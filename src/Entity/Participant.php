<?php

namespace App\Entity;

use App\Repository\ParticipantRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ParticipantRepository::class)]
class Participant
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nom = null;

    #[ORM\Column(length: 255)]
    private ?string $prenom = null;

    #[ORM\Column(length: 255)]
    private ?string $email = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $dateInscription = null;

    #[ORM\Column(nullable: true)]
    private ?bool $consentementRGPD = null;

    /**
     * @var Collection<int, Inscription>
     */
    #[ORM\OneToMany(targetEntity: Inscription::class, mappedBy: 'participant')]
    private Collection $inscriptions;

    /**
     * @var Collection<int, Gagnant>
     */
    #[ORM\OneToMany(targetEntity: Gagnant::class, mappedBy: 'participant')]
    private Collection $gagnants;

    public function __construct()
    {
        $this->inscriptions = new ArrayCollection();
        $this->gagnants = new ArrayCollection();
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

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): static
    {
        $this->prenom = $prenom;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): static
    {
        $this->email = $email;

        return $this;
    }

    public function getDateInscription(): ?\DateTimeInterface
    {
        return $this->dateInscription;
    }

    public function setDateInscription(\DateTimeInterface $dateInscription): static
    {
        $this->dateInscription = $dateInscription;

        return $this;
    }

    public function isConsentementRGPD(): ?bool
    {
        return $this->consentementRGPD;
    }

    public function setConsentementRGPD(?bool $consentementRGPD): static
    {
        $this->consentementRGPD = $consentementRGPD;

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
            $inscription->setParticipant($this);
        }

        return $this;
    }

    public function removeInscription(Inscription $inscription): static
    {
        if ($this->inscriptions->removeElement($inscription)) {
            // set the owning side to null (unless already changed)
            if ($inscription->getParticipant() === $this) {
                $inscription->setParticipant(null);
            }
        }

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
            $gagnant->setParticipant($this);
        }

        return $this;
    }

    public function removeGagnant(Gagnant $gagnant): static
    {
        if ($this->gagnants->removeElement($gagnant)) {
            // set the owning side to null (unless already changed)
            if ($gagnant->getParticipant() === $this) {
                $gagnant->setParticipant(null);
            }
        }

        return $this;
    }
}
