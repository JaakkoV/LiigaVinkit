<?php

class KayttajanPelaajienKontrolleri extends BaseController {
    # Käyttäjän pelaajien listaaminen kutsutaan KayttajaKontrollerista.kayttajanSeuraamat, joka täydentää "Käyttäjän pelaajat" CRUDin

    public function tallennaPelaajaSeurantaan() {
        $params = $_POST;
        $pelaaja = Pelaaja::getPelaaja($params['pelaajaTunnus']);
        $seurattava = new KayttajanPelaaja(array(
            'kayttajaId' => $_SESSION['kayttaja'],
            'pelaajaTunnus' => $params['pelaajaTunnus'],
            'alkupvm' => $params['alkupvm'],
            'loppupvm' => $params['loppupvm']
        ));
        $errors = $seurattava->errors();
        if (count($errors) == 0) {
            $seurattava->tallennaPelaajaSeurantaan();
            Redirect::to('/kayttajanSeuratut/', array('message' => 'Käyttäjä on lisätty seurantaasi!'));
        } else {
            View::make('/Pelaajat/pelaajatiedot.html', array('pelaaja' => $pelaaja, 'errors' => $errors, 'params' => $params));
        }
    }

    public static function muokkaa() {
        $params = $_POST;
        $pelaaja = Pelaaja::getPelaaja($params['pelaajaTunnus']);
        $seurattava = new KayttajanPelaaja(array(
            'pelaajaTunnus' => $params['pelaajaTunnus'],
            'alkupvm' => $params['alkupvm'],
            'loppupvm' => $params['loppupvm']
        ));
        $errors = $seurattava->errors();
        if (count($errors) == 0) {
            $seurattava->paivita();
            Redirect::to('/kayttajanSeuratut/', array('message' => 'Käyttäjä on lisätty seurantaasi!'));
        } else {
            View::make('/Pelaajat/pelaajatiedot.html', array('pelaaja' => $pelaaja, 'errors' => $errors, 'params' => $params));
        }
    }

    public static function poistaSeurannasta($pelaajaTunnus) {
        $poistettava = new KayttajanPelaaja(array('pelaajaTunnus' => $pelaajaTunnus));
        $poistettava->poistaSeurannasta($pelaajaTunnus);
        Redirect::to('/kayttajanSeuratut/', array('message' => 'pelaaja poistettu'));
    }

}
