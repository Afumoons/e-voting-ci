<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Tabeljurusan extends Migration
{
	public function up()
	{
		// We aren't actually going to use foreign keys (see below) but it is a good idea to toggle them in your seeder.


		/**
		 * jurusan
		 *
		 * Tabel untuk jurusan
		 */
		$fields = [
			'id_jurusan'      => ['type' => 'int', 'constraint' => 11, 'auto_increment' => true],
			'jurusan'         => ['type' => 'varchar', 'constraint' => 225],
		];


		$this->forge->addField($fields);

		// $this->forge->addKey('field',TRUE(optional primary),TRUE(optional unique));
		$this->forge->addKey('id_jurusan', TRUE);

		$this->forge->createTable('jurusan');
	}

	public function down()
	{

		$this->forge->dropTable('jurusan');
	}
}
