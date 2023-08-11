<?php
    $serverUrl = env('APP_URL');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="description" content="html 5 template">
    <meta name="author" content="">
    <title><?= $page->get('name') ?></title>
    <!-- FAVICON -->
    <link rel="shortcut icon" type="image/x-icon" href="favicon.ico">
    <link rel="stylesheet" href="/theme/sabbiancowebsite/assets/css/jquery-ui.css?<?php echo time(); ?>">
    <!-- GOOGLE FONTS -->
    <link href="https://fonts.googleapis.com/css?family=Lato:300,300i,400,400i%7CMontserrat:600,800" rel="stylesheet">
    <!-- FONT AWESOME -->
    <link rel="stylesheet" href="/theme/sabbiancowebsite/assets/font/flaticon.css">
    <link rel="stylesheet" href="/theme/sabbiancowebsite/assets/css/fontawesome-all.min.css">
    <link rel="stylesheet" href="/theme/sabbiancowebsite/assets/css/fontawesome-5-all.min.css">
    <link rel="stylesheet" href="/theme/sabbiancowebsite/assets/css/font-awesome.min.css">
    


    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-beta/css/bootstrap.min.css">
    
    <!-- LEAFLET MAP -->
    <link rel="stylesheet" href="/theme/sabbiancowebsite/assets/css/leaflet.css">
    <link rel="stylesheet" href="/theme/sabbiancowebsite/assets/css/leaflet-gesture-handling.min.css">
    <link rel="stylesheet" href="/theme/sabbiancowebsite/assets/css/leaflet.markercluster.css">
    <link rel="stylesheet" href="/theme/sabbiancowebsite/assets/css/leaflet.markercluster.default.css">
    <link href="https://cdn.jsdelivr.net/leaflet.esri.geocoder/2.1.0/esri-leaflet-geocoder.css" rel="stylesheet">
    <!-- ARCHIVES CSS -->
    <link rel="stylesheet" href="/theme/sabbiancowebsite/assets/css/search.css">
    <link rel="stylesheet" href="/theme/sabbiancowebsite/assets/css/animate.css">
    <link rel="stylesheet" href="/theme/sabbiancowebsite/assets/css/aos.css">
    <link rel="stylesheet" href="/theme/sabbiancowebsite/assets/css/aos2.css">
    <link rel="stylesheet" href="/theme/sabbiancowebsite/assets/css/magnific-popup.css">
    <link rel="stylesheet" href="/theme/sabbiancowebsite/assets/css/lightcase.css">
    <link rel="stylesheet" href="/theme/sabbiancowebsite/assets/css/owl.carousel.min.css">
    <link rel="stylesheet" href="/theme/sabbiancowebsite/assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="/theme/sabbiancowebsite/assets/css/menu.css?<?php echo time(); ?>?1">
    <link rel="stylesheet" href="/theme/sabbiancowebsite/assets/css/slick.css">
    <link rel="stylesheet" href="/theme/sabbiancowebsite/assets/css/styles.css?<?php echo time(); ?>">
    <link rel="stylesheet" href="/theme/sabbiancowebsite/assets/css/style.css?<?php echo time(); ?>">
    <link rel="stylesheet" href="/theme/sabbiancowebsite/assets/css/maps.css?<?php echo time(); ?>">
    <link rel="stylesheet" id="color" href="/theme/sabbiancowebsite/assets/css/colors/pink.css?<?php echo time(); ?>">
    
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.11.2/jquery-ui.min.js"></script>
    <script src="/theme/sabbiancowebsite/assets/js/jquery-3.5.1.min.js"></script>
    <script src="/theme/sabbiancowebsite/assets/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/signature_pad/1.3.5/signature_pad.min.js" integrity="sha512-kw/nRM/BMR2XGArXnOoxKOO5VBHLdITAW00aG8qK4zBzcLVZ4nzg7/oYCaoiwc8U9zrnsO9UHqpyljJ8+iqYiQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</head>
<body style="overflow-x: hidden;">
    <div id="wrapper">
        <?= $body ?>
    </div>
    <input type="hidden" id="server_url" value="<?php echo $serverUrl; ?>">


    
    <script src="/theme/sabbiancowebsite/assets/js/rangeSlider.js"></script>
    <script src="/theme/sabbiancowebsite/assets/js/tether.min.js"></script>
    <script src="/theme/sabbiancowebsite/assets/js/moment.js"></script>
    
    <script src="/theme/sabbiancowebsite/assets/js/mmenu.min.js"></script>
    <script src="/theme/sabbiancowebsite/assets/js/mmenu.js"></script>
    <script src="/theme/sabbiancowebsite/assets/js/aos.js"></script>
    <script src="/theme/sabbiancowebsite/assets/js/aos2.js"></script>
    <script src="/theme/sabbiancowebsite/assets/js/animate.js"></script>
    <script src="/theme/sabbiancowebsite/assets/js/slick.min.js"></script>
    <script src="/theme/sabbiancowebsite/assets/js/fitvids.js"></script>
    <script src="/theme/sabbiancowebsite/assets/js/jquery.waypoints.min.js"></script>
    <script src="/theme/sabbiancowebsite/assets/js/typed.min.js"></script>
    <script src="/theme/sabbiancowebsite/assets/js/jquery.counterup.min.js"></script>
    <script src="/theme/sabbiancowebsite/assets/js/imagesloaded.pkgd.min.js"></script>
    <script src="/theme/sabbiancowebsite/assets/js/isotope.pkgd.min.js"></script>
    <script src="/theme/sabbiancowebsite/assets/js/smooth-scroll.min.js"></script>
    <script src="/theme/sabbiancowebsite/assets/js/lightcase.js"></script>
    <script src="/theme/sabbiancowebsite/assets/js/search.js"></script>
    <script src="/theme/sabbiancowebsite/assets/js/owl.carousel.js"></script>
    <script src="/theme/sabbiancowebsite/assets/js/jquery.magnific-popup.min.js"></script>
    <script src="/theme/sabbiancowebsite/assets/js/ajaxchimp.min.js"></script>
    <script src="/theme/sabbiancowebsite/assets/js/newsletter.js"></script>
    <script src="/theme/sabbiancowebsite/assets/js/jquery.form.js"></script>
    <script src="/theme/sabbiancowebsite/assets/js/jquery.validate.min.js"></script>
    <script src="/theme/sabbiancowebsite/assets/js/searched.js"></script>
    <script src="/theme/sabbiancowebsite/assets/js/forms-2.js"></script>
    <!-- <script src="/theme/sabbiancowebsite/assets/js/map-style2.js"></script> -->
    <script src="/theme/sabbiancowebsite/assets/js/range.js"></script>
    <script src="/theme/sabbiancowebsite/assets/js/color-switcher.js"></script>
    <script src="/theme/sabbiancowebsite/assets/js/dropzone.js"></script>
    
    <script>
        $(window).on('scroll load', function() {
            $("#header.cloned #logo img").attr("src", $('#header #logo img').attr('data-sticky-logo'));
        });

    </script>
    <script>
        var typed = new Typed('.typed', {
            strings: ["House ^2000", "Apartment ^2000", "Plaza ^4000"],
            smartBackspace: false,
            loop: true,
            showCursor: true,
            cursorChar: "|",
            typeSpeed: 50,
            backSpeed: 30,
            startDelay: 800
        });

    </script>
    <script>
        $('.slick-lancers').slick({
            infinite: false,
            slidesToShow: 4,
            slidesToScroll: 1,
            dots: true,
            arrows: false,
            adaptiveHeight: true,
            responsive: [{
                breakpoint: 1292,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 2,
                    dots: true,
                    arrows: false
                }
            }, {
                breakpoint: 993,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 2,
                    dots: true,
                    arrows: false
                }
            }, {
                breakpoint: 769,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1,
                    dots: true,
                    arrows: false
                }
            }]
        });

    </script>
    <script>
        $('.job_clientSlide').owlCarousel({
            items: 2,
            loop: true,
            margin: 30,
            autoplay: false,
            nav: true,
            smartSpeed: 1000,
            slideSpeed: 1000,
            navText: ["<i class='fa fa-chevron-left'></i>", "<i class='fa fa-chevron-right'></i>"],
            dots: false,
            responsive: {
                0: {
                    items: 1
                },
                991: {
                    items: 3
                }
            }
        });

    </script>
    <script>
        $('.style2').owlCarousel({
            loop: true,
            margin: 0,
            dots: false,
            autoWidth: false,
            autoplay: true,
            autoplayTimeout: 5000,
            responsive: {
                0: {
                    items: 2,
                    margin: 20
                },
                400: {
                    items: 2,
                    margin: 20
                },
                500: {
                    items: 3,
                    margin: 20
                },
                768: {
                    items: 4,
                    margin: 20
                },
                992: {
                    items: 5,
                    margin: 20
                },
                1000: {
                    items: 7,
                    margin: 20
                }
            }
        });

    </script>
    <script>
        $(".dropdown-filter").on('click', function() {
            $(".explore__form-checkbox-list").toggleClass("filter-block");
        });
    </script>

    <!-- MAIN JS -->
    <script src="/theme/sabbiancowebsite/assets/js/script.js"></script>

</body>

</html>
