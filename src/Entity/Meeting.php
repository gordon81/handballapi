<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\MeetingRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MeetingRepository::class)]
#[ApiResource]
class Meeting
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $date = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $registrationDeadline = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\OneToOne(mappedBy: 'meeting', cascade: ['persist', 'remove'])]
    private ?Training $training = null;

    #[ORM\OneToOne(mappedBy: 'meeting', cascade: ['persist', 'remove'])]
    private ?Game $game = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function getRegistrationDeadline(): ?\DateTimeInterface
    {
        return $this->registrationDeadline;
    }

    public function setRegistrationDeadline(\DateTimeInterface $registrationDeadline): self
    {
        $this->registrationDeadline = $registrationDeadline;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getTraining(): ?Training
    {
        return $this->training;
    }

    public function setTraining(?Training $training): self
    {
        // unset the owning side of the relation if necessary
        if (null === $training && null !== $this->training) {
            $this->training->setMeeting(null);
        }

        // set the owning side of the relation if necessary
        if (null !== $training && $training->getMeeting() !== $this) {
            $training->setMeeting($this);
        }

        $this->training = $training;

        return $this;
    }

    public function getGame(): ?Game
    {
        return $this->game;
    }

    public function setGame(?Game $game): self
    {
        // unset the owning side of the relation if necessary
        if (null === $game && null !== $this->game) {
            $this->game->setMeeting(null);
        }

        // set the owning side of the relation if necessary
        if (null !== $game && $game->getMeeting() !== $this) {
            $game->setMeeting($this);
        }

        $this->game = $game;

        return $this;
    }
}
