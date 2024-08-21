<?php

namespace App\Entity;

use App\Repository\ModulRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ModulRepository::class)]
class Modul
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    private ?string $nomModul = null;

    #[ORM\ManyToOne(inversedBy: 'modul')]
    private ?Categorie $categories = null;

    /**
     * @var Collection<int, Programm>
     */
    #[ORM\OneToMany(targetEntity: Programm::class, mappedBy: 'modul')]
    private Collection $programms;

    public function __construct()
    {
        $this->programms = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomModul(): ?string
    {
        return $this->nomModul;
    }

    public function setNomModul(string $nomModul): static
    {
        $this->nomModul = $nomModul;

        return $this;
    }

    public function getCategories(): ?Categorie
    {
        return $this->categories;
    }

    public function setCategories(?Categorie $categories): static
    {
        $this->categories = $categories;

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
            $programm->setModul($this);
        }

        return $this;
    }

    public function removeProgramm(Programm $programm): static
    {
        if ($this->programms->removeElement($programm)) {
            // set the owning side to null (unless already changed)
            if ($programm->getModul() === $this) {
                $programm->setModul(null);
            }
        }

        return $this;
    }
}
