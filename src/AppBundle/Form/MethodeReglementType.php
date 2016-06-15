<?php

namespace AppBundle\Form;

use Symfony\Component\Form\FormBuilderInterface;
use AppBundle\Entity\MethodeReglement;

class MethodeReglementType extends ApiType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('libelle');
    }

    public function getEntity()
    {
        return MethodeReglement::class;
    }
}
