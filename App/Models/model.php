<?php

namespace App\Models;

use PDO;
use PDOException;



class Model
{
    protected $pdo;
    public function __construct()
    {

        require_once 'config/database_config.php';
        try {
            $this->pdo = new PDO(
                "mysql:host=$server_name;dbname=$database;charset=utf8mb4",
                $user_name,
                $password_bd,
                array(
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_PERSISTENT => false
                )
            );
        } catch (PDOException $e) {
            echo "Error!: " . $e->getMessage() . "<br/>";

            die();
        }
    }
}
