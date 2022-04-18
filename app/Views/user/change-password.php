<?= $this->extend('layouts/main/template'); ?>

<?= $this->section('main-content'); ?>

<?php if (session()->getFlashdata('sweet-alert-success')) : ?>
    <div class="flash-data" data-flashdata="<?= session()->getFlashdata('sweet-alert-success') ?>"></div>
<?php endif; ?>
<?php if (session()->getFlashdata('sweet-alert-error')) : ?>
    <div class="flash-data" data-flashdata="<?= session()->getFlashdata('sweet-alert-error') ?>"></div>
<?php endif; ?>

<div class="container my-5" data-aos="fade-up" data-aos-duration="1000">
    <h1 class="mb-3">Change Password</h1>

    <?php if (session()->getFlashdata('alert_error')) : ?>
        <div class="alert alert-danger text-center">
            <?= session()->getFlashdata('alert_error'); ?>
        </div>
    <?php endif; ?>
    <?php if (session()->getFlashdata('alert_success')) : ?>
        <div class="alert alert-success text-center">
            <?= session()->getFlashdata('alert_success'); ?>
        </div>
    <?php endif; ?>

    <form action="/user/changePassword" method="post">
        <?= csrf_field(); ?>
        <div class="row">
            <div class="form-group col">
                <label for="old_password">Old Password</label>
                <input class="form-control form-control-lg<?= ($validation->hasError('old_password')) ? ' is-invalid' : ''; ?>" id="old_password" type="password" name="old_password" placeholder="Old password" required autofocus>
                <div class="invalid-feedback">
                    <?= $validation->getError('old_password'); ?>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="form-group col">
                <label for="new_password">New Password</label>
                <input class="form-control form-control-lg<?= ($validation->hasError('new_password')) ? ' is-invalid' : ''; ?>" id="new_password" type="password" name="new_password" placeholder="New password" required>
                <div class="invalid-feedback">
                    <?= $validation->getError('new_password'); ?>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="form-group col">
                <label for="confirm_new_password">Confirm New Password</label>
                <input class="form-control form-control-lg<?= ($validation->hasError('confirm_new_password')) ? ' is-invalid' : ''; ?>" id="confirm_new_password" type="password" name="confirm_new_password" placeholder="Confirm new password" required>
                <div class="invalid-feedback">
                    <?= $validation->getError('confirm_new_password'); ?>
                </div>
            </div>
        </div>
        <input type="hidden" name="uid" value="<?= session()->get('uid')?>">
        <button class="btn btn-primary btn-block" type="submit">Change Password</button>
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