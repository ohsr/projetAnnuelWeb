<?php

namespace App\Entity;


use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiFilter;
use Doctrine\Common\Collections\Collection;
use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Annotation\ApiSubresource;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Serializer\Annotation\Groups;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\OrderFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;

/**
 * @ORM\Entity(repositoryClass="App\Repository\SchoolRepository")
 * @ApiResource(
 *     normalizationContext={"groups"={"schoolView"}}
 * )
 * @ApiFilter(SearchFilter::class, properties={"status": "exact"})
 * @ApiFilter(OrderFilter::class)
 */
class School
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     * @Groups({"schoolView"})
     */
    private $id;

    /**
     * @ORM\Column(type="integer", nullable=true)
     * @Groups({"schoolView"})
     */
    private $uai;

    /**
     * @ORM\Column(type="integer", nullable=true)
     * @Groups({"schoolView"})
     */
    private $siret;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"schoolView"})
     */
    private $type;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"schoolView"})
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups({"schoolView"})
     */
    private $sigle;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"schoolView"})
     */
    private $status;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"schoolView"})
     */
    private $adress;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"schoolView"})
     */
    private $postalCode;

    /**
     * @ORM\Column(type="integer", nullable=true)
     * @Groups({"schoolView"})
     */
    private $cityCode;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups({"schoolView"})
     */
    private $phone;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"schoolView"})
     */
    private $department;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups({"schoolView"})
     */
    private $academy;

    /**
     * @ORM\Column(type="integer", length=255, nullable=true)
     * @Groups({"schoolView"})
     */
    private $regionNum;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups({"schoolView"})
     */
    private $latitude;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups({"schoolView"})
     */
    private $longitude;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups({"schoolView"})
     */
    private $onisepLink;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $createdAt;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\UserCommentSchool", mappedBy="schools", orphanRemoval=true)
     * @ApiSubresource()
     * @Groups({"schoolView"})
     */
    private $commentsUser;

    /**
     * @ORM\Column(type="float", nullable=true)
     * @Groups({"schoolView"})
     */
    private $globalNote;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups({"schoolView"})
     */
    private $picture;

    public function __construct()
    {
        $this->commentsUser = new ArrayCollection();
    }


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUai(): ?int
    {
        return $this->uai;
    }

    public function setUai(?int $uai): self
    {
        $this->uai = $uai;

        return $this;
    }

    public function getSiret(): ?int
    {
        return $this->siret;
    }

    public function setSiret(?int $siret): self
    {
        $this->siret = $siret;

        return $this;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): self
    {
        $this->type = $type;

        return $this;
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

    public function getSigle(): ?string
    {
        return $this->sigle;
    }

    public function setSigle(?string $sigle): self
    {
        $this->sigle = $sigle;

        return $this;
    }

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(string $status): self
    {
        $this->status = $status;

        return $this;
    }

    public function getAdress(): ?string
    {
        return $this->adress;
    }

    public function setAdress(?string $adress): self
    {
        $this->adress = $adress;

        return $this;
    }

    public function getPostalCode(): ?string
    {
        return $this->postalCode;
    }

    public function setPostalCode(string $postalCode): self
    {
        $this->postalCode = $postalCode;

        return $this;
    }

    public function getCityCode(): ?int
    {
        return $this->cityCode;
    }

    public function setCityCode(int $cityCode): self
    {
        $this->cityCode = $cityCode;

        return $this;
    }

    public function getPhone(): ?string
    {
        return $this->phone;
    }

    public function setPhone(?string $phone): self
    {
        $this->phone = $phone;

        return $this;
    }

    public function getDepartment(): ?string
    {
        return $this->department;
    }

    public function setDepartment(string $department): self
    {
        $this->department = $department;

        return $this;
    }

    public function getAcademy(): ?string
    {
        return $this->academy;
    }

    public function setAcademy(?string $academy): self
    {
        $this->academy = $academy;

        return $this;
    }

    public function getRegionNum(): ?int
    {
        return $this->regionNum;
    }

    public function setRegionNum(?int $regionNum): self
    {
        $this->regionNum = $regionNum;

        return $this;
    }

    public function getLatitude(): ?string
    {
        return $this->latitude;
    }

    public function setLatitude(?string $latitude): self
    {
        $this->latitude = $latitude;

        return $this;
    }

    public function getLongitude(): ?string
    {
        return $this->longitude;
    }

    public function setLongitude(?string $longitude): self
    {
        $this->longitude = $longitude;

        return $this;
    }

    public function getOnisepLink(): ?string
    {
        return $this->onisepLink;
    }

    public function setOnisepLink(?string $onisepLink): self
    {
        $this->onisepLink = $onisepLink;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(?\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * @return Collection|UserCommentSchool[]
     */
    public function getCommentsUser(): Collection
    {
        return $this->commentsUser;
    }

    public function addCommentsUser(UserCommentSchool $commentsUser): self
    {
        if (!$this->commentsUser->contains($commentsUser)) {
            $this->commentsUser[] = $commentsUser;
            $commentsUser->setSchools($this);
        }

        return $this;
    }

    public function removeCommentsUser(UserCommentSchool $commentsUser): self
    {
        if ($this->commentsUser->contains($commentsUser)) {
            $this->commentsUser->removeElement($commentsUser);
            // set the owning side to null (unless already changed)
            if ($commentsUser->getSchools() === $this) {
                $commentsUser->setSchools(null);
            }
        }

        return $this;
    }

    public function getGlobalNote(): ?float
    {
        return $this->globalNote;
    }

    public function setGlobalNote(?float $globalNote): self
    {
        $this->globalNote = $globalNote;

        return $this;
    }

    public function getPicture(): ?string
    {
        return $this->picture;
    }

    public function setPicture(?string $picture): self
    {
        $this->picture = $picture;

        return $this;
    }



}
