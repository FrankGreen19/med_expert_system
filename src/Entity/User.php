<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

#[ORM\Entity(repositoryClass: UserRepository::class)]
#[ORM\HasLifecycleCallbacks()]
#[ORM\Table(name: '`usr`')]
class User implements UserInterface, PasswordAuthenticatedUserInterface
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

    #[ORM\ManyToMany(targetEntity: 'Role')]
    #[ORM\JoinTable(name: 'user_role')]
    #[ORM\JoinColumn(name: 'user_id', referencedColumnName: 'id')]
    private $roles;

    #[ORM\OneToOne(mappedBy: 'owner', targetEntity: RefreshToken::class, cascade: ['persist', 'remove'])]
    private $refreshToken;

    #[ORM\Column(type: 'boolean')]
    private bool $isActive;

    public function __construct($roles)
    {
        $this->roles = $roles;
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

    public function getJwtToken(): ?RefreshToken
    {
        return $this->refreshToken;
    }

    public function setJwtToken(RefreshToken $jwtToken): self
    {
        // set the owning side of the relation if necessary
        if ($jwtToken->getOwner() !== $this) {
            $jwtToken->setOwner($this);
        }

        $this->jwtToken = $jwtToken;

        return $this;
    }

    public function getRoles(): array
    {
        return $this->roles;
    }

    public function setRoles(array $roles): void
    {
        $this->roles = $roles;
    }

    public function getIsActive(): bool
    {
        return $this->isActive;
    }

    public function setIsActive(bool $isActive)
    {
        $this->isActive = $isActive;
    }

    public function eraseCredentials()
    {
        // TODO: Implement eraseCredentials() method.
    }

    public function getUserIdentifier(): string
    {
        return $this->email;
    }
}
