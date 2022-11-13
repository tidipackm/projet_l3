<?php

namespace App\Entity;

use App\Repository\EquipeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EquipeRepository::class)]
class Equipe
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(length: 255)]
    private ?string $stadium = null;

    #[ORM\ManyToOne(inversedBy: 'equipes')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Championnat $idChampionnat = null;

    #[ORM\OneToMany(mappedBy: 'idEquipe', targetEntity: Joueur::class, orphanRemoval: true)]
    private Collection $joueurs;

    #[ORM\OneToOne(mappedBy: 'idEquipe', cascade: ['persist', 'remove'])]
    private ?Palmares $palmares = null;

    public function __construct()
    {
        $this->joueurs = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getStadium(): ?string
    {
        return $this->stadium;
    }

    public function setStadium(string $stadium): self
    {
        $this->stadium = $stadium;

        return $this;
    }

    public function getIdChampionnat(): ?Championnat
    {
        return $this->idChampionnat;
    }

    public function setIdChampionnat(?Championnat $idChampionnat): self
    {
        $this->idChampionnat = $idChampionnat;

        return $this;
    }

    /**
     * @return Collection<int, Joueur>
     */
    public function getJoueurs(): Collection
    {
        return $this->joueurs;
    }

    public function addJoueur(Joueur $joueur): self
    {
        if (!$this->joueurs->contains($joueur)) {
            $this->joueurs->add($joueur);
            $joueur->setIdEquipe($this);
        }

        return $this;
    }

    public function removeJoueur(Joueur $joueur): self
    {
        if ($this->joueurs->removeElement($joueur)) {
            // set the owning side to null (unless already changed)
            if ($joueur->getIdEquipe() === $this) {
                $joueur->setIdEquipe(null);
            }
        }

        return $this;
    }

    public function getPalmares(): ?Palmares
    {
        return $this->palmares;
    }

    public function setPalmares(Palmares $palmares): self
    {
        // set the owning side of the relation if necessary
        if ($palmares->getIdEquipe() !== $this) {
            $palmares->setIdEquipe($this);
        }

        $this->palmares = $palmares;

        return $this;
    }
}
