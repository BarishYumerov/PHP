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

    public function available(){
        $query = "SELECT p.id, p.name, p.quantity, p.price, c.name as category
                    FROM products p
                    LEFT JOIN categories c ON c.id = p.categoryId
                    WHERE p.quantity > 0";
        $this->db->query($query);
        $result = $this->db->fetchAll();
        return $result;
    }

    public function edit(Product $product){
        $query = "Update products Set name = ?, categoryId = ?, price = ?, quantity = ?, editorId = ?
        WHERE products.id = ?";
        $params = [
            $product->getName(),
            $product->getCategoryId(),
            $product->getPrice(),
            $product->getQuantity(),
            $product->getEditorId(),
            $product->getId()
        ];
        $this->db->query($query, $params);
        $result = $this->db->row();

        return $result;
    }

    public function getAll(){
        $query = "Select *
        FROM products";
        $this->db->query($query);
        $result = $this->db->fetchAll();
        return $result;
    }

    public function getProduct($id){
        $query = "Select *
        FROM products WHERE products.id = ?";
        $this->db->query($query, [$id]);
        $result = $this->db->row();
        return $result;
    }

    public function delete($id){
        $query = "Delete FROM products WHERE id = ?";
        $this->db->query($query, [$id]);
        $result = $this->db->row();
        return $result;
    }

    public function getMyProducts($editorId){
        $query = "SELECT p.id, p.name, p.quantity, p.price, c.name as category
                    FROM products p
                    LEFT JOIN categories c ON c.id = p.categoryId
                    WHERE p.editorId = ?";
        $this->db->query($query, [$editorId]);
        $result = $this->db->fetchAll();
        return $result;
    }
}