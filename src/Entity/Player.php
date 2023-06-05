<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\PlayerRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PlayerRepository::class)]
#[ApiResource]
class Player
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $h4aId = null;

    #[ORM\OneToOne(mappedBy: 'player', cascade: ['persist', 'remove'])]
    private ?Person $person = null;

    #[ORM\OneToMany(mappedBy: 'player', targetEntity: GameEvent::class)]
    private Collection $gameEvents;

    #[ORM\ManyToMany(targetEntity: TeamLineup::class, mappedBy: 'player')]
    private Collection $teamLineups;

    public function __construct()
    {
        $this->gameEvents = new ArrayCollection();
        $this->teamLineups = new ArrayCollection();
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
            $this->person->setPlayer(null);
        }

        // set the owning side of the relation if necessary
        if (null !== $person && $person->getPlayer() !== $this) {
            $person->setPlayer($this);
        }

        $this->person = $person;

        return $this;
    }

    /**
     * @return Collection<int, GameEvent>
     */
    public function getGameEvents(): Collection
    {
        return $this->gameEvents;
    }

    public function addGameEvent(GameEvent $gameEvent): self
    {
        if (!$this->gameEvents->contains($gameEvent)) {
            $this->gameEvents->add($gameEvent);
            $gameEvent->setPlayer($this);
        }

        return $this;
    }

    public function removeGameEvent(GameEvent $gameEvent): self
    {
        if ($this->gameEvents->removeElement($gameEvent)) {
            // set the owning side to null (unless already changed)
            if ($gameEvent->getPlayer() === $this) {
                $gameEvent->setPlayer(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, TeamLineup>
     */
    public function getTeamLineups(): Collection
    {
        return $this->teamLineups;
    }

    public function addTeamLineup(TeamLineup $teamLineup): self
    {
        if (!$this->teamLineups->contains($teamLineup)) {
            $this->teamLineups->add($teamLineup);
            $teamLineup->addPlayer($this);
        }

        return $this;
    }

    public function removeTeamLineup(TeamLineup $teamLineup): self
    {
        if ($this->teamLineups->removeElement($teamLineup)) {
            $teamLineup->removePlayer($this);
        }

        return $this;
    }
}
