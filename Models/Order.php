<?php

namespace Models;

class Order
{
    private $productId;
    private $cartId;
    private $quantity;
    private $price;

    public function __construct($productId, $cartId, $quantity, $price)
    {
        $this->setCartId($cartId);
        $this->setProductId($productId);
        $this->setQuantity($quantity);
        $this->setPrice($price);
    }

    public function getProductId()
    {
        return $this->productId;
    }

    public function setProductId($productId)
    {
        $this->productId = $productId;
    }

    public function getCartId()
    {
        return $this->cartId;
    }

    public function setCartId($userId)
    {
        $this->cartId = $userId;
    }

    public function getQuantity()
    {
        return $this->quantity;
    }

    public function setQuantity($quantity)
    {
        $this->quantity = $quantity;
    }

    public function getPrice()
    {
        return $this->price;
    }

    public function setPrice($price)
    {
        $this->price = $price;
    }
}