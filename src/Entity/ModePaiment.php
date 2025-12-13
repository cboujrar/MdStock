<?php

namespace App\Entity;

use App\Repository\ModePaimentRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ModePaimentRepository::class)]
class ModePaiment
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $libelle = null;

    // #[ORM\OneToMany(targetEntity: Facture::class, mappedBy: 'ModePaiment')]
    // private Collection $factures;

    // public function __construct()
    // {
    //     $this->factures = new ArrayCollection();
    // }

    public function getId(): ?int
    {
        return $this->id;
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

    // /**
    //  * @return Collection<int, Facture>
    //  */
    // public function getFactures(): Collection
    // {
    //     return $this->factures;
    // }

    // public function addFacture(Facture $facture): static
    // {
    //     if (!$this->factures->contains($facture)) {
    //         $this->factures->add($facture);
    //         $facture->setModePaiment($this);
    //     }

    //     return $this;
    // }

    // public function removeFacture(Facture $facture): static
    // {
    //     if ($this->factures->removeElement($facture)) {
    //         // set the owning side to null (unless already changed)
    //         if ($facture->getModePaiment() === $this) {
    //             $facture->setModePaiment(null);
    //         }
    //     }

    //     return $this;
    // }
}
