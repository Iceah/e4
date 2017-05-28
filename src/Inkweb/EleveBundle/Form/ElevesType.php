<?php

namespace Inkweb\EleveBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;

class ElevesType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('classe', CollectionType::class, array(
                '' => EleveType::class,
            ))
            ->add('enregistrer', SubmitType::class)
        ;
    }

    public function getBlockPrefix()
    {
        return 'elevebundle_eleve';
    }
}