<?php

namespace App\Entity;

use App\Repository\EvenementRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EvenementRepository::class)]
class Evenement
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nom = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $description = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $dateDebut = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $dateFin = null;

    #[ORM\Column(nullable: true)]
    private ?int $nombreGagnants = null;

    /**
     * @var Collection<int, Inscription>
     */
    #[ORM\OneToMany(targetEntity: Inscription::class, mappedBy: 'evenement')]
    private Collection $inscriptions;

    /**
     * @var Collection<int, Tirage>
     */
    #[ORM\OneToMany(targetEntity: Tirage::class, mappedBy: 'evenement')]
    private Collection $tirages;

    public function __construct()
    {
        $this->inscriptions = new ArrayCollection();
        $this->tirages = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): static
    {
        $this->nom = $nom;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getDateDebut(): ?\DateTimeInterface
    {
        return $this->dateDebut;
    }

    public function setDateDebut(?\DateTimeInterface $dateDebut): static
    {
        $this->dateDebut = $dateDebut;

        return $this;
    }

    public function getDateFin(): ?\DateTimeInterface
    {
        return $this->dateFin;
    }

    public function setDateFin(?\DateTimeInterface $dateFin): static
    {
        $this->dateFin = $dateFin;

        return $this;
    }

    public function getNombreGagnants(): ?int
    {
        return $this->nombreGagnants;
    }

    public function setNombreGagnants(?int $nombreGagnants): static
    {
        $this->nombreGagnants = $nombreGagnants;

        return $this;
    }

    /**
     * @return Collection<int, Inscription>
     */
    public function getInscriptions(): Collection
    {
        return $this->inscriptions;
    }

    public function addInscription(Inscription $inscription): static
    {
        if (!$this->inscriptions->contains($inscription)) {
            $this->inscriptions->add($inscription);
            $inscription->setEvenement($this);
        }

        return $this;
    }

    public function removeInscription(Inscription $inscription): static
    {
        if ($this->inscriptions->removeElement($inscription)) {
            // set the owning side to null (unless already changed)
            if ($inscription->getEvenement() === $this) {
                $inscription->setEvenement(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Tirage>
     */
    public function getTirages(): Collection
    {
        return $this->tirages;
    }

    public function addTirage(Tirage $tirage): static
    {
        if (!$this->tirages->contains($tirage)) {
            $this->tirages->add($tirage);
            $tirage->setEvenement($this);
        }

        return $this;
    }

    public function removeTirage(Tirage $tirage): static
    {
        if ($this->tirages->removeElement($tirage)) {
            // set the owning side to null (unless already changed)
            if ($tirage->getEvenement() === $this) {
                $tirage->setEvenement(null);
            }
        }

        return $this;
    }
}
