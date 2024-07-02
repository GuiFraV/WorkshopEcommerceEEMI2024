<?php

namespace App\Controller;

use App\Entity\Participant;
use App\Repository\ParticipantRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

#[Route('/api/participants')]
class ParticipantController extends AbstractController
{
    public function __construct(
        private EntityManagerInterface $entityManager,
        private ParticipantRepository $participantRepository,
        private SerializerInterface $serializer,
        private ValidatorInterface $validator
    ) {}

    #[Route('', name: 'participant_list', methods: ['GET'])]
    public function list(): JsonResponse
    {
        $participants = $this->participantRepository->findAll();
        $json = $this->serializer->serialize($participants, 'json');
        return new JsonResponse($json, Response::HTTP_OK, [], true);
    }

    #[Route('/{id}', name: 'participant_show', methods: ['GET'])]
    public function show(int $id): JsonResponse
    {
        $participant = $this->participantRepository->find($id);
        if (!$participant) {
            return new JsonResponse(['message' => 'Participant not found'], Response::HTTP_NOT_FOUND);
        }
        $json = $this->serializer->serialize($participant, 'json');
        return new JsonResponse($json, Response::HTTP_OK, [], true);
    }

    #[Route('', name: 'participant_create', methods: ['POST'])]
    public function create(Request $request): JsonResponse
    {
        $data = json_decode($request->getContent(), true);
        $participant = $this->serializer->deserialize(json_encode($data), Participant::class, 'json');

        $errors = $this->validator->validate($participant);
        if (count($errors) > 0) {
            return new JsonResponse((string) $errors, Response::HTTP_BAD_REQUEST);
        }

        $this->entityManager->persist($participant);
        $this->entityManager->flush();

        $json = $this->serializer->serialize($participant, 'json');
        return new JsonResponse($json, Response::HTTP_CREATED, [], true);
    }

    #[Route('/{id}', name: 'participant_update', methods: ['PUT'])]
    public function update(Request $request, int $id): JsonResponse
    {
        $participant = $this->participantRepository->find($id);
        if (!$participant) {
            return new JsonResponse(['message' => 'Participant not found'], Response::HTTP_NOT_FOUND);
        }

        $data = json_decode($request->getContent(), true);
        $this->serializer->deserialize(json_encode($data), Participant::class, 'json', ['object_to_populate' => $participant]);

        $errors = $this->validator->validate($participant);
        if (count($errors) > 0) {
            return new JsonResponse((string) $errors, Response::HTTP_BAD_REQUEST);
        }

        $this->entityManager->flush();

        $json = $this->serializer->serialize($participant, 'json');
        return new JsonResponse($json, Response::HTTP_OK, [], true);
    }

    #[Route('/{id}', name: 'participant_delete', methods: ['DELETE'])]
    public function delete(int $id): JsonResponse
    {
        $participant = $this->participantRepository->find($id);
        if (!$participant) {
            return new JsonResponse(['message' => 'Participant not found'], Response::HTTP_NOT_FOUND);
        }

        $this->entityManager->remove($participant);
        $this->entityManager->flush();

        return new JsonResponse(null, Response::HTTP_NO_CONTENT);
    }
}
