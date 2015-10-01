<?php

namespace Models;

class Category
{
    private $id;
    private $name;

    public function __construct($name, $id = null)
    {
        $this->setName($name);
        $this->setId($id);
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

    public function setName($name)
    {
        if(strlen($name) < 2){
            echo 'Too short Name';
            die;
        }

        $this->name = $name;
    }
}