<div class="modal fade" id="add_izin_tinggal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="bd p-15">
                <h5 class="m-0">Tambah Data Izin Tinggal <span style="color: #b52317"><?php echo $datazona['nama_panjang'];?></span></h5>
            </div>
            <div class="modal-body">
                <form method="POST" action="izintinggal/data_itk/<?php echo hashids_encrypt($datazona['id']);?>/t" enctype="multipart/form-data">
                    <div class="form-group">
                        <label class="fw-500" for="nama">Nama </label>
                        <input class="form-control border-grey" id="nama" name="nama" required />
                    </div>
                    <div class="form-group">
                        <label class="fw-500" for="negara">Negara </label>
                        <input class="form-control border-grey" id="negara" name="negara" required />
                    </div>

                    <div class="form-group">
                        <label class="fw-500" for="jenis_kelamin">Jenis Kelamin </label>

                        <select class="form-control default-select2" id="jenis_kelamin" name="jenis_kelamin"
                                 required>
                            <option value="">- Pilih -</option>
                            <option value="pria" <?php if('pria'==$link5){echo "selected";} ?> >Pria</option>
                            <option value="wanita" <?php if('wanita'==$link5){echo "selected";} ?> >Wanita</option>

                        </select>


                    </div>

                    <div class="form-group">
                        <label class="fw-500" for="status">Status </label>

                        <select class="form-control default-select2" id="status" name="status"
                                required>
                            <option value="">- Pilih -</option>
                            <option value="belum_diproses"  >Belum Diproses</option>
                            <option value="sedang_diproses"  >Sedang Diproses</option>
                            <option value="selesai"  >Selesai</option>

                        </select>


                    </div>
                    <?php if (hashids_decrypt($zona_id)==0){ ?>
                        <div class="form-group">
                            <label class="fw-500" for="status">Pilih Daerah </label>

                            <select required class="form-control default-select2" id="pilih_zona" name="pilih_zona">
                                <option value="">- Pilih -</option>
                                <?php foreach ($datazona_all as $index=>$zona) {
                                    if($zona['id']!="64" && $zona['id']!="65" && $zona['id']!='1'){ ?>
                                        <option value="<?php echo hashids_encrypt($zona['id'])?>"  ><?php echo $zona['nama_panjang']?></option>

                                    <?php } ?>
                                <?php } ?>


                            </select>


                        </div>
                    <?php } ?>

                    <div class="form-group">
                        <!--cara convert uppercase inputan-->
                        <label class="fw-500" for="nama">No. Paspor </label>
                        <input onkeyup="this.value = this.value.toUpperCase();" class="form-control border-grey" id="no_paspor" name="no_paspor" required />
                    </div>

                    <div class="form-group">
                        <label class="fw-500" for="nama">Alamat </label>
                        <input class="form-control border-grey" id="alamat" name="alamat" required />
                    </div>

                    <div class="form-group">
                        <label class="fw-500" for="nama">Penjamin </label>
                        <input class="form-control border-grey" id="penjamin" name="penjamin" required />
                    </div>

                    <div class="form-group">
                        <label class="fw-500">Upload Foto Dokumentasi Kegiatan</label>
                        <br>
                        <button class="btn btn-success mB-10" id="add-more" type="button">
                            <i class="fa fa-plus-circle" aria-hidden="true"></i> Tambah Foto
                        </button>
                        <small class="lh-1 c-red-500"><i>.jpg .jpeg .png</i></small>
                        <div id="auth-rows"></div>
                    </div>
                    <div class="form-group">
                        <div class="g-recaptcha" data-sitekey="6LfUAE8mAAAAAGv4HnOTyYq3q-xedw0ethHsKO4H"></div>
                    </div>

                    <div class="text-right">
                        <button class="btn btn-secondary cur-p float-left" data-dismiss="modal" name="">
                            Kembali
                        </button>
                        <button class="btn btn-success cur-p" name="btn_simpan_logged_in" id="btn_simpan_logged_in">
                            Simpan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>



<script type="text/javascript">


    $(document).on('click', '#btn_simpan_logged_in', function() {
        var response = grecaptcha.getResponse();
        if (response.length == 0) {
            alert("Please verify you are not a robot.");
            return false;
        }
    });
    $('.clockpicker').clockpicker();

    $("#add-more").click(function(e) {

        var html3 = '<div class="form-group input-dinamis">' +
            '<div class="row">' +
            '<div class="col-input-dinamis col-lg-10">' +
            '<input type="file" name="url_files[]" class="form-control border-grey" id="peserta" ' +
            'placeholder="Upload file" required>' +
            '</div>' +
            '<div class="col-input-dinamis col-lg-2">' +
            '<button class="btn btn-danger remove" type="button">' +
            '<i class="fa fa-minus-circle"></i>' +
            '</button>' +
            '</div>' +
            '</div>' +
            '</div>';

        $('#auth-rows').append(html3);
    });

    $('#auth-rows').on('click', '.remove', function(e) {
        e.preventDefault();
        $(this).parents('.input-dinamis').remove();
    });
</script>