<?php

namespace Anax\Controller;

use Anax\DI\DIFactoryConfig;
use PHPUnit\Framework\TestCase;

/**
 * Test the SampleController.
 */
class IPControllerJSONTest extends TestCase
{
    protected function setUp()
    {
        global $di;

        // Setup di
        $this->di = new DIFactoryConfig();
        $this->di->loadServices(ANAX_INSTALL_PATH . "/config/di");

        // View helpers uses the global $di so it needs its value
        $di = $this->di;
        
        // Setup the controller
        $this->controller = new IPControllerJSON();
        $this->controller->setDI($this->di);
        //$this->controller->initialize();
    }

    public function testIndexActionSuccess()
    {
        
        
        $_GET["ip"] = "1.1.1.1";
        $res = $this->controller->indexAction()[0];
        //$this->assertContains("1.1.1.1 is a valid IP address", $res);

        //$this->assertInstanceOf("\Anax\Response\Response", $res);

        //$body = $res->getBody();
        $exp = " is a valid IP address";
        $this->assertContains($exp, $res["valid"]);
    }
    
    public function testIndexActionFail()
    {
        $_GET["ip"] = "1.1.1";
        $res = $this->controller->indexAction()[0];
        //$this->assertContains("1.1.1.1 is a valid IP address", $res);

        //$this->assertInstanceOf("\Anax\Response\Response", $res);

        //$body = $res->getBody();
        $exp = " is not a valid IP address";
        $this->assertContains($exp, $res["valid"]);
    }
}
