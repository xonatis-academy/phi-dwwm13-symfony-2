<?php

namespace App\Controller;

use App\Entity\Production;
use App\Form\Production1Type;
use App\Repository\ProductionRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/production")
 */
class ProductionController extends AbstractController
{
    /**
     * @Route("/", name="production_index", methods={"GET"})
     */
    public function index(ProductionRepository $productionRepository): Response
    {
        $moi = $this->getUser();
        return $this->render('production/index.html.twig', [
            'productions' => $productionRepository->findBy([
                'auteur' => $moi
            ]),
        ]);
    }

    /**
     * @Route("/new", name="production_new", methods={"GET", "POST"})
     */
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $production = new Production();
        $form = $this->createForm(Production1Type::class, $production);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($production);
            $entityManager->flush();

            return $this->redirectToRoute('production_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('production/new.html.twig', [
            'production' => $production,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="production_show", methods={"GET"})
     */
    public function show(Production $production): Response
    {
        return $this->render('production/show.html.twig', [
            'production' => $production,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="production_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Production $production, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(Production1Type::class, $production);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('production_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('production/edit.html.twig', [
            'production' => $production,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="production_delete", methods={"POST"})
     */
    public function delete(Request $request, Production $production, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$production->getId(), $request->request->get('_token'))) {
            $entityManager->remove($production);
            $entityManager->flush();
        }

        return $this->redirectToRoute('production_index', [], Response::HTTP_SEE_OTHER);
    }
}
