<?php

namespace App\Controller;

use App\Entity\Evenement;
use App\Entity\Tirage;
use App\Repository\EvenementRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
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
            $this->addFlash('error', 'Aucun participant pour cet événement.');
            return $this->redirectToRoute('evenement_show', ['id' => $evenement->getId()]);
        }

        shuffle($participants);
        $gagnant = $participants[0];

        $tirage = new Tirage();
        $tirage->setEvenement($evenement);
        $tirage->addGagnant($gagnant);
        $tirage->setDateTirage(new \DateTime());

        $entityManager->persist($tirage);
        $entityManager->flush();

        $this->addFlash('success', 'Le tirage au sort a été effectué avec succès !');

        return $this->redirectToRoute('evenement_show', ['id' => $evenement->getId()]);
    }
}
