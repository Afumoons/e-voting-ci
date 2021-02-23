<?php

/**
 * E-Voting Codeigniter 4
 * Robbi Abdul Rohman
 * https://github.com/robbiabd
 */

namespace App\Controllers\Auth;

use App\Controllers\BaseController;
use App\Models\UserModel;
use App\Models\VerifikasiModel;
use CodeIgniter\I18n\Time;

class Auth extends BaseController
{
	public function index()
	{
		helper(['form', 'url']);

		$data['title'] = 'Login';

		if ($this->request->getMethod() == 'post') {
			$userModel = new UserModel();
			// rules validation
			$rules = [
				'npm'		=> 'required',
				'password' 	=> 'required|min_length[3]'
			];

			// form validation
			if ($this->validate($rules)) {
				$npm 		= htmlspecialchars($this->request->getPost('npm'));
				$email = $npm . '@student.upnjatim.ac.id';
				$password 	= htmlspecialchars($this->request->getPost('password'));

				// ambil data user dari DB
				$user = $userModel->where('email', $userModel->escapeString($email))
					->first();

				if ($user) {
					if ($user['is_active'] == 1) { //cek apakah user aktif
						# code...

						if (password_verify($password, $user['password'])) {

							$userSession = [
								'id_user'		=> $user['id_user'],
								'nama'			=> $user['nama'],
								'email'			=> $user['email'],
								'id_level'		=> $user['id_level'],
								'id_jurusan'	=> $user['id_jurusan']
							];

							session()->set($userSession);

							// cek level
							if ($user['id_level'] == 1) {
								session()->setFlashdata('success', 'Berhasil login');

								return redirect()->route('admin');
							} elseif ($user['id_level'] == 2) {
								session()->setFlashdata('success', 'Berhasil login');

								return redirect()->route('admin');
							} elseif ($user['id_level'] == 3) {
								session()->setFlashdata('success', 'Berhasil login');

								return redirect()->route('admin');
							} elseif ($user['id_level'] == 4) {
								session()->setFlashdata('success', 'Berhasil login');

								return redirect()->route('admin');
							} else {
								return redirect()->route('logout');
							}
						} else {
							// password salah
							session()->setFlashdata('danger', 'Email atau Password salah');

							return redirect('login')->withInput();
						}
					} else {
						// password salah
						session()->setFlashdata('danger', 'User belum diaktifasi, silakan aktivasi terlebih dahulu');
						return redirect('login')->withInput();
					}
				} else {
					// user tidak terdaftar
					session()->setFlashdata('danger', 'Maaf email dan password yang kamu masukan tidak terdaftar');

					return redirect('login')->withInput();
				}
			} else {
				// inputan salah
				$data['validation'] = $this->validator;
			}
		}

		return view('auth/index', $data);
	}

	public function registration()
	{
		helper(['form']);
		$data['title'] = 'User registration';

		if ($this->request->getMethod() == 'post') {
			$userModel = new UserModel();
			$verifikasiModel = new VerifikasiModel();
			$npm = htmlspecialchars($this->request->getPost('npm'));
			$email = $npm . '@student.upnjatim.ac.id';
			if (substr($npm, 2, 3) == '081') { // cek kode jurusan
				$jurusan = 1;
			} elseif (substr($npm, 2, 3) == '082') {
				$jurusan = 2;
			} elseif (substr($npm, 2, 3) == '083') {
				$jurusan = 3;
			} else {
				session()->setFlashdata('danger', 'NPM tidak valid');
				return redirect()->route('register')->withInput();
			}
			$rules = [
				'nama' 		=> 'required|alpha_space|min_length[2]',
				'npm' 		=> 'required|numeric',
				'password'	=> 'required|min_length[3]|matches[password2]',
				'password2'	=> 'required',
			];

			if ($this->validate($rules)) {
				$params = [
					'nama' 		=> htmlspecialchars($this->request->getPost('nama')),
					'email'		=> $email,
					'password'	=> htmlspecialchars(password_hash($this->request->getPost('password'), PASSWORD_DEFAULT)),
					'id_level'	=> 4,
					'is_active'	=> 0,
					'id_jurusan'	=> $jurusan,
				];

				//Siapkan token
				$token = $this->_token_generate();
				$user_token = [
					'email' => $email,
					'token' => $token
				];

				$user = $userModel->where('email', $userModel->escapeString($email))->first();
				if (!$user) { // cek tidak ada user
					$sendemail = $this->_sendEmail($token, $email, 'verify');
					if ($sendemail) { //email terkirim
						$insert = $userModel->insert($params);
						$verifikasiModel->insert($user_token);
						if ($insert) { //terinsert
							session()->setFlashdata('success', 'Berhasil register, silakan aktivasi dalam kurun waktu 10 menit melalui link yang terkirim di email UPN anda.');
							return redirect()->route('login');
						} else {
							session()->setFlashdata('danger', 'Gagal registrasi user');
							return redirect()->route('register')->withInput();
						}
					} else {
						session()->setFlashdata('danger', 'NPM tidak valid');
						return redirect()->route('register')->withInput();
					}
				} else { // ada user
					$usertoken = $verifikasiModel->where('email', $email)->first();
					if ($usertoken) { // ada token
						$time = Time::parse($usertoken['created_at']);
						if (time() - $time->timestamp < (60 * 10)) { // batas waktu 10 menit masih ada
							session()->setFlashdata('danger', 'NPM sudah terdaftar, sialakan akrivasi di email anda');
							return redirect()->route('login');
						} else { //token sudah expired
							$verifikasiModel->where('email', $email)->delete(); // token lama dihapus
							$userModel->where('email', $email)->delete(); // user lama dihapus
							$this->_sendEmail($token, $email, 'verify'); //mengirim email
							$insert = $userModel->insert($params);
							$verifikasiModel->insert($user_token); //membuat token baru
							session()->setFlashdata('success', 'User diregistrasikan kembali');
							return redirect()->route('register');
						}
					}
					session()->setFlashdata('danger', 'NPM sudah terdaftar dan sudah aktif');
					return redirect()->route('register')->withInput();
				}
			} else {
				$data['validation'] = $this->validator;
			}
		}

		return view('auth/registration', $data);
	}
	private function _sendEmail($token = null, $user_email, $fungsi = null)
	{
		$email = \Config\Services::email();
		$email->setFrom('autoemail@pemirafik.iscommu.com', 'PemiraFIK autoemail');
		$email->setTo($user_email);
		if ($fungsi = 'verify') {
			$email->setSubject('Verifikasi akun');
			$email->setMessage('<p>Klik link ini untuk verifikasi akun : <a href="' . base_url('/verify?email=') . $user_email . '&token=' . $token . '">Aktifasikan akun saya</a></p><p>Abaikan ini jika anda tidak melakukan registrasi di web pemira</p>');
		}
		if ($email->send()) {
			return true;
		} else {
			// dd($email->printDebugger());
			return false;
		}
	}

	private function _token_generate()
	{
		$karakter = '!*ABCDEFGHIJKLMNOPQRSTUVWXYZ123456789abcdefghijklmnopqrstupwxyz';
		$string = '';
		for ($i = 0; $i < 32; $i++) {
			$pos = rand(0, strlen($karakter) - 1);
			$string .= $karakter[$pos];
		}
		return $string;
	}

	public function verification()
	{
		$userModel = new UserModel();
		$verifikasiModel = new VerifikasiModel();
		$email		= htmlspecialchars($this->request->getGet('email'));
		$token		= htmlspecialchars($this->request->getGet('token'));
		$user = $userModel->where('email', $email)->first();
		if ($user) { // email ada
			$usertoken = $verifikasiModel->where('token', $token)->first();
			if ($usertoken) { // user token ada
				$time = Time::parse($usertoken['created_at']);
				if (time() - $time->timestamp < (60 * 10)) { // batas waktu 10 menit
					$userModel->set('is_active', 1)->where('email', $email)->update();
					$verifikasiModel->where('email', $email)->delete();
					session()->setFlashdata('success', 'User berhasil diaktivasi');
					return redirect()->route('login');
				} else {
					$verifikasiModel->where('email', $email)->delete();
					$userModel->where('email', $email)->delete();
					session()->setFlashdata('danger', 'Token expired');
					return redirect()->route('register');
				}
			} else {
				session()->setFlashdata('danger', 'Token salah');
				return redirect()->route('register');
			}
		} else {
			session()->setFlashdata('danger', 'Email tidak ditemukan');
			return redirect()->route('register');
		}
	}
	public function logout()
	{
		session()->destroy();

		return redirect()->route('login');
	}
}
