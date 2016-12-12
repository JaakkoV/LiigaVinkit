<?php

class Ottelu extends BaseModel {

    public $idOttelut, $otteluTunnus, $kotijoukkueId, $vierasjoukkueId, $pvm, $yleiso, $kotijoukkueNimi, $vierasjoukkueNimi;

    public function __construct($attributes = null) {
        parent::__construct($attributes);
    }

    public static function all() {
        $query = DB::connection()->prepare('SELECT o.idOttelut, o.otteluTunnus, o.kotijoukkueid, o.vierasjoukkueid, o.pvm, o.yleiso, jkoti.nimi AS "koti", jvieras.nimi AS "vieras" FROM Ottelut o JOIN Joukkueet jkoti ON o.kotijoukkueid = jkoti.idJoukkueet JOIN Joukkueet jvieras ON o.vierasjoukkueId = jvieras.idJoukkueet ORDER BY o.pvm');
        $query->execute();
        $rows = $query->fetchAll();
        $ottelut = array();

        foreach ($rows as $row) {
            $ottelut[] = new Ottelu(array(
                'idOttelut' => $row['idOttelut'],
                'otteluTunnus' => $row['otteluTunnus'],
                'kotijoukkueId' => $row['kotijoukkueid'],
                'vierasjoukkueId' => $row['vierasjoukkueid'],
                'pvm' => $row['pvm'],
                'yleiso' => $row['yleiso'],
                'kotijoukkueNimi' => $row['koti'],
                'vierasjoukkueNimi' => $row['vieras']
            ));
        }
        return $ottelut;
    }

    public function getJoukkueenLaukaustenLkm($joukkueId, $event="") {
        $joukkueenLaukaukset = new Laukaus(array(
            'joukkue' => $joukkueId,
            'otteluTunnus' => $this->otteluTunnus,
            'event' => $event
        ));
        $joukkueenLaukaukset = $joukkueenLaukaukset->getLaukauksetByTeam($joukkueId, $this->otteluTunnus, $event);
        return sizeof($joukkueenLaukaukset);
    }

    public function getKotiJoukkueenLaukaustenLkm($event="") {
        return $this->getJoukkueenLaukaustenLkm($this->kotijoukkueId, $event);
    }

    public function getVierasJoukkueenLaukaustenLkm($event="") {
        return $this->getJoukkueenLaukaustenLkm($this->vierasjoukkueId, $event);
    }

}
