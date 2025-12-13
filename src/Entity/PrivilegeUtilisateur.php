<?php

namespace App\Entity;

use App\Repository\PrivilegeUtilisateurRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PrivilegeUtilisateurRepository::class)]
class PrivilegeUtilisateur
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'privilegeUtilisateurs')]
    private ?Privilege $idPriv = null;

    #[ORM\ManyToOne(inversedBy: 'privilegeUtilisateurs')]
    private ?Utilisateur $idUtilisateur = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $dateAdd = null;



    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdPriv(): ?Privilege
    {
        return $this->idPriv;
    }

    public function setIdPriv(?Privilege $idPriv): static
    {
        $this->idPriv = $idPriv;

        return $this;
    }

    public function getIdUtilisateur(): ?Utilisateur
    {
        return $this->idUtilisateur;
    }

    public function setIdUtilisateur(?Utilisateur $idUtilisateur): static
    {
        $this->idUtilisateur = $idUtilisateur;

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

}
