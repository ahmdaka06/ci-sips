<html>
<head>
<title><?php echo $title; ?></title>
  <link rel="shortcut icon" href="<?php echo base_url(); ?>assets/images/logo.png">
  <!-- Bootstrap Core Css -->
    <link href="<?php echo base_url(); ?>assets/admin/plugins/bootstrap/css/bootstrap.css" rel="stylesheet">
  <!-- Custom Css -->
    <link href="<?php echo base_url(); ?>assets/admin/css/style.css" rel="stylesheet">
</head>
<body onload="window.print()">
<div class="col-xs-12">
  <div style="text-align:justify; margin-top: 20px">
    <img src="" style="width: 78px; height: 80px; float:left; margin:0 8px 4px 0;"/>
    <p style="text-align: center; line-height: 20px">
      <span style="font-size: 15px">PEMERINTAH KABUPATEN SRAGEN</span><br/>
      <span style="font-size: 20px;"><strong>RSUD dr. SOEHADI PRIJONEGORO</strong></span><br/>
      <span style="font-size: 12px">Jln. Raya Sukowati No. 534 Telp. (271) 891068 Sragen 57272</span><br/>
      <span style="font-size: 12px">Website : www.rssp.sragenkab.go.id dan Email : rsudsragen1958@gmail.com</span>
    </p>
  </div>
  <div style="clear:both"></div><br/>
  <hr style="border: 2px groove #000000;margin-top: -2px; width:100%"/>
  <hr style="border: 1px groove #000000; margin-top: -19px; width:100%"/>
</div>
<div class="col-xs-12">
<p style="padding-left: 210px"><strong>SURAT</strong><strong> PERNYATAAN</strong></p>
<p><b>NISN : <?php echo $pelanggaran->nisn ?></b></p>
<p><b>Nama  Siswa                           : <?php echo $pelanggaran->std_name ?></b></p>
<p><b>Kelas                           : <?php echo $pelanggaran->class_name ?></b></p>
<p><b>Alamat                            : <?php echo $pelanggaran->address ?></b></p>
<!-- Quick Adsense WordPress Plugin: http://quickadsense.com/ -->
<div style="float: none; margin: 10px auto; text-align: center;">
<div id="quick_adsense_vi_ad"></div>
</div>

<p style="text-align: justify">Saya menyatakan dengan sebenar-benarnya bahwa saya tidak akan mengulangi lagi kesalahan berupa <b><?php echo $pelanggaran->violation_name ?></b> ,dan akan mematuhi segala peraturan yang ada di sekolah. Dan apabila saya tetap melakukan hal tersebut kembali, maka saya bersedia diberikan sanksi dari sekolah sesuai dengan peraturan yang berlaku.</p>
<p style="text-align: justify">Demikian surat pernyataan ini saya buat dengan sesungguhnya dan tanpa paksaan dari siapapun sebagai perjanjian untuk tidak mengulangi lagi perbuatan tersebut.</p>
<center><p style="text-align: justify; float: right;">Guru BK</p>
<br>
<br>
<br>
<br>
<br>
<br>
<p style="text-align: justify; float: right;">Nama Guru BK</p>
</div>

  <!-- Jquery Core Js -->
    <script src="<?php echo base_url(); ?>assets/admin/plugins/jquery/jquery.min.js"></script>

  <!-- Bootstrap Core Js -->
  <script src="<?php echo base_url(); ?>assets/admin/plugins/bootstrap/js/bootstrap.js"></script>
</body>
</html>