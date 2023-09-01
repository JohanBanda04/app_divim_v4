<?php
$link1 = strtolower($this->uri->segment(1));
$link2 = strtolower($this->uri->segment(2));
$link3 = strtolower($this->uri->segment(3));
$link4 = strtolower($this->uri->segment(4));

//$today = date('Y-m-d');
?>

<?php

//echo $tgl_now = $this->Mcrud->tgl_id_new($today, 'full');

?>
<main class="main-content">

    <div id="mainContent" class="" >
        <form action="<?php echo $link1; ?>/v/f.html" class="col-lg-12 justify-content-center" method="post" >
            <div class="row justify-content-center p-15">
                <h5 class="m-0 font-weight-bold">Kalenderr Laporan</h5>
                <?php /*echo $link1; */?><!-- <br>
                <?php /*echo $link2; */?> <br>
                --><?php /*echo $link3; */?>
            </div>
            <div class="row justify-content-center">
                <div class="col-md-2">
                    <label class="ml-5 fw-500" for="tanggal">Tanggal Awal</label>
                    <?php if($filter_date_dari==null){ ?>
                        <div class="timepicker-input input-icon form-group">
                            <div class="input-group">
                                <div
                                    class="icon-agenda bgc-white bd bdwR-0"
                                >
                                    <i class="ti-calendar"></i>
                                </div>
                                <input
                                    type="text"
                                    class="form-control border-grey start-date"
                                    data-provide="datepicker"

                                    value="<?php echo $tgl_now?>"
                                    data-date-format="d-M-yyyy"
                                    name="dari_tgl"
                                    id="dari_tgl"
                                    required
                                />
                            </div>
                        </div>
                    <?php } else { ?>
                        <div class="timepicker-input input-icon form-group">
                            <div class="input-group">
                                <div
                                    class="icon-agenda bgc-white bd bdwR-0"
                                >
                                    <i class="ti-calendar"></i>
                                </div>
                                <input
                                    type="text"
                                    class="form-control border-grey start-date"
                                    data-provide="datepicker"

                                    value="<?php echo $filter_date_dari;?>"
                                    data-date-format="d-M-yyyy"
                                    name="dari_tgl"
                                    id="dari_tgl"
                                    required
                                />
                            </div>
                        </div>
                    <?php } ?>

                </div>
                <div class="col-md-2">
                    <label class="fw-500 ml-5" for="tanggal">Tanggal Akhir</label>
                    <?php if($filter_date_sampai==null){ ?>
                        <div class="timepicker-input input-icon form-group">
                            <div class="input-group">
                                <div
                                    class="icon-agenda bgc-white bd bdwR-0"
                                >
                                    <i class="ti-calendar"></i>
                                </div>
                                <input
                                    type="text"
                                    class="form-control border-grey start-date"
                                    data-provide="datepicker"

                                    value="<?php echo $tgl_now?>"
                                    data-date-format="d-M-yyyy"
                                    name="sampai_tgl"
                                    id="sampai_tgl"
                                    required
                                />
                            </div>
                        </div>
                    <?php } else { ?>
                        <div class="timepicker-input input-icon form-group">
                            <div class="input-group">
                                <div
                                    class="icon-agenda bgc-white bd bdwR-0"
                                >
                                    <i class="ti-calendar"></i>
                                </div>
                                <input
                                    type="text"
                                    class="form-control border-grey start-date"
                                    data-provide="datepicker"

                                    value="<?php echo $filter_date_sampai; ?>"
                                    data-date-format="d-M-yyyy"
                                    name="sampai_tgl"
                                    id="sampai_tgl"
                                    required
                                />
                            </div>
                        </div>
                    <?php } ?>
                </div>

            </div>


            <div class="row justify-content-center">
                <div class="mb-3 mr-3 ml-4">
                    <button type="submit" class="btn btn-primary">
                        <span class="bg-float"></span>
                        <span class="text">Filterr</span>
                    </button>
                </div>
            </div>
        </form>



        <!--taruh cuys disini-->


        <!--table beginning-->
        <div class="container-fluid">
<!--            <div class="row">-->
<!--                <div class="col-md-7">-->
<!--                    <h4 class="c-grey-900 mT-10">Data Pengguna</h4>-->
<!--                </div>-->
<!--                <div class="col-md-5 fc-rtl">-->
<!--                    <button type="button" class="btn cur-p btn-success mT-10 mB-10" data-toggle="modal" data-target="#add_pengguna"><i class="fa fa-plus-circle" aria-hidden="true"></i> Tambah Pengguna Baru</button>-->
<!--                </div>-->
<!--            </div>-->
            <div class="row">
                <!-- <div class="col-md-12">
                </div> -->
                <div class="col-md-12">
                    <!-- <div class="bgc-white bd bdrs-3 p-20 mB-20"> -->
                    <!-- <h4 class="c-grey-900 mB-20">Bootstrap Data Table</h4> -->
                    <hr>
                    <table
                        id="dataTable"
                        class="table table-striped table-bordered"
                        cellspacing="0"
                        width="100%">
                        <thead class="thead-dark">
                        <tr>
                            <th width="1%" style="text-align: center">No.</th>
<!--                            <th style="text-align: center">Divisi</th>-->
<!--                            <th style="text-align: center">Pekan</th>-->
                            <th style="text-align: center">Hari / Tgl </th>
                            <th hidden style="text-align: center">Jam</th>
                            <th style="text-align: center">Kegiatan</th>
                            <th style="text-align: center">Tempat</th>
                            <th style="text-align: center">Keterangan</th>


<!--                            <th width="2%">No.</th>-->
<!--                            <th width="40%">Nama</th>-->
<!--                            <th width="22%">Username</th>-->
<!--                            <th width="18%">Level</th>-->
<!--                            <th width="18%">Aksi</th>-->
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach($agenda_data as $index=>$dt) { ?>
                            <tr>
                                <td style="text-align: center"><?php echo $index+1?></td>
<!--                                <td style="text-align: center">-</td>-->
<!--                                <td style="text-align: center">Pekan --><?php //echo $this->Mcrud->weekOfMonth(strtotime($dt['tanggal'])) . " ";?><!--</td>-->
                                <td style="text-align: center">
                                    <?php echo $this->Mcrud->hari_id($dt['tanggal']); ?> / <?php echo $this->Mcrud->tgl_id($dt['tanggal'], 'full'); ?>
                                </td>
                                <td hidden style="text-align: center">
                                    <?php echo substr($dt['jam_mulai'],0,5) ."-". substr($dt['jam_selesai'],0,5) ; ?>
                                </td>
                                <td style="text-align: center">
                                    <?php echo $dt['deskripsi']; ?>
                                </td>
                                <td style="text-align: center">
                                    <?php echo $dt['tempat']; ?>
                                </td>
                                <td style="text-align: center">
                                    <?php echo $dt['peserta']; ?>
                                </td>
<!--                                <td style="text-align: center">-->
<!--                                    --><?php //if($dt["url_data_dukung"]=="null") { ?>
<!--                                        <div>-</div>-->
<!--                                    --><?php //} else if($dt["url_data_dukung"]!="null") { ?>
<!--                                        <div>Ada Dokumen Data Dukung</div>-->
<!--                                    --><?php //} ?>
<!---->
<!--                                </td>-->
                            </tr>
                        <?php } ?>
                        </tbody>
                    </table>

                    <div style="text-align: center; font-weight: bold">
                        <a href="<?php echo $link1; ?>/v/c.html"
                           class="" title="Download"
                           onclick="" target="_blank">
                            <i class="fa fa-print btn btn-danger" style="padding: 10px"> Download PDF </i>
                            <!--                            dibawah tombol cetak tes muncul id ruangan-->
                            <!--                            <h1>--><?php //echo $this->session->userdata("id_ruangan_selected"); ?><!--</h1>-->
                            <!--                            <h1>--><?php //echo $this->session->userdata("tgl_awal"); ?><!--</h1>-->
                            <!--                            <h1>--><?php //echo $this->session->userdata("tgl_akhir"); ?><!--</h1>-->
                            <!--                            <h1>--><?php //echo $this->session->userdata("tgl_awal_sql"); ?><!--</h1>-->
                            <!--                            <h1>--><?php //echo $this->session->userdata("tgl_akhir_sql"); ?><!--</h1>-->
                        </a>

                    </div>


                    <!-- </div> -->
                </div>
            </div>

            <!-- Add, Detail, Edit, Delete Pengguna  -->
            <?php
            // Add Pengguna
            $this->load->view('datapengguna/add_pengguna');

            // Detail Pengguna
            $this->load->view('datapengguna/detail_pengguna');

            //  Edit Pengguna
            $this->load->view('datapengguna/edit_pengguna');

            //  Delete Pengguna
            $this->load->view('datapengguna/delete_pengguna');
            ?>
        </div>
        <!--table ending-->
    </div>
</main>
