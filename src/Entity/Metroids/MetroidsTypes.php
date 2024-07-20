<?php

namespace App\Entity\Metroids;

use App\Repository\Metroids\MetroidsTypesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MetroidsTypesRepository::class)]
class MetroidsTypes
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    /**
     * @var Collection<int, Metroids>
     */
    #[ORM\OneToMany(targetEntity: Metroids::class, mappedBy: 'refMetroidsTypes')]
    private Collection $metroids;

    public function __construct()
    {
        $this->metroids = new ArrayCollection();
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
            $metroid->setRefMetroidsTypes($this);
        }

        return $this;
    }

    public function removeMetroid(Metroids $metroid): static
    {
        if ($this->metroids->removeElement($metroid)) {
            // set the owning side to null (unless already changed)
            if ($metroid->getRefMetroidsTypes() === $this) {
                $metroid->setRefMetroidsTypes(null);
            }
        }

        return $this;
    }
}
