<?php

namespace App\Entity;

use App\Repository\TirageRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TirageRepository::class)]
class Tirage
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $dateTirage = null;

    #[ORM\Column(length: 255)]
    private ?string $status = null;

    #[ORM\ManyToOne(inversedBy: 'tirages')]
    private ?Evenement $evenement = null;

    /**
     * @var Collection<int, Gagnant>
     */
    #[ORM\OneToMany(targetEntity: Gagnant::class, mappedBy: 'tirage')]
    private Collection $gagnants;

    public function __construct()
    {
        $this->gagnants = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDateTirage(): ?\DateTimeInterface
    {
        return $this->dateTirage;
    }

    public function setDateTirage(?\DateTimeInterface $dateTirage): static
    {
        $this->dateTirage = $dateTirage;

        return $this;
    }

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(string $status): static
    {
        $this->status = $status;

        return $this;
    }

    public function getEvenement(): ?Evenement
    {
        return $this->evenement;
    }

    public function setEvenement(?Evenement $evenement): static
    {
        $this->evenement = $evenement;

        return $this;
    }

    /**
     * @return Collection<int, Gagnant>
     */
    public function getGagnants(): Collection
    {
        return $this->gagnants;
    }

    public function addGagnant(Gagnant $gagnant): static
    {
        if (!$this->gagnants->contains($gagnant)) {
            $this->gagnants->add($gagnant);
            $gagnant->setTirage($this);
        }

        return $this;
    }

    public function removeGagnant(Gagnant $gagnant): static
    {
        if ($this->gagnants->removeElement($gagnant)) {
            // set the owning side to null (unless already changed)
            if ($gagnant->getTirage() === $this) {
                $gagnant->setTirage(null);
            }
        }

        return $this;
    }
}
