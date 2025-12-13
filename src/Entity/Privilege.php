<?php

namespace App\Entity;

use App\Repository\PrivilegeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PrivilegeRepository::class)]
class Privilege
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 100)]
    private ?string $libPriv = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $dateAdd = null;

    #[ORM\OneToMany(targetEntity: PrivilegeUtilisateur::class, mappedBy: 'idPriv')]
    private Collection $privilegeUtilisateurs;

    #[ORM\Column(length: 255)]
    private ?string $titre = null;

    public function __construct()
    {
        $this->privilegeUtilisateurs = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLibPriv(): ?string
    {
        return $this->libPriv;
    }

    public function setLibPriv(string $libPriv): static
    {
        $this->libPriv = $libPriv;

        return $this;
    }

    public function getDateAdd(): ?\DateTimeInterface
    {
        return $this->dateAdd;
    }

    public function setDateAdd(\DateTimeInterface $dateAdd): static
    {
        $this->dateAdd = $dateAdd;

        return $this;
    }

    // /**
    //  * @return Collection<int, PrivilegeUtilisateur>
    //  */
    // public function getPrivilegeUtilisateurs(): Collection
    // {
    //     return $this->privilegeUtilisateurs;
    // }

    // public function addPrivilegeUtilisateur(PrivilegeUtilisateur $privilegeUtilisateur): static
    // {
    //     if (!$this->privilegeUtilisateurs->contains($privilegeUtilisateur)) {
    //         $this->privilegeUtilisateurs->add($privilegeUtilisateur);
    //         $privilegeUtilisateur->setIdPriv($this);
    //     }

    //     return $this;
    // }

    // public function removePrivilegeUtilisateur(PrivilegeUtilisateur $privilegeUtilisateur): static
    // {
    //     if ($this->privilegeUtilisateurs->removeElement($privilegeUtilisateur)) {
    //         // set the owning side to null (unless already changed)
    //         if ($privilegeUtilisateur->getIdPriv() === $this) {
    //             $privilegeUtilisateur->setIdPriv(null);
    //         }
    //     }

    //     return $this;
    // }

    public function getTitre(): ?string
    {
        return $this->titre;
    }

    public function setTitre(string $titre): static
    {
        $this->titre = $titre;

        return $this;
    }


}
