<?php

namespace Models;

class Cart
{
    private $id;
    private $name;
    private $ownerId;

    public function __construct($name, $ownedId, $id = null)
    {
        $this->setName($name);
        $this->setId($id);
        $this->setOwnerId($ownedId);
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

    public function getOwnerId()
    {
        return $this->ownerId;
    }

    public function setOwnerId($ownerId)
    {
        $this->ownerId = $ownerId;
    }
}