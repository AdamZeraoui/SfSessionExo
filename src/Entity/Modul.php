<?php

namespace App\Entity;

use App\Repository\ModulRepository;
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
    private ?Categorie $categorie = null;

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

    public function getCategorie(): ?Categorie
    {
        return $this->categorie;
    }

    public function setCategorie(?Categorie $categorie): static
    {
        $this->categorie = $categorie;

        return $this;
    }
}
