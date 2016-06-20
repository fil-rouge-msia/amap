<?php

namespace AppBundle\Form;

use Symfony\Component\Form\FormBuilderInterface;
use AppBundle\Entity\Benevole;

class BenevoleType extends ApiType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('poste_benevole')
            ->add('amap')
            ->add('adherent');
    }

    public function getEntity()
    {
        return Benevole::class;
    }
}
