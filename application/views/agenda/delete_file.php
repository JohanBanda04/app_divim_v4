<?php foreach ($agenda as $row):?>

  <div class="modal fade" id="delete_agenda<?php echo $row['id']; ?>">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="bd p-15"><h5 class="m-0">Hapus Agenda Kegiatan</h5></div>
        <div class="modal-body">
          <form method="POST" action="agenda/v/hf">
            <input type="hidden" value="<?php echo $row['id']; ?>" name="id_agenda" />
            <div>Apakah Anda yakin akan menghapus agenda ini?</div>
            <hr>
            <div class="text-right">
              <button
                class="btn btn-primary cur-p float-left"
                data-dismiss="modal"
                name=""
              >
                Tidak
              </button>
              <button
                class="btn btn-danger cur-p"
                name=""
              >
                Ya
              </button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>

<?php endforeach; ?>


    