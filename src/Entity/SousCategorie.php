<?php

namespace App\Entity;

use App\Repository\SousCategorieRepository;
use DateTime;
use DateTimeInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=SousCategorieRepository::class)
 */
class SousCategorie
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nom;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $slug;

    /**
     * @ORM\Column(type="date")
     */
    private $dateCreation;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $dateMaj;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $dateSuppression;

    /**
     * @ORM\ManyToOne(targetEntity=Categorie::class, inversedBy="sousCategories")
     * @ORM\JoinColumn(nullable=false)
     */
    private $categorie;

    /**
     * @ORM\OneToMany(targetEntity=Produit::class, mappedBy="sousCategorie")
     */
    private $produits;

    public function __construct()
    {
        $this->produits = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function setSlug(string $slug): self
    {
        $this->slug = $slug;

        return $this;
    }


    /**
     * @return DateTimeInterface|null
     */
    public function getDateCreation(): ?DateTimeInterface
    {
        return $this->dateCreation;
    }

    /**
     * @ORM\PrePersist
     * @return $this
     */
    public function setDateCreation(): self
    {
        $this->dateCreation = new DateTime();

        return $this;
    }

    /**
     * @return DateTimeInterface|null
     */
    public function getDateMaj(): ?DateTimeInterface
    {
        return $this->dateMaj;
    }

    /**
     * @ORM\PreUpdate
     * @return SousCategorie
     */
    public function setDateMaj(): self
    {
        $this->dateMaj = new DateTime();

        return $this;
    }

    /**
     * @return DateTimeInterface|null
     */
    public function getDateSuppression(): ?DateTimeInterface
    {
        return $this->dateSuppression;
    }

    /**
     * @ORM\PreRemove
     * @return $this
     */
    public function setDateSuppression(): self
    {
        $this->dateSuppression = new DateTime();

        return $this;
    }

    public function getCategorie(): ?Categorie
    {
        return $this->categorie;
    }

    public function setCategorie(?Categorie $categorie): self
    {
        $this->categorie = $categorie;

        return $this;
    }

    /**
     * @return Collection|Produit[]
     */
    public function getProduits(): Collection
    {
        return $this->produits;
    }

    public function addProduit(Produit $produit): self
    {
        if (!$this->produits->contains($produit)) {
            $this->produits[] = $produit;
            $produit->setSousCategorie($this);
        }

        return $this;
    }

    public function removeProduit(Produit $produit): self
    {
        if ($this->produits->contains($produit)) {
            $this->produits->removeElement($produit);
            // set the owning side to null (unless already changed)
            if ($produit->getSousCategorie() === $this) {
                $produit->setSousCategorie(null);
            }
        }

        return $this;
    }
}
