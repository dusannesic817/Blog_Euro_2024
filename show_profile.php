

<?php
require_once 'inc/header.php';
require_once 'app/classes/User.php';
require_once 'app/classes/Post.php';


    $user=new User();
    $post=new Post();

    if(isset($_GET['id'])){
        $id=$_GET['id'];

       $show=$user->show($id);

    }

    $posts=$post->fetch_user_posts($id);

   

    foreach($posts as $post){
        $user_id=$post['user_id'];
    }
    $_SESSION['show_id']=$show['id'];

?>
        
    <div class="container mb-5" style="margin-top: 150px;">
        <div class="row">
            <div class="col-md-3 profile-card" style=" background-color: #143cda; color: white;">
                <div class="text-center">
                    <?php if ($show['photo_path']==NULL){?>
                    <img src="public/images/mascot.jpg" alt="" class="profile-pic">
                    <?php }else{?>
                    <img src="public/images/<?php echo $show['photo_path']?>" alt="" class="profile-pic">
                    <?php }?>
                </div>
            </div>
            <div class="col-md-6">
            <div class="d-flex flex-row justify-content-between">
                <div class="p-2">
                    <h5><?php echo $show['first_name']." ". $show['last_name']?></h5>
                </div>
                <?php if(isset($_SESSION['id']) && $_SESSION['show_id']){
                    if($_SESSION['id'] == $_SESSION['show_id']){
                    ?>
                    
                <div class="p-2">
                    <div><a href="update_profile.php?id=<?php echo $id?>">Edit</a></div>
                </div>
                <?php }elseif(!isset($_SESSION['id'])){ ?>
                    <div class="p-2">
                    <div></div>
                </div>
                    <?php }
                    }
                    ?>
            </div>
                    <p class="p-2"><?php echo $show['about']?></p>
                    <div class="d-flex">
                    <div class="p-2"><i class="fa-brands fa-facebook fa-2xl"></i></div>
                    <div class="p-2"><i class="fa-brands fa-square-instagram fa-2xl" style="color: #ae1392;"></i></div>
                    <div class="p-2"><i class="fa-brands fa-youtube fa-2xl" style="color: #ff0000;"></i></div>
                    <div class="p-2"><i class="fa-brands fa-x-twitter fa-2xl" style="color: #1c1c1c;"></i></div>
                  </div>
            </div>    
        </div>
            <div class="border-bottom mt-5"></div>
        <div class="row mt-5">
            <div class="col-md-12" style="text-align: center;">
                <h4>Posts By <?php echo $show['first_name']." ". $show['last_name'] ?></h4>
            </div>
        </div>
        <div class="row mt-5 justify-content-center">
            <?php
                foreach($posts as $value){
                    $time=strtotime($value['created_at']);
                    $format_date=date('j M, Y',$time);                
            ?>
            <div class="col-12 col-md-6 mb-3">
                <div class="card h-100">
                    <div class="card-header bg-transparent">
                        <small><?php echo $format_date ?> | </small>
                        <small>By <?php echo $value['name']." " . $value['surname']?></small>
                    </div>
                    <?php
                        if($value['img']==NULL){             
                        ?>
                        <img class="card-img-top" src="public/images/euro_finalists.jpeg" alt="Card image cap">
                        <?php
                        }else{
                        ?>
                        <img class="card-img-top" src="public/images/<?php echo $value['img']?>" alt="Card image cap">
                        <?php }?>
                    <div class="card-body">
                        <h5 class="card-text"><?php echo $value['title']?></h5>
                        <p id="card-text" class="card-text short-text"> <?php echo $value['text']?></p>
                        <div><a href="show_post.php?id=<?php echo $value['id']?>" class="btn btn-link" style="text-decoration: none;">READ MORE</a></div>
                    </div>
                    <div class="card-footer bg-transparent d-flex align-items-end justify-content-end">
                        <small style="margin-right: 0.5rem;">Like(<?php echo $value['count_mark_1']?>)</small>
                        <small> Dislike (<?php echo $value['count_mark_0']?>)</small>
                    </div>
                </div>
            </div>
              <?php }?>
        </div>      
    </div>

<?php
require_once 'inc/footer.php';
?>