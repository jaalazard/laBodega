<?php

namespace App\Entity;

use App\Repository\ColorRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ColorRepository::class)]
class Color
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\OneToMany(mappedBy: 'color', targetEntity: Pimento::class)]
    private Collection $pimentos;

    public function __construct()
    {
        $this->pimentos = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
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
            $pimento->setColor($this);
        }

        return $this;
    }

    public function removePimento(Pimento $pimento): static
    {
        if ($this->pimentos->removeElement($pimento)) {
            // set the owning side to null (unless already changed)
            if ($pimento->getColor() === $this) {
                $pimento->setColor(null);
            }
        }

        return $this;
    }
}
