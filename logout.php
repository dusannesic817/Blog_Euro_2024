<?php

    require_once 'app/database/DbConnection.php';
    require_once "app/classes/User.php";

    $user= new User();

    $user->logOut();


    header("Location: index.php");
