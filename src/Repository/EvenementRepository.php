<?php

namespace App\Repository;

use App\Entity\Evenement;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class EvenementRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Evenement::class);
    }

    public function getParticipantsForEvenement(Evenement $evenement)
    {
        return $this->createQueryBuilder('e')
            ->innerJoin('e.inscriptions', 'i')
            ->innerJoin('i.participant', 'p')
            ->addSelect('i', 'p')
            ->where('e.id = :evenement')
            ->setParameter('evenement', $evenement->getId())
            ->getQuery()
            ->getResult();
    }
}