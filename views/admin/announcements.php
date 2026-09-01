<?php
// path: /user/modules/announcements/views/admin/announcements.php

/* [AI:OpenAI Codex | 2026-08-26 08:01:32 UTC] */
require APPROOT . '/views/inc/head.php';

$editItem = is_array($data['edit_item'] ?? null)
    ? $data['edit_item']
    : false;
$isEditing = $editItem !== false;
?>

<p>
    <small>
        <a href="/admin">Admin</a> &gt;&gt; <strong>Announcements</strong>
    </small>
</p>

<div class="container my-3 text-light">
    <h1 class="h5 mb-3">Announcements — Management</h1>

    <form
        method="post"
        action="/admin/announcements"
        class="card bg-dark text-white border-secondary card-body mb-4"
    >
        <?= $this->csrf_field(); ?>

        <?php if ($isEditing) : ?>
            <input
                type="hidden"
                name="edit_id"
                value="<?= (int) $editItem['id']; ?>"
            >
        <?php endif; ?>

        <h2 class="h6 mb-3">
            <?= $isEditing ? 'Edit Announcement' : 'Add Announcement'; ?>
        </h2>

        <div class="mb-2">
            <label class="form-label" for="announcement-title">Title</label>
            <input
                id="announcement-title"
                name="title"
                class="form-control form-control-sm bg-dark text-white border-secondary"
                value="<?= htmlspecialchars(
                    (string) ($editItem['title'] ?? ''),
                    ENT_QUOTES,
                    'UTF-8'
                ); ?>"
                required
            >
        </div>

        <div class="mb-2">
            <label class="form-label" for="announcement-body">Body</label>
            <textarea
                id="announcement-body"
                name="body"
                class="form-control form-control-sm bg-dark text-white border-secondary"
                rows="6"
                aria-describedby="announcement-body-help"
                required
            ><?= htmlspecialchars(
                (string) ($editItem['body'] ?? ''),
                ENT_QUOTES,
                'UTF-8'
            ); ?></textarea>
            <div id="announcement-body-help" class="form-text text-secondary">
                HTML is accepted for emphasis, links, paragraphs, and line breaks.
            </div>
        </div>

        <div class="form-check mb-3">
            <input
                class="form-check-input bg-dark border-secondary"
                type="checkbox"
                name="published"
                id="pub"
                <?= !$isEditing || !empty($editItem['published']) ? 'checked' : ''; ?>
            >
            <label class="form-check-label" for="pub">Published</label>
        </div>

        <div class="d-flex gap-2">
            <button class="btn btn-sm btn-outline-primary" type="submit">
                <?= $isEditing ? 'Update Announcement' : 'Add Announcement'; ?>
            </button>

            <?php if ($isEditing) : ?>
                <a class="btn btn-sm btn-outline-secondary" href="/admin/announcements">
                    Cancel
                </a>
            <?php endif; ?>
        </div>
    </form>

    <div class="table-responsive">
        <table class="table table-sm table-dark table-hover align-middle border-secondary">
            <thead>
                <tr class="text-secondary">
                    <th scope="col">Date</th>
                    <th scope="col">Title</th>
                    <th scope="col">Status</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($data['items'])) : ?>
                    <?php foreach ($data['items'] as $item) : ?>
                        <tr>
                            <td class="text-secondary small">
                                <?= htmlspecialchars(
                                    (string) $item['created_at'],
                                    ENT_QUOTES,
                                    'UTF-8'
                                ); ?>
                            </td>
                            <td>
                                <?= htmlspecialchars(
                                    (string) $item['title'],
                                    ENT_QUOTES,
                                    'UTF-8'
                                ); ?>
                            </td>
                            <td>
                                <span class="badge <?= !empty($item['published'])
                                    ? 'text-bg-success'
                                    : 'text-bg-dark border border-secondary'; ?>">
                                    <?= !empty($item['published']) ? 'Published' : 'Draft'; ?>
                                </span>
                            </td>
                            <td>
                                <div class="d-flex align-items-center gap-2">
                                    <a
                                        class="btn btn-sm btn-link p-0"
                                        href="/admin/announcements/edit/<?= (int) $item['id']; ?>"
                                    >
                                        Edit
                                    </a>

                                    <form method="post" action="/admin/announcements" class="d-inline">
                                        <?= $this->csrf_field(); ?>
                                        <input
                                            type="hidden"
                                            name="delete_id"
                                            value="<?= (int) $item['id']; ?>"
                                        >
                                        <button
                                            type="submit"
                                            class="btn btn-sm btn-link text-danger p-0"
                                            onclick="return confirm('Delete this announcement?')"
                                        >
                                            Delete
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else : ?>
                    <tr>
                        <td colspan="4" class="text-center text-secondary py-4">
                            No announcements found.
                        </td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<?php
require APPROOT . '/views/inc/foot.php';
/* [End AI:OpenAI Codex] */
