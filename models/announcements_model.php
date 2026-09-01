<?php
// path: /user/modules/announcements/models/announcements_model.php

/* [AI:OpenAI Codex | 2026-08-26 08:01:32 UTC] */
class announcements_model extends model
{
    /**
     * Announcement table name.
     *
     * @var string
     */
    protected $table = 'announcements';

    /**
     * Fetch all announcements for administration.
     *
     * @return array
     */
    public function get_all()
    {
        // The table is explicitly defined for the query.
        return $this->db
            ->query("SELECT * FROM {$this->table} ORDER BY id DESC")
            ->fetchAll();
    }

    /**
     * Fetch one announcement by identifier.
     *
     * @param int $id Announcement identifier.
     *
     * @return array|false
     */
    public function get_by_id($id)
    {
        $sql = "SELECT * FROM {$this->table} WHERE id = :id LIMIT 1";

        return $this->fetch($sql, ['id' => (int) $id]);
    }

    /**
     * Update an existing announcement.
     *
     * @param int   $id   Announcement identifier.
     * @param array $data Updated announcement values.
     *
     * @return bool
     */
    public function update_announcement($id, $data)
    {
        $sql = "UPDATE {$this->table}
            SET title = :title,
                body = :body,
                published = :published
            WHERE id = :id";

        $statement = $this->db->prepare($sql);

        return $statement->execute([
            'title' => (string) $data['title'],
            'body' => (string) $data['body'],
            'published' => (int) $data['published'],
            'id' => (int) $id,
        ]);
    }

    /**
     * Delete an announcement.
     *
     * @param string $table The table name.
     * @param string $where The WHERE clause (e.g., "id = 5").
     *
     * @return mixed
     */
    public function delete_by_id($id)
    {
        $statement = $this->db->prepare(
            "DELETE FROM {$this->table} WHERE id = :id"
        );

        return $statement->execute([
            'id' => (int) $id,
        ]);
    }

    /**
     * Fetch only published rows.
     *
     * @return array
     */
    public function get_active()
    {
        $sql = "SELECT * FROM {$this->table}
            WHERE published = 1
            ORDER BY created_at DESC";

        return $this->fetchAll($sql);
    }

    /**
     * Insert a published announcement.
     *
     * @param array $data Announcement values.
     *
     * @return mixed
     */
    public function add($data)
    {
        // Insert new announcement.
        return $this->insert($this->table, [
            'title' => $data['title'],
            'body' => $data['body'],
            'published' => 1,
        ]);
    }

    /**
     * Fetch the latest published announcements.
     *
     * @param int $limit Maximum number of announcements.
     *
     * @return array
     */
    public function get_latest($limit = 5)
    {
        $sql = "SELECT * FROM {$this->table}
            WHERE published = 1
            ORDER BY created_at DESC
            LIMIT :limit";

        // Use the base model's fetchAll with the limit parameter.
        return $this->fetchAll($sql, ['limit' => (int) $limit]);
    }

    /**
     * Fetch the latest published announcement.
     *
     * @return array|false
     */
    public function get_latest_single()
    {
        $sql = "SELECT * FROM {$this->table}
            WHERE published = 1
            ORDER BY created_at DESC
            LIMIT 1";

        return $this->fetch($sql);
    }
}
/* [End AI:OpenAI Codex] */
