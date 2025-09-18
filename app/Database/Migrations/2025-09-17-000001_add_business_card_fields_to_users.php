<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;
use CodeIgniter\I18n\Time;

class AddBusinessCardFieldsToUsers extends Migration
{
    public function up()
    {
        // Add new columns to users table
        // Add all required business card fields except location, avatar_path, logo_path
        $fields = [
            'full_name'             => ['type' => 'VARCHAR', 'constraint' => 350, 'null' => true],
            'job_title'             => ['type' => 'VARCHAR', 'constraint' => 350, 'null' => true],
            'company'               => ['type' => 'VARCHAR', 'constraint' => 350, 'null' => true],
            'phone'                 => ['type' => 'VARCHAR', 'constraint' => 350, 'null' => true],
            'website'               => ['type' => 'VARCHAR', 'constraint' => 350, 'null' => true],
            'card_theme'            => ['type' => 'VARCHAR', 'constraint' => 350, 'null' => true],
            'vcard_note'            => ['type' => 'TEXT', 'null' => true],
            'card_token'            => ['type' => 'VARCHAR', 'constraint' => 64, 'unique' => true, 'null' => true],
            'card_token_expires_at' => ['type' => 'DATETIME', 'null' => true],
            'card_views'            => ['type' => 'INT', 'unsigned' => true, 'default' => 0],
            'card_last_opened_at'   => ['type' => 'DATETIME', 'null' => true],
        ];
        $this->forge->addColumn('users', $fields);
    }

    public function down()
    {
        $columns = [
            'full_name', 'job_title', 'company', 'phone', 'website', 'card_theme', 'vcard_note',
            'card_token', 'card_token_expires_at', 'card_views', 'card_last_opened_at'
        ];
        foreach ($columns as $col) {
            $fields = array_map(function($f){return $f->name;}, $this->db->getFieldData('users'));
            if (in_array($col, $fields)) {
                $this->forge->dropColumn('users', $col);
            }
        }
    }
}
