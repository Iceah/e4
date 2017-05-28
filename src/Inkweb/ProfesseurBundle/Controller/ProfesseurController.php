<?php
/**
 * Created by PhpStorm.
 * User: arden
 * Date: 26/05/2017
 * Time: 14:14
 */

namespace Inkweb\ProfesseurBundle\Controller;


use ProfesseurBundle\Entity\Professeur;
use ProfesseurBundle\Form\ProfesseurType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class ProfesseurController extends Controller
{
    // Liste des professeurs
    public function indexAction() {
        $repository = $this->getDoctrine()
            ->getManager()
            ->getRepository('Inkweb\ProfesseurBundle:Professeur');
        $list_prof = $repository->findAll();
        return $this->render('Inkweb\ProfesseurBundle:Professeur:index.html.twig',array('list_prof' => $list_prof));
    }
}