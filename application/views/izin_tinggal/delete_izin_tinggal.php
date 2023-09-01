<?php foreach ($izintinggal as $dt) : ?>

    <div class="modal fade" id="delete_izin_tinggal<?php echo $dt['id']; ?>">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="bd p-15">
                    <h5 class="m-0">Hapus Data Izin Tinggal </h5>
                </div>
                <div class="modal-body">
                    <form method="POST" action="izintinggal/data_itk/<?php echo hashids_encrypt($datazona['id']);?>/h/<?php echo hashids_encrypt($dt['id']);?>">

                        <div>Apakah Anda yakin akan menghapus data?</div>
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