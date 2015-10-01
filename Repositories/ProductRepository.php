<?php

namespace Repositories;

use Db;
use Configs\DbConfig;
use Models\Product;

class ProductRepository
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

    public function add(Product $product){
        var_dump($product);
        $query = "INSERT INTO products (name, categoryId, price, quantity, editorId)
            VALUES (?, ?, ?, ?, ?)";
        $params = [
            $product->getName(),
            $product->getCategoryId(),
            $product->getPrice(),
            $product->getQuantity(),
            $product->getEditorId()
        ];
        $this->db->query($query, $params);
        $result = $this->db->row();

        return $result;
    }

    public function getAll(){
        $query = "Select id, name
        FROM products";
        $this->db->query($query);
        $result = $this->db->fetchAll();
        return $result;
    }
}