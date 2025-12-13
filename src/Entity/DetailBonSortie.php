<?php

namespace App\Entity;

use App\Repository\DetailBonSortieRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: DetailBonSortieRepository::class)]
class DetailBonSortie
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $quantite = null;

    // #[ORM\Column]
    // private ?float $prix = null;

    #[ORM\ManyToOne()]
    private ?BonSortie $idbs = null;

    #[ORM\ManyToOne(inversedBy: 'detailBonSorties')]
    private ?Article $article = null;


    public function getId(): ?int
    {
        return $this->id;
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

    // public function getPrix(): ?float
    // {
    //     return $this->prix;
    // }

    // public function setPrix(float $prix): static
    // {
    //     $this->prix = $prix;

    //     return $this;
    // }

    public function getIdbs(): ?BonSortie
    {
        return $this->idbs;
    }

    public function setIdbs(BonSortie $idbs): static
    {
        $this->idbs = $idbs;

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
}
