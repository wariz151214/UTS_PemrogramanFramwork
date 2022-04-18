<?= $this->extend('layouts/main/template'); ?>

<?= $this->section('main-content'); ?>

<?php if (session()->getFlashdata('sweet-alert-success')) : ?>
    <div class="flash-data" data-flashdata="<?= session()->getFlashdata('sweet-alert-success') ?>"></div>
<?php endif; ?>
<?php if (session()->getFlashdata('sweet-alert-error')) : ?>
    <div class="flash-data" data-flashdata="<?= session()->getFlashdata('sweet-alert-error') ?>"></div>
<?php endif; ?>

<div class="container my-5" data-aos="fade-up" data-aos-duration="1000">
    <h1 class="mb-3">Booking<small> - <?= $hotel['name']; ?></small></h1>
    <h4><small>Room Available:
            <?php if ($hotel['number_of_rooms'] <= 5) : ?>
                <span data-available-room="<?= $hotel['number_of_rooms']; ?>" class="badge text-white bg-danger"><?= $hotel['number_of_rooms']; ?></span>
            <?php elseif ($hotel['number_of_rooms'] <= 10) : ?>
                <span data-available-room="<?= $hotel['number_of_rooms']; ?>" class="badge bg-warning"><?= $hotel['number_of_rooms']; ?></span>
            <?php else : ?>
                <span data-available-room="<?= $hotel['number_of_rooms']; ?>" class="badge text-white bg-success"><?= $hotel['number_of_rooms']; ?></span>
            <?php endif; ?>
            -
        </small>
        <small data-price-per-day="<?= $hotel['price_per_day']; ?>" class="font-weight-bold"><?= number_to_currency($hotel['price_per_day'], 'IDR'); ?> per day</small>
    </h4>

    <form action="/hotels/newBooking" method="post">
        <?= csrf_field(); ?>
        <div class="row">
            <div class="form-group col">
                <label for="full_name">Full Name - <a id="self-name" href="#full_name">use my name</a></label>
                <input class="form-control form-control-lg<?= ($validation->hasError('full_name')) ? ' is-invalid' : ''; ?>" id="full_name" type="text" name="full_name" placeholder="Full name" required autofocus>
                <div class="invalid-feedback">
                    <?= $validation->getError('full_name'); ?>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="form-group col">
                <label for="phone_number">Phone Number - <a id="self-phone-number" href="#phone_number">use my phone number</a></label>
                <input class="form-control form-control-lg<?= ($validation->hasError('phone_number')) ? ' is-invalid' : ''; ?>" id="phone_number" type="text" name="phone_number" placeholder="Phone number" data-inputmask="'mask': '+62 999 9999 9999'" data-mask required>
                <div class="invalid-feedback">
                    <?= $validation->getError('phone_number'); ?>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="form-group col">
                <label for="email">Email Address - <a id="self-email" href="#email">use my email</a></label>
                <input class="form-control form-control-lg<?= ($validation->hasError('email')) ? ' is-invalid' : ''; ?>" id="email" type="email" name="email" placeholder="Email" required>
                <div class="invalid-feedback">
                    <?= $validation->getError('email'); ?>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="form-group col-lg-3">
                <label for="room_amount">Number of Rooms</label>
                <input class="form-control form-control-lg<?= ($validation->hasError('room_amount')) ? ' is-invalid' : ''; ?>" id="room_amount" type="text" name="room_amount" placeholder="Number of Rooms" required>
                <div class="invalid-feedback">
                    <?= $validation->getError('room_amount'); ?>
                </div>
            </div>
            <div class="form-group col-lg-3">
                <label for="check_in">Check-in</label>
                <input class="datetimepicker-input form-control form-control-lg<?= ($validation->hasError('check_in')) ? ' is-invalid' : ''; ?>" id="check_in" type="text" name="check_in" placeholder="Check-in" data-datepicker data-toggle="datetimepicker" required>
                <div class="invalid-feedback">
                    <?= $validation->getError('check_in'); ?>
                </div>
            </div>
            <div class="form-group col-lg-3">
                <label for="check_out">Check-out</label>
                <input class="datetimepicker-input form-control form-control-lg<?= ($validation->hasError('check_out')) ? ' is-invalid' : ''; ?>" id="check_out" type="text" name="check_out" placeholder="Check-out" data-datepicker data-toggle="datetimepicker" required>
                <div class="invalid-feedback">
                    <?= $validation->getError('check_out'); ?>
                </div>
            </div>
            <div class="form-group col-lg-3">
                <label for="total_price">Total Price</label>
                <input class="form-control form-control-lg<?= ($validation->hasError('total_price')) ? ' is-invalid' : ''; ?>" id="total_price" type="number" name="total_price" placeholder="Total price" readonly>
                <div class="invalid-feedback">
                    <?= $validation->getError('total_price'); ?>
                </div>
            </div>
        </div>
        <input type="hidden" name="hotel_id" value="<?= $hotel['id']; ?>">
        <input type="hidden" name="uid" value="<?= session()->get('uid'); ?>">
        <button id="booking-btn" class="btn btn-primary btn-block" type="submit" disabled>Book</button>
    </form>
    <hr>
    <div class="text-center">
        <a href="/hotels">
            <i class="fas fa-long-arrow-alt-left"></i>
            Back
        </a>
    </div>
</div>

<?= $this->endSection(); ?>