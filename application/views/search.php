<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
        </div>
      </div>
    </div>    
    <div class="container-fluid mt--7">
<?php
if ($hasil == 'Tidak Ditemukan') {
?>
<div class="alert alert-danger alert-dismissible" role="alert">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    <strong>Pesan : </strong> Hasil Dari Pencarian <b><?php echo $this->uri->segment('3'); ?> </b> <?php echo $hasil ?>
</div>
<?php } else { ?>
      <div class="row">
        <div class="col-xl-4 order-xl-2 mb-5 mb-xl-0">
          <div class="card card-profile shadow">
            <div class="row justify-content-center">
              <div class="col-lg-3 order-lg-2">
                <div class="card-profile-image">
                  <a href="#">
                    <img src="<?php echo base_url() ?>assets/img/lelaki.png" class="rounded-circle">
                  </a>
                </div>
              </div>
            </div>
            <div class="card-header text-center border-0 pt-8 pt-md-4 pb-0 pb-md-4">
            </div>
            <div class="card-body pt-0 pt-md-4">
              <div class="row">
                <div class="col">
                  <div class="card-profile-stats d-flex justify-content-center mt-md-5">
                  </div>
                </div>
              </div>
              <div class="text-center">
                <h3>
                  <?php echo $siswa->std_name ?>
                </h3>
                <div class="h5 font-weight-300">
                   <strong> Kelas : </strong><?php echo $siswa->class_name ?>
                </div>
                <div class="h5 font-weight-300">
                   <strong> Alamat : </strong><?php echo $siswa->address ?>
                </div>
                <hr class="my-4" />
                <div class="h5 mt-4">
                   <strong> Total Point : </strong><?php echo $total_point ?>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-8">
          <div class="card shadow">
            <div class="card-header border-0">
              <h3 class="mb-0">Daftar Pelanggaran</h3>
            </div>
            <div class="table-responsive">
              <table class="table align-items-center table-flush">
                <thead class="thead-light">
                  <tr>
                    <th>No</th>
                    <th>Tipe Pelanggaran</th>
                    <th>Catatan</th>
                    <th>Poin</th>
                  </tr>
                </thead>
                <?php
                $no = 1;
                foreach ($list->result() as $row) {
                $kategori = $this->db->get_where('tb_tipe_pelanggaran', array('id' => $row->type_id))->row();
                ?>
                  <tr>
                    <td><?php echo $no++; ?></td>
                    <td><?php echo $kategori->violation_name ?></td>
                    <td><?php echo $row->note ?></td>
                    <td><?php echo $row->point ?></td>
                  </tr>
                <?php } ?>
              </table>
            </div>
          <?php echo $pagination ?> <small>Total Data : <?php echo $total_rows ?></small>
          </div>
        </div>
      </div>  

      </div>

<?php } ?>