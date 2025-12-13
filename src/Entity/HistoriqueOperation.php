<?php

namespace App\Entity;

use App\Repository\HistoriqueOperationRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: HistoriqueOperationRepository::class)]
class HistoriqueOperation
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    private ?string $entite = null;

    #[ORM\Column(length: 50)]
    private ?string $utilisateur = null;


    #[ORM\Column(length: 50)]
    private ?string $date = null;

    #[ORM\ManyToOne(inversedBy: 'historiqueOperations')]
    private ?TypeOperation $type = null;


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEntite(): ?string
    {
        return $this->entite;
    }

    public function setEntite(string $entite): static
    {
        $this->entite = $entite;

        return $this;
    }

    public function getUtilisateur(): ?string
    {
        return $this->utilisateur;
    }

    public function setUtilisateur(string $utilisateur): static
    {
        $this->utilisateur = $utilisateur;

        return $this;
    }

    public function getDate(): ?string
    {
        return $this->date;
    }

    public function setDate(string $date): static
    {
        $this->date = $date;

        return $this;
    }

    public function getType(): ?TypeOperation
    {
        return $this->type;
    }

    public function setType(?TypeOperation $type): static
    {
        $this->type = $type;

        return $this;
    }
}
