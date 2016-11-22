<?php

class Pelaaja extends BaseModel {

    public $etunimi, $sukunimi, $joukkue, $pelipaikka, $dob;

    public function __construct($attributes) {
        parent::__construct($attributes);
    }

    public static function all() {
        $query = DB::connection()->prepare('SELECT * From Pelaajat');
        $query->execute();
        $rows = $query->fetchAll();
        $pelaajat = array();

        foreach ($rows as $row) {
            $pelaajat[] = new Pelaaja(array(
                'etunimi' => $row['etunimi'],
                'sukunimi' => $row['sukunimi'],
                'joukkue' => $row['joukkueid'],
                'pelipaikka' => $row['pelipaikka'],
                'dob' => $row['syntymaaika']
            ));
        }
        return $pelaajat;
    }

    public static function find($id) {
        $query = DB::connection()->prepare('SELECT * FROM Pelaajat WHERE idPelaajat = :id LIMIT 1');
        $query->execute(array('id' => $id));
        $row = $query->fetch();

        if ($row) {
            $pelaaja = new Pelaaja(array(
                'id' => $row['idPelaajat'],
                'etunimi' => $row['etunimi'],
                'sukunimi' => $row['sukunimi'],
                'joukkue' => $row['joukkueid'],
                'pelipaikka' => $row['pelipaikka'],
                'dob' => $row['syntymaaika']
            ));
            return $pelaaja;
        }
        return null;
    }

}
