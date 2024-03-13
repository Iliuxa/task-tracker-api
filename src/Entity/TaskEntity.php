<?php

namespace App\Entity;

use DateTime;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Table('task')]
#[ORM\Entity()]
class TaskEntity
{
    #[ORM\Id]
    #[ORM\GeneratedValue(strategy: 'SEQUENCE')]
    #[ORM\SequenceGenerator(sequenceName: 'task_id_seq', initialValue: 1)]
    #[ORM\Column(name: 'id', type: Types::INTEGER, nullable: true)]
    private ?int $id;

    #[ORM\Column(name: 'task_name', type: Types::STRING)]
    private string $taskName;

    #[ORM\Column(name: 'description', type: Types::STRING)]
    private ?string $description = null;

    #[Assert\Valid]
    #[Assert\Type(StatusEntity::class)]
    #[ORM\ManyToOne(targetEntity: StatusEntity::class)]
    #[ORM\JoinColumn(name: 'status_id', referencedColumnName: 'id')]
    private ?StatusEntity $status;

    #[ORM\Column(name: 'parent_task', type: Types::INTEGER)]
    private ?int $parentTask = null;

    #[Assert\Valid]
    #[Assert\Type(PriorityEntity::class)]
    #[ORM\ManyToOne(targetEntity: PriorityEntity::class)]
    #[ORM\JoinColumn(name: 'priority_id', referencedColumnName: 'id')]
    private ?PriorityEntity $priority;

    #[ORM\Column(name: 'creator', type: Types::INTEGER)]
    private ?int $creator = null;

    #[ORM\Column(name: 'create_date', type: Types::DATETIME_MUTABLE)]
    private DateTime|null $createDate = null;

    #[ORM\Column(name: 'start_date', type: Types::DATETIME_MUTABLE)]
    private DateTime|null $startDate = null;

    #[ORM\Column(name: 'end_end', type: Types::DATETIME_MUTABLE)]
    private DateTime|null $endDate = null;

    #[ORM\Column(name: 'archive', type: Types::BOOLEAN)]
    private bool $archive;

    #[ORM\JoinTable(name: 'task_employee')]
    #[ORM\JoinColumn(name: 'task_id', referencedColumnName: 'ID')]
    #[ORM\InverseJoinColumn(name: 'employee_id', referencedColumnName: 'ID')]
    #[ORM\ManyToMany(targetEntity: UserEntity::class)]
    private Collection $user;

    public function __construct()
    {
        $this->user = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(?int $id): TaskEntity
    {
        $this->id = $id;
        return $this;
    }

    public function getTaskName(): string
    {
        return $this->taskName;
    }

    public function setTaskName(string $taskName): TaskEntity
    {
        $this->taskName = $taskName;
        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): TaskEntity
    {
        $this->description = $description;
        return $this;
    }

    public function getStatus(): ?StatusEntity
    {
        return $this->status;
    }

    public function setStatus(?StatusEntity $status): TaskEntity
    {
        $this->status = $status;
        return $this;
    }

    public function getParentTask(): ?int
    {
        return $this->parentTask;
    }

    public function setParentTask(?int $parentTask): TaskEntity
    {
        $this->parentTask = $parentTask;
        return $this;
    }

    public function getPriority(): ?PriorityEntity
    {
        return $this->priority;
    }

    public function setPriority(?PriorityEntity $priority): TaskEntity
    {
        $this->priority = $priority;
        return $this;
    }

    public function getCreator(): ?int
    {
        return $this->creator;
    }

    public function setCreator(?int $creator): TaskEntity
    {
        $this->creator = $creator;
        return $this;
    }

    public function getCreateDate(): ?DateTime
    {
        return $this->createDate;
    }

    public function setCreateDate(?DateTime $createDate): TaskEntity
    {
        $this->createDate = $createDate;
        return $this;
    }

    public function getStartDate(): ?DateTime
    {
        return $this->startDate;
    }

    public function setStartDate(?DateTime $startDate): TaskEntity
    {
        $this->startDate = $startDate;
        return $this;
    }

    public function getEndDate(): ?DateTime
    {
        return $this->endDate;
    }

    public function setEndDate(?DateTime $endDate): TaskEntity
    {
        $this->endDate = $endDate;
        return $this;
    }

    public function isArchive(): bool
    {
        return $this->archive;
    }

    public function setArchive(bool $archive): TaskEntity
    {
        $this->archive = $archive;
        return $this;
    }

    public function getUser(): Collection
    {
        return $this->user;
    }

    public function setUser(Collection $user): TaskEntity
    {
        $this->user = $user;
        return $this;
    }

}