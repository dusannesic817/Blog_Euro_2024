<?php


class Home{

    protected $connection;

    public function __construct(){
        global $connection;
        $this->connection=$connection;
    }

  
    public function index($page = 1, $perPage = 6) {
        
        $offset = ($page - 1) * $perPage;
    
        $sql = "SELECT 
                    posts.id,
                    posts.user_id as user_id,
                    posts.title,
                    posts.created_at,
                    posts.text,
                    images.image_path as images,
                    (SELECT image_path FROM images WHERE post_id = posts.id LIMIT 1) as img,
                    users.first_name as name,
                    users.last_name as surname,
                    SUM(CASE WHEN ratings.mark = 1 THEN 1 ELSE 0 END) as count_mark_1,
                    SUM(CASE WHEN ratings.mark = 0 THEN 1 ELSE 0 END) as count_mark_0
                FROM 
                    posts
                LEFT JOIN users ON posts.user_id = users.id
                LEFT JOIN ratings ON posts.id = ratings.post_id
                LEFT JOIN images ON posts.id = images.post_id
                GROUP BY
                    posts.id
                ORDER BY
                    posts.created_at DESC
                LIMIT ?, ?";
    
        $stmt = $this->connection->getConnection()->prepare($sql);
        $stmt->bind_param("ii", $offset, $perPage);
        $stmt->execute();
        $result = $stmt->get_result();
    
        if($result->num_rows>0){

            return $result->fetch_all(MYSQLI_ASSOC);
        } else {
       
        return [];
    }
    }
    
}
