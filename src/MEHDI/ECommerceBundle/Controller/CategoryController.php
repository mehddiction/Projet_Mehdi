<?php

namespace MEHDI\ECommerceBundle\Controller;

use MEHDI\ECommerceBundle\Entity\Category;
use MEHDI\ECommerceBundle\Form\CategoryType;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class CategoryController extends Controller
{
    public function indexAction()
    {
		$categories = $this ->getDoctrine() //liste des catégories
			->getManager() //permet de gérer les requêtes
			->getRepository('MEHDIECommerceBundle:Category')
			->findAll();
        return $this->render('MEHDIECommerceBundle:Category:index.html.twig', array(
			'categories' => $categories
		));
    }
	
	public function addAction(Request $request)
    {
		$category = new Category();
		$form = $this->createForm(CategoryType::class, $category);
		$form->handleRequest($request);
		
		if($form->isValid()){
			$em = $this->getDoctrine()->getManager();
			$em->persist($category);//enregistrement de la catégorie en question
			$em->flush(); //confirmation des requêtes
			
			$request->getSession()->getFlashBag()->add('notice', 'La catÃ©gorie '.$category->getNom().' est enregistrÃ©.');
			return $this->redirect($this->generateUrl('mehdie_commerce_category'));
			
		}
		
        return $this->render('MEHDIECommerceBundle:Category:add.html.twig', array(
			'form' => $form->createView(),
		));
    }
	
	public function editAction($id, Request $request)
    {
        $em = $this->getDoctrine()->getManager();
		$category = $em->getRepository('MEHDIECommerceBundle:Category')->find($id);
		
		if(null == $category){
			throw new NotFoundHttpException("Cette catÃ©gorie d'ID ".$id." n'existe pas.");
		}
		
		$form = $this->createForm(CategoryType::class, $category);
		$form->handleRequest($request);
		
		if($form->isValid()){
			$em->flush();

			$request->getSession()->getFlashBag()->add('notice', 'La catÃ©gorie '.$category->getNom().' est modifiÃ©e.');
			return $this->redirect($this->generateUrl('mehdie_commerce_category'));
			}
		
		return $this->render('MEHDIECommerceBundle:Category:edit.html.twig', array(
			'form' => $form->createView(),
		));
    }
	
	public function deleteAction($id)
    {
        $em = $this->getDoctrine()->getManager();
		$category = $em->getRepository('MEHDIECommerceBundle:Category')->find($id);
		
		if(null == $category){
			throw new NotFoundHttpException("Cette catÃ©gorie d'ID ".$id." n'existe pas.");
		}
		
		//$count = $em->getRepository('MEHDIECommerceBundle:Product')->countProductWithCategory($id);
		$count=0;
		if($count <1){
			$em->remove($category);
			$em->flush();
			
			}
		else
			$request->getSession()->getFlashBag()->add('error', 'La catÃ©gorie '.$category->getNom().' ne peut Ãªtre supprimÃ©e car elle contient des produits.');
		
		return $this->redirect($this->generateUrl('mehdie_commerce_category'));
	}
	

}
