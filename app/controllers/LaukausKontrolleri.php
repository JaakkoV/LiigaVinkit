<?php

    class LaukausKontrolleri extends BaseController{
        
        public static function index(){
            $laukaisut = Laukaus::all();
            View::make('/Kentta/kentta.html', array('laukaisut' => $laukaisut));
        }
        
        public static function find($pelaajaTunnus) {
            $pelaajanLaukaisut = Laukaus::getLaukauksetByPelaaja($pelaajaTunnus);
            View::make('/Makrot/kentta.html', array('laukaisut' => $pelaajanLaukaisut));
        }
        
    }
