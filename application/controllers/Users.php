<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends CI_Controller {

	public function index()
	{
		$ceks = $this->session->userdata('token_katamaran');
		$id_user = $this->session->userdata('id_user');
		if(!isset($ceks)) {
			redirect('web/login');
		}else{
			redirect('agenda/v/harian');
		}
	}

	public function profile()
	{
		$ceks = $this->session->userdata('token_katamaran');
		$id_user = $this->session->userdata('id_user');
		$level = $this->session->userdata('level');
		if(!isset($ceks)) {
			redirect('web/login');
		}else{
			$data['user']  			= $this->Guzzle_model->getUserById($id_user);

			$data['level_users']  	= $level;
			$data['judul_web'] 		= "Profile";

			$this->load->view('header', $data);
			$this->load->view('profile', $data);
			$this->load->view('footer');
		}

		$user_list = $this->Guzzle_model->getAllUser();

		if (isset($_POST['btnupdate'])) {

            //echo $data['user']['username']; die;

			$nama	= htmlentities(strip_tags($this->input->post('nama')));
			$whatsapp	= htmlentities(strip_tags($this->input->post('whatsapp')));
			$role	= htmlentities(strip_tags($this->input->post('role')));
            $username	 		= htmlentities(strip_tags($this->input->post('username')));

            $password  = htmlentities(strip_tags($this->input->post('password')));
			$password2 = htmlentities(strip_tags($this->input->post('password2')));
			$ceks_username = $this->session->userdata('username');

//			echo $nama.'<br>';
//			echo $whatsapp.'<br>';
//			echo $role.'<br>';
//            echo $username.'<br>';
//
//            echo $password.'<br>';
//			echo $password2.'<br>'; die;

            /*masih salah logic*/
            $pesan  = '';
            $update = 'yes';

            if($data['user']['username']!=null){
                if($username==$data['user']['username']){
                   // echo "username sudah ada di db"; die;
                    $update = 'no';
                    $pesan  = "Gagal disimpan '<b>$username</b>' username, sudah ada";
                } else if ($username!=$data['user']['username']){
                    //echo "username belum ada di db"; die;
                    //$update = 'yes';
                    //$pesan  = "Berhasil Menyimpan Data '<b>$username</b>' ";
                    if($password==$password2){
                        $update = 'yes';
                        $pesan  = "Berhasil Menyimpan Data '<b>$username</b>' ";
                    } else if ($password!=$password2){
                        $update = 'no';
                        $pesan  = "Gagal disimpan '<b>$username</b>' password 1 dan password 2 belum cocok";;
                    }
                }

            } else {
                //echo "tidak ada data username di db"; die;
                $update = 'yes';
            }

            //echo $update; die;

//			if ($username != $ceks) {
//				$cek_username = array_search($username, array_column($user_list, 'username', 'id'));
//			}

//			$pesan  = '';
//			$update = 'yes';
			
			if ($cek_username != null) {
				$update = 'no';
				$pesan  = "Username '<b>$username</b>' sudah ada";
			} else {
				$pass_lama = $data['user']['password'];
				if ($password=='') {
					$password = $pass_lama;
				} else {
					if ($password!=$password2) {
						$update = 'no';
						$pesan  = "Password tidak cocok!";
					}
				}
			}
				

			if ($update == 'yes') {
				$data = array(
					'nama'			=> $nama,
					'whatsapp'		=> $whatsapp,
					'username' 		=> $username,
					'password' 		=> $password,
					'role' 			=> $level
				);
				$this->Guzzle_model->updateUser($id_user, $data);
					
				$this->session->has_userdata('username');
				$this->session->set_userdata('username', "$username");
				$this->session->has_userdata('nama');
				$this->session->set_userdata('nama', "$nama");

				$this->session->set_flashdata('msg',
					'
					<div class="alert alert-success alert-dismissible" role="alert">
						 <button type="button" class="close" data-dismiss="alert" aria-label="Close">
							 <span aria-hidden="true">&times;</span>
						 </button>
						 <strong>Sukses!</strong> Profile berhasil disimpan.
					</div>
				  <br>'
				);
				redirect('profile');
				
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
				redirect('profile');
			}
		}
			
	}

}
