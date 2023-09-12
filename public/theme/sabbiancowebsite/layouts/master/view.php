<?php
 if(isset($_SESSION["user_id"])){
    $user_id = $_SESSION["user_id"];
 }else{
    $user_id = "";
 }
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
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.4.0/dist/leaflet.css">
    <link href="https://cdn.jsdelivr.net/leaflet.esri.geocoder/2.1.0/esri-leaflet-geocoder.css" rel="stylesheet">

    <!-- <link rel="stylesheet" href="/theme/sabbiancowebsite/assets/css/leaflet.css">
    <link rel="stylesheet" href="/theme/sabbiancowebsite/assets/css/leaflet-gesture-handling.min.css">
    <link rel="stylesheet" href="/theme/sabbiancowebsite/assets/css/leaflet.markercluster.css">
    <link rel="stylesheet" href="/theme/sabbiancowebsite/assets/css/leaflet.markercluster.default.css">
    <link href="https://cdn.jsdelivr.net/leaflet.esri.geocoder/2.1.0/esri-leaflet-geocoder.css" rel="stylesheet"> -->
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

    <!-- //map -->
    <script src="https://code.jquery.com/jquery-2.2.4.min.js"></script>
    <script src="https://unpkg.com/leaflet@1.4.0/dist/leaflet.js"></script>
    <script src="https://unpkg.com/esri-leaflet@2.2.3/dist/esri-leaflet.js"></script>
    <script src="https://cdn.jsdelivr.net/gh/Falke-Design/L.Donut@latest/src/L.Donut.js"></script>
    <script src="https://cdn.jsdelivr.net/leaflet.esri.geocoder/2.1.0/esri-leaflet-geocoder.js" crossorigin="anonymous"></script>

    <!-- <script src="https://code.jquery.com/jquery-2.2.4.min.js" ></script>
<script src="https://npmcdn.com/leaflet@0.7.7/dist/leaflet.js" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/leaflet/1.0.0-rc.1/leaflet-src.js" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/leaflet.esri/2.0.0/esri-leaflet.js" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/leaflet.esri.geocoder/2.1.0/esri-leaflet-geocoder.js" crossorigin="anonymous"></script> -->

    <style>
        .locationLi {
            position: static!important;
            .wrapper {
                position: absolute;
                z-index: 10;
                display: none;
            }
            &:hover > .wrapper {
                display: block;
            }
        }
        .locationLiLeft {
            position: static!important;
            .wrapper {
                position: absolute;
                z-index: 10;
                display: none;
            }
            &:hover > .wrapper {
                display: block;
            }
        }
    </style>
</head>
<body style="overflow-x: hidden;">
    <div id="wrapper">
        <?= $body ?>
    </div>
    <a data-toggle="modal" data-target=".ListingDetailModal" id="ListingDetailButton"></a>
    <div class="modal fade bs-modal-sm ListingDetailModal" style="z-index: 9999;" id="ListingDetailModal" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-sm modal-width" >
            <div class="modal-content" style="padding: 20px 5px 15px 5px;display: flex;align-items: center;justify-content: center;background: #f5f7fb;">
                    <div class="inner-pages sin-1 homepage-4 hd-white" style="width: 100%;height: 90vh;overflow: auto;">
                        <section class="single-proper blog details" style="padding: 43px 0px 10px 16px  !important;">
                            <div class="container">
                                <div class="row">
                                    <div class="col-lg-8 col-md-12 ">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <section class="headings-2 pt-0">
                                                    <div class="listing-title-bar">
                                                        <h3 id="listingName"></h3>
                                                        <div >
                                                            <h4 id="listingPrice"></h4>
                                                        </div>
                                                        <div class="mt-0" style="width: 95%; display: flex; justify-content: space-between;" id ="address_favorit">
                                                            
                                                        </div>
                                                    </div>
                                                </section>
                                                <!-- main slider carousel items -->
                                                <div id="listingDetailsSlider" class="carousel listing-details-sliders slide mb-30">
                                                    <h5 class="mb-4">Gallery</h5>
                                                    <div class="carousel-inner" id ="listingImg">
                                                    
                                                    </div>
                                                    <!-- main slider carousel nav controls -->
                                                    <ul class="carousel-indicators smail-listing list-inline" id ="listingULImg">
                                                        
                                                    </ul>
                                                    <!-- main slider carousel items -->
                                                </div>
                                                <div class="blog-info details mb-30">
                                                    <h5 class="mb-4">Description</h5>
                                                    <p class="mb-3" id="listingDescription"></p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="single homes-content details mb-30">
                                            <!-- title -->
                                            <h5 class="mb-4">Property Details</h5>
                                            <ul class="homes-list clearfix">
                                                <li style="display:none">
                                                    <span class="font-weight-bold mr-1">Property ID:</span>
                                                    <span class="det"></span>
                                                </li>
                                                <li id="ListingPropertyTypeDiv">
                                                    <span class="font-weight-bold mr-1">Property Type:</span>
                                                    <span class="det" id="ListingPropertyType"></span>
                                                </li>
                                                <li id="ListingPropertyStatusDiv" style="display:none">
                                                    <span class="font-weight-bold mr-1">Property status:</span>
                                                    <span class="det" id="ListingPropertyStatus"></span>
                                                </li>
                                                <li id="ListingPropertyPriceDiv">
                                                    <span class="font-weight-bold mr-1">Property Price:</span>
                                                    <span class="det" id="ListingPropertyPrice"></span>
                                                </li>
                                                <li id="ListingAreaDiv">
                                                    <span class="font-weight-bold mr-1">Area:</span>
                                                    <span class="det" id="ListingArea"></span>
                                                </li>
                                                <li id="ListingBedroomsDiv">
                                                    <span class="font-weight-bold mr-1">Bedrooms:</span>
                                                    <span class="det" id="ListingBedrooms"></span>
                                                </li>
                                                <li id="ListingBathDiv">
                                                    <span class="font-weight-bold mr-1">Bath:</span>
                                                    <span class="det" id="ListingBath"></span>
                                                </li>
                                                <li id="ListingGaragesDiv">
                                                    <span class="font-weight-bold mr-1">Garages:</span>
                                                    <span class="det" id="ListingGarages"></span>
                                                </li>
                                                <li id="ListingYearBuiltDiv">
                                                    <span class="font-weight-bold mr-1">Year Built:</span>
                                                    <span class="det" id="ListingYearBuilt"></span>
                                                </li>
                                            </ul>
                                            <!-- title -->
                                            <h5 class="mt-5">Amenities</h5>
                                            <!-- cars List -->
                                            <ul class="homes-list clearfix" id="amenities">
                                            </ul>
                                        </div>
                                        <div class="floor-plan property wprt-image-video w50 pro" id="floorPlansDiv">
                                            <h5>Floor Plans</h5>
                                            <img alt="image" id="floorPlans" src="">
                                        </div>
                                        <div class="property-location map" style="height: 350px;">
                                            <h5>Location</h5>
                                            <div class="divider-fade"></div>
                                            <div id="map-leaflet-listingsDetail" class="contact-map" style="height: 255px; "></div>
                                        </div>
                                    </div>
                                    <aside class="col-lg-4 col-md-12 car">
                                        <div class="single widget">
                                            <div class="sidebar">
                                                <div class="widget-boxed mt-33 mt-5">
                                                    <div class="widget-boxed-body">
                                                        <div class="sidebar-widget author-widget2">
                                                            <div class="alert-box success" id="addRequest_success">Submit Ok !!!</div>
                                                            <div class="alert-box failure" id="addRequest_failure">fail!!!</div>
                                                            <div class="agent-contact-form-sidebar">
                                                                <h4>Request Inquiry</h4>
                                                                <form name="contact_form">
                                                                    <input type="text" id="inquiry_fname" name="full_name" placeholder="Full Name" required />
                                                                    <input type="number" id="inquiry_pnumber" name="phone_number" placeholder="Phone Number" required />
                                                                    <input type="email" id="inquiry_emailid" name="email_address" placeholder="Email Address" required />
                                                                    <textarea placeholder="Message" id="inquiry_message" name="inquiry_message" required></textarea>
                                                                    <input type="hidden" id="property_type_id"/>
                                                                    <input type="button" id="sendMessageListingsDetailModal" name="sendmessage" class="multiple-send-message" value="Submit Request" />
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </aside>
                                </div>
                            </div>
                        </section>
                    </div>
            </div>
        </div>
    </div>
    <a href="#signup"  data-toggle="modal" data-target=".log-sign" id="loginModal"></a>
    <div class="modal fade bs-modal-sm log-sign" style="z-index:9999" id="myModal" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-sm" style="margin-top: 200px;">
            <div class="modal-content" style="max-width:100%;width: 500px;">
                <div>
                    <div class="bs-example bs-example-tabs">
                        <ul id="myTab" class="nav nav-tabs">
                            <li id="loginModalTab1" style="padding: 10px;" class=" tab-style login-shadow "><a href="#signin" id="loginModalTabButton" data-toggle="tab">Log In</a></li>
                            <li id="loginModalTab2" style="padding: 10px;" class=" tab-style "><a href="#signup"  id="signupModalTabButton" data-toggle="tab">Sign Up</a></li>
                        </ul>
                    </div>
                    <div class="modal-body">
                        <div id="myTabContent" class="tab-content" style="margin-left: 20px; margin-right: 20px;">
                        <div class="alert-box success" id="login_success">Login Ok !!!</div>
                        <div class="alert-box failure" id="login_failure">fail!!!</div>
                        <div class="tab-pane fade active in" id="signin">
                            <!-- Sign In Form -->
                            <!-- Text input-->
                            <div class="group">
                                <label for="date">Email address</label></div>        
                                <input required="" id="login_email" class="loginModalInput" type="text"><span class="highlight"></span><span class="bar"></span>
                            <!-- Password input-->
                            <div class="group">
                                <label for="date">Password</label>
                                <input required="" id="login_password" class="loginModalInput" type="password"><span class="highlight"></span><span class="bar"></span>
                            </div>
                            <em>minimum 6 characters</em>

                        <div class="forgot-link">
                            <a href="#forgot" data-toggle="modal" data-target="#forgot-password"> I forgot my password</a>
                            </div>
                            <!-- Button -->
                            <div class="control-group">
                            <label class="control-label" for="signin"></label>
                            <div class="controls" id="loginButtonContent" style="display: flex;justify-content: space-around;">
                                <button onclick="modalLoginIn()" class="btn btn-primary btn-block">Log In</button>
                            </div>
                            </div>
                        </div>
                        
                        
                        <div class="tab-pane fade" id="signup">
                            <div class="alert-box success" id="signup_success">SignUp Ok !!!</div>
                            <div class="alert-box failure" id="signup_failure">fail!!!</div>
                            <!-- Sign Up Form -->
                            <!-- Text input-->
                            <div class="group">
                                <label for="date">First Name</label></div>
                                <input required="" id="SignFristName" class="loginModalInput" type="text"><span class="highlight"></span><span class="bar"></span>
                            <!-- Text input-->
                            <div class="group">
                                <label for="date">Surname</label></div>
                                <input required="" id="SignLastName" class="loginModalInput" type="text"><span class="highlight"></span><span class="bar"></span>
                            <!-- Password input-->
                            <div class="group">
                                <label for="date">Email</label></div>
                                <input required="" id="SignEmail" class="loginModalInput" type="text"><span class="highlight"></span><span class="bar"></span>
                            <!-- Text input-->
                            <div class="group">
                                <label for="date">Password</label></div>
                                <input required="" id="Signpassword1" class="loginModalInput" type="password"><span class="highlight"></span><span class="bar"></span>
                            <div class="group">
                                <label for="date">Confirm password</label></div>
                                <input required=""  id="Signpassword2" class="loginModalInput" type="password"><span class="highlight"></span><span class="bar"></span>
                            <em>1-8 Characters</em>
                            
                            <!-- Button -->
                            <div class="control-group">
                            <label class="control-label" for="confirmsignup"></label>
                            <div class="controls" id="signButtonContent" style="display: flex;justify-content: space-around;">
                                <button onclick="modalSignUp()" class="btn btn-primary btn-block">Sign Up</button>
                            </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
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
    <script src="/theme/sabbiancowebsite/assets/js/owl.carousel.js"></script>
    <script src="/theme/sabbiancowebsite/assets/js/jquery.magnific-popup.min.js"></script>
    <script src="/theme/sabbiancowebsite/assets/js/ajaxchimp.min.js"></script>
    <script src="/theme/sabbiancowebsite/assets/js/newsletter.js"></script>
    <script src="/theme/sabbiancowebsite/assets/js/jquery.form.js"></script>
    <script src="/theme/sabbiancowebsite/assets/js/jquery.validate.min.js"></script>
    <script src="/theme/sabbiancowebsite/assets/js/searched.js"></script>
    <script src="/theme/sabbiancowebsite/assets/js/forms-2.js"></script>
    <script src="/theme/sabbiancowebsite/assets/js/range.js"></script>
    <script src="/theme/sabbiancowebsite/assets/js/color-switcher.js"></script>
    <script src="/theme/sabbiancowebsite/assets/js/dropzone.js"></script>
    
    <script>
        $(window).on('scroll load', function() {
            $("#header.cloned #logo img").attr("src", $('#header #logo img').attr('data-sticky-logo'));
        });
    </script>
    <script>
        // var typed = new Typed('.typed', {
        //     strings: ["House ^2000", "Apartment ^2000", "Plaza ^4000"],
        //     smartBackspace: false,
        //     loop: true,
        //     showCursor: true,
        //     cursorChar: "|",
        //     typeSpeed: 50,
        //     backSpeed: 30,
        //     startDelay: 800
        // });

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

    <script>
        $(function() {
            // whenever we hover over a menu item that has a submenu
            $('.locationLi').on('mouseover', function() {
                var $menuItem = $(this),
                $submenuWrapper = $('> .wrapper', $menuItem);
            
                // grab the menu item's position relative to its positioned parent
                var menuItemPos = $menuItem.position();
                
                // place the submenu in the correct position relevant to the menu item
                $submenuWrapper.css({
                    top: menuItemPos.top,
                    left: menuItemPos.left + Math.round($menuItem.outerWidth())
                });
            });
            $('.locationLiLeft').on('mouseover', function() {
                var $menuItem = $(this),
                $submenuWrapper = $('> .wrapper', $menuItem);
            
                // grab the menu item's position relative to its positioned parent
                var menuItemPos = $menuItem.position();
                
                // place the submenu in the correct position relevant to the menu item
                $submenuWrapper.css({
                    top: menuItemPos.top,
                    left: menuItemPos.left - Math.round($menuItem.outerWidth())
                });
            });
        });
    </script>
    <!-- MAIN JS -->
    <script src="/theme/sabbiancowebsite/assets/js/script.js"></script>
    
    <!-- ListingDetailModal -->
    <script>
        var mapListingsDetail = null;
        function showListigDetailModal(index){
            document.getElementById("ListingDetailButton").click();
            loadListingsDetailModal(index);
        }
        function loadListingsDetailModal(index){

            const url = "/api/activelistings";
            customer_id = '<?php echo $user_id; ?>';
                    
            let xhr = new XMLHttpRequest();
            sendData = {
                "id": index,
                "customer_id": customer_id,
                "retrieve_markers": 1
            }
            xhr.open('POST', url, true);
            xhr.setRequestHeader('Content-type', 'application/json');
            xhr.send(JSON.stringify(sendData));
            xhr.onload = function () {

                list = JSON.parse(xhr.response);
                list = list.items;
                data = list.data[0];
                if(data.floor_plans.length == 0){
                    document.getElementById("floorPlansDiv").style.display="none";
                }else{
                    document.getElementById("floorPlans").src=""+data.floor_plans[0].image;
                }
                if(data.notes == null){
                    // document.getElementById("video").style.display="none";
                }
                favorite = '';
                if(data.in_favoriteproperties == 1){
                    favorite = "color: red;";
                }
                document.getElementById("listingName").innerHTML = data.displayname + `<span class="mrg-l-5 category-tag">`+data.property_type+`</span>`;
                document.getElementById("listingPrice").innerHTML = `€` + data.price;
                document.getElementById("address_favorit").innerHTML = `<a href="#listing-location" class="listing-address">
                        <i class="fa fa-map-marker pr-2 ti-location-pin mrg-r-5"></i>`+data.location_name+`
                    </a>
                    <a style="cursor: pointer;" onclick="addFavoritListingsDetailModal(`+data.id+`)">
                        <i id="faHeartListingDetailModal`+data.id+`" class="fa fa-heart" style="font-size: x-large; `+favorite+`"></i>
                    </a>`;
                document.getElementById("listingDescription").innerHTML = data.displaydescription;
                if(data.year_built !== null){
                    document.getElementById("ListingYearBuilt").innerHTML = data.year_built;
                }else{
                    document.getElementById("ListingYearBuiltDiv").style.display = "none";
                }
                if(data.number_of_garages_or_parkingpaces !== null){
                    document.getElementById("ListingGarages").innerHTML = data.number_of_garages_or_parkingpaces;
                }else{
                    document.getElementById("ListingGaragesDiv").style.display = "none";
                }
                if(data.number_of_bathrooms !== null){
                    document.getElementById("ListingBath").innerHTML = data.number_of_bathrooms;
                }else{
                    document.getElementById("ListingBathDiv").style.display = "none";
                }
                if(data.number_of_bedrooms !== null){
                    document.getElementById("ListingBedrooms").innerHTML = data.number_of_bedrooms;
                }else{
                    document.getElementById("ListingBedroomsDiv").style.display = "none";
                }
                if(data.area_size !== null){
                    document.getElementById("ListingArea").innerHTML = data.area_size + "sqm";
                }else{
                    document.getElementById("ListingAreaDiv").style.display = "none";
                }
                if(data.property_type !== null){
                    document.getElementById("ListingPropertyType").innerHTML = data.property_type;
                }else{
                    document.getElementById("ListingPropertyTypeDiv").style.display = "none";
                }
                if(data.price !== null){
                    document.getElementById("ListingPropertyPrice").innerHTML = `€‎` + data.price;
                }else{
                    document.getElementById("ListingPropertyPriceDiv").style.display = "none";
                }
                document.getElementById("property_type_id").value = data.property_type_id;
                var temp ="";
                for(i=0;i<data.features.length;i++){
                temp += `<li class="Amenities-width">
                            <input type="checkbox" checked><span>`+data.features[i]+`</span>
                        </li>`;
                }
                document.getElementById("amenities").innerHTML = temp;
                // var temp ="";amenities
                // document.getElementById("activefeaturesRight").innerHTML = temp;
                temp = `<div class="carousel-inner" id ="listingImg" style="text-align: center;">
                    <div class="active item carousel-item" data-slide-number="0">
                        <img src="`+data.image+`" class="img-fluid" alt="slider-listing">
                    </div>`;
                for(i=1;i<=data.images.length;i++){
                    temp += `<div class="item carousel-item" data-slide-number="`+i+`">
                        <img src="`+data.images[i-1]+`" class="img-fluid" alt="slider-listing">
                    </div>`;
                }
                temp += `<a class="carousel-control left" href="#listingDetailsSlider" data-slide="prev"><i class="fa fa-angle-left"></i></a>
                <a class="carousel-control right" href="#listingDetailsSlider" data-slide="next"><i class="fa fa-angle-right"></i></a>`;
                document.getElementById("listingImg").innerHTML = temp;
                temp = `<li class="list-inline-item active">
                        <a id="carousel-selector-0" class="selected" data-slide-to="0" data-target="#listingDetailsSlider">
                            <img src="`+data.image+`" class="img-fluid" alt="listing-small">
                        </a>
                    </li>`;
                    for(i=1;i<=data.images.length;i++){
                    temp += `<li class="list-inline-item active">
                        <a id="carousel-selector-0" class="selected" data-slide-to="`+i+`" data-target="#listingDetailsSlider">
                            <img src="`+data.images[i-1]+`" class="img-fluid" alt="listing-small">
                        </a>
                    </li>`;
                    }
                document.getElementById("listingULImg").innerHTML = temp;
                document.getElementById("sendMessageListingsDetailModal").setAttribute( "onClick", "sendRequestListingsDetailModal("+data.id+");" );
                markers = JSON.parse(xhr.response).listing_markers;
                
                var valueArray = [];
                if(markers[0].center[0]>0){
                    valueArray.push(markers[0]);
                }
                map_init_listingDetail(valueArray);
            }
        }
        function map_init_listingDetail(valueArray){
            if (mapListingsDetail !== undefined && mapListingsDetail !== null) {
                mapListingsDetail.remove(); // should remove the map from UI and clean the inner children of DOM element
            }
            mapListingsDetail = L.map('map-leaflet-listingsDetail').setView(valueArray[0].center, 9);
            L.tileLayer('http://{s}.tile.osm.org/{z}/{x}/{y}.png').addTo(mapListingsDetail);
            for(i=0;i<valueArray.length;i++){//valueArray.forEach((value) => {
                value = valueArray[i];
                var icon = L.divIcon({
                    html: value.icon,
                    iconSize: [50, 50],
                    iconAnchor: [50, 50],
                    popupAnchor: [-20, -42]
                });
                var marker = L.marker(value.center, {
                    icon: icon
                });
                mapListingsDetail.addLayer(marker);
            }
                //})
        }
        function addFavoritListingsDetailModal(index)
        {
            customer_id = '<?php echo $user_id; ?>';
            if(customer_id !== ""){
                const url = "/api/add-remove-to-favorites";
                const sendData = {
                    "customer_id": customer_id,
                    "listing_id": index,
                };
                let xhr = new XMLHttpRequest();
                xhr.open('POST', url, true);
                xhr.setRequestHeader('Content-type', 'application/json');
                xhr.send(JSON.stringify(sendData));
                xhr.onload = function () {
                    // var paragraph = document.getElementById("faHeart"+index);
                    var paragraph1 = document.getElementById("faHeartListingDetailModal"+index);
                    
                    if(paragraph1.style.color !== "red"){
                        // paragraph.style.color = "red";
                        paragraph1.style.color = "red";
                    }else{
                        // paragraph.style.color = "currentColor";
                        paragraph1.style.color = "currentColor";
                    }
                }
            }else{
                jQuery.noConflict();
                $('#ListingDetailModal').modal('toggle'); 
                loginIn();
            }
        }
        function sendRequestListingsDetailModal(index)
        {
            customer_id = '<?php echo $user_id; ?>';
            size = document.getElementById("ListingArea").innerHTML;
            price = document.getElementById("listingPrice").innerHTML;

            price = price.substring(2);
            price = price.replace(',', '');
            size = size.substring(0,size.length-3);
            if(customer_id !== ""){
                let data = {
                    "name": document.getElementById("inquiry_fname").value,
                    "date": moment(new Date()).format('YYYY-MM-DD'),
                    "customer_id": customer_id,
                    "inquiry_pnumber": document.getElementById("inquiry_pnumber").value,
                    "inquiry_emailid": document.getElementById("inquiry_emailid").value,
                    "description": document.getElementById("inquiry_message").value,
                    "listing_id": index,
                    "source_id":1,
                    "property_type_id":document.getElementById("property_type_id").value,
                    "minimum_budget" : price,
                    "minimum_size" : size,
                    "minimum_bedrooms" : document.getElementById("ListingBedrooms").innerHTML,
                    "minimum_bashrooms" : document.getElementById("ListingBath").innerHTML,
                };
                const url = "/api/salesrequest-addsalesrequest";
                let xhr = new XMLHttpRequest();
                xhr.open('POST', url, true);
                xhr.setRequestHeader('Content-type', 'application/json');
                xhr.send(JSON.stringify(data));
                xhr.onload = function () {
                    data = JSON.parse(xhr.response);
                    if(data.hasOwnProperty("errors")){
                        Object.keys(data.errors).forEach(function(key) {
                            $("#addRequest_failure").html(data.errors[key][0]);
                        })
                        $( "#addRequest_failure" ).fadeIn( 300 ).delay( 1500 ).fadeOut( 400 );
                    }else{
                        result = JSON.parse(xhr.response);
                        let data1 = {
                            "sales_request_id": result.salesRequest.id,
                            "listing_id": index,
                        };
                        console.log(data1);
                        const url1 = "/api/salesrequest-addlisting";
                        let xhr1 = new XMLHttpRequest();
                        xhr1.open('POST', url1, true);
                        xhr1.setRequestHeader('Content-type', 'application/json');
                        xhr1.send(JSON.stringify(data1));
                        xhr1.onload = function () {
                            data1 = JSON.parse(xhr1.response);
                            if(data1.hasOwnProperty("errors")){
                                Object.keys(data1.errors).forEach(function(key) {
                                    $("#addRequest_failure").html(data1.errors[key][0]);
                                })
                                $( "#addRequest_failure" ).fadeIn( 300 ).delay( 1500 ).fadeOut( 400 );
                            }else{
                                $( "#addRequest_success" ).fadeIn( 300 ).delay( 1500 ).fadeOut( 400 );
                            }
                        }
                    }
                }
            }else{
                jQuery.noConflict();
                $('#ListingDetailModal').modal('hide');
                loginIn();
            }
        }
        function loginIn()
        {
            document.getElementById("loginModal").click();
            document.getElementById("loginModalTabButton").click();
        }
        function signUp()
        {
            document.getElementById("loginModal").click();
            document.getElementById("signupModalTabButton").click();
        }
        function modalLoginIn()
        {
            let data = {
                "email": document.getElementById("login_email").value,
                "password": document.getElementById("login_password").value,
            };
            
            const url = "/api/login-webuser";
            let xhr = new XMLHttpRequest();
            xhr.open('POST', url, true);
            xhr.setRequestHeader('Content-type', 'application/json');
            xhr.send(JSON.stringify(data));
            xhr.onload = function () {
                
                data = JSON.parse(xhr.response);
                if(xhr.status == "201"){
                    $( "#login_success" ).fadeIn( 300 ).delay( 1500 ).fadeOut( 400 );
                    document.getElementById("loginButtonContent").innerHTML = `
                                <button onclick="goBack()" class="btn btn-primary btn-block">Close</button>
                                <button onclick="goMyAccount()" class="btn btn-primary btn-block" style>Go to my Account</button>`;
                }else{
                    if( data.hasOwnProperty('errors')){
                        if( data.errors.hasOwnProperty('password')){
                            $("#login_failure").html(data.errors.password);
                        }
                        if( data.errors.hasOwnProperty('email')){
                            $("#login_failure").html(data.errors.email);
                        }
                    }
                    if( data.hasOwnProperty('message')){
                        $("#login_failure").html(data.message);
                    }
                    $( "div.failure" ).fadeIn( 300 ).delay( 1500 ).fadeOut( 400 );
                }
            }
        }
        function modalSignUp()
        {
            let data = {
                "name": document.getElementById("SignFristName").value,
                "surname": document.getElementById("SignLastName").value,
                "email": document.getElementById("SignEmail").value,
                "password": document.getElementById("Signpassword1").value,
                "confirm_password": document.getElementById("Signpassword2").value,
            };
            
            const url = "/api/create-webuser";
            let xhr = new XMLHttpRequest();
            xhr.open('POST', url, true);
            xhr.setRequestHeader('Content-type', 'application/json');
            xhr.send(JSON.stringify(data));
            xhr.onload = function () {
                data = JSON.parse(xhr.response);
                if(xhr.status == "201"){
                    $( "div.signup_success" ).fadeIn( 300 ).delay( 1500 ).fadeOut( 400 );
                    document.getElementById("signButtonContent").innerHTML = `
                                <button onclick="goBack()" class="btn btn-primary btn-block">Close</button>
                                <button onclick="goMyAccount()" class="btn btn-primary btn-block" style>Go to my Account</button>`;
                }else{
                    if( data.hasOwnProperty('errors')){
                        if( data.errors.hasOwnProperty('password')){
                            $("#signup_failure").html(data.errors.password);
                        }
                        if( data.errors.hasOwnProperty('email')){
                            $("#signup_failure").html(data.errors.email);
                        }
                    }
                    if( data.hasOwnProperty('message')){
                        $("#signup_failure").html(data.message);
                    }
                    $( "div.signup_failure" ).fadeIn( 300 ).delay( 1500 ).fadeOut( 400 );
                    // alert("Login Fail");
                }
            }
        }
        function signOut()
        {
            
            const url = "/api/logout-webuser";
            let xhr = new XMLHttpRequest();
            xhr.open('POST', url, true);
            xhr.setRequestHeader('Content-type', 'application/json');
            xhr.send();
            xhr.onload = function () {
                if(xhr.status == "201"){
                    //alert("LogOut Ok");
                    window.location.href="/page/home";
                }else{
                    alert("LogOut Fail");
                }
            }
        }
        function goBack(){
            window.location.reload();
        }
        function goMyAccount(){
            window.location.href = "/page/profile";
        }
    </script>
</body>

</html>
