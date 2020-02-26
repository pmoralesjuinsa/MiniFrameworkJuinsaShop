<?php


namespace Juinsa\Helpers;


use Juinsa\db\entities\Customer;

class CustomerWrapper extends Customer
{
    public function getAddress(): ?string
    {
        return $this->address;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function getPhone(): ?string
    {
        return $this->phone;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCreatedAt(): ?object
    {
        return $this->created_at;
    }

    public function getUpdatedAt(): ?object
    {
        return $this->updated_at;
    }

}