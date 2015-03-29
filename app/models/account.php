<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Account extends BaseModel {
    
    public $id, $username, $username;
    
    public function __construct($attributes) {
        parent::__construct($attributes);
    }
    
    public static function all() {
        $query = DB::connection()->prepare('SELECT * FROM Account');
        
        $query->execute();
        
        $rows = $query->fetchAll();
        $accounts = array();
        
        foreach($rows as $row){
            $accounts[] = new Account(array(
                'id' => $row['id'],
                'username' => $row['username'],
                'password' => $row['password']
            ));
        }
        return $accounts;
    }
    
    public static function find($id) {
        $query = DB::connection()->prepare('SELECT * FROM Account WHERE id = :id LIMIT 1');
        $query->execute(array('id'=> $id));
        $row = $query->fetch();
        
        if($row){
            $account = new Account(array(
                'id' => $row['id'],
                'username' => $row['username'],
                'password' => $row['password']
            ));
            return $account;
        }
        return null;
    }
}

