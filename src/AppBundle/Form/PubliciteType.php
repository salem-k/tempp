<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Finder\Finder;


class PubliciteType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('libelle')
            ->add('image', 'choice', array(
              'empty_value' => 'No Pub (select one)',
              'choices'  => $this->getFiles(),
              'required' => false
            ))
            ->add('url')
        ;
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Publicite'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'appbundle_publicite';
    }

    /**
    *
    * $type = image
    */

    public function getFiles(){

      $finder = new Finder();

//      if($type == 'image')

      $finder->files()->name('*.jpg')->name('*.png')->in(__DIR__ . "/../../../web/uploads/");

/*
      else
        $finder->files()->name('*.mp3')->name('*.wav')->in(__DIR__ . "/../../../web/uploads/");
*/

      $return = Array();

      foreach ($finder as $file) {
        $return[$file->getBasename()] = $file->getBasename();
      }
      return $return;
    }
}
