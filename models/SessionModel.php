<?php

namespace app\models;
class SessionModel
{
    public string $email;
    public array $roles;

    public function __construct(string $email)
    {
        $this->email = $email;
        $this->roles = [];
    }

    public function setRoles(array $roles): void
    {
        $this->roles = $roles;
    }
}