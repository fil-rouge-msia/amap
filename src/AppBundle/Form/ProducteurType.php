<?php

namespace AppBundle\Form;

use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use AppBundle\Entity\Producteur;

class ProducteurType extends ApiType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom_producteur')
            ->add('prenom_producteur')
            ->add('amap')
        ;
    }

    public function getEntity() {
        return Producteur::class;
    }
}
