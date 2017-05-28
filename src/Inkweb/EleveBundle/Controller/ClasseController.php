<?php

namespace Inkweb\EleveBundle\Controller;

use Inkweb\EleveBundle\Entity\Classe;
use Inkweb\EleveBundle\Form\ClasseType;
use Inkweb\EleveBundle\Form\ElevesType;
use function Sodium\add;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class ClasseController extends Controller
{
    // Récupère la liste des classes
    public function indexAction(){
        $repository = $this->getDoctrine()
            ->getManager()
            ->getRepository('InkwebEleveBundle:Classe');
        $list_classe = $repository->findAll();
        return $this->render('InkwebEleveBundle:Classe:index.html.twig',array('list_classe' => $list_classe));
    }

    // Attribuer des élèves à une classe
    public function addMassAction(Request $request){
        // Récupération de la liste d'élève
        $repository = $this->getDoctrine()
            ->getManager()
            ->getRepository('InkwebEleveBundle:Eleve');
        $liste_eleve = $repository->findBy(
            array('classe' => null));

        // Création du formulaire d'attribution

        $form = $this->get('form.factory')->create(ElevesType::class,$liste_eleve);

        if ($request->isMethod('POST')&& $form->handleRequest($request)->isValid()){
            $em = $this->getDoctrine()->getManager();
            $em->persist($liste_eleve);
            $em->flush();
            return $this->render('InkwebEleveBundle:Classe:liste_eleve.html.twig',array('liste_eleve' => $liste_eleve));
        }
        return $this->render('InkwebEleveBundle:Classe:liste_eleve.html.twig',array('liste_eleve' => $liste_eleve, 'form' => $form->createView(),
        ));

    }

    public function editAction($id, Request $request){
        $repository = $this->getDoctrine()
            ->getManager()
            ->getRepository('InkwebEleveBundle:Classe');
        $classe = $repository->find($id);


        $form = $this->createForm(new ClasseType(),$classe);
        $form->handleRequest($request);
        $form->handleRequest($request);
        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($classe);
            $em->flush();

            $request->getSession()->getFlashBag()->add('notice', 'Classe bien enregistrée.');
            return $this->redirect($this->generateUrl('inkweb_classe_view', array('id' => $classe->getId())));
        }
        return $this->render('InkwebEleveBundle:Classe:add.html.twig', array(
            'form' => $form->createView(),
        ));

    }
}