<?php

namespace app\Controllers;

use app\Services\CategoryService;
use app\Services\PromptService;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;

class PromptController
{
    protected PromptService $promptService;
    protected CategoryService $categoryService;
    protected TwigController $twigController;

    public function __construct()
    {
        $this->promptService = new PromptService();
        $this->categoryService = new CategoryService();
        $this->twigController = new TwigController();
    }

    /**
     * @return void
     * @throws LoaderError
     * @throws RuntimeError
     * @throws SyntaxError
     */
    public function index(): void
    {
        $prompts = $this->promptService->getAllPrompts();

        $this->twigController->render('prompts/index', ['prompts' => $prompts]);
    }

    /**
     * @return void
     * @throws LoaderError
     * @throws RuntimeError
     * @throws SyntaxError
     */
    public function create(): void
    {
        $categories = $this->categoryService->getCategories();
        $this->twigController->render('prompts/create', ['categories' => $categories]);
    }

    /**
     * @return void
     */
    public function store(): void
    {
        $data = [
            'title' => $_POST['title'],
            'body' => $_POST['body'],
            'category_id' => $_POST['category_id'],
        ];

        $this->promptService->createPrompt($data);

        header('Location: /prompts/');
        exit;
    }

    /**
     * @param int $id
     * @return void
     * @throws LoaderError
     * @throws RuntimeError
     * @throws SyntaxError
     */
    public function show(int $id): void
    {
        $prompt = $this->promptService->getById($id);

        $this->twigController->render('prompts/show', ['prompt' => $prompt]);
    }

    /**
     * @param int $id
     * @return void
     * @throws LoaderError
     * @throws RuntimeError
     * @throws SyntaxError
     */
    public function edit(int $id): void
    {
        $categories = $this->categoryService->getCategories();
        $prompt = $this->promptService->getById($id);

        $this->twigController->render('prompts/edit', [
            'categories' => $categories,
            'prompt' => $prompt
        ]);
    }

    /**
     * @param int $id
     * @return void
     * @throws LoaderError
     * @throws RuntimeError
     * @throws SyntaxError
     */
    public function update(int $id): void
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'title' => $_POST['title'],
                'body' => $_POST['body'],
                'category_id' => $_POST['category_id'],
            ];

            $this->promptService->update($id, $data);

            header('Location: /prompts');
            exit;
        }

        $categories = $this->categoryService->getCategories();
        $prompt = $this->promptService->getById($id);

        $this->twigController->render('prompts/edit', [
            'categories' => $categories,
            'prompt' => $prompt
        ]);
    }

    /**
     * @param int $id
     * @return void
     */
    public function destroy(int $id): void
    {
        $this->promptService->delete($id);

        http_response_code(204);

        header("Location: /prompts");
        exit;
    }
}