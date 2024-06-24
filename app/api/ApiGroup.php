<?php


require_once "ApiConfiguration.php";
require_once "ApiConnection.php";

$curl=curl_init();

$api_configuration= new ApiConfiguration("x-rapidapi-host: euro-20242.p.rapidapi.com","x-rapidapi-key: f7d30c9eabmshab91b84ecb05d3ap104911jsn458f715dfbee","GET","https://euro-20242.p.rapidapi.com/groups");
$api_connection= new ApiConnection($api_configuration,$curl);

/*$response=$api_connection->request();

if($response){
    $data = json_decode($response, true);
    foreach($data as $key =>$values){
            
        
            var_dump($key);

            

    
    }
}*/
