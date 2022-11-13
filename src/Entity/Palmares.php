<?php

namespace App\Entity;

use App\Repository\PalmaresRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PalmaresRepository::class)]
class Palmares
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $nbChampionnat = null;

    #[ORM\Column]
    private ?int $nbCup = null;

    #[ORM\Column]
    private ?int $nbCL = null;

    #[ORM\Column]
    private ?int $nbEL = null;

    #[ORM\OneToOne(inversedBy: 'palmares', cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: false)]
    private ?Equipe $idEquipe = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNbChampionnat(): ?int
    {
        return $this->nbChampionnat;
    }

    public function setNbChampionnat(int $nbChampionnat): self
    {
        $this->nbChampionnat = $nbChampionnat;

        return $this;
    }

    public function getNbCup(): ?int
    {
        return $this->nbCup;
    }

    public function setNbCup(int $nbCup): self
    {
        $this->nbCup = $nbCup;

        return $this;
    }

    public function getNbCL(): ?int
    {
        return $this->nbCL;
    }

    public function setNbCL(int $nbCL): self
    {
        $this->nbCL = $nbCL;

        return $this;
    }

    public function getNbEL(): ?int
    {
        return $this->nbEL;
    }

    public function setNbEL(int $nbEL): self
    {
        $this->nbEL = $nbEL;

        return $this;
    }

    public function getIdEquipe(): ?Equipe
    {
        return $this->idEquipe;
    }

    public function setIdEquipe(Equipe $idEquipe): self
    {
        $this->idEquipe = $idEquipe;

        return $this;
    }
}
