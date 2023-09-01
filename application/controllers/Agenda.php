<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Agenda extends CI_Controller
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
        $ceks = $this->session->userdata('token_katamaran');

        if (!isset($ceks)) {
            redirect('web/login');
        } else {
            redirect('dashboard');
        }
    }

    public function v($aksi = '', $tanggal = '', $tanggal2 = '')
    {
        $ceks = $this->session->userdata('token_katamaran');
        $id_user = $this->session->userdata('id_user');
        $level = $this->session->userdata('level');

        $this->session->set_flashdata('msg', '');

        date_default_timezone_set('Asia/Singapore');
        $data['time_now'] = date('H:i');
        $today = date('Y-m-d');

        $lokasi = 'file/daduk';
        $max_size = 1024 * 5;
        $this->upload->initialize(array(
            "upload_path" => "./$lokasi",
            "allowed_types" => "pdf|doc|docx|ppt|pptx",
            "max_size" => $max_size
        ));

        if ($aksi == 't') {
            if (!isset($ceks)) {
                $id_user = 00;
                $status = 'belum';
            }

            if ($level == 'superadmin' or $level == 'protokol' or $level == 'sekpim') {
                $status = 'sudah';
                //$id_user = 00;
                $id_user = $this->session->userdata('id_user');
            } else {
                $status = 'sudah';
                $id_user = $this->session->userdata('id_user');
            }

            $nama = $this->input->post('nama');
            $tanggal = $this->input->post('tanggal');
            $jam_mulai = $this->input->post('jam_mulai');
            $jam_selesai = $this->input->post('jam_selesai');
            $tempat = $this->input->post('tempat');
            $peserta = $this->input->post('peserta');
            $pakaian = $this->input->post('pakaian');
            $deskripsi = $this->input->post('deskripsi');
            $pejabat = $this->input->post('pejabat');
            $penanggungjawab = $this->input->post('penanggungjawab');


            $tanggal_convert = date('Y-m-d', strtotime($tanggal));

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
                    'nama' => $nama,
                    'tanggal' => $tanggal_convert,
                    'jam_mulai' => $jam_mulai,
                    'jam_selesai' => $jam_selesai,
                    'tempat' => $tempat,
                    'pejabat' => $pejabat,
                    'peserta' => $peserta,
                    'pakaian' => $pakaian,
                    'penanggungjawab' => $penanggungjawab,
                    'deskripsi' => $deskripsi,
                    'url_data_dukung' => json_encode($url_file),
                    'status' => $status
                );

                $this->Guzzle_model->createAgenda($data);

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
            redirect("agenda/v/harian/" . $tanggal_convert);
        } elseif ($aksi == 'e') {
            if (!isset($ceks)) {
                redirect('web/login');
            }

            $id_agenda = $this->input->post('id_agenda');
            $nama = $this->input->post('nama');
            $tanggal = $this->input->post('tanggal');
            $jam_mulai = $this->input->post('jam_mulai');
            $jam_selesai = $this->input->post('jam_selesai');
            $tempat = $this->input->post('tempat');
            $peserta = $this->input->post('peserta');
            $pakaian = $this->input->post('pakaian');
            $deskripsi = $this->input->post('deskripsi');
            $pejabat = $this->input->post('pejabat');
            $penanggungjawab = $this->input->post('penanggungjawab');

            $data_lama = $this->Guzzle_model->getAgendaById($id_agenda);

            $tanggal_convert = date('Y-m-d', strtotime($tanggal));

            $pesan = '';

            if (!is_dir($lokasi)) {
                //jika tidak maka folder harus dibuat terlebih dahulu
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
                $url_data_dukung = json_encode(array_merge($file_lama, $url_file));
            } else {
                $url_data_dukung = $data_lama['url_data_dukung'];
                $simpan = 'y';
            }

            if ($simpan == 'y') {
                $data = array(
                    'nama' => $nama,
                    'tanggal' => $tanggal_convert,
                    'jam_mulai' => $jam_mulai,
                    'jam_selesai' => $jam_selesai,
                    'tempat' => $tempat,
                    'peserta' => $peserta,
                    'pakaian' => $pakaian,
                    'deskripsi' => $deskripsi,
                    'url_data_dukung' => $url_data_dukung,
                    'pejabat' => $pejabat,
                    'penanggungjawab' => $penanggungjawab
                );

                $this->Guzzle_model->updateAgenda($id_agenda, $data);

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
            redirect("agenda/v/harian/" . $tanggal_convert);
        } elseif ($aksi == 'h') {
            if (!isset($ceks)) {
                redirect('web/login');
            }

            $id_agenda = $this->input->post('id_agenda');
            $cek_data = $this->Guzzle_model->getAgendaById($id_agenda);

            if ($cek_data == null) {
                redirect('404');
            } else {
                foreach ($this->Mcrud->url_data_dukung($cek_data['url_data_dukung']) as $row) {
                    if ($row != '') {
                        unlink($row);
                    }
                }
                $this->Guzzle_model->deleteAgenda($id_agenda);
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
            redirect("agenda/v/harian/" . $cek_data['tanggal']);
        } elseif ($aksi == 'p') {
            if (!isset($ceks)) {
                redirect('web/login');
            }

            $id_agenda = $this->input->post('id_agenda');
            $status = $this->input->post('status');

            $data_lama = $this->Guzzle_model->getAgendaById($id_agenda);

            $pesan = '';
            $simpan = 'y';

            if ($simpan == 'y') {
                $data = array(
                    'nama' => $data_lama['nama'],
                    'status' => $status
                );

                $this->Guzzle_model->updateAgenda($id_agenda, $data);

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
            redirect("agenda/v/harian/" . $data_lama['tanggal']);
        } elseif ($aksi == 'harian') {
            //$p = 'list_jadwal';
            $p = 'dashboard';

            if ($tanggal == '') {
                $data['header_hari'] = $today;
            } else {
                $data['header_hari'] = $tanggal;
            }

            //$data['agenda'] = $this->Guzzle_model->getAgendaByTanggal($data['header_hari']);
            $data['zona'] = $this->Guzzle_model->getAllZona();
        } elseif ($aksi == 'mingguan') {
            $p = 'list_jadwal';

            if ($tanggal == '' and $tanggal2 == '') {
                $data['header_hari1'] = date("Y-m-d", strtotime("Monday this week"));
                $data['header_hari2'] = date("Y-m-d", strtotime("Sunday this week"));
                $data['agenda'] = $this->Guzzle_model->getAgendaMingguIni();
            } else {
                $data['header_hari1'] = $tanggal;
                $data['header_hari2'] = $tanggal2;
                $data['agenda'] = $this->Guzzle_model->getAgendaByRangeTanggal($tanggal, $tanggal2);
            }
        } elseif ($aksi == 'bulanan') {
            $p = 'list_jadwal';

            if ($tanggal == '' and $tanggal2 == '') {
                $data['header_bulan'] = $this->Mcrud->bulan_id($today);
                $data['header_tahun'] = date('Y', strtotime($today));
                $data['agenda'] = $this->Guzzle_model->getAgendaBulanIni();
            } else {
                $data['header_bulan'] = $this->Mcrud->bulan_id($tanggal);
                $data['header_tahun'] = date('Y', strtotime($tanggal));
                $data['agenda'] = $this->Guzzle_model->getAgendaByRangeTanggal($tanggal, $tanggal2);
            }
        } else if ($aksi == 'df') {
            $id_agenda = $this->input->post('id');
            $cek_data = $this->Guzzle_model->getAgendaById($id_agenda);

            if (!isset($ceks)) {
                redirect('web/login');
            }

            try {
                $path = $this->input->post('path');

                if (unlink($path)) {
                    $file = json_decode($cek_data['url_data_dukung'], true);
                    unset($file[$this->input->post('file_id')]);

                    $data = array(
                        'nama' => $cek_data['nama'],
                        'url_data_dukung' => json_encode(count($file) > 0 ? $file : null)
                    );

                    $this->Guzzle_model->updateAgenda($id_agenda, $data);
                }
                echo "success : " . json_encode($file);
            } catch (Exception $e) {
                echo json_encode($e);
            }
            return 0;
        } else {
            $p = "list_jadwal";
        }

        $this->load->view('header', $data);
        $this->load->view("agenda/$p", $data);
        $this->load->view('footer');
    }
}
