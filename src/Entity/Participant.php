<?php

namespace App\Entity;

use App\Repository\ParticipantRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: ParticipantRepository::class)]
class Participant
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    #[Assert\NotBlank]
    #[Assert\Length(min: 3, max: 50)]
    private ?string $name = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank]
    #[Assert\Email]
    private ?string $email = null;

    /**
     * @var Collection<int, Event>
     */
    #[ORM\ManyToMany(targetEntity: Event::class, inversedBy: 'participants')]
    #[ORM\JoinTable(name: "participant_event", )]
    #[ORM\JoinColumn(name: 'participant_id', referencedColumnName: 'id')]
    #[ORM\InverseJoinColumn(name: 'event_id', referencedColumnName: 'id')]
    private Collection $events;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank]
    private ?string $address_long = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank]
    private ?string $address_lat = null;

    public function __construct()
    {
        $this->events = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): static
    {
        $this->email = $email;

        return $this;
    }

    /**
     * @return Collection<int, Event>
     */
    public function getEvents(): Collection
    {
        return $this->events;
    }

    public function addEvent(Event $event): static
    {
        if (!$this->events->contains($event)) {
            $this->events->add($event);
        }

        return $this;
    }

    public function removeEvent(Event $event): static
    {
        $this->events->removeElement($event);

        return $this;
    }

    public function getAddressLong(): ?string
    {
        return $this->address_long;
    }

    public function setAddressLong(string $address_long): static
    {
        $this->address_long = $address_long;

        return $this;
    }

    public function getAddressLat(): ?string
    {
        return $this->address_lat;
    }

    public function setAddressLat(string $address_lat): static
    {
        $this->address_lat = $address_lat;

        return $this;
    }
}
