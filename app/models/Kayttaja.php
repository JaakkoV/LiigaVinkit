<?php

class Kayttaja extends BaseModel {

    public $idKayttaja, $kayttajatunnus, $etunimi, $sukunimi, $email, $salasana;

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
                'salasana' => $row['salasana']
            ));
        }
        return $kayttajat;
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

    public static function find($kayttajatunnus) {
        $query = DB::connection()->prepare('SELECT * FROM Kayttaja WHERE kayttajatunnus = :kayttajatunnus LIMIT 1');
        $query->execute(array('kayttajatunnus' => $kayttajatunnus));
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
        $query = DB::connection()->prepare('SELECT * FROM Kayttaja WHERE kayttajatunnus = :kayttajatunnus AND salasana = :salasana LIMIT 1');
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
