<?php ob_start(); ?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>


<table>
    <tr style="margin-top: 20px; ">
        <td style="width: 100px; align=center; margin-top: 100px; background-color: grey ">
            <img src="./assets/img/kumhamrad.png" width="100" height="100" alt="">
        </td>

        <td style="width: 630px; margin-top: 10px; background-color: yellow ">
            <div style="text-align: center">

                <span style="font-weight: bold">KEMENTERIAN HUKUM DAN HAK ASASI MANUSIA</span>
                <br>
                <span style="font-weight: bold">REPUBLIK INDONESIA</span>
                <br>
                <span style="font-weight: bold">KANTOR WILAYAH NUSA TENGGARA BARAT</span>
                <br>
                <span style="">Jalan Majapahit No. 44 Mataram</span>
                <br>
                <span style="">Telepon : 0370 – 7856244</span>
                <br>
                <span style="">Lamann : ntb.kemenkumham.go.id, Surel : kanwilntb@kemenkumham.go.id</span>
            </div>
        </td>
    </tr>

    <hr>
</table>
<table>
    <tr style="margin-top: 20px; ">


        <td style="width: 740px; margin-top: 10px; background-color: #00AAFF">
            <br>
            <div style="text-align: center">

                <span style="font-weight: bold; font-size: 20px">
                    <?= $judul_sub_menu;?>
                </span>
                <br>
                <br>
                <span style="font-weight: bold; font-size: 15px">
                    <?php
                    $str = explode('-', $tgl_awal_idn);
                    $tgl = $str[0];
                    $bln = $str[1];
                    $thn = $str[2];

                    echo $tgl." ".$bln." ".$thn;
                    ?>
                </span>
                <span style="font-size: 15px; font-weight: bold">
                    s.d.
                </span>
                <span style="font-weight: bold; font-size: 15px">
                    <?php
                    $str = explode('-', $tgl_akhir_idn);
                    $tgl = $str[0];
                    $bln = $str[1];
                    $thn = $str[2];

                    echo $tgl." ".$bln." ".$thn;
                    ?>
                </span>
            </div>
        </td>
    </tr>




</table>

<?php
//deklarasi array bantuan
$array_b = array();
$array_c = array();
$array_hari = array();
$array_hari_waktu = array();
$array_waktu = array();
$array_group_hari = array();
$array_group_hari_2 = array();
$array_get_agenda_by_hari = array();


foreach ($laporan_agenda_data as $index => $data) {
    $tahun = substr($data['tanggal'], 0, 4);
//    echo $tahun; exit;
    $bulan = "" . $this->Mcrud->getBulanIdOnly($data['tanggal']);
    $waktu = $data['waktu'];
    $pekan = "Pekan-" . $this->Mcrud->weekOfMonth(strtotime($data['tanggal']));
    $hari = "Hari-" . $this->Mcrud->hari_id($data['tanggal']);
    $bulanpekantahun = $bulan . " " . $tahun . " / " . $pekan;
    $bulanpekantahunhari = $hari . "/" . $bulan . " " . $tahun . " / " . $pekan;
    $bulanpekantahunhariwaktu = $hari . "/" . $bulan . " " . $tahun . " / " . $pekan . " / " . $waktu;
    $tgl = "";

//    echo "bulans".$bulan;

    if (!in_array($bulanpekantahun, $array_b)) {
        array_push($array_b, $bulanpekantahun);

    }

//    echo count($array_b)."count array b"; exit;

//    foreach ($array_b as $id => $val){
//        echo $val;
//    }

    if (!in_array($bulanpekantahunhariwaktu, $array_c)) {
        array_push($array_c, $bulanpekantahunhariwaktu);
    }
}

$hari_tgl_temp = "";
//echo count($array_b);
?>

<?php

//    echo "array b: ".count($array_b);
foreach ($array_b as $index => $val) {
    foreach ($laporan_agenda_data as $id => $dt) {
//        foreach ($laporan_agenda_data as $id => $dt){
//            echo $dt;
//        } exit;
        $tahuns = substr($dt['tanggal'], 0, 4);
        $hari_tgl = $dt['tanggal'];
        $bulans = $this->Mcrud->getBulanIdOnly($dt['tanggal']);
        $pekans = "Pekan-" . $this->Mcrud->weekOfMonth(strtotime($dt['tanggal']));
        $bulanpekantahuns = $bulans . " " . $tahuns . " / " . $pekans;
        $bulanpekantahunharis = $hari_tgl . " / " . $bulans . " " . $tahuns . " / " . $pekans;

        if ($val == $bulanpekantahuns) {
            //$array_hari data agenda per 1 pekan
            array_push($array_hari, (object)[
                "nama" => $dt['nama'],
                "deskripsi" => $dt['deskripsi'],
                "tanggal" => $dt['tanggal'],
                "waktu" => $dt['waktu'],
                "tempat" => $dt['tempat'],
                "pakaian" => $dt['pakaian'],
                "peserta" => $dt['peserta'],
            ]);
        }
    }

    foreach ($array_hari as $idx => $valx) {
        $thn = substr($valx->tanggal, 0, 4);
        $bln = $this->Mcrud->getBulanIdOnly($valx->tanggal);
        $pkn = "Pekan-" . $this->Mcrud->weekOfMonth(strtotime($valx->tanggal));
        $hri = $this->Mcrud->hari_id($valx->tanggal);

        $thn_bln_pkn_hri = $thn . "/" . $bln . "/" . $pkn . "/" . $hri;

        if (!in_array($thn_bln_pkn_hri, $array_group_hari)) {
            array_push($array_group_hari, $thn_bln_pkn_hri);
        }
    }


    foreach ($array_group_hari as $ide => $vale) {
//        $pdf->Cell(192, 8, $vale, 1, $ln=0, 'C', 1, '', 0, false, 'A', 'C');
//        $pdf->Ln();
        foreach ($laporan_agenda_data as $idr => $valr) {
            $thnr = substr($valr['tanggal'], 0, 4);
            $blnr = $this->Mcrud->getBulanIdOnly($valr['tanggal']);
            $pknr = "Pekan-" . $this->Mcrud->weekOfMonth(strtotime($valr['tanggal']));
            $hrir = $this->Mcrud->hari_id($valr['tanggal']);

            $thn_bln_pkn_hrir = $thnr . "/" . $blnr . "/" . $pknr . "/" . $hrir;

            if ($vale == $thn_bln_pkn_hrir) {
                array_push($array_get_agenda_by_hari, (object)[
                    "nama" => $valr['nama'],
                    "deskripsi" => $valr['deskripsi'],
                    "tanggal" => $valr['tanggal'],
                    "waktu" => $valr['waktu'],
                    "jam_mulai" => $valr['jam_mulai'],
                    "jam_selesai" => $valr['jam_selesai'],
                    "tempat" => $valr['tempat'],
                    "pakaian" => $valr['pakaian'],
                    "peserta" => $valr['peserta'],
                ]);
            }

        }
    }

//    $pdf->SetLineStyle(array('width' => 0.3, 'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => array(0, 0, 0)));
//    $pdf->SetTextColor(0, 0, 0);
//    $pdf->setFont('helvetica', 'B', 9);
//    $pdf->SetFillColor(172, 166, 213);


    //header bulan dan pekan
//    $pdf->Cell(192, 8, $val, 1, $ln = 0, 'C', 1, '', 0, false, 'A', 'C');
    /*ini dia header bulan dan pekan: */
    ?>
    <table style="border: 1px solid black">
        <tr style="margin-top: 20px; border: 1px solid black">


            <td style="width: 740px; margin-top: 10px; background-color: #00AAFF;">
                <br>
                <div style="text-align: center;">

                    <!--ini dia header bulan tahun / pekan-sekian di html2pdf-->
                <span style="font-weight: bold; font-size: 15px; background-color: #1e2b37; ">
                    <?php echo $val; ?>

                </span>
                    <br>
                    <br>
                    <span style="font-weight: bold; font-size: 20px; ">
                    <?php

foreach ($array_group_hari as $i => $v) {
    ?>

    <?php
    $get_hari = explode('/', $v);
    ?>
                <!--ini dia header hari di html2pdf-->
                <span style="font-weight: bold; font-size: 15px; background-color: #2C3E50;">
                    <?php echo $get_hari[3]; ?>
                </span>
    <br>
    <br>



    <?php
//        echo $v;
//    $get_hari = explode('/', $v);
//            $pdf->MultiCell(192, 8, $get_hari[3], 1, 'C', 1, 0, '', '', true);
//        $pdf->SetFillColor(229, 246, 118);
//        $pdf->setFont('helvetica', 'B', 9);
    //header hari
//        $pdf->Cell(192, 8, $get_hari[3], 1, $ln = 0, 'C', 1, '', 0, false, 'A', 'C');
    /*ini dia header hari :*/
//        $pdf->MultiCell(192, 8, $get_hari[3], 1, 'C', 1, 0, '', '', true);
//        $pdf->Ln();
//        $pdf->SetFillColor(172, 166, 213);
    //header komponen agenda kegiatan
//        $pdf->Cell(33, 8, "Hari / Tgl", 1, $ln = 0, 'C', 1, '', 0, false, 'A', 'C');
//        $pdf->Cell(30, 8, "Jam", 1, $ln = 0, 'C', 1, '', 0, false, 'A', 'C');
//        $pdf->Cell(50, 8, "Kegiatan", 1, $ln = 0, 'C', 1, '', 0, false, 'A', 'C');
//        $pdf->Cell(42, 8, "Tempat", 1, $ln = 0, 'C', 1, '', 0, false, 'A', 'C');
//        $pdf->Cell(37, 8, "Keterangan", 1, $ln = 0, 'C', 1, '', 0, false, 'A', 'C');
//        $pdf->Ln();

//        $pdf->MultiCell(33, 8, "Hari / Tgl", 1, 'C', 0, 0, '', '', true);
//        $pdf->MultiCell(30, 8, "Jam", 1, 'C', 0, 0, '', '', true);
//        $pdf->MultiCell(50, 8, "Kegiatan", 1, 'C', 0, 0, '', '', true);
//        $pdf->MultiCell(42, 8, "Tempat", 1, 'C', 0, 0, '', '', true);
//        $pdf->MultiCell(37, 8, "Keterangan", 1, 'C', 0, 0, '', '', true);
//        $pdf->Ln();
    foreach ($array_get_agenda_by_hari as $idt => $valt) {
        $thnt = substr($valt->tanggal, 0, 4);
        $blnt = $this->Mcrud->getBulanIdOnly($valt->tanggal);
        $pknt = "Pekan-" . $this->Mcrud->weekOfMonth(strtotime($valt->tanggal));
        $hrit = $this->Mcrud->hari_id($valt->tanggal);

        $thn_bln_pkn_hrit = $thnt . "/" . $blnt . "/" . $pknt . "/" . $hrit;
        if ($v == $thn_bln_pkn_hrit) {
//                $pdf->setAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
//                $pdf->SetFillColor(255, 255, 255);
//                $pdf->setFont('helvetica', '', 9);
//                $max_width = 45;
//                $row_height = 3.5;
//                $text_width = $pdf->GetStringWidth($valt->nama,"","");


//                $pdf->Cell(33, 8, $this->Mcrud->hari_id($valt->tanggal) . " / " . $this->Mcrud->tgl_idn($valt->tanggal, 'full'), 1, $ln = 0, 'C', 1, '', 0, false, 'A', 'C');
//                $pdf->Cell(30, 8, substr($valt->jam_mulai, 0, 5) . "-" . substr($valt->jam_selesai, 0, 5), 1, $ln = 0, 'C', 1, '', 0, false, 'A', 'C');
//                $pdf->Cell(50, 8, $valt->nama, 1, $ln = 0, 'C', 1, '', 0, false, 'A', 'C');
//                $pdf->Cell(42, 8, $valt->tempat, 1, $ln = 0, 'C', 1, '', 0, false, 'A', 'C');
//                $pdf->Cell(37, 8, $valt->peserta, 1, $ln = 0, 'C', 1, '', 0, false, 'A', 'C');
//                $pdf->Ln();

//                $pdf->MultiCell(33, 8, $this->Mcrud->hari_id($valt->tanggal) . " / " . $this->Mcrud->tgl_idn($valt->tanggal, 'full'), 1, 'L', 1, 0, '', '', true);
//                $pdf->MultiCell(30, 8, substr($valt->jam_mulai, 0, 5) . "-" . substr($valt->jam_selesai, 0, 5), 1, 'C', 1, 0, '', '', true);
//                $pdf->MultiCell(50, 8, $valt->nama, 1, 'C', 1, 0, '', '', true);
//                $pdf->MultiCell(42, 8, $valt->tempat, 1, 'C', 1, 0, '', '', true);
//                $pdf->MultiCell(37, 8, $valt->peserta, 1, 'C', 1, 0, '', '', true);
//                $pdf->Ln();
        }

    }

//        $pdf->SetFillColor(255, 255, 255);

}
                    ?>

                </span>

                </div>
            </td>

        </tr>


    </table>
    <?php
//    $pdf->setMargins(10,10,9,false);
//    $pdf->MultiCell(192, 8, $val, 1, 'C', 1, 0, "", "", true);
//    $pdf->Ln();

    //enter pemisah perpekan
//    $pdf->Ln();

    $array_get_agenda_by_hari = array();
    $array_hari = array();
    $array_group_hari = array();

}
?>



<!--testers-->

</body>
</html>




