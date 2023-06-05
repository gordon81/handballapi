<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\GoalsRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: GoalsRepository::class)]
#[ApiResource]
class Goals
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $home = null;

    #[ORM\Column]
    private ?int $guest = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getHome(): ?int
    {
        return $this->home;
    }

    public function setHome(int $home): self
    {
        $this->home = $home;

        return $this;
    }

    public function getGuest(): ?int
    {
        return $this->guest;
    }

    public function setGuest(int $guest): self
    {
        $this->guest = $guest;

        return $this;
    }
}
