<?php

declare(strict_types=1);

namespace App\Model;

class User extends Model
{
    protected static string $tableName = 'users';
    private string $email;
    private string $password;
    private string $firstName;
    private string $lastName;
    private string $roles;

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): void
    {
        $this->password = $password;
    }

    public function getFirstName(): string
    {
        return $this->firstName;
    }

    public function setFirstName(string $firstName): void
    {
        $this->firstName = $firstName;
    }

    public function getLastName(): string
    {
        return $this->lastName;
    }

    public function setLastName(string $lastName): void
    {
        $this->lastName = $lastName;
    }

    public function getRoles(): array
    {
        return json_decode($this->roles);
    }

    public function setRoles(array $roles): void
    {
        $this->roles = json_encode($roles);
    }

    protected function request(): string
    {
        return "email=:email, password=:password, first_name=:firstName, last_name=:lastName, roles=:roles";
    }

    protected function getParams(): array
    {
        return [
            'email' => $this->email,
            'password' => $this->password,
            'firstName' => $this->firstName,
            'lastName' => $this->lastName,
            'roles' => $this->roles,
        ];
    }
}
