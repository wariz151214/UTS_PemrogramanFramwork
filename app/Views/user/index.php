<?= $this->extend('layouts/main/template'); ?>

<?= $this->section('main-content'); ?>

<div class="container my-5">
    <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
        <li class="nav-item" role="presentation">
            <a class="nav-link active" id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="true">My Profile</a>
        </li>
        <li class="nav-item" role="presentation">
            <a class="nav-link" id="pills-booking-list-tab" data-toggle="pill" href="#pills-booking-list" role="tab" aria-controls="pills-booking-list" aria-selected="false">My Bookings</a>
        </li>
    </ul>
    <div class="tab-content" id="pills-tabContent">
        <div class="tab-pane fade show active" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="mb-3">My Profile<small> - <?= session()->get('full_name'); ?></small></h1>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <h5><small>User since <?= date_format(date_create(session()->get('created_at')), "F d, Y"); ?></small></h5>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-2 mb-4">
                    <img src="/assets/img/user-profile/<?= session()->get('avatar'); ?>" class="img-thumbnail img-preview" width="150">
                </div>
                <div class="col-lg-10">
                    <p>UID: <?= session()->get('uid'); ?></p>
                    <p>Email: <?= session()->get('email'); ?></p>
                    <p>Birth Date: <?= date_format(date_create(session()->get('birth_date')), "d F Y"); ?></p>
                    <p>Phone Number: +62 <?= session()->get('phone_number'); ?></p>
                    <p>Gender: <?= session()->get('gender'); ?></p>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12 mb-2">
                    <a href="/user/profile/edit">Edit Profile Details</a>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <a href="/user/profile/change-password">Change Password</a>
                </div>
            </div>
            <hr>
        </div>
        <div class="tab-pane fade" id="pills-booking-list" role="tabpanel" aria-labelledby="pills-booking-list-tab">
            <h1 class="mb-3">Booking List</h1>
            <?php if (!empty($booking_list)) : ?>
                <?php foreach ($booking_list as $booking) : ?>
                    <div class="row mb-4">
                        <div class="col card p-2">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="row mb-4">
                                            <div class="col-8">
                                                <a class="text-muted font-weight-bold" href="/user/booking-details/<?= $booking['booking_id']; ?>" target="_blank">
                                                    <p class="card-text">#<?= $booking['booking_id']; ?></p>
                                                </a>
                                                <h5 class="text-primary card-title"><?= $booking['hotel_name']; ?></h5>
                                                <p class="card-text">1 room x <?= number_to_currency($booking['price_per_day'], 'IDR'); ?></p>
                                            </div>
                                            <div class="col-4 text-right">
                                                <p class="card-text">Total Price</p>
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
                                        <a class="btn btn-primary" href="/user/booking-details/<?= $booking['booking_id']; ?>" target="_blank">View Details</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else : ?>
                <div class="row mb-4">
                    <div class="col card p-2">
                        <div class="card-body text-center">
                            <h4>You don't have any booking</h4>
                            <a href="/hotels" target="_blank">View Hotel List</a>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>

<?= $this->endSection(); ?>