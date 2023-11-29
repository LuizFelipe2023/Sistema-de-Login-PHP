<?php

class User
{
    private $id;
    private $username;
    private $password;

    public function __construct($username,$password){
           $this->username = $username;
           $this->password = $password;
    }
    
    public function getId(){
           return $this->id;
    }
    public function setId($id){
           $this->id = $id;
    }
    public function getUserName(){
           return $this->username;
    }
    public function setUserName($username){
           $this->username = $username;
    }
    public function getPassword(){
           return $this->password;
    }
    public function setPassword($password){
           $this->password = $password;
    }
   

}
interface userDaoInterface{
    public function createUser(User $user);
    public function login($username,$password);
    public function resetPassword($userId,$newPassword);
}
