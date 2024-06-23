<?php
require_once 'app/database/DbConnection.php';
require_once 'app/classes/Comment.php';


    if(!isset($_SESSION['id'])){
        header('location: index.php');
    }
    
    $comment=new Comment();



    if(isset($_GET['id'])){

        $id=$_GET['id'];
        $user_id=$_SESSION['id'];

        $delete=$comment->delete($id,$user_id);

        $_SESSION['succsses_delete_com']="Successfully deleted comment";
            header("Location: show_post.php?id=" . $_SESSION['post_id']);
        
    }