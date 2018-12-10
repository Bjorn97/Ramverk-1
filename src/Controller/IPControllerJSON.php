<?php

namespace Anax\Controller;

use Anax\Commons\ContainerInjectableInterface;
use Anax\Commons\ContainerInjectableTrait;

class IPControllerJSON implements ContainerInjectableInterface
{
    use ContainerInjectableTrait;

    public function indexAction()
    {
        $res = "";
        $json = [];
        $location = "";
        $bool = 0;
        $adress = $this->di->get("request")->getGet("ip");
        if ($adress != "") {
            if (filter_var($adress, FILTER_VALIDATE_IP)) {
                $res = " is a valid IP address";
                $geo = new GeoIP();
                $location = $geo->locate($adress);
                $location = json_decode($location);
                $bool = 1;
            } else {
                $res = " is not a valid IP address";
                $bool = 0;
            }
        }
        if ($bool == 1) {
            $json = [
                "ip" => $adress,
                "valid" => $res,
                "type" => $location->{'type'},
                "country" => $location->{'country_name'} ,
                "city" => $location->{'city'},
                "longitude" => $location->{'longitude'},
                "latitude" => $location->{'latitude'}
            ];
        } else {
            $json = [
                "ip" => $adress,
                "valid" => $res,
            ];
        }
        return [$json];
    }

    // public function ipController($adress)
    // {
    //
    // }
}
