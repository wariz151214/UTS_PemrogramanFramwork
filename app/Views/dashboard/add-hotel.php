<?= $this->extend('layouts/dashboard/template'); ?>

<?= $this->section('dashboard-content'); ?>

<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <h1>Add Hotel</h1>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="card card-primary shadow-sm">
                <div class="card-header">
                    <h3 class="card-title">Add New Hotel</h3>
                </div>
                <form action="/dashboard/hotels/add/save" method="post" enctype="multipart/form-data">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="hotel_name">Hotel Name</label>
                                    <input type="text" class="form-control<?= ($validation->hasError('hotel_name')) ? ' is-invalid' : ''; ?>" id="hotel_name" name="hotel_name" placeholder="Hotel name" required autofocus>
                                    <div class="invalid-feedback">
                                        <?= $validation->getError('hotel_name'); ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group clearfix">
                                    <label for="star_rating_3">Star Rating</label><br>
                                    <div class="icheck-primary d-inline">
                                        <label for="star_rating_1">1</label>
                                        <input type="radio" id="star_rating_1" name="star_rating" value="1" required>
                                    </div>
                                    <div class="icheck-primary d-inline">
                                        <input type="radio" id="star_rating_2" name="star_rating" value="2">
                                        <label for="star_rating_2"></label>
                                    </div>
                                    <div class="icheck-primary d-inline">
                                        <input type="radio" id="star_rating_3" name="star_rating" value="3" checked>
                                        <label for="star_rating_3"></label>
                                    </div>
                                    <div class="icheck-primary d-inline">
                                        <input type="radio" id="star_rating_4" name="star_rating" value="4">
                                        <label for="star_rating_4"></label>
                                    </div>
                                    <div class="icheck-primary d-inline">
                                        <input type="radio" id="star_rating_5" name="star_rating" value="5">
                                        <label for="star_rating_5">5</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="hotel_facilities">Facilities</label>
                                    <select class="select2bs4<?= ($validation->hasError('hotel_facilities')) ? ' is-invalid' : ''; ?>" multiple="multiple" id="hotel_facilities" name="hotel_facilities[]" data-placeholder="Select a facility" style="width: 100%;" required>
                                        <?php foreach ($facilities as $facility) : ?>
                                            <option value="<?= $facility['facility_id']; ?>"><?= $facility['facility_name']; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                    <div class="invalid-feedback">
                                        <?= $validation->getError('hotel_facilities'); ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="hotel_room_amount">Number of Rooms</label>
                                    <input type="text" class="form-control<?= ($validation->hasError('hotel_room_amount')) ? ' is-invalid' : ''; ?>" id="hotel_room_amount" name="hotel_room_amount" placeholder="Number of rooms" required>
                                    <div class="invalid-feedback">
                                        <?= $validation->getError('hotel_room_amount'); ?>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="hotel_price_per_day">Price Per Day</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text font-weight-bold">IDR</span>
                                        </div>
                                        <input type="text" class="form-control<?= ($validation->hasError('hotel_price_per_day')) ? ' is-invalid' : ''; ?>" id="hotel_price_per_day" name="hotel_price_per_day" placeholder="Price per day" required>
                                        <div class="invalid-feedback">
                                            <?= $validation->getError('hotel_price_per_day'); ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="hotel_address">Address</label>
                                    <input type="text" class="form-control<?= ($validation->hasError('hotel_address')) ? ' is-invalid' : ''; ?>" id="hotel_address" name="hotel_address" placeholder="Address" required>
                                    <div class="invalid-feedback">
                                        <?= $validation->getError('hotel_address'); ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="hotel_city">City</label>
                                    <input type="text" class="form-control<?= ($validation->hasError('hotel_city')) ? ' is-invalid' : ''; ?>" id="hotel_city" name="hotel_city" placeholder="City" required>
                                    <div class="invalid-feedback">
                                        <?= $validation->getError('hotel_city'); ?>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="hotel_province">Province</label>
                                    <input type="text" class="form-control<?= ($validation->hasError('hotel_province')) ? ' is-invalid' : ''; ?>" id="hotel_province" name="hotel_province" placeholder="Province" required>
                                    <div class="invalid-feedback">
                                        <?= $validation->getError('hotel_province'); ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="hotel_postal_code">Postal Code</label>
                                    <input type="text" class="form-control<?= ($validation->hasError('hotel_postal_code')) ? ' is-invalid' : ''; ?>" id="hotel_postal_code" name="hotel_postal_code" placeholder="Postal code" required>
                                    <div class="invalid-feedback">
                                        <?= $validation->getError('hotel_postal_code'); ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="hotel_description">Description</label>
                                    <textarea class="form-control<?= ($validation->hasError('hotel_description')) ? ' is-invalid' : ''; ?>" rows="5" id="hotel_description" name="hotel_description" placeholder="Description" required></textarea>
                                    <div class="invalid-feedback">
                                        <?= $validation->getError('hotel_description'); ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-2">
                                <img src="/assets/img/hotels/placeholder.png" class="img-thumbnail img-preview">
                            </div>
                            <div class="col-10">
                                <div class="form-group">
                                    <label for="hotel_image">Hotel Image</label>
                                    <div class="custom-file">
                                        <label class="custom-file-label" for="hotel_image">Choose image</label>
                                        <input type="file" class="custom-file-input<?= ($validation->hasError('hotel_image')) ? ' is-invalid' : ''; ?>" id="hotel_image" name="hotel_image" accept=".jpg,.jpeg,.png">
                                        <div class="invalid-feedback">
                                            <?= $validation->getError('hotel_image'); ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card-footer">
                        <?= csrf_field(); ?>
                        <button type="submit" class="btn btn-primary float-right" name="submit">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </section>
</div>

<?= $this->endSection(); ?>