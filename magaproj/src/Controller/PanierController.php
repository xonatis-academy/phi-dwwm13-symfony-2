<?php

namespace App\Controller;

use App\Entity\Production;
use App\Model\ElementPanier;
use App\Model\Panier;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;

class PanierController extends AbstractController
{
    /**
     * @Route("/panier", name="panier")
     */
    public function index(SessionInterface $sessionInterface): Response
    {
        $panier = $sessionInterface->get('cart');

        return $this->render('panier/index.html.twig', [
            'panier' => $panier,
        ]);
    }

    /**
     * @Route("/panier/add/{id}", name="panier_add")
     */
    public function add(Production $production, SessionInterface $sessionInterface): Response
    {
        $panier = $sessionInterface->get('cart');
        if ($panier === null) {
            $panier = new Panier();
            $panier->elements = [];
        }

        foreach ($panier->elements as $truc) {
            $productionDansLePanier = $truc->production;
            if ($productionDansLePanier->getId() === $production->getId()) {
                $truc->quantite = $truc->quantite + 1;
                $panier->prixtotal = $panier->prixtotal + $production->getPrixFinal();
                $sessionInterface->set('cart', $panier);
                return $this->redirectToRoute('panier');
            }
        }

        $element = new ElementPanier();
        $element->production = $production;
        $element->quantite = 1;
        $panier->elements[] = $element;
        $panier->prixtotal = $panier->prixtotal + $production->getPrixFinal();

        $sessionInterface->set('cart', $panier);

        return $this->redirectToRoute('panier');
    }

    
    /**
     * @Route("/panier/clear", name="panier_clear")
     */
    public function clear(SessionInterface $sessionInterface): Response
    {
        $sessionInterface->set('cart', null);

        return $this->redirectToRoute('panier');
    }

}
