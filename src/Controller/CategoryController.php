<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
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

        if (!$programs) {
            throw $this->createNotFoundException(
                "Aucune série trouvée dans la catégorie".$categoryName
            );
        }
        return $this->render('category/show.html.twig', ['programs' => $programs,'category' => $category,]);
    }

}



