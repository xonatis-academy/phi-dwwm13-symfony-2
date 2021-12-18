<?php

namespace App\Controller;

use App\Entity\Estimation;
use App\Entity\Production;
use App\Form\EstimationType;
use App\Repository\EstimationRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/estimation")
 */
class EstimationController extends AbstractController
{
    /**
     * @Route("/new/{id}", name="estimation_new", methods={"GET", "POST"})
     */
    public function new(Production $production, Request $request, EntityManagerInterface $entityManager): Response
    {
        $estimation = new Estimation();
        $estimation->setProduction($production);
        $user = $this->getUser();
        $estimation->setEstimateur($user);
        $form = $this->createForm(EstimationType::class, $estimation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($estimation);
            $entityManager->flush();

            return $this->redirectToRoute('production_show', [
                'id' => $production->getId()
            ], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('estimation/new.html.twig', [
            'estimation' => $estimation,
            'form' => $form,
        ]);
    }
}
