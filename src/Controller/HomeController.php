<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

/**
 * Class HomeController
 */
class HomeController extends AbstractController
{
    /**
     * Route for home page
     */
    #[Route('/home', name: 'app_home')]
    public function index(): Response
    {
        while(true){
            echo "Hello World";
        }
        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }
}
