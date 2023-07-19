<?php

namespace App\Entity;

use Symfony\Component\Validator\Constraints as Assert;

class PimentoSearch
{
    private ?string $search = null;

    #[Assert\PositiveOrZero()]
    private ?int $minPrice = null;

    #[Assert\Positive()]
    private ?int $maxPrice = null;

    private ?Color $color = null;

    private ?Strength $minStrength = null;
    private ?Strength $maxStrength = null;



    /**
     * Get the value of search
     *
     * @return ?string
     */
    public function getSearch(): ?string
    {
        return $this->search;
    }

    /**
     * Set the value of search
     *
     * @param ?string $search
     *
     * @return self
     */
    public function setSearch(?string $search): self
    {
        $this->search = $search;

        return $this;
    }

    /**
     * Get the value of minPrice
     */ 
    public function getMinPrice()
    {
        return $this->minPrice;
    }

    /**
     * Set the value of minPrice
     *
     * @return  self
     */ 
    public function setMinPrice($minPrice)
    {
        $this->minPrice = $minPrice;

        return $this;
    }

    /**
     * Get the value of maxPrice
     */ 
    public function getMaxPrice()
    {
        return $this->maxPrice;
    }

    /**
     * Set the value of maxPrice
     *
     * @return  self
     */ 
    public function setMaxPrice($maxPrice)
    {
        $this->maxPrice = $maxPrice;

        return $this;
    }
 
    public function getColor()
    {
        return $this->color;
    }

    /**
     * Set the value of color
     *
     * @return  self
     */ 
    public function setColor($color)
    {
        $this->color = $color;

        return $this;
    }

    public function getMinStrength()
    {
        return $this->minStrength;
    }

    /**
     * Set the value of minStrength
     *
     * @return  self
     */ 
    public function setMinStrength($minStrength)
    {
        $this->minStrength = $minStrength;

        return $this;
    }

    public function getMaxStrength()
    {
        return $this->maxStrength;
    }

    /**
     * Set the value of maxStrength
     *
     * @return  self
     */ 
    public function setMaxStrength($maxStrength)
    {
        $this->maxStrength = $maxStrength;

        return $this;
    }
}