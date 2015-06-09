<?php

namespace VTR\TimelandBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('VTRTimelandBundle:Default:index.html.twig', array('name' => $name));
    }

    public function timelandAction()
    {
        return $this->render('VTRTimelandBundle:Default:timeland.html.twig');
    }
}
