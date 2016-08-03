<?php

namespace MEHDI\ECommerceBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\ProductType;

class ProductType extends AbstractType
{
	/**
	*/
	
	public function buildForm(FormBuilderInterface $builder, array $options)
	{
		$builder
			->add('libelle')
			->add('description',TextAreaType::class)
			->add('image', ImageType::class)
			->add('prixUnitaire', MoneyType::class)
			->add('quantiteRestante', IntegerType:class)
			->add('category', EntityType::class, array(
				'class' => 'MEHDI\ECommerceBundle\Entity\Category',
				'choice_label' => 'nom',
				'multiple' => false
			))
		;
	}
	
	public function configureOptions(OptionsResolver $resolver)
	{
		$resolver->setDefaults(array(
			'data_class' => 'MEHDI\EcommerceBundle\Entity\Product'
		));
	}
}