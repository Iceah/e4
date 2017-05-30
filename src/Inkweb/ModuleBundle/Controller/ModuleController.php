<?php

namespace Inkweb\ModuleBundle\Controller;

use Inkweb\ModuleBundle\Entity\Cours;
use Inkweb\ModuleBundle\Entity\Evaluation;
use Inkweb\ModuleBundle\Form\CoursType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Inkweb\ModuleBundle\Repository\CoursRepository;
use Symfony\Component\HttpFoundation\Request;

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

        return $this->render('InkwebModuleBundle:Module:view.html.twig',
            array('module'=>$module, 'list_cours' =>$liste_cours));
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
}
