<?php

namespace App\Controller;

use App\Entity\Evenement;
use App\Entity\Tirage;
use App\Entity\Gagnant;
use App\Repository\EvenementRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TirageController extends AbstractController
{
    #[Route('/evenement/{id}/tirage', name: 'evenement_tirage')]
    public function tirage(
        Evenement $evenement, 
        EvenementRepository $evenementRepository,
        EntityManagerInterface $entityManager
    ): Response {
        $participants = $evenementRepository->getParticipantsForEvenement($evenement);

        if (empty($participants)) {
            return new JsonResponse(['message' => 'Aucun participant pour cet événement.'], Response::HTTP_NOT_FOUND);
        }

        shuffle($participants);
        $gagnants = array_slice($participants, 0, 10);

        $tirage = new Tirage();
        $tirage->setEvenement($evenement);
        $tirage->setDateTirage(new \DateTime());
        $tirage->setStatus('completed');

        $entityManager->persist($tirage);

        foreach ($gagnants as $participant) {
            $gagnant = new Gagnant();
            $gagnant->setParticipant($participant);
            $gagnant->setTirage($tirage);

            $entityManager->persist($gagnant);
            $tirage->addGagnant($gagnant);
        }

        $entityManager->flush();

        return new JsonResponse(['message' => 'Le tirage au sort a été effectué avec succès !', 'gagnants' => $gagnants], Response::HTTP_OK);
    }
}
