<?php

require_once 'app/database/DbConnection.php';
require_once 'app/classes/Post.php';


    if(!isset($_SESSION['id'])){
        header('location: index.php');
    }

    $post=new Post();

    if(isset($_GET['id'])){

        $id=$_GET['id'];
        $delete=$post->delete($id);

        $_SESSION['succsses_delete']="Successfully deleted post";
        header('location: index.php');
        
    }