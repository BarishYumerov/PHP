<?php

namespace Models;

use Repositories\UserRepository;

class User
{
    private $id;
    private $username;
    private $password;
    private $email;

    public function __construct($username, $password, $email, $id = null)
    {
        $this->setUsername($username);
        $this->setPassword($password);
        $this->setId($id);
        $this->setEmail($email);
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

    public function save()
    {
        return UserRepository::create()->save($this);
    }
}