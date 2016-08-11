<?php

namespace MEHDI\ECommerceBundle\Controller;

use MEHDI\ECommerceBundle\Entity\Basket;
use MEHDI\ECommerceBundle\Entity\Commande;
use MEHDI\ECommerceBundle\Form\BasketType;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class CommandeController extends Controller
{
    public function indexAction()
    {
		$commande = $this ->getDoctrine() //liste des catégories
			->getManager() //permet de gérer les requêtes
			->getRepository('MEHDIECommerceBundle:Commande')
			->findByUser($this->getUser());
        return $this->render('MEHDIECommerceBundle:Commande:index.html.twig', array(
			'commandes' => $commande
		));
    }
	
	public function detailsAction($id){
		$commande = $this ->getDoctrine() //liste des catégories
			->getManager() //permet de gérer les requêtes
			->getRepository('MEHDIECommerceBundle:Commande')
			->find($id);
		return $this->render('MEHDIECommerceBundle:Commande:details.html.twig', array(
			'products' => $commande->getProducts()
		));	
	}

}
