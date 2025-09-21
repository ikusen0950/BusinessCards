<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Business Card - .Here</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <script src="https://kit.fontawesome.com/734445d7bc.js" crossorigin="anonymous"></script>

    <style>
    /* Remove underline from phone and email links */
    .bc-contact a,
    .bc-contact a[href^="tel"],
    .bc-contact a[href^="mailto"] {
        text-decoration: none !important;
        color: inherit !important;
        border-bottom: none !important;
        background: none !important;
        box-shadow: none !important;
        -webkit-text-decoration-skip: none !important;
        -webkit-text-decoration: none !important;
        -webkit-tap-highlight-color: transparent !important;
    }

    body {
        background: #f7f7f7;
    }

    @font-face {
        font-family: 'Moeda';
        src: url('/assets/media/fonts/Moeda.otf') format('opentype');
        font-weight: normal;
        font-style: normal;
    }

    @font-face {
        font-family: 'Open Sans Regular';
        src: url('/assets/media/fonts/Open_Sans_Regular.ttf') format('opentype');
        font-weight: normal;
        font-style: normal;
    }

    .bc-card {
        width: 100%;
        max-width: 400px;
        height: 250px;
        margin: 40px auto 0 auto;
        background: #fff;
        border: none;
        box-shadow: 0 2px 12px rgba(0, 0, 0, 0.08);
        padding: 0;
        position: relative;
        /* Removed flexbox centering to keep content left-aligned */
    }

    .bc-name {
        color: #c1b4aa;
        font-weight: bold;
        font-size: 1.8rem;
        margin-top: -15px;
        margin-top: 20px;
        margin-left: 20px;
        /* margin-bottom: 0.1rem; */
        font-family: 'Moeda', Arial, sans-serif;
    }

    .bc-title {
        letter-spacing: 2px;
        color: #c1b4aa;
        font-size: 0.9rem;
        margin-bottom: 0.1rem;
        margin-left: 20px;
        font-family: 'Open Sans Regular', Arial, sans-serif;
    }

    .bc-contact {
        color: #c1b4aa;
        font-size: 0.9rem;
        margin-bottom: 2.2rem;
        margin-left: 20px;
        font-family: 'Open Sans Regular', Arial, sans-serif;
    }

    .bc-logo {
        display: block;
        max-width: 150px;
        margin: 0;
        padding: 0;
    }

    @media (max-width: 576px) {
        .bc-card {
            margin: 150px auto 4px auto;
            height: auto;
            /* padding: 16px 8px 8px 8px; */
        }

        .bc-name {
            margin-top: 5px;
            margin-left: 20px;
        }

        .bc-title,
        .bc-contact {
            margin-left: 20px;
        }
    }

    #fab {
        background-color: #c1b4aa !important;
        border-color: #c1b4aa !important;
    }

    #saveToPhoneBtn {
        border-color: #c1b4aa !important;
    }

    #copyLinkBtn .bi {
        color: #fff;
        font-size: 1.3rem;
    }

    /* Social icons color */
    .facebook a i {
        color: #c1b4aa;
    }

    .twitter a i {
        color: #c1b4aa;
    }

    .youtube a i {
        color: #c1b4aa;
    }

    .instagram a i {
        color: #c1b4aa;
    }
    </style>

</head>

<body>
    <div class="bc-card position-relative" style="display: flex; flex-direction: row; align-items: stretch;">
        <div style="width: 50px; height: 250px; overflow: hidden; margin: 0; padding: 0;">
            <img src="/assets/media/logo/Picture.jpg" alt="Left Image"
                style="width: 50px; height: 250px; object-fit: cover; display: block; margin: 0; padding: 0;">
        </div>
        <div style="flex: 1; padding-left: 0;">
            <div class="bc-name"><?= esc($user->username) ?></div>
            <div class="bc-title"><?= strtoupper(esc($user->job_title)) ?></div>
            <div class="bc-contact">
                Phone <?php
                    // Format phone number as +960 730 6700
                    $phone = $user->phone;
                    if (preg_match('/^(\+\d{3})(\d{3})(\d{4})$/', $phone, $matches)) {
                        $formattedPhone = $matches[1] . ' ' . $matches[2] . ' ' . $matches[3];
                    } else {
                        $formattedPhone = $phone;
                    }
                ?><?= esc($formattedPhone) ?> &bull; <?= esc($user->email) ?>
            </div>
            <div class="row" style="margin-top: 5px; margin-right: 10px;">
                <div class="col-6"></div>
                <div class="col-6">
                    <img src="/assets/media/logo/here.png" alt="Logo" class="bc-logo mt-4 me-4">
                </div>
            </div>
        </div>
    </div>
    <!-- Social Media Links -->
    <div class="text-center mt-3">
        <ul class="list-inline mb-0">
            <li class="list-inline-item facebook" style="margin-left: 0px; font-size: 2rem;">
                <a href="https://www.facebook.com/profile.php?id=61577687646689&mibextid=wwXIfr&mibextid=wwXIfr"
                    target="_blank" title="Facebook">
                    <i class="fab fa-facebook"></i>
                </a>
            </li>
            <li class="list-inline-item instagram" style="margin-left: 20px; font-size: 2rem;">
                <a href="https://www.instagram.com/_.herebaaatoll/profilecard/?igsh=azdzMXV5cXk0amtm" target="_blank"
                    title="Instagram">
                    <i class="fab fa-instagram"></i>
                </a>
            </li>
            <li class="list-inline-item youtube" style="margin-left: 20px; font-size: 2rem;">
                <a href="https://www.here-maldives.com/" target="_blank" title="Website">
                    <i class="fa-solid fa-globe"></i>
                </a>
            </li>
        </ul>
        <div class="mt-3 d-flex justify-content-center gap-2">
            <a href="<?= site_url('card/' . $user->card_token . '/vcard.vcf') ?>" class="btn" id="saveToPhoneBtn"
                style="background-color: #c1b4aa; color: #fff; width: 140px;">Save to Phone</a>
            <button type="button" class="btn" id="copyLinkBtn"
                style="background-color: #c1b4aa; color: #fff; width: 100px; height: 40px;">
                Copy Link
            </button>
            <button type="button" class="btn" id="qrCodeBtn"
                style="background-color: #c1b4aa; color: #fff; width: 100px; height: 40px;">
                QR Code
            </button>
        </div>

        <!-- QR Code Modal -->
        <div class="modal fade" id="qrCodeModal" tabindex="-1" aria-labelledby="qrCodeModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="qrCodeModalLabel">QR Code</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body text-center">
                        <img src="<?= esc($user->qrcode_path ?? '/assets/media/logo/default_qr.png') ?>" alt="QR Code"
                            style="max-width: 100%; height: auto;">
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script>
// Copy card link to clipboard
document.getElementById('copyLinkBtn').addEventListener('click', function() {
    var link = "<?= site_url('card/' . $user->card_token) ?>";
    navigator.clipboard.writeText(link).then(function() {
        document.getElementById('copyLinkBtn').textContent = 'Copied!';
        setTimeout(function() {
            document.getElementById('copyLinkBtn').textContent = 'Copy Link';
        }, 1500);
    });
});

// Show QR code modal
document.getElementById('qrCodeBtn').addEventListener('click', function() {
    var qrModal = new bootstrap.Modal(document.getElementById('qrCodeModal'));
    qrModal.show();
});
</script>

</html>