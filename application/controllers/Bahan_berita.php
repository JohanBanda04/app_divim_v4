<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Bahan_berita extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->library('pdf_report');
        $this->load->library('session');
        $this->load->helper('security');
        $this->load->helper('file');
    }

    public function index()
    {
        $ceks = $this->session->userdata('username');
        // if (!isset($ceks)) {
        //     redirect('web/login');
        // } else {
        date_default_timezone_set('Asia/Singapore');

        $p = "bahan_berita";
        $hari_ini = date("Y-m-d");
        $data["tgl_now"] = $this->Mcrud->tgl_english($hari_ini, 'full');

        if ($_SESSION['session_filter_date_dari'] == '' || $_SESSION['session_filter_date_dari'] == null) {
            $data['bahan_berita'] = $this->Guzzle_model->getBahanBeritaByTanggal($hari_ini);
        } else if ($_SESSION['session_filter_date_dari'] != '' || $_SESSION['session_filter_date_dari'] != null) {
            $data['bahan_berita'] = $this->Guzzle_model->getBahanBeritaByTanggal($this->Mcrud->tgl_sql($_SESSION['session_filter_date_dari']));
            $data['filter_date_dari'] = $_SESSION['session_filter_date_dari'];
        }

        $this->load->view('header', $data);
        $this->load->view("bahan_berita/$p", $data);
        $this->load->view('footer');
        // }
    }


    public function v($aksi = '', $tanggal = '', $tanggal2 = '')
    {
        $ceks = $this->session->userdata('username');
        $id_user = $this->session->userdata('id_user');
        $level = $this->session->userdata('level');

        date_default_timezone_set('Asia/Singapore');
        $data['time_now'] = date('H:i');
        $today = date('Y-m-d');

        $max_size = 1024 * 10;
        $lokasi = 'file/bahan_berita';
        $this->upload->initialize(array(
            "upload_path" => "./$lokasi",
            "allowed_types" => "*",
            "max_size" => $max_size
        ));

        if ($aksi == 't') {
            if (!isset($ceks)) {
                $id_user = 00;
            }

            $berita_what = $this->input->post('berita_what');
            $berita_where = $this->input->post('berita_where');
            $berita_when = $this->input->post('berita_when');
            $berita_who = $this->input->post('berita_who');
            $berita_why = $this->input->post('berita_why');
            $berita_how = $this->input->post('berita_how');

//            echo $berita_what; die;

            $_SESSION['session_filter_date_dari'] = $this->input->post('berita_when');

            $tanggal_convert = date('Y-m-d', strtotime($berita_when));

            $pesan = '';

            if (!is_dir($lokasi)) {
                //jika tidak maka folder harus dibuat terlebih dahulu
                mkdir($lokasi, 0777, $rekursif = true);
            }

            if ($_FILES['url_files']['name'][0] == null) {
                $count = 0;
            } else {
                $count = count($_FILES['url_files']['name']);
            }

            if ($count != 0) {
                for ($i = 0; $i < $count; $i++) {

                    if (!empty($_FILES['url_files']['name'][$i])) {

                        $_FILES['file']['name'] = $_FILES['url_files']['name'][$i];
                        $_FILES['file']['type'] = $_FILES['url_files']['type'][$i];
                        $_FILES['file']['tmp_name'] = $_FILES['url_files']['tmp_name'][$i];
                        $_FILES['file']['error'] = $_FILES['url_files']['error'][$i];
                        $_FILES['file']['size'] = $_FILES['url_files']['size'][$i];

                        if (!$this->upload->do_upload('file')) {
                            $simpan = 'n';
                            $pesan = htmlentities(strip_tags($this->upload->display_errors('<p>', '</p>')));
                        } else {
                            $gbr = $this->upload->data();
                            $filename = "$lokasi/" . $gbr['file_name'];
                            $url_file[$i] = preg_replace('/ /', '_', $filename);
                            $simpan = 'y';
                        }
                    }
                }
            } else {
                $simpan = 'y';
            }

            if ($simpan == 'y') {
                $data = array(
                    'id_user' => $id_user,
                    'berita_what' => $berita_what,
                    'berita_where' => $berita_where,
                    'berita_when' => $tanggal_convert,
                    'berita_who' => $berita_who,
                    'berita_why' => $berita_why,
                    'berita_how' => $berita_how,
                    'url_data_dukung' => json_encode($url_file),
                    'status' => 'x'
                );

                // echo '<pre>';
                // print_r($data);
                // exit;
                $this->Guzzle_model->createBahanBerita($data);

                $this->session->set_flashdata(
                    'msg',
                    '
					<div class="alert alert-success alert-dismissible" role="alert">
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
						<strong>Sukses!</strong> Berhasil disimpan.
					</div>
				<br>'
                );
            } else {
                $this->session->set_flashdata(
                    'msg',
                    '
					<div class="alert alert-warning alert-dismissible" role="alert">
						 <button type="button" class="close" data-dismiss="alert" aria-label="Close">
							 <span aria-hidden="true">&times;</span>
						 </button>
						 <strong>Gagal!</strong> ' . $pesan . '.
					</div>
				 <br>'
                );
            }
            redirect("bahan_berita/v/f/" . $berita_when);
        } else if ($aksi == 'f') {
            $data['filter_date_dari'] = $tanggal;
            $_SESSION['session_filter_date_dari'] = $tanggal;
            $data['tgl_awal_sql'] = $this->Mcrud->tgl_sql($data['filter_date_dari']);

            $data['bahan_berita'] = $this->Guzzle_model->getBahanBeritaByTanggal($data['tgl_awal_sql']);

            $p = "bahan_berita";
            $this->load->view('header', $data);
            $this->load->view("bahan_berita/$p", $data);
            $this->load->view('footer');
        } else if ($aksi == 'e') {
            $id_bahan_berita = $this->input->post('id_bahan_berita');
            $berita_what = $this->input->post('berita_what');
            $berita_where = $this->input->post('berita_where');
            $berita_when = $this->input->post('berita_when');
            $berita_who = $this->input->post('berita_who');
            $berita_why = $this->input->post('berita_why');
            $berita_how = $this->input->post('berita_how');


            $_SESSION['session_filter_date_dari'] = $this->input->post('when');

            $data_lama = $this->Guzzle_model->getBahanBeritaById($id_bahan_berita);

            $tanggal_convert = date('Y-m-d', strtotime($berita_when));

            $pesan = '';

            if (!is_dir($lokasi)) {
                # jika tidak maka folder harus dibuat terlebih dahulu
                mkdir($lokasi, 0777, $rekursif = true);
            }

            if ($_FILES['url_files_edit']['name'][0] == null) {
                $count = 0;
            } else {
                $count = count($_FILES['url_files_edit']['name']);
            }

            if ($count != 0) {
                for ($i = 0; $i < $count; $i++) {

                    if (!empty($_FILES['url_files_edit']['name'][$i])) {

                        $_FILES['file']['name'] = $_FILES['url_files_edit']['name'][$i];
                        $_FILES['file']['type'] = $_FILES['url_files_edit']['type'][$i];
                        $_FILES['file']['tmp_name'] = $_FILES['url_files_edit']['tmp_name'][$i];
                        $_FILES['file']['error'] = $_FILES['url_files_edit']['error'][$i];
                        $_FILES['file']['size'] = $_FILES['url_files_edit']['size'][$i];

                        if (!$this->upload->do_upload('file')) {
                            $simpan = 'n';
                            $pesan = htmlentities(strip_tags($this->upload->display_errors('<p>', '</p>')));
                        } else {
                            $gbr = $this->upload->data();
                            $filename = "$lokasi/" . $gbr['file_name'];
                            $url_file[$i] = preg_replace('/ /', '_', $filename);
                            $simpan = 'y';
                        }
                    }
                }
                $file_lama = json_decode($data_lama['url_data_dukung'] == 'null' ? "[]" : $data_lama['url_data_dukung']);
                $url_data_dukung =  json_encode(array_merge($file_lama, $url_file));
            } else {
                $url_data_dukung = $data_lama['url_data_dukung'];
                $simpan = 'y';
            }


            if ($simpan == 'y') {
                $data = array(
                    'berita_what' => $berita_what,
                    'berita_where' => $berita_where,
                    'berita_when' => $tanggal_convert,
                    'berita_who' => $berita_who,
                    'berita_why' => $berita_why,
                    'berita_how' => $berita_how,
                    'url_data_dukung' => $url_data_dukung
                );

                $this->Guzzle_model->updateBahanBerita($id_bahan_berita, $data);

                $this->session->set_flashdata(
                    'msg',
                    '
					<div class="alert alert-success alert-dismissible" role="alert">
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
						<strong>Sukses!</strong> Berhasil disimpan.
					</div>
				<br>'
                );
            } else {
                $this->session->set_flashdata(
                    'msg',
                    '
					<div class="alert alert-warning alert-dismissible" role="alert">
						 <button type="button" class="close" data-dismiss="alert" aria-label="Close">
							 <span aria-hidden="true">&times;</span>
						 </button>
						 <strong>Gagal!</strong> ' . $pesan . '.
					</div>
				 <br>'
                );
            }
            redirect("bahan_berita/v/f/" . $berita_when);
        } else if ($aksi == 'h') {
            if (!isset($ceks)) {
                redirect('web/login');
            }

            $id_bahan_berita = $this->input->post('id_bahan_berita');
            $cek_data = $this->Guzzle_model->getBahanBeritaById($id_bahan_berita);
            // print_r($cek_data);
            // exit;

            if ($cek_data == null) {
                redirect('404');
            } else {
                foreach ($this->Mcrud->url_data_dukung($cek_data['url_data_dukung']) as $row) {
                    if ($row != '') {
                        unlink($row);
                    }
                }
                $this->Guzzle_model->deleteBahanBerita($id_bahan_berita);
            }

            $this->session->set_flashdata(
                'msg',
                '
				<div class="alert alert-success alert-dismissible" role="alert">
					 <button type="button" class="close" data-dismiss="alert" aria-label="Close">
						 <span aria-hidden="true">&times;</span>
					 </button>
					 <strong>Sukses!</strong> Berhasil dihapus.
				</div>
				<br>'
            );
            redirect("bahan_berita/v/f/" . $this->Mcrud->tgl_english($cek_data['berita_when'], 'full'));
        } else if ($aksi == 'df') {
            $id_bahan_berita = $this->input->post('id');
            $cek_data = $this->Guzzle_model->getBahanBeritaById($id_bahan_berita);

            if (!isset($ceks)) {
                redirect('web/login');
            }

            try {
                $path = $this->input->post('path');
                // echo $path; exit;

                if (unlink($path)) {
                    $file = json_decode($cek_data['url_data_dukung'], true);
                    unset($file[$this->input->post('file_id')]);

                    $data = array(
                        'berita_what' => $cek_data['berita_what'],
                        'url_data_dukung' => json_encode(count($file) > 0 ? $file : null)
                    );

                    $this->Guzzle_model->updateBahanBerita($id_bahan_berita, $data);
                }
                echo "success : " . json_encode($file);
            } catch (Exception $e) {
                echo json_encode($e);
            }
        }
    }
}
