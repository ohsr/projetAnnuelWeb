<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CategoryRepository")
 * @ApiResource(normalizationContext={"groups"={"categoryView"}})
 */
class Category
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     * @Groups({"categoryView","commentView"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     *  @Groups({"categoryView"})
     */
    private $name;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\UserCommentSchool", mappedBy="categorys", orphanRemoval=true)
     */
    private $comments;

    /**
     * @ORM\Column(type="text")
     * @Groups({"categoryView"})
     */
    private $info;

    /**
     * @ORM\Column(type="integer")
     * @Groups({"categoryView"})
     */
    private $coefficient;

    public function __construct()
    {
        $this->comments = new ArrayCollection();
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
     * @return Collection|UserCommentSchool[]
     */
    public function getComments(): Collection
    {
        return $this->comments;
    }

    public function addComment(UserCommentSchool $comment): self
    {
        if (!$this->comments->contains($comment)) {
            $this->comments[] = $comment;
            $comment->setCategorys($this);
        }

        return $this;
    }

    public function removeComment(UserCommentSchool $comment): self
    {
        if ($this->comments->contains($comment)) {
            $this->comments->removeElement($comment);
            // set the owning side to null (unless already changed)
            if ($comment->getCategorys() === $this) {
                $comment->setCategorys(null);
            }
        }

        return $this;
    }

    public function getInfo(): ?string
    {
        return $this->info;
    }

    public function setInfo(string $info): self
    {
        $this->info = $info;

        return $this;
    }

    public function getCoefficient(): ?int
    {
        return $this->coefficient;
    }

    public function setCoefficient(int $coefficient): self
    {
        $this->coefficient = $coefficient;

        return $this;
    }
}
