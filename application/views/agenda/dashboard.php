<?php
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
            <div class="row fc-event-start" style="margin-left: 10px">
                <h2 class="font-weight-bold" style="margin: 0 0 40px 0; color: black; opacity: 70%">Dashboard</h2>
            </div>
            <div class="row">

                <?php foreach ($zona as $index => $data) {

                    ?>

                    <div <?php if($data['nama_zona']=="kasub_inteldakim"
                        || $data['nama_zona']=="superadmin"){
                        ?> hidden <?php
                    } ?> class="col-md-4" style="margin-bottom: 10px">

                        <div class="layers p-20 "
                             style="border-radius: 20px; border-color: <?= $data['warna_background']; ?>; border-style: solid ;  border-width: 5px">
                            <div class="layer w-100 mB-10">
                                <h6 class="lh-1" style="color: #373737">
                                    <?php echo $data['nama_panjang']; ?>
                                </h6>
                            </div>
                            <div class="layer w-100">
                                <div class="peers ai-sb fxw-nw">
                                    <a href=""><span class="pull-left" style="font-weight: bold">Lihat Data Izin Tinggal</span></a>
                                    <div class="peer peer-greed">
                                        <canvas width="45" height="20"
                                                style="display: inline-block; width: 45px; height: 20px; vertical-align: top;">

                                        </canvas>
                                    </div>
                                    <div class="peer">


                                        <span style="background-color: <?= $data['warna_background'] ?>; color: #000000"
                                              class="d-ib lh-0 va-m fw-600 bdrs-10em pX-15 pY-15  ">
                                            +10%
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
            $this->load->view('agenda/add_agenda');

            // Detail Agenda
            $this->load->view('agenda/detail_agenda');

            //  Edit Agenda
            $this->load->view('agenda/edit_agenda');

            //  Delete Agenda
            $this->load->view('agenda/delete_agenda');

            //  Proses Agenda
            $this->load->view('agenda/proses_agenda');
            ?>
        </div>
    </div>
</main>

  
