<?php

namespace App\Entity;

use App\Repository\StatusBcRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;


#[ORM\Entity(repositoryClass: StatusBcRepository::class)]
class StatusBc
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $codeStatus = null;

    #[ORM\Column(length: 100)]
    private ?string $libelle = null;

    #[ORM\OneToMany(targetEntity: BonCommande::class, mappedBy: 'codeStatus')]
    private Collection $bonCommandes;

    public function __construct()
    {
        $this->bonCommandes = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCodeStatus(): ?int
    {
        return $this->codeStatus;
    }

    public function setCodeStatus(int $codeStatus): static
    {
        $this->codeStatus = $codeStatus;

        return $this;
    }

    public function getLibelle(): ?string
    {
        return $this->libelle;
    }

    public function setLibelle(string $libelle): static
    {
        $this->libelle = $libelle;

        return $this;
    }
}
