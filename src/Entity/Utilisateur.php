<?php

namespace App\Entity;

use App\Repository\UtilisateurRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: UtilisateurRepository::class)]
class Utilisateur
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    private ?string $nom = null;

    #[ORM\Column(length: 100)]
    private ?string $email = null;

    #[ORM\Column(length: 100,  nullable: true)]
    private ?string $password = null;

    #[ORM\ManyToOne (cascade: ['persist'])]
    private ?Role $role = null;

    #[ORM\OneToMany(targetEntity: PrivilegeUtilisateur::class, mappedBy: 'idUtilisateur')]
    private Collection $privilegeUtilisateurs;

    public function __construct()
    {
        $this->privilegeUtilisateurs = new ArrayCollection();
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

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): static
    {
        $this->email = $email;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): static
    {
        $this->password = $password;

        return $this;
    }

    public function getRole(): ?Role
    {
        return $this->role;
    }

    public function setRole(?Role $role): static
    {
        $this->role = $role;

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
    //         $privilegeUtilisateur->setIdUtilisateur($this);
    //     }

    //     return $this;
    // }

    // public function removePrivilegeUtilisateur(PrivilegeUtilisateur $privilegeUtilisateur): static
    // {
    //     if ($this->privilegeUtilisateurs->removeElement($privilegeUtilisateur)) {
    //         // set the owning side to null (unless already changed)
    //         if ($privilegeUtilisateur->getIdUtilisateur() === $this) {
    //             $privilegeUtilisateur->setIdUtilisateur(null);
    //         }
    //     }

    //     return $this;
    // }


}
