<?php

class KayttajaKontrolleri extends BaseController {

    public static function index() {
        $kayttajat = Kayttaja::all();
        View::make('/Kayttaja/kayttajaListaus.html', array('kayttajat' => $kayttajat));
    }

    public static function kayttajanSeuraamat($idKayttaja) {
        $pelaajat = Kayttaja::kayttajanSeuraamatPelaajat($idKayttaja);
        View::make('/Kayttaja/kayttajanSeuraamatPelaajat.html', array('pelaajat' => $pelaajat));
    }

    public static function lisaysLomake() {
        View::make('/Kayttaja/uusiPelaajaSeurantaan.html');
    }

    public static function tallennaPelaajaSeurantaan() {
        $params = $_POST;
        $uusiSeurattava = new KayttajanPelaaja(array(
            'kayttajaId' => $params['kayttajaId'],
            'pelaajaTunnus' => $params['pelaajaTunnus'],
            'alkupvm' => $params['alkupvm'],
            'loppupvm' => $params['loppupvm']
        ));

        $uusiSeurattava->tallennaPelaajaSeurantaan();

        Redirect::to('/kayttajanSeuratut/');
    }

    public static function login() {
        View::make('Kayttaja/kirjaudu.html');
    }

    public static function handle_login() {
        $params = $_POST;

        $kayttaja = Kayttaja::authenticate($params['kayttajatunnus'], $params['salasana']);

        if (!$kayttaja) {
            View::make('Kayttaja/kirjaudu.html', array('error' => 'Väärä käyttäjätunnus tai salasana', 'kayttajatunnus' => $params['kayttajatunnus']));
        } else {
            $_SESSION['kayttaja'] = $kayttaja->kayttajatunnus;
            Redirect::to('/', array('message' => 'Tervetuloa palveluun ' . $kayttaja->etunimi . '!'));
        }
    }

    public static function logout() {
        $_SESSION['kayttaja'] = null;
        Redirect::to('/', array('message' => 'olet kirjautunut ulos'));
    }

}
