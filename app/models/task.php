<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Task extends BaseModel {
    
    public $id, $taskname, $priority,  $classname, $description, $status, $account, $priority_id, $class_id;
    
    public function __construct($attributes) {
        parent::__construct($attributes);
        $this->validators = array('validate_taskname', 'validate_classname');
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
                'classname' => $row['classname'],
                'description' => $row['description'],
                'status' => $row['status'],
                'account' => $row['account'],
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
                'account' => $row['account'],
                'priority_id' => $row['priority_id'],
                'class_id' => $row['class_id']
            ));
            return $task;
        }
        return null;
    }
    
    public function save(){
    $query = DB::connection()->prepare('INSERT INTO Task (account, taskname, priority, classname, description) VALUES (:account, :taskname, :priority, :classname , :description) RETURNING id');
    $query->execute(array('account'=> $_SESSION['account'], 'taskname' => $this->taskname, 'priority' => $this->priority, 'classname' => $this->classname, 'description' => $this->description));
    $row = $query->fetch();
//    Kint::trace();
//    Kint::dump($row);
    $this->id = $row['id'];
  }
  
  

    
    public function validate_taskname(){
        return parent::validate_string_length($this->taskname, 3);
    }
    
    public function validate_classname(){
        return parent::validate_string_length($this->classname, 1);
    }
    
    public function update(){
        $query = DB::connection()->prepare('UPDATE Task SET (taskname, priority, classname, description) = (:taskname, :priority, :classname, :description) where id = :id');
        $query->execute(array('id' => $this->id, 'taskname' => $this->taskname, 'priority' => $this->priority, 'classname' => $this->classname, 'description' => $this->description));
        $row = $query->fetch();
        Kint::dump($row);
    }
    
    public function destroy($id){
        $query = DB::connection()->prepare('DELETE FROM Task WHERE id = :id');
        $query->execute(array('id' => $id));
        $row = $query->fetch();
        
        
    }
    
    
    
    
}





