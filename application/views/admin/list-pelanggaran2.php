        </div>
      </div>
    </div>
    <div class="container-fluid mt--7">
      <!-- Table -->
        <div class="col-md-12">
          <div class="card">  
            <div class="card-body">  
              <?php $this->load->view('lib/validation_result'); ?>
              <?php $this->load->view('lib/result'); ?>
              <a href="<?php echo base_url() ?>pelanggaran/tambah" class="btn btn-xl btn-success" style="margin-bottom: 15px; float: right;"><i class="fa fa-plus-square"></i> Input Pelanggaran</a>
              <h3 class="mb-0"><?php echo $page ?></h3>
            <div class="table-responsive py-4">
              <table class="table table-flush" id="datatable-basic">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>Nama Siswa</th>
                    <th>Kelas</th>
                    <th>Dilaporkan oleh</th>
                    <th>Wali Murid</th>
                    <th>Tipe Pelanggaran</th>
                    <th>Catatan</th>
                    <th>Point Yang Didapatkan</th>
                    <th>Tanggal & Waktu</th>
                    <th>Opsi</th>
                  </tr>
                </thead>
              </table>
            </div>
          </div>
        <script src="<?php echo base_url() ?>assets/js/plugins/jquery/dist/jquery.min.js"></script>
        <script type="text/javascript">
            $(document).ready(function() {
                $.fn.dataTableExt.oApi.fnPagingInfo = function(oSettings)
                {
                    return {
                        "iStart": oSettings._iDisplayStart,
                        "iEnd": oSettings.fnDisplayEnd(),
                        "iLength": oSettings._iDisplayLength,
                        "iTotal": oSettings.fnRecordsTotal(),
                        "iFilteredTotal": oSettings.fnRecordsDisplay(),
                        "iPage": Math.ceil(oSettings._iDisplayStart / oSettings._iDisplayLength),
                        "iTotalPages": Math.ceil(oSettings.fnRecordsDisplay() / oSettings._iDisplayLength)
                    };
                };

                var t = $("#datatable-basic").DataTable({
                    initComplete: function() {
                        var api = this.api();
                        $('#mytable_filter input')
                                .off('.DT')
                                .on('keyup.DT', function(e) {
                                    if (e.keyCode == 13) {
                                        api.search(this.value).draw();
                            }
                        });
                    },
                    oLanguage: {
                        sProcessing: "loading..."
                    },
                    processing: true,
                    serverSide: true,
                    ajax: {"url": "pelanggaran/json", "type": "POST"},
                    columns: [
                        {
                            "data": "reported_on",
                            "orderable": false
                        },{"data": "std_name"},{"data": "class_name"},{"data": "teacher_name"},{"data": "wali_name"},{"data": "violation_name"},{"data": "note"},{"data": "point"},{"data": "reported_on"},
                        {
                            "data" : "action",
                            "orderable": false,
                            "className" : "text-center"
                        }
                    ],
                    order: [[0, 'desc']],
                    rowCallback: function(row, data, iDisplayIndex) {
                        var info = this.fnPagingInfo();
                        var page = info.iPage;
                        var length = info.iLength;
                        var index = page * length + (iDisplayIndex + 1);
                        $('td:eq(0)', row).html(index);
                    }
                });
            });
        </script>