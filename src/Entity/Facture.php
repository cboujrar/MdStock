<?php

namespace App\Entity;

use App\Repository\FactureRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: FactureRepository::class)]
class Facture
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATE_MUTABLE , nullable: true)]
    private ?\DateTimeInterface $DatePaiement = null;

    #[ORM\Column ( nullable: true)]
    private ?float $totale = null;


    #[ORM\ManyToOne(inversedBy: 'factures')]
    private ?ModePaiment $ModePaiment = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDatePaiement(): ?\DateTimeInterface
    {
        return $this->DatePaiement;
    }

    public function setDatePaiement(\DateTimeInterface $DatePaiement): static
    {
        $this->DatePaiement = $DatePaiement;

        return $this;
    }

    public function getTotale(): ?float
    {
        return $this->totale;
    }

    public function setTotale(float $totale): static
    {
        $this->totale = $totale;

        return $this;
    }

    public function getModePaiment(): ?ModePaiment
    {
        return $this->ModePaiment;
    }

    public function setModePaiment(?ModePaiment $ModePaiment): static
    {
        $this->ModePaiment = $ModePaiment;

        return $this;
    }
}
