<script src="/assets/js/input-filter.js"></script>
<script type="text/javascript">
    const formatNumber = number => {
        return number.toString().replace(/\B(?<!\.\d*)(?=(\d{3})+(?!\d))/g, ",");
    };

    const compareDates = fromCheckIn => {
        const dateFormat = 'YYYY-MM-DD';
        const checkIn = $('#check_in')[0];
        const checkOut = $('#check_out')[0];

        const checkInDate = checkIn.value;
        const checkOutDate = checkOut.value;

        // we need two value to compare
        if (!checkInDate || !checkOutDate) {
            return;
        }

        if (fromCheckIn && checkInDate > checkOutDate) {
            /**
             * * if check-in date is higher than check-out date
             * * then set new check-out date to check-in date plus 1 day
             */
            const momentDate = moment(checkInDate);
            const newCheckOutDate = momentDate.add(1, 'days').format(dateFormat);
            checkOut.value = newCheckOutDate;
        } else if (!fromCheckIn && checkOutDate < checkInDate) {
            /**
             * * if check-out date is lower than check-in date
             * * then set new check-in date to check-out date minus 1 day
             */
            const momentDate = moment(checkOutDate);
            const newCheckInDate = momentDate.subtract(1, 'days').format(dateFormat);
            checkIn.value = newCheckInDate;
        }
    };

    const countDays = () => {
        const startDate = moment($('#check_in').val());
        const endDate = moment($('#check_out').val());

        const duration = endDate.diff(startDate, 'days');

        return (duration ? duration : 1);
    };

    const calculateTotalPrice = () => {
        const roomAmount = parseInt($('#room_amount').val());
        const availableRoom = $('[data-available-room]').data('availableRoom');

        if (roomAmount < 1) {
            $('#room_amount').val('');
        } else if (roomAmount > availableRoom) {
            $('#room_amount').val(availableRoom);
        }

        const duration = countDays();
        const durationMsg = `${duration > 1 ? `${duration} days` : `${duration} day`}`;

        const pricePerDay = $('[data-price-per-day]').data('pricePerDay');
        const totalPrice = roomAmount * pricePerDay * duration;

        const bookingButtonText = `Book${totalPrice ? ` ${durationMsg} for IDR ${formatNumber(totalPrice)}` : ''}`;

        $('#total_price').val(totalPrice);
        $('#booking-btn').text(bookingButtonText);
    };

    $(function() {
        setInputFilter(document.getElementById('room_amount'), (value) => {
            return /^\d*?$/.test(value);
        });

        setInputFilter(document.getElementById('total_price'), (value) => {
            return /^\d*?$/.test(value);
        });

        // * Date picker
        $('[data-datepicker]').datetimepicker({
            format: 'YYYY-MM-DD'
        });

        // * InputMask
        $('[data-mask]').inputmask();

        // * Handle 'use my name'
        $('a#self-name').click(function() {
            const fullName = `<?= session()->get('full_name'); ?>`;
            $(':input#full_name').val(fullName);
        });

        // * Handle 'use my phone number'
        $('a#self-phone-number').click(function() {
            const phoneNumber = `<?= session()->get('phone_number'); ?>`;
            $(':input#phone_number').val(phoneNumber);
        });

        // * Handle 'use my email'
        $('a#self-email').click(function() {
            const email = `<?= session()->get('email'); ?>`;
            $(':input#email').val(email);
        });

        // * Calculate total price based on number of room
        $('#room_amount').on('change keyup keydown', function() {
            calculateTotalPrice();
        });

        // * Validate date
        $('#check_in').on('blur', function() {
            const fromCheckIn = true;
            compareDates(fromCheckIn);
            calculateTotalPrice();
        });

        $('#check_out').on('blur', function() {
            const fromCheckIn = false;
            compareDates(fromCheckIn);
            calculateTotalPrice();
        });

        const availableRoom = $('[data-available-room]').data('availableRoom');
        if (availableRoom <= 0) {
            $('#booking-btn').prop('disabled', true).text('Hotel is full');
        } else {
            $('#booking-btn').prop('disabled', false).text('Book');
        }
    });
</script>