<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ActivityRepository")
 */
class Activity
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $name;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $description;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $price;

    /**
     * @ORM\Column(type="boolean")
     */
    private $popular;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\ActivityCategoryLink", mappedBy="activity")
     */
    private $activity;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\ActivityImagesLink", mappedBy="activity")
     */
    private $images;

    public function __construct()
    {
        $this->activity = new ArrayCollection();
        $this->images = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): self
    {
        $this->name = $name;

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

    public function getPrice(): ?float
    {
        return $this->price;
    }

    public function setPrice(?float $price): self
    {
        $this->price = $price;

        return $this;
    }

    public function getPopular(): ?bool
    {
        return $this->popular;
    }

    public function setPopular(bool $popular): self
    {
        $this->popular = $popular;

        return $this;
    }

    /**
     * @return Collection|ActivityCategoryLink[]
     */
    public function getActivity(): Collection
    {
        return $this->activity;
    }

    public function getCategoriesArray(): array
    {
        $listOfActivityCategory = [];

        foreach ($this->getActivity() AS $value) {
            $listOfActivityCategory[] = $value->getCategory()->getName();
        }

        return $listOfActivityCategory;
    }

    public function addActivity(ActivityCategoryLink $activity): self
    {
        if (!$this->activity->contains($activity)) {
            $this->activity[] = $activity;
            $activity->setActivity($this);
        }

        return $this;
    }

    public function removeActivity(ActivityCategoryLink $activity): self
    {
        if ($this->activity->contains($activity)) {
            $this->activity->removeElement($activity);
            // set the owning side to null (unless already changed)
            if ($activity->getActivity() === $this) {
                $activity->setActivity(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|ActivityImagesLink[]
     */
    public function getImages(): Collection
    {
        return $this->images;
    }

    public function getImagesArray(): array
    {
        $listOfImagesUrl = [];

        foreach ($this->getImages() AS $image) {
            $listOfImagesUrl[] = $image->getImageUrl();
        }

        return $listOfImagesUrl;
    }

    public function addImage(ActivityImagesLink $image): self
    {
        if (!$this->images->contains($image)) {
            $this->images[] = $image;
            $image->setActivity($this);
        }

        return $this;
    }

    public function removeImage(ActivityImagesLink $image): self
    {
        if ($this->images->contains($image)) {
            $this->images->removeElement($image);
            // set the owning side to null (unless already changed)
            if ($image->getActivity() === $this) {
                $image->setActivity(null);
            }
        }

        return $this;
    }
}
