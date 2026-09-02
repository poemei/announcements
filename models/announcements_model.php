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

    /** Compatibility API used by existing domain modules. */
    public function get_latest_single()
    {
        return $this->fetch(
            'SELECT * FROM `announcements` '
            . 'WHERE `published` = :published '
            . 'ORDER BY `created_at` DESC LIMIT 1',
            ['published' => 1]
        );
    }

    /** Compatibility API used by existing domain modules. */
    public function get_latest(int $limit = 5): array
    {
        $limit = max(1, min($limit, 50));

        $statement = $this->db->prepare(
            'SELECT * FROM `announcements` '
            . 'WHERE `published` = :published '
            . 'ORDER BY `created_at` DESC LIMIT :result_limit'
        );
        $statement->bindValue(':published', 1, PDO::PARAM_INT);
        $statement->bindValue(':result_limit', $limit, PDO::PARAM_INT);
        $statement->execute();

        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    /** Compatibility API retained for installed consumers. */
    public function get_active(): array
    {
        return $this->getActive();
    }

    /** Compatibility API retained for installed consumers. */
    public function get_all(): array
    {
        return $this->getAll();
    }

    /** Compatibility API retained for installed consumers. */
    public function get_by_id(int $id)
    {
        return $this->getById($id);
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
