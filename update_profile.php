

<?php
require_once 'inc/header.php';
require_once 'app/classes/User.php';
require_once 'app/classes/Post.php';


    $user=new User();
   

    if(isset($_GET['id'])){
        $id=$_GET['id'];
        $show=$user->show($id);
     
    }

    if($_SERVER['REQUEST_METHOD']=="POST"){
        $first_name=$_POST['first_name'];
        $last_name=$_POST['last_name'];
        $about=$_POST['about'];
        $photo=$_POST['photo_path'];

        
        

        $update=$user->update($first_name,$last_name,$about,$photo,$_SESSION['id']);
        
       
            $_SESSION['update_profile']='Successfully changed!';
            header("Location: show_profile.php?id=".$_SESSION['id']);
        
        
    }


?>

    <div class="container mb-5" style="margin-top: 150px;">
        <div class="row">
            <div class="col-md-12 text-right">
                <a href="delete_user.php?id=<?php echo $show['id']?>">Delete Profile</a>
            </div>
        </div>
        <div class="row">
            <div class="col-md-3 profile-card mb-5" style=" background-color: #143cda; color: white;">
                <div class="text-center" >
                   <?php if ($show['photo_path']==NULL){?>
                    <img src="public/images/mascot.jpg" alt="" class="profile-pic">
                    <?php }else{?>
                    <img src="public/images/<?php echo $show['photo_path']?>" alt="" class="profile-pic">
                    <?php }?>
                </div>
            </div>
            <div class="col-md-8 mt-4" style="margin-left: 40px">
                
            <form action="update_profile.php" method="POST" enctype="multipart/form-data">
                <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">First Name</label>
                    <div class="col-sm-10">
                    <input 
                          id="first_name" 
                          type="text" 
                          class="form-control" 
                         
                          name="first_name" 
                          value='<?php echo $show['first_name']?>'
                          >
                    </div>
                </div>
                <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Last Name</label>
                    <div class="col-sm-10">
                    <input 
                          id="last_name" 
                          type="text" 
                          class="form-control" 
                         
                          name="last_name" 
                          value='<?php echo $show['last_name']?>'
                          >
                    </div>
                </div>
                <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">About</label>
                    <div class="col-sm-10">
                    <textarea 
                    class="form-control" 
                    id="about" 
                    name="about" 
                    
                    placeholder="<?php echo $show['about']?>" 
                    rows="5"></textarea>
                    </div>
                </div>
                <div class="form-group row">   
                <label for="inputEmail3" class="col-sm-2 col-form-label">Photo</label>
                <div style="margin-left:15px">
                    <input type="hidden" class="form-control" name= "photo_path" id="photoPathInput">
                    <div id="dropzone-upload" class="dropzone"></div>
                    </div>
                </div>       
                    <div class="d-flex">
                        <div class="p-2"><i class="fa-brands fa-facebook fa-2xl"></i></div>
                        <div class="p-2"><i class="fa-brands fa-square-instagram fa-2xl" style="color: #ae1392;"></i></div>
                        <div class="p-2"><i class="fa-brands fa-youtube fa-2xl" style="color: #ff0000;"></i></div>
                        <div class="p-2"><i class="fa-brands fa-x-twitter fa-2xl" style="color: #1c1c1c;"></i></div>
                    </div>
                    <div class="row mt-5">
                        <div class="col-md-10">
                            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                <button type="submit" class="btn btn-warning ">Update</button>                       
                            </div>
                        </div>
                    </div>
            </form>


            </div>    
        </div>
    
    </div>
    <script src="https://unpkg.com/dropzone@5/dist/min/dropzone.min.js"></script>
    <script>
        Dropzone.options.dropzoneUpload={
            url: "upload_photo.php",
            paramName: "photo",
            maxFilesize: 20,
            acceptedFiles: "image/*",
            init:function(){
                this.on("success", function(file, response){
                    const jsonResponse = JSON.parse(response);
                    if(jsonResponse.success){
                        document.getElementById("photoPathInput").value =jsonResponse.photo_path;
                    }else{
                        console.error(jsonResponse.error);
                    }
                });
            }
        };
    </script>


<?php require_once 'inc/footer.php'; ?>