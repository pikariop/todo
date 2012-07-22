<?php

namespace OP\TodoAppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;


class DefaultController extends Controller
{
    
    public function indexAction($name)
    {
        return $this->render('OPTodoAppBundle:Default:index.html.twig', array('name' => $name));
    }
}
