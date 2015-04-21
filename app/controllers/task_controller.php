<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class TaskController extends BaseController{
    public static function index(){
        self::check_logged_in();
        $tasks = Task::all();
        
        View::make('task/index.html', array('tasks' => $tasks));
    }
    
    public static function create() {
        self::check_logged_in();
        $classnames = TaskClass::all();
        View::make('task/new.html', array('classnames' => $classnames));
        
    }public static function show($id) {
        self::check_logged_in();
        $task = Task::find($id);
        View::make('task/show.html', array('task' => $task));
    }
    
    public static function store(){
        self::check_logged_in();
        $params = $_POST;
        $classname = $params['classname'];
        $attributes= array(
          'taskname' => $params['taskname'],
          'priority' => $params['priority'],
          'classname' => $classname,
          'description' => $params['description'],
          'account' => $_SESSION['account']
      
        );
        

        
        $task = new Task($attributes);
        $errors = $task->errors();

        if(count($errors) == 0) {
            $task->save();
            Redirect::to('/task/' . $task->id, array('message' => 'Askare lisätty muistilistaasi!'));
        }else{
            View::make('task/new.html', array('errors'=>$errors, 'attributes' => $attributes));
        }
    
  }
  
  public static function edit($id){
      self::check_logged_in();
        $task = Task::find($id);
        $classnames = TaskClass::all();
        View::make('task/edit.html', array('attributes' => $task, 'classnames'=> $classnames));
    }
    
    public static function update($id){
        self::check_logged_in();
        $params = $_POST;
        $classname = $params['classname'];
        
        $attributes = array(
            'id' => $id,
            'taskname' => $params['taskname'],
            'priority' => $params['priority'],
            'classname' => $classname,
            'description' => $params['description'],
            'account' => $_SESSION['account']
        );
        
//      Kint::dump($params);
        
        $task = new Task($attributes);
        $errors = $task->errors();
        
        
        if(count($errors) == 0){
            $task->update();
           
           Redirect::to('/task/' . $task->id, array('message' => 'Askaretta muokattu onnistuneesti!'));
            
            
        }else{
            View::make('task/edit.html', array('errors' => $errors, 'attributes' => $attributes));
        }
    }
    
    public static function destroy($id){
        self::check_logged_in();
        $task = new Task(array('id' => $id));
        
        $task->destroy($id);
        
        Redirect::to('/task', array('message' => 'Askare poistettu onnistuneesti!'));
        
    }
}
    

