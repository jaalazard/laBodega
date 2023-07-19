<?php

namespace App\Entity;

use App\Repository\StrengthRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: StrengthRepository::class)]
class Strength
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\OneToMany(mappedBy: 'strength', targetEntity: Pimento::class)]
    private Collection $pimentos;

    #[ORM\Column(type: Types::BIGINT)]
    private ?string $power = null;

    public function __construct()
    {
        $this->pimentos = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection<int, Pimento>
     */
    public function getPimentos(): Collection
    {
        return $this->pimentos;
    }

    public function addPimento(Pimento $pimento): static
    {
        if (!$this->pimentos->contains($pimento)) {
            $this->pimentos->add($pimento);
            $pimento->setStrength($this);
        }

        return $this;
    }

    public function removePimento(Pimento $pimento): static
    {
        if ($this->pimentos->removeElement($pimento)) {
            // set the owning side to null (unless already changed)
            if ($pimento->getStrength() === $this) {
                $pimento->setStrength(null);
            }
        }

        return $this;
    }

    public function getPower(): ?string
    {
        return $this->power;
    }

    public function setPower(string $power): static
    {
        $this->power = $power;

        return $this;
    }

}
