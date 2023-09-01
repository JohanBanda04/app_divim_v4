<?php

function tgl_sql($date){
    $exp=explode("-",$date);
    if(count($exp) == 3){
        $bln_indo = getBulan($exp[1]);
//        $date = $exp[2].'-'.$exp[1].'-'.$exp[0];
        $date = $exp[2].'-'.$bln_indo.'-'.$exp[0];
    }
    return $date;
}

function getBulan($bln)
{
    switch ($bln) {
        case 1:
            return "Januari";
            break;
        case 2:
            return "Februari";
            break;
        case 3:
            return "Maret";
            break;
        case 4:
            return "April";
            break;
        case 5:
            return "Mei";
            break;
        case 6:
            return "Juni";
            break;
        case 7:
            return "Juli";
            break;
        case 8:
            return "Agustus";
            break;
        case 9:
            return "September";
            break;
        case 10:
            return "Oktober";
            break;
        case 11:
            return "November";
            break;
        case 12:
            return "Des";
            break;
    }
}

function tgl_id($date, $bln='')
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

function tgl_indo($date){
    $exp = explode("-",$date);
    $date = "";
    if(count($exp)>0){
        $bulan = getBulan($exp[1]);
        $data = $exp[2]." ".$bulan." ".$exp[0];
    }
    return $data;
}

function hari_id($tanggal)
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





?>