<?php

namespace Anax\Controller;

use Anax\Commons\ContainerInjectableInterface;
use Anax\Commons\ContainerInjectableTrait;

class GeoControllerJson implements ContainerInjectableInterface
{
    use ContainerInjectableTrait;
    
    public function indexAction()
    {

        $keys = $this->di->get("api");
        $location = "";
        $res = "";
        $default = $_SERVER["REMOTE_ADDR"] ?? '127.0.0.1';
        $forcast = "";
        $bool = 2;
        $json = [];
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
                $forcast = $weather->weather($location->{"latitude"}, $location->{"longitude"}, $keys->getKeys("darksky"));
                $bool = 1;
            } else {
                $res = "$adress is not a valid IP address";
                $bool = 0;
            }
        }
        
        if ($bool == 1) {
            for ($i=0; $i < 8; $i++) {
                array_push($json, [
                    "ip" => $adress,
                    "valid" => $res,
                    "summary" => $forcast->{"daily"}->{"data"}[$i]->{"summary"},
                    "high" => " with highest temprature being " . $forcast->{"daily"}->{"data"}[$i]->{"apparentTemperatureHigh"},
                    "low" => " and lowest being " . $forcast->{"daily"}->{"data"}[$i]->{"apparentTemperatureLow"}
                ]);
            }
            
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
