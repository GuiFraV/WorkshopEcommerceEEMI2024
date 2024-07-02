<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
class Gagnant
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private ?int $id = null;

    #[ORM\ManyToOne(targetEntity: Participant::class)]
    private ?Participant $participant = null;

    #[ORM\ManyToOne(targetEntity: Tirage::class, inversedBy: 'gagnants')]
    private ?Tirage $tirage = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getParticipant(): ?Participant
    {
        return $this->participant;
    }

    public function setParticipant(?Participant $participant): self
    {
        $this->participant = $participant;

        return $this;
    }

    public function getTirage(): ?Tirage
    {
        return $this->tirage;
    }

    public function setTirage(?Tirage $tirage): self
    {
        $this->tirage = $tirage;

        return $this;
    }
}
