<?php
/**
 * Created by PhpStorm.
 * User: arden
 * Date: 27/05/2017
 * Time: 22:14
 */

namespace Inkweb\ProfesseurBundle\Admin;


use Inkweb\ProfesseurBundle\Entity\Professeur;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;

class ProfesseurAdmin extends AbstractAdmin
{
    protected function configureFormFields(FormMapper $formMapper){
        // Liste des champs disponibles dans le formulaire d'édition
        $formMapper
            ->with('Informations principales')
                ->add('nom','text')
                ->add('prenom','text')
                ->add('numsecusocial','text')
                ->add('telephone','number')
                ->add('adresse1','text')
                ->add('adresse2','text')
                ->add('cp','number')
                ->add('ville','text')
                ->add('avatar','text')
                ->add('dateembauche','date')
            ->end()
        ;
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper){
        // Liste des filtres disponibles dans la vue en liste
        $datagridMapper
            ->add('nom')
        ;
    }

    protected function configureListFields(ListMapper $listMapper){
        // Liste des champs disponibles dans le formulaire en liste
        $listMapper
            ->addIdentifier('nom')
            ->add('prenom')
            ->add('telephone')
        ;


    }

    public function toString($object)
    {
        return $object instanceof Professeur
            ? $object->getTitle()
            : 'Professeur';
    }


}