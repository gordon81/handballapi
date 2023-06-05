<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\GameRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: GameRepository::class)]
#[ApiResource]
class Game
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $h4aId = null;

    #[ORM\OneToOne(inversedBy: 'game', cascade: ['persist', 'remove'])]
    private ?Meeting $meeting = null;

    #[ORM\Column(length: 255)]
    private ?string $startTime = null;

    #[ORM\Column(type: Types::TIME_MUTABLE)]
    private ?\DateTimeInterface $endtime = null;

    #[ORM\Column(length: 255)]
    private ?string $token = null;

    #[ORM\Column]
    private ?int $appId = null;

    #[ORM\Column(length: 255)]
    private ?string $report = null;

    #[ORM\ManyToMany(targetEntity: Referee::class, inversedBy: 'games')]
    private Collection $referees;

    #[ORM\ManyToOne(inversedBy: 'games')]
    private ?Team $home = null;

    #[ORM\ManyToOne(inversedBy: 'games')]
    private ?Team $guest = null;

    #[ORM\Column]
    private ?bool $live = null;

    #[ORM\ManyToOne(inversedBy: 'games')]
    private ?Gymnasium $gymnasium = null;

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    private ?GamesGoals $goals = null;

    #[ORM\OneToMany(mappedBy: 'game', targetEntity: GameEvent::class)]
    private Collection $gameEvents;

    #[ORM\OneToMany(mappedBy: 'game', targetEntity: TeamLineup::class)]
    private Collection $teamLineups;

    public function __construct()
    {
        $this->referees = new ArrayCollection();
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

    public function getMeeting(): ?Meeting
    {
        return $this->meeting;
    }

    public function setMeeting(?Meeting $meeting): self
    {
        $this->meeting = $meeting;

        return $this;
    }

    public function getStartTime(): ?string
    {
        return $this->startTime;
    }

    public function setStartTime(string $startTime): self
    {
        $this->startTime = $startTime;

        return $this;
    }

    public function getEndtime(): ?\DateTimeInterface
    {
        return $this->endtime;
    }

    public function setEndtime(\DateTimeInterface $endtime): self
    {
        $this->endtime = $endtime;

        return $this;
    }

    public function getToken(): ?string
    {
        return $this->token;
    }

    public function setToken(string $token): self
    {
        $this->token = $token;

        return $this;
    }

    public function getAppId(): ?int
    {
        return $this->appId;
    }

    public function setAppId(int $appId): self
    {
        $this->appId = $appId;

        return $this;
    }

    public function getReport(): ?string
    {
        return $this->report;
    }

    public function setReport(string $report): self
    {
        $this->report = $report;

        return $this;
    }

    /**
     * @return Collection<int, Referee>
     */
    public function getReferees(): Collection
    {
        return $this->referees;
    }

    public function addReferee(Referee $referee): self
    {
        if (!$this->referees->contains($referee)) {
            $this->referees->add($referee);
        }

        return $this;
    }

    public function removeReferee(Referee $referee): self
    {
        $this->referees->removeElement($referee);

        return $this;
    }

    public function getHome(): ?Team
    {
        return $this->home;
    }

    public function setHome(?Team $home): self
    {
        $this->home = $home;

        return $this;
    }

    public function getGuest(): ?Team
    {
        return $this->guest;
    }

    public function setGuest(?Team $guest): self
    {
        $this->guest = $guest;

        return $this;
    }

    public function isLive(): ?bool
    {
        return $this->live;
    }

    public function setLive(bool $live): self
    {
        $this->live = $live;

        return $this;
    }

    public function getGymnasium(): ?Gymnasium
    {
        return $this->gymnasium;
    }

    public function setGymnasium(?Gymnasium $gymnasium): self
    {
        $this->gymnasium = $gymnasium;

        return $this;
    }

    public function getGoals(): ?GamesGoals
    {
        return $this->goals;
    }

    public function setGoals(?GamesGoals $goals): self
    {
        $this->goals = $goals;

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
            $gameEvent->setGame($this);
        }

        return $this;
    }

    public function removeGameEvent(GameEvent $gameEvent): self
    {
        if ($this->gameEvents->removeElement($gameEvent)) {
            // set the owning side to null (unless already changed)
            if ($gameEvent->getGame() === $this) {
                $gameEvent->setGame(null);
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
            $teamLineup->setGame($this);
        }

        return $this;
    }

    public function removeTeamLineup(TeamLineup $teamLineup): self
    {
        if ($this->teamLineups->removeElement($teamLineup)) {
            // set the owning side to null (unless already changed)
            if ($teamLineup->getGame() === $this) {
                $teamLineup->setGame(null);
            }
        }

        return $this;
    }
}
