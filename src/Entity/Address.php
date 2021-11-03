<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\AddressRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource
 * @ORM\Entity(repositoryClass=AddressRepository::class)
 */
class Address
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
     * @ORM\Column(type="string", length=255)
     */
    private $address1;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $address2;

    /**
     * @ORM\Column(type="string", length=10)
     */
    private $postcode;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="address")
     * @ORM\JoinColumn(nullable=false)
     */
    private $address_user;

    /**
     * @ORM\OneToMany(targetEntity=Activity::class, mappedBy="address")
     */
    private $activities;

    /**
     * @ORM\OneToMany(targetEntity=Event::class, mappedBy="address")
     */
    private $events;

    /**
     * @ORM\OneToMany(targetEntity=Accomodation::class, mappedBy="address")
     */
    private $accomodations;

    /**
     * @ORM\OneToMany(targetEntity=Transport::class, mappedBy="address_from")
     */
    private $transports_from;

    /**
     * @ORM\OneToMany(targetEntity=Transport::class, mappedBy="address_to")
     */
    private $transports_to;

    /**
     * @ORM\ManyToOne(targetEntity=City::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $city;

    public function __construct()
    {
        $this->activities = new ArrayCollection();
        $this->events = new ArrayCollection();
        $this->accomodations = new ArrayCollection();
        $this->transports_from = new ArrayCollection();
        $this->transports_to = new ArrayCollection();
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

    public function getAddress1(): ?string
    {
        return $this->address1;
    }

    public function setAddress1(string $address1): self
    {
        $this->address1 = $address1;

        return $this;
    }

    public function getAddress2(): ?string
    {
        return $this->address2;
    }

    public function setAddress2(string $address2): self
    {
        $this->address2 = $address2;

        return $this;
    }

    public function getPostcode(): ?string
    {
        return $this->postcode;
    }

    public function setPostcode(string $postcode): self
    {
        $this->postcode = $postcode;

        return $this;
    }

    public function getAddressUser(): ?User
    {
        return $this->address_user;
    }

    public function setAddressUser(?User $address_user): self
    {
        $this->address_user = $address_user;

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
            $activity->setAddress($this);
        }

        return $this;
    }

    public function removeActivity(Activity $activity): self
    {
        if ($this->activities->removeElement($activity)) {
            // set the owning side to null (unless already changed)
            if ($activity->getAddress() === $this) {
                $activity->setAddress(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Event[]
     */
    public function getEvents(): Collection
    {
        return $this->events;
    }

    public function addEvent(Event $event): self
    {
        if (!$this->events->contains($event)) {
            $this->events[] = $event;
            $event->setAddress($this);
        }

        return $this;
    }

    public function removeEvent(Event $event): self
    {
        if ($this->events->removeElement($event)) {
            // set the owning side to null (unless already changed)
            if ($event->getAddress() === $this) {
                $event->setAddress(null);
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
            $accomodation->setAddress($this);
        }

        return $this;
    }

    public function removeAccomodation(Accomodation $accomodation): self
    {
        if ($this->accomodations->removeElement($accomodation)) {
            // set the owning side to null (unless already changed)
            if ($accomodation->getAddress() === $this) {
                $accomodation->setAddress(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Transport[]
     */
    public function getTransportsFrom(): Collection
    {
        return $this->transports_from;
    }

    public function addTransportsFrom(Transport $transportsFrom): self
    {
        if (!$this->transports_from->contains($transportsFrom)) {
            $this->transports_from[] = $transportsFrom;
            $transportsFrom->setAddressFrom($this);
        }

        return $this;
    }

    public function removeTransportsFrom(Transport $transportsFrom): self
    {
        if ($this->transports_from->removeElement($transportsFrom)) {
            // set the owning side to null (unless already changed)
            if ($transportsFrom->getAddressFrom() === $this) {
                $transportsFrom->setAddressFrom(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Transport[]
     */
    public function getTransportsTo(): Collection
    {
        return $this->transports_to;
    }

    public function addTransportsTo(Transport $transportsTo): self
    {
        if (!$this->transports_to->contains($transportsTo)) {
            $this->transports_to[] = $transportsTo;
            $transportsTo->setAddressTo($this);
        }

        return $this;
    }

    public function removeTransportsTo(Transport $transportsTo): self
    {
        if ($this->transports_to->removeElement($transportsTo)) {
            // set the owning side to null (unless already changed)
            if ($transportsTo->getAddressTo() === $this) {
                $transportsTo->setAddressTo(null);
            }
        }

        return $this;
    }

    public function getCity(): ?City
    {
        return $this->city;
    }

    public function setCity(?City $city): self
    {
        $this->city = $city;

        return $this;
    }
}
