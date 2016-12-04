<?php

class KayttajanPelaaja extends BaseModel {

    public $idKayttajanPelaajat, $kayttajaId, $pelaajaTunnus, $alkupvm, $loppupvm;

    public function __construct($attributes) {
        parent::__construct($attributes);
    }

    public function tallennaPelaajaSeurantaan() {
        $query = DB::connection()->prepare('INSERT INTO KayttajanPelaajat(kayttajaId, pelaajaTunnus, alkupvm, loppupvm) VALUES (:kayttajaId, :pelaajaTunnus, :alkupvm, :loppupvm)');
        $query->execute(array('kayttajaId' => $this->kayttajaId, 'pelaajaTunnus' => $this->pelaajaTunnus, 'alkupvm' => $this->alkupvm, 'loppupvm' => $this->loppupvm));
    }

    public function paivita() {
        $query = DB::connection()->prepare('UPDATE KayttajanPelaajat SET loppupvm = :loppupvm WHERE pelaajaTunnus = :pelaajaTunnus');
        $query->execute(array('loppupvm' => $this->loppupvm, 'pelaajaTunnus' => $this->pelaajaTunnus));
    }

}
