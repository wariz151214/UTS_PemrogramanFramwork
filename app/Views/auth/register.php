<?= $this->extend('layouts/main/template'); ?>

<?= $this->section('main-content'); ?>

<?php if (session()->getFlashdata('sweet-alert-success')) : ?>
    <div class="flash-data" data-flashdata="<?= session()->getFlashdata('sweet-alert-success') ?>"></div>
<?php endif; ?>
<?php if (session()->getFlashdata('sweet-alert-error')) : ?>
    <div class="flash-data" data-flashdata="<?= session()->getFlashdata('sweet-alert-error') ?>"></div>
<?php endif; ?>

<div class="container my-5" data-aos="fade-up" data-aos-duration="1000">
    <h1 class="mb-3">Register</h1>

    <form action="/auth/newUser" method="post" enctype="multipart/form-data">
        <?= csrf_field(); ?>
        <div class="row">
            <div class="form-group col-lg-6">
                <label for="full_name">Full Name</label>
                <input class="form-control form-control-lg<?= ($validation->hasError('full_name')) ? ' is-invalid' : ''; ?>" id="full_name" type="text" name="full_name" placeholder="Full name" required autofocus>
                <div class="invalid-feedback">
                    <?= $validation->getError('full_name'); ?>
                </div>
            </div>
            <div class="form-group col-lg-6">
                <label for="email">Email Address</label>
                <input class="form-control form-control-lg<?= ($validation->hasError('email')) ? ' is-invalid' : ''; ?>" id="email" type="email" name="email" placeholder="Email" required>
                <div class="invalid-feedback">
                    <?= $validation->getError('email'); ?>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="form-group col-lg-6">
                <label for="password">Password</label>
                <input class="form-control form-control-lg<?= ($validation->hasError('password')) ? ' is-invalid' : ''; ?>" id="password" type="password" name="password" placeholder="Password" required>
                <div class="invalid-feedback">
                    <?= $validation->getError('password'); ?>
                </div>
            </div>
            <div class="form-group col-lg-6">
                <label for="confirm_password">Confirm Password</label>
                <input class="form-control form-control-lg<?= ($validation->hasError('confirm_password')) ? ' is-invalid' : ''; ?>" id="confirm_password" type="password" name="confirm_password" placeholder="Confirm password" required>
                <div class="invalid-feedback">
                    <?= $validation->getError('confirm_password'); ?>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="form-group col-lg-6">
                <label for="birth_date">Birth Date</label>
                <input class="datetimepicker-input form-control form-control-lg<?= ($validation->hasError('birth_date')) ? ' is-invalid' : ''; ?>" id="birth_date" type="text" name="birth_date" placeholder="Birth date" data-datepicker data-toggle="datetimepicker" required>
                <div class="invalid-feedback">
                    <?= $validation->getError('birth_date'); ?>
                </div>
            </div>
            <div class="form-group col-lg-6">
                <label for="phone_number">Phone Number</label>
                <input class="form-control form-control-lg<?= ($validation->hasError('phone_number')) ? ' is-invalid' : ''; ?>" id="phone_number" type="text" name="phone_number" placeholder="Phone number" data-inputmask="'mask': '+62 999 9999 9999'" data-mask required>
                <div class="invalid-feedback">
                    <?= $validation->getError('phone_number'); ?>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="form-group col-lg-12">
                <label for="gender">Gender</label>
                <select class="selectpicker show-tick" id="gender" name="gender" data-style="bs-select-form-control" data-title="Select gender" data-width="fit" required>
                    <option value="M">Male</option>
                    <option value="F">Female</option>
                </select>
                <div class="invalid-feedback">
                    <?= $validation->getError('gender'); ?>
                </div>
            </div>
        </div>
        <div class="row my-2">
            <div class="form-group col-lg-2">
                <img src="/assets/img/user-profile/avatar-placeholder.png" class="img-thumbnail img-preview" width="150">
            </div>
            <div class="form-group col-lg-10">
                <label for="user_avatar">User Avatar</label>
                <input class="form-control form-control-lg-2<?= ($validation->hasError('user_avatar')) ? ' is-invalid' : ''; ?>" id="user_avatar" name="user_avatar" type="file" accept=".jpg,.jpeg,.png">
                <div class="invalid-feedback">
                    <?= $validation->getError('user_avatar'); ?>
                </div>
            </div>
        </div>
        <button class="btn btn-primary btn-block" type="submit">Register</button>
    </form>
    <hr>
    <div class="text-center">
        <p class="mb-1">
            Already have an account? <a href="/auth/login">Login</a>
        </p>
        <a href="/">
            <i class="fas fa-long-arrow-alt-left"></i>
            Back
        </a>
    </div>
</div>

<?= $this->endSection(); ?>