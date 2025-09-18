<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Users</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">
    <div class="container py-4">
        <div class="row mb-3">
            <div class="col">
                <h1 class="mb-3">Users</h1>
                <?php if (session('success')): ?>
                <div class="alert alert-success"> <?= esc(session('success')) ?> </div>
                <?php endif; ?>
                <table class="table table-striped table-bordered align-middle">
                    <thead class="table-dark">
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Job Title</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($users as $user): ?>
                        <tr>
                            <td><?= esc($user->id) ?></td>
                            <td><?= esc($user->full_name) ?></td>
                            <td><?= esc($user->email) ?></td>
                            <td><?= esc($user->job_title) ?></td>
                            <td>
                                <a href="<?= site_url('admin/users/edit/'.$user->id) ?>"
                                    class="btn btn-sm btn-primary">Edit</a>
                                <form method="post" action="<?= site_url('admin/users/delete/'.$user->id) ?>"
                                    style="display:inline;">
                                    <?= csrf_field() ?>
                                    <button type="submit" class="btn btn-sm btn-danger"
                                        onclick="return confirm('Delete user?')">Delete</button>
                                </form>
                                <form method="post" action="<?= site_url('admin/users/regen-token/'.$user->id) ?>"
                                    style="display:inline;">
                                    <?= csrf_field() ?>
                                    <button type="submit" class="btn btn-sm btn-warning">Regenerate Token</button>
                                </form>
                                <a href="<?= site_url('card/'.$user->card_token) ?>" target="_blank"
                                    class="btn btn-sm btn-info">View Card</a>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
                <a href="<?= site_url('admin/users/create') ?>" class="btn btn-success">Create User</a>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>