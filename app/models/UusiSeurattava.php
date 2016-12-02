<?php

class UusiSeurattava extends BaseModel {

    public $idKayttajanPelaajat, $kayttajaId, $pelaajaTunnus, $alkupvm, $loppupvm;

    public function __construct($attributes) {
        parent::__construct($attributes);
    }

    public function tallennaPelaajaSeurantaan() {
        $query = DB::connection()->prepare('INSERT INTO KayttajanPelaajat(kayttajaId, pelaajaTunnus, alkupvm, loppupvm) VALUES (:kayttajaId, :pelaajaTunnus, :alkupvm, :loppupvm)');
        $query->execute(array('kayttajaId'=>$this->kayttajaId, 'pelaajaTunnus'=>$this->pelaajaTunnus, 'alkupvm'=>$this->alkupvm, 'loppupvm'=>$this->loppupvm)); 
        
        #$row = $query->fetch();
        #$this->idKayttajanPelaajat = $row['idKayttajanPelaajat'];
    }
}
