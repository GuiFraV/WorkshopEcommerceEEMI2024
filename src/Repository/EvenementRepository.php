<?php

namespace App\Repository;

use App\Entity\Evenement;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Evenement>
 */
// src/Repository/EvenementRepository.php

class EvenementRepository extends ServiceEntityRepository
{
    public function getParticipantsForEvenement(Evenement $evenement)
    {
        return $this->createQueryBuilder('e')
            ->select('p')
            ->from('App\Entity\Participant', 'p')
            ->join('App\Entity\Inscription', 'i', 'WITH', 'i.participant = p.id')
            ->where('i.evenement = :evenement')
            ->setParameter('evenement', $evenement)
            ->getQuery()
            ->getResult();
    }
}
