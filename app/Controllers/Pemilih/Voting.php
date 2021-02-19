<?php

/**
 * E-Voting Codeigniter 4
 * Robbi Abdul Rohman
 * https://github.com/robbiabd
 */

namespace App\Controllers\Pemilih;

use App\Controllers\BaseController;
use App\Models\PemilihModel;
use App\Models\KandidatModel;
use App\Models\TokenModel;
use App\Models\UserModel;

class Voting extends BaseController
{
	public function index()
	{
		helper(['form', 'url']);
		$pemilihModel = new PemilihModel();
		$tokenModel = new TokenModel();
		$userModel = new UserModel();
		$data['title'] = 'Input Token';

		if ($this->request->getMethod() == 'post') {
			$rules = [
				'token' => 'required'
			];

			if ($this->validate($rules)) {

				$getToken = $tokenModel->check_token_count($tokenModel->escapeString($this->request->getPost('token')));

				// cek token 
				if ($getToken) {
					// cek expired token
					$dateNow = date('Y-m-d H:i:s');
					if ($getToken['expired_at'] > $dateNow) {
						// cek user token
						if ($getToken['total_pengguna_saat_ini'] < $getToken['jumlah_pengguna_token']) {
							$params = [
								'token_key'		=> htmlspecialchars($this->request->getPost('token')),
								'id_kandidatbem' => 0,
								'id_kandidatblm' => 0,
								'id_user'		=> session()->id_user
							];

							$adarecord = $pemilihModel->where('id_user', session()->id_user)->first();
							// Jika tidak ada record (tidak pernah memilih)
							if ($adarecord) {
								session()->setFlashdata('success', 'Berhasil masuk silahkan edit pilihan');
							} else {
								$insert = $pemilihModel->insert($params);
								session()->setFlashdata('success', 'Berhasil masuk silahkan pilih');
							}

							$userSession = [
								// 'id_pemilih'	=> $last_id,
								'id_pemilih'	=> session()->id_user,
								'token_key'		=> htmlspecialchars($this->request->getPost('token'))
							];

							session()->set($userSession);

							return redirect()->route('voting/kandidatbem');
						} else {
							session()->setFlashdata('danger', 'Token sudah digunakan');
							return redirect()->route('voting')->withInput();
						}
					} else {
						session()->setFlashdata('danger', 'Token sudah expired');
						return redirect()->route('voting')->withInput();
					}
				} else {
					session()->setFlashdata('danger', 'Token tidak tersedia');
					return redirect()->route('voting')->withInput();
				}
			} else {
				$data['validation'] = $this->validator;
			}
		}
		return view('user/index', $data);
	}

	public function kandidatbemList()
	{
		helper(['form', 'url']);
		$kandidatModel = new KandidatModel();

		// $data['get_kandidat'] = $kandidatModel->findAll();
		$data['get_kandidat'] = $kandidatModel->where('ormawa', 'bem')->findAll();

		$data['title'] = 'List Kandidat BEM';
		return view('user/kandidat_list', $data);
	}
	public function kandidatblmList()
	{
		helper(['form', 'url']);
		$kandidatModel = new KandidatModel();

		$data['get_kandidat'] = $kandidatModel
			->where('ormawa', 'blm')
			->where('id_jurusan', session()->id_jurusan)
			->findAll();

		$data['title'] = 'List Kandidat BLM';
		return view('user/kandidat_list', $data);
	}

	public function pilihKandidat()
	{
		if ($this->request->getMethod() == 'post') {
			$pemilihModel = new PemilihModel();
			$kandidatModel = new KandidatModel();
			$id = htmlspecialchars($this->request->getPost('id'));
			$ormawa = htmlspecialchars($this->request->getPost('ormawa'));

			$getKandidat = $kandidatModel->find($id);
			if ($ormawa == 'bem') { //Cek tipe ormawa bem
				if ($getKandidat) { //Cek apakah kandidat ada

					$update = $pemilihModel->set('id_kandidatbem', htmlspecialchars($id))->where('id_user', session()->id_pemilih)->update();

					if ($update) {
						return redirect()->route('voting/kandidatblm');
					} else {
						session()->setFlashdata('danger', 'Gagal memilih kandidat');
						return redirect()->route('voting/kandidatbem');
					}
				} else {
					session()->setFlashdata('danger', 'Kandidat tidak ada');
					return redirect()->route('voting/kandidatbem');
				}
			} elseif ($ormawa == 'blm') { //Cek tipe ormawa bem
				if ($getKandidat) { //Cek apakah kandidat ada

					$update = $pemilihModel->set('id_kandidatblm', htmlspecialchars($id))->where('id_user', session()->id_pemilih)->update();
					// $update = $pemilihModel->update(session()->get('id_pemilih'), $params);

					if ($update) {
						session()->destroy();
						$data['title'] = 'Pemilihan Selesai';
						return view('user/kandidat_terpilih', $data);
					} else {
						session()->setFlashdata('danger', 'Gagal memilih kandidat');
						return redirect()->route('voting/kandidatblm');
					}
				} else {
					session()->setFlashdata('danger', 'Kandidat tidak ada');
					return redirect()->route('voting/kandidatbem');
				}
			}
		}

		return redirect()->route('voting/kandidat');
	}
}
