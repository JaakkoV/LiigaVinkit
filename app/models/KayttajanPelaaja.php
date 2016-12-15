<?php

class KayttajanPelaaja extends BaseModel {

    public $idKayttajanPelaajat, $kayttajaId, $joukkueNimi, $pelaajaTunnus, $etunimi, $sukunimi, $pelipaikka, $dob, $maila, $paino, $pituus, $alkupvm, $loppupvm;

    public function __construct($attributes) {
        parent::__construct($attributes);
    }

    public function getAll() {
        $query = DB::connection()->prepare('SELECT * FROM KayttajanPelaajat kp JOIN Pelaajat p ON kp.pelaajaTunnus = p.pelaajaTunnus JOIN Joukkueet j ON p.joukkueid = j.idJoukkueet WHERE kayttajaId = :kayttajaId');
        $query->execute(array('kayttajaId' => $_SESSION['kayttaja']));
        $rows = $query->fetchAll();
        $kayttajanPelaajat = array();

        foreach ($rows as $row) {
            $kayttajanPelaajat[] = new KayttajanPelaaja(array(
                'idKayttajanPelaajat' => $row['idKayttajanPelaajat'],
                'kayttajaId' => $row['kayttajaId'],
                'pelaajaTunnus' => $row['pelaajaTunnus'],
                'etunimi' => $row['etunimi'],
                'sukunimi' => $row['sukunimi'],
                'pelipaikka' => $row['pelipaikka'],
                'dob' => $row['syntymaaika'],
                'maila' => $row['maila'],
                'paino' => $row['paino'],
                'pituus' => $row['pituus'],
                'alkupvm' => $row['alkupvm'],
                'loppupvm' => $row['loppupvm'],
                'joukkueNimi' => $row['nimi']
            ));
        }

        return $kayttajanPelaajat;
    }

    public function getPelaajanLaukaustenLkm($event = "") {
        $pelaajanLaukaisut = new Laukaus(array(
            'pelaajaTunnus' => $this->pelaajaTunnus
        ));
        $pelaajanLaukaisut = $pelaajanLaukaisut->getLaukauksetByPelaaja($this->pelaajaTunnus, $event);
        return sizeof($pelaajanLaukaisut);
    }

    public function tallennaPelaajaSeurantaan() {
        $query = DB::connection()->prepare('INSERT INTO KayttajanPelaajat(kayttajaId, pelaajaTunnus, alkupvm, loppupvm) VALUES (:kayttajaId, :pelaajaTunnus, :alkupvm, :loppupvm)');
        $query->execute(array('kayttajaId' => $_SESSION['kayttaja'], 'pelaajaTunnus' => $this->pelaajaTunnus, 'alkupvm' => $this->alkupvm, 'loppupvm' => $this->loppupvm));
    }

    public function paivita() {
        $query = DB::connection()->prepare('UPDATE KayttajanPelaajat SET loppupvm = :loppupvm, alkupvm = :alkupvm WHERE pelaajaTunnus = :pelaajaTunnus AND kayttajaId = :kayttajaId');
        $query->execute(array('loppupvm' => $this->loppupvm, 'alkupvm' => $this->alkupvm, 'pelaajaTunnus' => $this->pelaajaTunnus, 'kayttajaId' => $_SESSION['kayttaja']));
    }

    public function poistaSeurannasta($pelaajaTunnus) {
        $query = DB::connection()->prepare('DELETE FROM KayttajanPelaajat WHERE kayttajaId = :kayttajaId AND pelaajaTunnus = :pelaajaTunnus');
        $query->execute(array('kayttajaId' => $_SESSION['kayttaja'], 'pelaajaTunnus' => $this->pelaajaTunnus));
    }

}
