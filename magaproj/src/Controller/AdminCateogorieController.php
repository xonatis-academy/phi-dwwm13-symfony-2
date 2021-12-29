<?php

namespace App\Controller;

use App\Entity\Categorie;
use App\Form\CategorieType;
use App\Repository\CategorieRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin/cateogorie")
 */
class AdminCateogorieController extends AbstractController
{
    /**
     * @Route("/", name="admin_cateogorie_index", methods={"GET"})
     */
    public function index(CategorieRepository $categorieRepository): Response
    {
        return $this->render('admin_cateogorie/index.html.twig', [
            'categories' => $categorieRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="admin_cateogorie_new", methods={"GET", "POST"})
     */
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $categorie = new Categorie(); // on instantie une catégorie (entité) - pour le remplir
        $bonhomme = $this->createForm(CategorieType::class, $categorie); // on crée un bonhomme à partir d'un type et de l'entité 
        // - pour produire le formulaire à afficher et remplir l'entité à partir du formulaire
        $bonhomme->handleRequest($request); // on va chercher des données dans la request - pour remplir l'entité

        if ($bonhomme->isSubmitted() && $bonhomme->isValid()) { // si l'entité a été rempli et est valide - pour déterminer s
            // 'il faut enregistrer l'entité en bdd ou si il faut afficher le formulaire

            $entityManager->persist($categorie); // on demande à l'entité manager de préparer l'envoi de l'entité en bdd - pour la sauvegarder
            $entityManager->flush(); // on donne le coup d'envoi à l'entity manager

            return $this->redirectToRoute('admin_cateogorie_index', [], Response::HTTP_SEE_OTHER); // on redirige le visiteur vers la page
            // de la liste des categories
        } // si l'entité n'a pas été remplie ou n'est pas valide

        return $this->renderForm('admin_cateogorie/new.html.twig', [ // on affiche la page TWIG 'admin_cateogorie/new.html.twig'
            // - pour afficher le formulaire
            'categorie' => $categorie, // en donnant à TWIG l'entité sous le nom categorie
            'form' => $bonhomme, // en donnant à TWIG le bonhomme sous le nom form
        ]);
    }

    /**
     * @Route("/{id}", name="admin_cateogorie_show", methods={"GET"})
     */
    public function show(Categorie $categorie): Response
    {
        return $this->render('admin_cateogorie/show.html.twig', [
            'categorie' => $categorie,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="admin_cateogorie_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Categorie $categorie, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(CategorieType::class, $categorie);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('admin_cateogorie_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin_cateogorie/edit.html.twig', [
            'categorie' => $categorie,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="admin_cateogorie_delete", methods={"POST"})
     */
    public function delete(Request $request, Categorie $categorie, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$categorie->getId(), $request->request->get('_token'))) {
            $entityManager->remove($categorie);
            $entityManager->flush();
        }

        return $this->redirectToRoute('admin_cateogorie_index', [], Response::HTTP_SEE_OTHER);
    }
}
