<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Task extends BaseModel {
    
    public $id, $taskname, $priority, $description, $status, $account, $classes;
    
    public function __construct($attributes) {
        parent::__construct($attributes);
        $this->validators = array('validate_taskname');
    }
    
    public static function all() {
        $query = DB::connection()->prepare('SELECT * FROM Task where account =:account');
        
        $query->execute(array('account' => $_SESSION['account']));
        
        $rows = $query->fetchAll();
        $tasks = array();
        
        foreach($rows as $row){
            $tasks[] = new Task(array(
                'id' => $row['id'],
                'taskname' => $row['taskname'],
                'priority' => $row['priority'],
                'description' => $row['description'],
                'status' => $row['status'],
                'account' => $row['account'],
                'classes' => TaskClass::findClasses($row['id'])
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
                'description' => $row['description'],
                'status' => $row['status'],
                'account' => $row['account'],
                'classes' => TaskClass::findClasses($id)
                
                
            ));
            return $task;
        }
        return null;
    }
    
    public function save(){
    $query = DB::connection()->prepare('INSERT INTO Task (account, taskname, priority, description, status) VALUES (:account, :taskname, :priority, :description, :status) RETURNING id');
    $query->execute(array('account'=> $_SESSION['account'], 'taskname' => $this->taskname, 'priority' => $this->priority, 'description' => $this->description, 'status' => $this->status));
    $row = $query->fetch();
//    Kint::trace();
//    Kint::dump($row);
    $this->id = $row['id'];
    
    foreach ($this->classes as $class){
        $this->saveTasksClasses($class, $row['id']);
    }
    
  }
  
  

    
    public function validate_taskname(){
        return parent::validate_string_length($this->taskname, 3);
    }
    
//    public function validate_classname(){
//        return parent::validate_string_length($this->classname, 1);
//    }
    
    public function update(){
        $query = DB::connection()->prepare('UPDATE Task SET (taskname, priority, description, status) = (:taskname, :priority, :description, :status) where id = :id');
        $query->execute(array('id' => $this->id, 'taskname' => $this->taskname, 'priority' => $this->priority, 'description' => $this->description, 'status' => $this->status ));
        $row = $query->fetch();
//        Kint::dump($row);
        
        $deletequery = DB::connection()->prepare('DELETE FROM Classes where task_id = :task_id');
        $deletequery->execute(array('task_id' => $this->id));
        $row = $query->fetch();



        foreach ($this->classes as $class){
            $this->saveTasksClasses($class, $this->id);
    }
    }
    
    public function destroy($id){
        $query = DB::connection()->prepare('DELETE FROM Task WHERE id = :id');
        $query->execute(array('id' => $id));
        $row = $query->fetch();
        
        
    }
    
    public function saveTasksClasses($class, $id) {
        $query = DB::connection()->prepare
                ('INSERT INTO Classes (task_id, class_id) VALUES (:task_id, :class_id)');
        $query->execute(array(
            'task_id' => $id,
            'class_id' => $class
                )
        );
    }    
    
    
    
    
}





