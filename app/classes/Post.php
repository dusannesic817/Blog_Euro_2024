<?php


class Post{

    protected $connection;


    public function __construct(){
        global $connection;
        $this->connection=$connection;
    }


    public function create($user_id,$title,$text,$tag){

        $sql="INSERT INTO `posts` (`user_id`, `title`,`text`,`tag`)
            VALUES(?,?,?,?)
        ";

        $stmt=$this->connection->getConnection()->prepare($sql);
        $stmt->bind_param("isss",$user_id,$title,$text,$tag);

       $result= $stmt->execute();

        if ($result) {
            $last_insert_id = $stmt->insert_id;
            $_SESSION['last_insert_post'] = $last_insert_id;
            return true;
        }
        
    }


    public function show($id){
        $sql="SELECT * FROM posts WHERE id = ?";
        $stmt = $this->connection->getConnection()->prepare($sql);
        $stmt->bind_param('i', $id);
        $stmt->execute();
        $stmt->execute();

        $result = $stmt->get_result();

        if($result->num_rows>0){

            return $result->fetch_assoc();
        }

}

    public function update($id){
        $sql="UPDATE `posts` SET `title`=?, `text`=?, `tag`=? WHERE `id`=?";
        $stmt=$this->connection->getConnection()->prepare($sql);
        $stmt->bind_param("i",$id);
        $stmt->execute();
    }

    public function delete($id){
        $sql="DELETE FROM `posts` WHERE id`=?";

        $stmt=$this->connection->getConnection()->prepare($sql);

        $stmt->bind_param("i", $id);
        $stmt->execute();
    }


    public function fetch_user_posts($id){
        $sql='SELECT 
                posts.id,
                posts.user_id as user_id,
                posts.title,
                posts.created_at,
                posts.text,
                (SELECT image_path FROM images WHERE post_id = posts.id LIMIT 1) as img,
                users.first_name as name,
                users.last_name as surname,
                SUM(CASE WHEN ratings.mark = 1 THEN 1 ELSE 0 END) as count_mark_1,
                SUM(CASE WHEN ratings.mark = 0 THEN 1 ELSE 0 END) as count_mark_0
            FROM 
                posts
            LEFT JOIN 
                users ON posts.user_id = users.id
            LEFT JOIN 
                ratings ON posts.id = ratings.post_id
            WHERE 
                posts.user_id = ?
            GROUP BY
                posts.id
            ';

        $stmt = $this->connection->getConnection()->prepare($sql);
        $stmt->bind_param('i', $id);
        $stmt->execute();

        $result = $stmt->get_result();


        if ($result->num_rows > 0) {

            $posts = $result->fetch_all(MYSQLI_ASSOC);

            return $posts;
        } else {
                
            return [];
        }


    }

}
