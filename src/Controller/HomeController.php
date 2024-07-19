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
        for ($i = 0; $i < 10; $i++) {
            echo $i; // This is a bug
        }
        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }
}
