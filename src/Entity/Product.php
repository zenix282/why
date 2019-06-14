<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ProductRepository")
 */
class Product
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
    private $omschrijving;

    /**
     * @ORM\Column(type="string", length=40)
     */
    private $code;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $prijs;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Regel", mappedBy="product")
     */
    private $regels;

    public function __construct()
    {
        $this->regels = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getOmschrijving(): ?string
    {
        return $this->omschrijving;
    }

    public function setOmschrijving(string $omschrijving): self
    {
        $this->omschrijving = $omschrijving;

        return $this;
    }

    public function getCode(): ?string
    {
        return $this->code;
    }

    public function setCode(string $code): self
    {
        $this->code = $code;

        return $this;
    }

    public function getPrijs(): ?float
    {
        return $this->prijs;
    }

    public function setPrijs(?float $prijs): self
    {
        $this->prijs = $prijs;

        return $this;
    }

    /**
     * @return Collection|Regel[]
     */
    public function getRegels(): Collection
    {
        return $this->regels;
    }

    public function addRegel(Regel $regel): self
    {
        if (!$this->regels->contains($regel)) {
            $this->regels[] = $regel;
            $regel->setProduct($this);
        }

        return $this;
    }

    public function removeRegel(Regel $regel): self
    {
        if ($this->regels->contains($regel)) {
            $this->regels->removeElement($regel);
            // set the owning side to null (unless already changed)
            if ($regel->getProduct() === $this) {
                $regel->setProduct(null);
            }
        }

        return $this;
    }
    public function __toString()
    {
      return $this->getCode().' '.$this->getOmschrijving().' '.$this->getPrijs();
    }
}
