<?php
if (validation_errors() == true) {
?>
<div class="col-sm-12"><div class="alert alert-dismissable alert-danger">
	<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
    <strong>Respon : </strong>Gagal<br /> <strong>Pesan : </strong><br> <?php echo validation_errors('<span>', '</span><br>'); ?> 
</div>
<?php } ?>