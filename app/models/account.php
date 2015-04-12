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
    
    public static function authenticate($username, $password){
        $query = DB::connection()->prepare('SELECT * FROM Account WHERE username = :username and password = :password limit 1');
        $query->execute(array('username' => $username, 'password' => $password));
        $row = $query->fetch();
        
        if($row){
            return new Account(array(
                'id' => $row['id'],
                'username' =>$row['username'],
                'password' => $row['password']
            ));
        }else {
            return null;
        }
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
        
    }
}


