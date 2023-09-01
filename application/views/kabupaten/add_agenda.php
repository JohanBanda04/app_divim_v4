<div class="modal fade" id="add_agenda">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="bd p-15">
        <h5 class="m-0">Tambah Agenda Kegiatan</h5>
      </div>
      <div class="modal-body">
          <!--ini cara kunci kesuksesan gunakan link aksi controller-->
        <form method="POST" action="agenda/v/t" enctype="multipart/form-data">
          <div class="form-group">
            <label class="fw-500" for="nama">Nama Kegiatan</label>
            <input class="form-control border-grey" id="nama" name="nama" required />
          </div>
          <div class="form-group">
            <label class="fw-500" for="tanggal">Tanggal</label>
            <div class="timepicker-input input-icon form-group">
              <div class="input-group">
                <div class="icon-agenda bgc-white bd bdwR-0">
                  <i class="ti-calendar"></i>
                </div>
                <input type="text" class="form-control border-grey start-date" placeholder="Pilih tanggal" data-provide="datepicker" data-date-format="d-M-yyyy" name="tanggal" id="tanggal" required />
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-6">
              <label class="fw-500" for="jam_mulai">Jam Mulai</label>
              <div class="clockpicker input-icon form-group" data-autoclose="true">
                <div class="input-group">
                  <div class="icon-agenda bgc-white bd bdwR-0">
                    <i class="ti-time"></i>
                  </div>
                  <input type="text" class="form-control border-grey" placeholder="Pilih jam" name="jam_mulai" id="jam_mulai" required />
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <label class="fw-500" for="jam_selesai">Jam Selesai</label>
              <div class="clockpicker input-icon form-group" data-autoclose="true">
                <div class="input-group">
                  <div class="icon-agenda bgc-white bd bdwR-0">
                    <i class="ti-time"></i>
                  </div>
                  <input type="text" class="form-control border-grey" placeholder="Pilih jam" name="jam_selesai" id="jam_selesai" required />
                </div>
              </div>
            </div>
          </div>
          <div class="form-group">
            <label class="fw-500" for="tempat">Tempat Kegiatan</label>
            <input class="form-control border-grey" id="tempat" name="tempat" required />
          </div>
          <div class="form-group">
            <label class="fw-500" for="pakaian">Pakaian</label>
            <input class="form-control border-grey" id="pakaian" name="pakaian" required />
          </div>
          <div class="form-group">
            <label class="fw-500" for="pejabat">Pejabat yang Menghadiri</label>
            <input class="form-control border-grey" id="pejabat" name="pejabat" required />
          </div>
          <div class="form-group">
            <label class="fw-500" for="peserta">Peserta Kegiatan</label>
            <input class="form-control border-grey" id="peserta" name="peserta" required />
          </div>
          <div class="form-group">
            <label class="fw-500" for="penanggungjawab">Penanggung jawab Kegiatan</label>
            <input class="form-control border-grey" id="penanggungjawab" name="penanggungjawab" required />
          </div>
          <div class="form-group" for="deskripsi">
            <label class="fw-500">Deskripsi Kegiatan</label>
            <textarea class="form-control border-grey" rows="5" name="deskripsi" id="deskripsi" required></textarea>
          </div>
          <div class="form-group">
            <label class="fw-500">Upload File SK / SP / Nodin / Undangan / Paparan / data pendukung lainnya</label>
            <button class="btn btn-success mB-10" id="add-more" type="button">
              <i class="fa fa-plus-circle" aria-hidden="true"></i> Tambah file
            </button>
            <small class="lh-1 c-red-500"><i>.pdf .doc .docx .ppt .pptx</i></small>
            <div id="auth-rows"></div>
          </div>

          <div class="form-group">
            <div class="g-recaptcha" data-sitekey="6LfUAE8mAAAAAGv4HnOTyYq3q-xedw0ethHsKO4H"></div>
          </div>

          <div class="text-right">
            <button class="btn btn-secondary cur-p float-left" data-dismiss="modal" name="">
              Kembali
            </button>
            <input type="submit" id="login" class="btn btn-success cur-p" value="Simpan" />
          </div>
        </form>
      </div>
    </div>
  </div>
</div>



<script type="text/javascript">
  $('.clockpicker').clockpicker();

  $("#add-more").click(function(e) {

    var html3 = '<div class="form-group input-dinamis"><div class="row"><div class="col-input-dinamis col-lg-10"><input type="file" name="url_files[]" class="form-control border-grey" id="peserta" placeholder="Upload file" required></div><div class="col-input-dinamis col-lg-2"><button class="btn btn-danger remove" type="button"><i class="fa fa-minus-circle"></i></button></div></div></div>';

    $('#auth-rows').append(html3);
  });

  $('#auth-rows').on('click', '.remove', function(e) {
    e.preventDefault();
    $(this).parents('.input-dinamis').remove();
  });

  $(document).on('click', '#login', function() {
    var response = grecaptcha.getResponse();
    if (response.length == 0) {
      alert("Please verify you are not a robot.");
      return false;
    }
  });
</script>