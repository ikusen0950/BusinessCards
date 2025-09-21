<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Users</title>
    <link rel="icon" href="https://www.finolhu.com/wp-content/uploads/2019/04/cropped-finolhu-favicon-1-32x32.png" sizes="32x32" />
    <link rel="icon" href="https://www.finolhu.com/wp-content/uploads/2019/04/cropped-finolhu-favicon-1-192x192.png" sizes="192x192" />
    <link rel="apple-touch-icon" href="https://www.finolhu.com/wp-content/uploads/2019/04/cropped-finolhu-favicon-1-180x180.png" />
    <meta name="msapplication-TileImage" content="https://www.finolhu.com/wp-content/uploads/2019/04/cropped-finolhu-favicon-1-270x270.png" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <style>
        body { background: #edece7; }
        .dashboard-card {
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 12px rgba(0,0,0,0.08);
            padding: 32px 24px;
            min-width: 250px;
            min-height: 120px;
            display: flex;
            flex-direction: column;
            align-items: flex-start;
            justify-content: center;
        }
        .dashboard-card .fa {
            font-size: 2.5rem;
            color: #3498b1;
            margin-bottom: 8px;
        }
        .dashboard-card-title {
            font-size: 1.1rem;
            color: #3498b1;
            font-weight: 600;
        }
        .dashboard-card-value {
            font-size: 2.2rem;
            color: #3498b1;
            font-weight: 700;
            margin-top: 8px;
        }
        .navbar-dashboard {
            background: #3498b1;
            color: #fff;
            box-shadow: 0 2px 8px rgba(0,0,0,0.08);
        }
        .navbar-dashboard .navbar-brand {
            color: #fff;
            font-weight: bold;
            font-size: 1.4rem;
            letter-spacing: 1px;
        }
        .navbar-dashboard .nav-link {
            color: #eaf6fa !important;
            font-weight: 500;
            font-size: 1rem;
            margin-right: 1.2rem;
            display: flex;
            align-items: center;
        }
        .navbar-dashboard .nav-link.active {
            font-weight: bold;
            text-decoration: none;
        }
        .navbar-dashboard .fa {
            margin-right: 6px;
        }
    </style>
</head>

<body class="bg-light">
<?php include(APPPATH . 'Views/layouts/header.php'); ?>
    <div class="container py-5">
        <h2 class="mb-4 fw-bold">Users</h2>
        <div class="row g-4 mb-5">
            <div class="col-md-3">
                <div class="dashboard-card">
                    <span class="dashboard-card-title">Islanders</span>
                    <i class="fa fa-users"></i>
                    <span class="dashboard-card-value">-</span>
                </div>
            </div>
            <div class="col-md-3">
                <div class="dashboard-card">
                    <span class="dashboard-card-title">Cards</span>
                    <i class="fa fa-id-card"></i>
                    <span class="dashboard-card-value">-</span>
                </div>
            </div>
            <div class="col-md-3">
                <div class="dashboard-card">
                    <span class="dashboard-card-title">Socials</span>
                    <i class="fa fa-share-alt"></i>
                    <span class="dashboard-card-value">-</span>
                </div>
            </div>
            <div class="col-md-3">
                <div class="dashboard-card">
                    <span class="dashboard-card-title">Users</span>
                    <i class="fa fa-user"></i>
                    <span class="dashboard-card-value"><?= isset($userCount) ? esc($userCount) : '-' ?></span>
                </div>
            </div>
        </div>

        <!-- Users Table -->
        <div class="card shadow-sm border-0 mb-5">
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="table-light">
                            <tr>
                                <th style="width:70px;">ID</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Job Title</th>
                                <th style="width:260px;">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($users as $user): ?>
                            <tr>
                                <td class="text-muted fw-semibold"><?= esc($user->id) ?></td>
                                <td class="fw-semibold"><?= esc($user->full_name) ?></td>
                                <td><?= esc($user->email) ?></td>
                                <td><?= esc($user->job_title) ?></td>
                                <td>
                                    <div class="btn-group" role="group" aria-label="Actions">
                                        <a href="<?= site_url('admin/users/edit/'.$user->id) ?>" class="btn btn-sm btn-outline-primary"><i class="fa fa-edit me-1"></i>Edit</a>
                                        <form method="post" action="<?= site_url('admin/users/delete/'.$user->id) ?>" style="display:inline;">
                                            <?= csrf_field() ?>
                                            <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Delete user?')"><i class="fa fa-trash me-1"></i>Delete</button>
                                        </form>
                                        <form method="post" action="<?= site_url('admin/users/regen-token/'.$user->id) ?>" style="display:inline;">
                                            <?= csrf_field() ?>
                                            <button type="submit" class="btn btn-sm btn-outline-warning"><i class="fa fa-refresh me-1"></i>Regenerate Token</button>
                                        </form>
                                        <a href="<?= site_url('card/'.$user->card_token) ?>" target="_blank" class="btn btn-sm btn-outline-info"><i class="fa fa-id-card me-1"></i>View Card</a>
                                    </div>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="d-flex justify-content-end mb-4">
            <a href="<?= site_url('admin/users/create') ?>" class="btn btn-success btn-lg px-4"><i class="fa fa-plus me-2"></i>Create User</a>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<?php include(APPPATH . 'Views/layouts/footer.php'); ?>
</body>
</html>