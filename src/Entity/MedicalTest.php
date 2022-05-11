<?php

namespace App\Entity;

use App\Repository\MedicalTestRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MedicalTestRepository::class)]
class MedicalTest
{
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

    #[ORM\ManyToOne(targetEntity: Illness::class)]
    private $cnnResult;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $fuzzyResult;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUsr(): ?User
    {
        return $this->usr;
    }

    public function setUsr(?User $usr): self
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

    public function getCnnResult(): ?Illness
    {
        return $this->cnnResult;
    }

    public function setCnnResult(?Illness $cnnResult): self
    {
        $this->cnnResult = $cnnResult;

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
}
