<?php

namespace MEHDI\CoreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException; 
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
}
