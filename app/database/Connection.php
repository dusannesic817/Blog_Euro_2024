<?php


class Connection{

    private $configuration;

    private $connection;


    public function __construct(Configuration $configuration){
        $this->configuration=$configuration;
    }



    public function getConnection(){
        

        $this->connection= new mysqli(
                $this->configuration->getServerName(),
                $this->configuration->getUsername(),
                $this->configuration->getPassword(),
                $this->configuration->getDatabaseName()
        );

        return $this->connection;


    }
}