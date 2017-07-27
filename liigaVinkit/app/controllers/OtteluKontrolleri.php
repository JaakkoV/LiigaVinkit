<?php

class OtteluKontrolleri extends BaseController {

    public static function getAll() {
        $ottelut = Ottelu::all();
        View::make('/Ottelut/ottelulistaus.html', array('ottelut' => $ottelut));
    }

    public static function getOttelu($otteluTunnus) {
        $ottelu = Ottelu::getOttelu($otteluTunnus);
        View::make('/Ottelut/ottelutiedot.html', array('ottelu' => $ottelu));
    }

}
