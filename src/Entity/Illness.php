<?php

namespace App\Entity;

use App\Repository\IllnessRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use JetBrains\PhpStorm\Pure;

#[ORM\Entity(repositoryClass: IllnessRepository::class)]
class Illness
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private string $title;

    #[ORM\ManyToMany(targetEntity: 'Symptom')]
    private ArrayCollection $symptoms;

    #[ORM\Column(type: 'string', length: 30, nullable: false)]
    private string $alias;

    /**
     * @return string
     */
    public function getAlias(): string
    {
        return $this->alias;
    }

    /**
     * @param string $alias
     */
    public function setAlias(string $alias): void
    {
        $this->alias = $alias;
    }

    /**
     * Illness constructor.
     * @param $symptoms
     */
    #[Pure]
    public function __construct()
    {
        $this->symptoms = new ArrayCollection();
    }

    /**
     * @return ArrayCollection
     */
    public function getSymptoms(): ArrayCollection
    {
        return $this->symptoms;
    }


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }
}
