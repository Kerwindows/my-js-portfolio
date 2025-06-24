<?php
if (!defined('PROJECT_PATH')) {
    header("Location: ../../../404.html");
    exit();
}
?>

<footer class="main-footer">
    <div class="float-right d-none d-sm-block">
        <b>Version</b> 1
    </div>
    <strong>Copyright &copy; <?php echo date('Y') ?> <a href="https://linkwi.co">linkwi.co</a>.</strong> All rights
    reserved.
</footer>

<!-- Control Sidebar -->
<aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
</aside>
<!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->
<!-- Select2 -->
<!-- <script src="../../admin/plugins/select2/js/select2.full.min.js"></script> -->
<!-- Bootstrap 4 -->

<!-- DataTables  & Plugins -->
<script src="<?php echo base_url_dir() ?>/admin/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url_dir() ?>/admin/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="<?php echo base_url_dir() ?>/admin/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="<?php echo base_url_dir() ?>/admin/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="<?php echo base_url_dir() ?>/admin/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="<?php echo base_url_dir() ?>/admin/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<?php if (getSlug() == 'views-chart') { ?>
    <script src="vendor/library/jquery.min.js"></script>
    <script src="vendor/library/bootstrap-5/bootstrap.bundle.min.js"></script>
    <script src="vendor/library/moment.min.js"></script>
    <script src="vendor/library/daterangepicker.min.js"></script>
    <script src="vendor/library/Chart.bundle.min.js"></script>
    <script src="vendor/library/jquery.dataTables.min.js"></script>
    <script src="vendor/library/dataTables.bootstrap5.min.js"></script>
<?php } else { ?>
    <script src="<?php echo base_url_dir() ?>/admin/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<?php } ?>
<script src="<?php echo base_url_dir() ?>/admin/plugins/jszip/jszip.min.js"></script>
<script src="<?php echo base_url_dir() ?>/admin/plugins/pdfmake/pdfmake.min.js"></script>
<script src="<?php echo base_url_dir() ?>/admin/plugins/pdfmake/vfs_fonts.js"></script>
<script src="<?php echo base_url_dir() ?>/admin/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="<?php echo base_url_dir() ?>/admin/plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="<?php echo base_url_dir() ?>/admin/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
<script src="<?php echo base_url_dir() ?>/admin/plugins/toastr/toastr.min.js"></script>
<!-- AdminLTE App -->
<script src="<?php echo base_url_dir() ?>/admin/dist/js/adminlte.min.js"></script>
<!--<script src="<?php echo base_url_dir() ?>/admin/plugins/chart.js/Chart.min.js"></script>-->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<!-- Page specific script -->
<script>
    $(function() {
        $("#example1").DataTable({
            "responsive": false,
            "info": true,
            "paging": true,
            "searching": true,
            "scrollX": true,
            "lengthChange": true,
            "ordering": true,
            "autoWidth": false,
            "buttons": ["copy", "csv", "excel", {
                extend: 'pdf',
                text: 'Pdf',
                orientation: 'landscape',
                pageSize: 'LEGAL',
                exportOptions: {
                    modifier: {
                        page: 'current'

                    }
                }
            }, "print", "colvis"]
        }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');


        $('#example2').DataTable({
            "paging": false,
            "lengthChange": false,
            "searching": false,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "responsive": true,
            "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
        }).buttons().container().appendTo('#example2_wrapper .col-md-6:eq(0)');


    });
</script>

<script>
function toolTip(tooltipName) {
    var tt = document.getElementById(tooltipName);
    tt.classList.toggle("show");
}
</script>
</body>

</html>