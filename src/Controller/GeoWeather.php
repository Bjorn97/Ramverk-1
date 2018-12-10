<?php
namespace Anax\Controller;

class GeoWeather
{
    public function weather($lattitude, $longitude, $key)
    {
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_URL => 'https://api.darksky.net/forecast/' . $key . "/" . $lattitude . "," . $longitude . '?exclude=currently,minutely,hourly,alerts,flags'
        ));
        $res = curl_exec($curl);
        curl_close($curl);
        
        return json_decode($res);
    }
}
