<?php



class ApiConnection{


    public $configuration;
    public $curl;



    public function __construct(ApiConfiguration $configuration, $curl){

        $this->configuration=$configuration;
        $this->curl=$curl;

    }


    public function request(){
        curl_setopt_array($this->curl, [
            CURLOPT_URL => $this->configuration->getUrl(),
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => $this->configuration->getMethod(),
            CURLOPT_HTTPHEADER => [
                $this->configuration->getHost(),
                $this->configuration->getKey()
            ],
        ]);

        $response = curl_exec($this->curl);

        return $response;
    }

}