<?php

namespace Inkweb\ModuleBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('InkwebModuleBundle:Default:index.html.twig');
    }
}
