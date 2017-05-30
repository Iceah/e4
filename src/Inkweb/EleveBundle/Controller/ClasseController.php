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
        // Liste de toutes les classes
        $repository = $this->getDoctrine()
            ->getManager()
            ->getRepository('InkwebEleveBundle:Classe');
        $classes = $repository->findAll();
        return $this->render('InkwebEleveBundle:Classe:index.html.twig',array('list_classe'=>$classes));
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

    public function listclassAction($id){
        // Liste des élèves par classe
        $repository = $this->getDoctrine()->getManager()->getRepository('InkwebEleveBundle:Eleve');
        $liste_eleves_classe = $repository->findBy(
            array('classe' => $id),
            array('nom' => 'desc')
        );
        $repository = $this->getDoctrine()
            ->getManager()
            ->getRepository('InkwebEleveBundle:Classe');
        $classes = $repository->findAll();

        return $this->render('InkwebEleveBundle:Classe:liste_classe.html.twig',
            array(
                'id'=>$id,
                'liste_eleve'=> $liste_eleves_classe,
                'list_classe' => $classes
            ));
    }
}