<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\TrainerRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TrainerRepository::class)]
#[ApiResource]
class Trainer
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $h4aId = null;

    #[ORM\OneToOne(mappedBy: 'trainer', cascade: ['persist', 'remove'])]
    private ?Person $person = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getH4aId(): ?int
    {
        return $this->h4aId;
    }

    public function setH4aId(int $h4aId): self
    {
        $this->h4aId = $h4aId;

        return $this;
    }

    public function getPerson(): ?Person
    {
        return $this->person;
    }

    public function setPerson(?Person $person): self
    {
        // unset the owning side of the relation if necessary
        if (null === $person && null !== $this->person) {
            $this->person->setTrainer(null);
        }

        // set the owning side of the relation if necessary
        if (null !== $person && $person->getTrainer() !== $this) {
            $person->setTrainer($this);
        }

        $this->person = $person;

        return $this;
    }
}
