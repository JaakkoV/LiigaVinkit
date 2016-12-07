<?php

class KayttajanPelaaja extends BaseModel {

    public $idKayttajanPelaajat, $kayttajaId, $pelaajaTunnus, $alkupvm, $loppupvm;

    public function __construct($attributes) {
        parent::__construct($attributes);
           $this->validators = array('validate_kayttajaId', 'validate_pelaajaTunnus');
    }

    public function tallennaPelaajaSeurantaan() {
        $query = DB::connection()->prepare('INSERT INTO KayttajanPelaajat(kayttajaId, pelaajaTunnus, alkupvm, loppupvm) VALUES (:kayttajaId, :pelaajaTunnus, :alkupvm, :loppupvm)');
        $query->execute(array('kayttajaId' => $this->kayttajaId, 'pelaajaTunnus' => $this->pelaajaTunnus, 'alkupvm' => $this->alkupvm, 'loppupvm' => $this->loppupvm));
    }

    public function paivita() {
        $query = DB::connection()->prepare('UPDATE KayttajanPelaajat SET loppupvm = :loppupvm WHERE pelaajaTunnus = :pelaajaTunnus AND kayttajaId = :kayttajaId');
        $query->execute(array('loppupvm' => $this->loppupvm, 'pelaajaTunnus' => $this->pelaajaTunnus, 'kayttajaId'=>$this->kayttajaId));
    }

    public function validate_kayttajaId() {
        $errors = array();
        if($this->kayttajaId=='' || $this->kayttajaId=null); {
            $errors[] = 'kayttajaId ei saa olla tyhjä';
        }
        if(!is_numeric($this->kayttajaId)) {
            $errors[] = 'kayttajaId:n pitää olla numeroarvo';
        }
        return $errors;
    }
    
    public function poistaSeurannasta($kayttajaId, $pelaajaTunnus) {
        $query = DB::connection()->prepare('DELETE FROM KayttajanPelaajat WHERE kayttajaId = :kayttajaId AND pelaajaTunnus = :pelaajaTunnus');
        $query->execute(array('kayttajaId' => $this->kayttajaId, 'pelaajaTunnus' => $this->pelaajaTunnus));
    }
}
