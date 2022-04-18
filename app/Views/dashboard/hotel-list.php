<?= $this->extend('layouts/dashboard/template'); ?>

<?= $this->section('dashboard-content'); ?>

<?php if (session()->getFlashdata('sweet-alert-success')) : ?>
    <div class="flash-data" data-flashdata="<?= session()->getFlashdata('sweet-alert-success') ?>"></div>
<?php endif; ?>
<?php if (session()->getFlashdata('sweet-alert-error')) : ?>
    <div class="flash-data" data-flashdata="<?= session()->getFlashdata('sweet-alert-error') ?>"></div>
<?php endif; ?>

<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <h1 class="m-0">View Hotel List</h1>
                </div>
            </div>
        </div>
    </div>

    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card card-primary shadow-sm">
                        <div class="card-header">
                            <h3 class="card-title">List of Hotel</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                            </div>
                        </div>
                        <div class="card-body">
                            <table id="hotel-list" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Hotel Name</th>
                                        <th>Star Rating</th>
                                        <th>Number of Rooms Available</th>
                                        <th>Price per day</th>
                                        <th>Address</th>
                                        <th>City</th>
                                        <th>Province</th>
                                        <th>Postal Code</th>
                                        <th>Description</th>
                                        <th>Action</th>
                                        <th>Image</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($hotel_list as $i => $hotel) : ?>
                                        <tr>
                                            <td><?= $i + 1; ?></td>
                                            <td><?= $hotel['name']; ?></td>
                                            <td><?= $hotel['star_rating']; ?></td>
                                            <td><?= $hotel['number_of_rooms']; ?></td>
                                            <td><?= $hotel['price_per_day']; ?></td>
                                            <td><?= $hotel['address']; ?></td>
                                            <td><?= $hotel['city']; ?></td>
                                            <td><?= $hotel['province']; ?></td>
                                            <td><?= $hotel['postal_code']; ?></td>
                                            <td><?= $hotel['description']; ?></td>
                                            <td>
                                                <div class="btn-group">
                                                    <button type="button" class="btn btn-info">Manage</button>
                                                    <button type="button" class="btn btn-info dropdown-toggle dropdown-hover dropdown-icon" data-toggle="dropdown">
                                                        <span class="sr-only">Toggle Dropdown</span>
                                                    </button>
                                                    <div class="dropdown-menu" role="menu">
                                                        <form action="/dashboard/hotels/edit" method="post" class="dropdown-item">
                                                            <?= csrf_field(); ?>
                                                            <input type="hidden" name="hotel_id" value="<?= $hotel['id']; ?>">
                                                            <button type="submit" class="btn btn-sm btn-warning btn-block"><i class="fas fa-edit"></i></button>
                                                        </form>
                                                        <form action="/dashboard/hotels/delete/<?= $hotel['id']; ?>" method="post" class="dropdown-item">
                                                            <?= csrf_field(); ?>
                                                            <input type="hidden" name="_method" value="DELETE">
                                                            <button type="submit" class="btn btn-sm btn-danger btn-block" onclick="return confirm('Are you sure?');"><i class="fas fa-trash"></i></button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <a href="/assets/img/hotels/<?= $hotel['image']; ?>" data-toggle="lightbox" data-title="Image - <?= $hotel['name']; ?>">
                                                    <img src="/assets/img/hotels/<?= $hotel['image']; ?>" class="img-fluid mb-2" alt="<?= $hotel['name']; ?>" width="250"/>
                                                </a>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>#</th>
                                        <th>Hotel Name</th>
                                        <th>Star Rating</th>
                                        <th>Number of Rooms Available</th>
                                        <th>Price per day</th>
                                        <th>Address</th>
                                        <th>City</th>
                                        <th>Province</th>
                                        <th>Postal Code</th>
                                        <th>Description</th>
                                        <th>Action</th>
                                        <th>Image</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection(); ?>