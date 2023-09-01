<?php
$link1 = strtolower($this->uri->segment(1));
$link2 = strtolower($this->uri->segment(2));
$link3 = strtolower($this->uri->segment(3));
$link4 = strtolower($this->uri->segment(4));
$ceks    = $this->session->userdata('token_katamaran');
?>

<main class="main-content">

    <div id="mainContent" class="">

        <div class="col-lg-12 justify-content-center">
            <div class="row justify-content-center p-15">
                <h2 class="font-weight-bold" style="margin: 0 0 40px 0;">Bahan Berita</h2>
            </div>
            <div class="row text-end">
                <div class="col-md-2">
                    <label class="ml-5 fw-500 float-left" style="vertical-align: middle; padding-top: 7px;" for="tanggal">Pilih Tanggal</label>
                </div>
                <div class="col-md-2">
                    <?php if ($filter_date_dari == null) { ?>
                        <div class="timepicker-input input-icon form-group">
                            <div class="input-group">
                                <div class="icon-agenda bgc-white bd bdwR-0">
                                    <i class="ti-calendar"></i>
                                </div>
                                <!--disini ifnya-->
                                <input type="text" class="form-control border-grey start-date" data-provide="datepicker" value="<?php echo $tgl_now ?>" data-date-format="d-M-yyyy" name="dari_tgl" id="dari_tgl" onchange="window.location.href='bahan_berita/v/f/'+this.value;" required />
                            </div>
                        </div>
                    <?php } else { ?>
                        <div class="timepicker-input input-icon form-group">
                            <div class="input-group">
                                <div class="icon-agenda bgc-white bd bdwR-0">
                                    <i class="ti-calendar"></i>
                                </div>
                                <input type="text" class="form-control border-grey start-date" data-provide="datepicker" value="<?php echo $filter_date_dari; ?>" data-date-format="d-M-yyyy" name="dari_tgl" id="dari_tgl" onchange="window.location.href='bahan_berita/v/f/'+this.value;" required />
                            </div>
                        </div>
                    <?php } ?>

                </div>

                <div class="col-md-2"></div>
                <div class="col-md-6">
                    <button type="button" class="float-right btn btn-success" data-toggle="modal" data-target="#add_bahan_berita">
                        <span class="bg-float"></span>
                        <span class="text">Tambah Bahan Berita</span>
                    </button>
                </div>
            </div>
        </div>

        <!--table beginning-->
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <hr>
                    <table id="dataTable" class="table table-striped table-bordered" cellspacing="0" width="100%">
                        <thead class="thead-dark">
                            <tr>
                                <th width="1%" style="text-align: center">No.</th>
                                <th width="25%" style="text-align: center">Hari / Tgl </th>
                                <th width="34%" style="text-align: center">Kegiatan</th>
                                <th width="25%" style="text-align: center">Tempat</th>
                                <th width="15%" style="text-align: center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($bahan_berita as $index => $dt) { ?>
                                <tr>
                                    <td style="text-align: center"><?php echo $index + 1 ?></td>
                                    <td style="text-align: center">
                                        <?php echo $this->Mcrud->hari_id($dt['berita_when']); ?> / <?php echo $this->Mcrud->tgl_english($dt['berita_when'], 'full'); ?>
                                    </td>
                                    <td style="text-align: center">
                                        <?php echo $dt['berita_what']; ?>
                                    </td>
                                    <td style="text-align: center">
                                        <?php echo $dt['berita_where']; ?>
                                    </td>
                                    <td style="text-align: center">
                                        <div class="peers">
                                            <div class="peer" style="text-align: center; margin-left: 22px">
                                                <a href="" class="td-n c-blue-500 cH-blue-500 fsz-md p-5" data-toggle="modal" data-target="#detail_bahan_berita<?php echo $dt['id']; ?>">
                                                    <i class="ti-search"></i>
                                                </a>
                                            </div>
                                            <?php if (isset($ceks)) : ?>
                                                <div class="peer">
                                                    <a href="" class="td-n c-deep-purple-500 cH-blue-500 fsz-md p-5" data-toggle="modal" data-target="#edit_bahan_berita<?php echo $dt['id']; ?>">
                                                        <i class="ti-pencil"></i>
                                                    </a>
                                                </div>
                                                <div class="peer">
                                                    <a href="" class="td-n c-red-500 cH-blue-500 fsz-md p-5" data-toggle="modal" data-target="#delete_bahan_berita<?php echo $dt['id']; ?>">
                                                        <i class="ti-trash"></i>
                                                    </a>
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Add, Detail, Edit, Delete Bahan Berita  -->
            <?php

            // Add Bahan Berita
            $this->load->view('bahan_berita/add_bahan_berita');

            // Detail Bahan Berita
            $this->load->view('bahan_berita/detail_bahan_berita');

            // Edit Bahan Berita
            $this->load->view('bahan_berita/edit_bahan_berita');

            // Delete Bahan Berita
            $this->load->view('bahan_berita/delete_bahan_berita');

            ?>
        </div>
        <!--table ending-->
    </div>
</main>