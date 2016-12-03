<?php

class KenttaKontrolleri extends BaseController {

    public static function index() {
        View::make('/Kentta/kentta.html');
    }

}
