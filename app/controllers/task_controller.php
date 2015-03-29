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
    $task = new Task(array(
      'taskname' => $params['taskname'],
      'priority' => $params['priority'],
      'classname' => $params['classname'],
      'description' => $params['description']
      
    ));
    //Kint::dump($params);
    
    $task->save();
    Redirect::to('/task/' . $task->id, array('message' => 'Askare lisätty muistilistaasi!'));
  }
}
    

