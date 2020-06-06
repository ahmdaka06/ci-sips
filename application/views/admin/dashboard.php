<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

          <!-- Card stats -->
          <div class="row">
            <div class="col-xl-3 col-lg-6">
              <div class="card card-stats mb-4 mb-xl-0">
                <div class="card-body">
                  <div class="row">
                    <div class="col">
                      <h5 class="card-title text-uppercase text-muted mb-0">Murid</h5>
                      <span class="h2 font-weight-bold mb-0"><?php echo $total_siswa ?></span>
                    </div>
                    <div class="col-auto">
                      <div class="icon icon-shape bg-info text-white rounded-circle shadow">
                        <i class="fas fa-users"></i>
                      </div>
                    </div>
                  </div>
                  <p class="mt-3 mb-0 text-muted text-sm">
                    <span></span>
                    <span></span>
                  </p>
                </div>
              </div>
            </div>
            <div class="col-xl-3 col-lg-6">
              <div class="card card-stats mb-4 mb-xl-0">
                <div class="card-body">
                  <div class="row">
                    <div class="col">
                      <h5 class="card-title text-uppercase text-muted mb-0">Guru</h5>
                      <span class="h2 font-weight-bold mb-0"><?php echo $total_guru ?></span>
                    </div>
                    <div class="col-auto">
                      <div class="icon icon-shape bg-success text-white rounded-circle shadow">
                        <i class="fas fa-users"></i>
                      </div>
                    </div>
                  </div>
                  <p class="mt-3 mb-0 text-muted text-sm">
                    <span></span>
                    <span></span>
                  </p>
                </div>
              </div>
            </div>
            <div class="col-xl-3 col-lg-6">
              <div class="card card-stats mb-4 mb-xl-0">
                <div class="card-body">
                  <div class="row">
                    <div class="col">
                      <h5 class="card-title text-uppercase text-muted mb-0">Wali Murid</h5>
                      <span class="h2 font-weight-bold mb-0"><?php echo $total_wali ?></span>
                    </div>
                    <div class="col-auto">
                      <div class="icon icon-shape bg-yellow text-white rounded-circle shadow">
                        <i class="fas fa-users"></i>
                      </div>
                    </div>
                  </div>
                  <p class="mt-3 mb-0 text-muted text-sm">
                    <span></span>
                    <span></span>
                  </p>
                </div>
              </div>
            </div>
            <div class="col-xl-3 col-lg-6">
              <div class="card card-stats mb-4 mb-xl-0">
                <div class="card-body">
                  <div class="row">
                    <div class="col">
                      <h5 class="card-title text-uppercase text-muted mb-0">Pelanggaran</h5>
                      <span class="h2 font-weight-bold mb-0"><?php echo $total_pelanggaran ?></span>
                    </div>
                    <div class="col-auto">
                      <div class="icon icon-shape bg-danger text-white rounded-circle shadow">
                        <i class="fas fa-times-circle"></i>
                      </div>
                    </div>
                  </div>
                  <p class="mt-3 mb-0 text-muted text-sm">
                    <span></span>
                    <span></span>
                  </p>
                </div>
              </div>
            </div>
          </div>
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
                    <td><a class="btn btn-primary btn-sm" href="<?php echo base_url('admin/search/') ?><?php echo $row->nisn ?>"><i class="fas fa-eye text-white"></i></a></td>
                  </tr>
                </tbody>
                <?php } ?>
              </table>
            </div>
          </div>
        </div>
      </div>  
