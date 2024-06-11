<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Repository\ProgramRepository;
use App\Repository\SeasonRepository;

#[Route('/program', name: 'program_')]
class ProgramController extends AbstractController
{
    #[Route('/', name: 'index')]
    public function index(ProgramRepository $programRepository): Response
    {
        $programs = $programRepository->findAll();
        // récupération de la liste des séries
        return $this->render('program/index.html.twig', ['programs' => $programs,]);
    }

    #[Route('/{id<^[0-9]+$>}', requirements: ['id'=>'\d+'], methods: ['GET'], name: 'show')]
    public function show(int $id, ProgramRepository $programRepository):Response
    {
        $program = $programRepository->findOneBy(['id' => $id]);
        // récupération d'une série par son id

        if (!$program) {
            throw $this->createNotFoundException(
                "Il n'existe aucune série correspondant à l' id : ".$id
            );
        }
        return $this->render('program/show.html.twig', ['program' => $program,]);
    }

    #[Route('/{programId}/season/{seasonId}', requirements: ['programId'=>'\d+'], methods: ['GET'], name: 'season_show')]
    public function showSeason(int $programId, int $seasonId, SeasonRepository $seasonRepository, ProgramRepository $programRepository):Response
    {
        $seasons = $seasonRepository->findOneBy(['id' => $seasonId]);

        return $this->render('program/season_show.html.twig', ['seasons' => $seasons,]);
    }
}
