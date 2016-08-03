<?php

namespace MEHDI\ECommerceBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CategoryType extends AbstractType
{
	/**
	*/
	
	public function buildForm(FormBuilderInterface $builder, array $options)
	{
		$builder
			->add('nom')
		;
	}
	
	public function configureOptions(OptionsResolver $resolver)
	{
		$resolver->setDefaults(array(
			'data_class' => 'MEHDI\EcommerceBundle\Entity\Category'
		));
	}
}