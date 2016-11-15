<?php

  $routes->get('/', function() {
    HelloWorldController::index();
  });

  $routes->get('/muokkaus', function() {
    HelloWorldController::muokkaus();
  });

  $routes->get('/listaus', function() {
    HelloWorldController::listaus();
  });

  $routes->get('/hiekkalaatikko', function() {
    HelloWorldController::sandbox();
  });
