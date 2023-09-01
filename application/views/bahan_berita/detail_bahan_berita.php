<?php foreach ($bahan_berita as $row):?>

    <div class="modal fade" id="detail_bahan_berita<?php echo $row['id']; ?>">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="bd p-15"><h5 class="m-0">Detail Bahan Berita</h5></div>
                <div class="modal-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped" width="100%">
                            <tbody>
                            <tr>
                                <th valign="top" width="160">What (Apa)</th>
                                <th valign="top" width="1">:</th>
                                <td><?php echo $row['berita_what']; ?></td>
                            </tr>
                            <tr>
                                <th valign="top" >Where (Dimana)</th>
                                <th valign="top">:</th>
                                <td><?php echo $row['berita_where']; ?></td>
                            </tr>
                            <tr>
                                <th valign="top" width="160">When (Kapan)</th>
                                <th valign="top" width="1">:</th>
                                <td><?php echo $this->Mcrud->hari_id($row['berita_when']) . ", " . $this->Mcrud->tgl_id($row['berita_when'], 'full'); ?></td>
                            </tr>
                            <tr>
                                <th valign="top" width="160">Who (Siapa)</th>
                                <th valign="top" width="1">:</th>
                                <td><?php echo $row['berita_who']; ?></td>
                            </tr>
                            <tr>
                                <th valign="top" width="160">Why (Mengapa)</th>
                                <th valign="top" width="1">:</th>
                                <td><?php echo $row['berita_why']; ?></td>
                            </tr>
                            <tr>
                                <th valign="top" width="160">How (Bagaimana)</th>
                                <th valign="top" width="1">:</th>
                                <td><?php echo $row['berita_how']; ?></td>
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


