<?php

    class PelaajaKontrolleri extends BaseController{
        
        public static function index(){
            $pelaajat = Pelaaja::all();
            View::make('/Pelaajat/pelaajalistaus.html', array('pelaajat' => $pelaajat));
        }
        
        public static function show($id) {
            $pelaaja = Pelaaja::find($id);
            View::make('/Pelaajat/pelaajatiedot.html', array('pelaaja' => $pelaaja));
        }
        
    }
