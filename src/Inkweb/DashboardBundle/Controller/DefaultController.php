<?php

namespace Inkweb\DashboardBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('InkwebDashboardBundle:Default:index.html.twig');
    }
}
