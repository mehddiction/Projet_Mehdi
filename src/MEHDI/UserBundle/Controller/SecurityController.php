<?php

namespace MEHDI\UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\SecurityContext;

class SecurityController extends Controller
{
    public function loginAction()
    {
        if ($this->get('security.authorization_checker')->isGranted('IS_AUTHENTICATED_REMEMBERED')){
			return $this->redirectToRoute('mehdi_core_homepage');
		}
		$authenticationUtils = $this->get('security.authentication_utils')
		return $this->render('MehdiUserBundle:Security:login.html.twig', array(
			'last_username' => $authenticationUtils->getLastUsername(),
			'error' => $authenticationUtils->getLastAuthenticationError(),
		));
    }
}
