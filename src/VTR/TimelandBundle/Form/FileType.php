<?php
// src/VTR/TimelandBundle/Form/ImageType.php

namespace VTR\TimelandBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class FileType extends AbstractType
{
  public function buildForm(FormBuilderInterface $builder, array $options)
  {
    $builder
      ->add('file', 'file')
    ;
  }

  public function setDefaultOptions(OptionsResolverInterface $resolver)
  {
    $resolver->setDefaults(array(
      'data_class' => 'VTR\TimelandBundle\Entity\File'
    ));
  }

  public function getName()
  {
    return 'vtr_timelandbundle_file';
  }
}
