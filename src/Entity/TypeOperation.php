<?php

namespace App\Entity;

use App\Repository\TypeOperationRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TypeOperationRepository::class)]
class TypeOperation
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    private ?string $titre = null;

    #[ORM\OneToMany(targetEntity: HistoriqueOperation::class, mappedBy: 'type')]
    private Collection $historiqueOperations;

    public function __construct()
    {
        $this->historiqueOperations = new ArrayCollection();
    }



    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitre(): ?string
    {
        return $this->titre;
    }

    public function setTitre(string $titre): static
    {
        $this->titre = $titre;

        return $this;
    }

    // /**
    //  * @return Collection<int, HistoriqueOperation>
    //  */
    // public function getHistoriqueOperations(): Collection
    // {
    //     return $this->historiqueOperations;
    // }

    // public function addHistoriqueOperation(HistoriqueOperation $historiqueOperation): static
    // {
    //     if (!$this->historiqueOperations->contains($historiqueOperation)) {
    //         $this->historiqueOperations->add($historiqueOperation);
    //         $historiqueOperation->setType($this);
    //     }

    //     return $this;
    // }

    // public function removeHistoriqueOperation(HistoriqueOperation $historiqueOperation): static
    // {
    //     if ($this->historiqueOperations->removeElement($historiqueOperation)) {
    //         // set the owning side to null (unless already changed)
    //         if ($historiqueOperation->getType() === $this) {
    //             $historiqueOperation->setType(null);
    //         }
    //     }

    //     return $this;
    // }

}
