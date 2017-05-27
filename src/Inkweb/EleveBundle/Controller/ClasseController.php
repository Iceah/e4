<?php

namespace Inkweb\EleveBundle\Controller;

use Inkweb\EleveBundle\Entity\Classe;
use Inkweb\EleveBundle\Form\ClasseType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
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

    // Ajout de classe
    public function addAction(Request $request){
        $classe = new Classe();
        // Préremplissage avec la date du jour
        $classe->setAnnee(new \DateTime());

        $form = $this->get('form.factory')->create(ClasseType::class,$classe);

        if ($request->isMethod('POST')&& $form->handleRequest($request)->isValid()){
            $em = $this->getDoctrine()->getManager();
            $em->persist($classe);
            $em->flush();

            $request->getSession()->getFlashBag()->add('notice','Classe bien ajoutée');
            return $this->redirect($this->generateUrl('inkweb_classe_homepage'));
        }

        return $this->render('InkwebEleveBundle:Classe:add.html.twig',
            array('form'=> $form->createView()
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

    public function delAction($id) {
        $repository = $this->getDoctrine()
            ->getManager()
            ->getRepository('InkwebEleveBundle:Classe');
        $classe = $repository->find($id);
        if (null === $classe){
            throw new NotFoundHttpException("La classe " . $id. " n'existe pas");
        }
        $em = $this->getDoctrine()->getEntityManager();
        $em->remove($classe);
        $em->flush();
        return  $this->render('InkwebEleveBundle:Classe:index.html.twing');
    }
}