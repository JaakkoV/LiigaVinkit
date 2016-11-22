<?php

class HelloWorldController extends BaseController {

    public static function index() {
        // make-metodi renderöi app/views-kansiossa sijaitsevia tiedostoja
        //echo 'Tämä on etusivu!';  
        View::make('home.html');
    }

    public static function muokkaus() {
        // make-metodi renderöi app/views-kansiossa sijaitsevia tiedostoja
        //echo 'Tämä on etusivu!';  
        View::make('users_tools.html');
    }

    public static function listaus() {
        // make-metodi renderöi app/views-kansiossa sijaitsevia tiedostoja
        //echo 'Tämä on etusivu!';  
        View::make('users_own_view.html');
    }

    public static function sandbox() {
        // Testaa koodiasi täällä
        // View::make('users_own_view.html');
        
        //$pelaajat = Pelaaja::all();
        //Kint::dump($pelaajat);
        
        //$pelaaja = new Pelaaja(array('etunimi'=>'Jukka'));
        //echo $pelaaja->etunimi;
       
        $pelaaja = Pelaaja::find(16112);
        Kint::dump($pelaaja);
        
    }

}
