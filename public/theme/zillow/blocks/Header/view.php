<?php

use App\Helpers\Helper;

if (isset($_SESSION["user_id"])) {
  $user_id = $_SESSION["user_id"];
} else {
  $user_id = "";
}

if (isset($_SESSION["user_role"])) {
  $user_role = $_SESSION["user_role"];
} else {
  $user_role = "";
}

if (isset($_SESSION["email"])) {
  $email = $_SESSION["email"];
} else {
  $email = "";
}
if (isset($_SESSION["user_image"])) {
  $user_image = $_SESSION["user_image"];
} else {
  $user_image = "";
}
if (isset($_SESSION["name"])) {
  $name = $_SESSION["name"];
} else {
  $name = "";
}

$active_district_response = Helper::get_active_district();
$active_district_response = json_decode($active_district_response);

$active_municipality_response = Helper::get_active_municipality();
$active_municipality_response = json_decode($active_municipality_response);

$active_location_response = Helper::get_active_location();
$active_location_response = json_decode($active_location_response);

// echo '<pre>';
// print_r($active_property_types_response);
// echo '</pre>';

$postData = [
  'slug' => "menu",
  'locale' => "en_US",
];

$menu_response = Helper::get_menu($postData);
$menu_response = json_decode($menu_response);

// $screen_width = "<script>document.write(screen.width);</script>";
// $screen_height = "<script>document.write(screen.height);</script>";
// echo 'screen_width: '.$screen_width.'<br>';
// echo 'screen_height: '.$height.'<br>';
?>

<style>
  #map-leaflet {
    height: 100vh;
  }

  .parallax-searchs.home15 {
    height: 100vh;
    display: block;
  }

  @media only screen and (max-width: 1024px) {
    .parallax-searchs.home15 .hero-inner {
      padding: 0px 0;
    }
  }

  .parallax-searchs.home15 .hero-inner {
    text-align: center;
    padding: 150px 0;
  }

  .parallax-searchs.thome-1 {
    background: -webkit-gradient(linear, left top, left bottom, from(rgba(0, 0, 0, 0.3)), to(rgba(0, 0, 0, 0.3))), url(<?php echo $block->setting('backgroundimage'); ?>) cover center top !important;
    background-size: cover !important;
    background: linear-gradient(rgba(0, 0, 0, 0.3), rgba(0, 0, 0, 0.3)), url(<?php echo $block->setting('backgroundimage'); ?>) cover center top !important;
    background-size: cover !important;
  }

  /* .parallax-searchs.home15 {
        height: 350px !important;
        display: block;
    } */
  #header.cloned.sticky ul li a:hover {
    color: #707070 !important;
  }

  #sideBar {
    position: fixed;
    display: block;
    top: 50%;
    left: 10px;
    margin: -100px 0 0 0;
    height: 200px;
    display: none;
    z-index: 1000;
  }

  @media only screen and (max-width: 450px) {
    .hp-6 .rld-single-select {
      width: auto;
    }
  }

  a {
    color: black !important;
  }

  .mm-panel.mm-hasnavbar .mm-navbar {
    background-color: white;
  }

  .mm-menu {
    background-color: white;
  }

  .mmenu-trigger {
    background-color: white;
  }

  .active {
    background-color: white;
  }

  .bannerTitle {
    text-align-last: center;
    color: white;
    display: flex;
    justify-content: center;
    align-items: center;
    font-size: 40px;
    font-family: "Ivar Headline", "Ivar Headline Subset", "Adjusted Times", "Adjusted Times New Roman", "Times New Roman", serif;
    filter: drop-shadow(0px 0px 5px #000);
  }

  .bannerTitle2 {
    text-align-last: center;
    color: white;
    justify-content: center;
    align-items: center;
    font-size: 40px;
    font-family: "Ivar Headline", "Ivar Headline Subset", "Adjusted Times", "Adjusted Times New Roman", "Times New Roman", serif;
    filter: drop-shadow(0px 0px 5px #000);
  }

  @media screen and (max-width: 768px) {
    .bannerTitle {
      font-size: 26px;
    }
  }

  .jYxjRF .Input-c11n-8-86-1__sc-4ry0fw-0 {
    font-weight: 600;
    font-size: 16px;
    cursor: text;
  }

  .jYxjRF .Input-c11n-8-86-1__sc-4ry0fw-0:hover {
    cursor: text;
  }

  data-styled.g18[id="sc-17uc5u3-0"] {
    content: "jYxjRF,";
  }

  .KiRwB {
    text-align: left;
    margin: auto;
    height: 68px;
    width: 100%;
  }

  .KiRwB.stuck {
    top: 0px;
    left: 0px;
    width: 100vw;
    position: fixed;
    display: -webkit-box;
    display: -webkit-flex;
    display: -ms-flexbox;
    display: flex;
    background-color: #fff;
    border-bottom: 1px solid #d1d1d5;
    z-index: 4;
  }

  data-styled.g19[id="sc-1dzx782-0"] {
    content: "KiRwB,";
  }

  .jYxjRF {
    margin: 12px auto;
    padding: 0px 16px;
    width: 100%;
  }

  @media (min-width: 769px) {
    .jYxjRF {
      max-width: 480px;
    }
  }

  @media (max-height: 820px) {
    .jYxjRF {
      max-width: 100%;
    }
  }

  @media (min-width: 1024px) {
    .jYxjRF {
      max-width: 700px;
    }
  }

  .jYxjRF .Input-c11n-8-86-1__sc-4ry0fw-0 {
    font-weight: 600;
    font-size: 16px;
    cursor: text;
  }

  .jYxjRF .Input-c11n-8-86-1__sc-4ry0fw-0:hover {
    cursor: text;
  }

  .jYxjRF label {
    cursor: pointer;
    margin-left: -1px !important;
  }

  .jYxjRF .react-autosuggest__suggestions-container {
    display: none;
  }

  .jYxjRF .react-autosuggest__suggestions-container--open {
    display: block;
    position: relative;
    width: calc(100% - 2px);
    margin-left: 1px;
    background-color: #fff;
    z-index: 4;
    box-shadow: 0 0 16px rgba(0, 0, 0, 0.1);
    border-bottom-left-radius: 3px;
    border-bottom-right-radius: 3px;
    border: none;
    max-height: calc(100vh - px);
    overflow-x: hidden;
    overflow-y: auto;
  }

  .jYxjRF .react-autosuggest__suggestions-list {
    margin: 0;
    padding: 0;
    list-style-type: none;
    overflow: hidden;
  }

  .jYxjRF .react-autosuggest__suggestion {
    cursor: pointer;
    padding: 0px 24px;
    color: #a7a6ab;
    display: block;
    height: 100%;
  }

  .jYxjRF .react-autosuggest__suggestion>div {
    height: 56px;
    box-sizing: border-box;
  }

  .jYxjRF .react-autosuggest__suggestion>div span {
    height: 56px;
  }

  .jYxjRF .react-autosuggest__suggestion:last-of-type div {
    border: none;
  }

  .jYxjRF .react-autosuggest__suggestion--highlighted {
    background-color: #006aff;
  }

  .jYxjRF .react-autosuggest__suggestion--highlighted>div div {
    border-bottom: none;
  }

  .jYxjRF .react-autosuggest__suggestion--highlighted>div span {
    color: #fff;
  }

  .jYxjRF .react-autosuggest__suggestion--highlighted>div span>svg g g,
  .jYxjRF .react-autosuggest__suggestion--highlighted>div span>svg g path {
    stroke: #fff;
  }

  data-styled.g18[id="sc-17uc5u3-0"] {
    content: "jYxjRF,";
  }

  .dvwpwM:hover .Input-c11n-8-86-1__sc-4ry0fw-0,
  .dvwpwM:hover label {
    border-color: rgb(0, 106, 255);
    cursor: pointer;
  }

  .dvwpwM input::-webkit-input-placeholder {
    color: #767676;
  }

  .dvwpwM input::-moz-placeholder {
    color: #767676;
  }

  .dvwpwM input:-ms-input-placeholder {
    color: #767676;
  }

  .dvwpwM input::placeholder {
    color: #767676;
  }

  data-styled.g14[id="sc-1lfawsc-0"] {
    content: "dvwpwM,";
  }

  .fvriFu {
    display: -webkit-box;
    display: -webkit-flex;
    display: -ms-flexbox;
    display: flex;
  }

  .fvriFu>.StyledAdornment-c11n-8-86-1__sc-1kerx9v-0 {
    -webkit-flex: 0 0 auto;
    -ms-flex: 0 0 auto;
    flex: 0 0 auto;
  }

  .fvriFu>.AdornmentLeft-c11n-8-86-1__sc-1kerx9v-1 {
    -webkit-order: -1;
    -ms-flex-order: -1;
    order: -1;
  }

  .fvriFu>.Input-c11n-8-86-1__sc-4ry0fw-0 {
    min-width: 0;
  }

  .fvriFu>.Input-c11n-8-86-1__sc-4ry0fw-0:-webkit-autofill~.StyledAdornment-c11n-8-86-1__sc-1kerx9v-0 {
    box-shadow: 0 0 0 1000px #e0f2ff inset;
  }

  .fvriFu>.Input-c11n-8-86-1__sc-4ry0fw-0.edge-autofilled~.StyledAdornment-c11n-8-86-1__sc-1kerx9v-0 {
    background-color: #e0f2ff;
  }

  .fvriFu>.Input-c11n-8-86-1__sc-4ry0fw-0:active:not([disabled])~.StyledAdornment-c11n-8-86-1__sc-1kerx9v-0,
  .fvriFu>.Input-c11n-8-86-1__sc-4ry0fw-0:focus~.StyledAdornment-c11n-8-86-1__sc-1kerx9v-0 {
    background-color: #fff;
  }

  .fvriFu>.Input-c11n-8-86-1__sc-4ry0fw-0:hover:not([disabled])~.StyledAdornment-c11n-8-86-1__sc-1kerx9v-0,
  .fvriFu>.Input-c11n-8-86-1__sc-4ry0fw-0:active:not([disabled])~.StyledAdornment-c11n-8-86-1__sc-1kerx9v-0,
  .fvriFu>.Input-c11n-8-86-1__sc-4ry0fw-0:focus~.StyledAdornment-c11n-8-86-1__sc-1kerx9v-0 {
    border-color: #006aff;
  }

  .fvriFu>.Input-c11n-8-86-1__sc-4ry0fw-0:focus {
    box-shadow: none;
  }

  .fvriFu>.Input-c11n-8-86-1__sc-4ry0fw-0:focus:-webkit-autofill {
    box-shadow: 0 0 0 1000px #e0f2ff inset;
  }

  .fvriFu>.Input-c11n-8-86-1__sc-4ry0fw-0[disabled]~.StyledAdornment-c11n-8-86-1__sc-1kerx9v-0 {
    cursor: default;
    opacity: 0.4;
  }

  .fvriFu>.Input-c11n-8-86-1__sc-4ry0fw-0[disabled]~.StyledAdornment-c11n-8-86-1__sc-1kerx9v-0,
  .fvriFu>.Input-c11n-8-86-1__sc-4ry0fw-0[disabled]~.StyledAdornment-c11n-8-86-1__sc-1kerx9v-0:hover,
  .fvriFu>.Input-c11n-8-86-1__sc-4ry0fw-0[disabled]~.StyledAdornment-c11n-8-86-1__sc-1kerx9v-0:active,
  .fvriFu>.Input-c11n-8-86-1__sc-4ry0fw-0[disabled]~.StyledAdornment-c11n-8-86-1__sc-1kerx9v-0:focus {
    background-color: #f6f6fa;
    border-color: #d1d1d5;
  }

  .fvriFu>.Input-c11n-8-86-1__sc-4ry0fw-0[readonly]~.StyledAdornment-c11n-8-86-1__sc-1kerx9v-0,
  .fvriFu>.Input-c11n-8-86-1__sc-4ry0fw-0[readonly]:hover~.StyledAdornment-c11n-8-86-1__sc-1kerx9v-0,
  .fvriFu>.Input-c11n-8-86-1__sc-4ry0fw-0[readonly]:active~.StyledAdornment-c11n-8-86-1__sc-1kerx9v-0,
  .fvriFu>.Input-c11n-8-86-1__sc-4ry0fw-0[readonly]:focus~.StyledAdornment-c11n-8-86-1__sc-1kerx9v-0 {
    background-color: transparent;
    border-color: transparent;
  }

  .fvriFu:focus-within {
    border-radius: 4px;
    box-shadow: 0 0 0px 1px #fff, 0 0 2px 3px #a6e5ff, 0 0 2px 4px #006aff;
  }

  .fvriFu>.Input-c11n-8-86-1__sc-4ry0fw-0 {
    padding-right: 0;
    border-right: 0;
    border-top-right-radius: 0;
    border-bottom-right-radius: 0;
  }

  .gPUkQT {
    box-shadow: 0 0 18px rgba(0, 0, 0, 0.1);
  }

  .gPUkQT>.Input-c11n-8-86-1__sc-4ry0fw-0,
  .gPUkQT>.StyledAdornment-c11n-8-86-1__sc-1kerx9v-0 {
    color: #2a2a33;
    -webkit-font-smoothing: antialiased;
    -moz-osx-font-smoothing: grayscale;
    text-transform: none;
    font-family: "Open Sans", "Adjusted Arial", Tahoma, Geneva, sans-serif;
    font-weight: 700;
    font-size: 16px;
    line-height: 24px;
    padding-top: 17px;
    padding-bottom: 17px;
    line-height: 24px;
    height: auto;
  }

  .gPUkQT .Icon-c11n-8-86-1__sc-13llmml-0 {
    color: #54545a;
    height: 16px;
    width: 16px;
  }

  @media (min-width: 481px) {
    .gPUkQT {
      box-shadow: 0 0 18px rgba(0, 0, 0, 0.1);
    }

    .gPUkQT>.Input-c11n-8-86-1__sc-4ry0fw-0,
    .gPUkQT>.StyledAdornment-c11n-8-86-1__sc-1kerx9v-0 {
      color: #2a2a33;
      -webkit-font-smoothing: antialiased;
      -moz-osx-font-smoothing: grayscale;
      text-transform: none;
      font-family: "Open Sans", "Adjusted Arial", Tahoma, Geneva, sans-serif;
      font-weight: 700;
      font-size: 16px;
      line-height: 24px;
      padding-top: 22px;
      padding-bottom: 22px;
      line-height: 24px;
      height: auto;
    }

    .gPUkQT .Icon-c11n-8-86-1__sc-13llmml-0 {
      color: #54545a;
      height: 22px;
      width: 22px;
    }

    .gPUkQT>.Input-c11n-8-86-1__sc-4ry0fw-0 {
      padding-left: 24px;
    }
  }

  .frrUMP {
    -webkit-appearance: none;
    -moz-appearance: none;
    appearance: none;
    width: 100%;
    margin: 0;
    padding-left: 16px;
    padding-right: 16px;
    background-color: #f6f6fa;
    border: 1px solid;
    border-color: #d1d1d5;
    border-radius: 4px;
    box-sizing: border-box;
    caret-color: #006aff;
    cursor: text;
    outline: none;
    box-shadow: none;
    outline: none;
    box-shadow: none;
    color: #2a2a33;
    -webkit-font-smoothing: antialiased;
    -moz-osx-font-smoothing: grayscale;
    text-transform: none;
    font-family: "Open Sans", "Adjusted Arial", Tahoma, Geneva, sans-serif;
    font-weight: 400;
    font-size: 16px;
    line-height: 24px;
    padding-top: 9px;
    padding-bottom: 9px;
    line-height: 24px;
    height: auto;
  }

  .frrUMP[disabled] {
    background-color: #f6f6fa;
    border-color: #d1d1d5;
    color: #2a2a33;
  }

  .frrUMP::-webkit-input-placeholder {
    color: #596b82;
  }

  .frrUMP::-moz-placeholder {
    color: #596b82;
  }

  .frrUMP:-ms-input-placeholder {
    color: #596b82;
  }

  .frrUMP::placeholder {
    color: #596b82;
  }

  .frrUMP:-webkit-autofill {
    box-shadow: 0 0 0 1000px #e0f2ff inset;
  }

  .frrUMP.edge-autofilled {
    background-color: #e0f2ff !important;
  }

  .frrUMP:focus-visible {
    box-shadow: 0 0 0px 1px #fff, 0 0 2px 3px #a6e5ff, 0 0 2px 4px #006aff;
  }

  @supports not selector(:focus-visible) {
    .frrUMP:focus {
      box-shadow: 0 0 0px 1px #fff, 0 0 2px 3px #a6e5ff, 0 0 2px 4px #006aff;
    }
  }

  .frrUMP:focus:-webkit-autofill {
    box-shadow: 0 0 0px 1px #fff, 0 0 2px 3px #a6e5ff, 0 0 2px 4px #006aff,
      0 0 0 1000px #e0f2ff inset;
  }

  .frrUMP:active:not([disabled]),
  .frrUMP:focus {
    background-color: #fff;
  }

  .frrUMP:hover:not([disabled]),
  .frrUMP:active:not([disabled]),
  .frrUMP:focus {
    border-color: #006aff;
  }

  .frrUMP[aria-invalid="true"] {
    caret-color: #a3000b;
  }

  .frrUMP[aria-invalid="true"],
  .frrUMP[aria-invalid="true"][disabled],
  .frrUMP[aria-invalid="true"]:hover,
  .frrUMP[aria-invalid="true"]:active,
  .frrUMP[aria-invalid="true"]:focus {
    border-color: #a3000b;
  }

  .frrUMP[disabled] {
    cursor: default;
    opacity: 0.4;
  }

  .frrUMP[readonly] {
    background-color: transparent;
    padding-left: 0;
    padding-right: 0;
  }

  .frrUMP[readonly],
  .frrUMP[readonly]:hover,
  .frrUMP[readonly]:active,
  .frrUMP[readonly]:focus {
    border-color: transparent;
  }

  .ddthKA {
    -webkit-appearance: none;
    -moz-appearance: none;
    appearance: none;
    width: auto;
    margin: 0;
    padding-left: 16px;
    padding-right: 16px;
    background-color: #f6f6fa;
    border: 1px solid;
    border-color: #d1d1d5;
    border-radius: 4px;
    box-sizing: border-box;
    caret-color: #006aff;
    cursor: text;
    outline: none;
    box-shadow: none;
    outline: none;
    box-shadow: none;
    color: #2a2a33;
    -webkit-font-smoothing: antialiased;
    -moz-osx-font-smoothing: grayscale;
    text-transform: none;
    font-family: "Open Sans", "Adjusted Arial", Tahoma, Geneva, sans-serif;
    font-weight: 400;
    font-size: 16px;
    line-height: 24px;
    padding-top: 9px;
    padding-bottom: 9px;
    line-height: 24px;
    height: auto;
    color: #54545a;
    width: auto;
    display: -webkit-inline-box;
    display: -webkit-inline-flex;
    display: -ms-inline-flexbox;
    display: inline-flex;
    -webkit-align-items: center;
    -webkit-box-align: center;
    -ms-flex-align: center;
    align-items: center;
    -webkit-user-select: none;
    -moz-user-select: none;
    -ms-user-select: none;
    user-select: none;
  }

  .ddthKA[disabled] {
    background-color: #f6f6fa;
    border-color: #d1d1d5;
    color: #2a2a33;
  }

  .ddthKA::-webkit-input-placeholder {
    color: #596b82;
  }

  .ddthKA::-moz-placeholder {
    color: #596b82;
  }

  .ddthKA:-ms-input-placeholder {
    color: #596b82;
  }

  .ddthKA::placeholder {
    color: #596b82;
  }

  .ddthKA:-webkit-autofill {
    box-shadow: 0 0 0 1000px #e0f2ff inset;
  }

  .ddthKA.edge-autofilled {
    background-color: #e0f2ff !important;
  }

  .ddthKA:focus-visible {
    box-shadow: 0 0 0px 1px #fff, 0 0 2px 3px #a6e5ff, 0 0 2px 4px #006aff;
  }

  @supports not selector(:focus-visible) {
    .ddthKA:focus {
      box-shadow: 0 0 0px 1px #fff, 0 0 2px 3px #a6e5ff, 0 0 2px 4px #006aff;
    }
  }

  .ddthKA:focus:-webkit-autofill {
    box-shadow: 0 0 0px 1px #fff, 0 0 2px 3px #a6e5ff, 0 0 2px 4px #006aff,
      0 0 0 1000px #e0f2ff inset;
  }

  .ddthKA:active:not([disabled]),
  .ddthKA:focus {
    background-color: #fff;
  }

  .ddthKA:hover:not([disabled]),
  .ddthKA:active:not([disabled]),
  .ddthKA:focus {
    border-color: #006aff;
  }

  .ddthKA[aria-invalid="true"] {
    caret-color: #a3000b;
  }

  .ddthKA[aria-invalid="true"],
  .ddthKA[aria-invalid="true"][disabled],
  .ddthKA[aria-invalid="true"]:hover,
  .ddthKA[aria-invalid="true"]:active,
  .ddthKA[aria-invalid="true"]:focus {
    border-color: #a3000b;
  }

  .ddthKA[disabled] {
    cursor: default;
    opacity: 0.4;
  }

  .ddthKA[readonly] {
    background-color: transparent;
    padding-left: 0;
    padding-right: 0;
  }

  .ddthKA[readonly],
  .ddthKA[readonly]:hover,
  .ddthKA[readonly]:active,
  .ddthKA[readonly]:focus {
    border-color: transparent;
  }

  .ddthKA[disabled] {
    color: #54545a;
  }

  .fspXPt {
    border: none;
    background: transparent;
    padding: unset;
  }

  .ecdnJo {
    border-top-left-radius: 0;
    border-bottom-left-radius: 0;
    border-left: 0;
  }

  data-styled.g11[id="AdornmentRight-c11n-8-86-1__sc-1kerx9v-2"] {
    content: "ecdnJo,";
  }

  .select2-search__field {
    padding-left: 5px !important;
  }

  #navigation.style-2.cloned,
  #header.cloned.sticky {
    opacity: 1;
    visibility: visible;
    transform: translate(0, 0) scale(1);
    transition: 0.3s;
    margin-top: 0px;
  }
</style>

<script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>

<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js" integrity="sha256-VazP97ZCwtekAsvgPBSUwPFKdrwD3unUfSGVYrahUqU=" crossorigin="anonymous"></script>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.5/css/select2.min.css" />


<div class="homepage-9 hp-6 homepage-1 mh" style="position: relative;">
  <div id="wrapper">
    <header id="header-container" class="header head-tr zillow-header">
      <div id="header" style="padding: 0px;height: 80px;">
        <div id="logo" style="position: absolute;width: 100%;text-align: center;">
          <a href="/page/home"><img style="width:175px;margin-top: -5px;" src="/theme/zillow/assets/images/logosabbianco.png" data-sticky-logo="/theme/zillow/assets/images/logosabbianco.png" alt=""></a>
        </div>
        <div class="container container-header">
          <div class="left-side">
            <div class="mmenu-trigger">
              <button class="hamburger hamburger--collapse" type="button">
                <span class="hamburger-box">
                  <span class="hamburger-inner"></span>
                </span>
              </button>
            </div>
            <nav id="navigation" class="style-1 head-tr">
              <ul name="menuResponsive" class="menu_style">
                <?php
                foreach ($menu_response as $menu) {
                  if ($menu->parent_id == null) {
                    $sub_children_menu = [];
                    foreach ($menu_response as $submenu) {
                      if ($submenu->parent_id == $menu->id) {
                        $sub_children_menu[] = $submenu;
                      }
                    }
                    echo '<li><a href="' . $menu->value . '">' . $menu->name . '</a>';
                    if (count($sub_children_menu) > 0) {
                      echo '<ul>';
                      foreach ($sub_children_menu as $submenu) {
                        echo '<li><a href="' . $submenu->value . '">' . $submenu->name . '</a></li>';
                      }
                      echo '</ul>';
                    }

                    echo '</li>';
                  }
                }
                ?>
              </ul>
            </nav>
          </div>

          <?php if ($email != '') { ?>
            <div class="header-user-menu user-menu add">
              <div class="header-user-name" style="font-size: 20px;">
                <!-- <a href="/page/profile"> -->

                Hi, <?php echo $name; ?>
                <!-- </a> -->
              </div>
              <ul>
                <?php if ($user_role == "sales_people") { ?>
                  <li>
                    <a href="/page/salesequest-pendingappproval">Sale Requests</a>
                  </li>
                  <li>
                    <a href="/page/salesequest-open">SalesRequests List</a>
                  </li>
                <?php } ?>

                <li>
                  <a href="/page/profile">Profile</a>
                </li>
                <li>
                  <a href="/page/my-listings">My Properties</a>
                </li>
                <li>
                  <a href="/page/favorited">Favorited Properties</a>
                </li>
                <li>
                  <a class="active" href="/page/add-listings">Add Property</a>
                </li>
                <li>
                  <a href="/page/changepassword">Change Password</a>
                </li>
                <li>
                  <a onclick="signOut()">Log Out</a>
                </li>
              </ul>
            </div>
          <?php
          } else {
          ?>
            <!-- Right Side Content / End -->

            <span id="headerlogindiv">
              <div class="right-side d-none d-none d-lg-none d-xl-flex sign ml-0">
                <!-- Header Widget -->
                <div class="header-widget sign-in">
                  <div class="show-reg-form"><a style="cursor: pointer;" onclick="loginIn()">Sign In</a></div>
                </div>
                <div class="header-widget sign-in">
                  <div class="show-reg-form"><a style="cursor: pointer;" onclick="signUp()">Sign Up</a></div>
                </div>
                <!-- Header Widget / End -->
              </div>
            </span>
            <!-- Right Side Content / End -->
          <?php
          }
          ?>
          <div class="header-user-menu user-menu add d-none d-lg-none d-xl-flex">
            <div class="lang-wrap" name="activeLangContent">

            </div>
          </div>
        </div>
      </div>
    </header>
    <div id="hero-area" style="background-image: url('https://www.zillowstatic.com/bedrock/app/uploads/sites/5/2023/07/1920w_nationalbrand.webp');background-repeat: no-repeat;background-size: inherit;width: 100%;height: 488px;z-index: 0;top: 0px;left: 0px;" class="parallax-searchs home15 overlay thome-7" data-stellar-background-ratio="0.5">
      <div class="hero-main" style="height: 100%;width: 100%;display: flex;justify-content: center;align-items: center;">
        <div>
          <div>
            <h1 class="bannerTitle">Discover your dream property</h1>
          </div>
          <div id="search-bar">
            <div class="row">
              <!-- Dropdown Button -->
              <div class="col-auto d-flex align-items-center">
                <div class="dropdown">
                  <select class="form-control" id="propertyStatusDropdown">
                    <option value="2">For Sale</option>
                    <option value="1">For Rent</option>
                  </select>
                </div>
              </div>
              <!-- Select2 Control -->
              <div class="col">
                <select class="form-control select2" id="search-box-input" onkeypress="search_text();" multiple="multiple"></select>
              </div>
            </div>
            <div style="margin-top:40px; text-align:right">
              <button id="searchButton" class="btn btn-primary">Search</button>
            </div>
            <!-- Show Map Button -->
            <div style="margin-top:40px; text-align:right">
              <a href="/page/listings?view=map&_r" style="padding: 10px 20px 10px 20px;background: #398a39;border-radius: 5px;cursor: pointer;color:white !important; margin-bottom:10px;" id="showMapListingListingMap">Show Map</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
</div>
<!-- <select class="form-control select2" multiple="multiple" style="width: 100%;"></select> -->

<script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>

<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js" integrity="sha256-VazP97ZCwtekAsvgPBSUwPFKdrwD3unUfSGVYrahUqU=" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.5/js/select2.full.min.js"></script>

<script>
   $('.select2').select2({
      maximumSelectionLength: 10,
      tokenSeparators: [',', ' '],
      placeholder: "Select or type keywords",
      minimumInputLength: 1,
      ajax: {
        url: "/api/getLocationSearch",
        type: 'POST',
        dataType: 'json',
        delay: 250,
        data: function(params) {
          var dataToSend = {
            data: params.term
          };
          console.log(dataToSend);
          return JSON.stringify(dataToSend);
        },

        processResults: function(data) {
          return {
            results: data.map(item => {
              return {
                id: item.id,
                text: item.name + ' (' + item.type + ')',
                type: item.type
              };
            })
          };
        },
        cache: true,
        contentType: "application/json",
        error: function(jqXHR, textStatus, errorThrown) {
          console.error('AJAX error: ' + textStatus + ', ' + errorThrown);
        }
      }
    });
  $(document).ready(function() {

   

    $('#searchButton').click(function() {
      var selectedData = $('#search-box-input').select2('data');
      var propertyStatus = $('#propertyStatusDropdown').val();

      var districtIds = [],
        municipalityIds = [],
        locationIds = [];

      selectedData.forEach(function(item) {
        switch (item.type) {
          case "District":
            districtIds.push(item.id);
            break;
          case "Municipality":
            municipalityIds.push(item.id);
            break;
          case "Location":
            locationIds.push(item.id);
            break;
        }
      });

      // Construct the URL
      var url = "/page/listings?";
      if (districtIds.length > 0) {
        url += "district=" + districtIds.join(',') + "&";
      }
      if (municipalityIds.length > 0) {
        url += "municipality=" + municipalityIds.join(',') + "&";
      }
      if (locationIds.length > 0) {
        url += "location=" + locationIds.join(',') + "&";
      }
      if (propertyStatus !== "") {
        url += "property_status=" + propertyStatus + "&";
      }

      // Remove the last '&' or '?' from the URL
      url = url.slice(0, -1);

      window.location.href = url;
    });
  });

</script>