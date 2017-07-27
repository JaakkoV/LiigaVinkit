<?php

class YleinenKontrolleri extends BaseController {

    public static function index() {
        View::make('home.html');
    }

    public static function sandbox() {
        View::make('/helloworld.html');
    }

}
