<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\TransportRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource
 * @ORM\Entity(repositoryClass=TransportRepository::class)
 */
class Transport
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Address::class, inversedBy="transports_from")
     * @ORM\JoinColumn(nullable=false)
     */
    private $address_from;

    /**
     * @ORM\ManyToOne(targetEntity=Address::class, inversedBy="transports_to")
     * @ORM\JoinColumn(nullable=false)
     */
    private $address_to;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $type;

    /**
     * @ORM\Column(type="datetime")
     */
    private $date_departure;

    /**
     * @ORM\Column(type="float")
     */
    private $duration;

    /**
     * @ORM\OneToOne(targetEntity=Cost::class, inversedBy="transport", cascade={"persist", "remove"})
     */
    private $cost;

    /**
     * @ORM\ManyToOne(targetEntity=Event::class, inversedBy="transports")
     * @ORM\JoinColumn(nullable=false)
     */
    private $event;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAddressFrom(): ?Address
    {
        return $this->address_from;
    }

    public function setAddressFrom(?Address $address_from): self
    {
        $this->address_from = $address_from;

        return $this;
    }

    public function getAddressTo(): ?Address
    {
        return $this->address_to;
    }

    public function setAddressTo(?Address $address_to): self
    {
        $this->address_to = $address_to;

        return $this;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function getDateDeparture(): ?\DateTimeInterface
    {
        return $this->date_departure;
    }

    public function setDateDeparture(\DateTimeInterface $date_departure): self
    {
        $this->date_departure = $date_departure;

        return $this;
    }

    public function getDuration(): ?float
    {
        return $this->duration;
    }

    public function setDuration(float $duration): self
    {
        $this->duration = $duration;

        return $this;
    }

    public function getCost(): ?Cost
    {
        return $this->cost;
    }

    public function setCost(?Cost $cost): self
    {
        $this->cost = $cost;

        return $this;
    }

    public function getEvent(): ?Event
    {
        return $this->event;
    }

    public function setEvent(?Event $event): self
    {
        $this->event = $event;

        return $this;
    }
}
