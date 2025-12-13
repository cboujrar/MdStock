<?php

namespace App\Entity;

use App\Repository\ArticleRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ArticleRepository::class)]
class Article
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    private ?string $nom = null;

    #[ORM\Column(length: 100)]
    private ?string $description = null;

    #[ORM\Column]
    private ?float $prix = null;

    #[ORM\Column]
    private ?int $quantite = null;

    #[ORM\ManyToOne(inversedBy: 'articles')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Categorie $idCategorie = null;

    #[ORM\ManyToOne(inversedBy: 'articles')]
    private ?Depot $idDepot = null;

    #[ORM\Column(length: 255)]
    private ?string $image = null;

    #[ORM\Column]
    private ?int $minQuantite = null;

    #[ORM\OneToMany(targetEntity: BonCommande::class, mappedBy: 'article')]
    private Collection $bonCommandes;

    #[ORM\OneToMany(targetEntity: DetailBonCommande::class, mappedBy: 'article')]
    private Collection $detailBonCommandes;

    // #[ORM\OneToMany(targetEntity: DetailBonSortie::class, mappedBy: 'article')]
    // private Collection $detailBonSorties;

    public function __construct()
    {
        // $this->detailBonSorties = new ArrayCollection();
        $this->bonCommandes = new ArrayCollection();
        $this->detailBonCommandes = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): static
    {
        $this->nom = $nom;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getPrix(): ?float
    {
        return $this->prix;
    }

    public function setPrix(float $prix): static
    {
        $this->prix = $prix;

        return $this;
    }

    public function getQuantite(): ?int
    {
        return $this->quantite;
    }

    public function setQuantite(int $quantite): static
    {
        $this->quantite = $quantite;

        return $this;
    }

    public function getIdCategorie(): ?Categorie
    {
        return $this->idCategorie;
    }

    public function setIdCategorie(?Categorie $idCategorie): static
    {
        $this->idCategorie = $idCategorie;

        return $this;
    }

    public function getIdDepot(): ?Depot
    {
        return $this->idDepot;
    }

    public function setIdDepot(?Depot $idDepot): static
    {
        $this->idDepot = $idDepot;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(?string $image): static
    {
        $this->image = $image;

        return $this;
    }

    // /**
    //  * @return Collection<int, DetailBonSortie>
    //  */
    // public function getDetailBonSorties(): Collection
    // {
    //     return $this->detailBonSorties;
    // }

    // public function addDetailBonSorty(DetailBonSortie $detailBonSorty): static
    // {
    //     if (!$this->detailBonSorties->contains($detailBonSorty)) {
    //         $this->detailBonSorties->add($detailBonSorty);
    //         $detailBonSorty->setArticle($this);
    //     }

    //     return $this;
    // }

    // public function removeDetailBonSorty(DetailBonSortie $detailBonSorty): static
    // {
    //     if ($this->detailBonSorties->removeElement($detailBonSorty)) {
    //         // set the owning side to null (unless already changed)
    //         if ($detailBonSorty->getArticle() === $this) {
    //             $detailBonSorty->setArticle(null);
    //         }
    //     }

    //     return $this;
    // }

    public function getMinQuantite(): ?int
    {
        return $this->minQuantite;
    }

    public function setMinQuantite(int $minQuantite): static
    {
        $this->minQuantite = $minQuantite;

        return $this;
    }

    // /**
    //  * @return Collection<int, BonCommande>
    //  */
    // public function getBonCommandes(): Collection
    // {
    //     return $this->bonCommandes;
    // }

    // public function addBonCommande(BonCommande $bonCommande): static
    // {
    //     if (!$this->bonCommandes->contains($bonCommande)) {
    //         $this->bonCommandes->add($bonCommande);
    //         $bonCommande->setArticle($this);
    //     }

    //     return $this;
    // }

    // public function removeBonCommande(BonCommande $bonCommande): static
    // {
    //     if ($this->bonCommandes->removeElement($bonCommande)) {
    //         // set the owning side to null (unless already changed)
    //         if ($bonCommande->getArticle() === $this) {
    //             $bonCommande->setArticle(null);
    //         }
    //     }

    //     return $this;
    // }

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
    //         $detailBonCommande->setArticle($this);
    //     }

    //     return $this;
    // }

    // public function removeDetailBonCommande(DetailBonCommande $detailBonCommande): static
    // {
    //     if ($this->detailBonCommandes->removeElement($detailBonCommande)) {
    //         // set the owning side to null (unless already changed)
    //         if ($detailBonCommande->getArticle() === $this) {
    //             $detailBonCommande->setArticle(null);
    //         }
    //     }

    //     return $this;
    // }
}
