<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
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

    #[ORM\Column(type: 'boolean')]
    private bool $isActive;

    #[ORM\OneToMany(mappedBy: 'usr', targetEntity: MedicalTest::class)]
    private $medicalTests;

    public function __construct()
    {
        $this->medicalTests = new ArrayCollection();
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

    public function getUserIdentifier(): string
    {
        return (string) $this->email;
    }

    public function getUsername(): string
    {
        return (string) $this->email;
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

    public function getRoles(): array
    {
        $roles = [];
        foreach ($this->roles->toArray() as $role) {
            $roles[] = $role->getTitle();
        }

        return $roles;
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

    /**
     * @return Collection|MedicalTest[]
     */
    public function getMedicalTests(): Collection
    {
        return $this->medicalTests;
    }

    public function addMedicalTest(MedicalTest $medicalTest): self
    {
        if (!$this->medicalTests->contains($medicalTest)) {
            $this->medicalTests[] = $medicalTest;
            $medicalTest->setUsr($this);
        }

        return $this;
    }

    public function removeMedicalTest(MedicalTest $medicalTest): self
    {
        if ($this->medicalTests->removeElement($medicalTest)) {
            // set the owning side to null (unless already changed)
            if ($medicalTest->getUsr() === $this) {
                $medicalTest->setUsr(null);
            }
        }

        return $this;
    }
}
