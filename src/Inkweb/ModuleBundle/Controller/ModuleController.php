<?php

namespace Inkweb\ModuleBundle\Controller;

use Inkweb\ModuleBundle\Entity\Cours;
use Inkweb\ModuleBundle\Entity\Evaluation;
use Inkweb\ModuleBundle\Entity\Module;
use Inkweb\ModuleBundle\Form\CoursType;
use Inkweb\ModuleBundle\Form\EvaluationType;
use Inkweb\ModuleBundle\Form\ModuleEditType;
use Sonata\CoreBundle\Form\Type\CollectionType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Inkweb\ModuleBundle\Repository\CoursRepository;
use Symfony\Component\HttpFoundation\Request;
use Ob\HighchartsBundle\Highcharts\Highchart;
use Symfony\Component\HttpFoundation\JsonResponse;

class ModuleController extends Controller
{
    public function indexAction()
    {
        $repository = $this->getDoctrine()->getManager()->getRepository('InkwebModuleBundle:Module');
        $list_modules = $repository->findAll();

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

/*
        // Chart
        $sellsHistory = array(
            array(
                "name" => "Total des ventes",
                "data" => array(683, 756, 543, 1208, 617, 990, 1001)
            ),
            array(
                "name" => "Ventes en France",
                "data" => array(467, 321, 56, 698, 134, 344, 452)
            ),

        );

        $dates = array(
            "21/06", "22/06", "23/06", "24/06", "25/06", "26/06", "27/06"
        );

        $ob = new Highchart();
        // ID de l'élement de DOM que vous utilisez comme conteneur
        $ob->chart->renderTo('linechart');
        $ob->title->text('Vente du 21/06/2013 au 27/06/2013');

        $ob->yAxis->title(array('text' => "Ventes (milliers d'unité)"));

        $ob->xAxis->title(array('text'  => "Date du jours"));
        $ob->xAxis->categories($dates);

        $ob->series($sellsHistory);*/

        return $this->render('InkwebModuleBundle:Module:view.html.twig',
            array(
                'module'=>$module,
                'list_cours' =>$liste_cours,
                'list_eval' => $liste_eval,
                //'chart' =>$ob,
                ));

    }


    public function viewEvalAction($id){
        $repository = $this->getDoctrine()->getManager()->getRepository('InkwebModuleBundle:Module');
        $module = $repository->find($id);

        $repository = $this->getDoctrine()->getManager()->getRepository('InkwebModuleBundle:Evaluation');
        $list_note = $repository->listNotesModuleDate($module);
        return $this->render('InkwebModuleBundle:Evaluation:view.html.twig',
            array('list_note'=> $list_note));
    }


    public function addCoursAction(Request $request){
        $cours = new Cours();
        $cours->setDate(new \DateTime());

        $form = $this->get('form.factory')->create(CoursType::class,$cours);

        if ($request->isMethod('POST')&& $form->handleRequest($request)->isValid()){
            $em = $this->getDoctrine()->getManager();
            $em->persist($cours);
            $em->flush();

            return $this->render('InkwebModuleBundle:Module:index.html.twig');
        }

        return $this->render('InkwebModuleBundle:Module:addc.html.twig',array('form'=> $form->createView()
        ));
    }

    public function addEvalAction(Request $request){
        $cours = new Evaluation();
        $cours->setDate(new \DateTime());

        $form = $this->get('form.factory')->create(EvaluationType::class,$cours);

        if ($request->isMethod('POST')&& $form->handleRequest($request)->isValid()){
            $em = $this->getDoctrine()->getManager();
            $em->persist($cours);
            $em->flush();

            return $this->render('InkwebModuleBundle:Module:index.html.twig');
        }

        return $this->render('InkwebModuleBundle:Module:addc.html.twig',array('form'=> $form->createView()
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

    public function deleteAction(Request $request, Module $module)
    {
        if (!$this->isCsrfTokenValid(self::DELETE_ARTICLE_TOKEN, $request->headers->get(self::DELETE_ARTICLE_HEADER))) {
            throw $this->createAccessDeniedException();
        }

        $om = $this->getDoctrine()->getManager();
        $om->remove($module);
        $om->flush();

        $this->addFlash('success', 'Module supprimé.');

        return new JsonResponse(['url' => $this->render('InkwebModuleBundle:index.html.twig')]);
    }
}
