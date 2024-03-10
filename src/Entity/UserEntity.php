<?php

namespace App\Entity;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Table('employee')]
#[ORM\Entity]
class UserEntity
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(name: 'id', type: Types::INTEGER)]
    private int $id;

    #[ORM\Column(name: 'first_name', type: Types::STRING)]
    private ?string $firstName = null;

    #[ORM\Column(name: 'last_name', type: Types::STRING)]
    private ?string $lastName = null;

    #[ORM\Column(name: 'patronymic', type: Types::STRING)]
    private ?string $patronymic = null;

    #[Assert\Email]
    #[ORM\Column(name: 'email', type: Types::STRING)]
    private string $email;

    #[Assert\NotBlank]
    #[ORM\Column(name: 'phone_number', type: Types::STRING)]
    private string $phoneNumber;

    #[Assert\NotBlank]
    #[ORM\Column(name: 'has_password', type: Types::STRING)]
    private string $hasPassword;

    #[Assert\Valid]
    #[Assert\Type(RoleEntity::class)]
    #[ORM\ManyToOne(targetEntity: RoleEntity::class)]
    #[ORM\JoinColumn(name: 'role_id', referencedColumnName: 'id')]
    private ?RoleEntity $role;

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): UserEntity
    {
        $this->id = $id;
        return $this;
    }

    public function hasId()
    {
        return isset($this->id);
    }

    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    public function setFirstName(?string $firstName): UserEntity
    {
        $this->firstName = $firstName;
        return $this;
    }

    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    public function setLastName(?string $lastName): UserEntity
    {
        $this->lastName = $lastName;
        return $this;
    }

    public function getPatronymic(): ?string
    {
        return $this->patronymic;
    }

    public function setPatronymic(?string $patronymic): UserEntity
    {
        $this->patronymic = $patronymic;
        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(?string $email): UserEntity
    {
        $this->email = $email;
        return $this;
    }

    public function getPhoneNumber(): ?string
    {
        return $this->phoneNumber;
    }

    public function setPhoneNumber(?string $phoneNumber): UserEntity
    {
        $this->phoneNumber = $phoneNumber;
        return $this;
    }

    public function getHasPassword(): ?string
    {
        return $this->hasPassword;
    }

    public function setHasPassword(?string $hasPassword): UserEntity
    {
        $this->hasPassword = $hasPassword;
        return $this;
    }

    public function getRole(): ?RoleEntity
    {
        return $this->role;
    }

    public function setRole(?RoleEntity $role): UserEntity
    {
        $this->role = $role;
        return $this;
    }

    public function toUserDto(UserEntity $user): UserEntity
    {
        return $this
            ->setFirstName($user->getFirstName())
            ->setLastName($user->getLastName())
            ->setPatronymic($user->getPatronymic())
            ->setEmail($user->getEmail())
            ->setPhoneNumber($user->getPhoneNumber())
            ->setHasPassword($user->getHasPassword())
            ->setRole($user->getRole());
    }

}