<?php

namespace App\Controller;

use App\Entity\Production;
use App\Form\ProductionType;
use App\Repository\ProductionRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin/production")
 */
class AdminProductionController extends AbstractController
{
    /**
     * @Route("/", name="admin_production_index", methods={"GET"})
     */
    public function index(ProductionRepository $productionRepository): Response
    {
        return $this->render('admin_production/index.html.twig', [
            'productions' => $productionRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="admin_production_new", methods={"GET", "POST"})
     */
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $production = new Production();
        $form = $this->createForm(ProductionType::class, $production);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($production);
            $entityManager->flush();

            return $this->redirectToRoute('admin_production_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin_production/new.html.twig', [
            'production' => $production,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="admin_production_show", methods={"GET"})
     */
    public function show(Production $production): Response
    {
        return $this->render('admin_production/show.html.twig', [
            'production' => $production,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="admin_production_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Production $production, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(ProductionType::class, $production);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('admin_production_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin_production/edit.html.twig', [
            'production' => $production,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="admin_production_delete", methods={"POST"})
     */
    public function delete(Request $request, Production $production, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$production->getId(), $request->request->get('_token'))) {
            $entityManager->remove($production);
            $entityManager->flush();
        }

        return $this->redirectToRoute('admin_production_index', [], Response::HTTP_SEE_OTHER);
    }
}
