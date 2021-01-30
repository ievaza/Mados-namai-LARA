<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class OutfitController extends AbstractController
{
    #[Route('/outfit', name: 'outfit')]
    public function index(): Response
    {
        return $this->render('outfit/index.html.twig', [
            'controller_name' => 'OutfitController',
        ]);
    }
}
