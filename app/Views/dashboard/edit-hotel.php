<?= $this->extend('layouts/dashboard/template'); ?>

<?= $this->section('dashboard-content'); ?>

<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <h1>Edit Hotel</h1>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="card card-primary shadow-sm">
                <div class="card-header">
                    <h3 class="card-title">Hotel ID - <?= $hotel['id']; ?></h3>
                </div>
                <form action="/dashboard/hotels/edit/save" method="post" enctype="multipart/form-data">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="hotel_name">Hotel Name</label>
                                    <input type="text" class="form-control<?= ($validation->hasError('hotel_name')) ? ' is-invalid' : ''; ?>" id="hotel_name" name="hotel_name" placeholder="Hotel name" value="<?= $hotel['name']; ?>" required autofocus>
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
                                        <?php if ($hotel['star_rating'] == 1) : ?>
                                            <input type="radio" id="star_rating_1" name="star_rating" value="1" checked required>
                                        <?php else : ?>
                                            <input type="radio" id="star_rating_1" name="star_rating" value="1" required>
                                        <?php endif; ?>
                                    </div>
                                    <div class="icheck-primary d-inline">
                                        <?php if ($hotel['star_rating'] == 2) : ?>
                                            <input type="radio" id="star_rating_2" name="star_rating" value="2" checked>
                                        <?php else : ?>
                                            <input type="radio" id="star_rating_2" name="star_rating" value="2">
                                        <?php endif; ?>
                                        <label for="star_rating_2"></label>
                                    </div>
                                    <div class="icheck-primary d-inline">
                                        <?php if ($hotel['star_rating'] == 3) : ?>
                                            <input type="radio" id="star_rating_3" name="star_rating" value="3" checked>
                                        <?php else : ?>
                                            <input type="radio" id="star_rating_3" name="star_rating" value="3">
                                        <?php endif; ?>
                                        <label for="star_rating_3"></label>
                                    </div>
                                    <div class="icheck-primary d-inline">
                                        <?php if ($hotel['star_rating'] == 4) : ?>
                                            <input type="radio" id="star_rating_4" name="star_rating" value="4" checked>
                                        <?php else : ?>
                                            <input type="radio" id="star_rating_4" name="star_rating" value="4">
                                        <?php endif; ?>
                                        <label for="star_rating_4"></label>
                                    </div>
                                    <div class="icheck-primary d-inline">
                                        <?php if ($hotel['star_rating'] == 5) : ?>
                                            <input type="radio" id="star_rating_5" name="star_rating" value="5" checked>
                                        <?php else : ?>
                                            <input type="radio" id="star_rating_5" name="star_rating" value="5">
                                        <?php endif; ?>
                                        <label for="star_rating_5">5</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="hotel_facilities">Facilities</label>
                                    <select class="select2bs4<?= ($validation->hasError('hotel_facilities')) ? ' is-invalid' : ''; ?>" multiple="multiple" id="hotel_facilities" name="hotel_facilities[]" data-placeholder="Select a facility" style="width: 100%;" required>
                                        <?php foreach ($facilities as $facility) : ?>
                                            <?php if (in_array($facility['facility_id'], $hotel_facility)) : ?>
                                                <option value="<?= $facility['facility_id']; ?>" selected><?= $facility['facility_name']; ?></option>
                                            <?php else : ?>
                                                <option value="<?= $facility['facility_id']; ?>"><?= $facility['facility_name']; ?></option>
                                            <?php endif; ?>
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
                                    <input type="text" class="form-control<?= ($validation->hasError('hotel_room_amount')) ? ' is-invalid' : ''; ?>" id="hotel_room_amount" name="hotel_room_amount" placeholder="Number of rooms" value="<?= $hotel['number_of_rooms']; ?>" required>
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
                                        <input type="text" class="form-control<?= ($validation->hasError('hotel_price_per_day')) ? ' is-invalid' : ''; ?>" id="hotel_price_per_day" name="hotel_price_per_day" placeholder="Price per day" value="<?= $hotel['price_per_day']; ?>" required>
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
                                    <input type="text" class="form-control<?= ($validation->hasError('hotel_address')) ? ' is-invalid' : ''; ?>" id="hotel_address" name="hotel_address" placeholder="Address" value="<?= $hotel['address']; ?>" required>
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
                                    <input type="text" class="form-control<?= ($validation->hasError('hotel_city')) ? ' is-invalid' : ''; ?>" id="hotel_city" name="hotel_city" placeholder="City" value="<?= $hotel['city']; ?>" required>
                                    <div class="invalid-feedback">
                                        <?= $validation->getError('hotel_city'); ?>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="hotel_province">Province</label>
                                    <input type="text" class="form-control<?= ($validation->hasError('hotel_province')) ? ' is-invalid' : ''; ?>" id="hotel_province" name="hotel_province" placeholder="Province" value="<?= $hotel['province']; ?>" required>
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
                                    <input type="text" class="form-control<?= ($validation->hasError('hotel_postal_code')) ? ' is-invalid' : ''; ?>" id="hotel_postal_code" name="hotel_postal_code" placeholder="Postal code" value="<?= $hotel['postal_code']; ?>" required>
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
                                    <textarea class="form-control<?= ($validation->hasError('hotel_description')) ? ' is-invalid' : ''; ?>" rows="5" id="hotel_description" name="hotel_description" placeholder="Description" required><?= $hotel['description']; ?></textarea>
                                    <div class="invalid-feedback">
                                        <?= $validation->getError('hotel_description'); ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-2">
                                <img src="/assets/img/hotels/<?= $hotel['image']; ?>" class="img-thumbnail img-preview">
                            </div>
                            <div class="col-10">
                                <div class="form-group">
                                    <label for="hotel_image">Hotel Image</label>
                                    <div class="custom-file">
                                        <label class="custom-file-label" for="hotel_image"><?= $hotel['image']; ?></label>
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
                        <input type="hidden" name="hotel_id" value="<?= $hotel['id']; ?>">
                        <input type="hidden" name="old_hotel_image" value="<?= $hotel['image']; ?>">
                        <button type="submit" class="btn btn-primary float-right" name="submit">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </section>
</div>

<?= $this->endSection(); ?>