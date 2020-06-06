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
              <?php $this->load->view('lib/validation_result'); ?>
              <?php $this->load->view('lib/result'); ?>
              <a href="<?php echo base_url('guru') ?>" class="btn btn-xl btn-success" style="margin-bottom: 15px; float: right;"><i class="fa fa-arrow-left"></i> Kembali</a>
              <h3 class="mb-0"><?php echo $page ?></h3>
<?php echo form_open('guru/edit/'.$this->uri->segment('3').'') ?>  
      <div class="form-group">
        <label class="control-label">NIK</label>
        <input type="number" class="form-control" placeholder="NIK" name="nik" value="<?php echo $guru->nik ?>">
      </div>
      <div class="form-group">
        <label class="control-label">Nama Guru</label>
        <input type="text" class="form-control" placeholder="Nama Guru" name="nama" value="<?php echo $guru->teacher_name ?>">
      </div>
      <div class="form-group">
        <label class="control-label">Mata Pelajaran</label>
        <input type="text" class="form-control" placeholder="Mata Pelajaran" name="mapel" value="<?php echo $guru->subject ?>">
      </div>
      <div class="form-group text-right">
        <button class="btn btn-danger" type="reset"><i class="fa fa-undo"></i> Reset</button>
        <button class="btn btn-success" type="submit"><i class="fa fa-check"></i> Update</button>
      </div>
</form>
            </div>
          </div>
        </div>
</div>
