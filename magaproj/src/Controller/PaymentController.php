<?php

namespace App\Controller;

use App\Service\CaissierService;
use App\Service\HassenService;
use App\Service\VendeurService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PaymentController extends AbstractController
{
    /**
     * @Route("/payment", name="payment")
     */
    public function index(HassenService $hassen, VendeurService $odile, CaissierService $manel): Response
    {
        $panier = $hassen->recupererLePanier();
        $bonDeOdile = $odile->etablirBonDeCommande($panier);
        $session = $manel->encaisserBonDeCommande($bonDeOdile);

        return $this->render('payment/index.html.twig', [
            'sessionId' => $session->id
        ]);
    }

    /**
     * @Route("/payment/success", name="payment_success")
     */
    public function success(): Response
    {
        return $this->render('payment/success.html.twig');
    }

    /**
     * @Route("/payment/failed", name="payment_failed")
     */
    public function failed(): Response
    {
        return $this->render('payment/failed.html.twig');
    }
}
