<?php

namespace App\Service;

class CaissierService {
    
    public function encaisserBonDeCommande($bonDeCommande) {

        $stripe = new \Stripe\StripeClient('<votre clé sk ici>');
        $session = $stripe->checkout->sessions->create([
            'success_url' => 'http://localhost:8000/payment/success',
            'cancel_url' => 'http://localhost:8000/payment/failed',
            'payment_method_types' => [
                'card'
            ],
            'mode' => 'payment',
            'line_items' => $bonDeCommande
        ]);

        return $session;
    }
    
}