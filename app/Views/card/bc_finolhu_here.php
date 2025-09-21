<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Business Card - Finolhu & .Here</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <script src="https://kit.fontawesome.com/734445d7bc.js" crossorigin="anonymous"></script>
    <style>
    /* --- Finolhu Card Styles --- */
    @font-face {
        font-family: 'Gill Sans Nova Book';
        src: url('/assets/media/fonts/Gill_Sans_Nova_Book.otf') format('opentype');
        font-weight: normal;
        font-style: normal;
    }

    @font-face {
        font-family: 'Gill Sans Nova Medium';
        src: url('/assets/media/fonts/Gill_Sans_Nova_Medium.otf') format('opentype');
        font-weight: normal;
        font-style: normal;
    }

    .bc-card.finolhu {
        width: 100%;
        max-width: 400px;
        height: 250px;
        margin: 40px auto 0 auto;
        background: #ecede8;
        border: 15px solid #fff;
        box-shadow: 0 2px 12px rgba(0, 0, 0, 0.08);
        padding: 32px 32px 16px 32px;
        position: relative;
    }

    .bc-name.finolhu {
        color: #38a8bb;
        font-weight: bold;
        font-size: 1.5rem;
        margin-top: -15px;
        margin-bottom: 0.1rem;
        font-family: 'Gill Sans Nova Book', Arial, sans-serif;
    }

    .bc-title.finolhu {
        letter-spacing: 2px;
        color: #231f20;
        font-size: 0.9rem;
        margin-bottom: 0.1rem;
        font-family: 'Gill Sans Nova Medium', Arial, sans-serif;
    }

    .bc-contact.finolhu {
        color: #57585a;
        font-size: 0.9rem;
        margin-bottom: 2.2rem;
        font-family: 'Gill Sans Nova Medium', Arial, sans-serif;
    }

    .bc-logo.finolhu {
        display: block;
        max-width: 150px;
        margin: 0;
        padding: 0;
    }

    /* --- .Here Card Styles --- */
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

    .bc-card.here {
        width: 100%;
        max-width: 400px;
        height: 250px;
        margin: 40px auto 0 auto;
        background: #fff;
        border: none;
        box-shadow: 0 2px 12px rgba(0, 0, 0, 0.08);
        padding: 0;
        position: relative;
        display: flex;
        flex-direction: row;
        align-items: stretch;
    }

    .bc-name.here {
        color: #c1b4aa;
        font-weight: bold;
        font-size: 1.8rem;
        margin-top: 20px;
        margin-left: 20px;
        font-family: 'Moeda', Arial, sans-serif;
    }

    .bc-title.here {
        letter-spacing: 2px;
        color: #c1b4aa;
        font-size: 0.9rem;
        margin-bottom: 0.1rem;
        margin-left: 20px;
        font-family: 'Open Sans Regular', Arial, sans-serif;
    }

    .bc-contact.here {
        color: #c1b4aa;
        font-size: 0.9rem;
        margin-bottom: 2.2rem;
        margin-left: 20px;
        font-family: 'Open Sans Regular', Arial, sans-serif;
    }

    .bc-logo.here {
        display: block;
        max-width: 150px;
        margin: 0;
        padding: 0;
    }

    /* Social icons color */
    .facebook.finolhu a i,
    .twitter.finolhu a i,
    .youtube.finolhu a i,
    .instagram.finolhu a i {
        color: #38a8bb;
    }

    .facebook.here a i,
    .twitter.here a i,
    .youtube.here a i,
    .instagram.here a i {
        color: #c1b4aa;
    }
    </style>
</head>

<body>
    <!-- Finolhu Card -->
    <div class="bc-card finolhu position-relative">
        <div class="bc-name finolhu"><?= esc($user->username) ?></div>
        <div class="bc-title finolhu"><?= strtoupper(esc($user->job_title)) ?></div>
        <div class="bc-contact finolhu">
            Phone <?php
                $phone = $user->phone;
                if (preg_match('/^(\+\d{3})(\d{3})(\d{4})$/', $phone, $matches)) {
                    $formattedPhone = $matches[1] . ' ' . $matches[2] . ' ' . $matches[3];
                } else {
                    $formattedPhone = $phone;
                }
            ?><?= esc($formattedPhone) ?> &bull; <?= esc($user->email) ?>
        </div>
        <div class="row mt-2">
            <div class="col-6"></div>
            <div class="col-6">
                <img src="/assets/media/logo/finolhu.png" alt="Logo" class="bc-logo finolhu">
            </div>
        </div>
    </div>
    <!-- Finolhu Social Icons & Buttons -->
    <div class="text-center mt-3">
        <ul class="list-inline mb-0">
            <li class="list-inline-item facebook finolhu" style="margin-left: 0px; font-size: 2rem;">
                <a href="https://www.facebook.com/FinolhuMaldives" target="_blank" title="Facebook">
                    <i class="fab fa-facebook"></i>
                </a>
            </li>
            <li class="list-inline-item twitter finolhu" style="margin-left: 20px; font-size: 2rem;">
                <a href="http://twitter.com/finolhumv" target="_blank" title="Twitter">
                    <i class="fa-brands fa-square-x-twitter"></i>
                </a>
            </li>
            <li class="list-inline-item youtube finolhu" style="margin-left: 20px; font-size: 2rem;">
                <a href="https://www.youtube.com/channel/UCR9otbxhk6F8EUW4Bjhd9Eg" target="_blank" title="Youtube">
                    <i class="fab fa-youtube"></i>
                </a>
            </li>
            <li class="list-inline-item instagram finolhu" style="margin-left: 20px; font-size: 2rem;">
                <a href="https://www.instagram.com/finolhu_maldives/" target="_blank" title="Instagram">
                    <i class="fab fa-instagram"></i>
                </a>
            </li>
            <li class="list-inline-item instagram finolhu" style="margin-left: 20px; font-size: 2rem;">
                <a href="https://www.finolhu.com" target="_blank" title="Website">
                    <i class="fa-solid fa-globe"></i>
                </a>
            </li>
        </ul>
        <div class="mt-3 d-flex justify-content-center gap-2">
            <a href="<?= site_url('card/' . $user->card_token . '/vcard.vcf') ?>" class="btn" id="saveToPhoneBtnFinolhu"
                style="background-color: #38a8bb; color: #fff; width: 150px;">Save to Phone</a>
            <button type="button" class="btn" id="copyLinkBtnFinolhu" style="background-color: #38a8bb; color: #fff; width: 100px; height: 40px;">
                Copy Link
            </button>
            <button type="button" class="btn" id="qrCodeBtnFinolhu" style="background-color: #38a8bb; color: #fff; width: 100px; height: 40px;">
                QR Code
            </button>
        </div>
    </div>
    <!-- .Here Card -->
    <div class="bc-card here position-relative" style="margin-top: 32px;">
        <div style="width: 50px; height: 250px; overflow: hidden; margin: 0; padding: 0;">
            <img src="/assets/media/logo/Picture.jpg" alt="Left Image"
                style="width: 50px; height: 250px; object-fit: cover; display: block; margin: 0; padding: 0;">
        </div>
        <div style="flex: 1; padding-left: 0;">
            <div class="bc-name here"><?= esc($user->username) ?></div>
            <div class="bc-title here"><?= strtoupper(esc($user->job_title)) ?></div>
            <div class="bc-contact here">
                Phone <?php
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
                    <img src="/assets/media/logo/here.png" alt="Logo" class="bc-logo here mt-4 me-4">
                </div>
            </div>
        </div>
    </div>
    <!-- .Here Social Icons & Buttons -->
    <div class="text-center mt-3">
        <ul class="list-inline mb-0">
            <li class="list-inline-item facebook here" style="margin-left: 0px; font-size: 2rem;">
                <a href="https://www.facebook.com/profile.php?id=61577687646689&mibextid=wwXIfr&mibextid=wwXIfr"
                    target="_blank" title="Facebook">
                    <i class="fab fa-facebook"></i>
                </a>
            </li>
            <li class="list-inline-item instagram here" style="margin-left: 20px; font-size: 2rem;">
                <a href="https://www.instagram.com/_.herebaaatoll/profilecard/?igsh=azdzMXV5cXk0amtm" target="_blank"
                    title="Instagram">
                    <i class="fab fa-instagram"></i>
                </a>
            </li>
            <li class="list-inline-item youtube here" style="margin-left: 20px; font-size: 2rem;">
                <a href="https://www.here-maldives.com/" target="_blank" title="Website">
                    <i class="fa-solid fa-globe"></i>
                </a>
            </li>
        </ul>
        <div class="mt-3 d-flex justify-content-center gap-2">
            <a href="<?= site_url('card/' . $user->card_token . '/vcard.vcf') ?>" class="btn" id="saveToPhoneBtnHere"
                style="background-color: #c1b4aa; color: #fff; width: 140px;">Save to Phone</a>
            <button type="button" class="btn" id="copyLinkBtnHere" style="background-color: #c1b4aa; color: #fff; width: 100px; height: 40px;">
                Copy Link
            </button>
            <button type="button" class="btn" id="qrCodeBtnHere" style="background-color: #c1b4aa; color: #fff; width: 100px; height: 40px;">
                QR Code
            </button>
        </div>
    </div>
        <!-- QR Code Modal (shared for both cards) -->
        <div class="modal fade" id="qrCodeModal" tabindex="-1" aria-labelledby="qrCodeModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="qrCodeModalLabel">QR Code</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body text-center">
                        <img src="<?= esc($user->qrcode_path ?? '/assets/media/logo/default_qr.png') ?>" alt="QR Code" style="max-width: 100%; height: auto;">
                    </div>
                </div>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
        <script>
        // Copy card link to clipboard for Finolhu
        document.getElementById('copyLinkBtnFinolhu').addEventListener('click', function() {
                var link = "<?= site_url('card/' . $user->card_token) ?>";
                navigator.clipboard.writeText(link).then(function() {
                        document.getElementById('copyLinkBtnFinolhu').textContent = 'Copied!';
                        setTimeout(function() {
                                document.getElementById('copyLinkBtnFinolhu').textContent = 'Copy Link';
                        }, 1500);
                });
        });
        // Copy card link to clipboard for Here
        document.getElementById('copyLinkBtnHere').addEventListener('click', function() {
                var link = "<?= site_url('card/' . $user->card_token) ?>";
                navigator.clipboard.writeText(link).then(function() {
                        document.getElementById('copyLinkBtnHere').textContent = 'Copied!';
                        setTimeout(function() {
                                document.getElementById('copyLinkBtnHere').textContent = 'Copy Link';
                        }, 1500);
                });
        });

        // Show QR code modal for both cards
        document.getElementById('qrCodeBtnFinolhu').addEventListener('click', function() {
                var qrModal = new bootstrap.Modal(document.getElementById('qrCodeModal'));
                qrModal.show();
        });
        document.getElementById('qrCodeBtnHere').addEventListener('click', function() {
                var qrModal = new bootstrap.Modal(document.getElementById('qrCodeModal'));
                qrModal.show();
        });
        </script>
</body>

</html>