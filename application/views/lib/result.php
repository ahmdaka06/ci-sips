<?php
if ($this->session->userdata('result')) {
?>
<div class="alert alert-<?php echo $_SESSION['result']['alert'] ?> alert-dismissible" role="alert">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    <strong>Respon : </strong><?php echo $_SESSION['result']['title'] ?><br /> <strong>Pesan : </strong> <?php echo $_SESSION['result']['msg'] ?>
</div>
<?php
$this->session->unset_userdata('result');
}
?>