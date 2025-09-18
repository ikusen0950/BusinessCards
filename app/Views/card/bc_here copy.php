<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Business Card - .Here</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
    @font-face {
        font-family: 'Moeda';
        src: url('/assets/media/fonts/Moeda.otf') format('opentype');
        font-weight: normal;
        font-style: normal;
    }
    @font-face {
        font-family: 'Open Sans Regular';
        src: url('/assets/media/fonts/Open_Sans_Regular.ttf') format('truetype');
        font-weight: normal;
        font-style: normal;
    }
    body {
        background: #f7f7f7;
    }
    .here-card {
    width: 100%;
    max-width: 400px;
    height: 250px;
    margin: 40px auto 0 auto;
    background: #f5f5f2;
    /* border: 15px solid #fff; */
    box-shadow: 0 2px 12px rgba(0,0,0,0.08);
    position: relative;
    display: flex;
    flex-direction: row;
    overflow: hidden;
    }
    .here-left {
        width: 70px;
        background: url('/assets/media/here_leaf.png') no-repeat center center;
        background-size: cover;
    }
    .here-content {
        flex: 1;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: flex-start;
        padding: 0 24px;
        position: relative;
    }
    .here-name {
    font-family: 'Moeda', Arial, sans-serif;
    font-size: 1.2rem;
    color: #231f20;
    margin-bottom: 0.2rem;
    }
    .here-title {
    font-family: 'Open Sans Regular', Arial, sans-serif;
    font-size: 0.95rem;
    color: #231f20;
    margin-bottom: 2.2rem;
    }
    .here-logo {
        position: absolute;
        right: 24px;
        bottom: 18px;
        font-family: 'Gill Sans Nova Medium', Arial, sans-serif;
        font-size: 2.2rem;
        color: #a89c87;
        letter-spacing: 1px;
    }
    .here-logo .dot {
        color: #b94c4c;
        font-size: 2.2rem;
        font-weight: bold;
        margin-right: 2px;
    }
    @media (max-width: 576px) {
        .here-card {
            height: auto;
            margin: 24px auto 0 auto;
        }
        .here-content {
            padding: 0 10px;
        }
        .here-logo {
            right: 10px;
            bottom: 10px;
            font-size: 1.5rem;
        }
    }
    </style>
</head>
<body>
    <div class="here-card">
        <div class="here-left"></div>
        <div class="here-content">
            <div class="here-name"><?= esc($user->full_name ?? $user->username) ?></div>
            <div class="here-title"><?= strtoupper(esc($user->job_title ?? '')) ?></div>
            <div class="here-logo"><span class="dot">.</span>Here</div>
        </div>
    </div>
</body>
</html>
