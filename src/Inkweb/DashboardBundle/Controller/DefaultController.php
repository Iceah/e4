<?php

namespace Inkweb\DashboardBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        $prof = $this->getUser();
        $repository = $this->getDoctrine()->getManager()->getRepository('InkwebModuleBundle:Module');

        // Affiche les modules enseignés par le professeur
        $list_modules = $repository->findBy(array('professeur' => $prof));

        // Si admin, affiche tout les modules
        if ($this->isGranted('ROLE_ADMIN')) {
            $list_modules = $repository->findAll();
        }

        return $this->render('InkwebDashboardBundle:Default:index.html.twig',array('list_module' => $list_modules));
    }
}
