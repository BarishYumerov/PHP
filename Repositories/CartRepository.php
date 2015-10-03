<?php

namespace Repositories;

use Db;
use Configs\DbConfig;

class CartRepository
{
    private $db;

    private static $inst = null;

    private function __construct(Db $db)
    {
        $this->db = $db;
    }

    public static function create()
    {
        $dbConfigClass = new DbConfig();

        Db::setInstance(
            $dbConfigClass::USER,
            $dbConfigClass::PASS,
            $dbConfigClass::DBNAME,
            $dbConfigClass::HOST
        );

        if (self::$inst == null)
        {
            self::$inst = new self(Db::getInstance());
        }
        return self::$inst;
    }

    public function getUserCard($userId){
        $query = "SELECT * FROM carts WHERE carts.ownerId = ?";
        $this->db->query($query, [$userId]);
        $result = $this->db->row();

        $query = "SELECT * FROM  cartsproducts where cartId = ?";
        $this->db->query($query, [$result['id']]);
        $cartProducts = $this->db->fetchAll();
        $productRepo = ProductRepository::create();
        foreach($cartProducts as $key => $value){
            $cartProducts[$key]['product'] = $productRepo->getProduct(intval($value['productId']));
        }

        $user = UserRepository::create()->getOne($userId);
        $_SESSION['cash'] = $user['cash'];
        $result['cartProducts'] = $cartProducts;
        return $result;
    }

    public function newCart($userId){
        $query = "INSERT INTO carts (ownerId, value) values(?, ?)";
        $this->db->query($query, [$userId, 0]);
        $result = $this->db->row();
        return $result;
    }

    public function checkout(){
        $userId = $_SESSION['userId'];
        $cartId = intval($_SESSION['userCart']['id']);
        $checkoutValue = $_SESSION['userCart']['value'];

        $query = "UPDATE users set cash = cash - ?
                  WHERE id = ?";
        $this->db->query($query, [$checkoutValue, $userId]);

        $query = "UPDATE carts set value = 0
                  WHERE id = ?";
        $this->db->query($query, [$cartId]);

        $query = "DELETE FROM cartsproducts
                  WHERE cartId = ?";
        $this->db->query($query, [$cartId]);
        $result = $this->db->row();
        var_dump($cartId);
        return $result;
    }
}