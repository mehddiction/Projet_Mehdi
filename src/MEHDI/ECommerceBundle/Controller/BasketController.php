<?php

namespace MEHDI\ECommerceBundle\Controller;

use MEHDI\ECommerceBundle\Entity\Basket;
use MEHDI\ECommerceBundle\Entity\Commande;
use MEHDI\ECommerceBundle\Form\BasketType;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class BasketController extends Controller
{
    public function indexAction()
    {
		$products = $this ->getDoctrine() //liste des catégories
			->getManager() //permet de gérer les requêtes
			->getRepository('MEHDIECommerceBundle:Basket')
			->findByUser($this->getUser());
        return $this->render('MEHDIECommerceBundle:Basket:index.html.twig', array(
			'products' => $products
		));
    }
	
	public function orderAction()
    {	
		$em = $this->getDoctrine()->getManager();
		$products = $em->getRepository('MEHDIECommerceBundle:Basket')->findByUser($this->getUser());
		$commande=new Commande();
		$commande->setEtat("Expedie")->setUser($this->getUser());
		$montant=0;
		foreach($products as $prod){
			$montant+=$prod->getProduct()->getPrixUnitaire()*$prod->getQuantiteChoisie();
			$commande->addProduct($prod->getProduct());
			$qty=($prod->getQuantiteChoisie()>$prod->getProduct()->getQuantiteRestante())?$prod->getProduct()->getQuantiteRestante():$prod->getQuantiteChoisie();
			$prod->getProduct()->decreaseQty($qty);
		$em->remove($prod);
		}
		$commande->setMontant($montant);
		$em->persist($commande);
		$em->flush();
		
		return $this->redirect($this->generateUrl('mehdie_commerce_commande_index'));
    }
	
	public function editQtyAction($id, Request $request)
    {
        $em = $this->getDoctrine()->getManager();
		$product = $em->getRepository('MEHDIECommerceBundle:Basket')->find($id);
		
		if(null == $product){
			throw new NotFoundHttpException("Cette product ne possède d'ID ".$id.".");
		}
		
		$form = $this->createForm(BasketType::class, $product);
		$form->handleRequest($request);
		
		if($form->isValid()){
			$em->flush();

			$request->getSession()->getFlashBag()->add('notice', 'La quantité du produit '.$product->getProduct()->getLibelle().' est modifiée.');
			return $this->redirect($this->generateUrl('mehdie_commerce_basket_index'));
			}
		
		return $this->render('MEHDIECommerceBundle:Basket:editQty.html.twig', array(
			'form' => $form->createView(),
		));
    }
	
	public function deleteProdAction($id)
    {
        $em = $this->getDoctrine()->getManager();
		$product = $em->getRepository('MEHDIECommerceBundle:Basket')->find($id);
		
		if(null == $product){
			throw new NotFoundHttpException("Cette product ne possède d'ID ".$id.".");
		}
			
		$em->remove($product);
		$em->flush();
		
		return $this->redirect($this->generateUrl('mehdie_commerce_basket_index'));
	}
	

}
