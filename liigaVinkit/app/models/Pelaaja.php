<?php

class Pelaaja extends BaseModel {

    public $idPelaajat, $pelaajaTunnus, $joukkueid, $etunimi, $sukunimi, $kausi, $pelipaikka, $dob, $maila, $paino, $pituus, $joukkueNimi, $laukaustenLkm;

    public function __construct($attributes) {
        parent::__construct($attributes);
    }

    public static function all() {
        $query = DB::connection()->prepare('SELECT p.*, j.nimi as joukkueNimi, count(l.idLaukaisut) as LKM FROM Pelaajat p JOIN Laukaisut l ON l.pelaajaTunnus = p.pelaajaTunnus JOIN Joukkueet j ON p.joukkueid = j.idJoukkueet GROUP BY p.pelaajaTunnus ORDER BY LKM desc');
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
                'joukkueNimi' => $row['joukkueNimi'],
                'laukaustenLkm' => $row['LKM']
            ));
        }
        return $pelaajat;
    }

    public static function getPelaaja($pelaajaTunnus) {
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
                'joukkueNimi' => $row['nimi']
            ));
            return $pelaaja;
        }
        return null;
    }

    public function linkki() {
        return strtolower("http://liiga.fi/media/players/" . $this->joukkueNimi . "/" . $this->pelaajaTunnus . "-" . $this->sukunimi . "-" . $this->etunimi . ".png");
    }

    public function getPelaajanLaukaustenLkm($event = "") {
        $pelaajanLaukaisut = new Laukaus(array(
            'pelaajaTunnus' => $this->pelaajaTunnus
        ));
        $pelaajanLaukaisut = $pelaajanLaukaisut->getLaukauksetByPelaaja($this->pelaajaTunnus, $event);
        return sizeof($pelaajanLaukaisut);
    }

    public function getPelaajanLaukaukset($event = "") {
        $pelaajanLaukaisut = new Laukaus(array(
            'pelaajaTunnus' => $this->pelaajaTunnus
        ));
        $pelaajanLaukaisut = $pelaajanLaukaisut->getLaukauksetByPelaaja($this->pelaajaTunnus, $event);
        return $pelaajanLaukaisut;
    }

    public function onkoKirjautuneenSeurannassa($pelaajaTunnus) {
        $query = DB::connection()->prepare('SELECT * FROM KayttajanPelaajat kp JOIN Pelaajat p ON kp.pelaajaTunnus = p.pelaajaTunnus WHERE kp.kayttajaId = :kayttajaId AND kp.pelaajaTunnus = :pelaajaTunnus LIMIT 1');
        $query->execute(array('kayttajaId' => $_SESSION['kayttaja'], 'pelaajaTunnus' => $pelaajaTunnus));
        $row = $query->fetch();
        $pelaaja = new Pelaaja(array());
        if ($row) {
            return 1;
        }
        return 0;
    }

}
