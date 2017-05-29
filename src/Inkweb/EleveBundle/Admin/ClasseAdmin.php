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
use Sonata\CoreBundle\Form\Type\CollectionType;

class ClasseAdmin extends AbstractAdmin
{
    protected function configureFormFields(FormMapper $formMapper){

        $formMapper
            ->add('nom','text')
            ->add('annee','date')
            ->add('eleve','sonata_type_collection',array(
                'required'=>true,
                'cascade_validation' => true,
                    'by_reference' => false,
                ), array(
                    'edit' => 'inline',
                    'inline' => 'table',
                )
            )
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
    public function toString($object)
    {
        return $object instanceof Eleve
            ? $object->getTitle()
            : 'Classe';
    }
}