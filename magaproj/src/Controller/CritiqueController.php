<?php

namespace App\Controller;

use App\Entity\Critique;
use App\Entity\Production;
use App\Form\CritiqueType;
use App\Repository\CritiqueRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/critique")
 */
class CritiqueController extends AbstractController
{
    /**
     * @Route("/new/{id}", name="critique_new", methods={"GET", "POST"})
     */
    public function new(Production $production, Request $request, EntityManagerInterface $entityManager): Response
    {
        $critique = new Critique();
        $critique->setProduction($production);
        $form = $this->createForm(CritiqueType::class, $critique);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($critique);
            $entityManager->flush();

            return $this->redirectToRoute('production_show', [
                'id' => $production->getId()
            ], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('critique/new.html.twig', [
            'critique' => $critique,
            'form' => $form,
        ]);
    }

}
