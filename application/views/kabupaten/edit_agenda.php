<?php foreach ($agenda as $row) : ?>

    <div class="modal fade" id="edit_agenda<?php echo $row['id']; ?>">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="bd p-15">
                    <h5 class="m-0">Ubah Agenda Kegiatan</h5>
                </div>
                <div class="modal-body">
                    <form method="POST" action="agenda/v/e" enctype="multipart/form-data">
                        <input type="hidden" value="<?php echo $row['id']; ?>" name="id_agenda" />
                        <div class="form-group">
                            <label class="fw-500" for="nama">Nama Kegiatan</label>
                            <input class="form-control border-grey" id="nama" name="nama" value="<?php echo $row['nama'] ?>" required />
                        </div>
                        <div class="form-group">
                            <label class="fw-500" for="tanggal">Tanggal</label>
                            <div class="timepicker-input input-icon form-group">
                                <div class="input-group">
                                    <div class="icon-agenda bgc-white bd bdwR-0">
                                        <i class="ti-calendar"></i>
                                    </div>
                                    <input type="text" class="form-control border-grey start-date" placeholder="Pilih tanggal" data-provide="datepicker" data-date-format="d-M-yyyy" name="tanggal" id="tanggal" value="<?php echo date('d-M-Y', strtotime($row['tanggal'])); ?>" required />
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
                                        <input type="text" class="form-control border-grey" placeholder="Pilih jam" name="jam_mulai" id="jam_mulai" value="<?php echo $row['jam_mulai'] ?>" required />
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
                                        <input type="text" class="form-control border-grey" placeholder="Pilih jam" name="jam_selesai" id="jam_selesai" value="<?php echo $row['jam_selesai'] ?>" required />
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="fw-500" for="tempat">Tempat Kegiatan</label>
                            <input class="form-control border-grey" id="tempat" name="tempat" value="<?php echo $row['tempat'] ?>" required />
                        </div>
                        <div class="form-group">
                            <label class="fw-500" for="pakaian">Pakaian</label>
                            <input class="form-control border-grey" id="pakaian" name="pakaian" value="<?php echo $row['pakaian'] ?>" required />
                        </div>
                        <div class="form-group">
                            <label class="fw-500" for="pejabat">Pejabat yang Menghadiri</label>
                            <input class="form-control border-grey" id="pejabat" name="pejabat" value="<?php echo $row['pejabat'] ?>" required />
                        </div>
                        <div class="form-group">
                            <label class="fw-500" for="peserta">Peserta Kegiatan</label>
                            <input class="form-control border-grey" id="peserta" name="peserta" value="<?php echo $row['peserta'] ?>" required />
                        </div>
                        <div class="form-group">
                            <label class="fw-500" for="penanggungjawab">Penanggung jawab Kegiatan</label>
                            <input class="form-control border-grey" id="penanggungjawab" name="penanggungjawab" value="<?php echo $row['penanggungjawab'] ?>" required />
                        </div>
                        <div class="form-group" for="deskripsi">
                            <label class="fw-500">Deskripsi Kegiatan</label>
                            <textarea class="form-control border-grey" rows="5" name="deskripsi" id="deskripsi" required><?php echo $row['deskripsi'] ?></textarea>
                        </div>
                        <div class="form-group">
                            <label class="fw-500">Upload File SK / SP / Nodin / Undangan / Paparan / data pendukung
                                lainnya</label>
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
                                    <li style="display: flex; justify-content: space-between" id="list-file-<?= $key ?>-<?= $row['id']; ?>">
                                        <a target="_blank" href="<?= base_url($file); ?>" class="wrap-text">
                                            <?php echo explode("/", $file)[2]; ?>
                                        </a>
                                        <a href="javascript:;" class="td-n c-red-500 cH-blue-500 fsz-md p-5" onclick="deleteFile('<?php echo $file; ?>',<?= $key ?>, <?= $row['id']; ?>)">
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
            $.post("agenda/v/df", {
                id: $row_id,
                path: $path,
                file_id: $file_id
            }).done(function(response) {
                $("#list-file-" + $file_id + "-" + $row_id).remove();
            });
        }
    }
</script>