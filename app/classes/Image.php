<?php


class Image{

    protected $connection;


    public function __construct(){
        global $connection;
        $this->connection=$connection;
    }

    public function create($user_id,$post_id,$image_path){

        $sql="INSERT INTO `images` (`user_id`, `post_id`,`image_path`)
            VALUES(?,?,?)
        ";

        $stmt=$this->connection->getConnection()->prepare($sql);
        $stmt->bind_param("iis",$user_id,$post_id,$image_path);

        if ($stmt->execute()) {
            return true;
        } 
    }


}
