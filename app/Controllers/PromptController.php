<?php

namespace app\Controllers;

use app\Services\CategoryService;
use app\Services\PromptService;

class PromptController
{
    protected PromptService $promptService;
    protected CategoryService $categoryService;

    public function __construct()
    {
        $this->promptService = new PromptService();
        $this->categoryService = new CategoryService();
    }

    /**
     * @return void
     */
    public function index(): void
    {
        $prompts = $this->promptService->getAllPrompts();

        include 'app/views/prompts/index.php';
    }

    /**
     * @return void
     */
    public function create(): void
    {
        $categories = $this->categoryService->getCategories();
        include 'app/views/prompts/create.php';
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

        $promptId = $this->promptService->createPrompt($data);

        include 'app/views/prompts/show.php';
        header('Location: /prompts/' . $id);
        exit;
    }

    /**
     * @param int $id
     * @return void
     */
    public function show(int $id): void
    {
        $prompt = $this->promptService->getById($id);

        include 'app/views/prompts/show.php';
    }

    /**
     * @param int $id
     * @return void
     */
    public function edit(int $id): void
    {
        $categories = $this->categoryService->getCategories();
        $prompt = $this->promptService->getById($id);

        include 'app/views/prompts/edit.php';
    }

    /**
     * @param int $id
     * @return void
     */
    public function update(int $id): void
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'title' => $_POST['title'],
                'body' => $_POST['body'],
            ];

            $this->promptService->update($id, $data);

            header('Location: /prompts');
            exit;
        }

        $prompt = $this->promptService->getById($id);

        include 'app/views/prompts/edit.php';
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