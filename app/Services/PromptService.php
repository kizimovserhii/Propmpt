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
    public function getById(int $id): array
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
     * @return bool
     */
    public function createPrompt(array $data): bool
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
    public function update(int $id, array $data): bool
    {
        $stmt = $this->db->prepare("UPDATE prompts SET title = ?, body = ?, category_id = ? WHERE id = ?");
        $stmt->execute([$data['title'], $data['body'], $data['category_id'], $id]);

        return $stmt->fetch();
    }

    /**
     * @param int $id
     * @return void
     */
    public function delete(int $id): void
    {
        $stmt = $this->db->prepare("DELETE FROM prompts WHERE id = ?");
        $stmt->execute([$id]);
    }

    /**
     * @param array $promptIds
     * @return array
     */
    public function getPrompts(array $promptIds): array
    {
        $IdsString = implode(',', $promptIds);

        $sql = "SELECT * FROM prompts WHERE id IN ($IdsString)";

        $stmt = $this->db->prepare($sql);
        $stmt->execute();

        $prompts = $stmt->fetchAll();

        return $this->sortPrompts($prompts, $promptIds);
    }

    /**
     * @param array $prompts
     * @param array $promptIds
     * @return array
     */
    private function sortPrompts(array $prompts, array $promptIds): array
    {
        $sortPrompts = [];
        foreach ($promptIds as $promptId) {
            foreach ($prompts as $prompt) {
                if ($prompt['id'] == $promptId) {
                    $sortPrompts[] = $prompt;
                }
            }
        }

        return $sortPrompts;
    }
}