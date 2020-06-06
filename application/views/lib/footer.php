
        <!-- Footer -->
      <footer class="footer">
        <div class="row align-items-center justify-content-xl-between">
          <div class="col-xl-6">
            <div class="copyright text-center text-xl-left text-muted">
              <?php echo $DataWebsite->school_name ?> &copy; <?php echo date('Y') ?> <b>Crafted With <i class="fas fa-heart text-danger"></i></b> By<a href="https://kanghl.web.id" class="font-weight-bold ml-1" target="_blank"><b>Ahmad Andika</b></a>
            </div>
          </div>
          <div class="col-xl-6">
            <ul class="nav nav-footer justify-content-center justify-content-xl-end">
            </ul>
          </div>
        </div>
      </footer>
    </div>
  </div>
  <!--   Core   -->
  <script src="<?php echo base_url() ?>assets/js/plugins/jquery/dist/jquery.min.js"></script>
  <script src="<?php echo base_url() ?>assets/js/plugins/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
  <!--   Optional JS   -->
  <script src="<?php echo base_url() ?>assets/datatables/js/jquery.dataTables.min.js"></script>
  <script src="<?php echo base_url() ?>assets/datatables/js/dataTables.bootstrap4.min.js"></script>
  <script src="<?php echo base_url() ?>assets/datatables/js/dataTables.buttons.min.js"></script>
  <script src="<?php echo base_url() ?>assets/datatables/js/buttons.bootstrap4.min.js"></script>
  <!--   Argon JS   -->
  <script src="<?php echo base_url() ?>assets/js/argon-dashboard.min.js?v=1.1.0"></script>
  <script src="https://cdn.trackjs.com/agent/v3/latest/t.js"></script>
  <script src="<?php echo base_url() ?>assets/select2/js/select2.min.js"></script>  
 <script>
  $(function () {
      $('.select2').select2();
    });
  </script> 
</body>

</html>