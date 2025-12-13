<?php

namespace App\Entity;

use App\Repository\BonSortieRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: BonSortieRepository::class)]
class BonSortie
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 100, nullable: true)]
    private ?string $observation = null;

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    private ?Facture $Facture = null;

  

    public function getId(): ?int
    {
        return $this->id;
    }

   

    public function getObservation(): ?string
    {
        return $this->observation;
    }

    public function setObservation(?string $observation): static
    {
        $this->observation = $observation;

        return $this;
    }

    public function getFacture(): ?Facture
    {
        return $this->Facture;
    }

    public function setFacture(?Facture $Facture): static
    {
        $this->Facture = $Facture;

        return $this;
    }

}
