<?php
namespace App\Libraries;

use App\Entities\User;

class VCardBuilder
{
    public static function fromUser(User $u): string
    {
        $lines = [];
        $lines[] = 'BEGIN:VCARD';
        $lines[] = 'VERSION:3.0';
        $lines[] = 'N:' . esc($u->username);
        $lines[] = 'FN:' . esc($u->username);
        if ($u->job_title) $lines[] = 'TITLE:' . esc($u->job_title);
        if ($u->company) $lines[] = 'ORG:' . esc($u->company);
        if ($u->phone) $lines[] = 'TEL;TYPE=CELL:' . esc($u->getPhoneDigits());
        if ($u->email) $lines[] = 'EMAIL:' . esc($u->email);
        if ($u->website) $lines[] = 'URL:' . esc($u->website);
        if ($u->location) $lines[] = 'ADR;TYPE=WORK:' . esc($u->location);
        if ($u->vcard_note) $lines[] = 'NOTE:' . esc($u->vcard_note);
        $lines[] = 'END:VCARD';
        return implode("\r\n", $lines);
    }
}
