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
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

