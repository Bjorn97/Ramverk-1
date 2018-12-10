<?php
namespace Anax\Controller;

class GeoIP
{
    public function locate($adress)
    {
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_URL =>'http://api.ipstack.com/' . $adress . '?access_key=183d40bcbfff96c2fac75ac3beda5069'
        ));
        $res = curl_exec($curl);
        curl_close($curl);
        
        return $res;
    }
}
