<?php

namespace Vinaros;
require __DIR__ . '/vendor/autoload.php';


use GuzzleHttp\Client;


function validate_url($url)
{
    if (!preg_match("/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i",$url)) {
        return false;
      }
      return true;

}


class VinarosAlumbradoWrapper{
    public $url;
    public $token;
    public $client;



    function __construct($url, $token)
    {
        if (!validate_url($url)){
            throw new Exception("Please enter a valid API url");

        }
        $this->url=$url;
        $this->token=$token;
        $this->client=new Client([
            'base_uri' => $url,
            'headers' => ['Authorization' => 'Basic '.$token],
            'verify' => false
        ]);

    }

    public function list(){
        $response=$this->client->get('ControllersStatus');
        return $response->getBody();

    }

    public function retrieve($controller){
        $response=$this->client->get($controller.'/ControllerStatus');
        return $response->getBody();


    }

    public function retrieve_date_range($controller, $start_date, $end_date){
        $response=$this->client->get($controller.'/Data?from='.$start_date.'&to='.$end_date);
        return $response->getBody();

    }


}
?>