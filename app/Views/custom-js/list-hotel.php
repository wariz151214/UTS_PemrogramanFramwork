<!-- noUi Slider -->
<script src="https://cdn.jsdelivr.net/npm/nouislider@15.1.1/dist/nouislider.min.js"></script>
<script src="/assets/js/input-filter.js"></script>
<script type="text/javascript">
    $(function() {
        setInputFilter(document.getElementById('hotel-min-price'), (value) => {
            return /^\d+(\.\d+)*$/.test(value);
        });

        setInputFilter(document.getElementById('hotel-max-price'), (value) => {
            return /^\d+(\.\d+)*$/.test(value);
        });

        /* Price Slider */
        const priceSlider = $('#price-slider')[0];
        const priceSliderValue = $('#price-slider-value')[0];

        noUiSlider.create(priceSlider, {
            start: [2000000, 10000000],
            step: 50000,
            connect: true,
            range: {
                'min': [0],
                'max': [15000000]
            }
        });

        priceSlider.noUiSlider.on('update', function(values, handle) {
            priceSliderValue.innerHTML = values.join(' - ');

            if (handle) {
                $('#hotel-max-price').val(values[handle]);
            } else {
                $('#hotel-min-price').val(values[handle]);
            }
        });

        $('#hotel-min-price').on('change', function() {
            priceSlider.noUiSlider.set([this.value, null]);
        });

        $('#hotel-max-price').on('change', function() {
            priceSlider.noUiSlider.set([null, this.value]);
        });

        /* End Price Slider */

        /**
         * * Get URL parameters to determine which search filter to be checked
         */
        const urlParams = new URLSearchParams(window.location.search);
        const hotelRating = urlParams.getAll('rating[]');
        const hotelFacility = urlParams.getAll('facility[]');
        const hotelMinPrice = urlParams.get('min_price');
        const hotelMaxPrice = urlParams.get('max_price');
        const hotelLocation = urlParams.getAll('location[]');

        $('input[name="rating[]"]').each(function() {
            hotelRating.includes(this.value) && (this.checked = true);
        });

        $('input[name="facility[]"]').each(function() {
            hotelFacility.includes(this.value) && (this.checked = true);
        });

        $('input[name="location[]"]').each(function() {
            hotelLocation.includes(this.value) && (this.checked = true);
        });

        if (hotelMinPrice) {
            $('#hotel-min-price').val(hotelMinPrice);
        }

        if (hotelMaxPrice) {
            $('#hotel-max-price').val(hotelMaxPrice);
        }
    });
</script>