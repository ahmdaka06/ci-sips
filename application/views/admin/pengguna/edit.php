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
              <a href="<?php echo base_url('pengguna') ?>" class="btn btn-xl btn-success" style="margin-bottom: 15px; float: right;"><i class="fa fa-arrow-left"></i> Kembali</a>
              <h3 class="mb-0"><?php echo $page ?></h3>
<?php echo form_open('pengguna/edit/'.$this->uri->segment('3').'') ?>  
<?php 
?>
      <div class="form-group">
        <label class="control-label">Nama</label>
        <input type="text" class="form-control" placeholder="Nama" name="nama" value="<?php echo $pengguna->full_name ?>">
      </div>
      <div class="form-group">
        <label class="control-label">Email</label>
        <input type="email" class="form-control" placeholder="Email" name="email" value="<?php echo $pengguna->email ?>">
      </div>
      <div class="form-group">
        <label class="control-label">Username</label>
        <input type="text" class="form-control" placeholder="Username" name="username" value="<?php echo $pengguna->username ?>">
      </div>    
      <div class="form-group">
        <label class="control-label">Password</label>
        <input type="text" class="form-control" placeholder="Password" name="pass">
        <p class="text-danger">*Catatan : Kosongkan Jika Tidak Diubah</p>
      </div>   
      <div class="form-group">
        <label class="control-label">Level</label>
        <select class="form-control" name="level">
          <option value="<?php echo $pengguna->level ?>" selected><?php echo $pengguna->level ?></option>
          <option value="Admin">Admin</option>
          <option value="Guru">Guru</option>
        </select>
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