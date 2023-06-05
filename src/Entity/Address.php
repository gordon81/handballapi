<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\AddressRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AddressRepository::class)]
#[ApiResource]
class Address
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $street = null;

    #[ORM\Column(length: 255)]
    private ?string $city = null;

    #[ORM\Column]
    private ?int $postal = null;

    #[ORM\Column(length: 255)]
    private ?string $number = null;

    #[ORM\ManyToOne(inversedBy: 'addresses')]
    private ?Association $association = null;

    #[ORM\ManyToOne(inversedBy: 'addresses')]
    private ?Club $club = null;

    #[ORM\OneToMany(mappedBy: 'address', targetEntity: Gymnasium::class)]
    private Collection $gymnasium;

    #[ORM\OneToMany(mappedBy: 'address', targetEntity: Person::class)]
    private Collection $person;

    public function __construct()
    {
        $this->gymnasium = new ArrayCollection();
        $this->person = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getStreet(): ?string
    {
        return $this->street;
    }

    public function setStreet(string $street): self
    {
        $this->street = $street;

        return $this;
    }

    public function getCity(): ?string
    {
        return $this->city;
    }

    public function setCity(string $city): self
    {
        $this->city = $city;

        return $this;
    }

    public function getPostal(): ?int
    {
        return $this->postal;
    }

    public function setPostal(int $postal): self
    {
        $this->postal = $postal;

        return $this;
    }

    public function getNumber(): ?string
    {
        return $this->number;
    }

    public function setNumber(string $number): self
    {
        $this->number = $number;

        return $this;
    }

    public function getAssociation(): ?Association
    {
        return $this->association;
    }

    public function setAssociation(?Association $association): self
    {
        $this->association = $association;

        return $this;
    }

    public function getClub(): ?Club
    {
        return $this->club;
    }

    public function setClub(?Club $club): self
    {
        $this->club = $club;

        return $this;
    }

    /**
     * @return Collection<int, Gymnasium>
     */
    public function getGymnasium(): Collection
    {
        return $this->gymnasium;
    }

    public function addGymnasium(Gymnasium $gymnasium): self
    {
        if (!$this->gymnasium->contains($gymnasium)) {
            $this->gymnasium->add($gymnasium);
            $gymnasium->setAddress($this);
        }

        return $this;
    }

    public function removeGymnasium(Gymnasium $gymnasium): self
    {
        if ($this->gymnasium->removeElement($gymnasium)) {
            // set the owning side to null (unless already changed)
            if ($gymnasium->getAddress() === $this) {
                $gymnasium->setAddress(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Person>
     */
    public function getPerson(): Collection
    {
        return $this->person;
    }

    public function addPerson(Person $person): self
    {
        if (!$this->person->contains($person)) {
            $this->person->add($person);
            $person->setAddress($this);
        }

        return $this;
    }

    public function removePerson(Person $person): self
    {
        if ($this->person->removeElement($person)) {
            // set the owning side to null (unless already changed)
            if ($person->getAddress() === $this) {
                $person->setAddress(null);
            }
        }

        return $this;
    }
}
