<?php
// path: /user/modules/announcements/controllers/announcements.php

/* [AI:OpenAI Codex | 2026-08-26 08:01:32 UTC] */
class announcements extends controller
{
    /**
     * Display the public announcements index.
     *
     * @param array $url Route parameters.
     *
     * @return void
     */
    public function index($url = [])
    {
        $data = ['items' => []];
        $model = $this->model('announcements_model');

        if (method_exists($model, 'get_active')) {
            $data['items'] = $model->get_active();
        }

        $this->view('public/announcements/index', $data);
    }

    /**
     * Display and process announcement administration.
     *
     * @param array $params Route parameters.
     *
     * @return void
     */
    public function admin($params = [])
    {
        $data = [
            'items' => [],
            'edit_item' => false,
        ];

        if (!isset($_SESSION['user_level']) || $_SESSION['user_level'] < 7) {
            header('Location: /auth/login');
            exit;
        }

        $model = $this->model('announcements_model');

        $action = $params[1] ?? null;
        $id = isset($params[2]) ? (int) $params[2] : 0;

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->require_csrf();
        }

        // ACTION: POST-based Deletion
        if (
            $_SERVER['REQUEST_METHOD'] === 'POST'
            && isset($_POST['delete_id'])
        ) {
            $model->delete_by_id((int) $_POST['delete_id']);
            header('Location: /admin/announcements');
            exit;
        }

        // ACTION: Update Existing Announcement
        if (
            $_SERVER['REQUEST_METHOD'] === 'POST'
            && isset($_POST['edit_id'], $_POST['title'], $_POST['body'])
        ) {
            $editId = (int) $_POST['edit_id'];

            if ($editId > 0) {
                $model->update_announcement($editId, [
                    'title' => trim((string) $_POST['title']),
                    'body' => trim((string) $_POST['body']),
                    'published' => isset($_POST['published']) ? 1 : 0,
                ]);
            }

            header('Location: /admin/announcements');
            exit;
        }

        // ACTION: New Addition
        if (
            $_SERVER['REQUEST_METHOD'] === 'POST'
            && isset($_POST['title'], $_POST['body'])
        ) {
            $model->insert('announcements', [
                'title' => trim((string) $_POST['title']),
                'body' => trim((string) $_POST['body']),
                'published' => isset($_POST['published']) ? 1 : 0,
            ]);
            header('Location: /admin/announcements');
            exit;
        }

        // ACTION: Load Existing Announcement Into the Shared Form
        if ($action === 'edit' && $id > 0) {
            $data['edit_item'] = $model->get_by_id($id);

            if (!$data['edit_item']) {
                header('Location: /admin/announcements');
                exit;
            }
        }

        if (method_exists($model, 'get_all')) {
            $data['items'] = $model->get_all();
        }

        $this->view('admin/announcements', $data);
    }
}
/* [End AI:OpenAI Codex] */
