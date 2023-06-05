<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\RefereeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: RefereeRepository::class)]
#[ApiResource]
class Referee
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $h4aId = null;

    #[ORM\OneToOne(mappedBy: 'referee', cascade: ['persist', 'remove'])]
    private ?Person $person = null;

    #[ORM\ManyToMany(targetEntity: Game::class, mappedBy: 'referees')]
    private Collection $games;

    public function __construct()
    {
        $this->games = new ArrayCollection();
    }

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
            $this->person->setReferee(null);
        }

        // set the owning side of the relation if necessary
        if (null !== $person && $person->getReferee() !== $this) {
            $person->setReferee($this);
        }

        $this->person = $person;

        return $this;
    }

    /**
     * @return Collection<int, Game>
     */
    public function getGames(): Collection
    {
        return $this->games;
    }

    public function addGame(Game $game): self
    {
        if (!$this->games->contains($game)) {
            $this->games->add($game);
            $game->addReferee($this);
        }

        return $this;
    }

    public function removeGame(Game $game): self
    {
        if ($this->games->removeElement($game)) {
            $game->removeReferee($this);
        }

        return $this;
    }
}
