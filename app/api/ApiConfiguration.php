<?php


class ApiConfiguration{

    public $host;
    public $key;
    public $method;

    public $url;


    public function __construct($host,$key,$method,$url){
        $this->host=$host;
        $this->key=$key;
        $this->method=$method;
        $this->url=$url;
    }

    
public function getHost(){
    return $this->host;
}
public function getKey(){
    return $this->key;
}
public function getMethod(){
    return $this->method;
}

public function getUrl(){
    return $this->url;
}
}