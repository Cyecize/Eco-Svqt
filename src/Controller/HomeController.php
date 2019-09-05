<?php

namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends Controller
{

    /**
     * @Route(path="/", name="homepage")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function homeAction() {
        return $this->render('base.html.twig');
    }
}