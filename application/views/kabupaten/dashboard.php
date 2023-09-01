<?php
session_start();
$ceks = $this->session->userdata('token_katamaran');
$link1 = $this->uri->segment(1);
$link2 = $this->uri->segment(2);
$link3 = $this->uri->segment(3);
$link4 = $this->uri->segment(4);
$link5 = $this->uri->segment(5);
$level = $this->session->userdata('level');

?>

<main class="main-content bgc-grey-100">
    <div id="mainContent">
        <div class="container-fluid">
            <?php

//            if ($_SESSION['token_katamaran']) {
//                echo "Terdapat data token : ".$_SESSION['token_katamaran'];
//            } else {
//                echo "Tidak Terdapat data token  ";
//            }
             ?>
            <div class="row fc-event-start justify-content-center" style="margin-left: 10px">
                <h2 class="font-weight-bold" style="margin: 0 0 40px 0; color: black; opacity: 70%">Dashboard</h2>

                <?php
                if($this->session->flashdata('msg')){
                    echo "<p>".$this->session->flashdata('msg')."</p>";
                }
                ?>
            </div>
            <div class="row">

                <?php if($_SESSION['token_katamaran']) { ?>
                    <div  class="col-md-4" style="margin-bottom: 10px">


                        <div class="layers p-20 "
                             style="border-radius: 20px; border-color: #490411; border-style: solid ;  border-width: 5px">
                            <div class="layer w-100 mB-10">
                                <h6 class="lh-1" style="color: #373737">
                                    <!--ini data dari tabel 'zona' database api_divim-->
                                    Semua Data ITK
                                </h6>
                            </div>
                            <div class="layer w-100">
                                <div class="peers ai-sb fxw-nw">
                                    <!--dashboard1-->
                                    <?php
                                    $id_for_all = 0;
                                    ?>

                                    <?php if($_SESSION['token_katamaran']){ ?>
                                        <a href="izintinggal/data_itk/<?php echo hashids_encrypt($id_for_all);?>">
                                        <span class="pull-left" style="font-weight: bold">
                                            Lihat Data Izin Tinggal
                                            <?php
                                            // echo $data['id'];
                                            ?>
                                        </span>
                                        </a>
                                    <?php }  ?>
                                    <div class="peer peer-greed">
                                        <canvas width="45" height="20"
                                                style="display: inline-block; width: 45px; height: 20px; vertical-align: top;">

                                        </canvas>
                                    </div>
                                    <div class="peer">

                                        <?php if($_SESSION['token_katamaran']){ ?>
                                            <span style=" background-color: #490411; color: #fcfaff"
                                                  class="d-ib lh-0 va-m fw-600 bdrs-10em pX-15 pY-15  ">
                                            <?php

                                            $dataITK_byZona = $this->Guzzle_model->getAllDataITK();
                                            echo count($dataITK_byZona)." Data ITK";
                                            ?>
                                        </span>
                                        <?php }  ?>


                                    </div>
                                </div>
                            </div>
                        </div>


                    </div>

                <?php } ?>


                <!--cara foreach data dari controller-->
                <?php foreach ($zona as $index => $data) {

                    ?>

                    <div <?php if($data['nama_zona']=="kasub_inteldakim"
                        || $data['nama_zona']=="superadmin" || $data['nama_zona']=="divim_kanwil"){
                        ?> hidden <?php
                    } ?> class="col-md-4" style="margin-bottom: 10px">


                        <div class="layers p-20 "
                             style="border-radius: 20px; border-color: <?= $data['warna_background']; ?>; border-style: solid ;  border-width: 5px">
                            <div class="layer w-100 mB-10">
                                <h6 class="lh-1" style="color: #373737">
                                    <!--ini data dari tabel 'zona' database api_divim-->
                                    <?php echo $data['nama_panjang'] ; ?>
                                </h6>
                            </div>
                            <div class="layer w-100">
                                <div class="peers ai-sb fxw-nw">
                                    <!--dashboard1-->

                                    <?php if($_SESSION['token_katamaran']){ ?>
                                        <a href="izintinggal/data_itk/<?= hashids_encrypt($data['id']);?>">
                                        <span class="pull-left" style="font-weight: bold">
                                            Lihat Data Izin Tinggal
                                            <?php
                                            // echo $data['id'];
                                            ?>
                                        </span>
                                        </a>
                                    <?php } else { ?>

                                        <button type="button" class="float-right btn_tambah" data-toggle="modal"
                                                data-target="#add_izin_tinggal<?php echo $data['id']; ?>">
                                            <span class="bg-float"></span>
                                            <span class="text">Tambah Data ITK</span>
                                        </button>
                                    <?php } ?>
                                    <div class="peer peer-greed">
                                        <canvas width="45" height="20"
                                                style="display: inline-block; width: 45px; height: 20px; vertical-align: top;">

                                        </canvas>
                                    </div>
                                    <div class="peer">


                                        <span style=" background-color: <?= $data['warna_background'] ?>; color: #fcfaff"
                                              class="d-ib lh-0 va-m fw-600 bdrs-10em pX-15 pY-15  ">
                                            <?php
                                            $dataITK_byZona = $this->Guzzle_model->getizintinggalByZona($data['id']);
                                            echo count($dataITK_byZona)." Data ITK";
                                            ?>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>


                    </div>
                    <?php
                } ?>


            </div>

            <!-- Add, Detail, Edit, Delete Agenda  -->
            <?php
            // Add Agenda
            //$this->load->view('agenda/add_agenda');
            $this->load->view('kabupaten/izintinggal/add_izin_tinggal');
//
            
//            // Detail Agenda
//            //$this->load->view('agenda/detail_agenda');
//            $this->load->view('izin_tinggal/detail_agenda');
//
//            //  Edit Agenda
//            //$this->load->view('agenda/edit_agenda');
//            $this->load->view('izin_tinggal/edit_agenda');
//
//            //  Delete Agenda
//            //$this->load->view('agenda/delete_agenda');
//            $this->load->view('izin_tinggal/delete_agenda');
//
//            //  Proses Agenda
//            //$this->load->view('agenda/proses_agenda');
//            $this->load->view('izin_tinggal/proses_agenda');
            ?>
        </div>
    </div>
</main>

  
