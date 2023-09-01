<?php foreach ($bahan_berita as $row) : ?>

    <div class="modal fade" id="edit_bahan_berita<?php echo $row['id'] ?>">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="bd p-15">
                    <h5 class="m-0">Ubah Bahan Berita</h5>
                </div>
                <div class="modal-body">
                    <form method="POST" action="bahan_berita/v/e" enctype="multipart/form-data">
                        <input type="hidden" value="<?php echo $row['id']; ?>" name="id_bahan_berita" />
                        <div class="form-group" for="berita_what">
                            <label class="fw-500" style="font-weight: bold">What (Apa)</label>
                            <br>

                            <label class="fw-400">Apa nama kegiatan yang diselenggarakan di UPT.
                                Contoh: Pembinaan Rohani Warga Binaan di Lapas Mataram</label>
                            <textarea class="form-control border-grey" rows="5" name="berita_what" id="berita_what" required><?php echo $row['berita_what'] ?></textarea>
                        </div>
                        <br>

                        <div class="form-group" for="berita_where">
                            <label class="fw-500" style="font-weight: bold">Where (Di mana)</label>
                            <br>

                            <label class="fw-400">Di mana kegiatan tersebut diselenggarakan.
                                Contoh: Ruang Legal Drafter Kanwil Kemenkumham NTB
                            </label>
                            <textarea class="form-control border-grey" rows="5" name="berita_where" id="berita_where" required><?php echo $row['berita_where'] ?></textarea>
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
                                    <?php
                                    $tanggal = $this->Mcrud->tgl_english($row['berita_when'], 'full');
                                    ?>
                                    <input value="<?php echo $tanggal; ?>" type="text" class="form-control border-grey start-date" placeholder="Pilih tanggal" data-provide="datepicker" data-date-format="d-M-yyyy" name="berita_when" id="berita_when" required />
                                </div>
                            </div>
                        </div>
                        <br>
                        <div class="form-group" for="berita_who">
                            <label class="fw-500" style="font-weight: bold">Who (Siapa)</label>
                            <br>

                            <label class="fw-400">Siapa tokoh/pejabat/tamu yang hadir pada kegiatan tersebut.
                                Contoh: Kepala Kantor Wilayah Kemenkumham NTB Romi Yudianto mengunjungi Kantor Imigrasi
                                Kelas I TPI Mataram, Senin (13/2).
                            </label>
                            <textarea class="form-control border-grey" rows="5" name="berita_who" id="berita_who" required><?php echo $row['berita_who']; ?></textarea>
                        </div>
                        <br>
                        <div class="form-group" for="berita_why">
                            <label class="fw-500" style="font-weight: bold">Why (Mengapa)</label>
                            <br>

                            <label class="fw-400">Mengapa kegiatan tersebut dilaksanakan.
                                Contoh: Romi Yudianto berkunjung ke Kantor Imigrasi Kelas I TPI Mataram dalam rangka monitoring dan evaluasi.
                            </label>
                            <textarea class="form-control border-grey" rows="5" name="berita_why" id="berita_why" required><?php echo $row['berita_why']; ?></textarea>
                        </div>
                        <br>
                        <div class="form-group" for="berita_how">
                            <label class="fw-500" style="font-weight: bold">How (Bagaimana)</label>
                            <br>

                            <label class="fw-400">Bagaimana acara tersebut berjalan dan pernyataan (statement)
                                narasumber/pejabat.
                                Contoh: Romi Yudianto dalam sambutan meminta agar para pegawai meningkatkan displin dan
                                terus meningkatkan kualitas pelayanan publik.
                            </label>
                            <textarea class="form-control border-grey" rows="5" name="berita_how" id="berita_how" required><?= $row['berita_how']; ?></textarea>
                        </div>
                        <br>
                        <div class="form-group">
                            <label class="fw-500">Upload Foto Dokumentasi Kegiatan</label>
                            <br>
                            <button class="btn btn-success mB-10" id="add-more-edit-<?php echo $row['id']; ?>" type="button">
                                <i class="fa fa-plus-circle" aria-hidden="true"></i> Tambah / Ubah file
                            </button>
                            <div id="auth-rows-edit-<?php echo $row['id']; ?>"></div>
                        </div>

                        <div class="mb-4">
                            <ul>
                                <?php

                                $files = json_decode($row['url_data_dukung']);
                                foreach ($files as $key => $file) { ?>
                                    <li style="display: flex ; justify-content: space-between" id="list-file-<?= $key ?>-<?= $row['id']; ?>">
                                        <div style="max-width:300px; overflow: hidden "><a target="_blank" href="<?= base_url($file); ?>" class="wrap-text">
                                                <?php echo explode("/", $file)[2]; ?>
                                            </a></div>
                                        <a href="javascript:;" class="td-n c-red-500 cH-blue-500 fsz-md p-5" onclick="deleteFile('<?php echo $file; ?>',<?= $key ?>,<?= $row['id']; ?>)">
                                            <i class="ti-trash"></i>
                                        </a>
                                    </li>

                                <?php }
                                ?>
                            </ul>
                        </div>
                        <div class="text-right">
                            <button class="btn btn-secondary cur-p float-left" data-dismiss="modal" name="">
                                Kembali
                            </button>
                            <button class="btn btn-success cur-p" name="">
                                Update Data
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

    var currentId = 0;

    $("[id^='add-more-edit-']").click(function(e) {

        var html4 = '<div class="form-group input-dinamis-edit"><div class="row"><div class="col-input-dinamis-edit col-lg-10"><input type="file" name="url_files_edit[]" class="form-control border-grey" id="peserta" placeholder="Upload file" required></div><div class="col-input-dinamis-edit col-lg-2"><button class="btn btn-danger remove-edit" type="button"><i class="fa fa-minus-circle"></i></button></div></div></div>';

        $("[id^='auth-rows-edit-']").append(html4);
    });

    $("[id^='auth-rows-edit-']").on('click', '.remove-edit', function(e) {
        e.preventDefault();
        $(this).parents('.input-dinamis-edit').remove();
    });

    function deleteFile($path, $file_id, $row_id) {

        if (confirm("Hapus File Lampiran?") == true) {

            $.post("bahan_berita/v/df", {
                path: $path,
                id: $row_id,
                file_id: $file_id
            }).done(function(response) {
                $("#list-file-" + $file_id + "-" + $row_id).remove();
            });
        }
    }
</script>