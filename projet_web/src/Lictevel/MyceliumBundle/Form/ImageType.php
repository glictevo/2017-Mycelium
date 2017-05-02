<?php
// src/Lictevel/MyceliumBundle/Form/ImageType.php

namespace Lictevel\MyceliumBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Lictevel\MyceliumBundle\Entity\Image;

class ImageType extends AbstractType
{
  public function buildForm(FormBuilderInterface $builder, array $options)
  {
    $builder
      ->add('url',      FileType::class, array('label' => 'Image'))
      ->add('valider',  SubmitType::class)
    ;
  }

  public function configureOptions(OptionsResolver $resolver){
    $resolver->setDefaults(array(
      'data_class' => Image::class,
    ));
  }
}
