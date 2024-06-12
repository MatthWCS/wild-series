<?php

namespace App\Controller;

use App\Form\CategoryType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;
use App\Repository\CategoryRepository;
use App\Repository\ProgramRepository;
use App\Entity\Category;
use App\Entity\Program;

#[Route('/category', name: 'category_')]
class CategoryController extends AbstractController
{
    #[Route('/', name: 'index')]
    public function index(CategoryRepository $categoryRepository): Response
    {
        $categories = $categoryRepository->findAll();

        return $this->render('category/index.html.twig', ['categories' => $categories]);
    }

    #[Route('/new', name: 'new')]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $category = new Category();
        // Création du formulaire
        $form = $this->createForm(CategoryType::class, $category);
        // Récupère la data lors de la requête
        $form->handleRequest($request);

        if ($form->isSubmitted()) {
            $entityManager->persist($category);
            $entityManager->flush();
            // Redirection vers la liste des catégories une fois le formulaire soumis
            return $this->redirectToRoute('category_index');
        }
        // Render du form
        return $this->render('category/new.html.twig', ['form' => $form]);
    }

    #[Route('/{categoryName}', name: 'show')]
    public function show(string $categoryName, CategoryRepository $categoryRepository, ProgramRepository $programRepository): Response
    {
        $category = $categoryRepository->findOneBy(['name' => $categoryName]);
        // récupération du nom de la catégorie
        if (!$category) {
            throw $this->createNotFoundException(
                'Aucune catégorie nommée '.$categoryName
            );
        }

        $programs = $programRepository->findBy(['category' => $category], ['id' => 'ASC'], 3);
        // liste de 3 séries d'une catégorie
        if (!$programs) {
            throw $this->createNotFoundException(
                "Aucune série trouvée dans la catégorie".$categoryName
            );
        }
        return $this->render('category/show.html.twig', ['programs' => $programs,'category' => $category,]);
    }

}



