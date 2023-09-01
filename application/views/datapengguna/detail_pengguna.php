<?php foreach ($user_list as $row):?>

  <div class="modal fade" id="detail_pengguna<?php echo $row['id']; ?>">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="bd p-15"><h5 class="m-0">Detail Data Pengguna</h5></div>
        <div class="modal-body">
          <div class="table-responsive">
			      <table class="table table-bordered table-striped" width="100%">
              <tbody>
                <tr>
                  <th valign="top" width="160">Nama</th>
                  <th valign="top" width="1">:</th>
                  <td><?php echo $row['nama']; ?></td>
                </tr>
                <tr>
                  <th valign="top" width="160">Username</th>
                  <th valign="top" width="1">:</th>
                  <td><?php echo $row['username']; ?></td>
                </tr>
                <tr>
                  <th valign="top" width="160">Level</th>
                  <th valign="top" width="1">:</th>
                  <td><?php echo $row['role']; ?></td>
                </tr>
                <tr>
                  <th valign="top" width="160">Password</th>
                  <th valign="top" width="1">:</th>
                  <td><?php echo $row['password']; ?></td>
                </tr>
              </tbody>
            </table>
          </div>
          <div class="text-right">
            <button
              class="btn btn-primary cur-p"
              data-dismiss="modal"
              name=""
            >
              Close
            </button>
          </div>
            
        </div>
      </div>
    </div>
  </div>

<?php endforeach; ?>


    