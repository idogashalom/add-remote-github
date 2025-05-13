<?php

namespace Model;

session_start();

// Check if the user is logged in (check for 'user_id' session)
if (!isset($_SESSION['user_id'])) {
    echo json_encode(['error' => 'User not logged in']);
    exit; // Make sure no further code is executed
}

use PDO;
use PDOException;

class User
{
    private $conn;
    private $table = 'users'; // Make sure this matches your actual table name

    public function __construct(PDO $db)
    {
        $this->conn = $db;
    }

    // Check if email exists
    public function emailExists($email)
    {
        $sql = "SELECT id FROM {$this->table} WHERE email = :email LIMIT 1";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['email' => $email]);
        return $stmt->fetch(PDO::FETCH_ASSOC) !== false;
    }

    // Register a new user
    public function register($name, $email, $password)
    {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        $sql = "INSERT INTO {$this->table} (name, email, password) VALUES (:name, :email, :password)";
        $stmt = $this->conn->prepare($sql);

        return $stmt->execute([
            'name'     => $name,
            'email'    => $email,
            'password' => $hashedPassword
        ]);
    }

    // Get user by username
    public function getUserByName($username)
    {
        try {
            $sql = "SELECT * FROM {$this->table} WHERE name = :username LIMIT 1";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute(['username' => $username]);
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            throw new PDOException("Error: " . $e->getMessage());
        }
    }
}
