<?php

namespace app\Controllers;

use app\Services\AuthService;
use app\Services\CategoryService;

use app\Services\PromptService;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;

class BlockController
{
    protected CategoryService $categoryService;
    protected PromptService $promptService;
    protected TwigController $twigController;
    protected AuthService $authService;

    public function __construct()
    {
        $this->categoryService = new CategoryService();
        $this->twigController = new TwigController();
        $this->authService = new AuthService();
        $this->promptService = new PromptService();
    }

    /**
     * @return void
     * @throws LoaderError
     * @throws RuntimeError
     * @throws SyntaxError
     */
    public function home(): void
    {
        $isLoggedIn = $this->authService->checkSession();
        $userName = $isLoggedIn ? $this->authService->getUserName() : '';
        $categories = $this->categoryService->getCategories();

        $this->twigController->render('home', [
            'isLoggedIn' => $isLoggedIn,
            'name' => $userName,
            'categories' => $categories
        ]);
    }

    /**
     * @return void
     * @throws LoaderError
     * @throws RuntimeError
     * @throws SyntaxError
     */
    public function getAllPromptByCategory(): void
    {
        $categoryId = $_POST['category_id'] ?? null;
        $prompts = $this->categoryService->getPromptsByCategory($categoryId);
        $this->twigController->render('include/category_block', ['prompts' => $prompts]);
    }

    /**
     * @return void
     * @throws LoaderError
     * @throws RuntimeError
     * @throws SyntaxError
     */
    public function updatePrompts(): void
    {
        if (isset($_POST['prompts']) && is_array($_POST['prompts']) && count($_POST['prompts']) > 0) {
            $promptIds = $_POST['prompts'];

            $prompt = $this->promptService->getPrompts($promptIds);

            $this->twigController->render('include/prompts_list', ['prompts' => $prompt,]);
        }
    }
}