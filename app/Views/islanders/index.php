<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Islanders List</title>
    <link rel="icon" href="https://www.finolhu.com/wp-content/uploads/2019/04/cropped-finolhu-favicon-1-32x32.png" sizes="32x32" />
<link rel="icon" href="https://www.finolhu.com/wp-content/uploads/2019/04/cropped-finolhu-favicon-1-192x192.png" sizes="192x192" />
<link rel="apple-touch-icon" href="https://www.finolhu.com/wp-content/uploads/2019/04/cropped-finolhu-favicon-1-180x180.png" />
<meta name="msapplication-TileImage" content="https://www.finolhu.com/wp-content/uploads/2019/04/cropped-finolhu-favicon-1-270x270.png" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<!-- Top Header -->
<nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm mb-4">
    <div class="container">
        <a class="navbar-brand fw-bold" href="<?= site_url('/') ?>" style="letter-spacing:2px;">Business Card System</a>
        <span class="navbar-text text-muted">Islanders Management</span>
    </div>
</nav>

<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h1 class="fw-bold mb-0" style="letter-spacing:1px;">Islanders</h1>
                <a href="<?= site_url('islanders/create') ?>" class="btn btn-success btn-lg px-4"><i class="fa fa-plus me-2"></i>Add Islander</a>
            </div>
            <div class="card shadow-sm border-0">
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th style="width:70px;">ID</th>
                                    <th>Full Name</th>
                                    <!-- <th>Token</th> -->
                                    <th style="width:220px;">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php foreach ($islanders as $islander): ?>
                                <?php
                                $id = is_array($islander) ? $islander['id'] : $islander->id;
                                $full_name = is_array($islander) ? $islander['full_name'] : $islander->full_name;
                                $token = is_array($islander) ? $islander['token'] : $islander->token;
                                ?>
                                <tr>
                                    <td class="text-muted fw-semibold"><?= esc($id) ?></td>
                                    <td class="fw-semibold"><?= esc($full_name) ?></td>
                                    <!-- <td><span class="badge bg-secondary px-2 py-1"><?= esc($token) ?></span></td> -->
                                    <td>
                                        <div class="btn-group" role="group" aria-label="Actions">
                                            <a href="<?= site_url('islanders/edit/'.$id) ?>" class="btn btn-sm btn-outline-primary"><i class="fa fa-edit me-1"></i>Edit</a>
                                            <a href="<?= site_url('islanders/delete/'.$id) ?>" class="btn btn-sm btn-outline-danger" onclick="return confirm('Delete?')"><i class="fa fa-trash me-1"></i>Delete</a>
                                            <a href="<?= site_url('card/'.$token) ?>" class="btn btn-sm btn-outline-info"><i class="fa fa-id-card me-1"></i>View Card</a>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Bottom Footer -->
<footer class="bg-white border-top py-3 mt-5 fixed-bottom">
    <div class="container text-center text-muted small">
        &copy; <?= date('Y') ?> Business Card System &mdash; Powered by CodeIgniter 4
    </div>
</footer>
<style>
    footer.fixed-bottom {
        left: 0;
        right: 0;
        bottom: 0;
        z-index: 1030;
    }
    body {
        padding-bottom: 70px; /* Prevent content from being hidden behind footer */
    }
</style>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
</body>
</html>
