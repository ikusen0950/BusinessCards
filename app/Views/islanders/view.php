<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Islander Card View</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container py-4">
    <h1>Islander Card</h1>
    <div class="card mb-4 p-3">
        <h3><?= esc($islander['full_name']) ?></h3>
        <p><strong>Token:</strong> <?= esc($islander['token']) ?></p>
        <?php if ($card): ?>
        <p><strong>Designation:</strong> <?= esc($card['designation']) ?></p>
        <p><strong>Email:</strong> <?= esc($card['email']) ?></p>
        <p><strong>Phone:</strong> <?= esc($card['phone']) ?></p>
        <?php endif; ?>
    </div>
    <h4>Social Icons</h4>
    <ul class="list-group mb-4">
        <?php foreach ($socials as $social): ?>
        <li class="list-group-item">
            <strong><?= esc($social['label']) ?>:</strong>
            <a href="<?= esc($social['link']) ?>" target="_blank"><?= esc($social['link']) ?></a>
            <?php if ($social['icon']): ?>
                <span class="ms-2"><i class="<?= esc($social['icon']) ?>"></i></span>
            <?php endif; ?>
        </li>
        <?php endforeach; ?>
    </ul>
    <a href="<?= site_url('islanders') ?>" class="btn btn-secondary">Back to List</a>
</div>
</body>
</html>
