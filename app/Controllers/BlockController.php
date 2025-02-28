<?php

namespace app\Controllers;

use app\Services\CategoryService;
use app\Services\BlockService;

class BlockController{
    protected CategoryService $categoryService;
    protected BlockService $blockService;

    public function __construct()
    {
        $this->categoryService = new CategoryService();
        $this->blockService = new BlockService();
    }

    /**
     * @return void
     */
    public function home(): void
    {
        $prompts = $this->blockService->getPromptsFromSession();
        include 'app/views/home.php';
    }

    /**
     * @return void
     */
    public function block(): void
    {
        $prompts = $this->blockService->getPrompts();
        include 'app/views/block.php';
    }

    public function addPrompt(): void
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $input = json_decode(file_get_contents('php://input'), true);
            $promptId = $input['id'];

            $this->blockService->addPrompt($promptId);
            echo json_encode(['success' => true]);
        }
    }

}