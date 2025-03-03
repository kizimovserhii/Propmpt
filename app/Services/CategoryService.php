<?php

namespace app\Services;

use app\Controllers\DbController;

class CategoryService
{
    protected DbController $db;

    public function __construct()
    {
        $this->db = new DbController();
    }

    /**
     * @return array
     */
    public function getCategories(): array
    {
        $stmt = $this->db->query('SELECT * FROM categories');
        return $stmt->fetchAll();
    }

    /**
     * @param $categoryId
     * @return array
     */
    public function getPromptsByCategory($categoryId): array
    {
        $stmt = $this->db->prepare('SELECT * FROM prompts WHERE category_id = ?');
        $stmt->execute([$categoryId]);
        return $stmt->fetchAll();
    }
}
