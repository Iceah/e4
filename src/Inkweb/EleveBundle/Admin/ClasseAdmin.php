<?php
/**
 * Created by PhpStorm.
 * User: arden
 * Date: 27/05/2017
 * Time: 21:53
 */

namespace Inkweb\EleveBundle\Admin;




use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;

class ClasseAdmin extends AbstractAdmin
{
    protected function configureFormFields(FormMapper $formMapper){

        $formMapper
            ->add('nom','text')
            ->add('annee','date')
            ->with('Eleves')
            ->add('classe','sonata_type_model',array(
                'class' => 'Inkweb\EleveBundle\Entity\Eleve',
                'property' => 'nom',
                'multiple' => true,

            ))
        ;
    }
    protected function configureDatagridFilters(DatagridMapper $datagridMapper){
        $datagridMapper->add('nom');
    }
    protected function configureListFields(ListMapper $listMapper){
        $listMapper
            ->addIdentifier('nom')
            ->add('date')
        ;
    }
}