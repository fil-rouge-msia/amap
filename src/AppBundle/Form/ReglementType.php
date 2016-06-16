<?php

namespace AppBundle\Form;

use Symfony\Component\Form\FormBuilderInterface;
use AppBundle\Entity\Reglement;

class ReglementType extends ApiType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('date_reglement');
    }

    public function getEntity()
    {
        return Reglement::class;
    }
}
