<?php

namespace App\Entity;

use App\Repository\BonCommandeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;


#[ORM\Entity(repositoryClass: BonCommandeRepository::class)]
class BonCommande
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;


    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $DateCommande = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $observation = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $dateLivraison = null;

    #[ORM\ManyToOne(inversedBy: 'bonCommandes')]
    private ?StatusBc $codeStatus = null;

    #[ORM\ManyToOne(inversedBy: 'bonCommandes')]
    private ?Fournisseur $idFournisseur = null;


    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    private ?Facture $facture = null;

    #[ORM\OneToMany(targetEntity: DetailBonCommande::class, mappedBy: 'bonCommande')]
    private Collection $detailBonCommandes;

    public function __construct()
    {
        $this->detailBonCommandes = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDateCommande(): ?\DateTimeInterface
    {
        return $this->DateCommande;
    }

    public function setDateCommande(\DateTimeInterface $DateCommande): static
    {
        $this->DateCommande = $DateCommande;

        return $this;
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

    public function getDateLivraison(): ?\DateTimeInterface
    {
        return $this->dateLivraison;
    }

    public function setDateLivraison(\DateTimeInterface $dateLivraison): static
    {
        $this->dateLivraison = $dateLivraison;

        return $this;
    }

    public function getCodeStatus(): ?StatusBc
    {
        return $this->codeStatus;
    }

    public function setCodeStatus(?StatusBc $codeStatus): static
    {
        $this->codeStatus = $codeStatus;

        return $this;
    }

    public function getIdFournisseur(): ?Fournisseur
    {
        return $this->idFournisseur;
    }

    public function setIdFournisseur(?Fournisseur $idFournisseur): static
    {
        $this->idFournisseur = $idFournisseur;

        return $this;
    }

    // /**
    //  * @return Collection<int, DetailBonCommande>
    //  */
    // public function getDetailBonCommandes(): Collection
    // {
    //     return $this->detailBonCommandes;
    // }

    // public function addDetailBonCommande(DetailBonCommande $detailBonCommande): static
    // {
    //     if (!$this->detailBonCommandes->contains($detailBonCommande)) {
    //         $this->detailBonCommandes->add($detailBonCommande);
    //         $detailBonCommande->setBonCommande($this);
    //     }

    //     return $this;
    // }

    // public function removeDetailBonCommande(DetailBonCommande $detailBonCommande): static
    // {
    //     if ($this->detailBonCommandes->removeElement($detailBonCommande)) {
    //         // set the owning side to null (unless already changed)
    //         if ($detailBonCommande->getBonCommande() === $this) {
    //             $detailBonCommande->setBonCommande(null);
    //         }
    //     }

    //     return $this;
    // }

    public function getFacture(): ?Facture
    {
        return $this->facture;
    }

    public function setFacture(?Facture $facture): static
    {
        $this->facture = $facture;

        return $this;
    }

    // /**
    //  * @return Collection<int, DetailBonCommande>
    //  */
    // public function getDetailBonCommandes(): Collection
    // {
    //     return $this->detailBonCommandes;
    // }

    // public function addDetailBonCommande(DetailBonCommande $detailBonCommande): static
    // {
    //     if (!$this->detailBonCommandes->contains($detailBonCommande)) {
    //         $this->detailBonCommandes->add($detailBonCommande);
    //         $detailBonCommande->setBonCommande($this);
    //     }

    //     return $this;
    // }

    // public function removeDetailBonCommande(DetailBonCommande $detailBonCommande): static
    // {
    //     if ($this->detailBonCommandes->removeElement($detailBonCommande)) {
    //         // set the owning side to null (unless already changed)
    //         if ($detailBonCommande->getBonCommande() === $this) {
    //             $detailBonCommande->setBonCommande(null);
    //         }
    //     }

    //     return $this;
    // }

    
}
