<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Task extends BaseModel {
    
    public $id, $taskname, $priority,  $classname, $description, $status, $account_id, $priority_id, $class_id;
    
    public function __construct($attributes) {
        parent::__construct($attributes);
    }
    
    public static function all() {
        $query = DB::connection()->prepare('SELECT * FROM Task');
        
        $query->execute();
        
        $rows = $query->fetchAll();
        $tasks = array();
        
        foreach($rows as $row){
            $tasks[] = new Task(array(
                'id' => $row['id'],
                'taskname' => $row['taskname'],
                'priority' => $row['priority'],
                'classname' => $row['classname'],
                'description' => $row['description'],
                'status' => $row['status'],
                'account_id' => $row['account_id'],
                'priority_id' => $row['priority_id'],
                'class_id' => $row['class_id']
            ));
        }
        return $tasks;
    }
    
    
    public static function find($id) {
        $query = DB::connection()->prepare('SELECT * FROM Task WHERE id = :id LIMIT 1');
        $query->execute(array('id' => $id));
        $row = $query->fetch();
        
        
        if($row){
            $task = new Task(array(
                'id' => $row['id'],
                'taskname' => $row['taskname'],
                'priority' => $row['priority'],
                'classname' => $row['classname'],
                'description' => $row['description'],
                'status' => $row['status'],
                'account_id' => $row['account_id'],
                'priority_id' => $row['priority_id'],
                'class_id' => $row['class_id']
            ));
            return $task;
        }
        return null;
    }
    
    public function save(){
    $query = DB::connection()->prepare('INSERT INTO Task (taskname, priority, classname, description) VALUES (:taskname, :priority, :classname , :description) RETURNING id');
    $query->execute(array('taskname' => $this->taskname, 'priority' => $this->priority, 'classname' => $this->classname, 'description' => $this->description));
    $row = $query->fetch();
//    Kint::trace();
//    Kint::dump($row);
$this->id = $row['id'];
  }
}



