<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ActivityCategoryRepository")
 */
class ActivityCategory
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
     * @ORM\OneToMany(targetEntity="App\Entity\ActivityCategoryLink", mappedBy="category")
     */
    private $category_links;

    public function __construct()
    {
        $this->category_links = new ArrayCollection();
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

    /**
     * @return Collection|ActivityCategoryLink[]
     */
    public function getCategoryLinks(): Collection
    {
        return $this->category_links;
    }

    public function addCategoryLink(ActivityCategoryLink $categoryLink): self
    {
        if (!$this->category_links->contains($categoryLink)) {
            $this->category_links[] = $categoryLink;
            $categoryLink->setCategory($this);
        }

        return $this;
    }

    public function removeCategoryLink(ActivityCategoryLink $categoryLink): self
    {
        if ($this->category_links->contains($categoryLink)) {
            $this->category_links->removeElement($categoryLink);
            // set the owning side to null (unless already changed)
            if ($categoryLink->getCategory() === $this) {
                $categoryLink->setCategory(null);
            }
        }

        return $this;
    }
}
