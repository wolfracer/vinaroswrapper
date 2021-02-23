<?php
require __DIR__ . '/vendor/autoload.php';


use GuzzleHttp\Client;

$url = 'https://46.24.7.148:8091/lighting/API/v1/';
$token = 'dGVzdDpOZDdHZ29DVWV5V1tFamxTQlduTQ==';
$controller = 'CM0001';
$start_date = '2021-01-30T00:00:00%2B01:00';
$end_date = '2021-02-01T00:00:00%2B01:00';


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
            // Base URI is used with relative requests
            'base_uri' => $url,
            // You can set any number of default request options.
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
        //$response=$this->client->request
//TODO: fix url encode.
        $response=$this->client->get($controller.'/Data?from='.$start_date.'&to='.$end_date);
        return $response->getBody();

    }


}
$wrapper = new VinarosAlumbradoWrapper($url, $token);

echo ($wrapper->retrieve_date_range($controller, $start_date, $end_date));



?>