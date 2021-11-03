<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\EventRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource
 * @ORM\Entity(repositoryClass=EventRepository::class)
 */
class Event
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $title;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $description;

    /**
     * @ORM\ManyToOne(targetEntity=Address::class, inversedBy="events")
     */
    private $address;

    /**
     * @ORM\Column(type="date")
     */
    private $date_begin;

    /**
     * @ORM\Column(type="date")
     */
    private $date_end;

    /**
     * @ORM\ManyToMany(targetEntity=User::class, inversedBy="events")
     */
    private $participants;

    /**
     * @ORM\OneToMany(targetEntity=Activity::class, mappedBy="event", orphanRemoval=true)
     */
    private $activities;

    /**
     * @ORM\OneToMany(targetEntity=Cost::class, mappedBy="event")
     */
    private $costs;

    /**
     * @ORM\OneToMany(targetEntity=Accomodation::class, mappedBy="event", orphanRemoval=true)
     */
    private $accomodations;

    /**
     * @ORM\OneToMany(targetEntity=Transport::class, mappedBy="event", orphanRemoval=true)
     */
    private $transports;

    public function __construct()
    {
        $this->participants = new ArrayCollection();
        $this->activities = new ArrayCollection();
        $this->costs = new ArrayCollection();
        $this->accomodations = new ArrayCollection();
        $this->transports = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getAddress(): ?Address
    {
        return $this->address;
    }

    public function setAddress(?Address $address): self
    {
        $this->address = $address;

        return $this;
    }

    public function getDateBegin(): ?\DateTimeInterface
    {
        return $this->date_begin;
    }

    public function setDateBegin(\DateTimeInterface $date_begin): self
    {
        $this->date_begin = $date_begin;

        return $this;
    }

    public function getDateEnd(): ?\DateTimeInterface
    {
        return $this->date_end;
    }

    public function setDateEnd(\DateTimeInterface $date_end): self
    {
        $this->date_end = $date_end;

        return $this;
    }

    /**
     * @return Collection|User[]
     */
    public function getParticipants(): Collection
    {
        return $this->participants;
    }

    public function addParticipant(User $participant): self
    {
        if (!$this->participants->contains($participant)) {
            $this->participants[] = $participant;
        }

        return $this;
    }

    public function removeParticipant(User $participant): self
    {
        $this->participants->removeElement($participant);

        return $this;
    }

    /**
     * @return Collection|Activity[]
     */
    public function getActivities(): Collection
    {
        return $this->activities;
    }

    public function addActivity(Activity $activity): self
    {
        if (!$this->activities->contains($activity)) {
            $this->activities[] = $activity;
            $activity->setEvent($this);
        }

        return $this;
    }

    public function removeActivity(Activity $activity): self
    {
        if ($this->activities->removeElement($activity)) {
            // set the owning side to null (unless already changed)
            if ($activity->getEvent() === $this) {
                $activity->setEvent(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Cost[]
     */
    public function getCosts(): Collection
    {
        return $this->costs;
    }

    public function addCost(Cost $cost): self
    {
        if (!$this->costs->contains($cost)) {
            $this->costs[] = $cost;
            $cost->setEvent($this);
        }

        return $this;
    }

    public function removeCost(Cost $cost): self
    {
        if ($this->costs->removeElement($cost)) {
            // set the owning side to null (unless already changed)
            if ($cost->getEvent() === $this) {
                $cost->setEvent(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Accomodation[]
     */
    public function getAccomodations(): Collection
    {
        return $this->accomodations;
    }

    public function addAccomodation(Accomodation $accomodation): self
    {
        if (!$this->accomodations->contains($accomodation)) {
            $this->accomodations[] = $accomodation;
            $accomodation->setEvent($this);
        }

        return $this;
    }

    public function removeAccomodation(Accomodation $accomodation): self
    {
        if ($this->accomodations->removeElement($accomodation)) {
            // set the owning side to null (unless already changed)
            if ($accomodation->getEvent() === $this) {
                $accomodation->setEvent(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Transport[]
     */
    public function getTransports(): Collection
    {
        return $this->transports;
    }

    public function addTransport(Transport $transport): self
    {
        if (!$this->transports->contains($transport)) {
            $this->transports[] = $transport;
            $transport->setEvent($this);
        }

        return $this;
    }

    public function removeTransport(Transport $transport): self
    {
        if ($this->transports->removeElement($transport)) {
            // set the owning side to null (unless already changed)
            if ($transport->getEvent() === $this) {
                $transport->setEvent(null);
            }
        }

        return $this;
    }
}
