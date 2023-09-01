<?php
//============================================================+
// File name   : example_003.php
// Begin       : 2008-03-04
// Last Update : 2013-05-14
//
// Description : Example 003 for TCPDF class
//               Custom Header and Footer
//
// Author: Nicola Asuni
//
// (c) Copyright:
//               Nicola Asuni
//               Tecnick.com LTD
//               www.tecnick.com
//               info@tecnick.com
//============================================================+

/**
 * Creates an example PDF TEST document using TCPDF
 * @package com.tecnick.tcpdf
 * @abstract TCPDF - Example: Custom Header and Footer
 * @author Nicola Asuni
 * @since 2008-03-04
 */

// Include the main TCPDF library (search for installation path).
//require_once('tcpdf_include.php');
$this->load->library('session');

// Extend the TCPDF class to create custom Header and Footer
class MYPDF extends TCPDF
{

    //Page header
    public function Header()
    {
        //set Gambar ketika menemukan last page
//        $image_file = K_PATH_IMAGES.'kumhamrad.png';
//        $this->Image($image_file, 100, 100, 26, 31, 'PNG', '', 'T', false, 300, '', false, false, 0, false, false, false);
//        $this->setFont('helvetica', 'B', 10);
        if ($this->page == 1) {
            $image_file = K_PATH_IMAGES . 'kumhamrad.png';
            $this->Image($image_file, 18, 13, 26, 31, 'PNG', '', 'T', false, 300, '', false, false, 0, false, false, false);
            // Set font
            $this->setFont('helvetica', 'B', 10);
            // Title
            $this->Ln(4);
            $this->Cell(0, 15, 'KEMENTERIAN HUKUM DAN HAK ASASI MANUSIA', 0, false, 'C', 0, '', 0, false, 'M', 'M');
            $this->Ln(5);
            $this->Cell(0, 15, 'REPUBLIK INDONESIA', 0, false, 'C', 0, '', 0, false, 'M', 'M');
            $this->Ln(5);
            $this->Cell(0, 15, 'KANTOR WILAYAH NUSA TENGGARA BARAT', 0, false, 'C', 0, '', 0, false, 'M', 'M');
            $this->Ln(5);
            $this->setFont('helvetica', '', 10);
            $this->Cell(0, 15, 'Jalan Majapahit No. 44 Mataram', 0, false, 'C', 0, '', 0, false, 'M', 'M');
            $this->Ln(5);
            $this->Cell(0, 15, 'Telepon : 0370 – 7856244', 0, false, 'C', 0, '', 0, false, 'M', 'M');
            $this->Ln(5);
            $this->Cell(0, 15, 'Lamanz : ntb.kemenkumham.go.id, Surel : kanwilntb@kemenkumham.go.id', 0, false, 'C', 0, '', 0, false, 'M', 'M');
            $this->Ln(10);
//        $style_up = array('width' => 0.5, 'line' => '2,2,2,2', 'phase' => 1, 'color' => array(0, 0, 0));
//        $this->Line(10, 40, 200, 40, $style_up);
            $style = array('width' => 1.0, 'line' => '2,2,2,2', 'phase' => 1, 'color' => array(0, 0, 0));
            $this->Line(10, 45, 200, 45, $style);

            $this->setFont('helvetica', 'B', 15);
            $this->Cell(0, 15,
                'Laporan Agenda',
                0,
                false,
                'C',
                0,
                '',
                0,
                false,
                'M', 'M');
            $this->Ln(10);
            $this->setFont('helvetica', '', 10);
            $this->Ln(7);

            $this->setFont('helvetica', '', 10);
        }

        //cuyss

    }

    // Page footer
    public function Footer_bk()
    {
        $this->setY(-15);
        // Set font
        $this->setFont('helvetica', 'I', 8);
        if ($this->lastPage(true)) {
            $this->Cell(173, 10, ' FOOTER TEST ssss -  {nb}', 0, 0);
        }
        // Position at 15 mm from bottom

        // Page number
        $this->Cell(0, 10, 'Page ' . $this->getAliasNumPage() . '/' . $this->getAliasNbPages(), 0, false, 'C', 0, '', 0, false, 'T', 'M');

    }


    public function Footer()
    {
        $tpages = $this->getAliasNbPages();
        $pages = $this->getPage();

        $footer = $pages . " / " . $tpages;

        if ($pages == 1) {
//            $footer = 'FIRST' . $pages .'/'. $tpages;
            $footer = $pages . '/' . $tpages;
        }
        $this->Cell(0, 10, $footer, 0, false, 'C', 0, '', 0, false, 'T', 'M');
    }


}

// create new PDF document
$pdf = new MYPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
$pdf->setCreator(PDF_CREATOR);
$pdf->setAuthor('Nicola Asuni');
$pdf->setTitle('Cetak Laporan');
$pdf->setSubject('TCPDF Tutorial');
$pdf->setKeywords('TCPDF, PDF, example, test, guide');

// set default header data
$pdf->setHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE, PDF_HEADER_STRING);

// set header and footer fonts
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// set default monospaced font
$pdf->setDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
$pdf->setMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->setHeaderMargin(PDF_MARGIN_HEADER);
$pdf->setFooterMargin(PDF_MARGIN_FOOTER);
$pdf->setLeftMargin(9);

// set auto page breaks
$pdf->setAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

// set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// set some language-dependent strings (optional)
if (@file_exists(dirname(__FILE__) . '/lang/eng.php')) {
    require_once(dirname(__FILE__) . '/lang/eng.php');
    $pdf->setLanguageArray($l);
}

// ---------------------------------------------------------

// set font
//$pdf->setFont('times', '', 12);
$pdf->setFont('helvetica', 'B', 12);
// add a page
$pdf->AddPage();

$pdf->Ln(30);

// set some text to print
$txt = <<<EOD
Laporan Jadwal Kegiatan
EOD;


$txt = $this->session->userdata('tgl_awal_idn') . ' S.D. ' . $this->session->userdata('tgl_akhir_idn');


// print a block of text using Write()
$pdf->Write(0, $txt, '', 0, 'C', true, 0, false, false, 0);

//dari sini
$pdf->setFont('helvetica', 'B', 9);
$pdf->SetLineStyle(array('width' => 0.5, 'cap' => 'butt', 'join' => 'miter', 'dash' => 4, 'color' => array(0, 0, 0)));
$pdf->SetFillColor(255, 255, 128);
$pdf->SetTextColor(0, 0, 128);

$text = "DUMMY";
$pdf->Ln(10);

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
    $bulan = "" . $this->Mcrud->getBulanIdOnly($data['tanggal']);
    $waktu = $data['waktu'];
    $pekan = "Pekan-" . $this->Mcrud->weekOfMonth(strtotime($data['tanggal']));
    $hari = "Hari-" . $this->Mcrud->hari_id($data['tanggal']);
    $bulanpekantahun = $bulan . " " . $tahun . " / " . $pekan;
    $bulanpekantahunhari = $hari . "/" . $bulan . " " . $tahun . " / " . $pekan;
    $bulanpekantahunhariwaktu = $hari . "/" . $bulan . " " . $tahun . " / " . $pekan . " / " . $waktu;
    $tgl = "";

    if (!in_array($bulanpekantahun, $array_b)) {
        array_push($array_b, $bulanpekantahun);

    }

    if (!in_array($bulanpekantahunhariwaktu, $array_c)) {
        array_push($array_c, $bulanpekantahunhariwaktu);
    }
}

$hari_tgl_temp = "";

foreach ($array_b as $index => $val) {
    foreach ($laporan_agenda_data as $id => $dt) {
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

    $pdf->SetLineStyle(array('width' => 0.3, 'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => array(0, 0, 0)));
    $pdf->SetTextColor(0, 0, 0);
    $pdf->setFont('helvetica', 'B', 9);
    $pdf->SetFillColor(172, 166, 213);

    //header bulan dan pekan
//    $pdf->Cell(192, 8, $val, 1, $ln = 0, 'C', 1, '', 0, false, 'A', 'C');
    $pdf->MultiCell(197, 8, $val, 1, 'C', 1, 0, "", "", true);
    $pdf->Ln();
    foreach ($array_group_hari as $i => $v) {

        $get_hari = explode('/', $v);
        $pdf->SetFillColor(229, 246, 118);
        $pdf->setFont('helvetica', 'B', 9);
        //header hari
//        $pdf->Cell(192, 8, $get_hari[3], 1, $ln = 0, 'C', 1, '', 0, false, 'A', 'C');

        $pdf->MultiCell(197, 8, $get_hari[3], 1, 'C', 1, 0, '', '', true);
        $pdf->Ln();
        $pdf->SetFillColor(172, 166, 213);
        //header komponen agenda kegiatan
//        $pdf->Cell(33, 8, "Hari / Tgl", 1, $ln = 0, 'C', 1, '', 0, false, 'A', 'C');
//        $pdf->Cell(30, 8, "Jam", 1, $ln = 0, 'C', 1, '', 0, false, 'A', 'C');
//        $pdf->Cell(50, 8, "Kegiatan", 1, $ln = 0, 'C', 1, '', 0, false, 'A', 'C');
//        $pdf->Cell(42, 8, "Tempat", 1, $ln = 0, 'C', 1, '', 0, false, 'A', 'C');
//        $pdf->Cell(37, 8, "Keterangan", 1, $ln = 0, 'C', 1, '', 0, false, 'A', 'C');
//        $pdf->Ln();

        $pdf->MultiCell(33, 8, "Hari / Tgl", 1, 'C', 0, 0, '', '', true);
        $pdf->MultiCell(30, 8, "Jam", 1, 'C', 0, 0, '', '', true);
        $pdf->MultiCell(50, 8, "Kegiatan", 1, 'C', 0, 0, '', '', true);
        $pdf->MultiCell(42, 8, "Tempat", 1, 'C', 0, 0, '', '', true);
        $pdf->MultiCell(42, 8, "Keterangan", 1, 'C', 0, 0, '', '', true);
        $pdf->Ln();
        foreach ($array_get_agenda_by_hari as $idt => $valt) {
            $thnt = substr($valt->tanggal, 0, 4);
            $blnt = $this->Mcrud->getBulanIdOnly($valt->tanggal);
            $pknt = "Pekan-" . $this->Mcrud->weekOfMonth(strtotime($valt->tanggal));
            $hrit = $this->Mcrud->hari_id($valt->tanggal);

            $thn_bln_pkn_hrit = $thnt . "/" . $blnt . "/" . $pknt . "/" . $hrit;
            if ($v == $thn_bln_pkn_hrit) {
//                $pdf->setAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
                $pdf->SetFillColor(255, 255, 255);
                $pdf->setFont('helvetica', '', 9);
                $max_width = 45;
                $row_height = 3.5;
                $text_width = $pdf->GetStringWidth($valt->nama,"","");


//                $pdf->Cell(33, 8, $this->Mcrud->hari_id($valt->tanggal) . " / " . $this->Mcrud->tgl_idn($valt->tanggal, 'full'), 1, $ln = 0, 'C', 1, '', 0, false, 'A', 'C');
//                $pdf->Cell(30, 8, substr($valt->jam_mulai, 0, 5) . "-" . substr($valt->jam_selesai, 0, 5), 1, $ln = 0, 'C', 1, '', 0, false, 'A', 'C');
//                $pdf->Cell(50, 8, $valt->nama, 1, $ln = 0, 'C', 1, '', 0, false, 'A', 'C');
//                $pdf->Cell(42, 8, $valt->tempat, 1, $ln = 0, 'C', 1, '', 0, false, 'A', 'C');
//                $pdf->Cell(37, 8, $valt->peserta, 1, $ln = 0, 'C', 1, '', 0, false, 'A', 'C');
//                $pdf->Ln();

                $pdf->MultiCell(33, 14, $this->Mcrud->hari_id($valt->tanggal) . " / " . $this->Mcrud->tgl_idn($valt->tanggal, 'full'), 1, 'L', 1, 0, '', '', true);
                $pdf->MultiCell(30, 14, substr($valt->jam_mulai, 0, 5) . "-" . substr($valt->jam_selesai, 0, 5), 1, 'C', 1, 0, '', '', true);
                $pdf->MultiCell(50, 14, $valt->nama, 1, 'C', 1, 0, '', '', true);
                $pdf->MultiCell(42, 14, $valt->tempat, 1, 'C', 1, 0, '', '', true);
                $pdf->MultiCell(42, 14, $valt->peserta, 1, 'C', 1, 0, '', '', true);
                $pdf->Ln();
            }

        }

        $pdf->SetFillColor(255, 255, 255);

    }
    //enter pemisah perpekan
    $pdf->Ln();

    $array_get_agenda_by_hari = array();
    $array_hari = array();
    $array_group_hari = array();

}
//$pdf->AddPage();
$pdf->setFont('helvetica', 'B', 10);
$pdf->Ln();
$pdf->setLeftMargin(150);
$pdf->Cell(25, 8, 'Mataram, ' . ($this->Mcrud->hari_id(date('Y-m-d'))) . ' ' . ($this->Mcrud->tgl_idn(date('Y-m-d'), 'full')), 0, $ln = 0, 'C', 1, '', 0, false, 'A', 'C');
$pdf->Ln(7);
$pdf->Cell(25, 8, 'Kepala Divisi Administrasi,', 0, $ln = 0, 'C', 1, '', 0, false, 'A', 'C');

$pdf->setFont('helvetica', '', 10);
$pdf->Ln(23);
$pdf->Cell(25, 8, 'Anton Edward Wardhana, S.Kom., M.Si.', 0, $ln = 0, 'C', 1, '', 0, false, 'A', 'C');
$pdf->Ln(7);
$pdf->Cell(25, 8, 'NIP. 197407041999031001', 0, $ln = 0, 'C', 1, '', 0, false, 'A', 'C');
$pdf->Ln();

//Close and output PDF document
//$pdf->Output('example_003.pdf', 'I');
$hari_ini = date("Y-m-d");
$hari_ini_id = $this->Mcrud->tgl_id_new($hari_ini, 'full');
$pdf->Output("LaporanAgenda" . $hari_ini_id . ".pdf", 'I');
//$pdf->Output("CetakLaporanAgenda".$hari_ini_id.".pdf", 'D');

//============================================================+
// END OF FILE
//============================================================+
