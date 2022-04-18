<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?= $title; ?></title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="all,follow">
    <!-- Bootstrap CSS-->
    <link rel="stylesheet" href="/assets/vendors/bootstrap/css/bootstrap.min.css">
    <!-- Google fonts-->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Work+Sans:300,400,700&amp;display=swap">
    <!-- Owl carousel2-->
    <link rel="stylesheet" href="/assets/vendors/owl.carousel2/assets/owl.carousel.min.css">
    <link rel="stylesheet" href="/assets/vendors/owl.carousel2/assets/owl.theme.default.min.css">
    <!-- Bootstrap Select-->
    <link rel="stylesheet" href="/assets/vendors/bootstrap-select/css/bootstrap-select.min.css">
    <!-- Lightbox-->
    <link rel="stylesheet" href="/assets/vendors/lightbox2/css/lightbox.min.css">
    <!-- AOS -->
    <link rel="stylesheet" href="https://unpkg.com/aos@2.3.1/dist/aos.css">
    <!-- SweetAlert2 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.16/dist/sweetalert2.min.css">
    <!-- Tempusdominus Bootstrap 4 -->
    <link rel="stylesheet" href="/assets/vendors/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
    <!-- theme stylesheet-->
    <link rel="stylesheet" href="/assets/css/style.default.css" id="theme-stylesheet">
    <!-- Custom stylesheet - for your changes-->
    <link rel="stylesheet" href="/assets/css/custom.css">
    <!-- Tweaks for older IEs-->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script><![endif]-->
    <!-- Google reCAPTCHA -->
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <!-- Custom CSS -->
    <?php
    if (!empty($custom_css)) {
        foreach ($custom_css as $css) {
            echo $css;
        }
    }
    ?>
</head>

<body>
    <div class="preloader">
        <div class="loading">
            <img src="/assets/img/uhotel2.png" width="150">
        </div>
    </div> 
    <!-- navbar-->
    <header class="header">
        <nav class="navbar navbar-expand-lg navbar-light bg-white py-3 py-lg-2">
            <div class="container"><a class="navbar-brand py-3 d-flex align-items-center" href="/"><img src="/assets/img/uhotel1.png" alt="" width="70" style="margin: -18px;"><span class="text-uppercase text-small font-weight-bold text-dark mb-0 ml-2">U-Hotel</span></a>
                <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item mr-1">
                            <a class="nav-link" href="/">Home</a>
                        </li>
                        <li class="nav-item mr-1">
                            <a class="nav-link" href="/hotels">Hotels</a>
                        </li>
                        <li class="nav-item mr-2">
                            <a class="nav-link" href="/about">About Us</a>
                        </li>
                        <li class="nav-item ml-lg-2 py-2 py-lg-0">
                            <?php switch (session()->get('role_id')):
                                case 'R0001': ?>
                                    <div class="btn-group" role="group">
                                        <a id="btnGroupDrop1" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            Hello, <?= session()->get('nickname'); ?>
                                        </a>
                                        <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                                            <a class="dropdown-item" href="/dashboard">Dashboard</a>
                                            <a class="dropdown-item" href="/auth/logout">Logout</a>
                                        </div>
                                    </div>
                                    <?php break; ?>
                                <?php
                                case 'R0002': ?>
                                    <div class="btn-group" role="group">
                                        <a id="btnGroupDrop1" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            Hello, <?= session()->get('nickname'); ?>
                                        </a>
                                        <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                                            <a class="dropdown-item" href="/user/profile">My Account</a>
                                            <a class="dropdown-item" href="/auth/logout">Logout</a>
                                        </div>
                                    </div>
                                    <?php break; ?>
                                <?php
                                default: ?>
                                    <div class="btn-group" role="group">
                                        <a class="btn btn-primary" href="/auth/login">Login</a>
                                    </div>
                                    <?php break; ?>
                            <?php endswitch; ?>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>