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
    public function getCategories()
    {
        $stmt = $this->db->query('SELECT * FROM categories');
        return $stmt->fetchAll();
    }
}
