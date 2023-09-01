<?php
$link1 = strtolower($this->uri->segment(1));
$link2 = strtolower($this->uri->segment(2));
$link3 = strtolower($this->uri->segment(3));
$link4 = strtolower($this->uri->segment(4));
$no=1;
?>
<main class="main-content bgc-grey-100">
  <div id="mainContent">
    <div class="container-fluid">
      <?php
                echo $this->session->flashdata('msg');
              ?>
      <div class="row">
        <div class="col-md-7">
          <h4 class="c-grey-900 mT-10">Data Pengguna</h4>
        </div>
        <div class="col-md-5 fc-rtl">
          <button type="button" class="btn cur-p btn-success mT-10 mB-10" data-toggle="modal" data-target="#add_pengguna"><i class="fa fa-plus-circle" aria-hidden="true"></i> Tambah Pengguna Baru</button>
        </div>
      </div>
      <div class="row">
        <!-- <div class="col-md-12">
        </div> -->
        <div class="col-md-12">
          <!-- <div class="bgc-white bd bdrs-3 p-20 mB-20"> -->
            <!-- <h4 class="c-grey-900 mB-20">Bootstrap Data Table</h4> -->
            <hr>
            <table
              id="dataTable"
              class="table table-striped table-bordered"
              cellspacing="0"
              width="100%"
            >
              <thead class="thead-dark">
                <tr>
                  <th width="2%">No.</th>
                  <th width="40%">Nama</th>
                  <th width="22%">Username</th>
                  <th width="18%">Level</th>
                  <th width="18%">Aksi</th>
                </tr>
              </thead>
              <tbody>
                <?php foreach ($user_list as $row): ?>
                <tr>
                  <td><?php echo $no++; ?>.</td>
                  <td><?php echo $row['nama']; ?></td>
                  <td><?php echo $row['username']; ?></td>
                  <td><?php echo $row['role']; ?></td>
                  <td class="text-center">
                    <div class="peers">
                      <div class="peer">
                        <a
                          href=""
                          class="td-n c-blue-500 cH-blue-500 fsz-md p-5"
                          data-toggle="modal"
                          data-target="#detail_pengguna<?php echo $row['id']; ?>"
                          ><i class="ti-search"></i
                        ></a>
                      </div>
                      <div class="peer">
                        <a
                          href=""
                          class="td-n c-deep-purple-500 cH-blue-500 fsz-md p-5"
                          data-toggle="modal"
                          data-target="#edit_pengguna<?php echo $row['id']; ?>"
                          ><i class="ti-pencil"></i
                        ></a>
                      </div>
                      <div class="peer">
                        <a
                          href=""
                          class="td-n c-red-500 cH-blue-500 fsz-md p-5"
                          data-toggle="modal"
                          data-target="#delete_pengguna<?php echo $row['id']; ?>"
                          ><i class="ti-trash"></i
                        ></a>
                      </div>
                    </div>
                  </td>
                </tr>
                <?php endforeach; ?>
              </tbody>
            </table>
          <!-- </div> -->
        </div>
      </div>

      <!-- Add, Detail, Edit, Delete Pengguna  -->
      <?php 
        // Add Pengguna 
        $this->load->view('datapengguna/add_pengguna');

        // Detail Pengguna 
        $this->load->view('datapengguna/detail_pengguna');  

        //  Edit Pengguna 
        $this->load->view('datapengguna/edit_pengguna'); 

        //  Delete Pengguna 
        $this->load->view('datapengguna/delete_pengguna');
      ?>
    </div>
  </div>
</main>

