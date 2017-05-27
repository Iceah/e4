<?php

namespace Inkweb\EleveBundle\Controller;

use Inkweb\EleveBundle\Entity\Eleve;
use Inkweb\EleveBundle\Form\EleveType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class EleveController extends Controller
{
    // Liste des étudiants
    public function indexAction() {
        $repository = $this->getDoctrine()
            ->getManager()
            ->getRepository('InkwebEleveBundle:Eleve');
        $list_eleve = $repository->findAll();
        return $this->render('InkwebEleveBundle:Eleve:index.html.twig',array('list_eleve' => $list_eleve));
    }
    // Ajout d'étudiants
    public function addAction(Request $request){

        // Création de l'entité
        $eleve = new Eleve();
        $form = $this->get('form.factory')->create(EleveType::class,$eleve);

        if ($request->isMethod('POST')&& $form->handleRequest($request)->isValid()) {
            // On l'enregistre notre objet $advert dans la base de données, par exemple
            $em = $this->getDoctrine()->getManager();
            $em->persist($eleve);
            $em->flush();

            $request->getSession()->getFlashBag()->add('notice', 'Elève bien enregistrée.');

            // On redirige vers la page de visualisation de l'annonce nouvellement créée
            return $this->redirect($this->generateUrl('inkweb_eleve_view', array('id' => $eleve->getId())));
        }

        // À ce stade, le formulaire n'est pas valide car :
        // - Soit la requête est de type GET, donc le visiteur vient d'arriver sur la page et veut voir le formulaire
        // - Soit la requête est de type POST, mais le formulaire contient des valeurs invalides, donc on l'affiche de nouveau
        return $this->render('InkwebEleveBundle:Eleve:add.html.twig', array(
            'form' => $form->createView(),
        ));
    }
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

    // Effacer un étudiant
    public function delAction($id) {
        $repository = $this->getDoctrine()
            ->getManager()
            ->getRepository('InkwebEleveBundle:Eleve');
        $eleve = $repository->find($id);
        if (null === $eleve){
            throw new NotFoundHttpException("L'élève d'id " . $id. " n'existe pas");
        }
        $em = $this->getDoctrine()->getEntityManager();
        $em->remove($eleve);
        $em->flush();
        return  $this->render('InkwebEleveBundle:Eleve:index.html.twing');
    }

    // Voir le profil d'un étudiant
    public function viewAction($id){
        $repository = $this->getDoctrine()
            ->getManager()
            ->getRepository('InkwebEleveBundle:Eleve');
        $eleve = $repository->find($id);
        if (null === $eleve){
            throw new NotFoundHttpException("L'élève d'id " . $id. " n'existe pas");
        }
        return $this->render(
            'InkwebEleveBundle:Eleve:view.html.twig',
            array('id' => $id, 'eleve' => $eleve) // On passe les variables souhaitées dans le twig via l'array
        );
    }



}
