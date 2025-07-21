<?php

namespace App\Controller;

use App\Entity\Trajets;
use App\Repository\TrajetsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Doctrine\ORM\EntityManagerInterface;

class DashboardController extends AbstractController
{
    #[Route('/dashboard', name: 'user_dashboard')]
    public function index(): Response
    {
        return $this->render('user/dashboard.html.twig');
    }
}
