<?php

namespace MEHDI\CoreBundle\Controller;

use MEHDI\ECommerceBundle\Entity\Basket;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException; 
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

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
	
	public function homeViewAction($id, Request $request){
		$em=$this->getDoctrine()->getManager();
		$product=$em->getRepository('MEHDIECommerceBundle:Product')->find($id);
		if(null==$product){
			throw new NotFoundHttpException("Le produit d'ID".$id."n'existe pas.");
		}
		return $this->render('MEHDICoreBundle:Core:homeview.html.twig',array(
		'product'=>$product));
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
			$em->persist($basket);
		}
		else{
			if($basket->getQuantiteChoisie()<$basket->getProduct()->getQuantiteRestante()){
				$basket->incrementQuantite();
			}
			else{
				$response=array("info" => 'Vous avez atteint le nombre maximum de "'.$product->getLibelle().'" disponible. Quantité dans le panier : '.$basket->getQuantiteChoisie());
				return new Response(json_encode($response));
			}
		}
		$em->flush();
		$response=array("info" => 'Le produit "'.$product->getLibelle().'" est ajouté avec succès au panier. Quantité : '.$basket->getQuantiteChoisie());
		return new Response(json_encode($response));
	}
	
}
