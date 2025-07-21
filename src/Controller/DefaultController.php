<?php

namespace App\Controller;

use App\Entity\Trajets;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\TrajetsRepository;
use App\Repository\FeedbackRepository;

class DefaultController extends AbstractController
{
    private $feedbackRepository;

    public function __construct(FeedbackRepository $feedbackRepository)
    {
        $this->feedbackRepository = $feedbackRepository;
    }

    #[Route('/')]
    public function home(): Response
    {
        // Contenu de la page d'accueil
        return $this->render('default/home.html.twig');
    }
    #[Route('/feedback', methods: ['GET'])]
    public function approved(FeedbackRepository $feedbackRepository): Response
    {
        $approvedFeedbacks = $feedbackRepository->findApprovedFeedbacks();
        return $this->render('default/feedback.html.twig', [
            'feedbacks' => $approvedFeedbacks,
        ]);
    }
    #[Route('/contact')]
    public function contact(): Response
    {
        // Contenu de la page d'accueil
        return $this->render('default/contact.html.twig');
    }
    #[Route('/services')]
    public function services(): Response
    {
        // Contenu de la page d'accueil
        return $this->render('default/services.html.twig');
    }
    #[Route('/trajets', name: 'trajets')]
    public function trajets(TrajetsRepository $trajetsRepository): Response
    {
        // Récupérer la liste des trajets depuis le repository
        $trajets = $trajetsRepository->findAll();

        // Passer la liste des trajets au modèle Twig pour affichage
        return $this->render('default/trajets.html.twig', [
            'trajets' => $trajets,
    ]);
    }

}