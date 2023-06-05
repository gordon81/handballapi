<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\GamesGoalsRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: GamesGoalsRepository::class)]
#[ApiResource]
class GamesGoals
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    private ?Goals $halfTime = null;

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    private ?Goals $end = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getHalfTime(): ?Goals
    {
        return $this->halfTime;
    }

    public function setHalfTime(?Goals $halfTime): self
    {
        $this->halfTime = $halfTime;

        return $this;
    }

    public function getEnd(): ?Goals
    {
        return $this->end;
    }

    public function setEnd(?Goals $end): self
    {
        $this->end = $end;

        return $this;
    }
}
