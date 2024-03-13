<?php

namespace App\Entity;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Table('t_status')]
#[ORM\Entity(readOnly: true)]
class StatusEntity
{
    #[ORM\Id]
    #[ORM\Column(name: 'id', type: Types::INTEGER)]
    private int $id;

    #[ORM\Column(name: 'status_name', type: Types::STRING)]
    private string $name;

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): StatusEntity
    {
        $this->id = $id;
        return $this;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): StatusEntity
    {
        $this->name = $name;
        return $this;
    }

}