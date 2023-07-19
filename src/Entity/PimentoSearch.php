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
}