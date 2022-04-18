<?= $this->extend('layouts/main/template'); ?>

<?= $this->section('main-content'); ?>

<?php if (session()->getFlashdata('sweet-alert-success')) : ?>
    <div class="flash-data" data-flashdata="<?= session()->getFlashdata('sweet-alert-success') ?>"></div>
<?php endif; ?>
<?php if (session()->getFlashdata('sweet-alert-error')) : ?>
    <div class="flash-data" data-flashdata="<?= session()->getFlashdata('sweet-alert-error') ?>"></div>
<?php endif; ?>

<div class="container my-5" data-aos="zoom-in" data-aos-duration="1000">
    <h1 class="mb-3">Booking ID - #<?= $booking['booking_id']; ?></h1>
    <?php if (!empty($booking)) : ?>
        <div class="row mb-4">
            <div class="col card p-2">
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="row mb-4">
                                <div class="col-4">
                                    <h5 class="text-primary card-title"><?= $hotel['name']; ?></h5>
                                    <p class="card-text"><?= $hotel['province']; ?></p>
                                    <p class="card-text"><?= $hotel['address']; ?>, <?= $hotel['city']; ?>, <?= $hotel['postal_code']; ?></p>
                                </div>
                                <div class="col-3">
                                    <p class="card-text font-weight-bold">Booking Info</p>
                                    <p class="card-text">&bull; Number of Rooms <span class="font-weight-bold">(<?= $booking['number_of_rooms']; ?>)</span></p>
                                    <p class="card-text">1 room x <?= number_to_currency($booking['price_per_day'], 'IDR'); ?></p>
                                    <p class="card-text">&bull; Duration <span class="font-weight-bold">(<?= $booking['duration']; ?> <?= $booking['duration'] > 1 ? 'days' : 'day'; ?>)</span></p>
                                    <p class="card-text"><?= date_format(date_create($booking['check_in']), "d/m/Y"); ?> - <?= date_format(date_create($booking['check_out']), "d/m/Y"); ?></p>
                                </div>
                                <div class="col-3">
                                    <p class="card-text font-weight-bold">Guest Info</p>
                                    <p class="card-text">Name: <?= $booking['full_name']; ?></p>
                                    <p class="card-text">Phone Number: +62 <?= substr($booking['phone_number'], 2); ?></p>
                                    <p class="card-text">Email: <?= $booking['email']; ?></p>
                                </div>
                                <div class="col-2">
                                    <p class="card-text font-weight-bold">Total Price</p>
                                    <h5 class="card-text"><?= number_to_currency($booking['total_price'], 'IDR'); ?></h5>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-6">
                            <p class="card-text"><small class="text-muted"><?= date_format(date_create($booking['created_at']), "F d, Y - H:i:s"); ?></small></p>
                        </div>
                        <div class="col-6 text-right">
                            <a class="btn btn-primary" href="/hotels">View More Hotel</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php endif; ?>
</div>

<?= $this->endSection(); ?>