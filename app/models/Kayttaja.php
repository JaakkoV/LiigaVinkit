<?php

class Kayttaja extends BaseModel {

    public $idKayttaja, $kayttajatunnus, $etunimi, $sukunimi, $email;

    public function __construct($attributes) {
        parent::__construct($attributes);
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
                'email' => $row['email']
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
                    'joukkue' => $row['nimi']
                ));
            }
            return $pelaajat;
        }
        return null;
    }
    
}
