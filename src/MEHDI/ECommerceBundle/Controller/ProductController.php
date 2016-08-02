<?php

namespace MEHDI\ECommerceBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ProductController extends Controller
{
    public function indexAction()
    {
        return $this->render('MEHDIECommerceBundle:Product:index.html.twig');
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
	

}
