<?php
/**
 * Created by PhpStorm.
 * User: arden
 * Date: 27/05/2017
 * Time: 22:14
 */

namespace Inkweb\ModuleBundle\Admin;


use Inkweb\ModuleBundle\Entity\Module;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;

class ModuleAdmin extends AbstractAdmin
{
    protected function configureFormFields(FormMapper $formMapper){
        // Liste des champs disponibles dans le formulaire d'édition
        $formMapper
            ->add('nomMat','text')
            ->add('professeur','sonata_type_model',array(
                'class' => 'Inkweb\ProfesseurBundle\Entity\Professeur',
                'property' => 'nom'
            ))
            ->add('ue','sonata_type_model',array(
                'class' => 'Inkweb\ModuleBundle\Entity\UE',
                'property' => 'nomue'
            ))
            ->add('codeMat','text')
            ->add('coefMat','number')
            ->add('dateDebut','date')
            ->add('dateFin','date')
        ;
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper){
        // Liste des filtres disponibles dans la vue en liste
        $datagridMapper
            ->add('nomMat')
            ->add('professeur',null,array(),'entity',array(
                'class' => 'Inkweb\ProfesseurBundle\Entity\Professeur',
                'choice_label' => 'nom',
            ))
            ->add('ue',null,array(),'entity',array(
                'class' => 'Inkweb\ModuleBundle\Entity\UE',
                'choice_label' => 'nomue',
            ))
            ->add('dateDebut')
            ->add('dateFin')
        ;
    }

    protected function configureListFields(ListMapper $listMapper){
        // Liste des champs disponibles dans le formulaire en liste
        $listMapper
            ->addIdentifier('nomMat')
            ->add('professeur',null,array(),'entity',array(
                'class' => 'Inkweb\ProfesseurBundle\Entity\Professeur',
                'choice_label' => 'nom',
            ))
            ->add('coef')
            ->add('codeMat','text')
            ->add('coefMat','number')
            ->add('dateDebut','date')
            ->add('dateFin','date')
        ;


    }

    public function toString($object)
    {
        return "module";
    }


}