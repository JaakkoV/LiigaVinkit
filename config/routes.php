<?php

$routes->get('/', function() {
    YleinenKontrolleri::index();
});

# Pelaajiin liittyvät reitit
$routes->get('/pelaajat', 'check_logged_in', function() {
    PelaajaKontrolleri::index();
});
$routes->get('/pelaaja/:id', 'check_logged_in', function($id) {
    PelaajaKontrolleri::show($id);
});

# Käyttäjiin liittyvät reitit
$routes->get('/rekisteroidy', function() {
    KayttajaKontrolleri::rekisteroitymisSivu();
});

$routes->post('/rekisteroiKayttaja/', function() {
    KayttajaKontrolleri::rekisteroiKayttaja();
});

$routes->post('/paivitaKayttajanTiedot', 'check_logged_in', function() {
    KayttajaKontrolleri::paivitaKayttajanTiedot();
});

$routes->get('/poistaKayttaja', 'check_logged_in', function() {
    KayttajaKontrolleri::poistaKayttaja();
});

$routes->get('/kayttajat', 'check_admin_logged_in', function() {
    # käyttäjälistaus, vain Admineille (käyttäjäryhmä 0)
    KayttajaKontrolleri::getKaikkiKayttajat();
});

$routes->get('/kayttajatiedot', 'check_logged_in', function() {
    KayttajaKontrolleri::getKayttaja();
});

$routes->get('/kayttajanSeuratut/', 'check_logged_in', function() {
    $kayttaja = BaseController::get_user_logged_in();
    KayttajaKontrolleri::kayttajanSeuraamat();
});

$routes->post('/lisaaSeurantaan/', 'check_logged_in', function() {
    KayttajanPelaajienKontrolleri::tallennaPelaajaSeurantaan();
});

$routes->post('/muokkaa/', 'check_logged_in', function() {
    KayttajanPelaajienKontrolleri::muokkaa();
});

$routes->get('/poistaSeurannasta/:pelaajaTunnus', 'check_logged_in', function($pelaajaTunnus) {
    KayttajanPelaajienKontrolleri::poistaSeurannasta($pelaajaTunnus);
});

# Otteluihin liittyvät reitit
$routes->get('/ottelut/', 'check_logged_in', function() {
    OtteluKontrolleri::getAll();
});

$routes->get('/ottelutiedot/:otteluTunnus', 'check_logged_in', function($otteluTunnus) {
    OtteluKontrolleri::getOttelu($otteluTunnus);
});

# Kenttään liittyvät reitit
$routes->get('/kentta', 'check_logged_in', function() {
    LaukausKontrolleri::index();
});


# Kirjautumiseen liittyvät reitit
$routes->get('/kirjaudu', function() {
    KayttajaKontrolleri::login();
});

$routes->post('/kirjaudu', function() {
    KayttajaKontrolleri::handle_login();
});

$routes->get('/logout', function() {
    KayttajaKontrolleri::logout();
});

function check_logged_in() {
    BaseController::check_logged_in();
}

function check_admin_logged_in() {
    BaseController::check_admin_logged_in();
}
