<script src="/assets/js/input-filter.js"></script>
<script type="text/javascript">
    $(function() {
        setInputFilter(document.getElementById('hotel_room_amount'), (value) => {
            return /^\d*?$/.test(value);
        });

        setInputFilter(document.getElementById('hotel_price_per_day'), (value) => {
            return /^\d*?$/.test(value);
        });

        $('.select2').select2();

        $('.select2bs4').select2({
            theme: 'bootstrap4'
        });

        // Price per day
        $('#hotel_price_per_day').on('change keyup keydown', function() {
            const amount = parseInt(this.value);

            if (!amount) {
                this.value = '';
            }
        });

        // Custom file input
        bsCustomFileInput.init();

        // Hotel image preview
        $('#hotel_image').on('change', function() {
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