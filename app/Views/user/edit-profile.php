<?= $this->extend('layouts/main/template'); ?>

<?= $this->section('main-content'); ?>

<?php if (session()->getFlashdata('sweet-alert-success')) : ?>
    <div class="flash-data" data-flashdata="<?= session()->getFlashdata('sweet-alert-success') ?>"></div>
<?php endif; ?>
<?php if (session()->getFlashdata('sweet-alert-error')) : ?>
    <div class="flash-data" data-flashdata="<?= session()->getFlashdata('sweet-alert-error') ?>"></div>
<?php endif; ?>

<div class="container my-5" data-aos="fade-up" data-aos-duration="1000">
    <h1 class="mb-3">Edit My Profile</h1>

    <form action="/user/editProfile" method="post" enctype="multipart/form-data">
        <?= csrf_field(); ?>
        <div class="row">
            <div class="form-group col-lg-6">
                <label for="full_name">Full Name</label>
                <input class="form-control form-control-lg<?= ($validation->hasError('full_name')) ? ' is-invalid' : ''; ?>" id="full_name" type="text" name="full_name" placeholder="Full name" value="<?= session()->get('full_name'); ?>" required autofocus>
                <div class="invalid-feedback">
                    <?= $validation->getError('full_name'); ?>
                </div>
            </div>
            <div class="form-group col-lg-6">
                <label for="email">Email Address</label>
                <input class="form-control form-control-lg" id="email" type="email" name="email" placeholder="Email" value="<?= session()->get('email'); ?>" required disabled>
            </div>
        </div>
        <div class="row">
            <div class="form-group col-lg-6">
                <label for="birth_date">Birth Date</label>
                <input class="datetimepicker-input form-control form-control-lg<?= ($validation->hasError('birth_date')) ? ' is-invalid' : ''; ?>" id="birth_date" type="text" name="birth_date" placeholder="Birth date" data-datepicker data-toggle="datetimepicker" value="<?= session()->get('birth_date'); ?>" required>
                <div class="invalid-feedback">
                    <?= $validation->getError('birth_date'); ?>
                </div>
            </div>
            <div class="form-group col-lg-6">
                <label for="phone_number">Phone Number</label>
                <input class="form-control form-control-lg<?= ($validation->hasError('phone_number')) ? ' is-invalid' : ''; ?>" id="phone_number" type="text" name="phone_number" placeholder="Phone number" data-inputmask="'mask': '+62 999 9999 9999'" data-mask value="<?= session()->get('phone_number'); ?>" required>
                <div class="invalid-feedback">
                    <?= $validation->getError('phone_number'); ?>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="form-group col-lg-12">
                <label for="gender">Gender</label>
                <select class="selectpicker show-tick" id="gender" name="gender" data-style="bs-select-form-control" data-title="Select gender" data-width="fit" required>
                    <?php if (session()->get('gender') === "Male") : ?>
                        <option value="M" selected>Male</option>
                        <option value="F">Female</option>
                    <?php else : ?>
                        <option value="M">Male</option>
                        <option value="F" selected>Female</option>
                    <?php endif; ?>
                </select>
                <div class="invalid-feedback">
                    <?= $validation->getError('gender'); ?>
                </div>
            </div>
        </div>
        <div class="row my-2">
            <div class="form-group col-lg-2">
                <img src="/assets/img/user-profile/<?= session()->get('avatar'); ?>" class="img-thumbnail img-preview" width="150">
            </div>
            <div class="form-group col-lg-10">
                <label for="user_avatar">User avatar</label>
                <input class="form-control form-control-lg-2<?= ($validation->hasError('user_avatar')) ? ' is-invalid' : ''; ?>" id="user_avatar" name="user_avatar" type="file" accept=".jpg,.jpeg,.png">
                <div class="invalid-feedback">
                    <?= $validation->getError('user_avatar'); ?>
                </div>
            </div>
        </div>
        <input type="hidden" name="old_user_avatar" value="<?= session()->get('avatar'); ?>">
        <input type="hidden" name="old_phone_number" value="<?= session()->get('phone_number'); ?>">
        <input type="hidden" name="uid" value="<?= session()->get('uid')?>">
        <button class="btn btn-primary btn-block" type="submit">Save</button>
    </form>
    <hr>
    <div class="text-center">
        <a href="/user/profile">
            <i class="fas fa-long-arrow-alt-left"></i>
            Back
        </a>
    </div>
</div>

<?= $this->endSection(); ?>