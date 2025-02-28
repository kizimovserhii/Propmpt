<?php

namespace app\Services;

use app\Controllers\DbController;

class BlockService{
    protected DbController $db;

    public function __construct()
    {
        $this->db = new DbController();
    }

    /**
     * @return array
     */
    public function getPrompts(): array
    {
        $query = "SELECT id, title, body FROM prompts";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    /**
     * @param $promptId
     * @return void
     */
    public function addPrompt($promptId)
    {
        if (!isset($_SESSION['home_prompts'])) {
            $_SESSION['home_prompts'] = [];
        }

        if (!in_array($promptId, $_SESSION['home_prompts'])) {
            $_SESSION['home_prompts'][] = $promptId;
        }
    }

    /**
     * @return array
     */
    public function getPromptsFromSession(): array
    {
        if (isset($_SESSION['home_prompts'])) {
            $placeholders = implode(',', array_fill(0, count($_SESSION['home_prompts']), '?'));
            $query = "SELECT id, title, body FROM prompts WHERE id IN ($placeholders)";
            $stmt = $this->db->prepare($query);
            $stmt->execute($_SESSION['home_prompts']);
            return $stmt->fetchAll();
        }
        return [];
    }
}