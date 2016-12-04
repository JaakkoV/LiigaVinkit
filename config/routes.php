<?php
$routes->get('/', function() {
    HelloWorldController::index();
});

$routes->get('/pelaaja/:id', function($id) {
    PelaajaKontrolleri::show($id);
});

$routes->get('/pelaajat', function() {
    PelaajaKontrolleri::index();
});

$routes->get('/kayttajat', function() {
    KayttajaKontrolleri::index();
});

$routes->get('/kayttajanSeuratut/:idKayttaja', function($idKayttaja) {
    KayttajaKontrolleri::kayttajanSeuraamat($idKayttaja);
});

$routes->post('/lisaaSeurantaan', function() {
    KayttajanPelaajienKontrolleri::tallennaPelaajaSeurantaan();
});

$routes->post('/muokkaa', function() {
    KayttajanPelaajienKontrolleri::muokkaa();
});

$routes->get('/muokkauslomake', function() {
    KayttajanPelaajienKontrolleri::muokkausLomake();
});

$routes->get('/lomake', function() {
    KayttajanPelaajienKontrolleri::lisaysLomake();
});

$routes->get('/kentta', function() {
    LaukausKontrolleri::index();
});


$routes->get('/pelaajanLaukaukset/:pelaajaTunnus', function($pelaajaTunnus) {
    LaukausKontrolleri::find($pelaajaTunnus);
});