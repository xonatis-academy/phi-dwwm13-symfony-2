<?php

namespace App\Service;

class VendeurService {

    public function etablirBonDeCommande($commande) {
        $panierChezStripe = [];
        foreach ($commande->elements as $truc) {
            $elementPourStripe = [
                'amount' => $truc->quantite * $truc->production->getPrixFinal() * 100,
                'quantity' => $truc->quantite,
                'currency' => 'eur',
                'name' => $truc->production->getTitre(),
            ];
            $panierChezStripe[] = $elementPourStripe;
        }
        return $panierChezStripe;
    }

}