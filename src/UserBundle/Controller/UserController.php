<?php

namespace UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class UserController extends Controller
{
    /**
     * @Route("/")
     */
    public function authenticationAction()
    {
        return $this->render('UserBundle:User:authentication.html.twig');
    }
	
	public function addAction()
    {
        return $this->render('UserBundle:Default:index.html.twig');
    }
	
	public function updateAction($id)
    {
        return $this->render('UserBundle:Default:index.html.twig');
    }
	
	public function deleteAction($id)
    {
        return $this->render('UserBundle:Default:index.html.twig');
    }
	
	public function listingAction()
    {
        return $this->render('UserBundle:Default:index.html.twig');
    }
}
