<?php

namespace App\Entity;

use App\Repository\PanierRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PanierRepository::class)]
class Panier
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\OneToMany(mappedBy: 'panier', targetEntity: Produit::class)]
    private Collection $idproduit;


    public function __construct()
    {
        $this->idproduit = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection<int, Produit>
     */
    public function getIdproduit(): Collection
    {
        return $this->idproduit;
    }

    public function addIdproduit(Produit $idproduit): self
    {
        if (!$this->idproduit->contains($idproduit)) {
            $this->idproduit->add($idproduit);
            $idproduit->setPanier($this);
        }

        return $this;
    }

    public function removeIdproduit(Produit $idproduit): self
    {
        if ($this->idproduit->removeElement($idproduit)) {
            // set the owning side to null (unless already changed)
            if ($idproduit->getPanier() === $this) {
                $idproduit->setPanier(null);
            }
        }

        return $this;
    }
}
