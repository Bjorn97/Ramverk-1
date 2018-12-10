<?php

namespace Anax\Controller;

use Anax\Commons\ContainerInjectableInterface;
use Anax\Commons\ContainerInjectableTrait;

class GeoController implements ContainerInjectableInterface
{
    use ContainerInjectableTrait;
    
    public function indexAction() : object
    {
        $page = $this->di->get("page");
        $keys = $this->di->get("api");
        $location = "";
        $res = "";
        $default = $_SERVER["REMOTE_ADDR"] ?? '127.0.0.1';
        $forcast = "";
        // $page->add("anax/IPController/", [
        //     "thing" => "goes as var to view",
        // ]);

        $adress = $this->di->get("request")->getGet("input");

        if ($adress != "") {
            if (filter_var($adress, FILTER_VALIDATE_IP)) {
                $res = "$adress is a valid IP address";
                $geo = new GeoIP();
                $location = $geo->locate($adress);
                $location = json_decode($location);
                $weather = new GeoWeather();
                $forcast = $weather->weather($location->latitude, $location->longitude, $keys->getKeys("darksky"));
            } else {
                $res = "$adress is not a valid IP address";
                
            }
        }
        $page->add("anax/ip-locator/index", [
            "res" => $res,
            "adress" => $adress,
            "forcast" => $forcast,
            "location" => $location
        ]);

        return $page->render([
            "res" => $res,
            "forcast" => $forcast,
            "adress" => $adress,
            "location" => $location
        ]);
    }
    // public function ipController($adress)
    // {
    //
    // }
}
