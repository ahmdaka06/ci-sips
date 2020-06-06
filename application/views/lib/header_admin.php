<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>
    <?php echo $DataWebsite->school_name ?> - <?php echo $page ?>
  </title>
  <!-- Favicon -->
  <link href="<?php echo base_url() ?>assets/img/brand/favicon.png" rel="icon" type="image/png">
  <!-- Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
  <!-- Icons -->
  <link href="<?php echo base_url() ?>assets/js/plugins/nucleo/css/nucleo.css" rel="stylesheet" />
  <link href="<?php echo base_url() ?>assets/js/plugins/@fortawesome/fontawesome-free/css/all.min.css" rel="stylesheet" />
  <!-- Page plugins -->
  <link rel="stylesheet" href="<?php echo base_url() ?>assets/datatables/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="<?php echo base_url() ?>assets/datatables/css/buttons.bootstrap4.min.css">
  <link rel="stylesheet" href="<?php echo base_url() ?>assets/datatables/css/select.bootstrap4.min.css">
  <!-- CSS Files -->
  <link href="<?php echo base_url() ?>assets/css/argon-dashboard.css?v=1.1.0" rel="stylesheet" />
  <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.8/css/select2.min.css" rel="stylesheet" />
    <script type="text/javascript">
        function modal_open(type, url) {
      $('#modal').modal('show');
      if (type == 'add') {
        $('#modal-title').html('<i class="fa fa-plus-square"></i> Tambah Data');
      } else if (type == 'edit') {
        $('#modal-title').html('<i class="fa fa-edit"></i> Ubah Data');
      } else if (type == 'delete') {
        $('#modal-title').html('<i class="fa fa-trash"></i> Hapus Data');
      } else if (type == 'detail') {
        $('#modal-title').html('<i class="fa fa-search"></i> Detail Data');
      } else {
        $('#modal-title').html('Empty');
      }
          $.ajax({
            type: "GET",
            url: url,
            beforeSend: function() {
              $('#modal-detail-body').html('Sedang memuat...');
            },
            success: function(result) {
              $('#modal-detail-body').html(result);
            },
            error: function() {
              $('#modal-detail-body').html('Terjadi kesalahan.');
            }
          });
          $('#modal-detail').modal();
        }
      </script>
</head>

<body class="">
  <nav class="navbar navbar-vertical fixed-left navbar-expand-md navbar-light bg-white" id="sidenav-main">
    <div class="container-fluid">
      <!-- Toggler -->
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#sidenav-collapse-main" aria-controls="sidenav-main" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <!-- Brand -->
        <a class="navbar-brand" href="<?php echo base_url() ?>">
          <h2 class="text-primary"><?php echo $DataWebsite->school_name ?></h2>
        </a>
      <!-- User -->
      <ul class="nav align-items-center d-md-none">
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <div class="media align-items-center">
              <span class="avatar avatar-sm rounded-circle">
                <img alt="Image placeholder" src="<?php echo base_url() ?>assets/img/theme/team-1-800x800.jpg">
              </span>
            </div>
          </a>
          <div class="dropdown-menu dropdown-menu-arrow dropdown-menu-right">
            <div class=" dropdown-header noti-title">
              <h6 class="text-overflow m-0">Selamat Datang!</h6>
            </div>
            <a href="<?php echo base_url() ?>setting" class="dropdown-item">
              <i class="ni ni-settings-gear-65"></i>
              <span>Pengaturan</span>
            </a>
            <div class="dropdown-divider"></div>
            <a href="<?php echo base_url() ?>logout" class="dropdown-item">
              <i class="ni ni-user-run"></i>
              <span>Logout</span>
            </a>
          </div>
        </li>
      </ul>
      <!-- Collapse -->
      <div class="collapse navbar-collapse" id="sidenav-collapse-main">
        <!-- Collapse header -->
        <div class="navbar-collapse-header d-md-none">
          <div class="row">
            <div class="col-6 collapse-brand">
              <a href="<?php echo base_url() ?>">
                <img src="<?php echo base_url() ?>assets/img/brand/blue.png">
              </a>
            </div>
            <div class="col-6 collapse-close">
              <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#sidenav-collapse-main" aria-controls="sidenav-main" aria-expanded="false" aria-label="Toggle sidenav">
                <span></span>
                <span></span>
              </button>
            </div>
          </div>
        </div>
        <!-- Navigation -->
        <ul class="navbar-nav">
          <li class="nav-item active" >
          <a class=" nav-link active " href="<?php echo base_url() ?>admin"> <i class="ni ni-tv-2 "></i> Dashboard
            </a>
          </li>
        </ul>
        <!-- Divider -->
        <hr class="my-3">
        <!-- Heading -->
        <h6 class="navbar-heading text-muted">Data Pelanggaran</h6>
        <ul class="navbar-nav mb-md-3">
          <li class="nav-item">
            <a class="nav-link" href="<?php echo base_url() ?>kategori-pelanggaran">
              <i class="fas fa-list"></i> Kategori Pelanggaran
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="<?php echo base_url() ?>pelanggaran">
              <i class="fas fa-times-circle"></i> List Pelanggaran
            </a>
          </li>
        </ul>
        <h6 class="navbar-heading text-muted">Data Lainnya</h6>
        <!-- Navigation -->
        <ul class="navbar-nav mb-md-3">
          <li class="nav-item">
            <a class="nav-link" href="<?php echo base_url() ?>guru">
              <i class="fas fa-users"></i> Guru
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="<?php echo base_url() ?>kelas">
              <i class="ni ni-ungroup"></i> Kelas
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="<?php echo base_url() ?>siswa">
              <i class="fas fa-users"></i> Siswa
            </a>
          </li>
        </ul>
        <h6 class="navbar-heading text-muted">Data Pengguna</h6>
        <!-- Navigation -->
        <ul class="navbar-nav mb-md-3">
          <li class="nav-item">
            <a class="nav-link" href="<?php echo base_url() ?>pengguna">
              <i class="fas fa-users"></i> Pengguna
            </a>
          </li>
        </ul>
        <h6 class="navbar-heading text-muted">Data Website</h6>
        <!-- Navigation -->
        <ul class="navbar-nav mb-md-3">
          <li class="nav-item">
            <a class="nav-link" href="<?php echo base_url() ?>website">
              <i class="fas fa-cogs"></i> Pengaturan Website
            </a>
          </li>
        </ul>
      </div>
    </div>
  </nav>
  <div class="main-content">
    <nav class="navbar navbar-top navbar-expand-md navbar-dark" id="navbar-main">
      <div class="container-fluid">
        <!-- Brand -->
        <a class="h4 mb-0 text-white text-uppercase d-none d-lg-inline-block" href="#">Dashboard</a>
        <!-- User -->
        <ul class="navbar-nav align-items-center d-none d-md-flex">
          <li class="nav-item dropdown">
            <a class="nav-link pr-0" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <div class="media align-items-center">
                <span class="avatar avatar-sm rounded-circle">
                  <img alt="Image placeholder" src="<?php echo base_url() ?>assets/img/theme/team-1-800x800.jpg">
                </span>
                <div class="media-body ml-2 d-none d-lg-block">
                  <span class="mb-0 text-sm  font-weight-bold"></span><?php echo $login->full_name ?></span>
                </div>
              </div>
            </a>
          <div class="dropdown-menu dropdown-menu-arrow dropdown-menu-right">
            <div class=" dropdown-header noti-title">
              <h6 class="text-overflow m-0">Selamat Datang!</h6>
            </div>
            <a href="<?php echo base_url() ?>pengaturan" class="dropdown-item">
              <i class="ni ni-settings-gear-65"></i>
              <span>Pengaturan</span>
            </a>
              <div class="dropdown-divider"></div>
              <a href="<?php echo base_url() ?>logout" class="dropdown-item">
                <i class="ni ni-user-run"></i>
                <span>Logout</span>
              </a>
            </div>
          </li>
        </ul>
      </div>
    </nav>
    <!-- End Navbar -->
    <!-- Header -->
    <div class="header bg-gradient-primary pb-8 pt-5 pt-md-8">
      <div class="container-fluid">
        <div class="header-body">
      <div class="modal fade" id="modal" id="modal-detail" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true" style="display: none;">
        <div class="modal-dialog modal-dialog-centered modal-lg">
          <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title"id="modal-title"></h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body" id="modal-detail-body">
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-light" data-dismiss="modal">Tutup</button>
            </div>
          </div>
        </div>
      </div>