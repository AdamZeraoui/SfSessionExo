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
    #[ORM\OneToMany(targetEntity: Modul::class, mappedBy: 'categories')]
    private Collection $moduls;

    public function __construct()
    {
        $this->moduls = new ArrayCollection();
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
        return $this->moduls;
    }

    public function addModul(Modul $moduls): static
    {
        if (!$this->moduls->contains($moduls)) {
            $this->moduls->add($moduls);
            $moduls->setCategories($this);
        }

        return $this;
    }

    public function removeModul(Modul $moduls): static
    {
        if ($this->moduls->removeElement($moduls)) {
            // set the owning side to null (unless already changed)
            if ($moduls->getCategories() === $this) {
                $moduls->setCategories(null);
            }
        }

        return $this;
    }
}
