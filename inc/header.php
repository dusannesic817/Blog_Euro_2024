<?php
  require_once 'app/database/DbConnection.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/3f1d14d928.js" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>


    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.css" integrity="sha512-KOWhIs2d8WrPgR4lTaFgxI35LLOp5PRki/DxQvb7mlP29YZ5iJ5v8tiLWF7JLk5nDBlgPP1gHzw96cZ77oD7zQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://unpkg.com/dropzone@5/dist/min/dropzone.min.css">
    <link rel="stylesheet" href="public/main.css">
</head>
<body>
  <nav class="navbar navbar-expand-lg navbar-light ">
    <a class="navbar-brand" href="index.php">
        <img src="public/images/logo_euro_nav.png" width="260" height="75" class="d-inline-block align-top" alt="">
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse justify-content-center" id="navbarNavDropdown">
        <ul class="navbar-nav mx-auto">
            <li class="nav-item">
              <a class="nav-link" href="index.php" style="color:white;">Home</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="https://www.uefa.com/euro2024/" target="blank" style="color:white;">About</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="https://en.wikipedia.org/wiki/UEFA_European_Championship" target="blank" style="color:white;">History</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="https://eurogermanytickets.com/all-matches-euro-2024-tickets?gad_source=1&gclid=Cj0KCQjwvb-zBhCmARIsAAfUI2vjgYfy5znBKd_TmBIGWsj63UafWHgTPvdKM3ISWEhciOwPW-bSIioaAnNLEALw_wcB" target="blank" style="color:white;">Tickets</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="https://www.uefa.com/euro2024/news/" target="blank" style="color:white;">News</a>
            </li>
        </ul>     
        <ul class="navbar-nav">
          <?php
            if(isset($_SESSION['id'])){
          ?>
            <li class="nav-item">
              <a class="nav-link" href="create_post.php" style="color:white;">Create Post</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="show_profile.php?id=<?php echo $_SESSION['id']?>" style="color:white;">Profile</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="logout.php" style="color:white;">Logout</a>
            </li>
          <?php
          }else{
          ?>

            <li class="nav-item">
              <a class="nav-link" href="javascript:void(0)" id="loginLink" data-bs-toggle="modal" data-bs-target="#logModal" style="color:white;">Login</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="javascript:void(0)" id="registerLink" data-bs-toggle="modal" data-bs-target="#regModal" style="color:white;">Register</a>
            </li>
            <?php } ?>
        </ul>
    </div>
</nav>
