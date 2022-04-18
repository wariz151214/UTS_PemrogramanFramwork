<?= $this->extend('layouts/main/template'); ?>

<?= $this->section('main-content'); ?>

<!-- Hero section-->
<section class="hero d-flex align-items-end py-5 bg-cover bg-center" style="background: url(/assets/img/hotels/<?= $hotel['image']; ?>)">
    <div class="container index-forward py-5 py-lg-0">
        <div class="row align-items-end" data-aos="zoom-in" data-aos-duration="1000">
            <div class="col-lg-7 mb-4 mb-lg-0">
                <div class="media align-items-center"><img class="img-thumbnail rounded-circle mr-2" src="/assets/img/hotels/<?= $hotel['image']; ?>" alt="U-Hotel" style="width: 120px; height: 120px !important;">
                    <div class="media-body ml-3">
                        <h1 class="text-white"><?= $hotel['name']; ?></h1>
                        <h6 class="text-white"><?= $hotel['province']; ?></h6>
                        <p class="text-white"><?= $hotel['address']; ?>, <?= $hotel['city']; ?>, <?= $hotel['postal_code']; ?></p>
                        <ul class="list-inline mb-0 text-small">
                            <?php for ($i = 0; $i < $hotel['star_rating']; $i++) { ?>
                                <li class="list-inline-item m-0"><i class="fas fa-star text-white"></i></li>
                            <?php } ?>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-lg-5 text-lg-right">
                <ul class="list-inline mb-0">
                    <li class="list-inline-item m-1">
                        <form action="/hotels/booking" method="post">
                            <?= csrf_field(); ?>
                            <input type="hidden" name="hotel_id" value="<?= $hotel['id']; ?>">
                            <button type="submit" class="btn btn-primary"><i class="fas fa-door-open mr-2"></i>Book Now</button>
                        </form>
                    </li>
                    <li class="list-inline-item m-1">
                        <a class="btn btn-outline-light px-3" href="#" rel="tooltip" data-placement="top" title="Per Day"><?= number_to_currency($hotel['price_per_day'], 'IDR'); ?></i></a>
                    </li>
                    <li class="list-inline-item m-1">
                        <a class="btn btn-outline-light px-3" href="/hotels" rel="tooltip" data-placement="top" title="Go Back"><i class="fas fa-reply"></i></a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</section>

<section class="py-5">
    <div class="container py-5">
        <div class="row">
            <div class="col-lg-8 d-flex">
                <div class="card border-0 shadow-sm mb-4 mb-lg-5 p-2 p-lg-0" data-aos="fade-up" data-aos-duration="1000">
                    <div class="card-body p-lg-5">
                        <h2 class="h3 mb-4">About this hotel</h2>
                        <hr>
                        <p class="text-justify"><?= $hotel['description']; ?></p>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 d-flex">
                <div class="card border-0 shadow-sm mb-4 mb-lg-5 p-2 p-lg-0 flex-fill" data-aos="fade-up" data-aos-duration="1000">
                    <div class="card-body p-lg-5">
                        <h2 class="h3 mb-4">Facilities</h2>
                        <hr>
                        <ul class="list-inline mb-0 d-flex flex-column">
                            <?php foreach ($facilities as $i => $facility) : ?>
                                <li class="list-inline-item m-1"><a class="btn btn-dark btn-block" href="#"><?= $facility['facility_name']; ?></a></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <div class="card border-0 shadow-sm mb-4 mb-lg-5 p-2 p-lg-0" data-aos="fade-up" data-aos-duration="1000">
                    <div class="card-body p-lg-5">
                        <h2 class="h3 mb-4">Image</h2>
                        <hr>
                        <div class="rounded overflow-hidden mb-3">
                            <div class="owl-carousel tool-gallery-slider" data-slider-id="1">
                                <a class="d-block" href="/assets/img/hotels/<?= $hotel['image']; ?>" data-lightbox="tool-gallery" title="<?= $hotel['name']; ?> - Preview">
                                    <img class="img-fluid" src="/assets/img/hotels/<?= $hotel['image']; ?>" alt="<?= $hotel['name']; ?>">
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php if (!empty($hotel_list)) : ?>
    <section class="pb-5">
        <div class="container" data-aos="fade-up">
            <header class="text-center mb-4">
                <h2>You May Also Be Interested In</h2>
            </header>
            <div class="row" data-aos="fade-up" data-aos-delay="200">
                <?php foreach ($hotel_list as $i => $hotel) : ?>
                    <div class="col-lg-4 mb-4 d-flex">
                        <div class="card shadow-sm border-0 reset-anchor d-block hover-transition">
                            <a class="d-block dark-overlay card-img-top overflow-hidden tool-trending" target="_blank" href="/hotels/detail/<?= $hotel['id']; ?>">
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
                                    <img src="/assets/img/hotels/<?= $hotel['image']; ?>" alt="<?= $hotel['name']; ?>" height="300">
                                </div>
                            </a>
                            <div class="card-body p-4">
                                <h3 class="h5"><a class="stretched-link reset-anchor" target="_blank" href="/hotels/detail/<?= $hotel['id']; ?>"><?= $hotel['name']; ?></a></h3>
                                <p class="text-muted text-small mb-0"><?= trim(substr($hotel['description'], 0, 100)); ?>...</p>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>
<?php endif; ?>

<?= $this->endSection(); ?>