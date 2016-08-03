<?php

namespace MEHDI\ECommerceBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class ProductController extends Controller
{
    public function indexAction()
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
		$form = $this->createForm(ProductType::class, $product);
		$form->handleRequest($request);
		
        return $this->render('MEHDIECommerceBundle:Product:index.html.twig', array(
			'form' => $form->createView(),
		));
    }
	
	public function editAction($id, Request $request)
    {
        return $this->render('MEHDIECommerceBundle:Product:index.html.twig');
    }
	
	public function deleteAction($id)
    {
        return $this->render('MEHDIECommerceBundle:Product:index.html.twig');
    }
	
	public function viewAction($id)
	{
		return $this->render('MEHDIECommerceBundle:Product:view.html.twig');
	}
	

}
