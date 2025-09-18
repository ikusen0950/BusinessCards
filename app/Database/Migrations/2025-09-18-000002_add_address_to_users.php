<?php
namespace App\Database\Migrations;
use CodeIgniter\Database\Migration;
class AddAddressToUsers extends Migration
{
    public function up()
    {
        $this->forge->addColumn('users', [
            'address' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => true,
                'after' => 'company',
            ],
        ]);
    }
    public function down()
    {
        $this->forge->dropColumn('users', 'address');
    }
}
