<?php

namespace Lictevel\MyceliumBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Lictevel\MyceliumBundle\Entity\Champignon;
use Lictevel\MyceliumBundle\Form\CasejeuType;

class CreerChampignonType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
          ->add('Name',           TextType::class)
          ->add('CaseSporophore', CasejeuCreerChampignonType::class)
          ->add('valider',        SubmitType::class)
        ;
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Lictevel\MyceliumBundle\Entity\Champignon'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'lictevel_myceliumbundle_champignon';
    }


}
