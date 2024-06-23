<?php
require_once 'inc/header.php';
require_once 'app/classes/Rating.php';


$rating= new Rating();
 if($_SERVER["REQUEST_METHOD"]=="POST") {
    if(isset($_POST['mark'])) {
        $mark = $_POST['mark'];
        $rating->create($_SESSION['id'], $_SESSION['post_id'], $mark);
        
        header("Location: show_post.php?id=" . $_SESSION['post_id']);
        exit();
    }
}