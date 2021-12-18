<?php

namespace App\Controller;

use App\Entity\Production;
use App\Form\Production2Type;
use App\Repository\ProductionRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/favoris")
 */
class FavorisController extends AbstractController
{
    /**
     * @Route("/", name="favoris_index", methods={"GET"})
     */
    public function index(): Response
    {
        $user = $this->getUser();
        return $this->render('favoris/index.html.twig', [
            'productions' => $user->getFavoris(),
        ]);
    }

    /**
     * @Route("/add/{id}", name="favoris_add", methods={"GET"})
     */
    public function add(Production $production): Response {
        $user = $this->getUser();
        $user->addFavori($production);
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->flush();

        return $this->redirectToRoute('favoris_index');
    }

    /**
     * @Route("/delete/{id}", name="favoris_delete", methods={"GET"})
     */
    public function delete(Production $production): Response
    {
        $user = $this->getUser();
        $user->removeFavori($production);
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->flush();
        
        return $this->redirectToRoute('favoris_index');
    }
}
