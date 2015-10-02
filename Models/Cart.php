<?php

namespace Models;

class Cart
{
    private $id;
    private $ownerId;
    private $value;

    public function __construct($value, $ownedId, $id = null)
    {
        $this->setValue($value);
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

    public function getValue()
    {
        return $this->value;
    }

    public function setValue($value)
    {
        $this->value = $value;
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