<?php

namespace Repositories;

use Db;
use Configs\DbConfig;
use Models\Category;

class CategoriesRepository
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

    public static function add(){

    }

    public function edit(Category $category)
    {
        var_dump($category);
        $query = "Select id, name
        FROM categories WHERE id = ?";
        $this->db->query($query, [$category->getId()]);
        $result = $this->db->row();

        if(!$result){
            echo 'No such category';
            die;
        }

        $query = "Select id, name
        FROM categories WHERE name = ?";
        $this->db->query($query, [$category->getName()]);
        $result = $this->db->row();

        if($result){
            echo 'The category exists!';
            die;
        }

        $query = "Update categories SET name = ?
        WHERE id = ?";
        $this->db->query($query, [$category->getName(), $category->getId()]);
        $result = $this->db->row();

        return $result;
    }
}