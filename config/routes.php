<?php

  $routes->get('/', function() {
    HelloWorldController::index();
  });

  $routes->get('/pelaaja/:id', function($id) {
      PelaajaKontrolleri::show($id);
  });

  $routes->get('/listaus', function() {
    HelloWorldController::listaus();
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
           KayttajaKontrolleri::tallennaPelaajaSeurantaan();
  });
  
        $routes->get('/lomake', function() {
           KayttajaKontrolleri::lisaysLomake();
  });
  
    $routes->get('/hiekkalaatikko', function() {
    HelloWorldController::sandbox();
  });