<?php ob_start(); ?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>

    <style>
        .tb-border {
            border: 1px solid black;
            border-collapse: collapse;
        }
    </style>

</head>
<body>


<table style="">
    <tr style="margin-top: 20px; ">
        <td style="width: 100px; align=center; margin-top: 100px; background-color: #f9fffb ">
            <img src="./assets/img/kumhamrad.png" width="100" height="100" alt="">
        </td>

        <td style="width: 630px; margin-top: 10px; background-color: #f9fffb ">
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
                <span style="">Laman : ntb.kemenkumham.go.id, Surel : kanwilntb@kemenkumham.go.id</span>
            </div>
        </td>
    </tr>

    <hr>
</table>
<table class="">
    <tr style="margin-top: 20px; " class="">


        <td class="" style="width: 740px; margin-top: 10px; background-color: #f9fffb">
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
<br>



<table style="margin-left: 10px" class="tb-border">
    <tr style="margin-top: 20px; font-weight: bold" class="tb-border">


        <td class="tb-border" style="width: 15px; margin-top: 10px; background-color: #b8b0b2">
            <div style="text-align: center">
                No
            </div>
        </td>
        <td class="tb-border" style="width: 95px; margin-top: 10px; background-color: #b8b0b2">
            <div style="text-align: center">
                Hari /Tgl
            </div>
        </td>
        <td class="tb-border" style="width: 90px; margin-top: 10px; background-color: #b8b0b2">
            <div style="text-align: center">
                Nama WNA
            </div>
        </td>
        <td class="tb-border" style="width: 90px; margin-top: 10px; background-color: #b8b0b2">
            <div style="text-align: center">
                Negara
            </div>
        </td>
        <td class="tb-border" style="width: 90px; margin-top: 10px; background-color: #b8b0b2">
            <div style="text-align: center">
                Jenis Kelamin
            </div>
        </td>
        <td class="tb-border" style="width: 100px; margin-top: 10px; background-color: #b8b0b2">
            <div style="text-align: center">
                No. Paspor
            </div>
        </td>
        <td class="tb-border" style="width: 110px; margin-top: 10px; background-color: #b8b0b2">
            <div style="text-align: center">
                Alamat
            </div>
        </td>

        <td class="tb-border" style="width: 100px; margin-top: 10px; background-color: #b8b0b2">
            <div style="text-align: center">
                Penjamin
            </div>
        </td>

    </tr>
    <?php
        foreach ($laporan_itk_data_pdf as $index => $data){
            ?>
            <tr style="margin-top: 20px; ">
                <?php

                /* untuk kolom hari / tgl */
                $hrir = $this->Mcrud->hari_id(explode(' ',$data['created_at'])[0]);
                $date_indonesia = $this->Mcrud->tgl_idn(explode(' ',$data['created_at'])[0], 'full');


                $nama_wna = $data['nama'];
                $negara = $data['negara'];
                $jenis_kelamin = $data['jenis_kelamin'];
                $no_paspor = $data['no_paspor'];
                $alamat = $data['alamat'];
                $penjamin = $data['penjamin'];

                /* untuk kolom tempat */
                $tempat = $data['tempat'];

                /* untuk kolom peserta */
                $keterangan = $data['peserta'];

                ?>

                <td class="tb-border" style="width: 15px; margin-top: 10px; background-color: #f9fffb">
                    <div style="text-align: center">
                        <?php echo $index+1;?>
                    </div>
                </td>

                <td class="tb-border" style="width: 95px; margin-top: 10px; background-color: #f9fffb">
                    <div style="text-align: center">
                        <?php echo $hrir." / ". $date_indonesia;?>
                    </div>
                </td>

                <td class="tb-border" style="width: 90px; margin-top: 10px; background-color: #f9fffb">
                    <div style="text-align: center">
                        <?php echo $nama_wna;?>
                    </div>
                </td>

                <td class="tb-border" style="width: 90px; margin-top: 10px; background-color: #f9fffb">
                    <div style="text-align: center">
                        <?php echo $negara;?>
                    </div>
                </td>

                <td class="tb-border" style="width: 90px; margin-top: 10px; background-color: #f9fffb">
                    <div style="text-align: center">
                        <?php echo $jenis_kelamin;?>
                    </div>
                </td>


                <td class="tb-border" style="width: 100px; margin-top: 10px; background-color: #f9fffb">
                    <div style="text-align: center">
                        <?php echo $no_paspor;?>
                    </div>
                </td>

                <td class="tb-border" style="width: 110px; margin-top: 10px; background-color: #f9fffb">
                    <div style="text-align: center">
                        <?php echo $alamat;?>
                    </div>
                </td>

                <td class="tb-border" style="width: 100px; margin-top: 10px; background-color: #f9fffb">
                    <div style="text-align: center">
                        <?php echo $penjamin;?>
                    </div>
                </td>
            </tr>
            <?php
        }

    ?>




</table>



<table class="">
    <tr style="margin-top: 20px; font-weight: bold" class="tb-border">


        <td class="" style="width: 148px; margin-top: 10px; color: white">
<!--            <div style="height: 40px"></div>-->
            <div style="text-align: center">
                Dummy
            </div>
        </td>
        <td class="" style="width: 148px; margin-top: 10px; color: white">
            <div style="text-align: center">
                Dummy
            </div>
        </td>
        <td class="" style="width: 148px; margin-top: 10px; color: white">
            <div style="text-align: center">
                Dummy
            </div>
        </td>

        <td class="" style="width: 270px; margin-top: 10px; color: black">
            <div style="text-align: center">
                Mataram, <?php echo ($this->Mcrud->hari_id(date('Y-m-d')))." ". ($this->Mcrud->tgl_idn(date('Y-m-d'), 'full'))?>
            </div>
        </td>
    </tr>


    <tr style="margin-top: 20px; font-weight: bold" class="tb-border">


        <td class="" style="width: 148px; margin-top: 10px; color: white">
            <div style="text-align: center">
                Dummy
            </div>
        </td>
        <td class="" style="width: 148px; margin-top: 10px; color: white">
            <div style="text-align: center">
                Dummy
            </div>
        </td>
        <td class="" style="width: 148px; margin-top: 10px; color: white">
            <div style="text-align: center">
                Dummy
            </div>
        </td>

        <td class="" style="width: 270px; margin-top: 10px; color: black">
            <div style="text-align: center">
                Kepala Divisi Keimigrasian,
            </div>
        </td>
    </tr>

    <tr style="margin-top: 20px;" class="tb-border">


        <td class="" style="width: 148px; margin-top: 10px; color: white">
            <div style="text-align: center">
                Dummy
            </div>
        </td>
        <td class="" style="width: 148px; margin-top: 10px; color: white">
            <div style="text-align: center">
                Dummy
            </div>
        </td>
        <td class="" style="width: 148px; margin-top: 10px; color: white">
            <div style="text-align: center">
                Dummy
            </div>
        </td>

        <td class="" style="width: 270px; margin-top: 10px; color: black">
            <div style="height: 80px;"></div>
            <div style="text-align: center">
                Yan Wely Wiguna, S.SOS., M.SI.
            </div>
        </td>
    </tr>

    <tr style="margin-top: 20px; " class="tb-border">


        <td class="" style="width: 148px; margin-top: 10px; color: white">
            <div style="text-align: center">
                Dummy
            </div>
        </td>
        <td class="" style="width: 148px; margin-top: 10px; color: white">
            <div style="text-align: center">
                Dummy
            </div>
        </td>
        <td class="" style="width: 148px; margin-top: 10px; color: white">
            <div style="text-align: center">
                Dummy
            </div>
        </td>

        <td class="" style="width: 270px; margin-top: 10px; color: black">
            <div style="text-align: center">
                NIP. 197211011999031001
            </div>
        </td>
    </tr>



</table>









</body>
</html>




