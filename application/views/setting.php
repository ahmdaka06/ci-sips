<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
        </div>
      </div>
    </div>
    <div class="container-fluid mt--7">
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
                  <?php echo $login->full_name ?>
                </h3>
                <div class="h5 font-weight-300">
                  <i class="ni location_pin mr-2"></i><?php echo $login->email ?>
                </div>
                <div class="h5 mt-4">
                  <i class="ni business_briefcase-24 mr-2"></i><?php echo $login->level ?>
                </div>
                <hr class="my-4" />
              </div>
            </div>
          </div>
        </div>
        <div class="col-xl-8 order-xl-1">
          <div class="card bg-secondary shadow">
            <div class="card-header bg-white border-0">
              <div class="row align-items-center">
                <div class="col-8">
                  <h3 class="mb-0">Informasi Pengguna</h3>
                </div>
              </div>
            </div>
            <div class="card-body">
              <?php echo form_open() ?>
                <h6 class="heading-small text-muted mb-4">Data</h6>
                <div class="pl-lg-4">
                  <div class="row">
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label" for="input-username">Username</label>
                        <input type="text" id="input-username" class="form-control form-control-alternative" value="<?php echo $login->username ?>" readonly>
                      </div>
                    </div>
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label" for="input-email">Alamat Email</label>
                        <input type="email" id="input-email" class="form-control form-control-alternative" value="<?php echo $login->email ?>" readonly>
                      </div>
                    </div>
                  </div>
                </div>
                <hr class="my-4" />
              <?php $this->load->view('lib/validation_result'); ?>
              <?php $this->load->view('lib/result'); ?>
                <!-- Address -->
                <h6 class="heading-small text-muted mb-4">Pengaturan Password</h6>
                <div class="pl-lg-4">
                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                        <label class="form-control-label">Password Lama</label>
                        <input class="form-control form-control-alternative" placeholder="Password Lama" name="old_pass" type="password">
                      </div>
                    </div>
                  </div>
                   <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                        <label class="form-control-label">Password Baru</label>
                        <input class="form-control form-control-alternative" placeholder="Password Baru" name="new_pass" type="password">
                      </div>
                    </div>
                  </div>
                   <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                        <label class="form-control-label">Konfirmasi Password Baru</label>
                        <input class="form-control form-control-alternative" placeholder="Konfirmasi Password Baru" name="conf_new_pass" type="password">
                      </div>
                    </div>
                  </div>
                </div>
                </div>
                <div class="form-group text-right">
                  <button class="btn btn-danger" type="reset"><i class="fa fa-undo"></i> Reset</button>
                  <button class="btn btn-success" type="submit"><i class="fa fa-check"></i> Submit</button>
                </div>
              <?php echo form_close() ?>
            </div>
          </div>
        </div>
      </div>