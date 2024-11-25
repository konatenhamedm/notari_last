<?php

namespace App\Entity;

use App\Repository\PaiementFraisRepository;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\DBAL\Types\Types;

#[ORM\Entity(repositoryClass: PaiementFraisRepository::class)]
class PaiementFrais
{
    // const SENS_DEPART = 1;

    // const SENS_ARRIVE = 2;

    // const Sens = [
    //     1 => 'Acheteur',
    //     2 => 'Vendeur'
    // ];

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;




    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $date = null;

    #[ORM\Column(type: 'string', length: 255)]
    private $montant;



    #[ORM\OneToOne(cascade: ["persist"], fetch: "EAGER")]
    #[ORM\JoinColumn(nullable: true)]
    private ?FichierAdmin $path = null;

    #[ORM\Column(type: 'string', length: 255)]
    private $sens;

    #[ORM\ManyToOne(targetEntity: Dossier::class, inversedBy: 'paiementFrais')]
    #[ORM\JoinColumn(onDelete: "CASCADE")]
    private $dossier;

    #[ORM\ManyToOne(inversedBy: 'paiementFrais')]
    private ?Client $client = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date && !in_array($this->date->format('Y'), ['-0001', '0000']) ? $this->date : null;
    }

    public function setDate(?\DateTimeInterface $date): static
    {
        $this->date = $date;
        return $this;
    }

    public function getMontant(): ?string
    {
        return $this->montant;
    }

    public function setMontant(string $montant): self
    {
        $this->montant = $montant;

        return $this;
    }

    public function getPath(): ?FichierAdmin
    {
        return $this->path;
    }

    public function setPath(?FichierAdmin $path): self
    {
        $this->path = $path;

        return $this;
    }

    public function getSens(): ?string
    {
        return $this->sens;
    }

    public function setSens(string $sens): self
    {
        $this->sens = $sens;

        return $this;
    }

    public function getDossier(): ?Dossier
    {
        return $this->dossier;
    }

    public function setDossier(?Dossier $dossier): self
    {
        $this->dossier = $dossier;

        return $this;
    }

    public function getClient(): ?Client
    {
        return $this->client;
    }

    public function setClient(?Client $client): static
    {
        $this->client = $client;

        return $this;
    }
}
