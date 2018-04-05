<?php

namespace App\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use App\Services\semantic\SemanticGui;

class IndexController extends AbstractController
{
    /**
     * @Route("/", name="index")
     */
    public function index(SemanticGui $gui){
    	$gui->getOnClick(".elements","", "#block-body",["attr"=>"data-ajax"]);
    	$gui->getOnClick("#menu a[data-ajax]","","#block-body",["attr"=>"data-ajax"]);
        return $gui->renderView("index.html.twig");
    }
}
