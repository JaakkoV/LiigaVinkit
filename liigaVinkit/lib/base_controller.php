<?php

class BaseController {

    public static function get_user_logged_in() {
        if (isset($_SESSION['kayttaja'])) {
            $kayttaja = Kayttaja::getKayttaja();
            return $kayttaja;
        }
        return null;
    }

    public static function check_logged_in() {
        if (!isset($_SESSION['kayttaja'])) {
            Redirect::to('/kirjaudu', array('message' => 'Kirjaudu ensin sisään juipelo'));
        }
    }

    public function check_admin_logged_in() {
        if (!isset($_SESSION['kayttaja'])) {
            Redirect::to('/kirjaudu', array('message' => 'Kirjaudu ensin sisään juipelo'));
        }
        $kirjautunutKayttaja = self::get_user_logged_in();
        if($kirjautunutKayttaja->kayttajaryhma!=0) {
            Redirect::to('/', array('message' => 'Tarvitset ylläpitäjän oikeudet tarkastellaksesi tätä sivua', 'img' => '/assets/pics/nedry.gif'));
        }
    }

}
