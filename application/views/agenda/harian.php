<div class="p-10"></div>
<ul class="m-0 p-0">
  <?php
  $ceks    = $this->session->userdata('token_katamaran');
  $id_user  = $this->session->userdata('id_user');
  $level  = $this->session->userdata('level');
  if ($agenda != null) :
    foreach ($agenda as $row) : ?>
      <li class="bdB peers ai-c jc-sb fxw-nw list-jadwal">
        <a class="td-n p-20 peers fxw-nw mR-20 peer-greed c-grey-900 link-agenda" href="javascript:void(0);" data-toggle="modal" data-target="#detail_agenda<?php echo $row['id']; ?>">
          <div class="peer mR-15">
            <i class="fa fa-fw fa-clock-o c-green-500"></i>
          </div>
          <div class="peer wrap-text-agenda">
            <span class="fw-600"><?php echo $row['nama']; ?></span>
            <div class="c-grey-600">
              <span class="c-grey-700"><?php echo $this->Mcrud->jam($row['jam_mulai']); ?> - </span><i><?php echo $row['tempat'] ?></i>
            </div>
            <div class="c-grey-600">
              <span class="c-grey-700"><?php echo $row['pakaian']; ?></span>
            </div>
            <div class="c-grey-600">
              <span class="c-grey-700"><?php echo $row['peserta']; ?></span>
            </div>
            <?php if ($row['status'] == 'belum') : ?>
              <span class="badge bgc-orange-50 c-orange-700 p-10 lh-0 tt-c badge-pill">Belum disetujui</span>
            <?php elseif ($row['status'] == 'sudah') : ?>
              <span class="badge bgc-green-50 c-green-700 p-10 lh-0 tt-c badge-pill">Telah disetujui</span>
            <?php elseif ($row['status'] == 'tolak') : ?>
              <span class="badge bgc-red-50 c-red-700 p-10 lh-0 tt-c badge-pill">Ditolak / Butuh Koreksi</span>
            <?php endif; ?>
          </div>
        </a>
        <div class="peers mR-15">
          <?php
          if (isset($ceks)) :
            if ($level == 'superadmin' or $level == 'sekpim' or $level == 'protokol' or $row['id_user'] == $id_user) : ?>
              <div class="peer">
                <a href="" class="td-n c-deep-purple-500 cH-blue-500 fsz-md p-5" data-toggle="modal" data-target="#edit_agenda<?php echo $row['id']; ?>"><i class="ti-pencil"></i></a>
              </div>
              <div class="peer">
                <a href="" class="td-n c-red-500 cH-blue-500 fsz-md p-5" data-toggle="modal" data-target="#delete_agenda<?php echo $row['id']; ?>"><i class="ti-trash"></i></a>
              </div>
              <div class="peer">
                <a href="" class="td-n c-green-500 cH-blue-500 fsz-md p-5" data-toggle="modal" data-target="#proses_agenda<?php echo $row['id']; ?>"><i class="ti-pencil-alt"></i><span style="font-size: 16px; padding-left: 4px;">Proses</span></a>
              </div>
          <?php endif;
          endif; ?>
        </div>
      </li>
    <?php endforeach;
  else : ?>
    <div class="p-20">
      <h6 class="ta-c fsz-sm">-- Belum ada agenda --</h6>
    </div>
  <?php endif; ?>
</ul>