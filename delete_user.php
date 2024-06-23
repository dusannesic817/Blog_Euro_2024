<?php

require_once 'app/database/DbConnection.php';
require_once 'app/classes/User.php';


    if(!isset($_SESSION['id'])){
        header('location: index.php');
    }

    $user=new User();

    if(isset($_GET['id'])){

        $id=$_GET['id'];
        $delete=$user->delete($id);

        $_SESSION['succsses_delete']="Successfully deleted user";
        header('location: index.php');
        
    }