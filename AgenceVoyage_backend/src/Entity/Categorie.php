<?php

namespace App\Entity;

use App\Repository\CategorieRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: CategorieRepository::class)]
class Categorie
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups('api_categorie_index')]
    private ?int $id = null;

    #[ORM\Column(length: 100)]
    #[Groups('api_categorie_index')]
    private ?string $pays = null;

    #[ORM\Column(length: 255)]
    #[Groups('api_categorie_index')]
    private ?string $evenement = null;

    

    /**
     * @var Collection<int, Voyage>
     */
    #[ORM\ManyToMany(targetEntity: Voyage::class, mappedBy: 'Categorie')]
    private Collection $voyages;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $Duree = null;

    public function __construct()
    {
        $this->voyages = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPays(): ?string
    {
        return $this->pays;
    }

    public function setPays(string $pays): static
    {
        $this->pays = $pays;

        return $this;
    }

    public function getEvenement(): ?string
    {
        return $this->evenement;
    }

    public function setEvenement(string $evenement): static
    {
        $this->evenement = $evenement;

        return $this;
    }


    /**
     * @return Collection<int, Voyage>
     */
    public function getVoyages(): Collection
    {
        return $this->voyages;
    }

    public function addVoyage(Voyage $voyage): static
    {
        if (!$this->voyages->contains($voyage)) {
            $this->voyages->add($voyage);
            $voyage->addCategorie($this);
        }

        return $this;
    }

    public function removeVoyage(Voyage $voyage): static
    {
        if ($this->voyages->removeElement($voyage)) {
            $voyage->removeCategorie($this);
        }

        return $this;
    }

    public function getDuree(): ?\DateTimeInterface
    {
        return $this->Duree;
    }

    public function setDuree(\DateTimeInterface $Duree): static
    {
        $this->Duree = $Duree;

        return $this;
    }
}
