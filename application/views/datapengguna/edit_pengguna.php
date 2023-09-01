<?php foreach ($user_list as $row):  ?>

  <div class="modal fade" id="edit_pengguna<?php echo $row['id']; ?>">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="bd p-15"><h5 class="m-0">Ubah Data Pengguna</h5></div>
        <div class="modal-body">
          <form method="POST" action="datapengguna/v/e">
            <input type="hidden" value="<?php echo $row['id']; ?>" name="id_user" />
            <div class="form-group">
              <label class="fw-500" for="nama">Nama Pengguna</label>
              <input class="form-control border-grey" id="nama" name="nama" value="<?php echo $row['nama']; ?>" required />
            </div>
            <div class="form-group">
              <label class="fw-500" for="tempat">Username</label>
              <input class="form-control border-grey" id="username" name="username" value="<?php echo $row['username']; ?>" required />
            </div>
            <div class="form-group">
              <label class="fw-500" for="role">Role</label>
              <select class="form-control border-grey" id="role" name="role" value="<?php echo $row['role'];?>" required>
                  <option value="">- Pilih -</option>
                  <option value="kakanwil" <?php if($row['role'] == 'kakanwil') { ?>
                      selected
                  <?php } ?> >Kepala Kantor Wilayah</option>

                  <option value="pimti" <?php if($row['role'] == 'pimti') { ?>
                      selected
                  <?php } ?> >Pimpinan Tinggi Pratama</option>

                  <option value="satker" <?php if($row['role'] == 'satker') { ?>
                      selected
                  <?php } ?> >Satuan Kerja Wilayah</option>

                <option value="pimti" <?php if($row['role'] == 'pimti'){ echo "selected";} ?>>Pimpinan Tinggi Pratama</option>
                <option value="pelaksana" <?php if($row['role'] == 'pelaksana'){ echo "selected";} ?>>Pelaksana Kegiatan</option>
                <option value="sekpim" <?php if($row['role'] == 'sekpim'){ echo "selected";} ?>>Sekretaris Pimpinan</option>
              </select>
            </div>
            <div class="form-group">
              <label class="fw-500" for="password">Password</label>
              <input class="form-control border-grey" id="password" type="password" name="password" required />
            </div>
            <div class="form-group">
              <label class="fw-500" for="konfirmasi password">Konfirmasi Password</label>
              <input class="form-control border-grey" id="password2" type="password" name="password2"  required />
            </div>
            
              <div class="text-right">
              <button
                class="btn btn-secondary cur-p float-left"
                data-dismiss="modal"
                name=""
              >
                Kembali
              </button>
              <button
                class="btn btn-success cur-p"
                name=""
              >
                Simpan
              </button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
<?php endforeach; ?>
    


<script type="text/javascript">
    $('.clockpicker').clockpicker();
</script>