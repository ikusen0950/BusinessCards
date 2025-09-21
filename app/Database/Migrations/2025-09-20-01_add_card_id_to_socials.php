<?php
namespace App\Database\Migrations;
use CodeIgniter\Database\Migration;
class AddCardIdToSocials extends Migration
{
    public function up()
    {
        $this->forge->addColumn('socials', [
            'card_id' => [
                'type' => 'INT',
                'constraint' => 11,
                'null' => true,
                'after' => 'icon',
            ],
        ]);
    }
    public function down()
    {
        $this->forge->dropColumn('socials', 'card_id');
    }
}
