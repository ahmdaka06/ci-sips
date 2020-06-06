<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
        </div>
      </div>
    </div>
    <div class="container-fluid mt--7">
      <div class="row">
      <!-- Table -->
        <div class="offset-md-2 col-md-8">
          <div class="card">  
            <div class="card-body">  
              <?php $this->load->view('lib/result'); ?>
              <h3 class="mb-0"><?php echo $page ?></h3>
<?php echo form_open() ?>  
<?php 
?>
      <div class="form-group">
        <label class="control-label">Nama Sekolah</label>
        <input type="text" class="form-control" placeholder="Nama Sekolah" name="name" value="<?php echo $website->school_name ?>">
      </div>
      <div class="form-group">
        <label class="control-label">Point</label>
        <input type="number" class="form-control" placeholder="Exampe : 30" name="point" value="<?php echo $website->point ?>">
        <p class="text-danger">*Catatan : Batas point, jika point siswa melebihi batas yang ditentukan, tombol print surat akan keluar</p>
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