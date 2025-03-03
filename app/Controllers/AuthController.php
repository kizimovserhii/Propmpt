<?php

namespace app\Controllers;

use app\Services\AuthService;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;

class AuthController
{
    private AuthService $authService;
    protected TwigController $twigController;

    public function __construct()
    {
        $this->authService = new AuthService();
        $this->twigController = new TwigController();
    }

    /**
     * @return void
     * @throws LoaderError
     * @throws RuntimeError
     * @throws SyntaxError
     */
    public function showRegisterForm(): void
    {
        $this->twigController->render('users/register');
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

            header("Location: /prompts");
            exit;
        }
    }

    /**
     * @return void
     * @throws LoaderError
     * @throws RuntimeError
     * @throws SyntaxError
     */
    public function showLoginForm(): void
    {
        $this->twigController->render('users/login');
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

            $loginResult = $this->authService->loginUser($email, $password);

            if ($loginResult === true) {
                header('Location: /prompts');
                exit;
            } else {
                echo $loginResult;
            }
        }
    }

    /**
     * @return void
     */
    public function logout(): void
    {
        $this->authService->logout();
        header('Location: /');
        exit;
    }
}