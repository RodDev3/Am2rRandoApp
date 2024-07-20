<?php

namespace App\Entity\Rooms;

use App\Entity\Areas\Areas;
use App\Entity\Metroids\Metroids;
use App\Repository\Rooms\RoomsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: RoomsRepository::class)]
class Rooms
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $basename = null;

    #[ORM\Column]
    private ?bool $hasItem = null;

    #[ORM\ManyToOne(inversedBy: 'rooms')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Areas $refAreas = null;

    /**
     * @var Collection<int, Metroids>
     */
    #[ORM\OneToMany(targetEntity: Metroids::class, mappedBy: 'refRooms')]
    private Collection $metroids;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $shortName = null;

    public function __construct()
    {
        $this->metroids = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getBaseName(): ?string
    {
        return $this->basename;
    }

    public function setBaseName(string $basename): static
    {
        $this->basename = $basename;

        return $this;
    }

    public function hasItem(): ?bool
    {
        return $this->hasItem;
    }

    public function setHasItem(bool $hasItem): static
    {
        $this->hasItem = $hasItem;

        return $this;
    }

    public function getRefAreas(): ?Areas
    {
        return $this->refAreas;
    }

    public function setRefAreas(?Areas $refAreas): static
    {
        $this->refAreas = $refAreas;

        return $this;
    }

    /**
     * @return Collection<int, Metroids>
     */
    public function getMetroids(): Collection
    {
        return $this->metroids;
    }

    public function addMetroid(Metroids $metroid): static
    {
        if (!$this->metroids->contains($metroid)) {
            $this->metroids->add($metroid);
            $metroid->setRefRooms($this);
        }

        return $this;
    }

    public function removeMetroid(Metroids $metroid): static
    {
        if ($this->metroids->removeElement($metroid)) {
            // set the owning side to null (unless already changed)
            if ($metroid->getRefRooms() === $this) {
                $metroid->setRefRooms(null);
            }
        }

        return $this;
    }

    public function getShortName(): ?string
    {
        return $this->shortName;
    }

    public function setShortName(?string $shortName): static
    {
        $this->shortName = $shortName;

        return $this;
    }
}
