<?php

namespace MEHDI\CoreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException; 
use MEHDI\ECommerceBundle\Entity\Basket;
use Symfony\Component\HttpFoundation\Request;


class CoreController extends Controller
{
    public function indexAction($page, Request $request)
    {	
		if($page < 1){
			throw $this->createNotFoundException("La page ".$page." n'existe pas.");
		}
		
		$sort = "dateAjout";
		
		if($request->getMethod()=='POST'){
			$sort=$request->request->get('sort');
		}
		
		$nbPerPage = 12;
		
		$products = $this->getDoctrine()
			->getManager()
			->getRepository('MEHDIECommerceBundle:Product')
			->getProductsByCustomOrder($page, $nbPerPage, $sort)
		;
		
		$nbPages=ceil(count($products)/$nbPerPage);
		
		if($page > $nbPages && $nbPages != 0){
			throw $this->createNotFoundException("La page ".$page." n'existe pas.");
		}
		
        return $this->render('MEHDICoreBundle:Core:index.html.twig', array(
			'products' => $products,
			'nbPages' => $nbPages,
			'page' => $page,
			'sort' => $sort
		));
    }
	
	public function homeViewAction(){
		
	}
	
	public function addInBasketAction(Request $request){
		$id = $request->request->get('data');
		$em = $this->getDoctrine()->getManager();
		$product = $em->getRepository('MEHDIECommerceBundle:Product')->find($id);
		$basket = $em->getRepository('MEHDIECommerceBundle:Basket')->findOneByProduct($product);
		
		if($basket==null){
			$basket=new Basket();
			$basket->setUser($this->getUser());
			$basket->setProduct($product);
			
		}
	)
}
