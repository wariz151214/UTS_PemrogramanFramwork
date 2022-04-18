<script type="text/javascript">
    $(function() {
        $("#hotel-list").DataTable({
            "responsive": true,
            "lengthChange": true,
            "pageLength": 5,
            "lengthMenu": [
                [5, 10, 25, 50, -1],
                [5, 10, 25, 50, "All"]
            ],
            "autoWidth": false,
            "buttons": ["csv", "excel", "pdf", "print", "colvis"]
        }).buttons().container().appendTo('#hotel-list_wrapper .col-md-6:eq(0)');

        $(document).on('click', '[data-toggle="lightbox"]', function(event) {
            event.preventDefault();
            $(this).ekkoLightbox({
                alwaysShowClose: true
            });
        });
    });
</script>