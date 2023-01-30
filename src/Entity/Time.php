<?php

namespace App\Entity;

use App\Repository\TimeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TimeRepository::class)]
class Time
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $date = null;

    #[ORM\Column(type: Types::TIME_MUTABLE)]
    private ?\DateTimeInterface $hour = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $startplay = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $endplay = null;

    #[ORM\ManyToOne(inversedBy: 'reservation')]
    private ?User $user = null;

    #[ORM\ManyToOne(inversedBy: 'reservation')]
    private ?Terrain $terrain = null;

    #[ORM\OneToMany(mappedBy: 'time', targetEntity: Players::class)]
    private Collection $player;



    public function __construct()
    {
        $this->player = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }


    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function getTerrain(): ?Terrain
    {
        return $this->terrain;
    }

    public function setTerrain(?Terrain $terrain): self
    {
        $this->terrain = $terrain;

        return $this;
    }

    /**
     * @return Collection<int, Players>
     */
    public function getPlayer(): Collection
    {
        return $this->player;
    }

    public function addPlayer(Players $player): self
    {
        if (!$this->player->contains($player)) {
            $this->player->add($player);
            $player->setTime($this);
        }

        return $this;
    }

    public function removePlayer(Players $player): self
    {
        if ($this->player->removeElement($player)) {
            // set the owning side to null (unless already changed)
            if ($player->getTime() === $this) {
                $player->setTime(null);
            }
        }

        return $this;
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

    public function getHour(): ?\DateTimeInterface
    {
        return $this->hour;
    }

    public function setHour(\DateTimeInterface $hour): self
    {
        $this->hour = $hour;

        return $this;
    }

    public function getStartplay(): ?\DateTimeInterface
    {
        return $this->startplay;
    }

    public function setStartplay(\DateTimeInterface $startplay): self
    {
        $this->startplay = $startplay;

        return $this;
    }

    public function getEndplay(): ?\DateTimeInterface
    {
        return $this->endplay;
    }

    public function setEndplay(\DateTimeInterface $endplay): self
    {
        $this->endplay = $endplay;

        return $this;
    }


}
