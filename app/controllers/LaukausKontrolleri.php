<?php

    class LaukausKontrolleri extends BaseController{
        
        public static function index(){
            $laukaisut = Laukaus::all();
            View::make('/Kentta/kentta.html', array('laukaisut' => $laukaisut));
        }
        
        public static function show($id) {
            $pelaaja = Pelaaja::find($id);
            View::make('/Pelaajat/pelaajatiedot.html', array('pelaaja' => $pelaaja));
        }
        
    }
