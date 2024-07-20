<?php

namespace App\Entity\Areas;

use App\Entity\Rooms\Rooms;
use App\Repository\Areas\AreasRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AreasRepository::class)]
class Areas
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $name = null;

    #[ORM\Column(length: 255)]
    private ?string $basename = null;

    /**
     * @var Collection<int, Rooms>
     */
    #[ORM\OneToMany(targetEntity: Rooms::class, mappedBy: 'refAreas')]
    private Collection $rooms;

    #[ORM\ManyToOne(targetEntity: self::class, inversedBy: 'areas')]
    private ?self $refParent = null;


    //TODO CHECK DANS QUELLE SENS VA LE MAPPEDBY ET RENAME LA VARIABLE
    /**
     * @var Collection<int, self>
     */
    #[ORM\OneToMany(targetEntity: self::class, mappedBy: 'refParent')]
    private Collection $areas;

    public function __construct()
    {
        $this->rooms = new ArrayCollection();
        $this->areas = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getBasename(): ?string
    {
        return $this->basename;
    }

    public function setBasename(string $basename): static
    {
        $this->basename = $basename;

        return $this;
    }

    /**
     * @return Collection<int, Rooms>
     */
    public function getRooms(): Collection
    {
        return $this->rooms;
    }

    public function addRoom(Rooms $room): static
    {
        if (!$this->rooms->contains($room)) {
            $this->rooms->add($room);
            $room->setRefAreas($this);
        }

        return $this;
    }

    public function removeRoom(Rooms $room): static
    {
        if ($this->rooms->removeElement($room)) {
            // set the owning side to null (unless already changed)
            if ($room->getRefAreas() === $this) {
                $room->setRefAreas(null);
            }
        }

        return $this;
    }

    public function getRefParent(): ?self
    {
        return $this->refParent;
    }

    public function setRefParent(?self $refParent): static
    {
        $this->refParent = $refParent;

        return $this;
    }

    /**
     * @return Collection<int, self>
     */
    public function getAreas(): Collection
    {
        return $this->areas;
    }

    public function addArea(self $area): static
    {
        if (!$this->areas->contains($area)) {
            $this->areas->add($area);
            $area->setRefParent($this);
        }

        return $this;
    }

    public function removeArea(self $area): static
    {
        if ($this->areas->removeElement($area)) {
            // set the owning side to null (unless already changed)
            if ($area->getRefParent() === $this) {
                $area->setRefParent(null);
            }
        }

        return $this;
    }
}
