<?php foreach ($agenda as $row): ?>

    <div class="modal fade" id="proses_agenda<?php echo $row['id']; ?>">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="bd p-15"><h5 class="m-0">Proses Agenda Kegiatan</h5></div>
                <div class="modal-body">
                    <form method="POST" action="agenda/v/p" enctype="multipart/form-data">
                        <input type="hidden" value="<?php echo $row['id']; ?>" name="id_agenda"/>
                        <div class="form-group">
                            <label class="fw-500" for="status">Ubah Status</label>
                            <select class="form-control border-grey" id="status" name="status" required>
                                <option value="">- Pilih -</option>
                                <option value="sudah">Sudah disetujui</option>
                                <option value="tolak">Ditolak / Perlu koreksi</option>
                            </select>
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