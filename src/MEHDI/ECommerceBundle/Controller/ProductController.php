<?php

namespace MEHDI\ECommerceBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use MEHDI\ECommerceBundle\Form\ProductType;
use MEHDI\ECommerceBundle\Entity\Product;

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
    {
        return $this->render('MEHDIECommerceBundle:Product:edit.html.twig');
    }
	
	public function deleteAction($id)
    {
        return $this->render('MEHDIECommerceBundle:Product:delete.html.twig');
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
