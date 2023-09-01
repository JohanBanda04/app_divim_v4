<!-- Main content -->
<!-- <div class="content-wrapper"> -->
  <!-- Content area -->
  <!-- <div class="content"> -->

    <!-- Dashboard content -->
    <div class="row">
      <div class="col-md-2"></div>
      <div class="col-md-8">
        <div class="panel panel-inverse">
            <div class="panel-heading">
                <div class="panel-heading-btn">
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
                </div>
                <h4 class="panel-title"><?php echo $judul_web; ?></h4>
            </div>
            <div class="panel-body">
                <?php
                echo $this->session->flashdata('msg');
                $level 	= $this->session->userdata('level');
                $id_user = $this->session->userdata('id_user');
                $link3 = $this->uri->segment(3);

                if ($status_ruangan == 'belum'):
                ?>

                <center>-- Ruangan belum dibersihkan --</center>

                <?php else: ?>
              

              <div class="table-responsive">
			          <table class="table table-bordered table-striped" width="100%">
                  <tbody>
                    <tr>
                      <th valign="top" width="160">Nama Ruangan</th>
                      <th valign="top" width="1">:</th>
                      <td><?php echo ucfirst($this->Mcrud->get_nama_ruangan($status_ruangan['id_ruangan'])); ?></td>
                    </tr>
                    <tr>
                      <th valign="top" width="160">Tanggal</th>
                      <th valign="top" width="1">:</th>
                      <td><?php echo $this->Mcrud->tgl_id(date('d-m-Y', strtotime($status_ruangan['tanggal'])),'full'); ?></td>
                    </tr>
                    <tr>
                      <th valign="top" width="160">Waktu</th>
                      <th valign="top" width="1">:</th>
                      <td><?php echo ucfirst($status_ruangan['waktu']); ?></td>
                    </tr>
                    <tr>
                      <th valign="top">Mr. Clean</th>
                      <th valign="top">:</th>
                      <td><?php echo ucfirst($this->Mcrud->get_user_name_by_id($status_ruangan['id_ob'])); ?></td>
                    </tr>
                    <tr>
                      <th valign="top" width="160">Status</th>
                      <th valign="top" width="1">:</th>
                      <td><?php $this->Mcrud->status_ob($status_ruangan['status_ob'])?></td>
                    </tr>
                    <tr>
                      <th valign="top">Catatan Mr. Clean</th>
                      <th valign="top">:</th>
                      <td><?php if($status_ruangan['catatan_ob'] == '') {
                                echo '-';
                              } else { echo ucfirst($status_ruangan['catatan_ob']); } 
                        ?></td>
                    </tr>
                     <tr>
                      <th valign="top">Pengawas</th>
                      <th valign="top">:</th>
                      <td><?php echo ucfirst($this->Mcrud->get_pengawas_name_by_id($status_ruangan['id_pengawas'])); ?></td>
                    </tr>
                    <tr>
                      <th valign="top" width="160">Status</th>
                      <th valign="top" width="1">:</th>
                      <td><?php $this->Mcrud->status_pengawas($status_ruangan['status_pengawas'])?></td>
                    </tr>
                    <tr>
                      <th valign="top">Catatan Pengawas</th>
                      <th valign="top">:</th>
                      <td>
                        <?php if($status_ruangan['catatan_pengawas'] == '') {
                                echo '-';
                              } else { echo $status_ruangan['catatan_pengawas']; } 
                        ?>
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>

              <hr style="margin-top:0px;">
              <a href="dashboard.html" class="btn btn-default"><< Kembali</a>

              <?php endif; ?>
              
            </div>

        </div>
      </div>
    </div>
    <!-- /dashboard content -->