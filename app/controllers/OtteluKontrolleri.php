<?php

    class OtteluKontrolleri extends BaseController{
        
        public static function getAll(){
            $ottelut = Ottelu::all();
            View::make('/Ottelut/ottelulistaus.html', array('ottelut' => $ottelut));
        }
    }
