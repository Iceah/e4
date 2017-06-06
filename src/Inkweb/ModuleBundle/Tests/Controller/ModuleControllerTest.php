<?php
namespace Inkweb\ModuleBundle\Tests\Controller;

use Inkweb\ModuleBundle\Entity\Module;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ModuleControllerTest extends WebTestCase
{
    public function testIndex()
    {
       $module = new Module();
       $result = $module->add(10,'1546','Maths','2');

       $this->assertEquals(10);
    }
}