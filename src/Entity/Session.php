<?php

namespace App\Entity;

use App\Repository\SessionRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SessionRepository::class)]
class Session
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 100)]
    private ?string $intituleSession = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $dateDebut = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $dateFin = null;

    #[ORM\Column]
    private ?int $nombrePlace = null;

    #[ORM\Column]
    private ?int $nombrePlaceRes = null;

    /**
     * @var Collection<int, Stagiaire>
     */
    #[ORM\ManyToMany(targetEntity: Stagiaire::class, inversedBy: 'sessions')]
    private Collection $stagiaire;

    /**
     * @var Collection<int, Programm>
     */
    #[ORM\OneToMany(targetEntity: Programm::class, mappedBy: 'session')]
    private Collection $programms;

    public function __construct()
    {
        $this->stagiaire = new ArrayCollection();
        $this->programms = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIntituleSession(): ?string
    {
        return $this->intituleSession;
    }

    public function setIntituleSession(string $intituleSession): static
    {
        $this->intituleSession = $intituleSession;

        return $this;
    }

    public function getDateDebut(): ?\DateTimeInterface
    {
        return $this->dateDebut;
    }

    public function setDateDebut(\DateTimeInterface $dateDebut): static
    {
        $this->dateDebut = $dateDebut;

        return $this;
    }

    public function getDateFin(): ?\DateTimeInterface
    {
        return $this->dateFin;
    }

    public function setDateFin(\DateTimeInterface $dateFin): static
    {
        $this->dateFin = $dateFin;

        return $this;
    }

    public function getNombrePlace(): ?int
    {
        return $this->nombrePlace;
    }

    public function setNombrePlace(int $nombrePlace): static
    {
        $this->nombrePlace = $nombrePlace;

        return $this;
    }

    public function getNombrePlaceRes(): ?int
    {
        return $this->nombrePlaceRes;
    }

    public function setNombrePlaceRes(int $nombrePlaceRes): static
    {
        $this->nombrePlaceRes = $nombrePlaceRes;

        return $this;
    }

    /**
     * @return Collection<int, Stagiaire>
     */
    public function getStagiaire(): Collection
    {
        return $this->stagiaire;
    }

    public function addStagiaire(Stagiaire $stagiaire): static
    {
        if (!$this->stagiaire->contains($stagiaire)) {
            $this->stagiaire->add($stagiaire);
        }

        return $this;
    }

    public function removeStagiaire(Stagiaire $stagiaire): static
    {
        $this->stagiaire->removeElement($stagiaire);

        return $this;
    }

    /**
     * @return Collection<int, Programm>
     */
    public function getProgramms(): Collection
    {
        return $this->programms;
    }

    public function addProgramm(Programm $programm): static
    {
        if (!$this->programms->contains($programm)) {
            $this->programms->add($programm);
            $programm->setSession($this);
        }

        return $this;
    }

    public function removeProgramm(Programm $programm): static
    {
        if ($this->programms->removeElement($programm)) {
            // set the owning side to null (unless already changed)
            if ($programm->getSession() === $this) {
                $programm->setSession(null);
            }
        }

        return $this;
    }
}
