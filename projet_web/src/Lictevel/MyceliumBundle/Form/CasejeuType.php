<?php

namespace Lictevel\MyceliumBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class CasejeuType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
          ->add('abscisse',         TextType::class)
          ->add('ordonnee',         TextType::class)
          ->add('type',             TextType::class)
          ->add('prodNutriments',   TextType::class)
          ->add('prodSpores',       TextType::class)
          ->add('prodPoison',       TextType::class)
          ->add('prodEnzymes',      TextType::class)
          ->add('prodFilamentsPara',TextType::class)
          ->add('prodFilamentsSym', TextType::class)
          ->add('Valider',          SubmitType::class);
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Lictevel\MyceliumBundle\Entity\Casejeu'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'lictevel_myceliumbundle_casejeu';
    }


}
