<?php

class KayttajaKontrolleri extends BaseController {

    public static function getKaikkiKayttajat() {
        $kayttajat = Kayttaja::all();
        View::make('/Kayttaja/kayttajaListaus.html', array('kayttajat' => $kayttajat));
    }

    public static function getKayttaja() {
        $kayttaja = Kayttaja::getKayttaja();
        View::make('/Kayttaja/kayttajatiedot.html', array('kayttaja' => $kayttaja));
    }

    public static function kayttajanSeuraamat() {
        $pelaajat = KayttajanPelaaja::getAll();
        View::make('/Kayttaja/kayttajanSeuraamatPelaajat.html', array('pelaajat' => $pelaajat));
    }

    public static function rekisteroitymisSivu() {
        View::make('Kayttaja/rekisteroidy.html');
    }

    public static function rekisteroiKayttaja() {
        $params = $_POST;
        $kayttaja = new Kayttaja(array(
            'kayttajatunnus' => $params['kayttajatunnus'],
            'etunimi' => $params['etunimi'],
            'sukunimi' => $params['sukunimi'],
            'email' => $params['email'],
            'salasana' => $params['salasana']
        ));

        $errors = $kayttaja->errors();
        if (count($errors) == 0) {
            $kayttaja->lisaaKayttaja();
            Redirect::to('/kirjaudu', array('message' => 'Tervetuloa palveluun ' . $kayttaja->etunimi . ', nyt voit kirjautua sisään!'));
        } else {
            View::make('Kayttaja/rekisteroidy.html', array('message' => 'Rekisteröityminen epäonnistui', 'errors' => $errors, 'params' => $params));
        }
    }

    public static function paivitaKayttajanTiedot() {
        $params = $_POST;
        $kirjautunutKayttaja = new Kayttaja(array('kayttajaId' => $_SESSION['kayttaja']));
        $kirjautunutKayttaja = $kirjautunutKayttaja->getKayttaja();
        $kayttaja = new Kayttaja(array(
            'kayttajatunnus' => 'dummytunnusvalidointiavarten',
            'etunimi' => $params['etunimi'],
            'sukunimi' => $params['sukunimi'],
            'email' => $params['email'],
            'salasana' => $params['salasana']
        ));
        $errors = $kayttaja->errors();
        if (count($errors) == 0) {
            $kayttaja->paivitaKayttaja();
            Redirect::to('/kayttajatiedot', array('message' => 'Tietosi ovat nyt päivitetty ja näkyvät alla'));
        } else {
            Redirect::to('/kayttajatiedot', array('errors' => $errors));
        }
    }

    public static function poistaKayttaja() {
        $kayttaja = new Kayttaja(array('kayttajaId' => $_SESSION['kayttaja']));
        $kayttaja->poistaKayttaja() ? Redirect::to('/', array('message' => 'Käyttäjätilisi on poistettu onnistuneesti')) : Redirect::to('/kayttajatiedot', array('message' => 'Jotain meni vikaan, tilisi on yhä aktiivinen'));
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
            $_SESSION['kayttaja'] = $kayttaja->idKayttaja;
            Redirect::to('/', array('message' => 'Tervetuloa palveluun ' . $kayttaja->etunimi . '!'));
        }
    }

    public static function logout() {
        $_SESSION['kayttaja'] = null;
        Redirect::to('/', array('message' => 'olet kirjautunut ulos'));
    }

}
