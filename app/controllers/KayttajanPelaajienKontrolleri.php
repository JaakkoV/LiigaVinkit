<?php

class KayttajanPelaajienKontrolleri extends BaseController {

    # Käyttäjän pelaajien listaaminen kutsutaan KayttajaKontrollerista.kayttajanSeuraamat, joka täydentää "Käyttäjän pelaajat" CRUDin
    
    public static function tallennaPelaajaSeurantaan() {
        $params = $_POST;
        $seurattava = new KayttajanPelaaja(array(
            'kayttajaId' => $_SESSION['kayttaja'],
            'pelaajaTunnus' => $params['pelaajaTunnus'],
            'alkupvm' => $params['alkupvm'],
            'loppupvm' => $params['loppupvm']
        ));
        $seurattava->tallennaPelaajaSeurantaan();
        Redirect::to('/kayttajanSeuratut/');
    }

    public static function muokkaa() {
        $params = $_POST;
        $seurattava = new KayttajanPelaaja(array(
            'pelaajaTunnus' => $params['pelaajaTunnus'],
            'alkupvm' => $params['alkupvm'],
            'loppupvm' => $params['loppupvm']
        ));
        $seurattava->paivita();
        Redirect::to('/kayttajanSeuratut/');
    }

    public static function poistaSeurannasta($pelaajaTunnus) {
        $poistettava = new KayttajanPelaaja(array('pelaajaTunnus' => $pelaajaTunnus));
        $poistettava->poistaSeurannasta($pelaajaTunnus);
        Redirect::to('/kayttajanSeuratut/', array('message' => 'pelaaja poistettu'));
    }

}
