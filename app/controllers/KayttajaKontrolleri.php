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
            
            Redirect::to('/kayttajanSeuratut/' . $params['kayttajaId']);                    
        }
        
    }