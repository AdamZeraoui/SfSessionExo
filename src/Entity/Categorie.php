<?php

namespace App\Entity;

use App\Repository\CategorieRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CategorieRepository::class)]
class Categorie
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    private ?string $nomCategorie = null;

    /**
     * @var Collection<int, Modul>
     */
    #[ORM\OneToMany(targetEntity: Modul::class, mappedBy: 'categorie')]
    private Collection $modul;

    public function __construct()
    {
        $this->modul = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomCategorie(): ?string
    {
        return $this->nomCategorie;
    }

    public function setNomCategorie(string $nomCategorie): static
    {
        $this->nomCategorie = $nomCategorie;

        return $this;
    }

    /**
     * @return Collection<int, Modul>
     */
    public function getModul(): Collection
    {
        return $this->modul;
    }

    public function addModul(Modul $modul): static
    {
        if (!$this->modul->contains($modul)) {
            $this->modul->add($modul);
            $modul->setCategorie($this);
        }

        return $this;
    }

    public function removeModul(Modul $modul): static
    {
        if ($this->modul->removeElement($modul)) {
            // set the owning side to null (unless already changed)
            if ($modul->getCategorie() === $this) {
                $modul->setCategorie(null);
            }
        }

        return $this;
    }
}
