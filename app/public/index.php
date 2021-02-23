<?php
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL,"https://46.24.7.148:8091/lighting/API/v1/ControllersStatus");
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Accept: application/json'));

$headers = [
    'Authorization: Basic dGVzdDpOZDdHZ29DVWV5V1tFamxTQlduTQ=='
];
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

$response=curl_exec($ch);
print_r($response);
echo 'Curl error: ' . curl_error($ch);
$result = json_decode($response, true);
curl_close ($ch);
print_r($result);

?>