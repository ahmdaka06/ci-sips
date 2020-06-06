<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<?php echo form_open() ?>  
<span>Anda Yakin Akan Menghapus Data Dari <b><?php echo $guru->name ?></b> ?</span>
      <div class="form-group text-right">
        <button class="btn btn-success" type="submit"><i class="fa fa-check"></i> Ya</button>
      </div>
</form>