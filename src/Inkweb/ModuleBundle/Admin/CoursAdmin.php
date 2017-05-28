<?php
/**
 * Created by PhpStorm.
 * User: arden
 * Date: 27/05/2017
 * Time: 22:14
 */

namespace Inkweb\ModuleBundle\Admin;


use Inkweb\ModuleBundle\Entity\Module;
use Inkweb\EleveBundle\Entity\Classe;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;

class CoursAdmin extends AbstractAdmin
{
    protected function configureFormFields(FormMapper $formMapper){
        // Liste des champs disponibles dans le formulaire d'édition
        $formMapper
            ->add('module','sonata_type_model',array(
                'class' => 'Inkweb\ModuleBundle\Entity\Module',
                'property' => 'nomMat'
            ))
            ->add('classe','sonata_type_model',array(
                'class' => 'Inkweb\EleveBundle\Entity\Classe',
                'property' => 'nom'
            ))
            ->add('date','date')
            ->add('heure','time')
            ->add('duree','number')
        ;
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper){
        // Liste des filtres disponibles dans la vue en liste
        $datagridMapper
            ->add('module',null,array(),'entity',array(
                'class' => 'Inkweb\ModuleBundle\Entity\Module',
                'choice_label' => 'nomMat',
            ))
            ->add('classe',null,array(),'entity',array(
                'class' => 'Inkweb\EleveBundle\Entity\Classe',
                'choice_label' => 'nom',
            ))
        ;
    }

    protected function configureListFields(ListMapper $listMapper){
        // Liste des champs disponibles dans le formulaire en liste
        $listMapper
            ->addIdentifier('module.Mat')
            ->add('classe.nom')
            ->add('date')
            ->add('heure')
            ->add('duree')
        ;


    }

    public function toString($object)
    {
        return $object instanceof Module
            ? $object->getTitle()
            : 'Module';
    }


}