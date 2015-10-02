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
        return $result;
    }
}