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
        $this->validators = array('validate_name');
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
               'classname' => $row['classname']
            ));
            return $taskclass;
        }
        return null;
    }
    
    public function validate_name(){
        return parent::validate_string_length($this->classname, 2);
    }
    
        public function save(){
    $query = DB::connection()->prepare('INSERT INTO TaskClass (classname) VALUES (:classname) RETURNING id');
    $query->execute(array('classname' => $this->classname));
    $row = $query->fetch();
//    Kint::trace();
//    Kint::dump($row);
    $this->id = $row['id'];
  }
  
      public function update(){
        $query = DB::connection()->prepare('UPDATE TaskClass SET (classname) = (:classname) where id = :id');
        $query->execute(array('id' => $this->id,  'classname' => $this->classname));
        $row = $query->fetch();
        Kint::dump($row);
    }
    
    public function destroy($id){
        $query = DB::connection()->prepare('DELETE FROM TaskClass WHERE id = :id');
        $query->execute(array('id' => $id));
        $row = $query->fetch();
        
        
    }
}

