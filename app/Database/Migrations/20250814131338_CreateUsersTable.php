<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateUsersTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'         => ['type' => 'INT','constraint' => 11,'unsigned' => true,'auto_increment' => true],
			'name'       => ['type' => 'VARCHAR','constraint' => 100],
			// Basic information fields
			'student_id'    => ['type' => 'VARCHAR','constraint' => 50,'null' => true,'unique' => true],
			'first_name'    => ['type' => 'VARCHAR','constraint' => 100,'null' => false],
			'middle_name'   => ['type' => 'VARCHAR','constraint' => 100,'null' => true],
			'last_name'     => ['type' => 'VARCHAR','constraint' => 100,'null' => false],
			'date_of_birth' => ['type' => 'DATE','null' => true],
			'gender'        => ['type' => 'VARCHAR','constraint' => 10,'null' => true],
			'contact_number'=> ['type' => 'VARCHAR','constraint' => 30,'null' => true],
            'email'      => ['type' => 'VARCHAR','constraint' => 100,'unique' => true],
            'password'   => ['type' => 'VARCHAR','constraint' => 255],
            'role'       => ['type' => 'ENUM("student","instructor","admin")','default' => 'student'],
            'created_at' => ['type' => 'DATETIME','null' => true],
            'updated_at' => ['type' => 'DATETIME','null' => true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('users');
    }

    public function down()
    {
        $this->forge->dropTable('users');
    }
}