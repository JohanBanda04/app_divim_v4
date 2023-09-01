<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Izintinggal extends CI_Controller
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

    public function data_itk($zona_id = '', $aksi = '', $status = '', $pemda = '')
    {
        //echo hashids_decrypt($zona_id); die;
        //echo $this->session->userdata('id_zona'); die;
        //bisa sampai sini
        //echo $zona; die;
        $ceks = $this->session->userdata('token_katamaran');
        $id_user = $this->session->userdata('id_user');
        $level = $this->session->userdata('level');

        //$this->session->set_flashdata('msg', '');

        date_default_timezone_set('Asia/Singapore');
        $data['time_now'] = date('H:i');
        $today = date('Y-m-d');

        /*disini getzonabyid*/
        $data['datazona'] = $this->Guzzle_model->getDataZonaByID(hashids_decrypt($zona_id));
        $data['datazona_all'] = $this->Guzzle_model->getAllZona();
        $data['zona_id'] = $zona_id;
        /*cuky*/
        if(hashids_decrypt($zona_id)==0 || hashids_decrypt($zona_id)=="0"){
            $data['izintinggal'] = $this->Guzzle_model->getAllDataITK();
        } else {
            $data['izintinggal'] = $this->Guzzle_model->getizintinggalByZona(hashids_decrypt($zona_id));

        }

        //echo '<pre>'; print_r($data['izintinggal']);die;
        $lokasi = 'file/data_itk';
        $max_size = 1024 * 5;
        $this->upload->initialize(array(
            "upload_path" => "./$lokasi",
            "allowed_types" => "jpeg|jpg|png",
            "max_size" => $max_size
        ));


//        if ($aksi != 't') {
//            $this->session->set_flashdata('msg', '');
//        }

//        if(!isset($ceks)) {
//            redirect('web/login');
//        }

        //cara get data
        $data['zona'] = $this->Guzzle_model->getZonaByID();

        if ($status == 'belum_diproses' or $status == 'perbaikan' or $status == 'draft_sedang_dibuat' or $status == 'sedang_diproses' or $status == 'menunggu_koreksi' or $status == 'selesai') {
            if(hashids_decrypt($zona_id)==0 || hashids_decrypt($zona_id)=="0"){
                $data['izintinggal'] = $this->Guzzle_model->getizintinggalAllByStatus($status);
            } else {
                $data['izintinggal'] = $this->Guzzle_model->getizintinggalByStatusandZonaID(hashids_decrypt($zona_id), $status);
            }
        } else if ($status == 'semua') {
            redirect("izintinggal/data_itk/" . $zona_id);
        }

        if ($aksi == 't') {
            //echo "tambah";die;


            if (hashids_decrypt($zona_id)=="0"){
                $zona_id = $this->input->post('pilih_zona');
            }
            if (!isset($ceks)) {
                $id_user = 00;
                $status = 'belum';
            }




            //$nama = $this->input->post('nama');
            $nama = $this->input->post('nama');
            $negara = $this->input->post('negara');
            $jenis_kelamin = $this->input->post('jenis_kelamin');
            $status = $this->input->post('status');
            $no_paspor = $this->input->post('no_paspor');
            $alamat = $this->input->post('alamat');
            $penjamin = $this->input->post('penjamin');


            //cuyypaspor2
            $cek_dtPaspor = $this->Guzzle_model->getDataByNoPaspor($no_paspor);

            if (count($cek_dtPaspor) > 0) {
                $publik_simpan = "n";

            } else if (count($cek_dtPaspor) <= 0) {
                $publik_simpan = "y";
            }

            if ($publik_simpan == 'n') {
                $simpan = 'n';


                redirect('failed_content');
            } else if ($publik_simpan == 'y') {
                //echo "tidak ada data no paspor sama "; die;

                if (!is_dir($lokasi)) {
                    //jika tidak maka folder harus dibuat terlebih dahulu
                    mkdir($lokasi, 0777, $rekursif = true);
                }

                if ($_FILES['url_files']['name'][0] == null) {
                    $count = 0;
                } else {
                    $count = count($_FILES['url_files']['name']);
                }

                //echo $count;die;

                if ($count != 0) {
                    //echo "tes"; die;
                    for ($i = 0; $i < $count; $i++) {

                        if (!empty($_FILES['url_files']['name'][$i])) {

                            $_FILES['file']['name'] = $_FILES['url_files']['name'][$i];
                            $_FILES['file']['type'] = $_FILES['url_files']['type'][$i];
                            $_FILES['file']['tmp_name'] = $_FILES['url_files']['tmp_name'][$i];
                            $_FILES['file']['error'] = $_FILES['url_files']['error'][$i];
                            $_FILES['file']['size'] = $_FILES['url_files']['size'][$i];

//                        echo $_FILES['file']['name']; die;

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
                        //echo "<pre>"; print_r($url_file); die;
                    }
                } else {
                    $simpan = 'y';
                }


                //echo hashids_decrypt($zona_id); die;
                if ($simpan == 'y') {
                    $data = array(
                        'id_user' => $id_user,
                        'nama' => $nama,
                        'negara' => $negara,
                        'jenis_kelamin' => $jenis_kelamin,
                        'no_paspor' => $no_paspor,
                        'alamat' => $alamat,
                        'penjamin' => $penjamin,
                        'status' => $status,
                        'url_data_dukung' => json_encode($url_file),
                        'created_at' => date('Y-m-d H:i:s'),
                        'updated_at' => date('Y-m-d H:i:s'),
                        'id_zona' => hashids_decrypt($zona_id),


                    );

                    //echo "<pre>"; print_r($data); die;

                    $this->Guzzle_model->createDataITK($data);

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
					<div class="alert alert-success alert-dismissible" role="alert">
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
						<strong>Gagal Menyimpan Data!</strong> No Paspor Sudah Terdaftar.
					</div>
				<br>'
                    );

                }

            }


            $pesan = '';


            //echo "<pre>"; print_r($url_file); die;

            //echo $this->session->flashdata("msg");die;
            /*cuyyycreate*/
            //redirect("agenda/v/harian/" . $tanggal_convert);
            if (isset($_SESSION['token_katamaran'])) {
                redirect("izintinggal/data_itk/" . $zona_id);

            } else if (!isset($_SESSION['token_katamaran'])) {
                redirect('datakabupaten/kabupaten/dashboard');
            }
        } else if ($aksi == 't_publik') {
            //echo "tambah_publik";die;


            $id_user = 00;
            $status = 'belum';



            //$nama = $this->input->post('nama');
            $nama = $this->input->post('nama');
            $negara = $this->input->post('negara');
            $jenis_kelamin = $this->input->post('jenis_kelamin');
            $status = $this->input->post('status');
            $no_paspor = $this->input->post('no_paspor');
            $alamat = $this->input->post('alamat');
            $penjamin = $this->input->post('penjamin');


            $pesan = '';

            if (!is_dir($lokasi)) {
                //jika tidak maka folder harus dibuat terlebih dahulu
                mkdir($lokasi, 0777, $rekursif = true);
            }

            //echo $_FILES['url_files']['name'][0]; die;
            if ($_FILES['url_files']['name'][0] == null) {
                $count = 0;
            } else {
                $count = count($_FILES['url_files']['name']);
            }

            echo $count;die;

            if ($count != 0) {
                //echo "tes"; die;
                for ($i = 0; $i < $count; $i++) {

                    if (!empty($_FILES['url_files']['name'][$i])) {

                        $_FILES['file']['name'] = $_FILES['url_files']['name'][$i];
                        $_FILES['file']['type'] = $_FILES['url_files']['type'][$i];
                        $_FILES['file']['tmp_name'] = $_FILES['url_files']['tmp_name'][$i];
                        $_FILES['file']['error'] = $_FILES['url_files']['error'][$i];
                        $_FILES['file']['size'] = $_FILES['url_files']['size'][$i];

//                        echo $_FILES['file']['name']; die;

                        if (!$this->upload->do_upload('file')) {
                            $simpan = 'n';
                            $pesan = htmlentities(strip_tags($this->upload->display_errors('<p>', '</p>')));
                        } else {
                            $gbr = $this->upload->data();
                            $filename = "$lokasi/" . $gbr['file_name'];
                            $url_file[$i] = preg_replace('/ /', '_', $filename);
                            $simpan = 'y';

                            echo '<pre>'; print_r($url_file); die;
                        }


                    }
                    //echo "<pre>"; print_r($url_file); die;
                }
            } else {
                $simpan = 'y';
            }

            $cek_dtPaspor = $this->Guzzle_model->getDataByNoPaspor($no_paspor);

            if (count($cek_dtPaspor) > 0) {
                $publik_simpan = "n";

            } else if (count($cek_dtPaspor) <= 0) {
                $publik_simpan = "y";
            }

            //echo $publik_simpan; die;
            if ($publik_simpan == 'n') {
                $simpan = 'n';
                //echo "ada data no paspor sama "; die;
            } else if ($publik_simpan == 'y') {
                //echo "tidak ada data no paspor sama "; die;
                $simpan = 'y';
            }




            if ($simpan == 'y') {
                $data = array(
                    'id_user' => $id_user,
                    'nama' => $nama,
                    'negara' => $negara,
                    'jenis_kelamin' => $jenis_kelamin,
                    'no_paspor' => $no_paspor,
                    'alamat' => $alamat,
                    'penjamin' => $penjamin,
                    'status' => $status,
                    'url_data_dukung' => json_encode($url_file),
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                    'id_zona' => hashids_decrypt($zona_id),


                );

                //echo "<pre>"; print_r($data); die;

                $this->Guzzle_model->createDataITK($data);

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
						 <strong>Gagal!</strong> ' . "No. Paspor Sudah Terdaftar,Data ITK Gagal Disimpan" . '.
					</div>
				 <br>'
                );
            }


            //echo $simpan; die;

            //echo "ada data yg sama"; die;

            //echo "<pre>"; print_r($url_file); die;


            /*cuyyycreate*/
            //redirect("agenda/v/harian/" . $tanggal_convert);
            if (isset($_SESSION['token_katamaran'])) {
                redirect("izintinggal/data_itk/" . $zona_id);

            } else if (!isset($_SESSION['token_katamaran'])) {
                redirect('datakabupaten/kabupaten/dashboard');
            }
        } elseif ($aksi == 'e') {
            //echo "simpan editan";die;

            if (!isset($ceks)) {
                redirect('web/login');
            }


            $id_dataitk = $this->input->post('id_dataitk');
            //echo $id_dataitk; die;
//            $nama = $this->input->post('nama');
//            $tanggal = $this->input->post('tanggal');
//            $jam_mulai = $this->input->post('jam_mulai');
//            $jam_selesai = $this->input->post('jam_selesai');
//            $tempat = $this->input->post('tempat');
//            $peserta = $this->input->post('peserta');
//            $pakaian = $this->input->post('pakaian');
//            $deskripsi = $this->input->post('deskripsi');
//            $pejabat = $this->input->post('pejabat');
//            $penanggungjawab = $this->input->post('penanggungjawab');
//
            $data_lama = $this->Guzzle_model->getDataITKById($id_dataitk);

//            $tanggal_convert = date('Y-m-d', strtotime($tanggal));

            $pesan = '';

            if (!is_dir($lokasi)) {
                //jika tidak maka folder harus dibuat terlebih dahulu
                mkdir($lokasi, 0777, $rekursif = true);
            }

//            if ($_FILES['url_files_edit']['name'][0] == null) {
//                $count = 0;
//            } else {
//                $count = count($_FILES['url_files_edit']['name']);
//            }

            if ($_FILES['url_files_edit']['name'][0] == null) {

                $count_edit = 0;
            } else {
                $count_edit = count($_FILES['url_files_edit']['name']);
            }

            /*cuyysimpaneditan*/
            $nama = $this->input->post('nama');
            $negara = $this->input->post('negara');
            $jenis_kelamin = $this->input->post('jenis_kelamin');
            $status = $this->input->post('status');
            $no_paspor = $this->input->post('no_paspor');
            $alamat = $this->input->post('alamat');
            $penjamin = $this->input->post('penjamin');


            if ($count_edit != 0) {
                for ($i = 0; $i < $count_edit; $i++) {
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
                //$url_data_dukung = json_encode(array_merge($file_lama, $url_file));
                $foto = json_encode(array_merge($file_lama, $url_file));
            } else {
                //$url_data_dukung = $data_lama['url_data_dukung'];
                $foto = $data_lama['url_data_dukung'];
                $simpan = 'y';
            }

            if ($simpan == 'y') {
                $data = array(
                    'id_user' => $id_user,
                    'nama' => $nama,
                    'negara' => $negara,
                    'jenis_kelamin' => $jenis_kelamin,
                    'no_paspor' => $no_paspor,
                    'alamat' => $alamat,
                    'penjamin' => $penjamin,
                    'status' => $status,
                    'url_data_dukung' => $foto,
                    'updated_at' => date('Y-m-d H:i:s'),
                    'id_zona' => hashids_decrypt($zona_id),
//                    'nama' => $nama,
//                    'tanggal' => $tanggal_convert,
//                    'jam_mulai' => $jam_mulai,
//                    'jam_selesai' => $jam_selesai,
//                    'tempat' => $tempat,
//                    'peserta' => $peserta,
//                    'pakaian' => $pakaian,
//                    'deskripsi' => $deskripsi,
//                    'url_data_dukung' => $url_data_dukung,
//                    'pejabat' => $pejabat,
//                    'penanggungjawab' => $penanggungjawab

                    /*cuyyhasilupdate*/
                );

                $this->Guzzle_model->updateDataITK($id_dataitk, $data);

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
            /*tez*/
//            redirect("agenda/v/harian/" . $tanggal_convert);
            redirect("izintinggal/data_itk/" . $zona_id);
        } elseif ($aksi == 'h') {
            /*$status disini merupakan id data dari tabel data_itk*/
            //echo "hapus".'<br>';
            //echo "zona : $zona_id".'<br>';
            //echo "id data itk : ". hashids_decrypt($status);die;
            if (!isset($ceks)) {
                redirect('web/login');
            }

            //$id_agenda = $this->input->post('id_agenda');
            $id_dataitk = hashids_decrypt($status);
            //echo $id_dataitk; die;

            //$cek_data = $this->Guzzle_model->getAgendaById($id_agenda);
            $cek_data = $this->Guzzle_model->getDataITKById($id_dataitk);

            if ($cek_data == null) {
                //echo "tdk ada data";die;
                redirect('404');
            } else {
                //echo "ada data";die;
                foreach ($this->Mcrud->url_data_dukung($cek_data['url_data_dukung']) as $row) {
                    if ($row != '') {
                        unlink($row);
                    }
                }
                //$this->Guzzle_model->deleteAgenda($id_agenda);
                $this->Guzzle_model->deleteDataITK($id_dataitk);
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
            //cuyydelete
            //redirect("agenda/v/harian/" . $cek_data['tanggal']);
            redirect("izintinggal/data_itk/" . $zona_id);
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

//            if ($tanggal == '') {
//                $data['header_hari'] = $today;
//            } else {
//                $data['header_hari'] = $tanggal;
//            }

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
            //$id_agenda = $this->input->post('id');
            $id_dataitk = $this->input->post('id');
            //$cek_data = $this->Guzzle_model->getAgendaById($id_agenda);
            $cek_data = $this->Guzzle_model->getDataITKById($id_dataitk);

            if (!isset($ceks)) {
                redirect('web/login');
            }


            try {
                /*cuyyunlink*/
                $path = $this->input->post('path');

                if (unlink($path)) {
                    //$file = json_decode($cek_data['url_data_dukung'], true);
                    $file = json_decode($cek_data['url_data_dukung']);
                    unset($file[$this->input->post('file_id')]);

                    $data = array(
                        'nama' => $cek_data['nama'],
                        'url_data_dukung' => json_encode(count($file) > 0 ? array_values($file) : null)
                    );

                    //$this->Guzzle_model->updateAgenda($id_agenda, $data);
                    $this->Guzzle_model->updateDataITK($id_dataitk, $data);
                }
                echo "success : " . json_encode($file);
            } catch (Exception $e) {
                echo json_encode($e);
            }
            return 0;
        } else {
            $p = "izin_tinggal";
        }

        $this->load->view('header', $data);
        $this->load->view("izin_tinggal/$p", $data);
        $this->load->view('footer');
    }

}
