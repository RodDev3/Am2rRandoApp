<?php

namespace App\Entity\Metroids;

use App\Entity\Rooms\Rooms;
use App\Repository\Metroids\MetroidsRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MetroidsRepository::class)]
class Metroids
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'metroids')]
    #[ORM\JoinColumn(nullable: false)]
    private ?MetroidsTypes $refMetroidsTypes = null;

    #[ORM\ManyToOne(inversedBy: 'metroids')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Rooms $refRooms = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getRefMetroidsTypes(): ?MetroidsTypes
    {
        return $this->refMetroidsTypes;
    }

    public function setRefMetroidsTypes(?MetroidsTypes $refMetroidsTypes): static
    {
        $this->refMetroidsTypes = $refMetroidsTypes;

        return $this;
    }

    public function getRefRooms(): ?Rooms
    {
        return $this->refRooms;
    }

    public function setRefRooms(?Rooms $refRooms): static
    {
        $this->refRooms = $refRooms;

        return $this;
    }
}
