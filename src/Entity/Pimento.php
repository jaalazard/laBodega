<?php

namespace App\Entity;

use DateTime;
use DateTimeInterface;
use App\Repository\PimentoRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\DBAL\Types\Types;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: PimentoRepository::class)]
#[Vich\Uploadable]
class Pimento
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank]
    private ?string $name = null;

    #[ORM\Column]
    #[Assert\NotBlank]
    #[Assert\Positive]
    private ?float $price = null;

    #[ORM\ManyToOne(inversedBy: 'pimentos')]
    #[ORM\JoinColumn(nullable: false)]
    #[Assert\NotBlank]
    private ?Strength $strength = null;

    #[ORM\ManyToOne(inversedBy: 'pimentos')]
    #[ORM\JoinColumn(nullable: false)]
    #[Assert\NotBlank]
    private ?Color $color = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank]
    private ?string $country = null;

    #[ORM\Column(length: 255)]
    private ?string $description = null;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private ?string $poster = null;

    #[Vich\UploadableField(mapping: 'poster_file', fileNameProperty: 'poster')]
    #[Assert\File(
        maxSize: '1M',
        mimeTypes: ['image/jpeg', 'image/png', 'image/webp'],
    )]
    private ?File $posterFile = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?DatetimeInterface $updatedAt = null;

    #[ORM\Column]
    private ?int $stock = null;

    #[ORM\ManyToMany(targetEntity: OrderContent::class, mappedBy: 'product')]
    private Collection $orderContents;

    public function __construct()
    {
        $this->orderContents = new ArrayCollection();
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

    public function getPrice(): ?float
    {
        return $this->price;
    }

    public function setPrice(float $price): static
    {
        $this->price = $price;

        return $this;
    }

    public function getStrength(): ?Strength
    {
        return $this->strength;
    }

    public function setStrength(?Strength $strength): static
    {
        $this->strength = $strength;

        return $this;
    }

    public function getColor(): ?Color
    {
        return $this->color;
    }

    public function setColor(?Color $color): static
    {
        $this->color = $color;

        return $this;
    }

    public function getCountry(): ?String
    {
        return $this->country;
    }

    public function setCountry(string $country): static
    {
        $this->country = $country;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getPoster(): ?string
    {
        return $this->poster;
    }

    public function setPoster(?string $poster): self
    {
        $this->poster = $poster;
        return $this;
    }

    public function setPosterFile(File $image = null): Pimento
    {
        $this->posterFile = $image;
        if ($image) {
            $this->updatedAt = new DateTime('now');
        }

        return $this;
    }

    public function getPosterFile(): ?File
    {
        return $this->posterFile;
    }

    public function getStock(): ?int
    {
        return $this->stock;
    }

    public function setStock(int $stock): static
    {
        $this->stock = $stock;

        return $this;
    }

    /**
     * @return Collection<int, OrderContent>
     */
    public function getOrderContents(): Collection
    {
        return $this->orderContents;
    }

    public function addOrderContent(OrderContent $orderContent): static
    {
        if (!$this->orderContents->contains($orderContent)) {
            $this->orderContents->add($orderContent);
            $orderContent->addProduct($this);
        }

        return $this;
    }

    public function removeOrderContent(OrderContent $orderContent): static
    {
        if ($this->orderContents->removeElement($orderContent)) {
            $orderContent->removeProduct($this);
        }

        return $this;
    }
}
