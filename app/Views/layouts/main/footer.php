<footer style="background: #111;">
    <div class="container py-4">
        <div class="row py-5 m-auto text-center">
            <div class="col-md-4 col-sm-12 mb-3 mb-md-0">
                <div class="d-flex align-items-center justify-content-center mb-3"><img src="/assets/img/uhotel2.png" alt="" width="70" style="margin: -18px;"><span class="text-uppercase text-small font-weight-bold text-white ml-2">U-Hotel</span></div>
                <p class="text-muted text-small font-weight-light mb-3">Jl. Scientia Boulevard, Gading, Kec. Serpong, Tangerang, Banten 15227.</p>
                <ul class="list-inline mb-0 text-white">
                    <li class="list-inline-item"><a class="reset-anchor text-small" href="#"><i class="fab fa-facebook-f"></i></a></li>
                    <li class="list-inline-item"><a class="reset-anchor text-small" href="#"><i class="fab fa-github"></i></a></li>
                    <li class="list-inline-item"><a class="reset-anchor text-small" href="#"><i class="fab fa-instagram"></i></a></li>
                    <li class="list-inline-item"><a class="reset-anchor text-small" href="#"><i class="fab fa-linkedin"></i></a></li>
                </ul>
            </div>
        <div class="col-md-4 col-sm-6 mb-3 mb-md-0">
                <h6 class="pt-2 text-white">Useful links</h6>
                <div class="d-flex flex-wrap justify-content-center">
                    <ul class="list-unstyled text-muted mb-0 mb-3 mr-4">
                        <li><a class="reset-anchor text-small" href="/hotels">Hotels</a></li>
                        <li><a class="reset-anchor text-small" href="/user/profile">User Profile</a></li>
                        <li><a class="reset-anchor text-small" href="/about">About us</a></li>
                    </ul>
                    <ul class="list-unstyled text-muted mb-0">
                        <li><a class="reset-anchor text-small" href="/auth/login">Login</a></li>
                        <li><a class="reset-anchor text-small" href="/auth/register">Register</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-md-4 col-sm-6 mb-3 mb-md-0">
                <h6 class="pt-2 text-white">Info</h6>
                <p class="text-muted">Website ini merupakan website yang dibuat untuk memenuhi ujian akhir mata kuliah Pemrograman Web.</p>
            </div>
        </div>
    </div>
    <div class="copyrights py-4" style="background: #0e0e0e">
        <div class="container">
            <div class="row text-center">
                <div class="col-md-6 text-lg-left mb-2 mb-md-0">
                    <p class="mb-0 text-muted mb-0 text-small">&copy; 2021 &bull; U-Hotel &bull; All rights reserved.</p>
                </div>
                <div class="col-md-6 col-sm-6 text-md-right">
                    <p class="mb-0 text-muted mb-0 text-small">Template designed by <a class="reset-anchor text-primary" href="https://bootstraptemple.com/p/listings">Bootstrap Temple</a>.</p>
                    <!-- If you want to remove the backlink, please purchase the Attribution-Free License.-->
                </div>
            </div>
        </div>
    </div>
</footer>
<!-- JavaScript files-->
<script src="/assets/vendors/jquery/jquery.min.js"></script>
<script src="/assets/vendors/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="/assets/vendors/owl.carousel2/owl.carousel.min.js"></script>
<script src="/assets/vendors/owl.carousel2.thumbs/owl.carousel2.thumbs.min.js"></script>
<script src="/assets/vendors/bootstrap-select/js/bootstrap-select.min.js"></script>
<script src="/assets/vendors/lightbox2/js/lightbox.min.js"></script>
<script src="/assets/js/bootstrap-filestyle.min.js"></script>
<!-- Moment.js -->
<script src="/assets/vendors/moment/moment.min.js"></script>
<!-- AOS -->
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<!-- SweetAlert2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.16/dist/sweetalert2.min.js"></script>
<?php if (session()->getFlashdata('sweet-alert-success')) : ?>
    <script>
        const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 5000,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer)
                toast.addEventListener('mouseleave', Swal.resumeTimer)
            }
        })

        const flashData = $('.flash-data').data('flashdata');

        if (flashData) {
            Toast.fire({
                icon: 'success',
                title: '<?= session()->getFlashdata('sweet-alert-success'); ?>'
            });
        }
    </script>
<?php endif; ?>
<?php if (session()->getFlashdata('sweet-alert-error')) : ?>
    <script>
        const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 5000,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer)
                toast.addEventListener('mouseleave', Swal.resumeTimer)
            }
        })

        const flashData = $('.flash-data').data('flashdata');

        if (flashData) {
            Toast.fire({
                icon: 'error',
                title: '<?= session()->getFlashdata('sweet-alert-error'); ?>'
            });
        }
    </script>
<?php endif; ?>
<!-- Tempusdominus Bootstrap 4 -->
<script src="/assets/vendors/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- bs-custom-file-input -->
<script src="/assets/vendors/bs-custom-file-input/bs-custom-file-input.min.js"></script>
<!-- InputMask -->
<script src="/assets/vendors/inputmask/jquery.inputmask.min.js"></script>
<script src="/assets/js/front.js"></script>
<script>
    // ------------------------------------------------------- //
    //   Inject SVG Sprite -
    //   see more here
    //   https://css-tricks.com/ajaxing-svg-sprite/
    // ------------------------------------------------------ //
    function injectSvgSprite(path) {

        var ajax = new XMLHttpRequest();
        ajax.open("GET", path, true);
        ajax.send();
        ajax.onload = function(e) {
            var div = document.createElement("div");
            div.className = 'd-none';
            div.innerHTML = ajax.responseText;
            document.body.insertBefore(div, document.body.childNodes[0]);
        }
    }
    // this is set to BootstrapTemple website as you cannot
    // inject local SVG sprite (using only 'icons/orion-svg-sprite.svg' path)
    // while using file:// protocol
    // pls don't forget to change to your domain :)
    injectSvgSprite('/assets/icons/orion-svg-sprite.svg');

    AOS.init();

    $(document).ready(function() {
        $(".preloader").fadeOut('slow');
    });
</script>
<!-- FontAwesome CSS - loading as last, so it doesn't block rendering-->
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
<!-- Custom Script -->
<?php
    if (!empty($custom_js)) {
        foreach($custom_js as $js) {
            echo $js;
        }
    }
?>
</body>

</html>