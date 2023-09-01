<div class="modal fade" id="add_bahan_berita">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="bd p-15">
                <h5 class="m-0">Tambah Bahan Berita</h5>
            </div>
            <div class="modal-body">
                <form method="POST" action="bahan_berita/v/t" enctype="multipart/form-data">
                    <div class="form-group" for="berita_what">
                        <label class="fw-500" style="font-weight: bold">What (Apa)</label>
                        <br>

                        <label class="fw-400">Apa nama kegiatan yang diselenggarakan di UPT.
                            Contoh: Pembinaan Rohani Warga Binaan di Lapas Mataram</label>
                        <textarea class="form-control border-grey" rows="5" name="berita_what" id="berita_what" required></textarea>
                    </div>
                    <br>

                    <div class="form-group" for="berita_where">
                        <label class="fw-500" style="font-weight: bold">Where (Di mana)</label>
                        <br>

                        <label class="fw-400">Di mana kegiatan tersebut diselenggarakan.
                            Contoh: Ruang Legal Drafter Kanwil Kemenkumham NTB
                        </label>
                        <textarea class="form-control border-grey" rows="5" name="berita_where" id="berita_where" required></textarea>
                    </div>
                    <br>

                    <div class="form-group">

                        <label class="fw-500" style="font-weight: bold">When (Kapan)</label>
                        <br>

                        <label class="fw-400">Kapan kegiatan tersebut diselenggarakan.
                        </label>
                        <div class="timepicker-input input-icon form-group">
                            <div class="input-group">
                                <div class="icon-agenda bgc-white bd bdwR-0">
                                    <i class="ti-calendar"></i>
                                </div>
                                <input type="text" class="form-control border-grey start-date" placeholder="Pilih tanggal" data-provide="datepicker" data-date-format="d-M-yyyy" name="berita_when" id="berita_when" required />
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="form-group" for="berita_who">
                        <label class="fw-500" style="font-weight: bold">Who (Siapa)</label>
                        <br>

                        <label class="fw-400">Siapa tokoh/pejabat/tamu yang hadir pada kegiatan tersebut.
                            Contoh: Kepala Kantor Wilayah Kemenkumham NTB Romi Yudianto mengunjungi Kantor Imigrasi Kelas I TPI Mataram, Senin (13/2).
                        </label>
                        <textarea class="form-control border-grey" rows="5" name="berita_who" id="berita_who" required></textarea>
                    </div>
                    <br>
                    <div class="form-group" for="berita_why">
                        <label class="fw-500" style="font-weight: bold">Why (Mengapa)</label>
                        <br>

                        <label class="fw-400">Mengapa kegiatan tersebut dilaksanakan. Contoh: Romi Yudianto berkunjung ke Kantor Imigrasi Kelas I TPI Mataram dalam rangka monitoring dan evaluasi.
                        </label>
                        <textarea class="form-control border-grey" rows="5" name="berita_why" id="berita_why" required></textarea>
                    </div>
                    <br>
                    <div class="form-group" for="berita_how">
                        <label class="fw-500" style="font-weight: bold">How (Bagaimana)</label>
                        <br>

                        <label class="fw-400">Bagaimana acara tersebut berjalan dan pernyataan (statement) narasumber/pejabat.
                            Contoh: Romi Yudianto dalam sambutan meminta agar para pegawai meningkatkan displin dan terus meningkatkan kualitas pelayanan publik.
                        </label>
                        <textarea class="form-control border-grey" rows="5" name="berita_how" id="berita_how" required></textarea>
                    </div>
                    <br>
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
                        <button class="btn btn-success cur-p" name="">
                            Simpan
                        </button>
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
</script>