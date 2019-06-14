<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\FactuurRepository")
 */
class Factuur
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="datetime")
     */
    private $datum;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Regel", mappedBy="factuur")
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

    public function getDatum(): ?\DateTimeInterface
    {
        return $this->datum;
    }

    public function setDatum(\DateTimeInterface $datum): self
    {
        $this->datum = $datum;

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
            $regel->setFactuur($this);
        }

        return $this;
    }

    public function removeRegel(Regel $regel): self
    {
        if ($this->regels->contains($regel)) {
            $this->regels->removeElement($regel);
            // set the owning side to null (unless already changed)
            if ($regel->getFactuur() === $this) {
                $regel->setFactuur(null);
            }
        }

        return $this;
    }
    public function __toString()
    {
      return 'Fact-nr: '.$this->getId();
    }
}
