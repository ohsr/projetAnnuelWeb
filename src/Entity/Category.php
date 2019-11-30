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
     * @Groups({"schoolView","categoryView"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     *  @Groups({"schoolView","categoryView"})
     */
    private $name;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\UserNoteSchool", mappedBy="categorys", orphanRemoval=true)
     */
    private $notes;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\UserCommentSchool", mappedBy="categorys", orphanRemoval=true)
     */
    private $comments;

    public function __construct()
    {
        $this->notes = new ArrayCollection();
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
     * @return Collection|UserNoteSchool[]
     */
    public function getNotes(): Collection
    {
        return $this->notes;
    }

    public function addNote(UserNoteSchool $note): self
    {
        if (!$this->notes->contains($note)) {
            $this->notes[] = $note;
            $note->setCategorys($this);
        }

        return $this;
    }

    public function removeNote(UserNoteSchool $note): self
    {
        if ($this->notes->contains($note)) {
            $this->notes->removeElement($note);
            // set the owning side to null (unless already changed)
            if ($note->getCategorys() === $this) {
                $note->setCategorys(null);
            }
        }

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
}
