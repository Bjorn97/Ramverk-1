<?php  


namespace Anax\apikeys;

use Anax\Commons\ContainerInjectableInterface;
use Anax\Commons\ContainerInjectableTrait;

class apikeys implements ContainerInjectableInterface
{
    use ContainerInjectableTrait;
    
    private $ipstack;
    private $darksky;
    
    public function __construct()
    {
        $config = include(__DIR__ . "/../../config/api_keys.php");
        $this->ipstack = $config["ipstack"];
        $this->darksky = $config["darksky"];
    }
    
    public function getKeys($keyname)
    {
        return $this->$keyname;
    }
}
