<?php

namespace MEHDI\ECommerceBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('MEHDIECommerceBundle:Default:index.html.twig');
    }
}
