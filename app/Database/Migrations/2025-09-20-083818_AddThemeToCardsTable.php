<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddThemeToCardsTable extends Migration
{
    public function up()
    {
        $this->forge->addColumn('cards', [
            'theme' => [
                'type' => 'VARCHAR',
                'constraint' => 32,
                'null' => true,
                'after' => 'phone',
            ],
        ]);
    }

    public function down()
    {
    $this->forge->dropColumn('cards', 'theme');
    }
}
