<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Datapengguna extends CI_Controller {

	public function index()
	{
		redirect('datapengguna/v');
	}

	public function v($aksi='', $id='')
	{
		$id = hashids_decrypt($id);
		$ceks 	 = $this->session->userdata('token_katamaran');
		$id_user = $this->session->userdata('id_user');
		$level 	 = $this->session->userdata('level');

		$this->session->set_flashdata('msg','');

		date_default_timezone_set('Asia/Jakarta');
		
		if(!isset($ceks)) {
			redirect('web/login');
		}else{
			
			if ($level != 'superadmin') {
				redirect('404_content');
			}

			$user_list = $this->Guzzle_model->getAllUser();
			foreach ($user_list as $key => $value) {
				if ($value['role'] == 'superadmin') continue;
				$data['user_list'][$key] = $value;
			}

			if ($aksi == 't') {
				$nama = $this->input->post('nama');
				$username = $this->input->post('username');
				$password = $this->input->post('password');
				$password2 = $this->input->post('password2');
				$role = $this->input->post('role');

				$cek_username = array_search($username, array_column($user_list, 'username', 'id'));
				
				$pesan = '';
				$simpan = 'y';

				if ($cek_username != null) {
					$simpan = 'n';
					$pesan  = "Username '<b>$username</b>' sudah ada";
				} else {
					if ($password!=$password2) {
						$simpan = 'n';
						$pesan  = "Password tidak cocok!";
					}
				}

				if ($simpan == 'y') {
				$data = array(
					'nama'		=> $nama,
					'username'	=> $username,
					'password'	=> $password,
					'role'		=> $role,
					'whatsapp'		=> 'x',
					'url_paraf'		=> 'x',
					'url_ttd'		=> 'x',

				);

				$this->Guzzle_model->createUser($data);
					
					$this->session->set_flashdata('msg',
						'
						<div class="alert alert-success alert-dismissible" role="alert">
							<button type="button" class="close" data-dismiss="alert" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
							<strong>Sukses!</strong> Berhasil disimpan.
						</div>
					<br>'
					);
				}else {
					$this->session->set_flashdata('msg',
						'
						<div class="alert alert-warning alert-dismissible" role="alert">
							<button type="button" class="close" data-dismiss="alert" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
							<strong>Gagal!</strong> '.$pesan.'.
						</div>
					<br>'
					);
				}
				redirect('datapengguna/v');
			}elseif ($aksi == 'e') {
				$id_user = $this->input->post('id_user');
				$cek_user = $this->Guzzle_model->getUserById($id_user);
				if ($cek_user == '') {redirect('404');} else {

					$nama = $this->input->post('nama');
					$username = $this->input->post('username');
					$password = $this->input->post('password');
					$password2 = $this->input->post('password2');
					$role = $this->input->post('role');
					
					$data_lama = $cek_user;
				
					if ($username != $data_lama['username']) {
						$cek_username = array_search($username, array_column($user_list, 'username', 'id'));
					}

					$pesan  = '';
					$simpan = 'y';
					
					if ($cek_username != null) {
						$simpan = 'n';
						$pesan  = "Username '<b>$username</b>' sudah ada";
					} else {
						if ($password!=$password2) {
							$simpan = 'n';
							$pesan  = "Password tidak cocok!";
						}
					}
					
					if ($simpan == 'y') {
					$data = array(
						'nama'		=> $nama,
						'username'	=> $username,
						'password'	=> $password,
						'role'	=> $role
					);

					$this->Guzzle_model->updateUser($id_user, $data);
						
						$this->session->set_flashdata('msg',
							'
							<div class="alert alert-success alert-dismissible" role="alert">
								<button type="button" class="close" data-dismiss="alert" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
								<strong>Sukses!</strong> Berhasil disimpan.
							</div>
						<br>'
						);
					}else {
						$this->session->set_flashdata('msg',
							'
							<div class="alert alert-warning alert-dismissible" role="alert">
								<button type="button" class="close" data-dismiss="alert" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
								<strong>Gagal!</strong> '.$pesan.'.
							</div>
						<br>'
						);
					}
					redirect('datapengguna/v');
				}
			}
			elseif ($aksi == 'h') {
				$id_user = $this->input->post('id_user');
				$cek_data = $this->Guzzle_model->getUserById($id_user);

				if ($cek_data == null) {redirect('404');} else {
					$this->Guzzle_model->deleteUser($id_user);
				}
				

				$this->session->set_flashdata('msg',
					'
					<div class="alert alert-success alert-dismissible" role="alert">
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
						<strong>Sukses!</strong> Berhasil dihapus.
					</div>
					<br>'
				);
				redirect('datapengguna/v');
			} else {
				$p = "index";
				$data['judul_web'] 	  = "Pengguna";
			}

			$this->load->view('header', $data);
			$this->load->view("datapengguna/$p", $data);
			$this->load->view('footer');
		}
	}

}
				

