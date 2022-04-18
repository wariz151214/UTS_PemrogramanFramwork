<script type="text/javascript">
    $(function() {
        $("#booking-list").DataTable({
            "responsive": true,
            "lengthChange": true,
            "pageLength": 10,
            "lengthMenu": [
                [5, 10, 25, 50, -1],
                [5, 10, 25, 50, "All"]
            ],
            "autoWidth": false,
            "buttons": ["csv", "excel", "pdf", "print", "colvis"]
        }).buttons().container().appendTo('#booking-list_wrapper .col-md-6:eq(0)');
    });
</script>