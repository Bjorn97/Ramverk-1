<?php

namespace Anax\Controller;

use Anax\Commons\ContainerInjectableInterface;
use Anax\Commons\ContainerInjectableTrait;

class IPController implements ContainerInjectableInterface
{
    use ContainerInjectableTrait;


    /**
     * The initialize method is optional and will always be called before the
     * target method/action. This is a convienient method where you could
     * setup internal properties that are commonly used by several methods.
     *
     * @return void
     */
    // public function initialize() : void
    // {
    // }



    /**
     * Display the stylechooser with details on current selected style.
     *
     * @return object
     */
    public function indexAction() : object
    {
        $title = "ip-controller";
        
        $page = $this->di->get("page");
        $num = 0;
        $location = "";
        $res = "";
        $default = $_SERVER["REMOTE_ADDR"] ?? '127.0.0.1';
        // $page->add("anax/IPController/", [
        //     "thing" => "goes as var to view",
        // ]);
        
        $adress = $this->di->get("request")->getGet("ip");
        
        if ($adress != "") {
            if (filter_var($adress, FILTER_VALIDATE_IP)) {
                $res = "$adress is a valid IP address";
                $num = 1;
                $geo = new GeoIP();
                $location = $geo->locate($adress);
                $location = json_decode($location);
            } else {
                $res = "$adress is not a valid IP address";
                $num = 0;
            }
        }
        $page->add("anax/ip-controller/index", [
            "res" => $res,
            "adress" => $adress,
            "num" => $num,
            "location" => $location,
            "default" => $default
        ]);
        
        return $page->render([
            "title" => $title,
            "res" => $res,
            "adress" => $adress,
            "num" => $num,
            "location" => $location,
            "default" => $default
        ]);
    }
    // public function ipController($adress)
    // {
    //
    // }
}
