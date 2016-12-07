<?php

class HelloWorldController extends BaseController {

    public static function index() {
        View::make('home.html');
    }

    public static function sandbox() {
        $kayttajat = array();
        $kayttajat [] = new Kayttaja(array(
            'idKayttaja' => 2395239,
            'etunimi' => 'kgejeg',
            'sukuniminimi' => 'gdsakgk',
            'kayttajatunnus' => 'gsaglök'
        ));
        foreach ($kayttajat as $kayttaja) {
            $errors = $kayttaja->errors();
            Kint::dump($errors);
        }
        View::make('/Kayttaja/kayttajaListaus.html', array('kayttajat' => $kayttajat));
    }

}
