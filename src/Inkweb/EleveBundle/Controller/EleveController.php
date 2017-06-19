<?php

namespace Inkweb\EleveBundle\Controller;

use Inkweb\EleveBundle\Entity\Eleve;
use Inkweb\EleveBundle\Form\EleveType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class EleveController extends Controller
{

    // Voir le profil d'un étudiant
    public function viewAction($id){
        $repository = $this->getDoctrine()
            ->getManager()
            ->getRepository('InkwebEleveBundle:Eleve');
        $eleve = $repository->find($id);
        // Liste des modules où l'élève est inscrit
        $module_list = $eleve->getClasse()->getModules();

        // Liste des notes
        $notes = $eleve->getNotes();

        // Liste des notes par module
        // [$module1 => 1,2,3,
        // $module2 => 12,4,5]
        $module_notes = array();
        foreach ($module_list as $module){
            $module_notes[$module->getId()] = array(
                'notes'=>$repository->getNotesModule($module->getId(),$id),
                'moyenne'=>$repository->getMoyenneModule($module->getId(),$id),
            ); // return un tableau de notes par module
        }




        if (null === $eleve){
            throw new NotFoundHttpException("L'élève d'id " . $id. " n'existe pas");
        }
        return $this->render(
            'InkwebEleveBundle:Eleve:view.html.twig',
            array('id' => $id, 'eleve' => $eleve,
                'list_notes_module' => $module_notes,
                'modules' => $module_list,
                ) // On passe les variables souhaitées dans le twig via l'array
        );
    }



}
