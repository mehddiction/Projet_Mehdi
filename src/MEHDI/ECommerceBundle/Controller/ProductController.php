<?php

namespace MEHDI\ECommerceBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use MEHDI\ECommerceBundle\Form\ProductType;
use MEHDI\ECommerceBundle\Entity\Product;
use MEHDI\ECommerceBundle\Form\QuantiteType;

class ProductController extends Controller
{
    public function indexAction($page)
    {
		if($page < 1){
			throw $this->createNotFoundException("La page ".$page." n'existe pas.");
		}
		$nbPerPage=5;
		$products=$this->getDoctrine()
			->getManager()
			->getRepository('MEHDIECommerceBundle:Product')
			->getProductsByUser($page, $nbPerPage, $this->getUser()->getId())
		;
		$nbPages=ceil(count($products)/$nbPerPage);
		
		if($page>$nbPages && $nbPages !=0){
			throw $this->createNotFoundException("La page ".$page." n'existe pas.");
		}
		
        return $this->render('MEHDIECommerceBundle:Product:index.html.twig', array(
			'products' 	=> $products,
			'nbPages'  	=> $nbPages,
			'page'		=> $page
		));
    }
	
	public function addAction(Request $request)
    {
		$product = new Product();
		$product->setUser($this->getUser());
		$form = $this->createForm(ProductType::class, $product);
		$form->handleRequest($request);
		
		if($form->isValid()){
			$em=$this->getDoctrine()->getManager();
			$em->persist($product);
			$em->flush();
			
			$request->getSession()->getFlashBag()->add('notice', 'Le produit '.$product->getLibelle().' a bien été enregistré.');
			return $this->redirect($this->generateUrl('mehdie_commerce_products'));
	}
		
        return $this->render('MEHDIECommerceBundle:Product:add.html.twig', array(
			'form' => $form->createView(),
		));
    }
	
	public function editAction($id, Request $request)
    {	$em = $this->getDoctrine()->getManager();
		$product = $em->getRepository('MEHDIECommerceBundle:Product')->find($id);
		
		if(null == $product){
			throw new NotFoundHttpException("Ce produit d'ID ".$id." n'existe pas.");
		}
        
		$form = $this->createForm(ProductType::class, $product); //modification du formulaire de l'objet
		$form->handleRequest($request);
		
		if($form->isValid()){
			$em->flush();

			$request->getSession()->getFlashBag()->add('notice', 'Le produit '.$product->getLibelle().' est modifié.');
			return $this->redirect($this->generateUrl('mehdie_commerce_products'));
			}
		
		return $this->render('MEHDIECommerceBundle:Product:edit.html.twig', array(
			'form' => $form->createView(),
		));
		
    }
	
	public function deleteAction($id)
    {
		$em = $this->getDoctrine()->getManager(); //objet permettant de récupérer le manager qui nous permet de gérer les requêtes
		$product = $em->getRepository('MEHDIECommerceBundle:Product')->find($id); //on veut récupérer le produit avec l'id correspondant
		if(null == $product){
			throw new NotFoundHttpException("Ce produit d'ID ".$id." n'existe pas.");
		}
		$count=0;
		if($count <1){
			$em->remove($product);
			$em->flush();
		}
        return $this->redirect($this->generateUrl('mehdie_commerce_products'));
    }
	
	public function editQuantiteAction($id, Request $request){
		$em = $this->getDoctrine()->getManager();
		$product = $em->getRepository('MEHDIECommerceBundle:Product')->find($id);
		
		if(null == $product){
			throw new NotFoundHttpException("Ce produit d'ID ".$id." n'existe pas.");
		}
		
		$form = $this->createForm(QuantiteType::class, $product); //modification du formulaire de l'objet
		$form->handleRequest($request);
		
		if($form->isValid()){
			$em->flush();

			$request->getSession()->getFlashBag()->add('notice', 'La quantité du produit '.$product->getLibelle().' est modifiée.');
			return $this->redirect($this->generateUrl('mehdie_commerce_products'));
			}
		
		return $this->render('MEHDIECommerceBundle:Product:editQty.html.twig', array(
			'form' => $form->createView(),
		));
	}
	
	public function viewAction($id)
	{
		$em = $this->getDoctrine()->getManager();
		$product = $em->getRepository('MEHDIECommerceBundle:Product')->find($id);
		
		if(null=== $product){
			throw new NotFoundHttpException("Le produit d'ID ".$id." n'existe pas.");
		}
		return $this->render('MEHDIECommerceBundle:Product:view.html.twig', array('product'=>$product));
	}
	

}
