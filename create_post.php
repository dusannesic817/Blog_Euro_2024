<?php
require_once 'inc/header.php';
require_once 'app/classes/Post.php';
require_once 'app/classes/Image.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user_id = $_SESSION['id'];
    $title = $_POST['title'];
    $text = $_POST['text'];
    $tag = $_POST['tag'];

    $post = new Post();
    $images = new Image();

    $create = $post->create($user_id, $title, $text, $tag);
    
    if ($create) {
        $post_id = $_SESSION['last_insert_post'];

        foreach ($_POST['photo_path'] as $photo_path) {
            $images->create($user_id, $post_id, $photo_path);
        }
        $_SESSION['success_post'] = "Your post created successfully";
    } else {
        $_SESSION['error_post'] = "Unsuccessful post creation";
    }

    header("Location: " . $_SERVER['PHP_SELF']);
    exit();
}



?>

 <?php
      if(isset($_SESSION['success_post']) || isset($_SESSION['error_post'])):?>
<div class="alert alert-warning alert-dismissible fade show" role="alert">
  <?php 
        if(isset($_SESSION['success_post'])){
          echo $_SESSION['success_post'];
          unset($_SESSION['success_post']);
          }elseif(isset($_SESSION['error_post'])){
            echo $_SESSION['error_post'];
          unset($_SESSION['error_post']);
          }
  ?>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
    </div>
    <?php endif?>
    <div class="container mt-5" style="margin-bottom: 70px">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">

                        <div class="row">
                            <div class="col-md-12">
                                <h5 class="ms-3">Post Your Exprirence</h5>
                                <div class="border-bottom"></div>
                            </div>
                        </div>
                        <form action="create_post.php" method="POST"  enctype="multipart/form-data" >
                            <div class="row mt-5">
                                <div class="col-md-2"><h5>Name</h5></div>
                                <div class="col-md-5">
                                    <div class="input-group mb-3">
                                        <input
                                        type="text"
                                        name='title' 
                                        class="form-control"
                                        value=""
                                        />
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-4">
                                <div class="col-md-2"><h5>Text</h5></div>
                                <div class="col-md-8">
                                    <textarea 
                                    name="text" 
                                    id="text"
                                    class="form-control"
                                    value=""
                                    rows="15"></textarea>                
                                </div>
                            </div>
                            <div class="row mt-4">
                                <div class="col-md-2"><h5>Tags</h5></div>
                                <div class="col-md-5">
                                    <div class="input-group mb-3">
                                        <input
                                        type="text"
                                        name='tag' 
                                        class="form-control"
                                        value=""
                                        />
                                    </div>
                                </div>
                            </div>
                                <div class="row mt-4">
                                    <div class="col-md-2"><h5>Photos</h5></div>
                                        <div class="d-flex justify-content-center align-items-center" style="margin-left:20px">
                                            <input type="hidden" class="form-control" name="photo_path[]" id="photoPathInput">
                                            <div id="dropzone-uploads" class="dropzone"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-5 mb-4">
                                    <div class="col-md-10">
                                        <div class="d-flex justify-content-end">
                                            <button type="submit" class="custom-button">Post Ad</button>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
        <script src="https://unpkg.com/dropzone@5/dist/min/dropzone.min.js"></script>
        <script>
          Dropzone.options.dropzoneUploads = {
    url: "upload_photos.php",
    paramName: "photos",
    maxFilesize: 20,
    acceptedFiles: "image/*",
    init: function() {
        this.on("success", function(file, response) {
            const jsonResponse = JSON.parse(response);
            if (jsonResponse.success) {
                for (let i = 0; i < jsonResponse.photo_paths.length; i++) {
                    let inputField = document.createElement("input");
                    inputField.setAttribute("type", "hidden");
                    inputField.setAttribute("value", jsonResponse.photo_paths[i]);
                    document.getElementById("photoPathInput").appendChild(inputField);
                }
            } else {
                console.error(jsonResponse.errors);
            }
        });
    }
};


        </script>

        <?php
require_once 'inc/footer.php';
?>
    