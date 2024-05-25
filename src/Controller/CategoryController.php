<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Repository\CategoryRepository;
use App\Entity\Category;

#[Route('/category', name: 'category_')]
class CategoryController extends AbstractController
{
    #[Route('/', name: 'index')]
    public function index(CategoryRepository $categoryRepository): Response
    {
        $categories = $categoryRepository->findAll();

        return $this->render('category/index.html.twig', ['categories' => $categories]);
    }

    #[Route('/show/{categoryName}', requirements: ['id'=>'\d+'], methods: ['GET'], name: 'show')]
    public function show(string $categoryName, CategoryRepository $categoryRepository): Response
    {
        $category = $categoryRepository->findBy(['categoryName' => $categoryName, 'programId' => 'DESC'],3,0);


        if (!$category) {
            throw $this->createNotFoundException(
                'No program with categoryName : '.$categoryName.' found in program\'s table.'
            );
        }
        return $this->render('category/show.html.twig', ['category' => $category,]);
    }

}



