<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class TaskController extends BaseController{
    public static function index(){
        $tasks = Task::all();
        
        View::make('task/index.html', array('tasks' => $tasks));
    }
    
    public static function create() {
        View::make('task/new.html');
        
    }public static function show($id) {
        $task = Task::find($id);
        View::make('task/show.html', array('task' => $task));
    }
    
    public static function store(){
    $params = $_POST;
    $attributes= array(
      'taskname' => $params['taskname'],
      'priority' => $params['priority'],
      'classname' => $params['classname'],
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
        $task = Task::find($id);
        View::make('task/edit.html', array('attributes' => $task));
    }
    
    public static function update($id){
        $params = $_POST;
        
        $attributes = array(
            'id' => $id,
            'taskname' => $params['taskname'],
            'priority' => $params['priority'],
            'classname' => $params['classname'],
            'description' => $params['description'],
            'account' => $_SESSION['account']
        );
        
//      Kint::dump($params);
        
        $task = new Task($attributes);
        $errors = $task->errors();
        
        
//        if(count($errors) == 0){
//            $task->update();
//           
//           Redirect::to('/task/' . $task->id, array('message' => 'Askaretta muokattu onnistuneesti!'));
//            
//            
//        }else{
//            View::make('task/edit.html', array('errors' => $errors, 'attributes' => $attributes));
//        }
    }
    
    public static function destroy($id){
        $task = new Task(array('id' => $id));
        
        $task->destroy($id);
        
        Redirect::to('/task', array('message' => 'Askare poistettu onnistuneesti!'));
        
    }
}
    

