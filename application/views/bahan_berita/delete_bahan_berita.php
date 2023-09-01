<?php foreach ($bahan_berita as $row) : ?>

    <div class="modal fade" id="delete_bahan_berita<?php echo $row['id']; ?>">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="bd p-15">
                    <h5 class="m-0">Hapus Bahan Berita</h5>
                </div>
                <div class="modal-body">
                    <form method="POST" action="bahan_berita/v/h">
                        <input type="hidden" value="<?php echo $row['id']; ?>" name="id_bahan_berita" />
                        <div>Apakah Anda yakin akan menghapus bahan berita ini?</div>
                        <hr>
                        <div class="text-right">
                            <button class="btn btn-primary cur-p float-left" data-dismiss="modal" name="">
                                Tidak
                            </button>
                            <button class="btn btn-danger cur-p" name="">
                                Ya
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

<?php endforeach; ?>