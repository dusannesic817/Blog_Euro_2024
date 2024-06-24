<?php

require_once 'app/database/DbConnection.php';
require_once 'app/classes/Post.php';

$post = new Post();



$page = isset($_GET['page']) ? $_GET['page'] : 1;
$perPage = isset($_GET['perPage']) ? $_GET['perPage'] : 4;

$posts = $post->fetch_user_posts( $_SESSION['user_id_page'],$page, $perPage);


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
