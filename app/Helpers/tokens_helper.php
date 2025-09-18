<?php

if (!function_exists('generateToken')) {
    function generateToken(int $len = 40): string
    {
        $bytes = random_bytes($len);
        return rtrim(strtr(base64_encode($bytes), '+/', '-_'), '=');
    }
}
