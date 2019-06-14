<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\RegelRepository")
 */
class Regel
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Factuur", inversedBy="regels")
     * @ORM\JoinColumn(nullable=false)
     */
    private $factuur;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Product", inversedBy="regels")
     * @ORM\JoinColumn(nullable=false)
     */
    private $product;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $aantal;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFactuur(): ?Factuur
    {
        return $this->factuur;
    }

    public function setFactuur(?Factuur $factuur): self
    {
        $this->factuur = $factuur;

        return $this;
    }

    public function getProduct(): ?Product
    {
        return $this->product;
    }

    public function setProduct(?Product $product): self
    {
        $this->product = $product;

        return $this;
    }

    public function getAantal(): ?int
    {
        return $this->aantal;
    }

    public function setAantal(?int $aantal): self
    {
        $this->aantal = $aantal;

        return $this;
    }
}
