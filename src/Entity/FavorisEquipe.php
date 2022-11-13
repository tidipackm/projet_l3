<?php

namespace App\Entity;

use App\Repository\FavorisEquipeRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: FavorisEquipeRepository::class)]
class FavorisEquipe
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $idEquipe = 0;


    #[ORM\Column]
    private ?int $idUser = 0;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdEquipe(): ?int
    {
        return $this->idEquipe;
    }

    public function setIdEquipe(?int $idEquipe): self
    {
        $this->idEquipe = $idEquipe;

        return $this;
    }

    public function getIdUser(): ?int
    {
        return $this->idUser;
    }

    public function setIdUser(?int $idUser): self
    {
        $this->idUser = $idUser;

        return $this;
    }
}
