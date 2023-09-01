<?php 
  $ceks 	 = $this->session->userdata('token_katamaran');
  $link1 = $this->uri->segment(1);
  $link2 = $this->uri->segment(2);
  $link3 = $this->uri->segment(3);
  $link4 = $this->uri->segment(4);
  $link5 = $this->uri->segment(5);
  $level = $this->session->userdata('level');
  
?>

<main class="main-content bgc-grey-100">
  <div id="mainContent">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-1"></div>
        <div class="col-md-10">
          <?php

                echo $this->session->flashdata('msg');
              ?>
          <!-- Button harian, mingguan, bulanan  -->
          <div class="btn-group mr-2 mb-2" role="group" aria-label="Grup button list jadwal">
            <a type="button" class="btn btn-secondary <?php if ($link3 == 'harian') { echo 'active'; } ?>" href="<?php echo $link1; ?>/<?php echo $link2; ?>/harian">Harian</a>
            <a type="button" class="btn btn-secondary <?php if ($link3 == 'mingguan') { echo 'active'; } ?>" href="<?php echo $link1; ?>/<?php echo $link2; ?>/mingguan">Mingguan</a>
            <a type="button" class="btn btn-secondary <?php if ($link3 == 'bulanan') { echo 'active'; } ?>" href="<?php echo $link1; ?>/<?php echo $link2; ?>/bulanan">Bulanan</a>
          </div>

          <div class="bdrs-3  bgc-white bd">
            <div class="bgc-deep-purple-500 ta-c px-4 py-5">
              <!-- Header Hari / Bulan  -->
              <h1 class="fw-300 mB-5 lh-1 c-white">
                <?php 
                  if ($link3 == 'harian') {
                    echo $this->Mcrud->hari_id($header_hari); 
                  } elseif ($link3 == 'mingguan') {
                    echo $this->Mcrud->hari_id($header_hari1) . ' - ' . $this->Mcrud->hari_id($header_hari2); 
                  } elseif ($link3 == 'bulanan') {
                    echo $header_bulan;
                  }
                ?>
              </h1>
              <!-- Header Tanggal / Tahun  -->
              <h3 class="c-white">
                <?php 
                  if ($link3 == 'harian') {
                    echo $this->Mcrud->tgl_id($header_hari, 'full'); 
                  } elseif ($link3 == 'mingguan') {
                    echo $this->Mcrud->tgl_id($header_hari1, 'full') . ' - ' . $this->Mcrud->tgl_id($header_hari2, 'full'); 
                  } elseif ($link3 == 'bulanan') {
                    echo $header_tahun;
                  }
                ?>
              </h3>
            </div>
            <div class="pos-r">
              <!-- Button previous  -->
              <button
                type="button"
                class="mT-nv-30 pos-a t-2 btn cur-p bdrs-50p p-0 w-3r h-3r btn-success btn-list-left"
                onclick="location.href='<?php 
                  if($link3 == 'harian') {
                    if ($link4 == '') {
                      echo $link1 . '/' . $link2 . '/' . $link3 . '/' . $this->Mcrud->prev_button($header_hari);
                    } else {
                      echo $link1 . '/' . $link2 . '/' . $link3 . '/' . $this->Mcrud->prev_button($link4);
                    }
                  } elseif ($link3 == 'mingguan') {
                    if ($link4 == '') {
                      echo $link1 . '/' . $link2 . '/' . $link3 . '/' . $this->Mcrud->prev_button_week1($header_hari1) . '/' . $this->Mcrud->prev_button_week2($header_hari2);
                    } else {
                      echo $link1 . '/' . $link2 . '/' . $link3 . '/' . $this->Mcrud->prev_button_week1($link4) . '/' . $this->Mcrud->prev_button_week2($link5);
                    }
                  } elseif ($link3 == 'bulanan') {
                    if ($link4 == '') {
                      echo $link1 . '/' . $link2 . '/' . $link3 . '/' . $this->Mcrud->prev_button_month1($header_hari1) . '/' . $this->Mcrud->prev_button_month2($header_hari2);
                    } else {
                      echo $link1 . '/' . $link2 . '/' . $link3 . '/' . $this->Mcrud->prev_button_month1($link4) . '/' . $this->Mcrud->prev_button_month2($link5);
                    }
                  }
                ?>'"
              >
                <i class="ti-angle-left"></i>
              </button>

              <!-- Button tambah  -->
              <button
                type="button"
                class="mT-nv-30 pos-a t-2 btn cur-p bdrs-50p p-0 w-3r h-3r btn-warning btn-center"
                data-toggle="modal"
                data-target="#add_agenda">
                <i class="ti-plus" style="font-weight: bold"></i>
              </button>

              <!-- Button next -->
              <button
                type="button"
                class="mT-nv-30 pos-a t-2 btn cur-p bdrs-50p p-0 w-3r h-3r btn-success btn-list-right"
                onclick="location.href='<?php 
                  if ($link3 == 'harian') {
                    if ($link4 == '') {
                      echo $link1 . '/' . $link2 . '/' . $link3 . '/' . $this->Mcrud->next_button($header_hari);
                    } else {
                      echo $link1 . '/' . $link2 . '/' . $link3 . '/' . $this->Mcrud->next_button($link4);
                    }
                  } elseif ($link3 == 'mingguan') {
                    if ($link4 == '') {
                      echo $link1 . '/' . $link2 . '/' . $link3 . '/' . $this->Mcrud->next_button_week1($header_hari1) . '/' . $this->Mcrud->next_button_week2($header_hari2);
                    } else {
                      echo $link1 . '/' . $link2 . '/' . $link3 . '/' . $this->Mcrud->next_button_week1($link4) . '/' . $this->Mcrud->next_button_week2($link5);
                    }
                  } elseif ($link3 == 'bulanan') {
                    if ($link4 == '') {
                      echo $link1 . '/' . $link2 . '/' . $link3 . '/' . $this->Mcrud->next_button_month1($header_hari1) . '/' . $this->Mcrud->next_button_month2($header_hari2);
                    } else {
                      echo $link1 . '/' . $link2 . '/' . $link3 . '/' . $this->Mcrud->next_button_month1($link4) . '/' . $this->Mcrud->next_button_month2($link5);
                    }
                  }
                ?>'"
              >
                <i class="ti-angle-right"></i>
              </button>
              <!-- List Agenda -->
              <?php if ($link3 == 'bulanan') {
                $this->load->view('agenda/bulanan'); 
              } elseif ($link3 == 'mingguan') {
                $this->load->view('agenda/mingguan'); 
              } elseif ($link3 == 'harian') {
                $this->load->view('agenda/harian'); 
              }
              ?>

            </div>
          </div>
        </div>
        <div class="col-md-1">
        </div>
      </div>

      <!-- Add, Detail, Edit, Delete Agenda  -->
      <?php 
        // Add Agenda 
        $this->load->view('agenda/add_agenda');

        // Detail Agenda 
        $this->load->view('agenda/detail_agenda');  

        //  Edit Agenda 
        $this->load->view('agenda/edit_agenda'); 

        //  Delete Agenda 
        $this->load->view('agenda/delete_agenda');

        //  Proses Agenda 
        $this->load->view('agenda/proses_agenda');
      ?>
    </div>
  </div>
</main>

  
