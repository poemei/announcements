<?php

declare(strict_types=1);

/* [AI:GPT-5.6 | 2026-09-01 05:00:00 UTC] */
final class announcements extends controller
{
    private const ADMIN_ACTIONS = ['create', 'update', 'delete'];

    public function index(array $params = []): void
    {
        $model = $this->model('announcements_model');
        $this->view('index', ['items' => $model->getActive()]);
    }

    public function admin(array $params = []): void
    {
        $this->require_admin(7);
        $model = $this->model('announcements_model');

        if (($_SERVER['REQUEST_METHOD'] ?? 'GET') === 'POST') {
            $this->require_csrf();
            $action = trim((string) ($_POST['action'] ?? ''));
            if (!in_array($action, self::ADMIN_ACTIONS, true)) {
                http_response_code(400);
                $this->error_page('Invalid Announcements module action.');
            }

            $id = $this->validId($_POST['id'] ?? null);
            if ($action === 'delete') {
                if ($id === null) {
                    $this->invalidRecord();
                }
                $model->deleteAnnouncement($id);
            } else {
                $announcement = $this->validatedAnnouncement($_POST);
                if ($action === 'create') {
                    $model->createAnnouncement($announcement);
                } elseif ($id === null) {
                    $this->invalidRecord();
                } else {
                    $model->updateAnnouncement($id, $announcement);
                }
            }

            header('Location: /admin/announcements');
            exit;
        }

        $editItem = null;
        $editOffset = array_search('edit', $params, true);
        $requestedEditId = $editOffset !== false
            ? ($params[$editOffset + 1] ?? null)
            : ($_GET['edit'] ?? null);
        if ($requestedEditId !== null) {
            $id = $this->validId($requestedEditId);
            if ($id === null || !is_array($editItem = $model->getById($id))) {
                $this->invalidRecord();
            }
        }

        $this->view('admin/announcements', [
            'items' => $model->getAll(),
            'edit_item' => $editItem,
        ]);
    }

    private function validatedAnnouncement(array $input): array
    {
        $title = trim((string) ($input['title'] ?? ''));
        $body = trim((string) ($input['body'] ?? ''));
        if ($title === '' || strlen($title) > 255 || $body === '') {
            http_response_code(422);
            $this->error_page('Enter a valid announcement title and body.');
        }
        return ['title' => $title, 'body' => $body, 'published' => isset($input['published']) ? 1 : 0];
    }

    private function validId($value): ?int
    {
        $id = filter_var($value, FILTER_VALIDATE_INT, ['options' => ['min_range' => 1]]);
        return $id === false || $id === null ? null : (int) $id;
    }

    private function invalidRecord(): void
    {
        http_response_code(400);
        $this->error_page('Invalid Announcement record.');
    }
}
/* [End AI:GPT-5.6] */
