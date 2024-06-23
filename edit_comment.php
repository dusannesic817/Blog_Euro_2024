<?php

     require_once 'app/database/DbConnection.php';
     require_once 'app/classes/Comment.php';

    $comment=new Comment();

    if($_SERVER['REQUEST_METHOD']=='POST'){

        $text=$_POST['text'];
        $user_id=$_SESSION['id'];
        $comment_id=$_SESSION['comment_id'];

        $update=$comment->update($text,$user_id,$comment_id);

        header("Location: show_post.php?id=" . $_SESSION['post_id']);
    }


?>

<div class="modal fade" id="comModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Comment</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="edit_comment.php" method="POST">
            <div class="modal-body">
            <textarea class="form-control" name="text" id="editCommentText"  rows="3"></textarea>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save changes</button>
            </div>
        </div>
        </form>
    </div>
</div>

