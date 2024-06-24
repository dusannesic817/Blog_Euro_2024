<?php


class ApiGroup{


    public $api_connection;


    public function __construct(){
        global $api_connection;

        $this->api_connection=$api_connection;
    }



    public function index(){
        $response=$this->api_connection->request();

        if($response){
            $data = json_decode($response, true);
            return $data;
        }
}
}