<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;

class PaymentController extends AbstractController
{
    /**
     * @Route("/payment", name="payment")
     */
    public function index(SessionInterface $sessionInterface): Response
    {
        $panier = $sessionInterface->get('cart');

        /*
        amount
        quantity
        currency 'eur'
        name
        */

        $panierChezStripe = [];

        foreach ($panier->elements as $truc) {
            $elementPourStripe = [
                'amount' => $truc->quantite * $truc->production->getPrixFinal() * 100,
                'quantity' => $truc->quantite,
                'currency' => 'eur',
                'name' => $truc->production->getTitre(),
            ];
            $panierChezStripe[] = $elementPourStripe;
        }

        $stripe = new \Stripe\StripeClient('<votre clé sk ici>');
        $session = $stripe->checkout->sessions->create([
            'success_url' => 'http://localhost:8000/payment/success',
            'cancel_url' => 'http://localhost:8000/payment/failed',
            'payment_method_types' => [
                'card'
            ],
            'mode' => 'payment',
            'line_items' => $panierChezStripe
        ]);

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
