<?php

namespace App\Users\Commands;

class StoreUserCommand
{
    private $name;
    private $surname;
    private $username;
    private $email;
    private $password;
    private $birthday;

    public function __construct($name, $surname, $username, $email, $password, $birthday)
    {
        $this->name = $name;
        $this->surname = $surname;
        $this->username = $username;
        $this->email = $email;
        $this->password = $password;
        $this->birthday = $birthday;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getSurname()
    {
        return $this->surname;
    }

    public function getUsername()
    {
        return $this->username;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function getBirthday()
    {
        return $this->birthday;
    }
}
