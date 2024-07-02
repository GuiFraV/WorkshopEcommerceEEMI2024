<?php

namespace App\Controller;

use App\Entity\Evenement;
use App\Repository\EvenementRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

#[Route('/api/evenements')]
class EvenementController extends AbstractController
{
    public function __construct(
        private EntityManagerInterface $entityManager,
        private EvenementRepository $evenementRepository,
        private SerializerInterface $serializer,
        private ValidatorInterface $validator
    ) {}

    #[Route('', name: 'evenement_list', methods: ['GET'])]
    public function list(): JsonResponse
    {
        $evenements = $this->evenementRepository->findAll();
        $json = $this->serializer->serialize($evenements, 'json');
        return new JsonResponse($json, Response::HTTP_OK, [], true);
    }

    #[Route('/{id}', name: 'evenement_show', methods: ['GET'])]
    public function show(int $id): JsonResponse
    {
        $evenement = $this->evenementRepository->find($id);
        if (!$evenement) {
            return new JsonResponse(['message' => 'Evenement not found'], Response::HTTP_NOT_FOUND);
        }
        $json = $this->serializer->serialize($evenement, 'json');
        return new JsonResponse($json, Response::HTTP_OK, [], true);
    }

    #[Route('', name: 'evenement_create', methods: ['POST'])]
    public function create(Request $request): JsonResponse
    {
        $data = json_decode($request->getContent(), true);
        $evenement = $this->serializer->deserialize(json_encode($data), Evenement::class, 'json');

        $errors = $this->validator->validate($evenement);
        if (count($errors) > 0) {
            return new JsonResponse((string) $errors, Response::HTTP_BAD_REQUEST);
        }

        $this->entityManager->persist($evenement);
        $this->entityManager->flush();

        $json = $this->serializer->serialize($evenement, 'json');
        return new JsonResponse($json, Response::HTTP_CREATED, [], true);
    }

    #[Route('/{id}', name: 'evenement_update', methods: ['PUT'])]
    public function update(Request $request, int $id): JsonResponse
    {
        $evenement = $this->evenementRepository->find($id);
        if (!$evenement) {
            return new JsonResponse(['message' => 'Evenement not found'], Response::HTTP_NOT_FOUND);
        }

        $data = json_decode($request->getContent(), true);
        $this->serializer->deserialize(json_encode($data), Evenement::class, 'json', ['object_to_populate' => $evenement]);

        $errors = $this->validator->validate($evenement);
        if (count($errors) > 0) {
            return new JsonResponse((string) $errors, Response::HTTP_BAD_REQUEST);
        }

        $this->entityManager->flush();

        $json = $this->serializer->serialize($evenement, 'json');
        return new JsonResponse($json, Response::HTTP_OK, [], true);
    }

    #[Route('/{id}', name: 'evenement_delete', methods: ['DELETE'])]
    public function delete(int $id): JsonResponse
    {
        $evenement = $this->evenementRepository->find($id);
        if (!$evenement) {
            return new JsonResponse(['message' => 'Evenement not found'], Response::HTTP_NOT_FOUND);
        }

        $this->entityManager->remove($evenement);
        $this->entityManager->flush();

        return new JsonResponse(null, Response::HTTP_NO_CONTENT);
    }
}
