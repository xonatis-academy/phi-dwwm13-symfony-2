<?php

namespace App\Controller;

use App\Entity\Production;
use App\Service\HassenService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PanierController extends AbstractController
{
    /**
     * @Route("/panier", name="panier")
     */
    public function index(HassenService $hassen): Response
    {
        $panier = $hassen->recupererLePanier();
        return $this->render('panier/index.html.twig', [
            'panier' => $panier,
        ]);
    }

    /**
     * @Route("/panier/add/{id}", name="panier_add")
     */
    public function add(Production $production, HassenService $hassen): Response
    {
        $hassen->chercherUnPanier();
        $hassen->mettreAJourLaQuantite($production);
        return $this->redirectToRoute('panier');
    }

    
    /**
     * @Route("/panier/clear", name="panier_clear")
     */
    public function clear(HassenService $hassen): Response
    {
        $hassen->viderLePanier();
        return $this->redirectToRoute('panier');
    }

}
