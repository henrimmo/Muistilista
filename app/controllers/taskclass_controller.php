<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class TaskClassController extends BaseController{
    
    public static function index(){
        self::check_logged_in();
        $classes = TaskClass::all();
        
        View::make('class/index.html', array('classes' => $classes));
    }
    
    public static function create() {
        self::check_logged_in();
        View::make('class/new.html');
        
    }public static function show($id) {
        self::check_logged_in();
        $class = TaskClass::find($id);
        View::make('class/show.html', array('class' => $class));
    }
    
    public static function store(){
        self::check_logged_in();
        $params = $_POST;
        $attributes= array(
          'classname' => $params['classname']
        );
        $class = new TaskClass($attributes);
        $errors = $class->errors();

        if(count($errors) == 0) {
            $class->save();
            Redirect::to('/class', array('message' => 'Uusi luokka lisätty!'));
        }else{
            View::make('class/new.html', array('errors'=>$errors, 'attributes' => $attributes));
        }
    
  }
  
  public static function edit($id){
      self::check_logged_in();
        $class = TaskClass::find($id);
        View::make('class/edit.html', array('attributes' => $class));
    }
    
    public static function update($id){
        self::check_logged_in();
        $params = $_POST;
        
        $attributes = array(
            'id' => $id,
            'classname' => $params['classname']
        );
        
//      Kint::dump($params);
        
        $class = new TaskClass($attributes);
        $errors = $class->errors();
        
        
        if(count($errors) == 0){
            $class->update();
           
           Redirect::to('/', array('message' => 'Luokkaa muokattu onnistuneesti!'));
            
            
        }else{
            View::make('class/edit.html', array('errors' => $errors, 'attributes' => $attributes));
        }
    }
    
    public static function destroy($id){
        self::check_logged_in();
        $class = new TaskClass(array('id' => $id));
        
        $class->destroy($id);
        
        Redirect::to('/class', array('message' => 'Luokka poistettu onnistuneesti!'));
        
    }
}

