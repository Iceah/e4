<?php
/**
 * Created by PhpStorm.
 * User: arden
 * Date: 31/05/2017
 * Time: 09:11
 */

namespace Inkweb\ModuleBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ButtonType;

class ModuleEditType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options){
        $builder
            ->add('avancement',NumberType::class)
            ->add('notemodule',TextareaType::class)
            ->add('enregistrer',SubmitType::class)
/*            ->add('delete', ButtonType::class, ['label' => 'Delete', 'attr' => [
                'class' => 'btn-danger form-delete-button',
                'data-delete-url' => $this->generateUrl('module_ajax_delete', [
                    'id' => $module->getId(),
                ]),*/
        ;
    }

    public function configureOptions(OptionsResolver $resolver){
        $resolver->setDefaults(array());
    }
    public function getBlockPrefix(){
        return 'inkweb_modulebundle_module';
    }
}