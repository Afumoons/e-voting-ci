<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use CodeIgniter\I18n\Time;

class InitialSeeder extends Seeder
{
	public function run()
	{
		// Level
		$data = [
			[
				'level'        => 'Administrator',
			],
			[
				'level'        => 'Petugas',
			],
			[
				'level'        => 'Pendata',
			],
			[
				'level'        => 'Pemilih',
			]
		];

		$this->db->table('level')->insertBatch($data);

		// Jurusan
		$data = [
			[
				'jurusan'        => 'Teknik Informatika',
			],
			[
				'jurusan'        => 'Sistem Informasi',
			],
		];

		$this->db->table('jurusan')->insertBatch($data);


		// Users
		$data = [
			[
				'nama'        => 'admintf',
				'email'       => 'admintf@gmail.com',
				'password'    => '$2y$10$s0g8BqjOkKkfNSllkvhv/uESgK.8c0vrw.OMn2yHSp0RnNfrhYL8S',
				'id_level'    => 1,
				'id_jurusan'    => 1,
				'created_at'  => Time::now(),
				'updated_at'  => Time::now(),
			],
			[
				'nama'        => 'petugastf',
				'email'       => 'petugastf@gmail.com',
				'password'    => '$2y$10$SH8sfiS0OWZ/tJpSBT4oy.y/keOS2p3I5hf86PkTgBjZ01oDujS66',
				'id_level'    => 2,
				'id_jurusan'    => 1,
				'created_at'  => Time::now(),
				'updated_at'  => Time::now(),
			],
			[
				'nama'        => 'pendatatf',
				'email'       => 'pendatatf@gmail.com',
				'password'    => '$2y$10$cLYoMMtbkPfTnCBDyOau1OHeocdEoSMYQfn2v0HKlklVEdVJJBVli',
				'id_level'    => 3,
				'id_jurusan'    => 1,
				'created_at'  => Time::now(),
				'updated_at'  => Time::now(),
			],
			[
				'nama'        => 'pemilihtf',
				'email'       => 'pemilihtf@gmail.com',
				'password'    => '$2y$10$ZY/GuV5IoPEdS1.8nZWQS.A0gmFIETJtUN70gh7Zn23/OrZGbaD/G',
				'id_level'    => 4,
				'id_jurusan'    => 1,
				'created_at'  => Time::now(),
				'updated_at'  => Time::now(),
			], [
				'nama'        => 'adminsi',
				'email'       => 'adminsi@gmail.com',
				'password'    => '$2y$10$s0g8BqjOkKkfNSllkvhv/uESgK.8c0vrw.OMn2yHSp0RnNfrhYL8S',
				'id_level'    => 1,
				'id_jurusan'    => 2,
				'created_at'  => Time::now(),
				'updated_at'  => Time::now(),
			],
			[
				'nama'        => 'petugassi',
				'email'       => 'petugassi@gmail.com',
				'password'    => '$2y$10$SH8sfiS0OWZ/tJpSBT4oy.y/keOS2p3I5hf86PkTgBjZ01oDujS66',
				'id_level'    => 2,
				'id_jurusan'    => 2,
				'created_at'  => Time::now(),
				'updated_at'  => Time::now(),
			],
			[
				'nama'        => 'pendatasi',
				'email'       => 'pendatasi@gmail.com',
				'password'    => '$2y$10$cLYoMMtbkPfTnCBDyOau1OHeocdEoSMYQfn2v0HKlklVEdVJJBVli',
				'id_level'    => 3,
				'id_jurusan'    => 2,
				'created_at'  => Time::now(),
				'updated_at'  => Time::now(),
			],
			[
				'nama'        => 'pemilihsi',
				'email'       => 'pemilihsi@gmail.com',
				'password'    => '$2y$10$ZY/GuV5IoPEdS1.8nZWQS.A0gmFIETJtUN70gh7Zn23/OrZGbaD/G',
				'id_level'    => 4,
				'id_jurusan'    => 2,
				'created_at'  => Time::now(),
				'updated_at'  => Time::now(),
			],
		];

		$this->db->table('users')->insertBatch($data);
	}
}
