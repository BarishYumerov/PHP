<?php

namespace Models;

class Category
{
    private $id;
    private $name;

    public function __construct($name, $id = null)
    {
        $this->setName($name);
    }

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setName($username)
    {
        $this->name = $username;
    }
}