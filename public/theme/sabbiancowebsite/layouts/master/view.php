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
    <link rel="stylesheet" href="/theme/sabbiancowebsite/assets/css/listingdetail.css">
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
    <style>
        section#slider .scroll-wrapper {
            width: 100%;
            overflow-x: hidden;
        }

        section#slider ul {
            padding: 0;
            width: max-content;
                margin-right: 0;
            margin-left: 0;
            margin-bottom: 0;
        }

        section#slider li.slider {
            display: inline-block;
            position: relative;
            /* width: 24.6vw; */
        }

        section#slider li.slider img {
            margin: 5px 10px 0 0;
            display: block;
            height: auto;
            max-width: 100%;
        }

        section#slider span.slider-name, span.slider-title {
            display: block;
            position: absolute;
            color: #fff;
            left: 2vw;
        }

        section#slider span.slider-name {
            font-weight: 900;
            bottom: 4vw;
            font-size: 1.5vw;
        }

        section#slider span.slider-title {
            font-weight: 100;
            bottom: 2.5vw;
            font-size: 1.3vw;
        }

        section#slider .more-slider {
            padding: 1vh 5% 0;
        }

        section#slider .more-slider h4 {
            font-family: 'Playfair Display', serif;
            color: #5896b0;
            font-weight: 500;
            font-size: 3vw;
            padding: 35px 0 25px 0px;
            margin-bottom: 0;
            margin-top: 8px;
        }

        section#slider .more-slider p {
                padding-bottom: 2vh;
        }

        section#slider .slide-controls {
            color: #5896b0;
            font-weight: 300;
        }

        section#slider .slide-controls span.slider-previous {
            margin-right: 75px;
        }

        section#slider .slide-controls i {
            font-size: 26px;
        }

        section#slider .more-slider a.button {
            border: 1px solid #5896b0;
            max-width: 200px;
            color: #5896b0;
            margin-top: 1vw;
        }

        .slider {
            font-family: "@Microsoft YaHei Light";
            background: #fafafa;
            display: flex;
            justify-content: center;
            align-items: center;
            overflow: hidden;	
            width:100%;
            height: 100%;	
        }

        .carousel-container {
            width: 100%;
            position: relative;
            box-shadow: 0 0 30px -20px #223344;
            margin: auto;
            z-index: 0;
        }

        /* Hide the images by default */
        .mySlides {
            display: none;
        }
        .mySlides img {
            display: block;
            height: 90vh;
        }

        .prev,
        .next {
            cursor: pointer;
            position: absolute;
            top: 50%;
            transform: translate(0, -50%);
            width: auto;
            padding: 20px;
            color: white;
            font-weight: bold;
            font-size: 24px;
            border-radius: 0 8px 8px 0;
            background: rgba(173, 216, 230, 0.1);
            user-select: none;
        }
        .next {
            right: 0;
            border-radius: 8px 0 0 8px;
        }
        .prev:hover,
        .next:hover {
            background-color: rgba(173, 216, 230, 0.3);
        }

        /* Caption text */
        .text {
            color: #f2f2f2;
            background-color: rgba(10, 10, 20, 0.1);
            backdrop-filter: blur(6px);
            border-radius: 10px;
            font-size: 20px;
            padding: 8px 12px;
            position: absolute;
            bottom: 60px;
            left: 50%;
            transform: translate(-50%);
            text-align: center;
        }

        /* Number text (1/3 etc) */
        .number {
            color: #f2f2f2;
            font-size: 16px;
            background-color: rgba(173, 216, 230, 0.15);
            backdrop-filter: blur(6px);
            border-radius: 10px;
            padding: 8px 12px;
            position: absolute;
            top: 10px;
            left: 10px;
        }
        .dots-container {
            position: absolute;
            bottom: 10px;
            left: 50%;
            transform: translate(-50%);
        }

        /* The dots/bullets/indicators */
        .dots {
            cursor: pointer;
            height: 14px;
            width: 14px;
            margin: 0 4px;
            background-color: rgba(173, 216, 230, 0.2);
            backdrop-filter: blur(2px);
            border-radius: 50%;
            display: inline-block;
            transition: background-color 0.3s ease;
        }
        

        /* transition animation */
        .animate {
            text-align: -webkit-center;
            -webkit-animation-name: animate;
            -webkit-animation-duration: 1s;
            animation-name: animate;
            animation-duration: 2s;
        }
        
    </style>
</head>
<body style="overflow-x: hidden;">
    <div id="wrapper">
        <?= $body ?>
    </div>
    <div class="modal fade bs-modal-sm imageModal" style="z-index:99999" id="imageModal" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-sm" style="height: 100%;width: 100%;max-width: 100%;display: flex;align-content: center;justify-content: center;">
            <div class="modal-content" style="width: 90%;height: 90%;">
                <div class="slider">
                    <!-- Full-width images with number and caption text -->
                    <div class="carousel-container">
                        <div id="slideContent">
                        </div>
                        <!-- Next and previous buttons -->
                        <a class="prev" onclick="prevSlide()">&#10094;</a>
                        <a class="next" onclick="nextSlide()">&#10095;</a>
                        <!-- The dots/circles -->
                        <div class="dots-container" id="dotsContainer">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <a data-toggle="modal" data-target=".ListingDetailModal" id="ListingDetailButton"></a>
    <div class="modal fade bs-modal-sm ListingDetailModal" style="z-index: 9999;" id="ListingDetailModal" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-sm modal-width" >
            <div class="modal-content" style="padding: 20px 5px 15px 5px;display: flex;align-items: center;justify-content: center;background: #f5f7fb;">
                <div id="search-detail-lightbox" class="home-detail-lightbox">
                    <div id="details-page-container" class="detail-page details-page-container active-view react">
                        <div id="detail-container-column" class="active-hdp-col yui3-app-views">
                            <div class="active-view preload-lightbox">
                                <div id="__next">
                                    <div data-test="hdp-for-sale-page-content">
                                        <div class="hdp__sc-9dqr3g-0 gDrWtP ds-wrapper fs-package">
                                            <div class="hdp__sc-9dqr3g-1 KyLea ds-container">
                                                <div class="layout-wrapper" style="height: auto;">
                                                    <div class="layout-container " style="height: 100vh;">
                                                        <div class="media-column-container">
                                                            <div data-renderstrat="inline">
                                                                <div>
                                                                    <div>
                                                                        <div class="hdp__sc-ys97yr-0 dsOsCK">
                                                                            <div data-media-col="true">
                                                                                <ul class="hdp__sc-1wi9vqt-0 dDzspE ds-media-col media-stream" id="listingImg">
                                                                                </ul>
                                                                            </div>
                                                                        </div>
                                                                        <div class="hdp__sc-ys97yr-1 byRSqe" style="margin-top: 59px;">
                                                                            <button class="StyledTextButton-c11n-8-84-3__sc-n1gfmh-0 kvwmII dpf__sc-bfl6r0-0 gvIJFU">Skip to end of photos</button>
                                                                            <div data-integration-test-id="photo-carousel" class="dpf__sc-1dbq79x-0 ihMmzv">
                                                                                <div class="sc-gGvHcT hUYMgw dpf__sc-1ezqz18-0 brZwag">
                                                                                    <button id="slider-previous" tabindex="-1" aria-label="Previous set of items" type="button" class="UnstyledButton-c11n-8-84-3__sc-13jpj60-0 ghQDHZ">
                                                                                        <svg viewBox="0 0 32 32" class="Icon-c11n-8-84-3__sc-13llmml-0 eFSKjO IconChevronLeft-c11n-8-84-3__sc-ddr5cu-0 fXPeRZ" aria-hidden="true" focusable="false" role="img">
                                                                                            <title>Chevron Left</title>
                                                                                            <path stroke="none" d="M29.41 8.59a2 2 0 00-2.83 0L16 19.17 5.41 8.59a2 2 0 00-2.83 2.83l12 12a2 2 0 002.82 0l12-12a2 2 0 00.01-2.83z">
                                                                                            </path>
                                                                                        </svg>
                                                                                    </button>
                                                                                    <section id="slider" class="row" style="height: 100%;">
                                                                                        <div class="scroll-wrapper" >
                                                                                            <ul class="row" id="listingImgMobile" style="height: 100%;">
                                                                                            </ul>
                                                                                        </div>
                                                                                    </section>
                                                                                    <button id="slider-next" tabindex="-1" aria-label="Next set of items" type="button" class="UnstyledButton-c11n-8-84-3__sc-13jpj60-0 ghQDHZ">
                                                                                        <svg viewBox="0 0 32 32" class="Icon-c11n-8-84-3__sc-13llmml-0 eFSKjO IconChevronRight-c11n-8-84-3__sc-19mpgrq-0 dUtfpm" aria-hidden="true" focusable="false" role="img">
                                                                                            <title>Chevron Right</title>
                                                                                            <path stroke="none" d="M29.41 8.59a2 2 0 00-2.83 0L16 19.17 5.41 8.59a2 2 0 00-2.83 2.83l12 12a2 2 0 002.82 0l12-12a2 2 0 00.01-2.83z"></path>
                                                                                        </svg>
                                                                                    </button>
                                                                                </div>
                                                                            </div>
                                                                            <button class="StyledTextButton-c11n-8-84-3__sc-n1gfmh-0 kvwmII dpf__sc-bfl6r0-0 gvIJFU">Skip to beginning of photos</button>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="data-column-container">
                                                            <div class="side-by-side-action-bar">
                                                                <div data-renderstrat="inline">
                                                                    <div>
                                                                        <div class="hdp__sc-664ky2-0 bjuBcC">
                                                                            <div class="hdp__sc-1dupnse-5 kNVgPR">
                                                                                <div class="hdp__sc-1dupnse-9 gWnoLO ds-action-bar">
                                                                                    <nav aria-label="utility" class="hdp__sc-1dupnse-8 fHgghR">
                                                                                        <!-- <div  style="position: inherit;text-align: center;width:100%">
                                                                                            <a href="/page/home"><img style="width: 120px;margin-top: 4px;" src="/theme/sabbiancowebsite/assets/images/logosabbianco.png" alt=""/></a>
                                                                                        </div> -->
                                                                                        <ul class="hdp__sc-1dupnse-7 erqwFf">
                                                                                            <li class="hdp__sc-1dupnse-1 fsIsqR">
                                                                                                <button aria-pressed="false" class="sc-bcXHqe cqBcXG hdp__sc-14xnfdo-0 gdKUCl" role="button">
                                                                                                    <div class="hdp__sc-1dupnse-4 jJQTGX" id="ListingDetailFavorit">
                                                                                                        <div aria-hidden="true" class="hdp__sc-1dupnse-2 hdp__sc-1dupnse-10 dWtTje eThNKw">
                                                                                                            <svg viewBox="0 0 32 32" aria-hidden="true" focusable="false" role="img" class="Icon-c11n-8-84-3__sc-13llmml-0 jhZWWg">
                                                                                                                <title>Heart</title>
                                                                                                                <path stroke="none" d="M27.66 6.19a7.85 7.85 0 00-11 .13L16 7l-.65-.66a7.85 7.85 0 00-11-.13 8.23 8.23 0 00.09 11.59l.42.42L15.29 28.7a1 1 0 001.42 0l10.44-10.5.42-.42a8.23 8.23 0 00.09-11.59zm-1.42 10.06l-.52.52L16 26.55l-9.72-9.78-.52-.52A6.15 6.15 0 014 13.19a5.91 5.91 0 011.62-5.43 5.81 5.81 0 014.67-1.71 6 6 0 013.78 1.87l.5.5 1.08 1.08a.5.5 0 00.7 0l1.08-1.08.5-.5a6 6 0 013.78-1.87 5.81 5.81 0 014.67 1.71A5.91 5.91 0 0128 13.19a6.15 6.15 0 01-1.76 3.06z"></path>
                                                                                                            </svg>
                                                                                                        </div>
                                                                                                        <span class="hdp__sc-1dupnse-3 gBetGm"> Save </span>
                                                                                                    </div>
                                                                                                </button>
                                                                                            </li>
                                                                                            <li class="hdp__sc-1dupnse-1 fsIsqR">
                                                                                                <div class="hdp__sc-1dupnse-11 gLYDfj" property="[object Object]">
                                                                                                    <div type="button" class="hdp__sc-1dupnse-4 jJQTGX">
                                                                                                        <div aria-hidden="true" class="hdp__sc-1dupnse-2 hdp__sc-1dupnse-10 dWtTje eThNKw" onclick="closeListingDetailModal();">
                                                                                                            <svg viewBox="0 0 32 32" aria-hidden="true" focusable="false" role="img" class="Icon-c11n-8-84-3__sc-13llmml-0 jhZWWg">
                                                                                                                <title>close</title>
                                                                                                                <path stroke="none" d="M16 2a14 14 0 1014 14A14 14 0 0016 2zM6.85 23.74A12 12 0 0123.74 6.85L6.85 23.74zM16 28a11.89 11.89 0 01-7.74-2.85L25.15 8.26A12 12 0 0116 28z"></path>
                                                                                                            </svg>
                                                                                                        </div>
                                                                                                        <span class="hdp__sc-1dupnse-3 gBetGm" onclick="closeListingDetailModal();">Close</span>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </li>
                                                                                        </ul>
                                                                                    </nav>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="summary-container">
                                                                <div>
                                                                    <div data-renderstrat="inline">
                                                                        <div>
                                                                            <div class="Spacer-c11n-8-84-3__sc-17suqs2-0 yETgj">
                                                                                <div class="hdp__sc-1s2b8ok-0 eXZxHY">
                                                                                    <div class="hdp__sc-1s2b8ok-1 ckVIjE">
                                                                                        <span data-testid="price" class="Text-c11n-8-84-3__sc-aiai24-0 dpf__sc-1me8eh6-0 OByUh fpfhCd">
                                                                                            <span id="listingPriceTitle"></span>
                                                                                        </span>
                                                                                        <div class="hdp__sc-1s2b8ok-2 wmMDq">
                                                                                            <span data-testid="bed-bath-beyond">
                                                                                                <span data-testid="bed-bath-item" id="ListingBedroomsTitleDiv" class="Text-c11n-8-84-3__sc-aiai24-0 hrfydd">
                                                                                                    <i class="flaticon-bed mr-2" aria-hidden="true"></i>
                                                                                                    <strong id="ListingBedroomsTitle"></strong>
                                                                                                    <span> bd</span>
                                                                                                    <span color="colors.gray300" class="dpf__sc-13frln-0 haJXRk"></span>
                                                                                                </span>
                                                                                                <!-- <button type="button" aria-expanded="false" aria-haspopup="false" class="TriggerText-c11n-8-84-3__sc-139r5uq-0 eJlkOp TooltipPopper-c11n-8-84-3__sc-io290n-0 hdp__sc-1vcj1w9-0 cPCtZj"> -->
                                                                                                <span data-testid="bed-bath-item" id="ListingBathTitleDiv" class="Text-c11n-8-84-3__sc-aiai24-0 hrfydd">
                                                                                                    <i class="flaticon-bathtub mr-2" aria-hidden="true"></i>
                                                                                                    <strong id="ListingBathTitle"></strong>
                                                                                                    <span> ba</span>
                                                                                                    <span color="colors.gray300" class="dpf__sc-13frln-0 haJXRk"></span>
                                                                                                </span>
                                                                                                <!-- </button> -->
                                                                                                <span data-testid="bed-bath-item" id="ListingAreaTitleDiv" class="Text-c11n-8-84-3__sc-aiai24-0 hrfydd">
                                                                                                    <i class="flaticon-square mr-2" aria-hidden="true"></i>
                                                                                                    <strong id="ListingAreaTitle"></strong>
                                                                                                    <span> sqm</span>
                                                                                                </span>
                                                                                            </span>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="hdp__sc-riwk6j-0 jmPkrV">
                                                                                    <h1 class="Text-c11n-8-84-3__sc-aiai24-0 hrfydd" id="listingName"></h1>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div data-cft-name="contact-buttons" class="hdp__sc-h6x2kh-0 hXcQfc">
                                                                        <ul class="contact-button-group">
                                                                            <li class="contact-button prominent">
                                                                                <button onclick="showRequestModal()" class="StyledButton-c11n-8-84-3__sc-wpcbcc-0 fKAHIc sc-16sdjcz-0 eObXzv contact-button-condensed ds-button ds-label-small" data-cft-name="contact-button-tour">
                                                                                    <div style="text-align: center;">Request more Details
                                                                                        <!-- <p class="Text-c11n-8-84-3__sc-aiai24-0 StyledParagraph-c11n-8-84-3__sc-18ze78a-0 hTmUSk">as early as today at 11:00 am</p> -->
                                                                                    </div>
                                                                                </button>
                                                                            </li>
                                                                            <!-- <li class="contact-button">
                                                                                <button class="StyledButton-c11n-8-84-3__sc-wpcbcc-0 liNKkG sc-16sdjcz-0 eObXzv contact-button-condensed ds-button ds-label-small" data-cft-name="contact-button-message">Contact agent</button>
                                                                            </li> -->
                                                                        </ul>
                                                                        <div class="Spacer-c11n-8-84-3__sc-17suqs2-0 fyXflK"></div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="data-view-container">
                                                                <div class="ds-data-view-list">
                                                                    <div class="hdp__sc-1jydst6-0 lckxKm">
                                                                        <div class="single homes-content details mb-30">
                                                                            <h3 class="mb-3">Description</h3>
                                                                            <p id="listingDescription"></p>
                                                                        </div>
                                                                        <div class="single homes-content details mb-30">
                                                                            <!-- title -->
                                                                            <h3 class="mb-3">Property Details</h3>
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
                                                                        </div>
                                                                        <div class="single homes-content details mb-30">
                                                                            <!-- title -->
                                                                            <h3 class="mb-3">Amenities</h3>
                                                                            <!-- cars List -->
                                                                            <ul class="homes-list clearfix" id="amenities">
                                                                            </ul>
                                                                        </div>
                                                                        <div class="floor-plan property wprt-image-video w50 pro" id="floorPlansDiv">
                                                                        <h3 class="mb-3">Floor Plans</h3>
                                                                            <img alt="image" id="floorPlans" src="">
                                                                        </div>
                                                                        <div class="property-location map" style="height: 350px;">
                                                                        <h3 class="mb-3">Location</h3>
                                                                            <div class="divider-fade"></div>
                                                                            <div id="map-leaflet-listingsDetail" class="contact-map" style="height: 255px; "></div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="mixed-media-lightbox-container" style="width:100vw"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div id="__NEXT_SCRIPTS_DEV__"></div>
                            </div>
                        </div>
                    </div>
                    <div class="home-detail-lightbox-mask" role="presentation"></div>
                </div>
            </div>
        </div>
        <input type="hidden" id="property_type_id"/>
    </div>
    <a data-toggle="modal" data-target=".RequestModal" id="RequestModal"></a>
    <div class="modal fade bs-modal-sm RequestModal" style="z-index:99999" id="RequestModalDiv" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-sm" style="margin-top: 200px;">
            <div class="modal-content" style="display:flex;align-items: center;justify-content:center;">
                <div class="widget-boxed-body signature-width" style="padding: 25px;background: white;border-radius: 10px;">
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
        var listingMobileSliderIndex = 0;

        $(document).on('click', '#slider-next', function(){
            var next = listingMobileSliderIndex + 9;
            console.log(next);
            if (listingMobileSliderIndex === 90) {
                $('div.scroll-wrapper ul.row li').removeAttr('style');
                $('div.scroll-wrapper ul.row li').attr('style', 'left:0%;-webkit-transition:left 1s;transition:left 1s;');
                listingMobileSliderIndex = 0;
            } else {
                $('div.scroll-wrapper ul.row li').removeAttr('style');
                $('div.scroll-wrapper ul.row li').attr('style', 'left:-'+ next +'.1%;-webkit-transition:left 1s;transition:left 1s;');
                listingMobileSliderIndex = next;
            }   
        });

        $(document).on('click', '#slider-previous', function(){
            
            var previous = listingMobileSliderIndex - 9;
            console.log(previous);
            if (listingMobileSliderIndex === 0) {
                $('div.scroll-wrapper ul.row li').removeAttr('style');
                $('div.scroll-wrapper ul.row li').attr('style', 'left:-70%;-webkit-transition:left 1s;transition:left 1s;');
                listingMobileSliderIndex = 90;
            } else {
                $('div.scroll-wrapper ul.row li').removeAttr('style');
                $('div.scroll-wrapper ul.row li').attr('style', 'left:-'+ previous +'.1%;-webkit-transition:left 1s;transition:left 1s;');
                listingMobileSliderIndex = previous;
            }
        });

        function showRequestModal(index){
            jQuery.noConflict();
            // $('#ListingDetailModal').modal('toggle'); 
            document.getElementById("RequestModal").click();
        }
        function closeListingDetailModal(index){
            jQuery.noConflict();
            $('#ListingDetailModal').modal('toggle'); 
            var newurl = <?php echo env('APP_URL'); ?>'<?php echo env('APP_URL'); ?>/page/listings-map';
            window.history.pushState({ path: newurl }, '', newurl);
        }

        var mapListingsDetail = null;
        function showListigDetailModal(index){
            document.getElementById("ListingDetailButton").click();
            loadListingsDetailModal(index);
            
            var newurl = '<?php echo env('APP_URL'); ?>/page/listing-details?index='+index;
            window.history.pushState({ path: newurl }, '', newurl);
            
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
                console.log(data);
                favorite = '';
                if(data.in_favoriteproperties == 1){
                    favorite = "color: red;";
                }

                document.getElementById("listingName").innerHTML = data.displayname + ` <span class="Text-c11n-8-84-3__sc-aiai24-0 dpf__sc-1yftt2a-1 hrfydd ixkFNb">`+data.property_type+`</span>`;
                if(data.price !== null && data.price !== '0' && data.price !== 0){
                    document.getElementById("listingPriceTitle").innerHTML = `€‎ ` + data.price;
                }
                if(data.number_of_bathrooms !== null){
                    document.getElementById("ListingBath").innerHTML = data.number_of_bathrooms;
                    document.getElementById("ListingBathTitle").innerHTML = data.number_of_bathrooms;
                }else{
                    document.getElementById("ListingBathDiv").style.display = "none";
                    document.getElementById("ListingBathTitleDiv").style.display = "none";
                }
                if(data.number_of_bedrooms !== null){
                    document.getElementById("ListingBedrooms").innerHTML = data.number_of_bedrooms;
                    document.getElementById("ListingBedroomsTitle").innerHTML = data.number_of_bedrooms;
                }else{
                    document.getElementById("ListingBedroomsDiv").style.display = "none";
                    document.getElementById("ListingBedroomsTitleDiv").style.display = "none";
                }
                if(data.area_size !== null){
                    document.getElementById("ListingArea").innerHTML = data.area_size + "sqm";
                    document.getElementById("ListingAreaTitle").innerHTML = data.area_size;
                }else{
                    document.getElementById("ListingAreaDiv").style.display = "none";
                    document.getElementById("ListingAreaTitleDiv").style.display = "none";
                }

                if(data.property_type !== null){
                    document.getElementById("ListingPropertyType").innerHTML = data.property_type;
                }else{
                    document.getElementById("ListingPropertyTypeDiv").style.display = "none";
                }
                if(data.price !== null && data.price !== '0' && data.price !== 0){
                    document.getElementById("ListingPropertyPrice").innerHTML = `€‎` + data.price;
                }else{
                    document.getElementById("ListingPropertyPriceDiv").style.display = "none";
                }
                if(data.floor_plans.length == 0){
                    document.getElementById("floorPlansDiv").style.display="none";
                }else{
                    document.getElementById("floorPlans").src=""+data.floor_plans[0].image;
                }
                document.getElementById("ListingDetailFavorit").innerHTML = `<a style="cursor: pointer;" onclick="addFavoritListingsDetailModal(`+data.id+`)">
                        <i id="faHeartListingDetailModal`+data.id+`" class="fa fa-heart" style="font-size: initial; `+favorite+`"></i>
                        <span class="hdp__sc-1dupnse-3 gBetGm"> Save </span></a>`;

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
               
                document.getElementById("property_type_id").value = data.property_type_id;
                var temp ="";
                for(i=0;i<data.features.length;i++){
                temp += `<li style="display: flex;width:100%;align-items: center;">
                            <img style="height: 15px;" src="/theme/sabbiancowebsite/assets/images/checkbox.png">&nbsp;<span>`+data.features[i]+`</span>
                        </li>`;
                }
                document.getElementById("amenities").innerHTML = temp;
                var  imagesTemp = "";
                imagesTemp = data.image;
                for(i=0; i < data.images.length; i++){
                    imagesTemp += "---" + data.images[i];
                }
                temp =`<li class="hdp__sc-bxf98j-0 hsjuif media-stream-tile media-stream-tile--prominent">
                            <figure>
                                <button onclick="viewImage('`+imagesTemp+`',1)" aria-label="view larger view of the 1 photo of this home" class="sc-bcXHqe hdp__sc-1hfifce-0 cqBcXG dYAmNA">
                                    <picture class="sc-eJDSGI izLhdJ">
                                        <img src="`+data.image+`" alt="">
                                    </picture>
                                </button>
                            </figure>
                        </li>`;
                temp1 =`<li class="slider" style="left:-0%;-webkit-transition:left 1s;transition:left 1s;">
                            <button onclick="viewImage('`+imagesTemp+`',1)" type="button" class="UnstyledButton-c11n-8-84-3__sc-13jpj60-0 dpf__sc-1obsll-1 ghQDHZ ieLHUW">
                                <picture class="sc-eJDSGI izLhdJ">
                                    <img style="height:100%" src="`+data.image+`" alt="">
                                </picture>
                            </button>
                        </li>`;
                for(i=0;i<data.images.length;i++){
                    index = i+2;
                    temp += `<li class="hdp__sc-bxf98j-0 hsjuif media-stream-tile tile-1">
                                <figure>
                                    <button onclick="viewImage('`+imagesTemp+`',`+index+`)" aria-label="view larger view of the 2 photo of this home" class="sc-bcXHqe hdp__sc-1hfifce-0 cqBcXG dYAmNA">
                                        <picture class="sc-eJDSGI izLhdJ">
                                            <img src="`+data.images[i]+`" alt="">
                                        </picture>
                                    </button>
                                </figure>
                            </li>`;
                    temp1 +=` <li class="slider" style="left:-0%;-webkit-transition:left 1s;transition:left 1s;">
                                <button onclick="viewImage('`+imagesTemp+`',`+index+`)" type="button" class="UnstyledButton-c11n-8-84-3__sc-13jpj60-0 dpf__sc-1obsll-1 ghQDHZ ieLHUW">
                                    <picture class="sc-eJDSGI izLhdJ">
                                        <img  style="height:100%" src="`+data.images[i]+`" alt="">
                                    </picture>
                                </button>
                            </li>`;
                }
                document.getElementById("listingImg").innerHTML = temp;
                document.getElementById("listingImgMobile").innerHTML = temp1;

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
                console.log(sendData);
                let xhr = new XMLHttpRequest();
                xhr.open('POST', url, true);
                xhr.setRequestHeader('Content-type', 'application/json');
                xhr.send(JSON.stringify(sendData));
                xhr.onload = function () {
                    console.log(xhr.response);
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
            price = document.getElementById("listingPriceTitle").innerHTML;

            price = price.substring(3);
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
                                jQuery.noConflict();
                                $('#RequestModalDiv').modal('toggle');
                            }
                        }
                    }
                }
            }else{
                jQuery.noConflict();
                $('#ListingDetailModal').modal('toggle');
                $('#RequestModalDiv').modal('toggle');
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
                    
                    var success_message = `<div class="right-side d-none d-none d-lg-none d-xl-flex sign ml-0">
                            <div class="header-widget sign-in">
                                <div class="show-reg-form"><a style="cursor: pointer;" onclick="goMyAccount()">Μy Account</a></div>
                            </div>
                        </div>`;
                    $('#headerlogindiv').html(success_message);
                    $('#myModal').hide();
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
                    var success_message = `<div class="right-side d-none d-none d-lg-none d-xl-flex sign ml-0">
                            <div class="header-widget sign-in">
                                <div class="show-reg-form"><a style="cursor: pointer;" onclick="goMyAccount()">Μy Account</a></div>
                            </div>
                        </div>`;
                    $('#headerlogindiv').html(success_message);
                    $('#myModal').hide();
                }else{
                    console.log(data);
                    if( data.hasOwnProperty('errors')){
                        if( data.errors.hasOwnProperty('name')){
                            $("#signup_failure").html(data.errors.name);
                        }
                        else if( data.errors.hasOwnProperty('surname')){
                            $("#signup_failure").html(data.errors.surname);
                        }                        
                        else if( data.errors.hasOwnProperty('email')){
                            $("#signup_failure").html(data.errors.email);
                        }
                        else if( data.errors.hasOwnProperty('password')){
                            $("#signup_failure").html(data.errors.password);
                        }
                    }
                    if( data.hasOwnProperty('message')){
                        $("#signup_failure").html(data.message);
                    }
                    $( "#signup_failure" ).fadeIn( 300 ).delay( 1500 ).fadeOut( 400 );
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
        function viewImage(data,index){
            jQuery.noConflict();
            $('#imageModal').modal('toggle'); 
            temp = "";
            temp1 = "";
            images = data.split("---");
            console.log(index);
            for(i=0;i<images.length;i++){
                temp += `<div class="mySlides animate" >
                            <img src="`+images[i]+`" alt="slide" />
                        </div>`;
                temp1 += `<span class="dots" onclick="currentSlide(`+i+`)"></span>`;
            }
            document.getElementById("slideContent").innerHTML = temp;
            document.getElementById("dotsContainer").innerHTML = temp1;
            nextSlide(index);
        }
        let slideIndex = 0;
	
        // Next-previous control
        function nextSlide() {
            slideIndex++;
            showSlides();
        }

        function prevSlide() {
            slideIndex--;
            showSlides();
        }

        // Thumbnail image controlls
        function currentSlide(n) {
            slideIndex = n-1;
            showSlides();
        }

        function showSlides() {
            
            let slides = document.querySelectorAll(".mySlides");
            
            let dots = document.querySelectorAll(".dots");
            
            if (slideIndex > slides.length - 1) slideIndex = 0;
            if (slideIndex < 0) slideIndex = slides.length - 1;
            
            // hide all slides
            slides.forEach((slide) => {
                slide.style.display = "none";
            });
            // show one slide base on index number

            slides[slideIndex].style.display = "block";

            dots.forEach((dot) => {
                dot.classList.remove("active");
            });

            dots[slideIndex].classList.add("active");
        }
    </script>
</body>

</html>
