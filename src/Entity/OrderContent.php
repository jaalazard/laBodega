<?php

namespace App\Entity;

use App\Repository\OrderContentRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: OrderContentRepository::class)]
class OrderContent
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToMany(targetEntity: Pimento::class, inversedBy: 'orderContents')]
    private Collection $product;

    #[ORM\Column]
    private ?int $quantity = null;

    #[ORM\OneToOne(mappedBy: 'content', cascade: ['persist', 'remove'])]
    private ?Order $command = null;

    public function __construct()
    {
        $this->product = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection<int, Pimento>
     */
    public function getProduct(): Collection
    {
        return $this->product;
    }

    public function addProduct(Pimento $product): static
    {
        if (!$this->product->contains($product)) {
            $this->product->add($product);
        }

        return $this;
    }

    public function removeProduct(Pimento $product): static
    {
        $this->product->removeElement($product);

        return $this;
    }

    public function getQuantity(): ?int
    {
        return $this->quantity;
    }

    public function setQuantity(int $quantity): static
    {
        $this->quantity = $quantity;

        return $this;
    }

    public function getCommand(): ?Order
    {
        return $this->command;
    }

    public function setCommand(Order $command): static
    {
        // set the owning side of the relation if necessary
        if ($command->getContent() !== $this) {
            $command->setContent($this);
        }

        $this->command = $command;

        return $this;
    }
}
