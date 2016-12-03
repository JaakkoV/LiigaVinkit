<?php

class Laukaus extends BaseModel {

    public $idLaukaisut, $pelaajaTunnus, $top, $lefty, $otteluTunnus, $joukkue, $aika, $tulos, $event;

    public function __construct($attributes) {
        parent::__construct($attributes);
    }

    public static function all() {
        $query = DB::connection()->prepare('SELECT * FROM Laukaisut');
        $query->execute();
        $rows = $query->fetchAll();
        $laukaisut = array();

        foreach ($rows as $row) {
            $laukaisut[] = new Laukaus(array(
                'idLaukaisut' => $row['idLaukaisut'],
                'pelaajaTunnus' => $row['pelaajaTunnus'],
                'top' => $row['top'],
                'lefty' => $row['lefty'],
                'otteluTunnus' => $row['otteluTunnus'],
                'joukkue' => $row['joukkue'],
                'aika' => $row['aika'],
                'tulos' => $row['tulos'],
                'event' => $row['event']
            ));
        }
        return $laukaisut;
    }
}