<?php


    class KayttajaKontrolleri extends BaseController{
        
        public static function index(){
            $kayttajat = Kayttaja::all();
            View::make('/Kayttaja/kayttajaListaus.html', array('kayttajat' => $kayttajat));
        }
        
        public static function kayttajanSeuraamat($idKayttaja) {
            $pelaajat = Kayttaja::kayttajanSeuraamatPelaajat($idKayttaja);
            View::make('/Kayttaja/kayttajanSeuraamatPelaajat.html', array('pelaajat' => $pelaajat));
        }
        
    }