<?php

namespace MEHDI\CoreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class CoreController extends Controller
{
    public function indexAction()
    {
        return $this->render('MEHDICoreBundle:Core:index.html.twig');
    }
}
