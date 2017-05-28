<?php
/**
 * Created by PhpStorm.
 * User: arden
 * Date: 27/05/2017
 * Time: 22:14
 */

namespace Inkweb\EleveBundle\Admin;


use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;

class EleveAdmin extends AbstractAdmin
{
    protected function configureFormFields(FormMapper $formMapper){
        // Liste des champs disponibles dans le formulaire d'édition
        $formMapper
            ->with('Classe')
                ->add('classe','sonata_type_model',array(
                'class' => 'Inkweb\EleveBundle\Entity\Classe',
                'property' => 'nom'
            ))
            ->end()
            ->with('Informations principales')
                ->add('nom','text')
                ->add('prenom','text')
                ->add('ine','number')
                ->add('numsecusocial','text')
                ->add('telephone','number')
                ->add('adresse1','text')
                ->add('adresse2','text')
                ->add('cp','number')
                ->add('ville','text')
                ->add('avatar','text')
            ->end()
        ;
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper){
        // Liste des filtres disponibles dans la vue en liste
        $datagridMapper
            ->add('nom')
            ->add('classe',null,array(),'entity',array(
                'class' => 'Inkweb\EleveBundle\Entity\Classe',
                'choice_label' => 'nom',
            ))
        ;
    }

    protected function configureListFields(ListMapper $listMapper){
        // Liste des champs disponibles dans le formulaire en liste
        $listMapper
            ->addIdentifier('nom')
            ->add('classe.nom')
            ->add('prenom')
            ->add('telephone')
            ->add('ine')
        ;


    }

    public function toString($object)
    {
        return $object instanceof Eleve
            ? $object->getTitle()
            : 'Eleve';
    }


}