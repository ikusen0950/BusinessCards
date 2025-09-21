<?php
namespace App\Models;

use CodeIgniter\Model;

class SocialModel extends Model
{
    protected $table = 'socials';
    protected $primaryKey = 'id';
    protected $allowedFields = ['islander_id', 'label', 'link', 'icon', 'card_id', 'created_at', 'updated_at'];
    protected $useTimestamps = true;
}
