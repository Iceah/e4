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
    public function viewAction(){
        $repository = $this->getDoctrine()
            ->getManager()
            ->getRepository('InkwebProfesseurBundle:Professeur');
        $user = $this->getUser();
        $prof = $repository->find($user->getId());
        return $this->render('InkwebUserBundle:Profile:show.html.twig',
            array('prof'=>$prof));
    }
}