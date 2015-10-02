<?php
namespace Repositories;

use Models\User;
use Db;
use Configs\DbConfig;

class UserRepository
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

    public function getOne($id)
    {
        $query = "SELECT id, username, password, email
        FROM users WHERE id = ?";
        $this->db->query($query, [$id]);
        $result = $this->db->row();

        return $result;
    }

    public function getByName($username){
        $query = "SELECT id, username, password, email
        FROM users WHERE username = ?";
        $this->db->query($query, [$username]);
        $result = $this->db->row();

        return $result;
    }

    public function loginCheck($username, $passwordHash){
        $query = "SELECT id, username, password, email, cash, roleId
        FROM users WHERE username = ? && password = ?";
        $this->db->query($query, [$username, $passwordHash]);
        $result = $this->db->row();

        return $result;
    }

    public function save(User $user)
    {
        $query = "
            INSERT INTO users (username, email, cash, roleId, password)
            VALUES (?, ?, ?, ?, ?)
        ";
        $params = [
            $user->getUsername(),
            $user->getEmail(),
            $user->getCash(),
            $user->getRole(),
            $user->getPassword()
        ];

        if ($user->getId()) {
            $query = "UPDATE players SET username = ?, password = ? WHERE id = ?";
            $params[] = $user->getId();
        }

        $this->db->query($query, $params);
        return $this->db->rows() > 0;
    }
}