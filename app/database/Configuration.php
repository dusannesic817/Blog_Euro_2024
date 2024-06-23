<?php
class Configuration{

    private $server_name;
    private $username;
    private $password;
    private $database_name;


    public function __construct($server_name,$username,$password,$database_name){
        $this->server_name=$server_name;
        $this->username=$username;
        $this->password=$password;
        $this->database_name=$database_name;
    }


  public function getServerName(){
        return $this->server_name;
    }
    public function getUsername(){
        return $this->username;
    }
    public function getPassword(){
        return $this->password;
    }

    public function getDatabaseName(){
        return $this->database_name;
    }

}