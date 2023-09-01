<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mcrud extends CI_Model {	
	public static function tgl_id($date, $bln='')
	{
		date_default_timezone_set('Asia/Singapore');
			$str = explode('-', $date);
			$bulan = array(
				'01' => 'Jan',
				'02' => 'Feb',
				'03' => 'Mar',
				'04' => 'Apr',
				'05' => 'Mei',
				'06' => 'Jun',
				'07' => 'Jul',
				'08' => 'Ags',
				'09' => 'Sep',
				'10' => 'Okt',
				'11' => 'Nov',
				'12' => 'Des',
			);
			if ($bln == '') {
				$hasil = $str['2'] . "-" . substr($bulan[$str[1]],0,3) . "-" .$str[0];
			}elseif ($bln == 'full') {
				$hasil = $str['2'] . " " . $bulan[$str[1]] . " " .$str[0];
			}else {
				$hasil = $bulan[$str[1]];
			}
			return $hasil;
	}

	public static function tgl_idn($date, $bln='')
	{
		date_default_timezone_set('Asia/Singapore');
			$str = explode('-', $date);
			$bulan = array(
				'01' => 'Januari',
				'02' => 'Februari',
				'03' => 'Maret',
				'04' => 'April',
				'05' => 'Mei',
				'06' => 'Juni',
				'07' => 'Juli',
				'08' => 'Agustus',
				'09' => 'September',
				'10' => 'Oktober',
				'11' => 'November',
				'12' => 'Desember',
			);
			if ($bln == '') {
				$hasil = $str['2'] . "-" . substr($bulan[$str[1]],0,3) . "-" .$str[0];
			}elseif ($bln == 'full') {
				$hasil = $str['2'] . " " . $bulan[$str[1]] . " " .$str[0];
			}else {
				$hasil = $bulan[$str[1]];
			}
			return $hasil;
	}

	public static function tgl_english($date, $bln){
        date_default_timezone_set('Asia/Singapore');
        $str = explode('-', $date);
        $bulan = array(
            '01' => 'Jan',
            '02' => 'Feb',
            '03' => 'Mar',
            '04' => 'Apr',
            '05' => 'May',
            '06' => 'Jun',
            '07' => 'Jul',
            '08' => 'Aug',
            '09' => 'Sep',
            '10' => 'Oct',
            '11' => 'Nov',
            '12' => 'Dec',
        );
        if ($bln == '') {
            $hasil = $str['2'] . "-" . substr($bulan[$str[1]],0,3) . "-" .$str[0];
        }elseif ($bln == 'full') {
            $hasil = substr($str['2'],0,2) . "-" . $bulan[$str[1]] . "-" .$str[0];
        }else {
            $hasil = $bulan[$str[1]];
        }
        return $hasil;
    }

    public static function tgl_id_new($date, $bln='')
    {
        date_default_timezone_set('Asia/Singapore');
        $str = explode('-', $date);
        $bulan = array(
            '01' => 'Jan',
            '02' => 'Feb',
            '03' => 'Mar',
            '04' => 'Apr',
            '05' => 'Mei',
            '06' => 'Jun',
            '07' => 'Jul',
            '08' => 'Ags',
            '09' => 'Sep',
            '10' => 'Okt',
            '11' => 'Nov',
            '12' => 'Des',
        );
        if ($bln == '') {
            $hasil = $str['2'] . "-" . substr($bulan[$str[1]],0,3) . "-" .$str[0];
        }elseif ($bln == 'full') {
            $hasil = substr($str['2'],0,2) . "-" . $bulan[$str[1]] . "-" .$str[0];
        }else {
            $hasil = $bulan[$str[1]];
        }
        return $hasil;
    }

	public function hari_id($tanggal)
	{
		$day = date('D', strtotime($tanggal));
		$dayList = array(
			'Sun' => 'Minggu',
			'Mon' => 'Senin',
			'Tue' => 'Selasa',
			'Wed' => 'Rabu',
			'Thu' => 'Kamis',
			'Fri' => "Jum'at",
			'Sat' => 'Sabtu'
		);
		return $dayList[$day];
	}

    public function weekOfMonth($date) {
        //Get the first day of the month.
        $firstOfMonth = strtotime(date("Y-m-01", $date));
        //Apply above formula.
        return $this->weekOfYear($date) - $this->weekOfYear($firstOfMonth) + 1;
    }

    public function weekOfYear($date) {
        $weekOfYear = intval(date("W", $date));
        if (date('n', $date) == "1" && $weekOfYear > 51) {
            // It's the last week of the previos year.
            return 0;
        }
        else if (date('n', $date) == "12" && $weekOfYear == 1) {
            // It's the first week of the next year.
            return 53;
        }
        else {
            // It's a "normal" week.
            return $weekOfYear;
        }
    }

//    function weekOfMonth($date) {
//        //Get the first day of the month.
//        $firstOfMonth = strtotime(date("Y-m-01", $date));
//        //Apply above formula.
//        return $this->weekOfYear($date) - $this->weekOfYear($firstOfMonth) + 1;
//    }
//
//    function weekOfYear($date) {
//        $weekOfYear = intval(date("W", $date));
//        if (date('n', $date) == "1" && $weekOfYear > 51) {
//            // It's the last week of the previos year.
//            return 0;
//        }
//        else if (date('n', $date) == "12" && $weekOfYear == 1) {
//            // It's the first week of the next year.
//            return 53;
//        }
//        else {
//            // It's a "normal" week.
//            return $weekOfYear;
//        }
//    }

    public function getBulanOnly($date){
        $bulan_digit1 = substr($date,5,1);
        $bulan_digit2 = substr($date,6,1);
        $bulan = ($bulan_digit1)."".($bulan_digit2);
        return $bulan;
    }
    public function getBulanIdOnly($date){
        $bulan_digit1 = substr($date,5,1);
        $bulan_digit2 = substr($date,6,1);
        $bulan = ($bulan_digit1)."".($bulan_digit2);
	    $bulan_id = $this->getBulanId($bulan);
        return $bulan_id;
    }

    public function tgl_sql($date){
        $exp = explode("-",$date);
        if(count($exp) == 3){
            $bln_sql = $this->getBulanSql($exp[1]);
            $tgl_sql = $this->getTglSql($exp[0]);
//            $date_tgl = $exp[2].'-'.$bln_sql.'-'.$exp[0];
            $date_tgl = $exp[2].'-'.$bln_sql.'-'.$tgl_sql;
        }
        return $date_tgl;
    }

    public function getBulanId($bln){
        switch ($bln) {
            case "01":
                return "Januari";
                break;
            case "02":
                return "Februari";
                break;
            case "03":
                return "Maret";
                break;
            case "04":
                return "April";
                break;
            case "05":
                return "Mei";
                break;
            case "06":
                return "Juni";
                break;
            case "07":
                return "Juli";
                break;
            case "08":
                return "Agustus";
                break;
            case "09":
                return "September";
                break;
            case "10":
                return "Oktober";
                break;
            case "11":
                return "November";
                break;
            case "12":
                return "Desember";
                break;
        }
    }

    public function getBulanSql_New($bln){
        switch ($bln) {
            case "Jan":
                return "01";
                break;
            case "Feb":
                return "02";
                break;
            case "Mar":
                return "03";
                break;
            case "Apr":
                return "04";
                break;
            case "May":
                return "05";
                break;
            case "Jun":
                return "06";
                break;
            case "Jul":
                return "07";
                break;
            case "Aug":
                return "08";
                break;
            case "Sep":
                return "09";
                break;
            case "Oct":
                return "10";
                break;
            case "Nov":
                return "11";
                break;
            case "Dec":
                return "12";
                break;
        }
    }

    public function getBulanSql($bln){
        switch ($bln) {
            case "Jan":
                return "01";
                break;
            case "Feb":
                return "02";
                break;
            case "Mar":
                return "03";
                break;
            case "Apr":
                return "04";
                break;
            case "May":
                return "05";
                break;
            case "Jun":
                return "06";
                break;
            case "Jul":
                return "07";
                break;
            case "Aug":
                return "08";
                break;
            case "Sep":
                return "09";
                break;
            case "Oct":
                return "10";
                break;
            case "Nov":
                return "11";
                break;
            case "Dec":
                return "12";
                break;
        }
    }

    public function getTglSql($tgl){
        switch ($tgl) {
            case "1":
                return "01";
                break;
            case "2":
                return "02";
                break;
            case "3":
                return "03";
                break;
            case "4":
                return "04";
                break;
            case "5":
                return "05";
                break;
            case "6":
                return "06";
                break;
            case "7":
                return "07";
                break;
            case "8":
                return "08";
                break;
            case "9":
                return "09";
                break;
            case "10":
                return "10";
                break;
            case "11":
                return "11";
                break;
            case "12":
                return "12";
                break;
            case "13":
                return "13";
                break;
            case "14":
                return "14";
                break;
            case "15":
                return "15";
                break;
            case "16":
                return "16";
                break;
            case "17":
                return "17";
                break;
            case "18":
                return "18";
                break;
            case "19":
                return "19";
                break;

            case "20":
                return "20";
                break;
            case "21":
                return "21";
                break;
            case "22":
                return "22";
                break;
            case "23":
                return "23";
                break;
            case "24":
                return "24";
                break;
            case "25":
                return "25";
                break;
            case "26":
                return "26";
                break;
            case "27":
                return "27";
                break;
            case "28":
                return "28";
                break;
            case "29":
                return "29";
                break;

            case "30":
                return "30";
                break;
            case "31":
                return "31";
                break;

        }
    }

	public function bulan_id($tanggal)
	{
		$day = date('m', strtotime($tanggal));
		$dayList = array(
			'01' => 'Januari',
			'02' => 'Februari',
			'03' => 'Maret',
			'04' => 'April',
			'05' => 'Mei',
			'06' => 'Juni',
			'07' => 'Juli',
			'08' => 'Agustus',
			'09' => 'September',
			'10' => 'Oktober',
			'11' => 'November',
			'12' => 'Desember',
		);
		return $dayList[$day];
	}

	public function waktu($data, $aksi='')
	{
		if ($aksi=='full') {
			$tgl_n = date('d-m-Y H:i:s',strtotime($data));
		}else {
			$tgl_n = date('d-m-Y',strtotime($data));
		}
		$hari = $this->Mcrud->hari_id($tgl_n);
		$tgl  = $this->Mcrud->tgl_id($tgl_n,$aksi);
		return $hari.", ".$tgl;
	}

	public function jam($data)
	{
		$time = date("H:i", strtotime($data));
		return $time;
	}

	public function prev_button($tanggal) {
		return date('Y-m-d', strtotime($tanggal .' -1 day'));
	}

	public function next_button($tanggal) {
		return date('Y-m-d', strtotime($tanggal .' +1 day'));
	}

	public function prev_button_week1($tanggal) {
		return  date("Y-m-d", strtotime($tanggal ."Monday previous week"));
	}

	public function prev_button_week2($tanggal) {
		return  date("Y-m-d", strtotime($tanggal ."Sunday previous week"));
	}

	public function next_button_week1($tanggal) {
		return  date("Y-m-d", strtotime($tanggal ."Monday next week"));
	}
	
	public function next_button_week2($tanggal) {
		return  date("Y-m-d", strtotime($tanggal ."Sunday next week"));
	}

	public function prev_button_month1($tanggal) {
		return  date("Y-m-d", strtotime($tanggal ."first day of previous month"));
	}

	public function prev_button_month2($tanggal) {
		return  date("Y-m-d", strtotime($tanggal ."last day of previous month"));
	}

	public function next_button_month1($tanggal) {
		return  date("Y-m-d", strtotime($tanggal ."first day of next month"));
	}
	
	public function next_button_month2($tanggal) {
		return  date("Y-m-d", strtotime($tanggal ."last day of next month"));
	}

	public function get_user_name_by_id($id)
	{
		$user = $this->Guzzle_model->getUserById($id);
		return $user['nama'];
	}

	public function url_data_dukung($array) {
		return json_decode($array);
	}

	public function get_pengawas_name_by_id($id)
	{
		if ($id == 0) {
			$nama = "-";
		} else {
			$user = $this->Guzzle_model->getUserById($id);
			$nama = $user['nama'];
		}
		return $nama;
	}

	public function get_nama_ruangan($id)
	{
		$ruangan = $this->Guzzle_model->getRuanganById($id);
		return $ruangan['nama'];
	}

	function judul_web($id='')
	{
		$data = '';
		return $data;
	}

	public function cek_filename($file='')
	{
		$data = "assets/favicon.png";
		if ($file != '') {
			if(file_exists("$file")){
				$data = $file;
			}
		}
		return $data;
	}

	function kirim_notif($notif_type, $id_dipa, $id_for_link, $pengirim, $penerima, $status_verifikasi='')
	{
		if ($notif_type == 'pelaksanaan_anggaran') {
			$pesan = "Mengirim laporan pelaksanaan anggaran";
			$link = "pelaksanaan_anggaran/v/$id_dipa/d/".hashids_encrypt($id_for_link);
		} elseif ($notif_type == 'revisi_pelaksanaan_anggaran') {
			$pesan = "Mengirim perbaikan laporan pelaksanaan anggaran";
			$link = "pelaksanaan_anggaran/v/$id_dipa/d/".hashids_encrypt($id_for_link);
		} elseif ($notif_type == 'verifikasi_pelaksanaan_anggaran') {
			$link = "pelaksanaan_anggaran/v/$id_dipa/d/".hashids_encrypt($id_for_link);
			if ($status_verifikasi == 'tolak') {
				$pesan = "Laporan pelaksanaan anggaran perlu perbaikan";
			} elseif ($status_verifikasi == 'sudah') {
				$pesan = "Laporan pelaksaanaan anggaran sudah diverifikasi";
			}
		} elseif ($notif_type == 'usulan_revisi_dipa') {
			$link = "revisi_dipa/v/$id_dipa/d/".hashids_encrypt($id_for_link);
			$pesan = "Mengirim usulan revisi dipa";
		} elseif ($notif_type == 'revisi_usulan_revisi_dipa') {
			$link = "revisi_dipa/v/$id_dipa/d/".hashids_encrypt($id_for_link);
			$pesan = "Mengirim perbaikan usulan revisi dipa";
		} elseif ($notif_type == 'verifikasi_usulan_revisi_dipa') {
			$link = "revisi_dipa/v/$id_dipa/d/".hashids_encrypt($id_for_link);
			if ($status_verifikasi == 'tolak') {
				$pesan = "Usulan revisi DIPA perlu perbaikan";
			} elseif ($status_verifikasi == 'sudah') {
				$pesan = "Usulan revisi DIPA sudah diverifikasi";
			}
		} elseif ($notif_type == 'monev') {
			$pesan = "Mengirim monitoring dan evaluasi";
			$link = "monev/v/$status_verifikasi/$id_dipa/".hashids_encrypt($id_for_link);
		} elseif ($notif_type == 'tindak_lanjut_monev') {
			$pesan = "Mengirim tindak lanjut monitoring dan evaluasi";
			$link = "monev/v/$status_verifikasi/$id_dipa/".hashids_encrypt($id_for_link);
		}

		$data_notif = array(
			'pesan'				=> $pesan,
			'link'				=> $link,
			'status'			=> "belum dibaca",
			'id_user_pengirim'	=> $pengirim,
			'id_user_penerima'	=> $penerima,
			'id_for_link'		=> $id_for_link

		);

		$this->Guzzle_model->createNotifikasi($data_notif);
	}

	function update_notif($notif) {
		$data_notif = array(
			'pesan'				=> $notif['pesan'],
			'link'				=> $notif['link'],
			'status'			=> "sudah dibaca",
			'id_user_pengirim'	=> $notif['id_user_pengirim'],
			'id_user_penerima'	=> $notif['id_user_penerima'],
			'id_for_link'		=> $notif['id_for_link']

		);
		$this->Guzzle_model->updateNotifikasi($notif['id'], $data_notif);
	}

	function cek_verifikasi_usulan_revisi_dipa($id_dipa, $id_user, $id_usulan_verifikasi_dipa) {
		$verifikasi_array = $this->Guzzle_model->getRevisiDipaByDipaIdUserId($id_dipa, $id_user);

		$verifikasi_filter = array_filter($verifikasi_array, function($key) use ($id_usulan_verifikasi_dipa) {
			return ($key['id'] == $id_usulan_verifikasi_dipa);
		});

		foreach ($verifikasi_filter as $key => $value) {
			$status = $value['status_verifikasi'];
		}

		if (count($verifikasi_filter) != 0 AND $status != 'sudah') {
			$result = true;
		} else {
			$result = false;
		}

		return $result;
	}

	public function persen($realisasi, $total) {
		 $persen = ($realisasi / $total) * 100;
		 if ($total == 0) {
			 $persen = 0;
		 }
		 return $persen;
	}

	public function status_ob($status) {
		if($status == 'SUDAH') { 
            echo '<label class="label label-success">SUDAH DIBERSIHKAN</label>';
        } elseif($status == 'BELUM') {
            echo '<label class="label label-danger">BELUM DIBERSIHKAN</label>';
        } 
	}

	public function status_pengawas($status) {
		if($status == 'SUDAH') { 
            echo '<label class="label label-success">SUDAH DIBERSIHKAN</label>';
        } elseif($status == 'BELUM') {
            echo '<label class="label label-warning">BELUM DIPERIKSA</label>';
        }
	}

	public function zona() {
        $data = $this->Guzzle_model->getAllZona();
        return $data;
	}
	
}
