
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Business Card</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-lg-6">
            <div class="card shadow-lg">
                <div class="card-header text-center bg-primary text-white">
                    <?php if ($user->avatar_path): ?>
                        <img src="<?= base_url($user->avatar_path) ?>" alt="Avatar" class="rounded-circle mb-2" style="max-width:120px;">
                    <?php endif; ?>
                    <?php if ($user->logo_path): ?>
                        <img src="<?= base_url($user->logo_path) ?>" alt="Logo" class="mb-2" style="max-width:80px;">
                    <?php endif; ?>
                    <h2 class="mb-0"><?= esc($user->username) ?></h2>
                    <h4 class="mb-0"><?= esc($user->job_title) ?></h4>
                    <h5 class="mb-2"><?= esc($user->company) ?></h5>
                </div>
                <div class="card-body">
                    <div class="row mb-2">
                        <div class="col-6"><strong>Phone:</strong></div>
                        <div class="col-6"><a href="tel:<?= esc($user->getPhoneDigits()) ?>" class="text-decoration-none"><?= esc($user->phone) ?></a></div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-6"><strong>Email:</strong></div>
                        <div class="col-6"><a href="mailto:<?= esc($user->email) ?>" class="text-decoration-none"><?= esc($user->email) ?></a></div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-6"><strong>Website:</strong></div>
                        <div class="col-6"><a href="<?= esc($user->website) ?>" target="_blank" class="text-decoration-none"><?= esc($user->website) ?></a></div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-6"><strong>Location:</strong></div>
                        <div class="col-6"><?= esc($user->location) ?></div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-6"><strong>Theme:</strong></div>
                        <div class="col-6"><?= esc($user->card_theme) ?></div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-6"><strong>Note:</strong></div>
                        <div class="col-6"><?= esc($user->vcard_note) ?></div>
                    </div>
                    <div class="mb-3 text-center">
                        <a href="<?= site_url('card/'.$user->card_token.'/vcard.vcf') ?>" class="btn btn-outline-primary me-2">Save Contact (.vcf)</a>
                        <a href="<?= site_url('card/'.$user->card_token) ?>" class="btn btn-outline-secondary">Share Link</a>
                    </div>
                    <div class="mb-2 text-center">
                        <img src="<?= site_url('card/'.$user->card_token.'/qr.png') ?>" alt="QR Code" class="img-fluid">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
