<?php


class User{

    protected $connection;

    public function __construct(){
        global $connection;
        $this->connection=$connection;
    }

public function create($first_name, $last_name, $about, $username, $email, $password) {
    $hash_password = password_hash($password, PASSWORD_DEFAULT);

    $sql = "INSERT INTO `users` (first_name, last_name, about, username, email, password)
            VALUES (?, ?, ?, ?, ?, ?)";

    $stmt = $this->connection->getConnection()->prepare($sql);
    $stmt->bind_param("ssssss", $first_name, $last_name, $about, $username, $email, $hash_password);

    $result = $stmt->execute();
  

    if ($result) {
        $last_insert_id = $this->connection->getConnection()->insert_id;
        $_SESSION['last_insert_user'] = $last_insert_id;
        return true; 
    } else {
        return false; 
    }
}



    public function login($username, $password){
        $sql = "SELECT `id`, `password` FROM `users` WHERE `username`=?";
        $stmt = $this->connection->getConnection()->prepare($sql);
        $stmt->bind_param('s', $username);
        $stmt->execute();
    
        $result = $stmt->get_result();

            if($result->num_rows==1){
                $row = $result->fetch_assoc();
                $_SESSION['id'] = $row['id'];

                if(password_verify($password,$row['password'])){              
                    return true;
                }
            }

            return false;
    }


    public function show($id){

        $sql="SELECT `id`, `first_name`, `last_name`,`about`,`photo_path` FROM  `users` WHERE `id`=? ";

        $stmt = $this->connection->getConnection()->prepare($sql);
        $stmt->bind_param('i', $id);
        $stmt->execute();

        $result = $stmt->get_result();

            if($result->num_rows==1){
                return $result->fetch_assoc();         
            }

            return false;
    }

    public function update($first_name,$last_name,$about,$photo_path,$id){
        $sql="UPDATE `users` SET `first_name`=?, `last_name`=?, `about`=?, `photo_path`=? WHERE `id`=?";
        $stmt=$this->connection->getConnection()->prepare($sql);
        $stmt->bind_param("ssssi",$first_name,$last_name,$about,$photo_path,$id);
        return $stmt->execute();
    }

    public function delete($id){
        $sql="DELETE FROM `users` WHERE `id`=?";

        $stmt=$this->connection->getConnection()->prepare($sql);

        $stmt->bind_param("i", $id);
        $stmt->execute();
    }

    public function logOut(){
        unset($_SESSION["id"]);
    }

}