<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CategoryRepository")
 */
class Category
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\UserNoteSchool", mappedBy="categorys")
     */
    private $userNoteSchools;

    public function __construct()
    {
        $this->userNoteSchools = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return Collection|UserNoteSchool[]
     */
    public function getUserNoteSchools(): Collection
    {
        return $this->userNoteSchools;
    }

    public function addUserNoteSchool(UserNoteSchool $userNoteSchool): self
    {
        if (!$this->userNoteSchools->contains($userNoteSchool)) {
            $this->userNoteSchools[] = $userNoteSchool;
            $userNoteSchool->setCategorys($this);
        }

        return $this;
    }

    public function removeUserNoteSchool(UserNoteSchool $userNoteSchool): self
    {
        if ($this->userNoteSchools->contains($userNoteSchool)) {
            $this->userNoteSchools->removeElement($userNoteSchool);
            // set the owning side to null (unless already changed)
            if ($userNoteSchool->getCategorys() === $this) {
                $userNoteSchool->setCategorys(null);
            }
        }

        return $this;
    }
}
