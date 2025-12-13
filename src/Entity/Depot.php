<?php

namespace App\Entity;

use App\Repository\DepotRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: DepotRepository::class)]
class Depot
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 100)]
    private ?string $adresse = null;

    #[ORM\Column]
    private ?int $capacite = null;

    // #[ORM\OneToMany(targetEntity: Article::class, mappedBy: 'idDepot')]
    // private Collection $articles;

    public function __construct()
    {
        // $this->articles = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAdresse(): ?string
    {
        return $this->adresse;
    }

    public function setAdresse(string $adresse): static
    {
        $this->adresse = $adresse;

        return $this;
    }

    public function getCapacite(): ?int
    {
        return $this->capacite;
    }

    public function setCapacite(int $capacite): static
    {
        $this->capacite = $capacite;

        return $this;
    }

    // /**
    //  * @return Collection<int, Article>
    //  */
    // public function getArticles(): Collection
    // {
    //     return $this->articles;
    // }

    // public function addArticle(Article $article): static
    // {
    //     if (!$this->articles->contains($article)) {
    //         $this->articles->add($article);
    //         $article->setIdDepot($this);
    //     }

    //     return $this;
    // }

    // public function removeArticle(Article $article): static
    // {
    //     if ($this->articles->removeElement($article)) {
    //         // set the owning side to null (unless already changed)
    //         if ($article->getIdDepot() === $this) {
    //             $article->setIdDepot(null);
    //         }
    //     }

    //     return $this;
    // }
}
