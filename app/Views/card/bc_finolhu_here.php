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

    .bc-card {
        width: 100%;
        max-width: 400px;
        height: 250px;
        margin: 40px auto;
        background: #ecede8;
        border: 15px solid #fff;
        box-shadow: 0 2px 12px rgba(0, 0, 0, 0.08);
        padding: 32px 32px 16px 32px;
        position: relative;
        /* Removed flexbox centering to keep content left-aligned */
    }

    .bc-name {
        color: #009999;
        font-weight: bold;
        font-size: 1.5rem;
        margin-top: -15px;
        margin-bottom: 0.1rem;
        font-family: 'Gill Sans Nova Book', Arial, sans-serif;
    }

    .bc-title {
        letter-spacing: 2px;
        color: #231f20;
        font-size: 0.9rem;
        margin-bottom: 0.1rem;
        font-family: 'Gill Sans Nova Medium', Arial, sans-serif;
    }

    .bc-contact {
        color: #57585a;
        font-size: 0.9rem;
        margin-bottom: 2.2rem;
        font-family: 'Gill Sans Nova Medium', Arial, sans-serif;
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
            padding: 16px 8px 8px 8px;
        }

        .bc-name {
            margin-top: 1px;
            margin-left: 10px;
        }

        .bc-title,
        .bc-contact {
            margin-left: 10px;
        }
    }

    #fab {
        background-color: #38a8bb !important;
        border-color: #38a8bb !important;
    }

    #saveToPhoneBtn {
        border-color: #38a8bb !important;
    }

    #copyLinkBtn .bi {
        color: #fff;
        font-size: 1.3rem;
    }

    /* Social icons color */
    .facebook a i {
        color: #38a8bb;
    }

    .twitter a i {
        color: #38a8bb;
    }

    .youtube a i {
        color: #38a8bb;
    }

    .instagram a i {
        color: #38a8bb;
    }
    </style>

</head>

<body>
    <div class="bc-card position-relative">
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
        <div class="row mt-2">
            <div class="col-6"></div>
            <div class="col-6">
                <img src="/assets/media/logo/finolhu.png" alt="Logo" class="bc-logo">
            </div>
        </div>
    </div>
    <!-- Social Media Links -->
    <div class="text-center mt-3">
        <ul class="list-inline mb-0">
            <li class="list-inline-item facebook" style="margin-left: 0px; font-size: 2rem;">
                <a href="https://www.facebook.com/FinolhuMaldives" target="_blank" title="Facebook">
                    <i class="fab fa-facebook"></i>
                </a>
            </li>
            <li class="list-inline-item twitter" style="margin-left: 20px; font-size: 2rem;">
                <a href="http://twitter.com/finolhumv" target="_blank" title="Twitter">
                    <i class="fab fa-twitter"></i>
                </a>
            </li>
            <li class="list-inline-item youtube" style="margin-left: 20px; font-size: 2rem;">
                <a href="https://www.youtube.com/channel/UCR9otbxhk6F8EUW4Bjhd9Eg" target="_blank" title="Youtube">
                    <i class="fab fa-youtube"></i>
                </a>
            </li>
            <li class="list-inline-item instagram" style="margin-left: 20px; font-size: 2rem;">
                <a href="https://www.instagram.com/finolhu_maldives/" target="_blank" title="Instagram">
                    <i class="fab fa-instagram"></i>
                </a>
            </li>
        </ul>
        <div class="mt-3">
            <a href="<?= site_url('card/' . $user->card_token . '/vcard.vcf') ?>" class="btn mb-2" id="saveToPhoneBtn"
                style="background-color: #38a8bb; color: #fff; width: 250px;">Save to Phone</a><br>
            <button type="button" class="btn btn-secondary" id="copyLinkBtn" style="width: 250px; height: 40px;">
                <span class="bi bi-copy align-middle"></span> <span class="align-middle">Copy Link</span>
            </button>
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
</script>

</html>
