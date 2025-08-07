<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

final class MainController extends AbstractController
{
    #[Route('/', name: 'main_home', methods: ['GET'])]
    function home() : Response
    {
return $this->render('main/home.html.twig');
    }

    #[Route('/about-us', name: 'main_aboutus', methods: ['GET'])]
    function aboutUs() : Response
    {
        return $this->render('main/about_us.html.twig');
    }

}