<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run()
    {
        $userModel = model('Myth\Auth\Models\UserModel');
        $password = 'admin123'; // Keep your chosen password
        $passwordHash = \Myth\Auth\Password::hash($password);
        $userData = [
            'username'      => 'admin',
            'email'         => 'admin@example.com',
            'password_hash' => $passwordHash,
            'active'        => 1,
            'status'        => null,
            'created_at'    => date('Y-m-d H:i:s'),
            'updated_at'    => date('Y-m-d H:i:s'),
        ];
        $userModel->insert($userData);
    }
}
