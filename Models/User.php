<?php

namespace Models;

use Repositories\UserRepository;

class User
{
    private static $initialCash = 1000;

    private $id;
    private $username;
    private $password;
    private $email;
    private $cash;
    private $role;

    public function __construct($username, $password, $email, $id = null)
    {
        $this->setUsername($username);
        $this->setPassword($password);
        $this->setId($id);
        $this->setEmail($email);
        $this->setCash($this::$initialCash);
        $this->setRole(1);
    }

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getUsername()
    {
        return $this->username;
    }

    public function setUsername($username)
    {
        $this->username = $username;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function setPassword($password)
    {
        $this->password = md5($password);
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function getCash()
    {
        return $this->cash;
    }

    public function setCash($cash)
    {
        $this->cash = $cash;
    }

    public function getRole()
    {
        return $this->role;
    }

    public function setRole($role)
    {
        $this->role = $role;
    }

    public function save()
    {
        return UserRepository::create()->save($this);
    }
}