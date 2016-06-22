<?php

namespace AppBundle\Form;

use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use AppBundle\Entity\Contrat;

class ContratType extends ApiType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('amap')
            ->add('adherent')
            ->add('producteur')
            ->add('date_debut')
            ->add('date_fin')
            ->add('saison')
            ->add('part_recolte')
            ->add('montant_part')
        ;
    }

    public function getEntity() {
        return Contrat::class;
    }
}
