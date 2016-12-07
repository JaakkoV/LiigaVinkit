<?php

$routes->get('/', function() {
    HelloWorldController::index();
});

$routes->get('/pelaaja/:id', function($id) {
    PelaajaKontrolleri::show($id);
});

$routes->get('/pelaajat', 'check_logged_in', function() {
    PelaajaKontrolleri::index();
});

$routes->get('/kayttajat', function() {
    KayttajaKontrolleri::index();
});

$routes->get('/kayttajanSeuratut/', 'check_logged_in', function() {
    $kayttaja = BaseController::get_user_logged_in();
    KayttajaKontrolleri::kayttajanSeuraamat($kayttaja->idKayttaja);
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



$routes->post('/poistaSeurannasta/:pelaajaTunnus', function($id, $pelaajaTunnus) {
    KayttajanPelaajienKontrolleri::poistaSeurannasta($id, $pelaajaTunnus);
});


$routes->get('/hiekkalaatikko', function() {
    HelloWorldController::sandbox();
});

$routes->get('/kirjaudu', function() {
    KayttajaKontrolleri::login();
});

$routes->post('/kirjaudu', function() {
    KayttajaKontrolleri::handle_login();
});

$routes->get('/logout', function() {
    KayttajaKontrolleri::logout();
});

function check_logged_in(){
    BaseController::check_logged_in();
}