<?php

namespace Inkweb\EleveBundle\Controller;

use Inkweb\EleveBundle\Entity\Eleve;
use Inkweb\EleveBundle\Form\EleveType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class EleveController extends Controller
{
    // Modifier un étudiant
    public function editAction($id, Request $request){
        /*
        $repository = $this->getDoctrine()
            ->getManager()
            ->getRepository('InkwebEleveBundle:Eleve');
        $eleve = $repository->find($id);

        $form = $this->createForm(new EleveType(),$eleve);

        $form->handleRequest($request);
        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($eleve);
            $em->flush();

            $request->getSession()->getFlashBag()->add('notice', 'Elève bien enregistrée.');
            return $this->redirect($this->generateUrl('inkweb_eleve_view', array('id' => $eleve->getId())));
        }
        return $this->render('InkwebEleveBundle:Eleve:add.html.twig', array(
            'form' => $form->createView(),
        ));
*/
    }

    // Voir le profil d'un étudiant
    public function viewAction($id){
        $repository = $this->getDoctrine()
            ->getManager()
            ->getRepository('InkwebEleveBundle:Eleve');
        $eleve = $repository->find($id);

        // Liste de toutes les classes
        $repository = $this->getDoctrine()
            ->getManager()
            ->getRepository('InkwebEleveBundle:Classe');
        $classes = $repository->findAll();
        if (null === $eleve){
            throw new NotFoundHttpException("L'élève d'id " . $id. " n'existe pas");
        }
        return $this->render(
            'InkwebEleveBundle:Eleve:view.html.twig',
            array('id' => $id, 'eleve' => $eleve,
                'list_classe' => $classes
                ) // On passe les variables souhaitées dans le twig via l'array
        );
    }



}
