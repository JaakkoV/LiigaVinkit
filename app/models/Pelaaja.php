<?php

class Pelaaja extends BaseModel {

    public $idPelaajat, $pelaajaTunnus, $joukkueid, $etunimi, $sukunimi, $kausi, $pelipaikka, $dob, $maila, $paino, $pituus, $joukkueNimi;

    public function __construct($attributes) {
        parent::__construct($attributes);
    }

    public static function all() {
        $query = DB::connection()->prepare('SELECT * FROM Pelaajat p JOIN PelaajanJoukkueet pj ON p.pelaajaTunnus = pj.pelaajaTunnus JOIN Joukkueet j ON pj.joukkueid = j.idJoukkueet ORDER BY j.nimi DESC');
        $query->execute();
        $rows = $query->fetchAll();
        $pelaajat = array();

        foreach ($rows as $row) {
            $pelaajat[] = new Pelaaja(array(
                'idPelaajat' => $row['idPelaajat'],
                'pelaajaTunnus' => $row['pelaajaTunnus'],
                'joukkueid' => $row['joukkueid'],
                'etunimi' => $row['etunimi'],
                'sukunimi' => $row['sukunimi'],
                'kausi' => $row['kausi'],
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

    public static function find($pelaajaTunnus) {
        $query = DB::connection()->prepare('SELECT * FROM Pelaajat p JOIN PelaajanJoukkueet pj ON p.pelaajaTunnus = pj.pelaajaTunnus JOIN Joukkueet j ON pj.joukkueid = j.idJoukkueet WHERE p.pelaajaTunnus = :pelaajaTunnus LIMIT 1');
        $query->execute(array('pelaajaTunnus' => $pelaajaTunnus));
        $row = $query->fetch();

        if ($row) {
            $pelaaja = new Pelaaja(array(
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
            return $pelaaja;
        }
        return null;
    }

    public function linkki() {
        return strtolower("http://liiga.fi/media/players/" . $this->joukkueNimi . "/" . $this->pelaajaTunnus . "-" . $this->sukunimi . "-" . $this->etunimi . ".png");
    }

}
