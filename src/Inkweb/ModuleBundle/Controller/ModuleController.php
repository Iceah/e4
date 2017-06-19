<?php

namespace Inkweb\ModuleBundle\Controller;

use Inkweb\ModuleBundle\Entity\Cours;
use Inkweb\ModuleBundle\Entity\Evaluation;
use Inkweb\ModuleBundle\Entity\Module;
use Inkweb\ModuleBundle\Entity\Note;
use Inkweb\ModuleBundle\Form\CoursType;
use Inkweb\ModuleBundle\Form\EvaluationType;
use Inkweb\ModuleBundle\Form\ModuleEditType;
use function PHPSTORM_META\type;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;

class ModuleController extends Controller
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





        return $this->render('InkwebModuleBundle:Module:index.html.twig', array('list_module' => $list_modules));
    }
    public function viewAction($id){
        // ID = Module en cours
        // Information sur le module en cours
        $repository = $this->getDoctrine()->getManager()->getRepository('InkwebModuleBundle:Module');
        $module = $repository->find($id);

        // Liste des cours
        $repository = $this->getDoctrine()->getManager()
            ->getRepository('InkwebModuleBundle:Cours');
        $liste_cours = $repository->listCours($module);

        // Liste des évaluations
        $repository = $this->getDoctrine()->getManager()->getRepository('InkwebModuleBundle:Evaluation');
        $liste_eval = $repository->findBy(array('module'=> $id));


        return $this->render('InkwebModuleBundle:Module:view.html.twig',
            array(
                'module'=>$module,
                'list_cours' =>$liste_cours,
                'list_eval' => $liste_eval,
                ));

    }


    public function viewEvalAction($id){

        // Afficher pour une évaluation la liste des notes
        $repository = $this->getDoctrine()->getManager()->getRepository('InkwebModuleBundle:Note');
        $liste_notes = $repository->findBy(array('evaluation'=> $id));

        return $this->render('InkwebModuleBundle:Module:vieweval.html.twig',
            array('list_note'=> $liste_notes));
    }


    public function addCoursAction(Request $request){
        $cours = new Cours();
        $cours->setDate(new \DateTime());

        $form = $this->get('form.factory')->create(CoursType::class,$cours);

        if ($request->isMethod('POST')&& $form->handleRequest($request)->isValid()){
            $em = $this->getDoctrine()->getManager();
            $em->persist($cours);
            $em->flush();

            return $this->redirectToRoute('inkweb_module_homepage');
        }

        return $this->render('InkwebModuleBundle:Module:addc.html.twig',array('form'=> $form->createView()
        ));
    }

    public function addEvalAction($id,Request $request){
        $repository = $this->getDoctrine()->getManager()->getRepository('InkwebModuleBundle:Module');
        $module = $repository->find($id);
        $module_id = $module->getId();

        // Liste des élèves
        $repository = $this->getDoctrine()->getManager()->getRepository('InkwebModuleBundle:Evaluation');
        $liste_eleve = $repository->listEleveModule($module_id);

        // Tableau d'entité notes

        $evaluation = new Evaluation();
        $em = $this->getDoctrine()->getManager();
        foreach ($liste_eleve as $eleve){
            // Creation de la note
            $note = new Note();
            // Attribution de l'eleve
            $note->setEleve($eleve);
            $em->persist($note);
            // Attribution de la note à l'evaluation
            $evaluation->addNote($note);
        }
        // Attribution du module TODO
        $evaluation->setModule($module);
        $evaluation->setDate(new \DateTime());

        $form = $this->get('form.factory')->create(EvaluationType::class,$evaluation);


        if ($request->isMethod('POST')&& $form->handleRequest($request)->isValid()){
           $em->persist($evaluation);

            $em->flush();


            return $this->redirectToRoute('inkweb_module_homepage');
        }

        return $this->render('InkwebModuleBundle:Module:addev.html.twig',array(
            'eleves'=>$liste_eleve,
            'form'=> $form->createView()
        ));

    }

    public function editAction($id, Request $request){
        // Récupération du module correspondant pour édition
        $repository = $this->getDoctrine()->getManager()->getRepository('InkwebModuleBundle:Module');
        $module = $repository->find($id);
        // Créattion du formulaire d'édition
        $form = $this->get('form.factory')->create(ModuleEditType::class,$module);

        if ($request->isMethod('POST')&&$form->handleRequest($request)->isValid()){
            $em = $this->getDoctrine()->getManager();
            $em->persist($module);
            $em->flush();

            $repository = $this->getDoctrine()->getManager()->getRepository('InkwebModuleBundle:Module');
            $list_modules = $repository->findAll();

            return $this->render('InkwebModuleBundle:Module:index.html.twig', array('list_module' => $list_modules));
        }
        return $this->render('InkwebModuleBundle:Module:edit.html.twig',array(
            'form'=>$form->createView(),
            ));
    }

    public function delEvalAction(Request $request, Evaluation $evaluation)
    {


        $om = $this->getDoctrine()->getManager();
        $om->remove($evaluation);
        $om->flush();

        $this->addFlash('success', 'Evaluation supprimée.');

        return $this->redirectToRoute('inkweb_module_homepage');
    }

    public function delCoursAction(Request $request, Cours $cours)
    {


        $om = $this->getDoctrine()->getManager();
        $om->remove($cours);
        $om->flush();

        $this->addFlash('success', 'Cours supprimé.');

        return $this->redirectToRoute('inkweb_module_homepage');
    }
}
