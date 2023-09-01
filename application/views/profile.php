<?php
$username   = $this->session->userdata('username');
$level   = $this->session->userdata('level');
$nama	= $this->session->userdata('nama');
$id_dipa	= $this->session->userdata('id_dipa');

$foto_profile = "img/user/user-default.png";
if ($level=='obh') {
	$foto_k = $d_k->foto_obh;
	if ($foto_k!='') {
		if(file_exists("$foto_k")){
			$foto_profile = $foto_k;
		}
	}
}
?>
<!-- Main content -->
<!-- <div class="content-wrapper"> -->

  <!-- Content area -->
  <!-- <div class="content"> -->

    <!-- Dashboard content -->
    <div class="row">
      <div class="col-md-3"></div>
      <div class="col-md-6" style="padding-top: 80px">
      <div class="panel panel-flat">
          <div class="panel-body">
              <center>
                <img src="<?php echo $foto_profile; ?>" alt="<?php echo $nama; ?>" class="img-circle" width="176">
              </center>
          </div>
      </div>

      <div class="panel panel-flat">
          <div class="panel-body">
            <fieldset class="content-group">
              <legend class="text-bold"><i class="icon-user"></i>
                PROFILE
              </legend>
              <?php
              echo $this->session->flashdata('msg');
              ?>
              <form class="form-horizontal" action="" method="post" data-parsley-validate="true" enctype="multipart/form-data">
                  <div class="form-group">
                    <label class="control-label col-lg-3">Nama</label>
                    <div class="col-lg-9">
                      <input readonly type="text" name="nama" class="form-control" value="<?php echo ucwords($user['nama']); ?>" placeholder="Nama" maxlength="100">
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-lg-3">Whatsapp</label>
                    <div class="col-lg-9">
                      <input readonly type="text" name="whatsapp" class="form-control" value="<?php
                        if($level == 'superadmin') { 
                          echo '-'; 
                        } else { 
                          echo $user['whatsapp'];
                        } ?>" placeholder="Whatsapp" maxlength="100">
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-lg-3">Role</label>
                    <div class="col-lg-9">
                      <input type="text" name="role" class="form-control"
                             value="<?php echo ucwords($user['role']); ?>"
                             placeholder="Role" maxlength="100" readonly>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-lg-3">Username</label>
                    <div class="col-lg-9">
                      <input readonly type="text" name="username" class="form-control"
                             value="<?php echo strtolower($user['username']); ?>"
                             placeholder="Nama Pengguna">
                    </div>
                  </div>
                  <div hidden class="form-group">
                    <label class="control-label col-lg-3">Password</label>
                    <div class="col-lg-9">
                      <input type="password" name="password" class="form-control"
                             value="<?php echo $user['password']; ?>" placeholder="Password" required>
					            <i style="color: red;">*Password tidak boleh kosong.</i>
                    </div>
                  </div>
                  <div hidden class="form-group">
                    <label class="control-label col-lg-3">Re-Password</label>
                    <div class="col-lg-9">
                      <input type="password" name="password2" class="form-control"
                             value="<?php echo $user['password']; ?>" placeholder="Konfirmasi Password" required>
                    </div>
                  </div>
                
                <hr>

                <!-- <a href="ubah_pass" class="btn btn-info">Ubah Password</a> -->
                <button hidden type="submit" name="btnupdate" class="btn btn-primary" style="float:right;">Simpan</button>
                
            </fieldset>

          </form>
          </div>
      </div>
      </div>


    </div>
    <!-- /dashboard content -->


        <script src="assets/js/jquery.min.js"></script>
        <link rel="stylesheet" type="text/css" href="assets/panel/plugin/datetimepicker/jquery.datetimepicker.css"/>
        <script src="assets/panel/plugin/datetimepicker/jquery.datetimepicker.js"></script>
        <script>
        $('#tgl_1').datetimepicker({
          lang:'en',
          timepicker:false,
          format:'d-m-Y'
        });
        </script>
