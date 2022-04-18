<?= $this->extend('layouts/main/template'); ?>

<?= $this->section('main-content'); ?>

<?php if (session()->getFlashdata('sweet-alert-success')) : ?>
    <div class="flash-data" data-flashdata="<?= session()->getFlashdata('sweet-alert-success') ?>"></div>
<?php endif; ?>
<?php if (session()->getFlashdata('sweet-alert-error')) : ?>
    <div class="flash-data" data-flashdata="<?= session()->getFlashdata('sweet-alert-error') ?>"></div>
<?php endif; ?>

<!-- Hero section-->
<section class="hero-home py-3">
    <div class="container pt-5">
        <div class="row" style="margin-top: 24vh;" data-aos="zoom-in" data-aos-duration="1000">
            <div class="col-lg-8 mx-auto text-center">
                <p class="h6 text-uppercase text-primary mb-3">U-Hotel</p>
                <h1 class="text-white mb-5">We serve the best resting place, anytime and anywhere.</h1>
            </div>
        </div>
    </div>
</section>
<!-- Features section-->
<section class="py-0" style="margin-top: 10vh;">
    <div class="container py-5" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="200">
        <div class="row text-center">
            <div class="col-lg-12 mx-auto">
                <div class="card border-0 shadow">
                    <div class="card-body p-5">
                        <div class="row">
                            <div class="col-lg-4 mb-4 mb-lg-0">
                                <svg class="svg-icon mb-3 text-primary svg-icon-big">
                                    <use xlink:href="#property-1"> </use>
                                </svg>
                                <h2 class="h5">Stay Guarantee</h2>
                                <p class="text-muted text-small mb-0">We have a guarantee to provide comfortable hotel services for customers.</p>
                            </div>
                            <div class="col-lg-4 mb-4 mb-lg-0">
                                <svg class="svg-icon mb-3 text-primary svg-icon-big">
                                    <use xlink:href="#dollar-sign-1"> </use>
                                </svg>
                                <h2 class="h5">Best Price</h2>
                                <p class="text-muted text-small mb-0">We make sure to always provide the best price when placing an order.</p>
                            </div>
                            <div class="col-lg-4 mb-4 mb-lg-0">
                                <svg class="svg-icon mb-3 text-primary svg-icon-big">
                                    <use xlink:href="#list-details-1"> </use>
                                </svg>
                                <h2 class="h5">Easy Payment</h2>
                                <p class="text-muted text-small mb-0">Choose your preferred payment method (transfers, credit cards, etc).</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Featured Hotels -->
<section class="py-5">
    <div class="container py-5" data-aos="fade-up">
        <h1 class="mb-2">Featured Hotels</h1>
        <div class="row" data-aos="fade-up" data-aos-delay="200">
            <div class="col mb-4">
                <div style="display: flex; flex-wrap: wrap; overflow-x: scroll;">
                    <div style="display: flex; flex-wrap: nowrap; transform: translateZ(0); overflow: visible;">
                        <?php foreach ($hotels as $hotel) : ?>
                            <div class="card mx-2 my-3 shadow-sm border-0 reset-anchor d-block hover-transition" style="width: 300px;">
                                <a class="d-block dark-overlay card-img-top overflow-hidden tool-trending" href="/hotels/detail/<?= $hotel['id']; ?>">
                                    <div class="tool-thumb rounded-circle" href="#">
                                        <img class="rounded-circle" src="/assets/img/uhotel2.png" alt="U-Hotel" width="40">
                                    </div>
                                    <div class="featured-badge" rel="tooltip" data-placement="top" title="Per Day">
                                        <?= number_to_currency($hotel['price_per_day'], 'IDR'); ?>
                                    </div>
                                    <ul class="list-inline tool-rating mb-0" rel="tooltip" data-placement="top" title="Rating">
                                        <?php for ($i = 0; $i < $hotel['star_rating']; $i++) { ?>
                                            <li class="list-inline-item m-0"><i class="fas fa-star text-white"></i></li>
                                        <?php } ?>
                                    </ul>
                                    <div class="overlay-content">
                                        <img src="/assets/img/hotels/<?= $hotel['image']; ?>" alt="<?= $hotel['name']; ?>" height="250">
                                    </div>
                                </a>
                                <div class="card-body p-4">
                                    <h3 class="h5"><a class="stretched-link reset-anchor" href="/hotels/detail/<?= $hotel['id']; ?>"><?= $hotel['name']; ?></a></h3>
                                    <p class="text-muted text-small mb-0"><?= trim(substr($hotel['description'], 0, 50)); ?>...</p>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="row" data-aos="zoom-in">
            <div class="col">
                <a type="btn" class="btn btn-primary btn-block" href="/hotels">View More</a>
            </div>
        </div>
    </div>
</section>

<?= $this->endSection(); ?>