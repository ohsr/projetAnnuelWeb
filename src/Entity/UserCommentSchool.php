<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiFilter;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Serializer\Annotation\Groups;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UserCommentSchoolRepository")
 * @ApiResource(
 *      normalizationContext={"groups"={"commentView"}},
 *      attributes={"pagination_enabled"=false}
 * )
 * @ApiFilter(SearchFilter::class, properties={"schools": "exact","categorys": "exact"})
 */
class UserCommentSchool
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     * @Groups({"commentView"})
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="commentsSchool")
     * @ORM\JoinColumn(nullable=true))
     * @Groups({"commentView"})
     */
    private $users;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\School", inversedBy="commentsUser")
     * @ORM\JoinColumn(nullable=true)
     */
    private $schools;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Category", inversedBy="comments")
     * @ORM\JoinColumn(nullable=true)
     * @Groups({"commentView"})
     */
    private $categorys;

    /**
     * @ORM\Column(type="text", nullable=true)
     * @Groups({"commentView","userView"})
     */
    private $comment;

    /**
     * @ORM\Column(type="integer")
     * @Groups({"commentView"})
     */
    private $note;

    /**
     * @ORM\Column(type="datetime")
     */
    private $createdAt;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUsers(): ?User
    {
        return $this->users;
    }

    public function setUsers(?User $users): self
    {
        $this->users = $users;

        return $this;
    }

    public function getSchools(): ?School
    {
        return $this->schools;
    }

    public function setSchools(?School $schools): self
    {
        $this->schools = $schools;

        return $this;
    }

    public function getCategorys(): ?Category
    {
        return $this->categorys;
    }

    public function setCategorys(?Category $categorys): self
    {
        $this->categorys = $categorys;

        return $this;
    }

    public function getComment(): ?string
    {
        return $this->comment;
    }

    public function setComment(string $comment): self
    {
        $this->comment = $comment;

        return $this;
    }

    public function getNote(): ?int
    {
        return $this->note;
    }

    public function setNote(int $note): self
    {
        $this->note = $note;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }
}
