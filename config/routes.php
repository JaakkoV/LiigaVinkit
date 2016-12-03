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
    SeurattujenKontrolleri::tallennaPelaajaSeurantaan();
});

$routes->post('/muokkaa', function() {
    SeurattujenKontrolleri::muokkaa();
});

$routes->get('/muokkauslomake', function() {
    SeurattujenKontrolleri::muokkausLomake();
});

$routes->get('/lomake', function() {
    SeurattujenKontrolleri::lisaysLomake();
});

$routes->get('/kentta', function() {
    LaukausKontrolleri::index();
});