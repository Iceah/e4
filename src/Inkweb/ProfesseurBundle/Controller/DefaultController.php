<?php

namespace Inkweb\ProfesseurBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('InkwebProfesseurBundle:Default:index.html.twig');
    }
}
