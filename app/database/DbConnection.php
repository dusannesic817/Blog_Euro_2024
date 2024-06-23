<?php



session_start();

require_once "Configuration.php";
require_once "Connection.php";

$configuration=new Configuration('localhost','root','','euro');
$connection= new Connection($configuration);

