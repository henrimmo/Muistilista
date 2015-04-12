<?php

  $routes->get('/task', function() {
      TaskController::index();
  }); 
    
  $routes->get('/', function() {
    TaskController::index();
  });
  
  
  
  
  $routes->post('/task', function(){
  TaskController::store();
  });

  $routes->get('/task/new', function(){
  TaskController::create();
  });
  
  $routes->get('/task/:id', function($id) {
    TaskController::show($id);
  });
  
  $routes->get('/task/:id/edit', function($id){
      TaskController::edit($id);
  });
  
  $routes->post('/task/:id/edit', function($id) {
      TaskController::update($id); 
  });
  
  $routes->get('/task/:id/destroy', function($id){
      TaskController::destroy($id); 
  });
  
  $routes->get('/hiekkalaatikko', function() {
    HelloWorldController::sandbox();
  });
  
  $routes->get('/login', function(){
     UserController::login(); 
  });
  
    $routes->post('/login', function(){
     UserController::handle_login(); 
    });
  
//  $routes->get('/lista', function() {
//    HelloWorldController::task_list();
//  });
//  
//  $routes->get('/login', function() {
//    HelloWorldController::login();
//  });
//  
//  $routes->get('/edit/1', function() {
//    HelloWorldController::edit();
//  });
//  
//  $routes->get('/lista/1', function() {
//    HelloWorldController::listShow();
//  });
