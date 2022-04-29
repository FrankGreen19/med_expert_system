<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: UserRepository::class)]
#[ORM\HasLifecycleCallbacks()]
class User
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private ?string $email;

    #[ORM\Column(type: 'string', length: 255)]
    private ?string $password;

    #[ORM\Column(type: 'string', length: 255)]
    private ?string $lName;

    #[ORM\Column(type: 'string', length: 255)]
    private ?string $fName;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private ?string $pName = null;

    #[ORM\Column(type: 'string', length: 255)]
    private ?string $fullName;

    #[ORM\Column(type: 'date')]
    private ?\DateTimeInterface $birthDate;

    #[ORM\ManyToOne(targetEntity: 'Role')]
    private $role;

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

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    public function getLName(): ?string
    {
        return $this->lName;
    }

    public function setLName(string $lName): self
    {
        $this->lName = $lName;

        return $this;
    }

    public function getFName(): ?string
    {
        return $this->fName;
    }

    public function setFName(string $fName): self
    {
        $this->fName = $fName;

        return $this;
    }

    public function getPName(): ?string
    {
        return $this->pName;
    }

    public function setPName(?string $pName): self
    {
        $this->pName = $pName;

        return $this;
    }

    public function getFullName(): ?string
    {
        return $this->fullName;
    }

    public function setFullName(string $fullName): self
    {
        $this->fullName = $fullName;

        return $this;
    }

    public function getBirthDate(): ?\DateTimeInterface
    {
        return $this->birthDate;
    }

    public function setBirthDate(\DateTimeInterface $birthDate): self
    {
        $this->birthDate = $birthDate;

        return $this;
    }

    #[ORM\PrePersist]
    public function constructFullName() {
        $this->fullName = $this->pName
            ? $this->lName.' '.$this->fName.' '.$this->pName
            : $this->lName.' '.$this->fName;
    }
}
