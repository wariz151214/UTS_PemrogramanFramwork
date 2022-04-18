<!-- Main Footer -->
<footer class="main-footer">
    <strong>Copyright &copy; 2014-2021 <a href="https://adminlte.io/" target="_blank">AdminLTE.io</a>.</strong>
    All rights reserved.
    <div class="float-right d-none d-sm-inline-block">
        <b>Version</b> 3.1.0
    </div>
</footer>
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->

<!-- jQuery -->
<script src="/assets/vendors/jquery/jquery.min.js"></script>
<!-- Bootstrap -->
<script src="/assets/vendors/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- DataTables  & Plugins -->
<script src="/assets/vendors/datatables/jquery.dataTables.min.js"></script>
<script src="/assets/vendors/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="/assets/vendors/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="/assets/vendors/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="/assets/vendors/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="/assets/vendors/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="/assets/vendors/jszip/jszip.min.js"></script>
<script src="/assets/vendors/pdfmake/pdfmake.min.js"></script>
<script src="/assets/vendors/pdfmake/vfs_fonts.js"></script>
<script src="/assets/vendors/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="/assets/vendors/datatables-buttons/js/buttons.print.min.js"></script>
<script src="/assets/vendors/datatables-buttons/js/buttons.colVis.min.js"></script>
<!-- Ekko Lightbox -->
<script src="/assets/vendors/ekko-lightbox/ekko-lightbox.min.js"></script>
<!-- Select2 -->
<script src="/assets/vendors/select2/js/select2.full.min.js"></script>
<!-- bs-custom-file-input -->
<script src="/assets/vendors/bs-custom-file-input/bs-custom-file-input.min.js"></script>
<!-- AdminLTE -->
<script src="/assets/js/adminlte.js"></script>
<!-- SweetAlert2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.16/dist/sweetalert2.min.js"></script>
<?php if (session()->getFlashdata('sweet-alert-success')) : ?>
    <script>
        const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 5000,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer)
                toast.addEventListener('mouseleave', Swal.resumeTimer)
            }
        })

        const flashData = $('.flash-data').data('flashdata');

        if (flashData) {
            Toast.fire({
                icon: 'success',
                title: '<?= session()->getFlashdata('sweet-alert-success'); ?>'
            });
        }
    </script>
<?php endif; ?>
<?php if (session()->getFlashdata('sweet-alert-error')) : ?>
    <script>
        const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 5000,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer)
                toast.addEventListener('mouseleave', Swal.resumeTimer)
            }
        })

        const flashData = $('.flash-data').data('flashdata');

        if (flashData) {
            Toast.fire({
                icon: 'error',
                title: '<?= session()->getFlashdata('sweet-alert-error'); ?>'
            });
        }
    </script>
<?php endif; ?>
<!-- Custom Script -->
<?php
if (!empty($custom_js)) {
    foreach ($custom_js as $js) {
        echo $js;
    }
}
?>
</body>

</html>