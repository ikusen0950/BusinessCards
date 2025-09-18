<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= isset($user) ? 'Edit User' : 'Create User' ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-7 col-lg-6">
            <a href="<?= site_url('admin/users') ?>" class="btn btn-secondary mb-3">&larr; Back to Admin</a>
            <h1 class="mb-4 text-center"><?= isset($user) ? 'Edit User' : 'Create User' ?></h1>
            <form method="post" enctype="multipart/form-data" action="<?= isset($user) ? site_url('admin/users/update/'.$user->id) : site_url('admin/users/store') ?>" class="card p-4 shadow-sm">
                <?php if (session('errors')): ?>
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                        <?php foreach (session('errors') as $error): ?>
                            <li><?= esc($error) ?></li>
                        <?php endforeach; ?>
                        </ul>
                    </div>
                <?php endif; ?>
                <?= csrf_field() ?>
                <div class="row g-3 mb-2">
                    <div class="col-md-12">
                        <label class="form-label">Full Name</label>
                        <input type="text" name="full_name" class="form-control" value="<?= esc($user->full_name ?? '') ?>" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Email</label>
                        <input type="email" name="email" class="form-control" value="<?= esc($user->email ?? '') ?>" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Phone</label>
                        <input type="text" name="phone" class="form-control" value="<?= esc($user->phone ?? '') ?>">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Designation</label>
                        <input type="text" name="job_title" class="form-control" value="<?= esc($user->job_title ?? '') ?>">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Company</label>
                        <input type="text" name="company" class="form-control" value="<?= esc($user->company ?? '') ?>">
                    </div>
                    <div class="col-md-12">
                        <label class="form-label">Website</label>
                        <input type="text" name="website" class="form-control" value="<?= esc($user->website ?? '') ?>">
                    </div>
                    <div class="col-md-12">
                        <label class="form-label">Address</label>
                        <textarea name="address" class="form-control" rows="2"><?= esc($user->address ?? '') ?></textarea>
                    </div>
                </div>
                <hr>
                <div class="row g-3 mb-2">
                    <div class="col-md-6">
                        <label class="form-label">Card Theme</label>
                        <select name="card_theme" class="form-select">
                            <option value="">Select theme</option>
                            <option value="minimal" <?= isset($user) && $user->card_theme=='minimal' ? 'selected' : '' ?>>Minimal</option>
                            <option value="detailed" <?= isset($user) && $user->card_theme=='detailed' ? 'selected' : '' ?>>Detailed</option>
                            <option value=".here" <?= isset($user) && $user->card_theme=='.here' ? 'selected' : '' ?>>.Here</option>
                            <option value="finolhu" <?= isset($user) && $user->card_theme=='finolhu' ? 'selected' : '' ?>>Finolhu</option>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Card Token</label>
                        <input type="text" name="card_token" class="form-control" value="<?= esc($user->card_token ?? '') ?>" readonly>
                    </div>
                    <div class="col-md-12">
                        <label class="form-label">vCard Note</label>
                        <textarea name="vcard_note" class="form-control" rows="2"><?= esc($user->vcard_note ?? '') ?></textarea>
                    </div>
                </div>
                <!-- Hidden fields to ensure update always has data -->
                <input type="hidden" name="card_token_expires_at" value="<?= esc($user->card_token_expires_at ?? '') ?>">
                <input type="hidden" name="card_views" value="<?= esc($user->card_views ?? '') ?>">
                <input type="hidden" name="card_last_opened_at" value="<?= esc($user->card_last_opened_at ?? '') ?>">
                <button type="submit" class="btn btn-primary w-100 mt-3">Save</button>
            </form>
            <?php if (isset($user)): ?>
            <div class="mb-3">
                <form method="post" action="<?= site_url('admin/users/regen-token/'.$user->id) ?>">
                    <?= csrf_field() ?>
                    <button type="submit" class="btn btn-warning mt-2">Regenerate Token</button>
                </form>
                <a href="<?= site_url('card/'.$user->card_token) ?>" target="_blank" class="btn btn-info mt-2">View Public Card</a>
            </div>
            <?php endif; ?>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
