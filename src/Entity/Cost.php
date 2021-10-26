<?php

namespace App\Entity;

use App\Repository\CostRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CostRepository::class)
 */
class Cost
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
     * @ORM\Column(type="float")
     */
    private $amount;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $paid;

    /**
     * @ORM\OneToOne(targetEntity=Activity::class, mappedBy="cost", cascade={"persist", "remove"})
     */
    private $activity;

    /**
     * @ORM\ManyToOne(targetEntity=Event::class, inversedBy="costs")
     */
    private $event;

    /**
     * @ORM\OneToOne(targetEntity=Accomodation::class, mappedBy="cost", cascade={"persist", "remove"})
     */
    private $accomodation;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="costs")
     */
    private $paid_by;

    /**
     * @ORM\OneToOne(targetEntity=Transport::class, mappedBy="cost", cascade={"persist", "remove"})
     */
    private $transport;

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

    public function getAmount(): ?float
    {
        return $this->amount;
    }

    public function setAmount(float $amount): self
    {
        $this->amount = $amount;

        return $this;
    }

    public function getPaid(): ?bool
    {
        return $this->paid;
    }

    public function setPaid(?bool $paid): self
    {
        $this->paid = $paid;

        return $this;
    }

    public function getActivity(): ?Activity
    {
        return $this->activity;
    }

    public function setActivity(?Activity $activity): self
    {
        // unset the owning side of the relation if necessary
        if ($activity === null && $this->activity !== null) {
            $this->activity->setCost(null);
        }

        // set the owning side of the relation if necessary
        if ($activity !== null && $activity->getCost() !== $this) {
            $activity->setCost($this);
        }

        $this->activity = $activity;

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

    public function getAccomodation(): ?Accomodation
    {
        return $this->accomodation;
    }

    public function setAccomodation(?Accomodation $accomodation): self
    {
        // unset the owning side of the relation if necessary
        if ($accomodation === null && $this->accomodation !== null) {
            $this->accomodation->setCost(null);
        }

        // set the owning side of the relation if necessary
        if ($accomodation !== null && $accomodation->getCost() !== $this) {
            $accomodation->setCost($this);
        }

        $this->accomodation = $accomodation;

        return $this;
    }

    public function getPaidBy(): ?User
    {
        return $this->paid_by;
    }

    public function setPaidBy(?User $paid_by): self
    {
        $this->paid_by = $paid_by;

        return $this;
    }

    public function getTransport(): ?Transport
    {
        return $this->transport;
    }

    public function setTransport(?Transport $transport): self
    {
        // unset the owning side of the relation if necessary
        if ($transport === null && $this->transport !== null) {
            $this->transport->setCost(null);
        }

        // set the owning side of the relation if necessary
        if ($transport !== null && $transport->getCost() !== $this) {
            $transport->setCost($this);
        }

        $this->transport = $transport;

        return $this;
    }
}
