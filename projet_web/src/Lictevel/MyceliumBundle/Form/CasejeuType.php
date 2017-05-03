<?php

namespace Lictevel\MyceliumBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CasejeuType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
          ->add('abscisse')
          ->add('palier')
          ->add('ordonnee')
          ->add('type')
          ->add('occupee')
          ->add('prodNutriments')
          ->add('prodSpores')
          ->add('prodPoison')
          ->add('prodEnzymes')
          ->add('prodFilamentsPara')
          ->add('prodFilamentsSym')
          ->add('joueur')
          ->add('champignon');
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
