<div class="modal fade" id="add_pengguna">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="bd p-15">
        <h5 class="m-0">Tambah Pengguna Baru</h5>
      </div>
      <div class="modal-body">
        <form method="POST" action="datapengguna/v/t">
          <div class="form-group">
            <label class="fw-500" for="nama">Nama Pengguna</label>
            <input class="form-control border-grey" id="nama" name="nama" required />
          </div>
          <div class="form-group">
            <label class="fw-500" for="tempat">Username</label>
            <input class="form-control border-grey" id="username" name="username" required />
          </div>
          <div class="form-group">
            <label class="fw-500" for="role">Role</label>
            <select class="form-control border-grey" id="role" name="role" required>
              <option value="">- Pilih -</option>
              <option value="kakanwil">Kepala Kantor Wilayah</option>
              <option value="pimti">Pimpinan Tinggi Pratama</option>
              <option value="satker">Satker</option>

            </select>
          </div>
          <div class="form-group">
            <label class="fw-500" for="password">Password</label>
            <input class="form-control border-grey" id="password" type="password" name="password" required />
          </div>
          <div class="form-group">
            <label class="fw-500" for="konfirmasi password">Konfirmasi Password</label>
            <input class="form-control border-grey" id="password2" type="password" name="password2" required />
          </div>
          <div class="text-right">
            <button class="btn btn-secondary cur-p float-left" data-dismiss="modal" name="">
              Kembali
            </button>
            <button class="btn btn-success cur-p" name="">
              Simpan
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>