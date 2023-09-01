<?php foreach ($izintinggal as $row) : ?>

    <div class="modal fade" id="edit_izin_tinggal<?php echo $row['id'] ?>">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="bd p-15">
                    <h5 class="m-0">Ubah Data Izin Tinggal <?php echo $row['id_zona']; ?></h5>
                </div>
                <div class="modal-body">
                    <form method="POST" action="izintinggal/data_itk/<?php echo $zona_id; ?>/e" enctype="multipart/form-data">
                        <input type="hidden" value="<?php echo $row['id']; ?>" name="id_dataitk" />

                        <div class="form-group">
                            <label class="fw-500" for="nama">Nama </label>
                            <input class="form-control border-grey" value="<?php echo $row['nama'];?>"
                                   id="nama" name="nama" required />
                        </div>

                        <div class="form-group">
                            <label class="fw-500" for="negara">Negara </label>
                            <input class="form-control border-grey" value="<?php echo ucfirst($row['negara']);?>"
                                   id="negara" name="negara" required />
                        </div>

                        <div class="form-group">
                            <label class="fw-500" for="jenis_kelamin">Jenis Kelamin </label>

                            <select class="form-control default-select2" id="jenis_kelamin" name="jenis_kelamin"
                                    required>
                                <option value="">- Pilih -</option>
                                <option value="pria" <?php if('pria'==$row['jenis_kelamin']){echo "selected";} ?> >Pria</option>
                                <option value="wanita" <?php if('wanita'==$row['jenis_kelamin']){echo "selected";} ?> >Wanita</option>

                            </select>


                        </div>

                        <div class="form-group">
                            <label class="fw-500" for="status">Status </label>

                            <select class="form-control default-select2" id="status" name="status"
                                    required>
                                <option value="">- Pilih -</option>
                                <option value="belum_diproses" <?php if($row['status']=='belum_diproses'){ ?> selected <?php } ?> >Belum Diproses</option>
                                <option value="sedang_diproses"  <?php if($row['status']=='sedang_diproses'){ ?> selected <?php } ?> >Sedang Diproses</option>
                                <option value="selesai"  <?php if($row['status']=='selesai'){ ?> selected <?php } ?> >Selesai</option>

                            </select>


                        </div>

                        <div class="form-group">
                            <label class="fw-500" for="nama">No. Paspor </label>
                            <input class="form-control border-grey" value="<?php echo ($row['no_paspor']);?>"
                                   id="no_paspor" name="no_paspor" required />
                        </div>

                        <div class="form-group">
                            <label class="fw-500" for="nama">Alamat </label>
                            <input class="form-control border-grey" value="<?php echo ($row['alamat']);?>"
                                   id="alamat" name="alamat" required />
                        </div>

                        <div class="form-group">
                            <label class="fw-500" for="nama">Penjamin </label>
                            <input class="form-control border-grey" value="<?php echo ($row['penjamin']);?>"
                                   id="penjamin" name="penjamin" required />
                        </div>



                        <div class="form-group" style="background-color: ">
                            <!--                        <label class="fw-500">Upload File SK / SP / Nodin / Undangan / Paparan / data pendukung lainnya</label>-->
                            <label class="col-lg-11" style="background-color:  ">Foto-foto</label>
                            <br>

                            <button onclick="addFile(<?php echo ($row['id']);?>)"
                                    class="<?php if($status=="selesai"){ ?> hidden <?php } ?> btn btn-success m-l-15"
                                    id="add-more-edit-<?php echo ($row['id']);?>" type="button"
                                    style="background-color: ">
                                <i class="fa fa-plus-circle" aria-hidden="true"></i> Tambah Foto
                            </button>
                            <div id="show-file-list-<?php echo ($row['id']);?>"></div>

                            <div id="auth-rows"></div>
                        </div>
                        <input type="hidden" value="<?php echo ($row['url_data_dukung']);?>" name="foto_foto">
                        <input type="hidden" value="<?php echo ($row['id']);?>" name="id_dataitk">

                        <div class="mb-4">
                            <ul>
                                <?php

                                $files = json_decode($row['url_data_dukung']);
                                foreach ($files as $key => $file) { ?>
                                    <li style="display: flex ; justify-content: space-between" id="list-file-<?= $key ?>-<?= $row['id']; ?>">
                                        <div style="max-width:300px; overflow: hidden "><a target="_blank" href="<?= base_url($file); ?>" class="wrap-text">
                                                <?php echo explode("/", $file)[2]; ?>
                                            </a></div>
                                        <a href="javascript:;" class="td-n c-red-500 cH-blue-500 fsz-md p-5"
                                           onclick="deleteFile('<?php echo $file; ?>',<?= $key ?>,<?= $row['id']; ?>,'<?php echo $zona_id; ?>')">
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



    function deleteFile($path, $file_id, $row_id, $zona_id) {

        if (confirm("Hapus File Lampiran?") == true) {

            // $.post("bahan_berita/v/df", {
            $.post("izintinggal/data_itk/"+$zona_id+"/df", {
                path: $path,
                id: $row_id,
                file_id: $file_id
            }).done(function(response) {
                $("#list-file-" + $file_id + "-" + $row_id).remove();
            });
        }
    }

    //$("#add-more").click(function(e){
    $("#add-more-edit").click(function(e){

        var html3 = '<div class="form-group input-dinamis m-20">' +
            '<div class="row">' +
            '<div class="col-input-dinamis col-lg-10 ">' +
            '<input type="file" name="url_files_edit[]" class="form-control border-grey" ' +
            'id="peserta" placeholder="Upload file" required>' +
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

    function checkFileExtension_edit(id) {
        fileName = document.querySelector('#'+id).value;
        extension = fileName.split('.').pop();

        if(extension != "jpg" && extension != "jpeg" && extension != "png"){
            alert("ekstensi file harus JPG, JPEG, atau PNG");

            document.querySelector('#' + id).value = '';
        }
        const oFile = document.getElementById(id).files[0];
        console.log(id);
        console.log(oFile);

        if (oFile.size > 5*1024*1024) // 500Kb for bytes.
        {
            alert("size file terlalu besar");

            document.querySelector('#' + id).value = '';
        }
    }

    function removeFile(element){
        console.log("xxxx");
        document.getElementById(element).remove();
    }

    var count = 0;

    function addFile($row_id){
        console.log($row_id);
        let elementId = "input-file-element-"+count;
        let divId = "input-dinamis-edit-"+count;
        var html4 = '<div class="form-group input-dinamis m-20" id="'+divId+'">' +
            '<div class="row">' +
            '<div class="col-input-dinamis col-lg-10 ">' +
            '<input type="file" name="url_files_edit[]" class="form-control border-grey" ' +
            'id="'+elementId+'" onchange="checkFileExtension_edit('+"'"+elementId+"'"+')" ' +
            'placeholder="Upload file" required>' +
            '</div>' +
            '<div class="col-input-dinamis col-lg-2">' +
            '<button class="btn btn-danger remove-edit" ' +
            'onclick="removeFile('+"'"+divId+"'"+')" type="button">' +
            '<i class="fa fa-minus-circle"></i>' +
            '</button>' +
            '</div>' +
            '</div>' +
            '</div>';
        $('#show-file-list-'+$row_id).append(html4);
        count++;
    }
</script>