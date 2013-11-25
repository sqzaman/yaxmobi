<?php

namespace Front\YxBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        die('here ' . $name);
        return $this->render('YxBundle:Default:index.html.twig', array('name' => $name));
    }
}
