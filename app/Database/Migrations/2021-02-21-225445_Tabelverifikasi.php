<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Tabelverifikasi extends Migration
{
	public function up()
	{
		// We aren't actually going to use foreign keys (see below) but it is a good idea to toggle them in your seeder.
		$this->db->disableForeignKeyChecks();

		/**
		 * users
		 *
		 * Tabel untuk users
		 */
		$fields = [
			'id_verifikasi'     => ['type' => 'int', 'constraint' => 11, 'auto_increment' => true],
			'email'       => ['type' => 'varchar', 'constraint' => 100, 'unique' => true],
			'token'    => ['type' => 'varchar', 'constraint' => 225],
			'created_at'  => ['type' => 'datetime'],
			'updated_at'  => ['type' => 'datetime'],
		];


		$this->forge->addField($fields);

		// $this->forge->addKey('field',TRUE(optional primary),TRUE(optional unique));
		$this->forge->addKey('id_verifikasi', TRUE);

		$this->forge->createTable('verifikasi');

		$this->db->enableForeignKeyChecks();
	}

	public function down()
	{
		$this->db->disableForeignKeyChecks();

		$this->forge->dropTable('verifikasi');

		$this->db->enableForeignKeyChecks();
	}
}
