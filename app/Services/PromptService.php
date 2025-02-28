<?php

namespace app\Services;

use app\Controllers\DbController;

class PromptService
{
    protected DbController $db;

    public function __construct()
    {
        $this->db = new DbController();
    }

    /**
     * @return array
     */
    public function getAllPrompts(): array
    {
        $query = "SELECT * FROM prompts";

        return $this->db->query($query)->fetchAll();
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function getById(int $id)
    {
        $query = "
        SELECT p.*, c.title AS category_title
        FROM prompts p
        JOIN categories c ON p.category_id = c.id
        WHERE p.id = ?
    ";
        $stmt = $this->db->prepare($query);
        $stmt->execute([$id]);

        return $stmt->fetch();
    }

    /**
     * @param array $data
     * @return false|string
     */
    public function createPrompt(array $data)
    {
        $stmt = $this->db->prepare("INSERT INTO prompts (title, body, category_id) VALUES (?, ?, ?)");
        $stmt->execute([$data['title'], $data['body'], $data['category_id']]);

        return $this->db->lastInsertId();
    }

    /**
     * @param int $id
     * @param array $data
     * @return mixed
     */
    public function update(int $id, array $data)
    {
        $stmt = $this->db->prepare("UPDATE prompts SET title = ?, body = ? WHERE id = ?");
        $stmt->execute([$data['title'], $data['body'], $id]);

        return $stmt->fetch();
    }

    /**
     * @param int $id
     * @return void
     */
    public function delete(int $id)
    {
        $stmt = $this->db->prepare("DELETE FROM prompts WHERE id = ?");
        $stmt->execute([$id]);
    }
}