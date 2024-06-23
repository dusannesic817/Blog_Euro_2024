<?php
require_once 'inc/header.php';
require_once 'app/classes/Post.php';

   $post=new Post();

   if(isset($_GET['id'])){

        $post_id=$_GET['id'];

        $show=$post->show($post_id);
        

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
                        <form action="update_post.php" method="POST"  enctype="multipart/form-data" >
                        <div class="row mt-5">
                            <div class="col-md-2"><h5>Name</h5></div>
                            <div class="col-md-5">
                                <div class="input-group mb-3">
                                    <input
                                    type="text"
                                    name='title' 
                                    class="form-control"
                                    value="<?php echo $show['title']?>"
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
                                  placeholder="<?php echo $show['text']?>"
                                rows="10"></textarea>                
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
                                      value="<?php echo $show['tag']?>"
                                    />
                                </div>
                            </div>
                        </div>
                        <div class="row mt-4">
                            <div class="col-md-2"><h5>Images</h5></div>
                            <div class="col-md-3">
                                <div class="input-group">
                                    <input 
                                    type="file" 
                                    name="images[]" 
                                    class="form-control"
                                    value="{{old('images[]')}}"
                                    multiple id="postImages" 
                                    aria-describedby="inputGroupFileAddon04" 
                                    aria-label="Upload"
                                    /> 
                                </div>
                            </div>
                            <div class="col-md-5">
                                <div id="slike-preview" class="d-flex flex-row"></div>
                            </div>
                        </div>
                        <div class="row mt-5">
                            <div class="col-md-10">
                                <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                    <button type="submit" class="btn btn-warning ">Post Ad</button>
                    
                                </div>
                            </div>
                        </div>
                    </form>
                    </div>
                    </div>
                  </div>
            </div>
        </div>
        
        <?php require_once 'inc/footer.php'; ?>
    