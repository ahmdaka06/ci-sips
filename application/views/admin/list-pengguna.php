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
              <a href="<?php echo base_url() ?>pengguna/tambah" class="btn btn-xl btn-success" style="margin-bottom: 15px; float: right;"><i class="fa fa-plus-square"></i> Tambah Pengguna</a>
              <h3 class="mb-0">Seluruh Pengguna</h3>
            <form method="get" action="<?php echo base_url() ?>pengguna/index">
            <div class="col-lg-12">
                <div class="form-group">
                    <div class="input-group">
                    <input type="text" class="form-control" placeholder="Cari Username Pengguna..." name="search">
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
                    <th>Username</th>
                    <th>Level</th>
                    <th>Status</th>
                    <th>Opsi</th>
                  </tr>
                </thead>
                <?php 
                foreach ($list->result() as $row) {
                if ($row->status == '1') {
                $badge = 'badge badge-success';
                $status = 'Aktif';
                } else {
                $badge = 'badge badge-danger';
                $status = 'Tidak Aktif';
                }
                ?>
                <tbody>
                  <tr>
                    <td><?php echo $row->full_name ?></td>
                    <td><?php echo $row->username ?></td>
                    <td><?php echo $row->level ?></td>
                    <td><span class="<?php echo $badge ?>"><?php echo $status ?></span></td>
                    <td align="center">
                      <a href="<?php echo base_url() ?>pengguna/edit/<?php echo $row->id ?>" class="btn btn-primary btn-sm"><i class="fas fa-pencil-alt"></i> </a>
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
            <form class="form-horizontal" method="post" action="<?php echo base_url()?>pengguna/hapus">
                <div class="modal-body">
                    <span>Anda yakin mau menghapus data dari<b> <?php echo $row->full_name ?></b> ??</span>
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