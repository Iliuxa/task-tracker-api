<?php

namespace App\Entity;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Table('t_priority')]
#[ORM\Entity(readOnly: true)]
class PriorityEntity
{
    #[ORM\Id]
    #[ORM\Column(name: 'id', type: Types::INTEGER)]
    private int $id;

    #[ORM\Column(name: 'priority_name', type: Types::STRING)]
    private string $name;

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): PriorityEntity
    {
        $this->id = $id;
        return $this;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): PriorityEntity
    {
        $this->name = $name;
        return $this;
    }

}