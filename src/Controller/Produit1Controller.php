<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class Produit1Controller extends AbstractController
{
    /**
     * @Route("/produit1", name="produit1")
     */
    public function index(): Response
    {
        return $this->render('produit1/index.html.twig', [
            'controller_name' => 'Produit1Controller',
        ]);
    }
}
