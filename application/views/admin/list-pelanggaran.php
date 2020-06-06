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
              <a href="<?php echo base_url() ?>pelanggaran/tambah" class="btn btn-xl btn-success" style="margin-bottom: 15px; float: right;"><i class="fa fa-plus-square"></i> Input Pelanggaran</a>
              <h3 class="mb-0"><?php echo $page ?></h3>
            <form method="get" action="<?php echo base_url() ?>pelanggaran/index">
            <div class="col-lg-12">
                <div class="form-group">
                    <div class="input-group">
                    <input type="text" class="form-control" placeholder="Cari NISN Siswa..." name="search">
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
                    <th>No</th>
                    <th>Nama Siswa</th>
                    <th>Dilaporkan oleh</th>
                    <th>Wali Murid</th>
                    <th>Tipe Pelanggaran</th>
                    <th>Catatan</th>
                    <th>Point Yang Didapatkan</th>
                    <th>Opsi</th>
                  </tr>
                </thead>
                <?php 
                $no = 1;
                foreach ($list->result() as $row) {
                if ($row->point > $point) {
                  $show = '';
                } else {
                  $show = 'disabled';
                }
                ?>
                <tbody>
                  <tr>                           
                    <td><?php echo $no++ ?></td>
                    <td><strong><?php echo $row->std_name ?></strong> (<?php echo $row->class_name ?>)</td>
                    <td><?php echo $row->teacher_name ?></td>
                    <td><?php echo $row->wali_name ?></td>
                    <td><?php echo $row->violation_name ?></td>
                    <td><?php echo $row->note ?></td>
                    <td><span class="badge badge-pill badge-warning"><?php echo $row->point ?></span></td>
                    <td align="center">
                      <a href="<?php echo base_url() ?>pelanggaran/print-pelanggaran/<?php echo $row->id ?>" class="btn btn-primary btn-sm <?php echo $show ?>"><i class="fas fa-print"></i></a>
                      <a href="<?php echo base_url() ?>pelanggaran/edit/<?php echo $row->id ?>" class="btn btn-warning btn-sm"><i class="fas fa-pencil-alt"></i></a>
                      <a class="btn btn-danger btn-sm" data-toggle="modal" data-target="#modal_hapus<?php echo $row->id ?>"><i class="fas fa-trash-alt text-white"></i></a>
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
    <?php
        foreach($list->result() as $row):
    ?>  
        <div class="modal fade" id="modal_hapus<?php echo $row->id ?>" tabindex="-1" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
            <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
            <h3 class="modal-title" id="myModalLabel"><i class="fa fa-trash-alt"></i> Hapus Data</h3>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <form class="form-horizontal" method="post" action="<?php echo base_url()?>pelanggaran/hapus">
                <div class="modal-body">
                    <span>Anda yakin mau menghapus </span>

                </div>
                <div class="modal-footer">
                    <input type="hidden" name="id" value="<?php echo $row->id ?>">
                    <button class="btn" data-dismiss="modal" aria-hidden="true">Tutup</button>
                    <button class="btn btn-danger">Hapus</button>
                </div>
            </form>
            </div>
            </div>
        </div>
    <?php endforeach;?>
  </div>