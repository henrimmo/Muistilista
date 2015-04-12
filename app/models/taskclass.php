<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class TaskClass extends BaseModel {
    
    public $id, $classname;
    
    public function __construct($attributes) {
        parent::__construct($attributes);
    }
    
    public static function all() {
        $query = DB::connection()->prepare('SELECT * FROM TaskClass');
        
        $query->execute();
        
        $rows = $query->fetchAll();
        $taskclasses = array();
        
        foreach($rows as $row){
            $taskclasses[] = new TaskClass(array(
                'id' => $row['id'],
                'classname' => $row['classname']
            ));
        }
        return $taskclasses;
    }
    
    public static function find($id) {
        $query = DB::connection()->prepare('SELECT * FROM TaskClass WHERE id = :id LIMIT 1');
        $query->execute(array('id'=> $id));
        $row = $query->fetch();
        
        if($row){
            $taskclass = new TaskClass(array(
                'id' => $row['id'],
                'taskname' => $row['taskname']
            ));
            return $taskclass;
        }
        return null;
    }
    
    public function validate_name($string, $length) {
        
    }
}

