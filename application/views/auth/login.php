<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
    <div class="header bg-gradient-primary py-7 py-lg-8">
      <div class="container">
        <div class="header-body text-center mb-7">
          <div class="row justify-content-center">
          </div>
        </div>
      </div>
      <div class="separator separator-bottom separator-skew zindex-100">
        <svg x="0" y="0" viewBox="0 0 2560 100" preserveAspectRatio="none" version="1.1" xmlns="http://www.w3.org/2000/svg">
          <polygon class="fill-default" points="2560 0 2560 100 0 100"></polygon>
        </svg>
      </div>
    </div>
    <!-- Page content -->
    <div class="container mt--8 pb-5">
      <div class="row justify-content-center">
        <div class="col-lg-5 col-md-7">
          <div class="card bg-secondary shadow border-0">
            
            <div class="card-body px-lg-5 py-lg-5">
              <div class="text-center text-muted mb-4">
                <h3><?php echo $page ?></h3>
              </div>
              <?php echo form_open('auth/login') ?>
              <?php $this->load->view('lib/result'); ?>
                <div class="form-group <?php echo form_error('username') ? 'has-danger':''?> mb-3">
                  <div class="input-group input-group-alternative">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="ni ni-single-02 <?php echo form_error('username') ? 'text-danger':''?>"></i></span>
                    </div>
                    <input class="form-control <?php echo form_error('username') ? 'is-invalid':''?>" name="username" type="text" placeholder="Username" value="<?php echo set_value('username'); ?>" >
                  </div>
                    <?php echo form_error('username','<small class="text-danger">', '</small>'); ?>
                </div>
                <div class="form-group <?php echo form_error('password') ? 'has-danger':''?>">
                  <div class="input-group input-group-alternative">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="ni ni-lock-circle-open <?php echo form_error('password') ? 'text-danger':''?>"></i></span>
                    </div>
                    <input class="form-control <?php echo form_error('password') ? 'is-invalid':''?>" name="password" placeholder="Password" value="<?php echo set_value('password'); ?>" type="password">
                  </div>
                  	<?php echo form_error('password','<small class="text-danger">', '</small>'); ?>
                </div>
                <div class="custom-control custom-control-alternative custom-checkbox">
                  <input class="custom-control-input" id=" customCheckLogin" type="checkbox" name="remember">
                  <label class="custom-control-label" for=" customCheckLogin">
                    <span class="text-muted">Remember me</span>
                  </label>
                </div>
                <div class="text-center">
                  <button type="submit" class="btn btn-primary my-4">Sign in</button>
                </div>
              </form>
            </div>
          </div>
          <div class="row mt-3">
            <div class="col-6">
              <a href="#" class="text-light"><small>Lupa Password ?</small></a>
            </div>
          </div>
        </div>
      </div>
    </div>