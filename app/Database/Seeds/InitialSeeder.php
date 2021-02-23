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
			[
				'jurusan'        => 'Sains Data',
			],
		];

		$this->db->table('jurusan')->insertBatch($data);


		// Users
		$data = [
			[
				'nama'        => 'admintf',
				'email'       => '132592871@student.upnjatim.ac.id',
				'password'    => '$2y$10$s0g8BqjOkKkfNSllkvhv/uESgK.8c0vrw.OMn2yHSp0RnNfrhYL8S',
				'id_level'    => 1,
				'id_jurusan'    => 1,
				'is_active'  => 1,
				'created_at'  => Time::now(),
				'updated_at'  => Time::now(),
			],
			[
				'nama'        => 'petugastf',
				'email'       => '132592872@student.upnjatim.ac.id',
				'password'    => '$2y$10$SH8sfiS0OWZ/tJpSBT4oy.y/keOS2p3I5hf86PkTgBjZ01oDujS66',
				'id_level'    => 2,
				'id_jurusan'    => 1,
				'is_active'  => 1,
				'created_at'  => Time::now(),
				'updated_at'  => Time::now(),
			],
			[
				'nama'        => 'pendatatf',
				'email'       => '132592873@student.upnjatim.ac.id',
				'password'    => '$2y$10$cLYoMMtbkPfTnCBDyOau1OHeocdEoSMYQfn2v0HKlklVEdVJJBVli',
				'id_level'    => 3,
				'id_jurusan'    => 1,
				'is_active'  => 1,
				'created_at'  => Time::now(),
				'updated_at'  => Time::now(),
			],
			[
				'nama'        => 'pemilihtf',
				'email'       => '132592874@student.upnjatim.ac.id',
				'password'    => '$2y$10$ZY/GuV5IoPEdS1.8nZWQS.A0gmFIETJtUN70gh7Zn23/OrZGbaD/G',
				'id_level'    => 4,
				'id_jurusan'    => 1,
				'is_active'  => 1,
				'created_at'  => Time::now(),
				'updated_at'  => Time::now(),
			], [
				'nama'        => 'adminsi',
				'email'       => '132592875@student.upnjatim.ac.id',
				'password'    => '$2y$10$s0g8BqjOkKkfNSllkvhv/uESgK.8c0vrw.OMn2yHSp0RnNfrhYL8S',
				'id_level'    => 1,
				'id_jurusan'    => 2,
				'is_active'  => 1,
				'created_at'  => Time::now(),
				'updated_at'  => Time::now(),
			],
			[
				'nama'        => 'petugassi',
				'email'       => '132592876@student.upnjatim.ac.id',
				'password'    => '$2y$10$SH8sfiS0OWZ/tJpSBT4oy.y/keOS2p3I5hf86PkTgBjZ01oDujS66',
				'id_level'    => 2,
				'id_jurusan'    => 2,
				'is_active'  => 1,
				'created_at'  => Time::now(),
				'updated_at'  => Time::now(),
			],
			[
				'nama'        => 'pendatasi',
				'email'       => '132592877@student.upnjatim.ac.id',
				'password'    => '$2y$10$cLYoMMtbkPfTnCBDyOau1OHeocdEoSMYQfn2v0HKlklVEdVJJBVli',
				'id_level'    => 3,
				'id_jurusan'    => 2,
				'is_active'  => 1,
				'created_at'  => Time::now(),
				'updated_at'  => Time::now(),
			],
			[
				'nama'        => 'pemilihsi',
				'email'       => '132592878@student.upnjatim.ac.id',
				'password'    => '$2y$10$ZY/GuV5IoPEdS1.8nZWQS.A0gmFIETJtUN70gh7Zn23/OrZGbaD/G',
				'id_level'    => 4,
				'id_jurusan'    => 2,
				'is_active'  => 1,
				'created_at'  => Time::now(),
				'updated_at'  => Time::now(),
			],
		];

		$this->db->table('users')->insertBatch($data);
	}
}
