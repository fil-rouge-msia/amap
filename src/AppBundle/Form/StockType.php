<?php

namespace AppBundle\Form;

use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use AppBundle\Entity\Stock;

class StockType extends ApiType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('quantite_produit', IntegerType::class)
            ->add('emballage')
            ->add('producteur')
            ->add('amap')
            ->add('produit');
    }

    public function getEntity()
    {
        return Stock::class;
    }
}
