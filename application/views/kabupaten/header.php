<!DOCTYPE html>
<?php
$ceks    = $this->session->userdata('token_katamaran');
$username   = $this->session->userdata('username');
$level   = $this->session->userdata('level');
$nama  = $this->session->userdata('nama');
$zona  = $this->Mcrud->zona();

$foto = "img/user/user-default.png";

$menu     = strtolower($this->uri->segment(1));
$sub_menu = strtolower($this->uri->segment(2));
$sub_menu3 = strtolower($this->uri->segment(3));
?>
<html>

<head>
  <base href="<?php echo base_url(); ?>" />
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1,shrink-to-fit=no" />
  <title>PITAMIN - PENDATAAN IJIN TINGGAL NTB</title>
  <style>
    #loader {
      transition: all 0.3s ease-in-out;
      opacity: 1;
      visibility: visible;
      position: fixed;
      height: 100vh;
      width: 100%;
      background: #fff;
      z-index: 90000;
    }

    #loader.fadeOut {
      opacity: 0;
      visibility: hidden;
    }

    .spinner {
      width: 40px;
      height: 40px;
      position: absolute;
      top: calc(50% - 20px);
      left: calc(50% - 20px);
      background-color: #333;
      border-radius: 100%;
      -webkit-animation: sk-scaleout 1s infinite ease-in-out;
      animation: sk-scaleout 1s infinite ease-in-out;
    }



    @-webkit-keyframes sk-scaleout {
      0% {
        -webkit-transform: scale(0);
      }

      100% {
        -webkit-transform: scale(1);
        opacity: 0;
      }
    }

    @keyframes sk-scaleout {
      0% {
        -webkit-transform: scale(0);
        transform: scale(0);
      }

      100% {
        -webkit-transform: scale(1);
        transform: scale(1);
        opacity: 0;
      }
    }
  </style>

  <!--tambahan css-->
  <!--beginning of calendar-15 header-->

  <!--end of calendar-15 header-->

    <link rel="shortcut icon" href="img/LOGO.png" type="image/x-icon" />
  <link href="assets/agenda/style.css" rel="stylesheet" />
  <link href="assets/agenda/custom.css" rel="stylesheet" />
  <link href="node_modules/fullcalendar/main.css" rel="stylesheet" />
  <link rel="stylesheet" type="text/css" href="node_modules/jquery-datetimepicker/jquery.datetimepicker.css" />
  <link rel="stylesheet" type="text/css" href="assets/clockpicker-gh-pages/dist/bootstrap-clockpicker.min.css" />
  <!--tambahan untuk captcha-->
  <script src="https://www.google.com/recaptcha/api.js" async defer></script>
<!--  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>-->
  <script type="text/javascript" src="assets/js/jquery.min.js"></script>
  <script type="text/javascript" src="assets/clockpicker-gh-pages/dist/bootstrap-clockpicker.min.js"></script>



</head>

<body class="app">
  <div id="loader">
    <div class="spinner"></div>
  </div>
  <script>
    window.addEventListener("load", () => {
      const loader = document.getElementById("loader");
      setTimeout(() => {
        loader.classList.add("fadeOut");
      }, 300);
    });
  </script>
  <div>
    <?php //if (isset($ceks)): 
    ?>
    <div class="sidebar">
      <div class="sidebar-inner">
        <div class="sidebar-logo">
          <div class="peers ai-c fxw-nw">
            <div class="peer peer-greed">
              <a class="sidebar-link td-n" href="index.html">
                <div class="peers ai-c fxw-nw">
                  <div class="peer">
                    <div class="logo" style="padding: 10px 5px 0px 5px;">
                        <br>
                      <img style="width: 65px; height: 65px"
                           src="assets/agenda/assets/static/images/rounded.png" alt="" />
                    </div>
                  </div>
                  <div class="peer peer-greed">
                    <h5 class="lh-1 mB-0 logo-text" style="padding-left: 10px">PITAMIN</h5>
                  </div>
                </div>
              </a>
            </div>
            <div class="peer">
              <div class="mobile-toggle sidebar-toggle">
                <a href="" class="td-n"><i class="ti-arrow-circle-left"></i></a>
              </div>
            </div>
          </div>
        </div>
        <!-- Sidebar -->
        <ul class="sidebar-menu scrollable pos-r">
          <li hidden class="nav-item mT-30 active">
            <a class="sidebar-link" href="index.html">
                <span class="icon-holder">
                    <i class="c-orange-500 ti-layout-list-thumb"></i>
                </span>
                <span class="title">Jadwal Harian</span>
            </a>
          </li>
            <?php if($_SESSION['token_katamaran']) { ?>
                <li  class="nav-item mT-30 active">
                    <a class="sidebar-link" href="index.html">
                <span class="icon-holder">
                    <i class="c-orange-500 ti-layout-list-thumb"></i>
                </span>

                        <span class="title">Dashboard</span>
                    </a>
                </li>
            <?php } ?>

            <li hidden class="nav-item ">
                <a class="sidebar-link" href="index.html">
                <span class="icon-holder">
                    <i class="c-red-500 ti-write"></i>
                </span>
                    <span class="title">Data Izin Tinggal</span>
                </a>
            </li>

            <?php if($_SESSION['token_katamaran']){ ?>
                <?php
                $id_for_all = 0;
                ?>
                <li class="nav-item dropdown">
                    <a class="dropdown-toggle" href="javascript:void(0);">
                    <span class="icon-holder"><i class="c-red-500 ti-write"></i>
                    </span>
                        <span class="title">Data Izin Tinggal</span>
                        <span class="arrow"><i class="ti-angle-right"></i></span></a>
                    <ul class="dropdown-menu" style="display: none;">
                        <!--merujuk disini untuk melihat data semua pemda / pemkot-->
                        <li ><a class="sidebar-link" href="izintinggal/data_itk/<?php echo hashids_encrypt($id_for_all);?>">
                                Semua Pemda / Pemkot
                            </a>
                        </li>
                        <?php foreach ($zona as $index => $data){
                            ?>
                            <li <?php if($data['nama_zona']=="kasub_inteldakim" || $data['nama_zona']=="superadmin"){
                                ?> hidden <?php

                                /*dashboard2*/
                            } ?> ><a class="sidebar-link" href="izintinggal/data_itk/<?= hashids_encrypt($data['id']);?>">
                                    <?php echo $data['nama_panjang'];?>
                                </a>
                            </li>
                            <?php
                        }?>

                    </ul>
                </li>
            <?php } ?>




          <li hidden class="nav-item">
            <a class="sidebar-link" href="kalender">
                <span class="icon-holder"><i class="c-blue-500 ti-calendar"></i> </span>
                <span class="title">Kalender</span></a>
          </li>
          <?php if (isset($ceks)) :
            if ($level == 'superadmin') : ?>
              <li class="nav-item">
                <a class="sidebar-link" href="<?php if ($level == 'superadmin') {
                                                echo "datapengguna/v.html";
                                              } else {
                                                echo "profile.html";
                                              } ?>"><span class="icon-holder"><i class="c-deep-purple-500 ti-user"></i> </span><span class="title">Data Pengguna</span></a>
              </li>
          <?php endif;
          endif; ?>
          <?php if (isset($ceks)) : ?>
            <li class="nav-item">
              <!--pada href tersebut yang 'laporan' merupakan nama controller-->
              <a class="sidebar-link" href="laporan">
                  <span class="icon-holder">
                      <i class="c-brown-500 ti-book"></i>
                  </span>
                  <span class="title">Laporan ITK</span>
              </a>
            </li>
          <?php endif; ?>
          <?php //if (isset($ceks)) : 
          ?>

          <?php //endif; 
          ?>
        </ul>
      </div>
    </div>
    <?php //endif; 
    ?>
    <div class="page-container">
      <div class="header navbar">
        <div class="header-container">
          <ul class="nav-left">
            <?php //if (isset($ceks)) : 
            ?>
            <li>
              <a id="sidebar-toggle" class="sidebar-toggle" href="javascript:void(0);"><i class="ti-menu"></i></a>
            </li>
          </ul>
          <ul class="nav-right">
            <?php if (!isset($ceks)) : ?>
              <div class="div-login-button">
                <!--ke controller Web lalu function login-->
                <a href="web/login" class="btn btn-primary btn-block">Login</a>
              </div>
            <?php else : ?>
              <li class="dropdown">
                <a href="" class="dropdown-toggle no-after peers fxw-nw ai-c lh-1" data-toggle="dropdown">
                  <div class="peer mR-10">
                    <img class="w-2r bdrs-50p" src="<?php echo $foto; ?>" alt="" />
                  </div>
                  <div class="peer">
                    <span class="fsz-sm c-grey-900"><?php echo $nama; ?></span>
                  </div>
                </a>
                <ul class="dropdown-menu fsz-sm">
                  <li>
                    <a href="profile.html" class="d-b td-n pY-5 bgcH-grey-100 c-grey-700">
                        <i class="ti-user mR-10"></i> <span>Profile</span>
                    </a>
                  </li>
                  <li role="separator" class="divider"></li>
                  <li>
                    <a href="web/logout.html" class="d-b td-n pY-5 bgcH-grey-100 c-grey-700"><i class="ti-power-off mR-10"></i> <span>Logout</span></a>
                  </li>
                </ul>
              </li>
            <?php endif;
            ?>
          </ul>
        </div>
      </div>