<?= $this->extend('layouts/main/template'); ?>

<?= $this->section('main-content'); ?>

<section class="py-5">
    <div class="container py-lg-5">
        <div class="row" data-aos="fade-up" data-aos-duration="1000">
            <div class="col-lg-3 order-2 order-lg-1">
                <h2 class="h3 mb-4 pb-1">Search & Filter</h2>
                <form action="" method="get">
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" placeholder="Search hotel name..." name="search" value="<?= isset($_GET['search']) ? $_GET['search'] : ''; ?>">
                        <button class="btn btn-outline-primary" type="submit" id="search_button"><i class="fas fa-search"></i></button>
                    </div>
                    <div class="card border-0 shadow-sm mb-4 p-2">
                        <div id="rating-filter" class="card-body">
                            <h2 class="h5 mb-4">Rating</h2>
                            <div class="custom-control custom-checkbox mb-2">
                                <input class="custom-control-input" id="rating-1-star" name="rating[]" value="1" type="checkbox">
                                <label class="custom-control-label" for="rating-1-star"><i class="fas fa-star"></i></label>
                            </div>
                            <div class="custom-control custom-checkbox mb-2">
                                <input class="custom-control-input" id="rating-2-star" name="rating[]" value="2" type="checkbox">
                                <label class="custom-control-label" for="rating-2-star"><i class="fas fa-star"></i><i class="fas fa-star"></i></label>
                            </div>
                            <div class="custom-control custom-checkbox mb-2">
                                <input class="custom-control-input" id="rating-3-star" name="rating[]" value="3" type="checkbox">
                                <label class="custom-control-label" for="rating-3-star"><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i></label>
                            </div>
                            <div class="custom-control custom-checkbox mb-2">
                                <input class="custom-control-input" id="rating-4-star" name="rating[]" value="4" type="checkbox">
                                <label class="custom-control-label" for="rating-4-star"><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i></label>
                            </div>
                            <div class="custom-control custom-checkbox mb-2">
                                <input class="custom-control-input" id="rating-5-star" name="rating[]" value="5" type="checkbox">
                                <label class="custom-control-label" for="rating-5-star"><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i></label>
                            </div>
                        </div>
                    </div>
                    <div class="card border-0 shadow-sm mb-4 p-2">
                        <div id="facility-filter" class="card-body">
                            <h2 class="h5 mb-4">Facility</h2>
                            <?php foreach ($facilities as $i => $facility) : ?>
                                <div class="custom-control custom-checkbox mb-2">
                                    <input class="custom-control-input" id="facility-<?= $i + 1; ?>" name="facility[]" value="<?= $facility['facility_id']; ?>" type="checkbox">
                                    <label class="custom-control-label" for="facility-<?= $i + 1; ?>"><?= $facility['facility_name']; ?></label>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                    <div class="card border-0 shadow-sm mb-4 p-2">
                        <div id="price-filter" class="card-body">
                            <h2 class="h5 mb-4">Price</h2>
                            <div class="row mb-2">
                                <div class="col">
                                    <label for="hotel-min-price">Min</label>
                                    <input class="form-control" type="text" id="hotel-min-price" name="min_price">
                                </div>
                            </div>
                            <div class="row mb-4">
                                <div class="col">
                                    <label for="hotel-max-price">Max</label>
                                    <input class="form-control" type="text" id="hotel-max-price" name="max_price">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="mb-2" id="price-slider"></div>
                                    <small id="price-slider-value"></small>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card border-0 shadow-sm mb-4 p-2">
                        <div id="location-filter" class="card-body">
                            <h2 class="h5 mb-4">Location</h2>
                            <?php foreach ($hotel_location as $i => $location) : ?>
                                <div class="custom-control custom-checkbox mb-2">
                                    <input class="custom-control-input" id="hotel-city-<?= $i + 1; ?>" name="location[]" value="<?= $location['city']; ?>" type="checkbox">
                                    <label class="custom-control-label" for="hotel-city-<?= $i + 1; ?>"><?= $location['city']; ?></label>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                    <button class="btn btn-primary btn-block" type="submit">Apply</button>
                </form>
            </div>
            <div class="col-lg-9 mb-5 mb-lg-0 order-1 order-lg-2">
                <div class="row mb-4 align-items-center">
                    <div class="col-md-5 offset-md-7 text-md-right">
                        <p class="h6 mb-0 p-3 p-md-0">Showing <?= count($hotel_list); ?> results</p>
                    </div>
                </div>
                <div class="row mb-4">
                    <?php if (!empty($hotel_list)) : ?>
                        <?php foreach ($hotel_list as $i => $hotel) : ?>
                            <div class="col-lg-6 mb-4">
                                <div class="card shadow-sm border-0 reset-anchor d-block hover-transition">
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
                                            <img src="/assets/img/hotels/<?= $hotel['image']; ?>" alt="<?= $hotel['name']; ?>" height="300">
                                        </div>
                                    </a>
                                    <div class="card-body p-4">
                                        <h3 class="h5"><a class="stretched-link reset-anchor" href="/hotels/detail/<?= $hotel['id']; ?>"><?= $hotel['name']; ?></a></h3>
                                        <p class="text-muted text-small mb-0"><?= trim(substr($hotel['description'], 0, 100)); ?>...</p>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php else : ?>
                        <div class="col-lg-12 mb-4">
                            <div class="text-center card shadow-sm border-0 p-3 reset-anchor d-block hover-transition">
                                <h3>No Hotel Found</h3>
                                <a href="/hotels">View Hotel List</a>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
                <!-- PAGINATION-->
                <?= $pager->links('hotels', 'bootstrap_pagination') ?>
            </div>
        </div>
    </div>
</section>

<?= $this->endSection(); ?>