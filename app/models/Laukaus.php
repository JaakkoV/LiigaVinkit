<?php

class Laukaus extends BaseModel {

    public $idLaukaisut, $pelaajaTunnus, $top, $lefty, $otteluTunnus, $joukkue, $aika, $tulos, $event, $isHome;

    public function __construct($attributes) {
        parent::__construct($attributes);
    }

    public static function all() {
        $query = DB::connection()->prepare('SELECT *, l.joukkue=o.kotijoukkueid as isHome FROM Laukaisut l JOIN Ottelut o ON o.otteluTunnus = l.otteluTunnus');
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
                'event' => $row['event'],
                'isHome' => $row['isHome']
            ));
        }
        return $laukaisut;
    }

    public function isHome() {
        if ($this->isHome == '1') {
            return 'home';
        }
        return 'away';
    }

    public static function find($pelaajaTunnus) {
        $query = DB::connection()->prepare('SELECT *, l.joukkue=o.kotijoukkueid as isHome FROM Laukaisut l JOIN Ottelut o ON o.otteluTunnus = l.otteluTunnus WHERE l.pelaajaTunnus = :pelaajaTunnus');
        $query->execute(array('pelaajaTunnus' => $pelaajaTunnus));
        $rows = $query->fetchAll();
        $pelaajanLaukaisut = array();

        foreach ($rows as $row) {
            $pelaajanLaukaisut[] = new Laukaus(array(
                'idLaukaisut' => $row['idLaukaisut'],
                'pelaajaTunnus' => $row['pelaajaTunnus'],
                'top' => $row['top'],
                'lefty' => $row['lefty'],
                'otteluTunnus' => $row['otteluTunnus'],
                'joukkue' => $row['joukkue'],
                'aika' => $row['aika'],
                'tulos' => $row['tulos'],
                'event' => $row['event'],
                'isHome' => $row['isHome']
            ));
        }
        return $pelaajanLaukaisut;
    }

}
