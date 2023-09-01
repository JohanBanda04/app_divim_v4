<?php
$link1 = strtolower($this->uri->segment(1));
$link2 = strtolower($this->uri->segment(2));
$link3 = strtolower($this->uri->segment(3));
$link4 = $this->uri->segment(4);
?>
<!-- Main content -->
<!-- <div class="content-wrapper"> -->
  <!-- Content area -->
  <!-- <div class="content"> -->

    <!-- Dashboard content -->
    <div class="row">
      <div class="col-md-3"></div>
      <div class="col-md-6">
        <div class="panel panel-inverse">
            <div class="panel-heading">
                <div class="panel-heading-btn">
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
                </div>
                <h4 class="panel-title"><?php echo $judul_web; ?></h4>
            </div>
            <div class="panel-body">
              <h4><?php echo $this->Mcrud->get_nama_ruangan(hashids_decrypt($link4)); ?></h4>
              <h6><?php echo $this->Mcrud->hari_id(date('d-m-Y')); ?>, <?php echo $this->Mcrud->tgl_id(date('d-m-Y'),'full'); ?></h6>
              <hr>
                <?php
                echo $this->session->flashdata('msg');
                ?>
                <form class="form-horizontal" action="" data-parsley-validate="true" method="post" enctype="multipart/form-data">
                  <div class="form-group">
                    <label class="control-label col-lg-3">Waktu</label>
                    <div class="col-lg-9">
                      <select class="form-control default-select2" name="waktu" required>
                        <option value="">- Pilih -</option>
                        <option value="PAGI">Pagi</option>
                        <option value="SIANG">Siang</option>
                        <option value="SORE">Sore</option>
                      </select>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-lg-3">Catatan Mr. Clean</label>
                    <div class="col-lg-9">
                      <textarea name="catatan_ob" class="form-control" placeholder="Catatan" rows="4" cols="100"></textarea>
                    </div>
                  </div>
                  <hr>
                  <a href="<?php echo "dashboard"; ?>" class="btn btn-default"><< Kembali</a>
                  <button type="submit" name="btnsimpan" class="btn btn-primary" style="float:right;">Simpan</button>
                </form>
            </div>

        </div>
      </div>
    </div>
    <!-- /dashboard content -->
