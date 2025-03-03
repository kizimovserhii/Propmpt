<?php

namespace app\Services;

use app\Controllers\DbController;

class AuthService
{
    protected DbController $db;

    public function __construct()
    {
        $this->db = new DbController();
    }

    /**
     * @param $name
     * @param $email
     * @param $password
     * @return false|string
     */
    public function registerUser($name, $email, $password): false|string
    {
        $stmt = $this->db->prepare('SELECT * FROM users WHERE email = ?');
        $stmt->execute([$email]);
        $existingUser = $stmt->fetch();

        if ($existingUser) {
            return 'User with this email already exists.';
        }

        $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

        $stmt = $this->db->prepare('INSERT INTO users (name, email, password) VALUES (?, ?, ?)');
        $stmt->execute([$name, $email, $hashedPassword]);

        return $this->db->lastInsertId();
    }

    /**
     * @param $email
     * @param $password
     * @return string|true
     */
    public function loginUser($email, $password): string|true
    {
        $stmt = $this->db->prepare('SELECT * FROM users WHERE email = ?');
        $stmt->execute([$email]);
        $user = $stmt->fetch();

        if (!$user) {
            return 'User with this email not found';
        }

        if (!password_verify($password, $user['password'])) {
            return 'Wrong password';
        }

        $_SESSION['user_id'] = $user['id'];
        $_SESSION['user_name'] = $user['name'];

        return true;
    }

    /**
     * @return bool
     */
    public function checkSession(): bool
    {
        return isset($_SESSION['user_id']);
    }

    /**
     * @return string
     */
    public function getUserName(): string
    {
        return $_SESSION['name'] ?? '';
    }

    /**
     * @return void
     */
    public function logout(): void
    {
        session_unset();
        session_destroy();
    }
}

