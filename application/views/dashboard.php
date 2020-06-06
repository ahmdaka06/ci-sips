<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
</div>
  </div>
    </div>
    <div class="container-fluid mt--7">
      <div class="row">
      <!-- Table -->
        <div class="col-md-6">
          <div class="card shadow">
            <div class="card-header border-0">
              <h3 class="mb-0">Top 5 Pelanggaran Yang Sering Dilakukan</h3>
            </div>
            <div class="table-responsive">
              <table class="table align-items-center table-flush">
                <thead class="thead-light">
                  <tr>
                    <th>Nama Pelanggaran</th>
                    <th>Total Pelanggaran</th>
                  </tr>
                </thead>
                <?php
                foreach ($top_pelanggaran as $row) {
                ?>
                <tbody>
                  <tr>
                    <td><?php echo $row->violation_name ?></td>
                    <td><?php echo $row->total_pelanggaran ?></td>
                  </tr>
                </tbody>
                <?php } ?>
              </table>
            </div>
          </div>
        </div>
        <div class="col-md-6">
          <div class="card shadow">
            <div class="card-header border-0">
              <h3 class="mb-0">Top 5 Murid Yang Sering Melakukan Pelanggaran</h3>
            </div>
            <div class="table-responsive">
              <table class="table align-items-center table-flush">
                <thead class="thead-light">
                  <tr>
                    <th>Nama Murid</th>
                    <th>Total Point</th>
                    <th>Aksi</th>
                  </tr>
                </thead>
                <?php
                foreach ($top_murid as $row) {
                ?>
                <tbody>
                  <tr>
                    <td><?php echo $row->nisn ?></td>
                    <td><?php echo $row->total_poin ?> Dari <?php echo $row->total_pelanggaran ?> Pelanggaran</td>
                    <td><a class="btn btn-primary btn-sm" href="<?php echo base_url('dashboard/search/') ?><?php echo $row->nisn ?>"><i class="fas fa-eye text-white"></i></a></td>
                  </tr>
                </tbody>
                <?php } ?>
              </table>
            </div>
          </div>
        </div>
      </div>  
