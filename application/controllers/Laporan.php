<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Laporan extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->library('pdf_report');


        $this->load->library('session');
//        $this->load->model('Guzzle_model');
        $this->load->helper('security');

    }

    public function index_bk()
    {
        $ceks = $this->session->userdata('username');
        $id_user = $this->session->userdata('id_user');
        if (!isset($ceks)) {
            redirect('web/login');
        } else {
            $data['judul_web'] = "Laporan";
            date_default_timezone_set('Asia/Singapore');
            $p = "laporan_data";

            if ($this->session->has_userdata("tgl_awal_sql")) {
                $this->session->unset_userdata("tgl_awal_sql");
            }

            if ($this->session->has_userdata("tgl_akhir_sql")) {
                $this->session->unset_userdata("tgl_akhir_sql");
            }

            $data['tgl_awal_sql'] = date("Y-m-d");
            $data['tgl_akhir_sql'] = date("Y-m-d");

            $data['id_divisi_selected'] = "kosong";
            $hari_ini = date("Y-m-d");

            $data["tgl_now"] = $this->Mcrud->tgl_english($hari_ini, 'full');
            $data['agenda_data'] = $this->Guzzle_model->getAgendaByRangeTanggal($hari_ini, $hari_ini);
            $this->load->view('header', $data);
            $this->load->view("laporan/$p", $data);
            $this->load->view('footer');
        }
    }

    public function index()
    {
        $ceks = $this->session->userdata('username');
        $id_user = $this->session->userdata('id_user');
        if (!isset($ceks)) {
            redirect('web/login');
        } else {
            $data['judul_web'] = "Laporan";
            date_default_timezone_set('Asia/Singapore');
            $p = "laporan_data_itk";

            if ($this->session->has_userdata("tgl_awal_sql")) {
                $this->session->unset_userdata("tgl_awal_sql");
            }

            if ($this->session->has_userdata("tgl_akhir_sql")) {
                $this->session->unset_userdata("tgl_akhir_sql");
            }

            $data['tgl_awal_sql'] = date("Y-m-d");
            $data['tgl_akhir_sql'] = date("Y-m-d");

            $data['id_divisi_selected'] = "kosong";
            $hari_ini = date("Y-m-d");

            $data["tgl_now"] = $this->Mcrud->tgl_english($hari_ini, 'full');
            //$data['agenda_data'] = $this->Guzzle_model->getAgendaByRangeTanggal($hari_ini, $hari_ini);
            $data['itk_data_pdf'] = $this->Guzzle_model->getDataITKByRangeTanggal($hari_ini, $hari_ini);
            $this->load->view('header', $data);
            $this->load->view("laporan/$p", $data);
            $this->load->view('footer');
        }
    }


    public function v($aksi = '', $tanggal = '', $tanggal2 = '')
    {
        $ceks = $this->session->userdata('username');
        $id_user = $this->session->userdata('id_user');
        $level = $this->session->userdata('level');
        $link1 = $this->uri->segment(1);
        $link2 = $this->uri->segment(2);
        $link3 = $this->uri->segment(3);
        $link4 = $this->uri->segment(4);
        $link5 = $this->uri->segment(5);
        $data['laporan_agenda_data'] = [];

        if (!isset($ceks)) {
            redirect('web/login');
        } else {
            $data['tgl_awal_sql'] = "kosong";
            $data['tgl_akhir_sql'] = "kosong";
            $data['id_divisi'] = "kosong";
            if ($aksi == 'f') {

                $data['filter_date_dari'] = $this->input->post('dari_tgl');
                $data['filter_date_sampai'] = $this->input->post('sampai_tgl');

//                echo $data['filter_date_dari']; die;

                //ubah format tgl indo ke tgl sql
                $data['tgl_awal_sql'] = $this->Mcrud->tgl_sql($data['filter_date_dari']);
//                echo $data['tgl_awal_sql'];
                $data['tgl_akhir_sql'] = $this->Mcrud->tgl_sql($data['filter_date_sampai']);
                //nanti cek disini , value untuk id dan name divisi masih static di laporan_data.php (view)
                $data['id_divisi_selected'] = $this->input->post('id_divisi');
                //cukx

                $data['itk_data_pdf'] = $this->Guzzle_model->getDataITKByRangeTanggal($data['tgl_awal_sql'], $data['tgl_akhir_sql']);
                //$data['agenda_data'] = $this->Guzzle_model->getAgendaByRangeTanggal($data['tgl_awal_sql'], $data['tgl_akhir_sql']);
                $data['laporan_itk_data_pdf'] = $this->Guzzle_model->getDataITKByRangeTanggal($data['tgl_awal_sql'], $data['tgl_akhir_sql']);
                //$data['laporan_agenda_data'] = $this->Guzzle_model->getAgendaByRangeTanggal($data['tgl_awal_sql'], $data['tgl_akhir_sql']);


                //awal set tanggal sql
                if ($this->session->has_userdata("tgl_awal_sql")) {
                    $this->session->unset_userdata("tgl_awal_sql");
                }
                $this->session->set_userdata("tgl_awal_sql", $data['tgl_awal_sql']);

                if ($this->session->has_userdata("tgl_akhir_sql")) {
                    $this->session->unset_userdata("tgl_akhir_sql");
                }
                $this->session->set_userdata("tgl_akhir_sql", $data['tgl_akhir_sql']);
                //akhir set tanggal sql

                if ($this->session->has_userdata("tgl_awal_idn")) {
                    $this->session->unset_userdata("tgl_awal_idn");
                }
                $test = $this->Mcrud->tgl_idn($data['tgl_awal_sql'], 'full');
                $this->session->set_userdata("tgl_awal_idn", $test);

                if ($this->session->has_userdata("tgl_akhir_idn")) {
                    $this->session->unset_userdata("tgl_akhir_idn");
                }
                $test = $this->Mcrud->tgl_idn($data['tgl_akhir_sql'], 'full');
                $this->session->set_userdata("tgl_akhir_idn", $test);


                $firstTgl = strtotime($data['tgl_awal_sql']);
                $endTgl = strtotime($data['tgl_akhir_sql']);

                $jarakWaktu = abs($endTgl - $firstTgl);
                $numberDays = $jarakWaktu / 86400;
                $numberDays = intval($numberDays) + 1;
//                var_dump($numberDays);
                $data['laporan_status_agenda'] = [];

                for ($i = 0; $i < $numberDays; $i++) {
                    $getTgl = date('Y-m-d', strtotime("+" . $i . "day", strtotime($data['tgl_awal_sql'])));
                    //nanti lock agar bisa menentukan pekan ke sekian
                    array_push($data['laporan_status_agenda'], (object)[
                        'tanggal' => $getTgl,
                    ]);
//                    var_dump($getTgl);


//                    echo $this->Mcrud->weekOfMonth(strtotime($getTgl)) . " "; // 2
                }
                $p = "laporan_data_itk";
                $this->load->view('header', $data);
                $this->load->view("laporan/$p", $data);
                $this->load->view('footer');
            } else if ($aksi == 'c') {

                if ($this->session->has_userdata("tgl_awal_sql") && $this->session->has_userdata("tgl_akhir_sql")) {
                    $firstTgl = strtotime($this->session->userdata("tgl_awal_sql"));
                    $endTgl = strtotime($this->session->userdata("tgl_akhir_sql"));

                    $jarakWaktu = abs($endTgl - $firstTgl);
                    $numberDays = $jarakWaktu / 86400;
                    $numberDays = intval($numberDays) + 1;
                    $data['laporan_status_ruangan'] = [];

//                echo $numberDays;
                    $data['a'] = array();
                    $data['b'] = array();
                    for ($i = 0; $i < $numberDays; $i++) {
                        $getTgl = date('Y-m-d', strtotime("+" . $i . "day", strtotime($this->session->userdata("tgl_awal_sql"))));
                        $bulan = date("Y-m", strtotime($getTgl));

                        array_push($data['a'], $bulan);
                    }

                    for ($i = 0; $i < count($data['a']); $i++) {
                        if (!in_array($data['a'][$i], $data['b'])) {
                            array_push($data['b'], $data['a'][$i]);
                        }
                    }


                    $this->session->userdata("tgl_akhir_sql");
                    $data['dt_session_akhir'] = $this->session->userdata('tgl_akhir_sql');
                    $data['laporan_agenda_data'] = $this->Guzzle_model->getAgendaByRangeTanggal($this->session->userdata("tgl_awal_sql"), $this->session->userdata("tgl_akhir_sql"));
                    $data['test'] = "tes bro";

                    $this->load->view('laporan/test_view_new', $data);

                } else {
                    $firstTgl = strtotime(date("Y-m-d"));
                    $endTgl = strtotime(date("Y-m-d"));

                    $jarakWaktu = abs($endTgl - $firstTgl);
                    $numberDays = $jarakWaktu / 86400;
                    $numberDays = intval($numberDays) + 1;
                    $data['laporan_status_ruangan'] = [];

                    $data['a'] = array();
                    $data['b'] = array();
                    for ($i = 0; $i < $numberDays; $i++) {
                        $getTgl = date('Y-m-d', strtotime("+" . $i . "day", strtotime(date("Y-m-d"))));
                        $bulan = date("Y-m", strtotime($getTgl));

                        array_push($data['a'], $bulan);
                    }

                    for ($i = 0; $i < count($data['a']); $i++) {
                        if (!in_array($data['a'][$i], $data['b'])) {
                            array_push($data['b'], $data['a'][$i]);
                        }
                    }

                    $data['dt_session_akhir'] = date("Y-m-d");
                    $data['laporan_agenda_data'] = $this->Guzzle_model->getAgendaByRangeTanggal(date("Y-m-d"), date("Y-m-d"));
                    $data['test'] = "tes bro";

                    $this->load->view('laporan/test_view_new', $data);

                }


            } else if ($aksi == 'ccs') {

//                $data['filter_date_dari'] = $this->input->post('dari_tgl');
//                $data['filter_date_sampai'] = $this->input->post('sampai_tgl');
//                echo $this->input->post('dari_tgl'); die;
//                echo 'ccs'; die;
//                echo $this->session->userdata("tgl_awal_sql"); die;

                if ($this->session->has_userdata("tgl_awal_sql") && $this->session->has_userdata("tgl_akhir_sql")) {
                    $firstTgl = strtotime($this->session->userdata("tgl_awal_sql"));
                    $endTgl = strtotime($this->session->userdata("tgl_akhir_sql"));

                    $jarakWaktu = abs($endTgl - $firstTgl);
                    $numberDays = $jarakWaktu / 86400;
                    $numberDays = intval($numberDays) + 1;
                    $data['laporan_status_ruangan'] = [];

//                echo $numberDays;
                    $data['a'] = array();
                    $data['b'] = array();
                    for ($i = 0; $i < $numberDays; $i++) {
                        $getTgl = date('Y-m-d', strtotime("+" . $i . "day", strtotime($this->session->userdata("tgl_awal_sql"))));
                        $bulan = date("Y-m", strtotime($getTgl));

                        array_push($data['a'], $bulan);
                    }

                    for ($i = 0; $i < count($data['a']); $i++) {
                        if (!in_array($data['a'][$i], $data['b'])) {
                            array_push($data['b'], $data['a'][$i]);
                        }
                    }


                    $this->session->userdata("tgl_akhir_sql");
                    $data['dt_session_akhir'] = $this->session->userdata('tgl_akhir_sql');
                    //$data['laporan_agenda_data'] = $this->Guzzle_model->getAgendaByRangeTanggal($this->session->userdata("tgl_awal_sql"), $this->session->userdata("tgl_akhir_sql"));
                    $data['laporan_itk_data_pdf'] = $this->Guzzle_model->getDataITKByRangeTanggal($this->session->userdata("tgl_awal_sql"), $this->session->userdata("tgl_akhir_sql"));
                    $data['test'] = "tes bro sudah lakukan filter";

//                    $this->load->view('laporan/test_view_new', $data);

                } else {
                    $firstTgl = strtotime(date("Y-m-d"));
                    $endTgl = strtotime(date("Y-m-d"));

                    $jarakWaktu = abs($endTgl - $firstTgl);
                    $numberDays = $jarakWaktu / 86400;
                    $numberDays = intval($numberDays) + 1;
                    $data['laporan_status_ruangan'] = [];

                    $data['a'] = array();
                    $data['b'] = array();
                    for ($i = 0; $i < $numberDays; $i++) {
                        $getTgl = date('Y-m-d', strtotime("+" . $i . "day", strtotime(date("Y-m-d"))));
                        $bulan = date("Y-m", strtotime($getTgl));

                        array_push($data['a'], $bulan);
                    }

                    for ($i = 0; $i < count($data['a']); $i++) {
                        if (!in_array($data['a'][$i], $data['b'])) {
                            array_push($data['b'], $data['a'][$i]);
                        }
                    }

                    $data['dt_session_akhir'] = date("Y-m-d");
                    //$data['laporan_agenda_data'] = $this->Guzzle_model->getAgendaByRangeTanggal(date("Y-m-d"), date("Y-m-d"));
                    $data['laporan_itk_data_pdf'] = $this->Guzzle_model->getDataITKByRangeTanggal(date("Y-m-d"), date("Y-m-d"));
                    $data['test'] = "tes bro belum lakukan filter";

//                    $this->load->view('laporan/test_view_new', $data);

                }


                ob_start();
                $data['tests'] = "tes bro";
                $data['judul_sub_menu'] = "Laporan Data ITK";

                if ($this->session->has_userdata("tgl_awal_sql") && $this->session->has_userdata("tgl_akhir_sql")){
                    $data['tgl_awal_sql'] =  $this->session->userdata("tgl_awal_sql");
                    $data["tgl_awal_idn"] = $this->Mcrud->tgl_id_new($data['tgl_awal_sql'], 'full');

                    $data['tgl_akhir_sql'] =  $this->session->userdata("tgl_akhir_sql");
                    $data["tgl_akhir_idn"] = $this->Mcrud->tgl_id_new($data['tgl_akhir_sql'], 'full');
                } else if (!$this->session->has_userdata("tgl_awal_sql") && !$this->session->has_userdata("tgl_akhir_sql")){
                    $data['tgl_awal_sql'] =  date("Y-m-d");
                    $data["tgl_awal_idn"] = $this->Mcrud->tgl_id_new($data['tgl_awal_sql'], 'full');

                    $data['tgl_akhir_sql'] = date("Y-m-d");
                    $data["tgl_akhir_idn"] = $this->Mcrud->tgl_id_new($data['tgl_akhir_sql'], 'full');
                }

                //$this->load->view('laporan/print_laporan_katamaran',$data);
                $this->load->view('laporan/print_laporan_data_itk',$data);
                $content = ob_get_contents();
                ob_end_clean();

                require('./assets/html2pdf/autoload.php');
                try
                {
                    $pdf  = new Spipu\Html2Pdf\Html2Pdf('P','A4','en');
//                    $pdf->pdf->SetDisplayMode('fullpage');
                    $pdf->writeHTML($content);
                    //$pdf->Output('laporan_katamaran.pdf','I');
                    $pdf->Output('laporan_data_itk.pdf','I');
                }
                catch(HTML2PDF_exception $e) {
                    echo $e;
                    exit;
                }
            } else {
                $data['tgl_awal_sql'] = "kosong";
                $data['tgl_akhir_sql'] = "kosong";
                $data['id_divisi'] = "kosong";
                $p = 'laporan_data';
                $this->load->view('header', $data);
                $this->load->view("laporan/$p", $data);
                $this->load->view('footer');
            }

        }
    }


}