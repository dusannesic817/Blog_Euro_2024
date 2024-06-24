<?php
require_once 'inc/header.php';
require_once 'app/classes/Post.php';
require_once 'app/classes/User.php';
require_once 'app/classes/Visitor.php';
require_once 'app/classes/Comment.php';
require_once 'app/classes/Rating.php';

    $post=new Post();
    $user= new User();
    $visitor= new Visitor();
    $comment= new Comment();
    $rating= new Rating();

    if(isset($_GET['id'])){

        $post_id=$_GET['id'];
        $_SESSION['post_id']=$_GET['id'];

        $show=$post->show($post_id);
        $user_id=$show['user_id'];
        $users=$user->show($user_id);

    }

    if($_SERVER['REQUEST_METHOD']=="POST"){

        if(isset($_SESSION['id'])){
            $user_id=$_SESSION['id'];
            $visitor_id=NULL;
        }else{

            $name = isset($_POST['name']) ? $_POST['name'] : null;
            $email = isset($_POST['email']) ? $_POST['email'] : null;
            $create = $visitor->create($name, $email);

            if($create) {
                $visitor_id = isset($_SESSION['last_insert_visitor']) ? $_SESSION['last_insert_visitor'] : null;
                $user_id = null; 
            }else {
                
                echo "Failed to create visitor.";
                exit();
            }

        }
        $post_id=$_SESSION['post_id'];

        $text = $_POST['comment'];
        $create_comment = $comment->create($user_id, $visitor_id, $post_id, $text);
           
        if($create_comment) {
            header("Location: show_post.php?id=" . $_SESSION['post_id']);

        } 

    }
   
    
    $show_comments=$comment->show($post_id);
    $count=$comment->count($post_id);


   // $ratings=$rating->check($_SESSION['id'],$post_id);



 
?>
    
<div class="container mt-5 mt-5">
    <div class="row">
        <div class="col-md-8" >
            <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
                <div class="carousel-inner">
                  <div class="carousel-item active">
                    <img class="d-block w-100" src="public/images/euro_finalists.jpeg" alt="First slide">
                  </div>
                  <div class="carousel-item">
                    <img class="d-block w-100" src="public/images/euro_finalists.jpeg"  alt="Second slide">
                  </div>
                  <div class="carousel-item">
                    <img class="d-block w-100" src="public/images/euro_finalists.jpeg"  alt="Third slide">
                  </div>
                </div>
                <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                  <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                  <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                  <span class="carousel-control-next-icon" aria-hidden="true"></span>
                  <span class="sr-only">Next</span>
                </a>
            </div>
        </div>
        <div class="col-md-4 profile-card" style=" background-color: #143cda;"> 
            <img src="public/images/mascot.jpg" alt="" class="profile-pic">             
            <div class="mt-5">
                <h5 class="mb-5 text-center"><?php echo $users['first_name']." " . $users['last_name']?></h5>
                <small><?php echo $users['about']?></small>
            </div>
        </div>
    </div>
    <div class="row mt-3">
        <div class="col-md-12">
            <div class="d-flex justify-content-end">
                <?php
                if(isset($_SESSION['id'])== $show['user_id']){
                ?>
                <div><a href="update_post.php?id=<?php echo $post_id?>">Edit <i class="fa-solid fa-pencil fa"></i></a></div>
                <div style="margin-left: 20px;"><a href="delete_post.php?id=<?php echo $post_id?>">Delete <i class="fa-solid fa-trash fa"></i></a></div>
                <?php }?>
                <div></div>
            </div>
        </div>
    </div>
    <div class="row mt-2">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title" style="color:#ffca00;"><?php echo $show['title']?></h5>
                    <p class="card-text"><?php echo $show['text']?></p>
                </div>
              </div>
        </div>       
    </div>
    <div class="row mt-3">
        <div class="col-md-12">
            <div class="d-flex justify-content-end">
               
            <form method="POST" action="rating.php">
                    <div>
                        <input type="hidden" name="mark" value="1">
                        <button type="submit" class="like-button" style="margin-right: 10px;"><i class="fa-regular fa-thumbs-up fa-lg" style="color: #3a76df;"></i>(1)</button>
                    </div>
                </form>
               

                <form method="POST" action="rating.php">
                    <div>
                        <input type="hidden" name="mark" value="0">
                        <button type="submit" class="dislike-button"><i class="fa-regular fa-thumbs-down fa-lg" style="color: red;"></i>(2)</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
    <form action="show_post.php" method="POST">
        <div class="row mt-2">
            <div class="col-md-8">
                <div class="card  border-0">
                    <div class="card-body">
                        <div class="card-title">Leave Comment</div>
                           
                            <textarea 
                            name="comment" 
                            id="description"
                            class="form-control"
                            rows="6"></textarea>
                    </div>
                </div>
            </div>
            <?php if(!isset($_SESSION['id'])) {?>  
            <div class="col-md-4">
                <div class="card  border-0">
                    <div class="card-body">
                        <div class="mt-4">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Email address</label>
                                <input type="email" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
                            
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Full Name</label>
                                <input type="text" name="name" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter Full Name">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php } ?>    
        </div>
        <button type="submit" class=" mt-2 buttons" style="margin-left: 20px;">Leave Comment</button>
    </form>
    <div class="row mt-5">
        <div class="col-md-12">
            <h5 class="mb-2" style="color:#ffca00;">COMMENTS <?php echo $count?></h5>
            <div class="border-bottom"></div>   
            </div>
        </div>
        <div class="row" style="margin-bottom:100px">
       
            <div class="col-10">
            <?php foreach($show_comments as $comment){
                $time=strtotime($comment['created_at']);
                $format_date=date('j M, Y',$time);

                   $_SESSION['comment_id']=$comment['id'];

                ?>
                <div class="card custom-border">
                    <div class="card-body">
                        <div class="card-title">
                            <div class="d-flex justify-content-between">
                                <div>
                                    <?php
                                    if ($comment['visitor_id'] == NULL) {
                                        echo $comment['user_first_name'];
                                    } else {
                                        echo $comment['visitor_name'];
                                    }
                                    ?>
                                </div>
                                <div>
                                    <?php if (isset($_SESSION['id']) == $comment['user_id'] && isset($_SESSION['id'])) { ?>
                                        <div class="d-flex">
                                            <div><a href="javascript:void(0)" id="editLink" data-toggle="modal" data-target="#comModal">Edit <i class="fas fa-pencil-alt"></i></a></div>
                                            <div style="margin-left:10px;"><a href="delete_comment.php?id=<?php echo $comment['id']?>">Delete <i class="fa-solid fa-trash fa"></i></a></div>
                                        </div>
                                    <?php }elseif(!isset($_SESSION['id'])){ ?>
                                        <div class="d-flex">
                                            <div></div>

                                            <div></div>
                                        </div>
                                        <?php }?>
                                </div>
                            </div>
                        </div>
                        <p class="card-text"><?php echo $comment['text']?></p>
                        <small class="card-text"><?php echo $format_date?></small>
                    </div>
                </div> 
                <?php }?>                 
            </div>
        </div>
</div>








<?php
require_once 'inc/footer.php';
//href="edit_comment.php?id=<?php echo $comment['id']
?>
    