<?php

class Kayttaja extends BaseModel {

    public $idKayttaja, $kayttajatunnus, $etunimi, $sukunimi, $email, $salasana, $kayttajaryhma;

    public function __construct($attributes) {
        parent::__construct($attributes);
        $this->validators = array('validate_kayttajaId');
    }

    public static function all() {
        $query = DB::connection()->prepare('SELECT * FROM Kayttaja');
        $query->execute();
        $rows = $query->fetchAll();
        $kayttajat = array();

        foreach ($rows as $row) {
            $kayttajat[] = new Kayttaja(array(
                'idKayttaja' => $row['idKayttaja'],
                'kayttajatunnus' => $row['kayttajatunnus'],
                'etunimi' => $row['etunimi'],
                'sukunimi' => $row['sukunimi'],
                'email' => $row['email'],
                'salasana' => $row['salasana'],
                'kayttajaryhma' => $row['kayttajaryhma']
            ));
        }
        return $kayttajat;
    }

    public static function getKayttaja() {
        $query = DB::connection()->prepare('SELECT * FROM Kayttaja WHERE idKayttaja = :idKayttaja LIMIT 1');
        $query->execute(array('idKayttaja' => $_SESSION['kayttaja']));
        $row = $query->fetch();

        if ($row) {
            $kayttaja = new Kayttaja(array(
                'idKayttaja' => $row['idKayttaja'],
                'kayttajatunnus' => $row['kayttajatunnus'],
                'etunimi' => $row['etunimi'],
                'sukunimi' => $row['sukunimi'],
                'email' => $row['email'],
                'salasana' => $row['salasana'],
                'kayttajaryhma' => $row['kayttajaryhma']
            ));
            return $kayttaja;
        }
        return null;
    }

    public function onkoTunnusVapaa() {
        $query = DB::connection()->prepare('SELECT * FROM Kayttaja WHERE kayttajatunnus = :kayttajatunnus LIMIT 1');
        $query->execute(array('kayttajatunnus' => $this->kayttajatunnus));
        $row = $query->fetch();
        if ($row) {
            return false;
        }
        return true;
    }

    public function onkoTarvittavatTiedot() {
        if (strlen($this->kayttajatunnus) < 3 || strlen($this->etunimi) < 3 || strlen($this->sukunimi) < 3 || strlen($this->email) < 3 || strlen($this->salasana) < 3) {
            return false;
        }
        return true;
    }

    public function lisaaKayttaja() {
        if (self::onkoTunnusVapaa()) {
            $query = DB::connection()->prepare('INSERT INTO Kayttaja(kayttajatunnus, etunimi, sukunimi, email, salasana, kayttajaryhma) VALUES (:kayttajatunnus, :etunimi, :sukunimi, :email, :salasana, 1)');
            $query->execute(array('kayttajatunnus' => $this->kayttajatunnus, 'etunimi' => $this->etunimi, 'sukunimi' => $this->sukunimi, 'email' => $this->email, 'salasana' => $this->salasana));
            return true;
        }
        return false;
    }

    public function paivitaKayttaja() {
        $query = DB::connection()->prepare('UPDATE Kayttaja SET etunimi=:etunimi, sukunimi=:sukunimi, email=:email, salasana=:salasana WHERE idKayttaja = :idKayttaja');
        $query->execute(array('etunimi' => $this->etunimi, 'sukunimi' => $this->sukunimi, 'email' => $this->email, 'salasana' => $this->salasana, 'idKayttaja' => $_SESSION['kayttaja']));
        return true;
    }

    public function poistaKayttaja() {
        $query = DB::connection()->prepare('DELETE FROM Kayttaja WHERE idKayttaja = :idKayttaja');
        $query->execute(array('idKayttaja' => $_SESSION['kayttaja']));
        return true;
    }
    
    public static function kayttajanSeuraamatPelaajat($idKayttaja) {
        $query = DB::connection()->prepare('SELECT * FROM Kayttaja k JOIN KayttajanPelaajat kp ON k.idKayttaja = kp.kayttajaId JOIN Pelaajat p ON kp.pelaajaTunnus = p.pelaajaTunnus JOIN Joukkueet j ON p.joukkueid = j.idJoukkueet WHERE k.idKayttaja = :idKayttaja');
        $query->execute(array('idKayttaja' => $idKayttaja));
        $rows = $query->fetchAll();
        if ($rows) {
            $pelaajat = array();
            foreach ($rows as $row) {
                $pelaajat[] = new Pelaaja(array(
                    'pelaajaTunnus' => $row['pelaajaTunnus'],
                    'etunimi' => $row['etunimi'],
                    'sukunimi' => $row['sukunimi'],
                    'pelipaikka' => $row['pelipaikka'],
                    'dob' => $row['syntymaaika'],
                    'maila' => $row['maila'],
                    'paino' => $row['paino'],
                    'pituus' => $row['pituus'],
                    'joukkueNimi' => $row['nimi']
                ));
            }
            return $pelaajat;
        }
        return null;
    }

    public function validate_kayttajaId() {
        $errors = array();
        if ($this->idKayttaja == '' || $this->idKayttaja = null) {
            $errors[] = 'kayttajaId ei saa olla tyhjä';
        }
        if (is_numeric($this->idKayttaja)) {
            $errors[] = 'kayttajaId:n pitää olla numeroarvo';
        }
        return $errors;
    }

    public function authenticate($kayttajatunnus, $salasana) {
        $query = DB::connection()->prepare('SELECT * FROM Kayttaja WHERE kayttajatunnus = BINARY :kayttajatunnus AND salasana = BINARY :salasana LIMIT 1');
        $query->execute(array('kayttajatunnus' => $kayttajatunnus, 'salasana' => $salasana));
        $row = $query->fetch();
        if ($row) {
            $kayttaja = new Kayttaja(array(
                'idKayttaja' => $row['idKayttaja'],
                'kayttajatunnus' => $row['kayttajatunnus'],
                'etunimi' => $row['etunimi'],
                'sukunimi' => $row['sukunimi'],
                'email' => $row['email'],
                'salasana' => $row['salasana']
            ));
            return $kayttaja;
        } else {
            return null;
        }
    }

}
