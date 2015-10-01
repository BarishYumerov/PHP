<?php

namespace Models;


class Product
{
    private $id;
    private $name;
    private $categoryId;
    private $price;
    private $quantity;
    private $editorId;

    public function __construct($name, $categoryId, $price, $quantity, $editorId, $id = null)
    {
        $this->setName($name);
        $this->setId($id);
        $this->setCategoryId($categoryId);
        $this->setPrice($price);
        $this->setQuantity($quantity);
        $this->setEditorId($editorId);
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

    public function getCategoryId()
    {
        return $this->categoryId;
    }

    public function setCategoryId($categoryId)
    {
        $this->categoryId = $categoryId;
    }

    public function getPrice()
    {
        return $this->price;
    }

    public function setPrice($price)
    {
        if($price < 0){
            echo 'Invalid price!';
            die;
        }
        $this->price = $price;
    }

    public function getQuantity()
    {
        return $this->quantity;
    }

    public function setQuantity($quantity)
    {
        if($quantity < 0){
            echo 'Invalid quantity!';
            die;
        }
        $this->quantity = $quantity;
    }

    public function getEditorId()
    {
        return $this->editorId;
    }

    public function setEditorId($editorId)
    {
        $this->editorId = $editorId;
    }
}