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
            <div class="card-body">  
              <?php $this->load->view('lib/validation_result'); ?>
              <?php $this->load->view('lib/result'); ?>
              <a href="<?php echo base_url() ?>admin/tambah-guru" class="btn btn-xl btn-success" style="margin-bottom: 15px; float: right;"><i class="fa fa-plus-square"></i> Input Pelanggaran</a>
              <h3 class="mb-0"><?php echo $page ?></h3>
            <form method="get" action="<?php echo base_url() ?>dashboard/list-pelanggaran">
            <div class="col-lg-12">
                <div class="form-group">
                    <div class="input-group">
                    <input type="text" class="form-control" placeholder="Cari NIK Siswa..." name="search">
                    <div class="input-group-append">
                        <button class="btn btn-primary waves-effect waves-light" type="submit"><i class="fa fa-search"></i></button>
                    </div>
                    </div>
                </div>
            </div>
            </form>
                  <?php print_r($list->result_array()) ?>
            <div class="table-responsive">
              <table class="table align-items-center table-flush">
                <thead class="thead-light">
                  <tr>
                    <th>No</th>
                    <th>Nama Siswa</th>
                    <th>Point Yang Didapatkan</th>
                    <th>Opsi</th>
                  </tr>
                </thead>
                <?php 
                $no = 1;
                foreach ($list->result_array() as $row) {
                ?>
                <tbody>
                  <tr>
                    <td><?php echo $no++ ?></td>
                    <td><strong><?php echo $row['name'] ?></strong> (<?php echo $row['name'] ?>)</td>
                    <td><span class="badge badge-pill badge-warning"><?php echo $row['point'] ?></span></td>
                    <td align="center">
                      <a href="<?php echo base_url() ?>dashboard/view-pelanggaran/<?php echo $row['id'] ?>" class="btn btn-primary btn-sm"><i class="fas fa-eye"></i></a>
                    </td>
                  </tr>
                </tbody>
                <?php } ?>
              </table>
            </div>
          <?php echo $pagination ?> <small>Total Data : <?php echo $total_rows ?></small>
          </div>
        </div>
</div>
  </div>