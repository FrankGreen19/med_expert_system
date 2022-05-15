<?php

namespace App\Entity;

use App\Repository\MedicalTestRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;

#[ORM\Entity(repositoryClass: MedicalTestRepository::class)]
class MedicalTest
{
    const TEST_COMMON = 'common';
    const TEST_SPECIALIZED = 'specialized';

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\ManyToOne(targetEntity: User::class, inversedBy: 'medicalTests')]
    private $usr;

    #[ORM\Column(type: 'string', length: 255)]
    private $testType;

    #[ORM\OneToOne(targetEntity: XrayImage::class, cascade: ['persist', 'remove'])]
    private $xrayImage;

    #[ORM\Column(type: 'json', length: 255, nullable: true)]
    private $cnnResult = [];

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $fuzzyResult;

    #[ORM\Column(type: 'json', length: 255, nullable: true)]
    private $context = [];

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUsr(): ?User
    {
        return $this->usr;
    }

    public function setUsr(?UserInterface $usr): self
    {
        $this->usr = $usr;

        return $this;
    }

    public function getTestType(): ?string
    {
        return $this->testType;
    }

    public function setTestType(string $testType): self
    {
        $this->testType = $testType;

        return $this;
    }

    public function getXrayImage(): ?XrayImage
    {
        return $this->xrayImage;
    }

    public function setXrayImage(?XrayImage $xrayImage): self
    {
        $this->xrayImage = $xrayImage;

        return $this;
    }

    public function getFuzzyResult(): ?string
    {
        return $this->fuzzyResult;
    }

    public function setFuzzyResult(?string $fuzzyResult): self
    {
        $this->fuzzyResult = $fuzzyResult;

        return $this;
    }

    public function getContext(): array
    {
        return $this->context;
    }

    public function setContext(array $context): void
    {
        $this->context = $context;
    }

    public function getCnnResult(): array
    {
        return $this->cnnResult;
    }

    public function setCnnResult(array $cnnResult): void
    {
        $this->cnnResult = $cnnResult;
    }
}
