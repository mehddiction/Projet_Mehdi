<?php

namespace MEHDI\ECommerceBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class BasketType extends AbstractType
{
	/**
	*/
	
	public function buildForm(FormBuilderInterface $builder, array $options)
	{
		$builder
			->add('quantiteChoisie', IntegerType::class);
	}
	
	public function configureOptions(OptionsResolver $resolver)
	{
		$resolver->setDefaults(array(
			'data_class' => 'MEHDI\EcommerceBundle\Entity\Basket'
		));
	}
}