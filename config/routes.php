<?php

  $routes->get('/', function() {
    HelloWorldController::index();
  });

  $routes->get('/hiekkalaatikko', function() {
    HelloWorldController::sandbox();
  });
  
  $routes->get('/lista', function() {
    HelloWorldController::task_list();
  });
  
  $routes->get('/login', function() {
    HelloWorldController::login();
  });
  
  $routes->get('/edit/1', function() {
    HelloWorldController::edit();
  });
  
  $routes->get('/lista/1', function() {
    HelloWorldController::listShow();
  });
