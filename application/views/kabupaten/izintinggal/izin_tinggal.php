<?php
//$link1 = strtolower($this->uri->segment(1));
//$link2 = strtolower($this->uri->segment(2));
//$link3 = strtolower($this->uri->segment(3));
//$link4 = strtolower($this->uri->segment(4));
//$link4 = strtolower($this->uri->segment(5));
//$ceks    = $this->session->userdata('token_katamaran');


$ceks 	 = $this->session->userdata('token_katamaran');
$link1 = $this->uri->segment(1);
$link2 = $this->uri->segment(2);
$link3 = $this->uri->segment(3);
$link4 = $this->uri->segment(4);
$link5 = $this->uri->segment(5);
?>

<main class="main-content">

    <div id="mainContent" class="">

        <div class="col-lg-12 justify-content-center">
            <div class="row justify-content-center p-15">
                <h2 class="font-weight-bold" style="margin: 0 0 40px 0;">Izin Tinggal <?php echo $datazona['nama_panjang'];?></h2>
            </div>

            <div class="row text-end">
                <div class="col-md-2">
                    <label class="ml-5 fw-500 float-left" style="vertical-align: middle; padding-top: 7px;" for="tanggal">Pilih Status</label>
                </div>
                <div class="col-md-2">
                    <select style="width: 170px; " class="form-control default-select2" id="stt"
                            onchange="window.location.href='izintinggal/data_itk/<?= $link3?>/id/'+this.value;">
                        <option value="semua" <?php if('semua'==$link5){ ?> selected <?php }?> >- Semua -</option>
                        <option value="belum_diproses" <?php if('belum_diproses'==$link5){echo "selected";} ?> >Belum diproses</option>
                        <option value="sedang_diproses" <?php if('sedang_diproses'==$link5){echo "selected";} ?> >Sedang Diproses</option>
                        <option value="selesai" <?php if('selesai'==$link5){echo "selected";} ?> >Selesai</option>
                    </select>

                </div>

                <div class="col-md-2"></div>
                <div class="col-md-6">
                    <button type="button" class="float-right btn btn-success" data-toggle="modal"
                            data-target="#add_izin_tinggal">
                        <span class="bg-float"></span>
                        <span class="text">Tambah Data ITK</span>
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
                                <th width="10%" style="text-align: center">Nama</th>
                                <th width="15%" style="text-align: center">Negara</th>
                                <th width="15%" style="text-align: center">Status</th>
                                <th width="15%" style="text-align: center">L / P</th>
                                <th width="15%" style="text-align: center">Paspor</th>
                                <th width="10%" style="text-align: center">Alamat</th>
                                <th width="10%" style="text-align: center">Penjamin</th>
                                <th width="15%" style="text-align: center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($izintinggal as $index => $dt) { ?>
                                <tr>
                                    <td style="text-align: center"><?php echo $index + 1 ?></td>
                                    <td style="text-align: center">
                                          <?php echo $dt['nama']; ?>
                                    </td>
                                    <td style="text-align: center">
                                        <?php echo $dt['negara']; ?>
                                    </td>
                                    <td style="text-align: center">

                                        <?php echo ucfirst(explode('_',$dt['status'])[0]??'').' ' .ucfirst(explode('_',$dt['status'])[1]??'')  ; ?>
                                    </td>
                                    <td style="text-align: center">
                                        <?php echo $dt['jenis_kelamin']; ?>
                                    </td>
                                    <td style="text-align: center">
                                        <?php echo $dt['no_paspor']; ?>
                                    </td>
                                    <td style="text-align: center">
                                        <?php echo $dt['alamat']; ?>
                                    </td>
                                    <td style="text-align: center">
                                        <?php echo $dt['penjamin']; ?>
                                    </td>
                                    <td class="" style="text-align: center">
                                        <div class="d-flex justify-content-center" style="text-align: center">
                                            <div class="" style="text-align: center; margin-left: 22px">
                                                <a href="" class="td-n c-blue-500 cH-blue-500 fsz-md p-5" data-toggle="modal" data-target="#detail_izin_tinggal<?php echo $dt['id']; ?>">
                                                    <i class="ti-search"></i>
                                                </a>
                                            </div>
                                            <?php if (isset($ceks)) : ?>
                                                <div class="">
                                                    <a href="" class="td-n c-deep-purple-500 cH-blue-500 fsz-md p-5" data-toggle="modal" data-target="#edit_izin_tinggal<?php echo $dt['id']; ?>">
                                                        <i class="ti-pencil"></i>
                                                    </a>
                                                </div>
                                                <div class="">
                                                    <a href="" class="td-n c-red-500 cH-blue-500 fsz-md p-5" data-toggle="modal" data-target="#delete_izin_tinggal<?php echo $dt['id']; ?>">
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
            $this->load->view('izin_tinggal/add_izin_tinggal');

            // Detail Bahan Berita
            $this->load->view('izin_tinggal/detail_izin_tinggal');

            // Edit Bahan Berita
            $this->load->view('izin_tinggal/edit_izin_tinggal');

            // Delete Bahan Berita
            $this->load->view('izin_tinggal/delete_izin_tinggal');

            ?>
        </div>
        <!--table ending-->
    </div>
</main>