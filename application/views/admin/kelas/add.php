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
              <a href="<?php echo base_url('kelas') ?>" class="btn btn-xl btn-success" style="margin-bottom: 15px; float: right;"><i class="fa fa-arrow-left"></i> Kembali</a>
              <h3 class="mb-0"><?php echo $page ?></h3>
<?php echo form_open() ?>  
      <div class="form-group">
        <label class="control-label">Kelas</label>
          <select class="form-control" name="kelas">
            <option value="">Pilih Salah Satu</option>
            <option value="X">10</option>
            <option value="XI">11</option>
            <option value="XII">12</option>
          </select>
      </div>
      <div class="form-group">
        <label class="control-label">Nama Kelas</label>
        <input type="text" class="form-control" placeholder="Contoh : XII - RPL" name="nama_kelas">
      </div>
      <div class="form-group">
        <label class="control-label">Wali Kelas</label>
                <select name="wali_kelas" class="form-control select2">
                  <option value="">Pilih Salah Satu</option>
                  <?php foreach ($guru as $row) : ?>
                  <option value="<?php echo $row->id ?>"><?php echo $row->teacher_name ?></option>
                  <?php endforeach; ?>
                </select>
      </div>

      <div class="form-group">
        <label class="control-label">Total Siswa</label>
        <input type="number" class="form-control" placeholder="Total Siswa" name="total_siswa">
      </div>
      <div class="form-group text-right">
        <button class="btn btn-danger" type="reset"><i class="fa fa-undo"></i> Reset</button>
        <button class="btn btn-success" type="submit"><i class="fa fa-check"></i> Submit</button>
      </div>
</form>
            </div>
          </div>
        </div>
</div>

<script type="text/javascript">
  $(function () {
      $('.select2').select2();
    });
</script>