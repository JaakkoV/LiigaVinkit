<?php

class Laukaus extends BaseModel {

    public $idLaukaisut, $pelaajaTunnus, $top, $lefty, $otteluTunnus, $joukkue, $aika, $tulos, $event, $isHome;

    public function __construct($attributes) {
        parent::__construct($attributes);
    }

    public static function all($event='') {
        $queryString = 'SELECT *, l.joukkue=o.kotijoukkueid as isHome FROM Laukaisut l JOIN Ottelut o ON o.otteluTunnus = l.otteluTunnus';
        $event= $event==""?" LIMIT 1000":" WHERE l.event = '" . $event . "'";
        $queryString = $queryString . $event;
        $query = DB::connection()->prepare($queryString);
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
        # palauttaa kotijoukkueen, toiminnallisuus on toteutettu laukausten piirtoa kentälle varten
        if ($this->isHome == '1') {
            return 'home';
        }
        return 'away';
    }

    public static function getLaukauksetByPelaaja($pelaajaTunnus, $event="") {
        $queryString = 'SELECT *, l.joukkue=o.kotijoukkueid as isHome FROM Laukaisut l JOIN Ottelut o ON o.otteluTunnus = l.otteluTunnus WHERE l.pelaajaTunnus = :pelaajaTunnus';
        $event= $event==""?'':" AND l.event = '" . $event . "'";
        $queryString = $queryString . $event;
        $query = DB::connection()->prepare($queryString);
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

    public static function getLaukauksetByTeam($joukkue, $otteluTunnus, $event="") {
        $queryString = 'SELECT *, l.joukkue=o.kotijoukkueid as isHome FROM Laukaisut l JOIN Ottelut o ON o.otteluTunnus = l.otteluTunnus WHERE l.joukkue = :joukkue AND l.otteluTunnus = :otteluTunnus';
        $event= $event==""?'':" AND l.event = '" . $event . "'";
        $queryString = $queryString . $event;
        $query = DB::connection()->prepare($queryString);
        $query->execute(array('joukkue' => $joukkue, 'otteluTunnus' => $otteluTunnus));
        $rows = $query->fetchAll();
        $joukkueenLaukaisut = array();

        foreach ($rows as $row) {
            $joukkueenLaukaisut[] = new Laukaus(array(
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
        return $joukkueenLaukaisut;
    }
    
    public static function getLaukauksetByOttelu($otteluTunnus, $event="") {
        $queryString = 'SELECT *, l.joukkue=o.kotijoukkueid as isHome FROM Laukaisut l JOIN Ottelut o ON o.otteluTunnus = l.otteluTunnus WHERE l.otteluTunnus = :otteluTunnus';
        $event= $event==""?'':" AND l.event = '" . $event . "'";
        $queryString = $queryString . $event;
        $query = DB::connection()->prepare($queryString);
        $query->execute(array('otteluTunnus' => $otteluTunnus));
        $rows = $query->fetchAll();
        $ottelunLaukaukset = array();

        foreach ($rows as $row) {
            $ottelunLaukaukset[] = new Laukaus(array(
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
        return $ottelunLaukaukset;
    }
    
}