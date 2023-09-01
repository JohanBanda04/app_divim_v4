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
        table, th, td {
            border: 1px solid black;
            border-collapse: collapse;
        }
    </style>

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
                <span style="">Laman : ntb.kemenkumham.go.id, Surel : kanwilntb@kemenkumham.go.id</span>
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
<br>

<?php


?>
<table>
    <tr style="margin-top: 20px; ">


        <td colspan="1" style="width: 740px; margin-top: 2px; background-color: #c372ff; text-align: center">
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
        </td>
    </tr>




</table>





</body>
</html>




