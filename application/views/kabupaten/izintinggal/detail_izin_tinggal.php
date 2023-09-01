<?php foreach ($izintinggal as $row):?>

    <div class="modal fade" id="detail_izin_tinggal<?php echo $row['id']; ?>">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="bd p-15"><h5 class="m-0">Detail Data Izin Tinggal</h5></div>
                <div class="modal-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped" width="100%">
                            <tbody>
                            <!--id
id_user
nama
negara
jenis_kelamin
no_paspor
alamat
penjamin
status
url_data_dukung
created_at
updated_at
id_zona
-->
                            <tr>
                                <th valign="top" width="160">Nama </th>
                                <th valign="top" width="1">:</th>
                                <td><?php echo $row['nama']; ?></td>
                            </tr>

                            <tr>
                                <th valign="top" width="160">Negara </th>
                                <th valign="top" width="1">:</th>
                                <td><?php echo ucfirst($row['negara']); ?></td>
                            </tr>

                            <tr>
                                <th valign="top" width="160">Jenis Kelamin </th>
                                <th valign="top" width="1">:</th>
                                <td><?php echo ucfirst($row['jenis_kelamin']); ?></td>
                            </tr>

                            <tr>
                                <th valign="top" width="160">No Paspor </th>
                                <th valign="top" width="1">:</th>
                                <td><?php echo $row['no_paspor']; ?></td>
                            </tr>
                            <tr>
                                <th valign="top" width="160">Alamat </th>
                                <th valign="top" width="1">:</th>
                                <td><?php echo $row['alamat']; ?></td>
                            </tr>

                            </tr>
                            <tr>
                                <th valign="top" width="160">Penjamin </th>
                                <th valign="top" width="1">:</th>
                                <td><?php echo $row['penjamin']; ?></td>
                            </tr>
                            <tr>
                                <th valign="top" width="160">Status </th>
                                <th valign="top" width="1">:</th>
                                <td><?php echo ucfirst(explode('_',$row['status'])[0]??'').' ' .ucfirst(explode('_',$row['status'])[1]??'')  ; ?></td>
                            </tr>

                            <tr>
                                <th valign="top" width="160">Zona </th>
                                <th valign="top" width="1">:</th>
                                <td><?php echo $datazona['nama_panjang'];?></td>
                            </tr>



                            <?php foreach ($this->Mcrud->url_data_dukung($row['url_data_dukung']) as $key => $element): ?>
                                <tr>
                                    <th valign="top" width="160"><?php if($key == 0): ?>Data Dukung<?php endif; ?></th>
                                    <th valign="top" width="1"><?php if($key == 0): ?>:<?php endif; ?></th>

                                    <td>
                                        <a target="_blank" href="<?= base_url($element); ?>">
                                            <?php echo explode("/", $element)[2]; ?>
                                        </a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="text-right">
                        <button
                            class="btn btn-primary cur-p"
                            data-dismiss="modal"
                            name="">
                            Close
                        </button>
                    </div>

                </div>
            </div>
        </div>
    </div>

<?php endforeach; ?>


