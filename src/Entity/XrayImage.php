<?php

namespace App\Entity;

use App\Repository\XrayImageRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;

#[ORM\Entity(repositoryClass: XrayImageRepository::class)]
class XrayImage
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private string $imageName;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private string $imagePath;

    private ?File $imageFile = null;

    #[ORM\Column(type: 'integer')]
    private ?int $imageSize = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getImageName(): ?string
    {
        return $this->imageName;
    }

    public function setImageName(string $imageName): self
    {
        $this->imageName = $imageName;

        return $this;
    }

    public function getImageFile(): ?File
    {
        return $this->imageFile;
    }

    public function setImageFile(?File $imageFile): void
    {
        $this->imageFile = $imageFile;
    }

    public function getImageSize(): ?int
    {
        return $this->imageSize;
    }

    public function setImageSize(?int $imageSize): void
    {
        $this->imageSize = $imageSize;
    }

    public function getImagePath(): string
    {
        return $this->imagePath;
    }

    public function setImagePath($imagePath): void
    {
        $this->imagePath = $imagePath;
    }

    public function parseUploadedFile(File $file): XrayImage
    {
        $this->imageFile = $file;
        $this->imagePath = $_ENV['FILE_UPLOAD_DIR'] . $file->getFilename();
        $this->imageName = $file->getFilename();
        $this->imageSize = $file->getSize();

        return $this;
    }
}
