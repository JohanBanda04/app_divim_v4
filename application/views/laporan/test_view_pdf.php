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
class MYPDF extends TCPDF {

    //Page header
    public function Header() {
        //set Gambar ketika menemukan last page
//        $image_file = K_PATH_IMAGES.'kumhamrad.png';
//        $this->Image($image_file, 100, 100, 26, 31, 'PNG', '', 'T', false, 300, '', false, false, 0, false, false, false);
//        $this->setFont('helvetica', 'B', 10);
        if($this->page==1){
            $image_file = K_PATH_IMAGES.'kumhamrad.png';
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
            $this->Cell(0, 15, 'Laman : ntb.kemenkumham.go.id, Surel : kanwilntb@kemenkumham.go.id', 0, false, 'C', 0, '', 0, false, 'M', 'M');
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
    public function Footer_bk() {
        $this->setY(-15);
        // Set font
        $this->setFont('helvetica', 'I', 8);
        if($this->lastPage(true)){
            $this->Cell(173,10, ' FOOTER TEST ssss -  {nb}', 0, 0);
        }
        // Position at 15 mm from bottom

        // Page number
        $this->Cell(0, 10, 'Page '.$this->getAliasNumPage().'/'.$this->getAliasNbPages(), 0, false, 'C', 0, '', 0, false, 'T', 'M');

    }


    public function Footer() {
        $tpages = $this->getAliasNbPages();
        $pages = $this->getPage();

        $footer = 'LAST' . $pages . $tpages;

        if ($pages == 1 ) {
//            $footer = 'FIRST' . $pages .'/'. $tpages;
            $footer =  $pages .'/'. $tpages;
        }
        $this->Cell(0, 10, $footer, 0, false, 'C', 0, '', 0, false, 'T', 'M');
    }



}

// create new PDF document
$pdf = new MYPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
$pdf->setCreator(PDF_CREATOR);
$pdf->setAuthor('Nicola Asuni');
$pdf->setTitle('TCPDF Example 003');
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
if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
    require_once(dirname(__FILE__).'/lang/eng.php');
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


$txt = $this->session->userdata('tgl_awal_idn').' S.D. '.$this->session->userdata('tgl_akhir_idn');


// print a block of text using Write()
$pdf->Write(0, $txt, '', 0, 'C', true, 0, false, false, 0);

//dari sini
$pdf->setFont('helvetica', 'B', 9);
$pdf->SetLineStyle(array('width' => 0.5, 'cap' => 'butt', 'join' => 'miter', 'dash' => 4, 'color' => array(0, 0, 0)));
$pdf->SetFillColor(255,255,128);
$pdf->SetTextColor(0,0,128);

$text="DUMMY";

//        $this->Cell(0, 0, $text, 1, 1, 'L', 1, 0);
// simple = taruh function weekOfMonth dan weekOfYear di Mcrud
$pdf->Ln(10);
//atur left margin disini
$pdf->setLeftMargin(10);
//hasil in_array (cara group by manual) dari controlleh Laporan.php
//foreach ($b as $index=>$dt){
//    $pdf->SetLineStyle(array('width' => 0.3, 'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => array(0, 0, 0)));
//    $pdf->SetFillColor(170, 170, 170 );
//    $pdf->SetTextColor(0,0,0);
//    $pdf->Cell(13, 8, $dt, 1, $ln=0, 'C', 1, '', 0, false, 'A', 'C');
//}
$pdf->Ln();

$pdf->SetLineStyle(array('width' => 0.3, 'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => array(0, 0, 0)));
$pdf->SetFillColor(170, 170, 170 );
$pdf->SetTextColor(0,0,0);
//nanti cek parameter border mulai disini
//$pdf->MultiCell(10, 8, 'No', 1, 'C', 1, 0);
$pdf->setLeftMargin(10);
$pdf->Cell(7, 8, 'No', 1, $ln=0, 'C', 1, '', 0, false, 'A', 'C');

$pdf->SetLineStyle(array('width' => 0.3, 'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => array(0, 0, 0)));
$pdf->SetFillColor(170, 170, 170 );
$pdf->SetTextColor(0,0,0);
//tambahan kolom disini
$pdf->Cell(29, 8, 'Bulan / Pekan', 1, $ln=0, 'C', 1, '', 0, false, 'A', 'C');

//$pdf->SetLineStyle(array('width' => 0.3, 'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => array(0, 0, 0)));
$pdf->SetFillColor(170, 170, 170 );
$pdf->SetTextColor(0,0,0);
//$pdf->MultiCell(35, 8, 'Hari \ Tgl', 1, 'C', 1, 0);
$pdf->Cell(32, 8, 'Hari \ Tgl', 1, $ln=0, 'C', 1, '', 0, false, 'A', 'C');

//$pdf->SetLineStyle(array('width' => 0.3, 'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => array(0, 0, 0)));
$pdf->SetFillColor(170, 170, 170 );
$pdf->SetTextColor(0,0,0);
//$pdf->MultiCell(20, 8, 'Jam', 1, 'C', 1, 0);
$pdf->Cell(12, 8, 'Jam', 1, $ln=0, 'C', 1, '', 0, false, 'A', 'C');

//$pdf->SetLineStyle(array('width' => 0.3, 'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => array(0, 0, 0)));
$pdf->SetFillColor(170, 170, 170 );
$pdf->SetTextColor(0,0,0);
//$pdf->MultiCell(40, 8, 'Kegiatan', 1, 'C', 1, 0);
$pdf->Cell(37, 8, 'Kegiatan', 1, $ln=0, 'C', 1, '', 0, false, 'A', 'C');


//$pdf->SetLineStyle(array('width' => 0.3, 'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => array(0, 0, 0)));
$pdf->SetFillColor(170, 170, 170 );
$pdf->SetTextColor(0,0,0);
//$pdf->MultiCell(40, 8, 'Tempat', 1, 'C', 1, 0);
$pdf->Cell(37, 8, 'Tempat', 1, $ln=0, 'C', 1, '', 0, false, 'A', 'C');

//$pdf->SetLineStyle(array('width' => 0.3, 'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => array(0, 0, 0)));
$pdf->SetFillColor(170, 170, 170 );
$pdf->SetTextColor(0,0,0);
//$pdf->MultiCell(35, 8, 'Keterangan', 1, '', 1, 0);
$pdf->Cell(35, 8, 'Peserta', 1, $ln=0, 'C', 1, '', 0, false, 'A', 'C');
$pdf->Ln();

foreach ($laporan_agenda_data as $index=>$data){
    $pdf->SetLineStyle(array('width' => 0.3, 'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => array(0, 0, 0)));
    $pdf->SetFillColor(170, 170, 170 );
    $pdf->SetTextColor(0,0,0);

//nanti cek parameter border mulai disini
//$pdf->MultiCell(10, 8, 'No', 1, 'C', 1, 0);
    $pdf->setFont('helvetica', 'B', 9);
    $pdf->Cell(7, 8, ($index+1), 1, $ln=0, 'C', 1, '', 0, false, 'A', 'C');
    $pdf->SetFillColor(255, 255, 255 );
    $pdf->Cell(29, 8, $this->Mcrud->getBulanIdOnly($data['tanggal'])." / "."Pekan"."-"."".$this->Mcrud->weekOfMonth(strtotime($data['tanggal'])), 1, $ln=0, 'C', 1, '', 0, false, 'A', 'C');

    //taruhsini
    $pdf->setFont('helvetica', '', 9);
    $pdf->Cell(32, 8,$this->Mcrud->hari_id($data['tanggal']) .' / '.($this->Mcrud->tgl_id($data['tanggal'], 'full')), 1, $ln=0, 'C', 1, '', 0, false, 'A', 'C');
    $pdf->Cell(12, 8,substr($data['waktu'],0,5), 1, $ln=0, 'C', 1, '', 0, false, 'A', 'C');
    $pdf->Cell(37, 8,$data['nama'], 1, $ln=0, 'C', 1, '', 0, false, 'A', 'C');
    $pdf->Cell(37, 8,$data['tempat'], 1, $ln=0, 'C', 1, '', 0, false, 'A', 'C');
    $pdf->Cell(35, 8,$data['peserta'], 1, $ln=0, 'C', 1, '', 0, false, 'A', 'C');
    $pdf->Ln();
}

$pdf->setFont('helvetica', 'B', 10);
$pdf->Ln(15);
$pdf->setLeftMargin(150);
$pdf->Cell(25, 8, 'Mataram, '.($this->Mcrud->hari_id(date('Y-m-d'))).' '.($this->Mcrud->tgl_idn(date('Y-m-d'), 'full')), 0, $ln=0, 'C', 1, '', 0, false, 'A', 'C');
$pdf->Ln(8);
$pdf->Cell(25, 8, 'Kepala Divisi Administrasi,', 0, $ln=0, 'C', 1, '', 0, false, 'A', 'C');

$pdf->setFont('helvetica', '', 10);
$pdf->Ln(30);
$pdf->Cell(25, 8, 'Saefur Rochim, S.H., M.H.', 0, $ln=0, 'C', 1, '', 0, false, 'A', 'C');
$pdf->Ln(7);
$pdf->Cell(25, 8, 'NIP. 19750402 199803 1 001.', 0, $ln=0, 'C', 1, '', 0, false, 'A', 'C');

//nanti cek mulai disini
//$pdf->SetLineStyle(array('width' => 0.3, 'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => array(0, 0, 0)));
//$pdf->SetFillColor(170, 170, 170 );
//$pdf->SetTextColor(0,0,0);
////$pdf->MultiCell(35, 8, 'Keterangan', 1, '', 1, 0);
//$pdf->Cell(35, 8, 'Keterangan', 1, $ln=0, 'C', 1, '', 0, false, 'A', 'C');
//$pdf->Ln();

//contoh penggunaan Cell
//$pdf->Cell();
//$pdf->Cell(0, 0, 'TEST CELL STRETCH: force scaling', 1, 1, 'C', 0, '', 2);

//$pdf->SetLineStyle(array('width' => 0.5, 'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => array(0, 0, 0)));
//$pdf->SetFillColor(255,255,255);
//$pdf->SetTextColor(0,0,0);
//$pdf->MultiCell(60, 4, $text, 1, 'C', 1, 0);
//
//$pdf->SetLineStyle(array('width' => 0.5, 'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => array(0, 0, 0)));
//$pdf->SetFillColor(255,255,255);
//$pdf->SetTextColor(0,0,0);
//$pdf->MultiCell(60, 4, $text, 1, 'C', 1, 0);
//
//$pdf->SetLineStyle(array('width' => 0.5, 'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => array(0, 0, 0)));
//$pdf->SetFillColor(255,255,255);
//$pdf->SetTextColor(0,0,0);
//$pdf->MultiCell(60, 4, $text, 1, 'C', 1, 1);
//sampai sini

// ---------------------------------------------------------



//Close and output PDF document
$pdf->Output('example_003.pdf', 'I');
//$pdf->Output('example_003.pdf', 'D');

//============================================================+
// END OF FILE
//============================================================+
