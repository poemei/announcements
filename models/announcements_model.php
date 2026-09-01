<?php

declare(strict_types=1);

/* [AI:GPT-5.6 | 2026-09-01 05:00:00 UTC] */
final class announcements_model extends model
{
    private const TABLE = 'announcements';

    public function getAll(): array
    {
        return $this->fetchAll('SELECT * FROM `announcements` ORDER BY `id` DESC');
    }

    public function getById(int $id)
    {
        return $this->fetch('SELECT * FROM `announcements` WHERE `id` = :id LIMIT 1', ['id' => $id]);
    }

    public function getActive(): array
    {
        return $this->fetchAll('SELECT * FROM `announcements` WHERE `published` = :published ORDER BY `created_at` DESC', ['published' => 1]);
    }

    public function createAnnouncement(array $data): int
    {
        return (int) $this->insert(self::TABLE, $data);
    }

    public function updateAnnouncement(int $id, array $data): void
    {
        $this->update(self::TABLE, $data, 'id = :record_id', ['record_id' => $id]);
    }

    public function deleteAnnouncement(int $id): void
    {
        $this->query('DELETE FROM `announcements` WHERE `id` = :id', ['id' => $id]);
    }
}
/* [End AI:GPT-5.6] */
