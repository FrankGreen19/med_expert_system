<?php

namespace App\Entity;

use App\Repository\IllnessRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\PersistentCollection;
use JetBrains\PhpStorm\ArrayShape;
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

    #[ORM\ManyToMany(targetEntity: 'App\Entity\Symptom')]
    #[ORM\JoinTable(name: 'illness_symptom')]
    #[ORM\JoinColumn(name: 'illness_id', referencedColumnName: 'id')]
    #[ORM\InverseJoinColumn(name: 'symptom_id', referencedColumnName: 'id')]
    private $symptoms;

    /**
     * Illness constructor.
     * @param $symptoms
     */
    public function __construct($symptoms)
    {
        $this->symptoms = $symptoms;
    }

    /**
     * @return mixed
     */
    public function getSymptoms()
    {
        return $this->symptoms;
    }

    /**
     * @param mixed $symptoms
     */
    public function setSymptoms($symptoms): void
    {
        $this->symptoms = $symptoms;
    }

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
