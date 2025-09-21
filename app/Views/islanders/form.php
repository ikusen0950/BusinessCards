<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?= isset($islander) ? 'Edit Islander' : 'Add Islander' ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
    /* Match Select2 single select height to Bootstrap input */
    .select2-container--default .select2-selection--single {
        min-height: 38px;
        height: 38px !important;
        padding: 0.375rem 0.75rem;
        border: 1px solid #ced4da;
        border-radius: 0.375rem;
        box-sizing: border-box;
        display: flex;
        align-items: center;
        font-size: 1rem;
        background-color: #fff;
    }
    .select2-selection__rendered {
        line-height: 1.5 !important;
        padding-left: 0 !important;
    }
    .select2-selection__arrow {
        height: 38px !important;
        top: 0.375rem !important;
    }
    .select2-container .select2-selection--single .select2-selection__rendered {
        padding-right: 24px;
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
    /* font-weight: bold; */
    font-size: 1.5rem;
    margin-top: -15px;
    /* margin-bottom: 0.1rem; */
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
    font-size: 0.9rem;
    margin-bottom: 2.2rem;
    font-family: 'Open Sans Regular', Arial, sans-serif;
    white-space: nowrap;
    }


    </style>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://kit.fontawesome.com/734445d7bc.js" crossorigin="anonymous"></script>
</head>
<body class="bg-light">
<div class="container py-4">
    <h1><?= isset($islander) ? 'Edit Islander' : 'Add Islander' ?></h1>
    <form method="post" action="<?= isset($islander) ? site_url('islanders/update/'.$islander['id']) : site_url('islanders/store') ?>">
        <div class="mb-3">
            <label class="form-label">Full Name</label>
            <input type="text" name="full_name" class="form-control" value="<?= esc($islander['full_name'] ?? '') ?>" required>
        </div>
        <?php if (isset($islander)): ?>
        <div class="mb-3">
            <label class="form-label">Token</label>
            <input type="text" class="form-control" value="<?= esc($islander['token']) ?>" readonly>
        </div>
        <?php endif; ?>
        <hr>
        <h4>Cards</h4>
        <div id="cards">
            <?php if (!empty($cards)): foreach ($cards as $i => $card): ?>
            <div class="row mb-2 card-row align-items-center">
                <input type="hidden" name="card_id[]" value="<?= esc($card['id']) ?>">
                <div class="col-md-3"><input type="text" name="designation[]" class="form-control" placeholder="Designation" value="<?= esc($card['designation']) ?>"></div>
                <div class="col-md-3"><input type="email" name="email[]" class="form-control" placeholder="Email" value="<?= esc($card['email']) ?>"></div>
                <div class="col-md-2"><input type="text" name="phone[]" class="form-control" placeholder="Phone" value="<?= esc($card['phone']) ?>"></div>
                <div class="col-md-3">
                    <select name="theme[]" class="form-select">
                        <option value="">Select Theme</option>
                        <option value="finolhu" <?= isset($card['theme']) && $card['theme'] == 'finolhu' ? 'selected' : '' ?>>Finolhu</option>
                        <option value="here" <?= isset($card['theme']) && $card['theme'] == 'here' ? 'selected' : '' ?>>.Here</option>
                    </select>
                </div>
                <div class="col-md-1 d-flex align-items-center"><button type="button" class="btn btn-danger btn-sm" onclick="removeRow(this)">Remove</button></div>
            </div>
            <?php endforeach; endif; ?>
        </div>
    <button type="button" class="btn btn-sm btn-success mb-2" onclick="addCardRow()">Add Card</button>
    <hr>
    <h4>Card Previews</h4>
    <div id="cardPreviews" class="row mb-4"></div>
    <!-- Hidden bc_finolhu template for JS preview -->
    <div id="bcFinolhuTemplate" style="display:none;">
        <div class="bc-card position-relative" style="max-width:450px;height:250px;margin:auto;background:#ecede8;border:15px solid #fff;box-shadow:0 2px 12px rgba(0,0,0,0.08);padding:32px 32px 16px 32px;">
            <div class="bc-name-finolhu" style="color:#38a8bb;font-weight:bold;font-size:1.5rem;margin-top:-15px;margin-bottom:0.1rem;font-family:'Gill Sans Nova Book',Arial,sans-serif;">{name}</div>
            <div class="bc-title-finolhu" style="letter-spacing:2px;color:#231f20;font-size:0.9rem;margin-bottom:0.1rem;font-family:'Gill Sans Nova Medium',Arial,sans-serif;">{designation}</div>
            <div class="bc-contact-finolhu" style="color:#57585a;font-size:0.9rem;margin-bottom:2.2rem;font-family:'Gill Sans Nova Medium',Arial,sans-serif;">Phone <span style="font-family:'Gill Sans Nova Medium',Arial,sans-serif;">{phoneFmt}</span> &bull; <span style="font-family:'Gill Sans Nova Medium',Arial,sans-serif;">{email}</span></div>
            <div class="row mt-2">
                <div class="col-6"></div>
                <div class="col-6">
                    <img src="/assets/media/logo/finolhu.png" alt="Logo" class="bc-logo" style="max-width:150px;">
                </div>
            </div>
        </div>
    </div>
    <!-- Hidden bc_here template for JS preview -->
    <div id="bcHereTemplate" style="display:none;">
        <div class="bc-card position-relative" style="max-width:450px;height:250px;margin:auto;background:#fff;border:none;box-shadow:0 2px 12px rgba(0,0,0,0.08);padding:0;display:flex;flex-direction:row;align-items:stretch;">
            <div style="width:60px;height:250px;overflow:hidden;margin:0;padding:0;">
                <img src="/assets/media/logo/Picture.jpg" alt="Left Image" style="width:60px;height:250px;object-fit:cover;display:block;margin:0;padding:0;">
            </div>
            <div style="flex:1;padding-left:0;">
                <div class="bc-name-here" style="color:#c1b4aa;font-weight:bold;font-size:1.8rem;margin-top:20px;margin-left:20px;font-family:'Moeda',Arial,sans-serif;">{name}</div>
                <div class="bc-title-here" style="letter-spacing:2px;color:#c1b4aa;font-size:0.9rem;margin-bottom:0.1rem;margin-left:20px;font-family:'Open Sans Regular',Arial,sans-serif;">{designation}</div>
                <div class="bc-contact-here" style="color:#c1b4aa;font-size:0.9rem;margin-bottom:2.2rem;margin-left:20px;font-family:'Open Sans Regular',Arial,sans-serif;">Phone <span style="font-family:'Open Sans Regular',Arial,sans-serif;">{phoneFmt}</span> &bull; <span style="font-family:'Open Sans Regular',Arial,sans-serif;">{email}</span></div>
                <div class="row" style="margin-top:5px;margin-right:10px;">
                    <div class="col-6"></div>
                    <div class="col-6">
                        <img src="/assets/media/logo/here_new.png" alt="Logo" class="bc-logo mt-4 me-4" style="max-width:150px;">
                    </div>
                </div>
            </div>
        </div>
    </div>
        <hr>
        <h4>Social Icons</h4>
        <div id="socials">
            <?php if (!empty($socials)): foreach ($socials as $i => $social): ?>
            <div class="row mb-2 social-row">
                <input type="hidden" name="social_id[]" value="<?= esc($social['id']) ?>">
                <div class="col-md-5"><input type="text" name="social_link[]" class="form-control" placeholder="Link" value="<?= esc($social['link']) ?>"></div>
                <div class="col-md-3">
                    <select name="social_icon[]" class="form-select icon-select">
                        <option value="">Select Icon</option>
                        <option value="fa fa-facebook-square" <?= (isset($social['icon']) && $social['icon'] == 'fa fa-facebook-square') ? 'selected' : '' ?>>Facebook</option>
                        <option value="fa fa-twitter-square" <?= (isset($social['icon']) && $social['icon'] == 'fa fa-twitter-square') ? 'selected' : '' ?>>Twitter</option>
                        <option value="fa fa-instagram" <?= (isset($social['icon']) && $social['icon'] == 'fa fa-instagram') ? 'selected' : '' ?>>Instagram</option>
                        <option value="fa fa-linkedin-square" <?= (isset($social['icon']) && $social['icon'] == 'fa fa-linkedin-square') ? 'selected' : '' ?>>LinkedIn</option>
                        <option value="fa fa-github-square" <?= (isset($social['icon']) && $social['icon'] == 'fa fa-github-square') ? 'selected' : '' ?>>GitHub</option>
                        <option value="fa fa-youtube-play" <?= (isset($social['icon']) && $social['icon'] == 'fa fa-youtube-play') ? 'selected' : '' ?>>YouTube</option>
                        <option value="fa fa-whatsapp" <?= (isset($social['icon']) && $social['icon'] == 'fa fa-whatsapp') ? 'selected' : '' ?>>WhatsApp</option>
                        <option value="fa fa-telegram" <?= (isset($social['icon']) && $social['icon'] == 'fa fa-telegram') ? 'selected' : '' ?>>Telegram</option>
                        <option value="fa fa-snapchat-square" <?= (isset($social['icon']) && $social['icon'] == 'fa fa-snapchat-square') ? 'selected' : '' ?>>SnapChat</option>
                        <option value="fa fa-globe" <?= (isset($social['icon']) && $social['icon'] == 'fa fa-globe') ? 'selected' : '' ?>>Website</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <select name="social_card[]" class="form-select">
                        <option value="">Select Card</option>
                        <?php if (!empty($cards)): foreach ($cards as $c): ?>
                            <?php 
                                $cardLabel = esc($c['designation'] ?? '') . ' ' . esc($c['theme'] ?? ''); 
                                $selected = '';
                                if (isset($social['card_id']) && isset($c['id']) && $social['card_id'] == $c['id']) {
                                    $selected = 'selected';
                                }
                            ?>
                            <option value="<?= esc($c['id']) ?>" <?= $selected ?>><?= $cardLabel ?></option>
                        <?php endforeach; endif; ?>
                    </select>
                </div>
                <div class="col-md-1 d-flex align-items-center"><button type="button" class="btn btn-danger btn-sm" onclick="removeRow(this)">Remove</button></div>
            </div>
            <?php endforeach; endif; ?>
            <!-- Empty row for new socials -->
            <div class="row mb-2 social-row">
                <div class="col-md-5"><input type="text" name="social_link[]" class="form-control" placeholder="Link"></div>
                <div class="col-md-3">
                    <select name="social_icon[]" class="form-select icon-select">
                        <option value="">Select Icon</option>
                        <option value="fa fa-facebook-square">Facebook</option>
                        <option value="fa fa-twitter-square">Twitter</option>
                        <option value="fa fa-instagram">Instagram</option>
                        <option value="fa fa-linkedin-square">LinkedIn</option>
                        <option value="fa fa-github-square">GitHub</option>
                        <option value="fa fa-youtube-play">YouTube</option>
                        <option value="fa fa-whatsapp">WhatsApp</option>
                        <option value="fa fa-telegram">Telegram</option>
                        <option value="fa fa-snapchat-square">SnapChat</option>
                        <option value="fa fa-globe">Website</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <select name="social_card[]" class="form-select">
                        <option value="">Select Card</option>
                        <?php if (!empty($cards)): foreach ($cards as $c): ?>
                            <?php $cardLabel = esc($c['designation'] ?? '') . ' ' . esc($c['theme'] ?? ''); ?>
                            <option value="<?= esc($c['id']) ?>"><?= $cardLabel ?></option>
                        <?php endforeach; endif; ?>
                    </select>
                </div>
                <div class="col-md-1 d-flex align-items-center"><button type="button" class="btn btn-danger btn-sm" onclick="removeRow(this)">Remove</button></div>
            </div>
        </div>
        <button type="button" class="btn btn-sm btn-success mb-2" onclick="addSocialRow()">Add Social</button>
        <br><button type="submit" class="btn btn-primary">Save</button>
        <a href="<?= site_url('islanders') ?>" class="btn btn-secondary">Cancel</a>
    </form>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
$(document).ready(function() {
    $('.icon-select').select2({
        width: '100%',
        templateResult: function(icon) {
            if (!icon.id) return icon.text;
            return $('<span><i class="fa ' + icon.id + '"></i> ' + icon.text + '</span>');
        },
        templateSelection: function(icon) {
            if (!icon.id) return icon.text;
            return $('<span><i class="fa ' + icon.id + '"></i> ' + icon.text + '</span>');
        }
    });

    // Live card previews for all card rows
    function updateCardPreviews() {
        var name = $('input[name="full_name"]').val() || '';
        var cardRows = $('#cards .card-row');
        var previewsHtml = '';
        cardRows.each(function(idx, row) {
            var designation = $(row).find('input[name="designation[]"]').val() || '';
            var email = $(row).find('input[name="email[]"]').val() || '';
            var phone = $(row).find('input[name="phone[]"]').val() || '';
            var theme = $(row).find('select[name="theme[]"]').val() || '';
            var phoneFmt = phone;
            var phoneMatch = phone.match(/^(\+\d{3})(\d{3})(\d{4})$/);
            if (phoneMatch) {
                phoneFmt = phoneMatch[1] + ' ' + phoneMatch[2] + ' ' + phoneMatch[3];
            }
            var previewHtml = '';
            if (theme === 'finolhu') {
                previewHtml = $('#bcFinolhuTemplate').html()
                    .replace('{name}', $('<div>').text(name).html())
                    .replace('{designation}', $('<div>').text(designation).html())
                    .replace('{phoneFmt}', $('<div>').text(phoneFmt).html())
                    .replace('{email}', $('<div>').text(email).html());
            } else if (theme === 'here') {
                previewHtml = $('#bcHereTemplate').html()
                    .replace('{name}', $('<div>').text(name).html())
                    .replace('{designation}', $('<div>').text(designation).html())
                    .replace('{phoneFmt}', $('<div>').text(phoneFmt).html())
                    .replace('{email}', $('<div>').text(email).html());
            } else {
                previewHtml = '<div class="card shadow" style="max-width:450px;margin:auto;">';
                previewHtml += '<div class="card-header text-center bg-primary text-white">';
                previewHtml += '<h2 class="mb-0">' + $('<div>').text(name).html() + '</h2>';
                previewHtml += '<h4 class="mb-0">' + $('<div>').text(designation).html() + '</h4>';
                previewHtml += '</div>';
                previewHtml += '<div class="card-body">';
                previewHtml += '<div class="mb-2"><strong>Email:</strong> ' + $('<div>').text(email).html() + '</div>';
                previewHtml += '<div class="mb-2"><strong>Phone:</strong> ' + $('<div>').text(phoneFmt).html() + '</div>';
                previewHtml += '<div class="mb-2"><strong>Theme:</strong> ' + $('<div>').text(theme).html() + '</div>';
                previewHtml += '</div></div>';
            }
            previewsHtml += '<div class="col-md-4 mb-3">' + previewHtml + '</div>';
        });
        $('#cardPreviews').html(previewsHtml);
    }
    $(document).on('input change', 'input[name="designation[]"], input[name="email[]"], input[name="phone[]"], select[name="theme[]"]', updateCardPreviews);
    updateCardPreviews();
});
function addCardRow() {
    var cards = document.getElementById('cards');
    var row = document.createElement('div');
    row.className = 'row mb-2 card-row align-items-center';
    row.innerHTML = '<div class="col-md-3"><input type="text" name="designation[]" class="form-control" placeholder="Designation"></div>' +
        '<div class="col-md-3"><input type="email" name="email[]" class="form-control" placeholder="Email"></div>' +
        '<div class="col-md-2"><input type="text" name="phone[]" class="form-control" placeholder="Phone"></div>' +
        '<div class="col-md-3"><select name="theme[]" class="form-select"><option value="">Select Theme</option><option value="finolhu">Finolhu</option><option value="here">.Here</option><option value="finolhu_here">Finolhu & .Here</option></select></div>' +
        '<div class="col-md-1 d-flex align-items-center"><button type="button" class="btn btn-danger btn-sm" onclick="removeRow(this)">Remove</button></div>';
    cards.appendChild(row);
}
function addSocialRow() {
    var socials = document.getElementById('socials');
    var row = document.createElement('div');
    row.className = 'row mb-2 social-row';
    row.innerHTML =
        '<div class="col-md-5"><input type="text" name="social_link[]" class="form-control" placeholder="Link"></div>' +
        '<div class="col-md-3">' +
            '<select name="social_icon[]" class="form-select icon-select">' +
                '<option value="">Select Icon</option>' +
                '<option value="fa fa-facebook-square">Facebook</option>' +
                '<option value="fa fa-twitter-square">Twitter</option>' +
                '<option value="fa fa-instagram">Instagram</option>' +
                '<option value="fa fa-linkedin-square">LinkedIn</option>' +
                '<option value="fa fa-github-square">GitHub</option>' +
                '<option value="fa fa-youtube-play">YouTube</option>' +
                '<option value="fa fa-whatsapp">WhatsApp</option>' +
                '<option value="fa fa-telegram">Telegram</option>' +
                '<option value="fa fa-snapchat-square">SnapChat</option>' +
                '<option value="fa fa-globe">Website</option>' +
            '</select>' +
        '</div>' +
        '<div class="col-md-3">' +
            '<select name="social_card[]" class="form-select">' +
                '<option value="">Select Card</option>' +
                <?php if (!empty($cards)): foreach ($cards as $c): ?>
                '<option value="<?= esc($c['id']) ?>"><?= esc($c['designation'] ?? '') . ' ' . esc($c['theme'] ?? '') ?></option>' +
                <?php endforeach; endif; ?>
            '</select>' +
        '</div>' +
        '<div class="col-md-1 d-flex align-items-center"><button type="button" class="btn btn-danger btn-sm" onclick="removeRow(this)">Remove</button></div>';
    socials.appendChild(row);
    // Re-initialize select2 for new icon dropdown
    $(row).find('.icon-select').select2({
        width: '100%',
        templateResult: function(icon) {
            if (!icon.id) return icon.text;
            return $('<span><i class="fa ' + icon.id + '"></i> ' + icon.text + '</span>');
        },
        templateSelection: function(icon) {
            if (!icon.id) return icon.text;
            return $('<span><i class="fa ' + icon.id + '"></i> ' + icon.text + '</span>');
        }
    });
}
function removeRow(btn) {
    btn.closest('.row').remove();
}
</script>
</div>
</body>
</html>
