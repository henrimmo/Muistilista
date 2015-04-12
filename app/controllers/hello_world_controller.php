<?php
  require 'app/models/task.php';  
  class HelloWorldController extends BaseController{

    public static function index(){
      // make-metodi renderöi app/views-kansiossa sijaitsevia tiedostoja
   	  echo 'Tämä on etusivu!';
    }
    
    public static function sandbox(){
      $pyykki = new Task(array(
          'taskname' =>'d',
          'priority' => 'kiireellinen', 
          'classname' => 'koti'
          
      ));
      $errors = $pyykki->errors();
      
      Kint::dump($errors);
    }
    
    public static function task_list() {
        View::make('suunnitelmat/list.html');
    }

    public static function listShow(){
      // Testaa koodiasi täällä
      View::make('suunnitelmat/listShow.html');
    }
    
    public static function login() {
        View::make('suunnitelmat/login.html');
    }
    
    public static function edit() {
        View::make('suunnitelmat/edit.html');
    }
  }
