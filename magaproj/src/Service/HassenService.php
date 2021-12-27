<?php

namespace App\Service;

use App\Model\ElementPanier;
use App\Model\Panier;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class HassenService {

    public $panier;
    public $sessionInterface;

    public function __construct(SessionInterface $sessionInterface)
    {
        $this->sessionInterface = $sessionInterface;
    }

    public function ajouterUneAutreLigneAuPanier($production) {
        $element = new ElementPanier();
        $element->production = $production;
        $element->quantite = 1;
        $this->panier->elements[] = $element;
        $this->panier->prixtotal = $this->panier->prixtotal + $production->getPrixFinal();
        $this->sessionInterface->set('cart', $this->panier);
    }

    public function chercherUnPanier() {
        $panier = $this->sessionInterface->get('cart');
        if ($panier === null) {
            $panier = new Panier();
            $panier->elements = [];
        }
        $this->panier = $panier;
        return;
    }

    public function mettreAJourLaQuantite($production) {
        foreach ($this->panier->elements as $truc) {
            $productionDansLePanier = $truc->production;
            if ($productionDansLePanier->getId() === $production->getId()) {
                $truc->quantite = $truc->quantite + 1;
                $this->panier->prixtotal = $this->panier->prixtotal + $production->getPrixFinal();
                $this->sessionInterface->set('cart', $this->panier);
                return;
            }
        }

        $this->ajouterUneAutreLigneAuPanier($production);
        return;
    }

    public function viderLePanier() {
        $this->sessionInterface->set('cart', null);
    }

    public function recupererLePanier() {
        $panier = $this->sessionInterface->get('cart');
        return $panier;
    }
}