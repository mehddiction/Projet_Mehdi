<?php

namespace MEHDI\ECommerceBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class ProductType extends AbstractType
{
	/**
	*/
	
	public function buildForm(FormBuilderInterface $builder, array $options)
	{
		$builder
			->add('libelle')
			->add('description',TextareaType::class)
			->add('image', ImageType::class)
			->add('prixUnitaire', MoneyType::class)
			->add('quantiteRestante', IntegerType::class)
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