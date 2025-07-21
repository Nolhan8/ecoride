<?php

namespace App\Controller;

use App\Entity\Trajets;
use App\Repository\TrajetsRepository;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;

#[Route('/api/trajets', name: 'api_trajets_')]
class TrajetsController extends AbstractController
{
    private ManagerRegistry $managerRegistry;
    private EntityManagerInterface $entityManager;

    public function __construct(ManagerRegistry $managerRegistry, EntityManagerInterface $entityManager)
    {
        $this->managerRegistry = $managerRegistry;
        $this->entityManager = $entityManager;
    }

    #[Route('', name: 'trajets_index', methods: ['GET'])]
    #[Security('is_granted("ROLE_ADMIN")')]
    public function index(TrajetsRepository $trajetsRepository): JsonResponse
    {
        $trajets = $trajetsRepository->findAll();
        $trajetData = [];

        foreach ($trajets as $trajet) {
            $trajetData[] = [
                'id' => $trajet->getId(),
                'driver' => $trajet->getDriver(),
                'price' => $trajet->getPrice(),
                'depart' => $trajet->getDepart(),
                'destination' => $trajet->getDestination(),
            ];
        }

        return new JsonResponse($trajetData, JsonResponse::HTTP_OK);
    }

    #[Route('', name: 'trajets_new', methods: ['POST'])]
    #[Security('is_granted("ROLE_ADMIN")')]
    public function new(Request $request, SluggerInterface $slugger): JsonResponse
    {
        $data = json_decode($request->getContent(), true);
        $trajet = new Trajets();
        $trajet->setDriver($data['driver']);
        $trajet->setPrice($data['price']);
        $trajet->setDepart($data['depart']);
        $trajet->setDestination($data['destination']);

        $this->entityManager->persist($trajet);
        $this->entityManager->flush();

        return new JsonResponse(['message' => 'Nouveau trajet créé'], JsonResponse::HTTP_CREATED);
    }

    #[Route('/{id}', name: 'trajets_show', methods: ['GET'])]
    #[Security('is_granted("ROLE_ADMIN")')]
    public function show(int $id, TrajetsRepository $trajetsRepository): JsonResponse
    {
        $trajet = $trajetsRepository->find($id);

        if (!$trajet) {
            return new JsonResponse(['error' => 'Trajet non trouvé'], JsonResponse::HTTP_NOT_FOUND);
        }

        return new JsonResponse([
            'id' => $trajet->getId(),
            'driver' => $trajet->getDriver(),
            'price' => $trajet->getPrice(),
            'depart' => $trajet->getDepart(),
            'destination' => $trajet->getDestination(),
        ]);
    }

    #[Route('/{id}', name: 'trajets_edit', methods: ['PUT'])]
    #[Security('is_granted("ROLE_ADMIN")')]
    public function edit(int $id, Request $request, TrajetsRepository $trajetsRepository): JsonResponse
    {
        $trajet = $trajetsRepository->find($id);

        if (!$trajet) {
            return new JsonResponse(['error' => 'Trajet non trouvé'], JsonResponse::HTTP_NOT_FOUND);
        }

        $data = json_decode($request->getContent(), true);

        if (isset($data['driver'])) {
            $trajet->setDriver($data['driver']);
        }
        if (isset($data['price'])) {
            $trajet->setPrice($data['price']);
        }
        if (isset($data['depart'])) {
            $trajet->setDepart($data['depart']);
        }
        if (isset($data['destination'])) {
            $trajet->setDestination($data['destination']);
        }

        $this->entityManager->flush();

        return new JsonResponse(['message' => 'Trajet modifié'], JsonResponse::HTTP_OK);
    }

    #[Route('/{id}', name: 'trajets_delete', methods: ['DELETE'])]
    #[Security('is_granted("ROLE_ADMIN")')]
    public function delete(int $id, TrajetsRepository $trajetsRepository): JsonResponse
    {
        $trajet = $trajetsRepository->find($id);

        if (!$trajet) {
            return new JsonResponse(['error' => 'Trajet non trouvé'], JsonResponse::HTTP_NOT_FOUND);
        }

        $this->entityManager->remove($trajet);
        $this->entityManager->flush();

        return new JsonResponse(['message' => 'Trajet supprimé'], JsonResponse::HTTP_OK);
    }

    // 🔎 NOUVELLE ROUTE DE FILTRAGE
    #[Route('/filter', name: 'trajets_filter', methods: ['GET'])]
    public function filter(Request $request, TrajetsRepository $trajetsRepository): JsonResponse
    {
        $depart = $request->query->get('depart');
        $destination = $request->query->get('destination');

        $trajets = $trajetsRepository->findByDepartEtDestination($depart, $destination);

        $trajetData = [];
        foreach ($trajets as $trajet) {
            $trajetData[] = [
                'id' => $trajet->getId(),
                'driver' => $trajet->getDriver(),
                'price' => $trajet->getPrice(),
                'depart' => $trajet->getDepart(),
                'destination' => $trajet->getDestination(),
            ];
        }

        return new JsonResponse($trajetData, JsonResponse::HTTP_OK);
    }
}
