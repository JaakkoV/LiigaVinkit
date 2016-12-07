<?php

class KayttajanPelaajienKontrolleri extends BaseController {

    public static function lisaysLomake() {
        View::make('/Kayttaja/uusiPelaajaSeurantaan.html');
    }

    public static function tallennaPelaajaSeurantaan() {
        $params = $_POST;
        $seurattava = new KayttajanPelaaja(array(
            'kayttajaId' => $params['kayttajaId'],
            'pelaajaTunnus' => $params['pelaajaTunnus'],
            'alkupvm' => $params['alkupvm'],
            'loppupvm' => $params['loppupvm']
        ));
        $seurattava->tallennaPelaajaSeurantaan();
        Redirect::to('/kayttajanSeuratut/');
    }

    public static function muokkausLomake() {
        View::make('/Kayttaja/muokkaa.html');
    }

    public static function muokkaa() {
        $params = $_POST;
        $seurattava = new KayttajanPelaaja(array(
            'kayttajaId' => $params['kayttajaId'],
            'pelaajaTunnus' => $params['pelaajaTunnus'],
            'loppupvm' => $params['loppupvm']
        ));
        $seurattava->paivita();
        Redirect::to('/kayttajanSeuratut/' . $params['kayttajaId']);
    }
    
    

    public static function poistaSeurannasta($idKayttaja, $pelaajaTunnus) {
        $poistettava = new KayttajanPelaaja(array('kayttajaId' => $idKayttaja, 'pelaajaTunnus' => $pelaajaTunnus));
        $poistettava->poistaSeurannasta($idKayttaja, $pelaajaTunnus);
        Redirect::to('/kayttajanSeuratut/' . $idKayttaja, array('message' => 'pelaaja poistettu'));
    }

}
