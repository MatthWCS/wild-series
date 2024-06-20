<?php

namespace App\Controller;

use App\Form\ProgramType;
use App\Service\ProgramDuration;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;
use App\Repository\ProgramRepository;
use App\Repository\SeasonRepository;
use App\Entity\Program;
use App\Entity\Season;
use App\Entity\Episode;
use Symfony\Component\String\Slugger\SluggerInterface;
use Symfony\Bridge\Doctrine\Attribute\MapEntity;

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

    #[Route('/new', name: 'new')]
    public function new(Request $request, EntityManagerInterface $entityManager, SluggerInterface $slugger): Response
    {
        $program = new Program();
        // Création du formulaire
        $form = $this->createForm(ProgramType::class, $program);
        // Récupère la data lors de la requête
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $slug = $slugger->slug($program->getTitle());
            $program->setSlug($slug);

            $entityManager->persist($program);
            $entityManager->flush();

            // Quand le formulaire est soumis, validé et les données insérées dans la DB , définit le message flash suivant
            $this->addFlash('success', 'The new series has been created.');

            // Redirection vers la liste des séries une fois le formulaire soumis
            return $this->redirectToRoute('program_index');
        }

        // Render du form
        return $this->render('program/new.html.twig', ['form' => $form]);
    }

    #[Route('/{slug}', name: 'show', requirements: ['id'=>'\d+'], methods: ['GET'])]
    public function show(Program $program, ProgramDuration $programDuration):Response
    {
        //$program = $programRepository->findOneBy(['id' => $id]);
        // récupération d'une série par son id

        if (!$program) {
            throw $this->createNotFoundException(
                "Il n'existe aucune série correspondant à " . $program['slug']
            );
        }
        return $this->render('program/show.html.twig', ['program' => $program, 'programDuration' => $programDuration->calculate($program)], );
    }

    #[Route('/{slug}/season/{season}', name: 'season_show', requirements: ['programId'=>'\d+'], methods: ['GET'])]
    public function showSeason( Program $program, Season $season,):Response
    {
        // $seasons = $seasonRepository->findOneBy(['id' => $seasonId]);

        return $this->render('program/season_show.html.twig', ['seasons' => $season,'program' => $program]);
    }

    #[Route('/{program_slug}/season/{season}/episode/{episode_slug}', name: 'season_episode_show_', requirements: ['programId'=>'\d+'], methods: ['GET'])]
    public function showEpisode(#[MapEntity(mapping: ['program_slug' => 'slug'])] Program $program,Season $season,#[MapEntity(mapping: ['episode_slug' => 'slug'])] Episode $episode, ):Response
    {
        return $this->render('program/episode_show.html.twig', ['program' => $program, 'season' => $season, 'episode' => $episode,]);
    }

    #[Route('/{slug}/delete', name: 'delete')]
    public function delete(Request $request, Program $program, EntityManagerInterface $entityManager): Response
    {
        $entityManager->remove($program);
        $entityManager->flush();

        $this->addFlash('danger', 'The series has been deleted.');

        return $this->redirectToRoute('program_index', [], Response::HTTP_SEE_OTHER);
    }
}
