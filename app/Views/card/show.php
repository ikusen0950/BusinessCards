<!DOCTYPE html>
<html lang="en">

<?php

    use chillerlan\QRCode\QRCode;
    use chillerlan\QRCode\QROptions;

    $qrCode = site_url('card/'.$islander['token']);
?>


<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Business Card</title>
    <link rel="icon" href="https://www.finolhu.com/wp-content/uploads/2019/04/cropped-finolhu-favicon-1-32x32.png"
        sizes="32x32" />
    <link rel="icon" href="https://www.finolhu.com/wp-content/uploads/2019/04/cropped-finolhu-favicon-1-192x192.png"
        sizes="192x192" />
    <link rel="apple-touch-icon"
        href="https://www.finolhu.com/wp-content/uploads/2019/04/cropped-finolhu-favicon-1-180x180.png" />
    <meta name="msapplication-TileImage"
        content="https://www.finolhu.com/wp-content/uploads/2019/04/cropped-finolhu-favicon-1-270x270.png" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <script src="https://kit.fontawesome.com/734445d7bc.js" crossorigin="anonymous"></script>
    <style>
    .card-social-icon-finolhu {
        font-size: 2.2rem !important;
        color: #38a8bb !important;
        background: none !important;
        border: none !important;
        box-shadow: none !important;
        padding: 0.2em 0.4em;
        transition: color 0.2s;
    }

    .card-social-icon-finolhu:hover {
        color: #231f20 !important;
    }

    .card-social-icon-here {
        font-size: 2.2rem !important;
        color: #c1b4aa !important;
        background: none !important;
        border: none !important;
        box-shadow: none !important;
        padding: 0.2em 0.4em;
        transition: color 0.2s;
    }

    .card-social-icon-here:hover {
        color: #231f20 !important;
    }

    /* Ensure SVG QR code is visible and sized in modal */
    .qr-modal-svg-container {
        display: flex;
        justify-content: center;
        align-items: center;
        width: 300px;
        height: 300px;
        margin: 0 auto;
        background: #fff;
        padding: 16px;
        border-radius: 8px;
    }

    .qr-modal-svg-container svg {
        width: 100% !important;
        height: 100% !important;
        display: block;
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

    .bc-name-finolhu {
        color: #38a8bb;
        font-weight: bold;
        font-size: 1.5rem;
        margin-top: -15px;
        margin-bottom: 0.1rem;
        font-family: 'Gill Sans Nova Book', Arial, sans-serif;
    }

    .bc-title-finolhu {
        letter-spacing: 2px;
        color: #231f20;
        font-size: 0.9rem;
        margin-bottom: 0.1rem;
        font-family: 'Gill Sans Nova Medium', Arial, sans-serif;
        text-transform: uppercase;
    }

    .bc-contact-finolhu {
        color: #57585a;
        font-size: 0.9rem;
        margin-bottom: 2.2rem;
        font-family: 'Gill Sans Nova Medium', Arial, sans-serif;
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

    .bc-name-here {
        color: #c1b4aa;
        font-size: 1.5rem;
        margin-top: -15px;
        font-family: 'Moeda', Arial, sans-serif;
        letter-spacing: 2px;
    }

    .bc-title-here {
        letter-spacing: 2px;
        color: #c1b4aa;
        font-size: 0.9rem;
        margin-bottom: 0.1rem;
        font-family: 'Open Sans Regular', Arial, sans-serif;
        text-transform: uppercase;
    }

    .bc-contact-here {
        color: #c1b4aa;
        font-size: 0.7rem;
        margin-bottom: 2.2rem;
        font-family: 'Open Sans Regular', Arial, sans-serif;
        white-space: nowrap;
    }
    </style>
</head>

<body class="bg-light">
    <div class="container py-4">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="row">
                    <?php if (!empty($islander['cards'])): ?>
                    <div class="d-flex flex-column align-items-center mt-5">
                        <?php foreach ($islander['cards'] as $card): ?>
                        <?php
                    $phoneFmt = $card['phone'];
                    if (preg_match('/^(\+\d{3})(\d{3})(\d{4})$/', $card['phone'], $m)) {
                        $phoneFmt = $m[1] . ' ' . $m[2] . ' ' . $m[3];
                    }
                    ?>
                        <?php if ($card['theme'] === 'finolhu'): ?>
                        <div class="mb-4" style="width:100%;max-width:400px;">
                            <div class="bc-card position-relative"
                                style="max-width:400px;height:250px;margin:auto;background:#ecede8;border:15px solid #fff;box-shadow:0 2px 12px rgba(0,0,0,0.08);padding:32px 32px 16px 32px;">
                                <div class="bc-name-finolhu"
                                    style="color:#38a8bb;font-weight:bold;font-size:1.5rem;margin-top:-15px;margin-bottom:0.1rem;font-family:'Gill Sans Nova Book',Arial,sans-serif;letter-spacing:2px;">
                                    <?= esc($islander['full_name'] ?? '') ?>
                                </div>
                                <div class="bc-title-finolhu"
                                    style="letter-spacing:2px;color:#231f20;font-size:0.9rem;margin-bottom:0.1rem;font-family:'Gill Sans Nova Medium',Arial,sans-serif;text-transform:uppercase;">
                                    <?= esc($card['designation'] ?? '') ?>
                                </div>
                                <div class="bc-contact-finolhu"
                                    style="color:#57585a;font-size:0.9rem;margin-bottom:2.2rem;font-family:'Gill Sans Nova Medium',Arial,sans-serif;white-space:nowrap;">
                                    Phone <span
                                        style="font-family:'Gill Sans Nova Medium',Arial,sans-serif;"><?= esc($phoneFmt) ?></span>
                                    &bull; <span
                                        style="font-family:'Gill Sans Nova Medium',Arial,sans-serif;"><?= esc($card['email'] ?? '') ?></span>
                                </div>
                                <div class="row mt-2">
                                    <div class="col-6"></div>
                                    <div class="col-6">
                                        <img src="/assets/media/logo/finolhu.png" alt="Logo" class="bc-logo"
                                            style="max-width:150px;">
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex flex-wrap justify-content-center gap-2 mt-2">
                                <?php foreach ($islander['socials'] as $social): ?>
                                <?php if ($social['card_id'] == $card['id']): ?>
                                <a href="<?= esc($social['link']) ?>" target="_blank"
                                    style="background:none;border:none;box-shadow:none;padding:0;">
                                    <?php 
                                            $iconClass = trim($social['icon']);
                                            $faBrands = [
                                                'facebook', 'twitter', 'instagram', 'linkedin', 'github', 'youtube', 'whatsapp', 'telegram', 'snapchat'
                                            ];
                                            $faClass = 'fa';
                                            $faBrandClass = '';
                                            foreach ($faBrands as $brand) {
                                                if (stripos($iconClass, $brand) !== false) {
                                                    $faBrandClass = 'fa-brands';
                                                    break;
                                                }
                                            }
                                            if (preg_match('/fa-(brands|solid|regular)/', $iconClass)) {
                                                $renderClass = $iconClass;
                                            } else {
                                                $renderClass = trim($faClass . ' ' . $faBrandClass . ' ' . $iconClass);
                                            }
                                        ?>
                                    <i class="card-social-icon-finolhu <?= esc($renderClass) ?>"></i>
                                </a>
                                <?php endif; ?>
                                <?php endforeach; ?>
                            </div>
                            <div class="d-flex justify-content-center gap-2 mt-2">
                                <a href="<?= site_url('card/'.$islander['token'].'/vcard.vcf') ?>" class="btn"
                                    style="background-color:#38a8bb;color:#fff;">Save to Phone</a>
                                <button type="button" class="btn copy-link-btn" id="copy-link-btn-<?= $card['id'] ?>"
                                    style="background-color:#38a8bb;color:#fff;"
                                    onclick="copyCardLink('<?= site_url('card/'.$islander['token']) ?>', 'copy-link-btn-<?= $card['id'] ?>')">Copy
                                    Link</button>
                                <button type="button" class="btn" style="background-color:#38a8bb;color:#fff;"
                                    data-bs-toggle="modal" data-bs-target="#qrModal-<?= $card['id'] ?>">QR Code</button>
                            </div>
                        </div>
                        <?php elseif ($card['theme'] === 'here'): ?>
                        <div class="mb-4" style="width:100%;max-width:400px;">
                            <div class="bc-card position-relative"
                                style="max-width:400px;height:250px;margin:auto;background:#fff;border:none;box-shadow:0 2px 12px rgba(0,0,0,0.08);padding:0;display:flex;flex-direction:row;align-items:stretch;">
                                <div style="width:60px;height:250px;overflow:hidden;margin:0;padding:0;">
                                    <img src="/assets/media/logo/Picture.jpg" alt="Left Image"
                                        style="width:60px;height:250px;object-fit:cover;display:block;margin:0;padding:0;">
                                </div>
                                <div style="flex:1;padding-left:0;">
                                    <div class="bc-name-here"
                                        style="color:#c1b4aa;font-weight:bold;font-size:1.8rem;margin-top:20px;margin-left:20px;font-family:'Moeda',Arial,sans-serif;letter-spacing:2px;">
                                        <?= esc($islander['full_name'] ?? '') ?>
                                    </div>
                                    <div class="bc-title-here"
                                        style="letter-spacing:2px;color:#c1b4aa;font-size:0.9rem;margin-bottom:0.1rem;margin-left:20px;font-family:'Open Sans Regular',Arial,sans-serif;text-transform:uppercase;">
                                        <?= esc($card['designation'] ?? '') ?>
                                    </div>
                                    <div class="bc-contact-here"
                                        style="color:#c1b4aa;margin-bottom:2.2rem;margin-left:20px;font-family:'Open Sans Regular',Arial,sans-serif;white-space:nowrap;">
                                        Phone <span
                                            style="font-family:'Open Sans Regular',Arial,sans-serif;"><?= esc($phoneFmt) ?></span>
                                        &bull; <span
                                            style="font-family:'Open Sans Regular',Arial,sans-serif;"><?= esc($card['email'] ?? '') ?></span>
                                    </div>
                                    <div class="row" style="margin-top:5px;margin-right:10px;">
                                        <div class="col-6"></div>
                                        <div class="col-6">
                                            <img src="/assets/media/logo/here_new.png" alt="Logo"
                                                class="bc-logo mt-4 me-4" style="max-width:150px;">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex flex-wrap justify-content-center gap-2 mt-2">
                                <?php foreach ($islander['socials'] as $social): ?>
                                <?php if ($social['card_id'] == $card['id']): ?>
                                <a href="<?= esc($social['link']) ?>" target="_blank"
                                    style="background:none;border:none;box-shadow:none;padding:0;">
                                    <?php 
                                            $iconClass = trim($social['icon']);
                                            $faBrands = [
                                                'facebook', 'twitter', 'instagram', 'linkedin', 'github', 'youtube', 'whatsapp', 'telegram', 'snapchat'
                                            ];
                                            $faClass = 'fa';
                                            $faBrandClass = '';
                                            foreach ($faBrands as $brand) {
                                                if (stripos($iconClass, $brand) !== false) {
                                                    $faBrandClass = 'fa-brands';
                                                    break;
                                                }
                                            }
                                            if (preg_match('/fa-(brands|solid|regular)/', $iconClass)) {
                                                $renderClass = $iconClass;
                                            } else {
                                                $renderClass = trim($faClass . ' ' . $faBrandClass . ' ' . $iconClass);
                                            }
                                        ?>
                                    <i class="card-social-icon-here <?= esc($renderClass) ?>"></i>
                                </a>
                                <?php endif; ?>
                                <?php endforeach; ?>
                            </div>
                            <div class="d-flex justify-content-center gap-2 mt-2">
                                <a href="<?= site_url('card/'.$islander['token'].'/vcard.vcf') ?>" class="btn"
                                    style="background-color:#c1b4aa;color:#fff;">Save to Phone</a>
                                <button type="button" class="btn copy-link-btn" id="copy-link-btn-<?= $card['id'] ?>"
                                    style="background-color:#c1b4aa;color:#fff;"
                                    onclick="copyCardLink('<?= site_url('card/'.$islander['token']) ?>', 'copy-link-btn-<?= $card['id'] ?>')">Copy
                                    Link</button>
                                <button type="button" class="btn" style="background-color:#c1b4aa;color:#fff;"
                                    data-bs-toggle="modal" data-bs-target="#qrModal-<?= $card['id'] ?>">QR Code</button>
                            </div>
                        </div>
                        <?php else: ?>
                        <div class="mb-4" style="width:100%;max-width:400px;">
                            <div class="card shadow-lg">
                                <div class="card-header text-center bg-info text-white">
                                    <h2 class="mb-0"
                                        style="font-family:'Gill Sans Nova Book',Arial,sans-serif;letter-spacing:2px;">
                                        <?= esc($islander['full_name'] ?? '') ?></h2>
                                    <h4 class="mb-0"
                                        style="font-family:'Gill Sans Nova Medium',Arial,sans-serif;text-transform:uppercase;letter-spacing:2px;">
                                        <?= esc($card['designation'] ?? '') ?></h4>
                                </div>
                                <div class="card-body">
                                    <div class="mb-2"><strong>Email:</strong> <?= esc($card['email'] ?? '') ?></div>
                                    <div class="mb-2"><strong>Phone:</strong> <?= esc($phoneFmt) ?></div>
                                    <div class="mb-2"><strong>Theme:</strong> <?= esc($card['theme'] ?? '') ?></div>
                                </div>
                            </div>
                            <?php if (!empty($islander['socials'])): ?>
                            <div class="d-flex flex-wrap justify-content-center gap-2 mt-2">
                                <?php foreach ($islander['socials'] as $social): ?>
                                <?php if ($social['card_id'] == $card['id']): ?>
                                <a href="<?= esc($social['link']) ?>" target="_blank" class="btn btn-light border">
                                    <i class="<?= esc($social['icon']) ?> fa-lg me-1"></i>
                                </a>
                                <?php endif; ?>
                                <?php endforeach; ?>
                            </div>
                            <?php endif; ?>
                            <div class="d-flex justify-content-center gap-2 mt-2">
                                <a href="<?= site_url('card/'.$islander['token'].'/vcard.vcf') ?>" class="btn"
                                    style="background-color:#0d6efd;color:#fff;">Save to Phone</a>
                                <button type="button" class="btn copy-link-btn" id="copy-link-btn-<?= $card['id'] ?>"
                                    style="background-color:#6c757d;color:#fff;"
                                    onclick="copyCardLink('<?= site_url('card/'.$islander['token']) ?>', 'copy-link-btn-<?= $card['id'] ?>')">Copy
                                    Link</button>
                                <button type="button" class="btn" style="background-color:#ffe066;color:#231f20;"
                                    data-bs-toggle="modal" data-bs-target="#qrModal-<?= $card['id'] ?>">QR Code</button>
                            </div>
                        </div>
                        <?php endif; ?>
                        <?php endforeach; ?>
                    </div>
                    <?php else: ?>
                    <div class="col-12 text-center">No cards found for this islander.</div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>

    <!-- QR Code Modals: Rendered at root for proper Bootstrap modal behavior -->
    <?php foreach ($islander['cards'] as $card): ?>
    <?php
        $qrColor = '#231f20'; // default
        if ($card['theme'] === 'finolhu') {
            $qrColor = '#38a8bb';
        } elseif ($card['theme'] === 'here') {
            $qrColor = '#c1b4aa';
        }
        $options = new QROptions([
                'outputType' => 'svg',
                'eccLevel' => QRCode::ECC_L,
                'scale' => 8,
                'imageBase64' => false,
                'bgColor' => '#fff',
                'moduleValues' => [
                    'F' => $qrColor,
                    'B' => '#fff',
                ],
        ]);
        $qrCodeUrl = site_url('card/'.$islander['token'].'/');
            $qrSvg = (new QRCode($options))->render($qrCodeUrl);
            if (strpos($qrSvg, '<?xml') === 0) {
                $qrSvg = preg_replace('/<\?xml.*?\?>/', '', $qrSvg, 1);
    }
    // Replace black fills with theme color
    $qrSvg = str_replace('fill="#000"', 'fill="' . $qrColor . '"', $qrSvg);
    $qrSvg = str_replace('fill="black"', 'fill="' . $qrColor . '"', $qrSvg);
    // No injected style: rely on QR library's moduleValues for color
    ?>
    <div class="modal fade" id="qrModal-<?= $card['id'] ?>" tabindex="-1"
        aria-labelledby="qrModalLabel-<?= $card['id'] ?>" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="qrModalLabel-<?= $card['id'] ?>">QR Code</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body text-center">
                    <div class="qr-modal-svg-container">
                        <?php echo $qrSvg; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php endforeach; ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
    function copyCardLink(link, btnId) {
        navigator.clipboard.writeText(link).then(function() {
            var btn = document.getElementById(btnId);
            if (btn) {
                var orig = btn.innerText;
                btn.innerText = 'Copied!';
                btn.disabled = true;
                setTimeout(function() {
                    btn.innerText = orig;
                    btn.disabled = false;
                }, 1500);
            }
        });
    }
    </script>
</body>

</html>