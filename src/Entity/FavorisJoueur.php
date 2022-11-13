<?php

namespace App\Entity;

use App\Repository\FavorisJoueurRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: FavorisJoueurRepository::class)]
class FavorisJoueur
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $idJoueur = 0;

    #[ORM\Column]
    private ?int $idUser = 0;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdJoueur(): ?int
    {
        return $this->idJoueur;
    }

    public function setIdJoueur(?int $idJoueur): self
    {
        $this->idJoueur = $idJoueur;

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
