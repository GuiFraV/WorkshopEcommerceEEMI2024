<?php

namespace App\Entity;

use App\Repository\GagnantRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: GagnantRepository::class)]
class Gagnant
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $rang = null;

    #[ORM\ManyToOne(inversedBy: 'gagnants')]
    private ?Tirage $tirage = null;

    #[ORM\ManyToOne(inversedBy: 'gagnants')]
    private ?Participant $participant = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getRang(): ?int
    {
        return $this->rang;
    }

    public function setRang(int $rang): static
    {
        $this->rang = $rang;

        return $this;
    }

    public function getTirage(): ?Tirage
    {
        return $this->tirage;
    }

    public function setTirage(?Tirage $tirage): static
    {
        $this->tirage = $tirage;

        return $this;
    }

    public function getParticipant(): ?Participant
    {
        return $this->participant;
    }

    public function setParticipant(?Participant $participant): static
    {
        $this->participant = $participant;

        return $this;
    }
}
