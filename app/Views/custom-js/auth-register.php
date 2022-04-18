<script type="text/javascript">
    $(function() {
        // Custom file input
        bsCustomFileInput.init();

        // Date picker
        $('[data-datepicker]').datetimepicker({
            format: 'YYYY-MM-DD'
        });

        // InputMask
        $('[data-mask]').inputmask();

        // User avatar preview
        $('#user_avatar').on('change', function() {
            const file = $(this).get(0).files;
            const reader = new FileReader();

            reader.readAsDataURL(file[0]);
            reader.addEventListener('load', function(e) {
                const image = e.target.result;
                $('.img-preview').attr('src', image);
            });
        });
    });
</script>