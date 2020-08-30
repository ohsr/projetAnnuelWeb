<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Serializer\Annotation\Groups;


/**
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 * @ApiResource(normalizationContext={"groups"={"userView"}})
 */
class User implements UserInterface
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     * @Groups({"commentView","userView"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=180, unique=true)
     * @Groups({"userView"})
     */
    private $email;

    /**
     * @ORM\Column(type="json")
     * @Groups({"userView"})
     */
    private $roles = [];

    /**
     * @var string The hashed password
     * @ORM\Column(type="string")
     */
    private $password;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\UserCommentSchool", mappedBy="users", orphanRemoval=true)
     */
    private $commentsSchool;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"commentView","userView"})
     *
     */
    private $firstName;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"commentView","userView"})
     */
    private $lastName;

    /**
     * @ORM\Column(type="boolean")
     * @Groups({"commentView","userView"})
     */
    private $isVerified;

    public function __construct()
    {
        $this->commentsSchool = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUsername(): string
    {
        return (string) $this->email;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getPassword(): string
    {
        return (string) $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getSalt()
    {
        // not needed when using the "bcrypt" algorithm in security.yaml
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    /**
     * @return Collection|UserCommentSchool[]
     */
    public function getCommentsSchool(): Collection
    {
        return $this->commentsSchool;
    }

    public function addCommentsSchool(UserCommentSchool $commentsSchool): self
    {
        if (!$this->commentsSchool->contains($commentsSchool)) {
            $this->commentsSchool[] = $commentsSchool;
            $commentsSchool->setUsers($this);
        }

        return $this;
    }

    public function removeCommentsSchool(UserCommentSchool $commentsSchool): self
    {
        if ($this->commentsSchool->contains($commentsSchool)) {
            $this->commentsSchool->removeElement($commentsSchool);
            // set the owning side to null (unless already changed)
            if ($commentsSchool->getUsers() === $this) {
                $commentsSchool->setUsers(null);
            }
        }

        return $this;
    }

    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    public function setFirstName(string $firstName): self
    {
        $this->firstName = $firstName;

        return $this;
    }

    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    public function setLastName(string $lastName): self
    {
        $this->lastName = $lastName;

        return $this;
    }

    public function getIsVerified(): ?bool
    {
        return $this->isVerified;
    }

    public function setIsVerified(bool $isVerified): self
    {
        $this->isVerified = $isVerified;

        return $this;
    }

}
