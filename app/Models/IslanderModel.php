<?php
namespace App\Models;

use CodeIgniter\Model;

class IslanderModel extends Model
{
    protected $table = 'islanders';
    protected $primaryKey = 'id';
    protected $allowedFields = ['full_name', 'token', 'created_at', 'updated_at'];
    protected $useTimestamps = true;
}
