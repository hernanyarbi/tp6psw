<?php

namespace BackendBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class DefaultController extends Controller
{
    /**
     * @Route("/backend")
     */
    public function indexAction()
    {
        return $this->render('BackendBundle:Default:index.html.twig');
        return new Response( '<html><body>PSW 2017</body></html>' );

    }
}
