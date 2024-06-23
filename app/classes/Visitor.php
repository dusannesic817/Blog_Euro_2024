<?php



class Visitor{

    protected $connection;

    public function __construct(){
        global $connection;
        $this->connection=$connection;
    }


    public function create($name,$email){

        $sql="INSERT INTO `visitors` (`name`, `email`)
        VALUES(?,?)";

    $stmt=$this->connection->getConnection()->prepare($sql);
    $stmt->bind_param("ss",$name,$email);

        $result=$stmt->execute();

        if ($result) {
            $last_insert_visitor = $stmt->insert_id;
             $_SESSION['last_insert_visitor'] = $last_insert_visitor;
            return true; 
        } else {
            return false; 
        }
    }

}
