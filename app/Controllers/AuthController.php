<?php

namespace app\Controllers;

use app\Services\AuthService;

class AuthController
{
    private AuthService $authService;

    public function __construct()
    {
        $this->authService = new AuthService();
    }

    /**
     * @return void
     */
    public function showRegisterForm(): void
    {
        include 'app/views/users/register.php';
    }

    /**
     * @return void
     */
    public function register(): void
    {
        $name = $_POST['name'] ?? '';
        $email = $_POST['email'] ?? '';
        $password = $_POST['password'] ?? '';

        $userId = $this->authService->registerUser($name, $email, $password);

        if (is_numeric($userId)) {
            $_SESSION['auth'] = true;
            $_SESSION['user_id'] = $userId;

            header("Location: /");
            exit;
        }
    }

    /**
     * @return void
     */
    public function showLoginForm(): void
    {
        include 'app/views/users/login.php';
    }

    /**
     * @return void
     */
    public function login(): void
    {

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = $_POST['email'] ?? '';
            $password = $_POST['password'] ?? '';

            if (empty($email) || empty($password)) {
                echo 'Email and password are required';
                return;
            }

            $result = $this->authService->loginUser($email, $password);

            if ($result === true) {
                header('Location: /');
                exit;
            } else {
                echo $result;
            }
        }
    }

    /**
     * @return void
     */
    public function logout()
    {
        $this->authService->logoutUser();

        header("Location: /login");
        exit();
    }

//    public function checkAuth()
//    {
//        if (isset($_SESSION['auth']) && $_SESSION['auth'] === true) {
//            return true;
//        }
//        return false;
//    }
}