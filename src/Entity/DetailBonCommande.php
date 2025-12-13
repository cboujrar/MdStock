<?php

namespace App\Entity;

use App\Repository\DetailBonCommandeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;


#[ORM\Entity(repositoryClass: DetailBonCommandeRepository::class)]
class DetailBonCommande
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $quantite = null;

    #[ORM\Column]
    private ?float $prix = null;

    #[ORM\ManyToOne(inversedBy: 'detailBonCommandes')]
    private ?Article $article = null;

    #[ORM\ManyToOne(inversedBy: 'detailBonCommandes')]
    private ?BonCommande $bonCommande = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getQuantite(): ?string
    {
        return $this->quantite;
    }

    public function setQuantite(string $quantite): static
    {
        $this->quantite = $quantite;

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

    public function getArticle(): ?Article
    {
        return $this->article;
    }

    public function setArticle(?Article $article): static
    {
        $this->article = $article;

        return $this;
    }

    public function getBonCommande(): ?BonCommande
    {
        return $this->bonCommande;
    }

    public function setBonCommande(?BonCommande $bonCommande): static
    {
        $this->bonCommande = $bonCommande;

        return $this;
    }

}
