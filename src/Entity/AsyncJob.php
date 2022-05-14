<?php

namespace App\Entity;

use App\Repository\AsyncJobRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;

#[ORM\Entity(repositoryClass: AsyncJobRepository::class)]
class AsyncJob
{
    const STATUS_QUEUED = 'in_queue';
    const STATUS_COMPLETED = 'complete';
    const STATUS_FAILED = 'failed';
    const STATUS_REQUEUED = 'requeued';

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'json', nullable: true)]
    private array $context = [];

    #[ORM\ManyToOne(targetEntity: User::class)]
    #[ORM\JoinColumn(name: 'user_id', referencedColumnName: 'id', nullable: true)]
    private ?UserInterface $user;

    #[ORM\Column(type: 'string', nullable: true)]
    private string $status;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getContext(): ?array
    {
        return $this->context;
    }

    public function setContext(array $context): self
    {
        $this->context = $context;

        return $this;
    }

    public function getUser(): ?UserInterface
    {
        return $this->user;
    }

    public function setUser(?UserInterface $user): void
    {
        $this->user = $user;
    }

    public function getStatus(): string
    {
        return $this->status;
    }

    public function setStatus(string $status): void
    {
        $this->status = $status;
    }
}
