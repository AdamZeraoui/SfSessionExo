<?php

namespace App\Entity;

use App\Repository\ProgrammRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ProgrammRepository::class)]
class Programm
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $nombreJour = null;

    #[ORM\ManyToOne(inversedBy: 'programms')]
    private ?Session $session = null;

    #[ORM\ManyToOne(inversedBy: 'programms')]
    private ?Modul $modul = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNombreJour(): ?int
    {
        return $this->nombreJour;
    }

    public function setNombreJour(int $nombreJour): static
    {
        $this->nombreJour = $nombreJour;

        return $this;
    }

    public function getSession(): ?Session
    {
        return $this->session;
    }

    public function setSession(?Session $session): static
    {
        $this->session = $session;

        return $this;
    }

    public function getModul(): ?Modul
    {
        return $this->modul;
    }

    public function setModul(?Modul $modul): static
    {
        $this->modul = $modul;

        return $this;
    }
}
