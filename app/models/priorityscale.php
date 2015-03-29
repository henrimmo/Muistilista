<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class PriorityScale extends BaseModel {
    
    public $id, $priority, $description;
    
    public function __construct($attributes) {
        parent::__construct($attributes);
    }
    
    public static function all() {
        $query = DB::connection()->prepare('SELECT * FROM PriorityScale');
        
        $query->execute();
        
        $rows = $query->fetchAll();
        $priorityscales = array();
        
        foreach($rows as $row){
            $priorityscales[] = new PriorityScale(array(
                'id' => $row['id'],
                'priority' => $row['priority'],
                'description' => $row['description']
            ));
        }
        return $priorityscales;
    }
    
    public static function find($id) {
        $query = DB::connection()->prepare('SELECT * FROM PriorityScale WHERE id = :id LIMIT 1');
        $query->execute(array('id'=> $id));
        $row = $query->fetch();
        
        if($row){
            $priorityscale = new PriorityScale(array(
                'id' => $row['id'],
                'priority' => $row['priority'],
                'description' => $row['description']
            ));
            return $priorityscale;
        }
        return null;
    }
}
