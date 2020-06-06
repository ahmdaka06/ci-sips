<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
        </div>
      </div>
    </div>
    <div class="container-fluid mt--7">
      <div class="row">
      <!-- Table -->
        <div class="col-md-12">
          <div class="card">  
            <div class="card shadow"> 
            <div class="card-header border-0">
              <h3 class="mb-0">Seluruh Wali Murid</h3>
            </div>
            <form method="get" action="<?php echo base_url() ?>admin/list-wali-murid">
            <div class="col-lg-12">
                <div class="form-group">
                    <div class="input-group">
                    <input type="text" class="form-control" placeholder="Cari NIK Murid..." name="search">
                    <div class="input-group-append">
                        <button class="btn btn-primary waves-effect waves-light" type="submit"><i class="fa fa-search"></i></button>
                    </div>
                    </div>
                </div>
            </div>
            </form>
            <div class="table-responsive">
              <table class="table align-items-center table-flush">
                <thead class="thead-light">
                  <tr>
                    <th>Nama</th>
                    <th>Wali Murid Dari</th>
                    <th>Nomor HP</th>
                    <th>Alamat</th>
                  </tr>
                </thead>
                <?php 
                foreach ($list->result() as $row) {
                $siswa = $this->db->get_where('tb_siswa', array('id' => $row->id))->row();
                ?>
                <tbody>
                  <tr>
                    <td><?php echo $row->name ?></td>
                    <td><?php echo $siswa->name ?></td>
                    <td><?php echo $row->phone_number ?></td>
                    <td><textarea><?php echo $siswa->address ?></textarea></td>
                  </tr>
                </tbody>
                <?php } ?>
              </table>
            </div>
            <div class="card-footer py-4">
          <?php echo $pagination ?> <small>Total Data : <?php echo $total_rows ?></small>
        </div>
          </div>
        </div>
</div>
</div>