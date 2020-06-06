a<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
    <footer class="py-5">
      <div class="container">
        <div class="row align-items-center justify-content-xl-between">
          <div class="col-xl-6">
            <div class="copyright text-center text-xl-left text-muted">
              <?php echo $DataWebsite->school_name ?> &copy; <?php echo date('Y') ?> <b>Crafted With <i class="fas fa-heart text-danger"></i></b> By<a href="https://kanghl.web.id" class="font-weight-bold ml-1" target="_blank"><b>Ahmad Andika</b></a>
            </div>
          </div>

        </div>
      </div>
    </footer>
  </div>
  <!--   Core   -->
  <script src="../assets/js/plugins/jquery/dist/jquery.min.js"></script>
  <script src="../assets/js/plugins/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
  <!--   Optional JS   -->
  <!--   Argon JS   -->
  <script src="../assets/js/argon-dashboard.min.js?v=1.1.0"></script>
  <script src="https://cdn.trackjs.com/agent/v3/latest/t.js"></script>
  <script>
    window.TrackJS &&
      TrackJS.install({
        token: "ee6fab19c5a04ac1a32a645abde4613a",
        application: "argon-dashboard-free"
      });
  </script>
</body>

</html>