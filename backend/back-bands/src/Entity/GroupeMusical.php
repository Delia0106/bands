<?php

namespace App\Entity;

use App\Repository\GroupeMusicalRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: GroupeMusicalRepository::class)]
class GroupeMusical
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nom_du_groupe = null;

    #[ORM\Column(length: 255)]
    private ?string $origine = null;

    #[ORM\Column(length: 255)]
    private ?string $ville = null;

    #[ORM\Column(length: 255)]
    private ?string $annee_debut = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $annee_separation = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $fondateurs = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?int $membres = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $courant_musical = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $presentation = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomDuGroupe(): ?string
    {
        return $this->nom_du_groupe;
    }

    public function setNomDuGroupe(string $nomDuGroupe): static
    {
        $this->nom_du_groupe = $nomDuGroupe;

        return $this;
    }

    public function getOrigine(): ?string
    {
        return $this->origine;
    }

    public function setOrigine(string $origine): static
    {
        $this->origine = $origine;

        return $this;
    }

    public function getVille(): ?string
    {
        return $this->ville;
    }

    public function setVille(string $ville): static
    {
        $this->ville = $ville;

        return $this;
    }

    public function getAnneeDebut(): ?string
    {
        return $this->annee_debut;
    }

    public function setAnneeDebut(string $anneeDebut): static
    {
        $this->annee_debut = $anneeDebut;

        return $this;
    }

    public function getAnneeSeparation(): ?string
    {
        return $this->annee_separation;
    }

    public function setAnneeSeparation(?string $anneeSeparation): static
    {
        $this->annee_separation = $anneeSeparation;

        return $this;
    }

    public function getFondateurs(): ?string
    {
        return $this->fondateurs;
    }

    public function setFondateurs(?string $fondateurs): static
    {
        $this->fondateurs = $fondateurs;

        return $this;
    }

    public function getMembres(): ?string
    {
        return $this->membres;
    }

    public function setMembres(?string $membres): static
    {
        $this->membres = $membres;

        return $this;
    }

    public function getCourantMusical(): ?string
    {
        return $this->courant_musical;
    }

    public function setCourantMusical(?string $courant_musical): static
    {
        $this->courant_musical = $courant_musical;

        return $this;
    }

    public function getPresentation(): ?string
    {
        return $this->presentation;
    }

    public function setPresentation(?string $presentation): static
    {
        $this->presentation = $presentation;

        return $this;
    }
}
