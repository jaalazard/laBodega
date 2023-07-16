<?php

namespace App\Entity;

use App\Repository\CountryRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CountryRepository::class)]
class Country
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\OneToMany(mappedBy: 'country', targetEntity: Client::class)]
    private Collection $clients;

    #[ORM\OneToMany(mappedBy: 'country', targetEntity: Pimento::class)]
    private Collection $pimentos;

    public function __construct()
    {
        $this->clients = new ArrayCollection();
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
     * @return Collection<int, Client>
     */
    public function getClients(): Collection
    {
        return $this->clients;
    }

    public function addClient(Client $client): static
    {
        if (!$this->clients->contains($client)) {
            $this->clients->add($client);
            $client->setCountry($this);
        }

        return $this;
    }

    public function removeClient(Client $client): static
    {
        if ($this->clients->removeElement($client)) {
            // set the owning side to null (unless already changed)
            if ($client->getCountry() === $this) {
                $client->setCountry(null);
            }
        }

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
            $pimento->setCountry($this);
        }

        return $this;
    }

    public function removePimento(Pimento $pimento): static
    {
        if ($this->pimentos->removeElement($pimento)) {
            // set the owning side to null (unless already changed)
            if ($pimento->getCountry() === $this) {
                $pimento->setCountry(null);
            }
        }

        return $this;
    }
}
