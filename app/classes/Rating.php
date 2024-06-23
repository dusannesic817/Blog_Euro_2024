<?php

class Rating{

    protected $connection;


    public function __construct(){
        global $connection;
        $this->connection=$connection;
    }


    public function create($user_id,$post_id,$mark){

        $mark = $mark ? 1 : 0;
        $sql="INSERT INTO `ratings` (`user_id`, `post_id`,`mark`)
        VALUES(?,?,?)";

        $stmt=$this->connection->getConnection()->prepare($sql);
        $stmt->bind_param("iii",$user_id,$post_id,$mark);

        return $stmt->execute();
        
    }


    public function check($user_id, $post_id) {

        $sql = 'SELECT * FROM `ratings` WHERE user_id=? AND post_id=?';
        $stmt = $this->connection->getConnection()->prepare($sql);
        $stmt->bind_param("ii", $user_id, $post_id); 
        $stmt->execute();

        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            return $result->fetch_all(MYSQLI_ASSOC);
        } else {
            return false;
        }
    }
    
}