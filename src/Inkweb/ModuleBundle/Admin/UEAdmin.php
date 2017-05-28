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

class UEAdmin extends AbstractAdmin
{
    protected function configureFormFields(FormMapper $formMapper){
        // Liste des champs disponibles dans le formulaire d'édition
        $formMapper
            ->add('codeue','text')
            ->add('nomue','text')
        ;
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper){
        // Liste des filtres disponibles dans la vue en liste
        $datagridMapper
            ->add('codeue')
            ->add('nomue')
        ;
    }

    protected function configureListFields(ListMapper $listMapper){
        // Liste des champs disponibles dans le formulaire en liste
        $listMapper
            ->addIdentifier('codeue')
            ->add('nomue')
        ;


    }

    public function toString($object)
    {
        return $object instanceof Module
            ? $object->getTitle()
            : 'Module';
    }


}