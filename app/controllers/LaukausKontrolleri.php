<?php

class LaukausKontrolleri extends BaseController {

    public static function index() {
        $goal = Laukaus::all('event-goal');
        $save = Laukaus::all('event-save');
        $miss = Laukaus::all('event-miss');
        $block = Laukaus::all('event-block');
        View::make('/Kentta/kentta.html', array('goal' => $goal, 'save' => $save, 'miss' => $miss, 'block' => $block));
    }

}
