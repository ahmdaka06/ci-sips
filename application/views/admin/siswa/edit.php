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
              <a href="<?php echo base_url('siswa') ?>" class="btn btn-xl btn-success" style="margin-bottom: 15px; float: right;"><i class="fa fa-arrow-left"></i> Kembali</a>
              <h3 class="mb-0"><?php echo $page ?></h3>
<?php echo form_open('siswa/edit/'.$this->uri->segment('3').'') ?>  
<?php 
?>
      <div class="form-group">
        <label class="control-label">NISN</label>
        <input type="number" class="form-control" placeholder="NISN" name="nisn" value="<?php echo $siswa->nisn ?>">
      </div>
      <div class="form-group">
        <label class="control-label">Nama</label>
        <input type="text" class="form-control" placeholder="Nama Murid" name="nama" value="<?php echo $siswa->std_name ?>">
      </div>
      <div class="form-group">
          <div>
              <div class="form-row">
              <div class="form-group col-md-6">
                  <label class="col-form-label">Kategori Kelas</label>
                  <select class="form-control" name="sub_kelas" id="sub_kelas">
                    <option value="<?php echo $siswa->sub_class ?>" selected><?php echo $siswa->sub_class ?></option>
                    <option value="X">10</option>
                    <option value="XI">11</option>
                    <option value="XII">12</option>
                  </select>
              </div>
              <div class="form-group col-md-6">
                  <label class="col-form-label">Kelas</label>
                  <select class="form-control" name="kelas" id="kelas">
                    <option value="<?php echo $siswa->class_id ?>" selected><?php echo $siswa->class_name ?></option>
                  </select>
              </div>
          </div>
      </div>
      <div class="form-group">
        <label class="control-label">Orang Tua / Wali Murid</label>
        <input type="text" class="form-control" placeholder="Orang Tua / Wali Murid" name="orang_tua" value="<?php echo $siswa->parent_name ?>">
      </div>
      <div class="form-group">
        <label class="control-label">Alamat</label>
        <textarea type="text" class="form-control" rows="5" name="alamat"><?php echo $siswa->address ?></textarea>
      </div>
      <div class="form-group">
        <label class="control-label">Nomor HP</label>
        <input type="text" class="form-control" placeholder="Nomor HP Yang Bisa Dihubungi (Utamakan Nomor HP Orang Tua)" name="phone" value="<?php echo $siswa->phone_number ?>">
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
  <script src="<?php echo base_url() ?>assets/js/plugins/jquery/dist/jquery.min.js"></script>
<script type="text/javascript">
$(document).ready(function() {
    $('#sub_kelas').change(function() {
        var sub_kelas = $('#sub_kelas').val();
        $.ajax({
            method: "POST",
            data: {
                    'sub_kelas': sub_kelas
                },
            url: "<?php echo base_url() ?>siswa/ajax-list-kelas",
            dataType: "html", 
            success: function(data) {
                $('#kelas').html(data);
            }
        });
    });
});
</script>  