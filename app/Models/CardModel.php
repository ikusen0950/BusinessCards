<?php
namespace App\Models;

use CodeIgniter\Model;

class CardModel extends Model
{
    protected $table = 'cards';
    protected $primaryKey = 'id';
    protected $allowedFields = ['islander_id', 'designation', 'email', 'phone', 'theme', 'created_at', 'updated_at'];
    protected $useTimestamps = true;
}
