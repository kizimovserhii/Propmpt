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


    public function registerUser($name, $email, $password)
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


    public function loginUser($email, $password)
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

        return true;
    }

    /**
     * @return void
     */
    public function logoutUser(): void
    {
        session_destroy();
    }
}

