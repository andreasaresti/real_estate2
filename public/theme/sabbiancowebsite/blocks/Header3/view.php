<?php

use App\Helpers\Helper;

    if(isset($_SESSION["user_id"])){
        $user_id = $_SESSION["user_id"];
    }else{
        $user_id = "";
    }

    if(isset($_SESSION["email"])){
        $email = $_SESSION["email"];
    }else{
        $email = "";
    }
    if(isset($_SESSION["user_image"])){
        $user_image = $_SESSION["user_image"];
    }else{
        $user_image = "";
    }
    if(isset($_SESSION["name"])){
        $name = $_SESSION["name"];
    }else{
        $name = "";
    }

    $active_district_response = Helper::get_active_district();       
    $active_district_response = json_decode($active_district_response);

    $active_municipality_response = Helper::get_active_municipality();       
    $active_municipality_response = json_decode($active_municipality_response);

    $active_location_response = Helper::get_active_location();       
    $active_location_response = json_decode($active_location_response);

    $active_features_response = Helper::get_active_features();       
    $active_features_response = json_decode($active_features_response);
    $active_features = $active_features_response->data;

    $active_listing_types_response = Helper::get_active_listing_types();       
    $active_listing_types_response = json_decode($active_listing_types_response);

    $active_listing_types_response = Helper::get_active_listing_types();       
    $active_listing_types_response = json_decode($active_listing_types_response);

    $active_property_types_response = Helper::get_active_property_types();       
    $active_property_types_response = json_decode($active_property_types_response);

    // echo '<pre>';
    // print_r($active_property_types_response);
    // echo '</pre>';

    $postData = [
        'slug'=>"menu",
        'locale'=>"en_US",
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
        display:block;
    }
    @media only screen and (max-width: 1024px){
        .parallax-searchs.home15 .hero-inner {
            padding: 0px 0;
        }
    }
    .parallax-searchs.home15 .hero-inner {
        text-align: center;
        padding: 150px 0;
    }
    .parallax-searchs.thome-1 {
        background: -webkit-gradient(linear, left top, left bottom, from(rgba(0, 0, 0, 0.3)), to(rgba(0, 0, 0, 0.3))), url(<?php echo $block->setting('backgroundimage'); ?>) cover center top !important;background-size: cover !important;
        background: linear-gradient(rgba(0, 0, 0, 0.3), rgba(0, 0, 0, 0.3)), url(<?php echo $block->setting('backgroundimage'); ?>) cover center top !important;background-size: cover !important;
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
        display:none;
        z-index:1000;
    }
    @media only screen and (max-width: 450px){
        .hp-6 .rld-single-select {
            width: auto;
        } 
    }


</style>
<!-- <div id="sideBar">
    <div id="showmapbutton" class="col-xl-12 xsRow" style="z-index:1000;background:green; color:white;display: flex;justify-content: space-around;align-items: center;padding: 0px;">
        <a  class="btn btn-map" onclick="alert('hi');show_map();" style="margin-right:5px;">Show Map</a>
    </div>
    <div id="showlistingbutton" class="col-xl-12 xsRow" style="z-index:1000;background:green; color:white;display: flex;justify-content: space-around;align-items: center;padding: 0px;">
        <a  class="btn btn-map" onclick="show_map();" style="margin-right:5px;">Show Listing</a>
    </div>
</div> -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="sha512-9usAa10IRO0HhonpyAIVpjrylPvoDwiPUiKdWk5t3PyolY1cOd4DSE0Ga+ri4AuTroPR5aQvXU9xC6qOPnzFeg==" crossorigin="anonymous" referrerpolicy="no-referrer" />

<div class="homepage-9 hp-6 homepage-1 mh" style="z-index: 9999;position: relative;">
    <div id="wrapper">
        <header id="header-container" class="header head-tr">
            <div id="header" class="head-tr bottom">
                <div id="logo" style="position: absolute;width: 100%;text-align: center;">
                    <a href="/page/home"><img src="/theme/sabbiancowebsite/assets/images/logosabbianco.png" data-sticky-logo="/theme/sabbiancowebsite/assets/images/logosabbianco.png" alt=""></a>
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
                                foreach($menu_response as $menu){
                                    if($menu->parent_id == null){
                                        $sub_children_menu = []; 
                                        foreach($menu_response as $submenu){
                                            if($submenu->parent_id == $menu->id){
                                                $sub_children_menu[] = $submenu; 
                                            }
                                        }
                                        echo '<li><a href="'.$menu->value.'">'.$menu->name.'</a>';
                                        if(count($sub_children_menu) > 0){
                                            echo '<ul>';
                                            foreach($sub_children_menu as $submenu){
                                                echo '<li><a href="'.$submenu->value.'">'.$submenu->name.'</a></li>';
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
                    <div class="right-side d-none d-lg-none d-xl-flex">
                        <!-- Header Widget -->
                        <div class="header-widget">
                            <a onclick="showAddListingHeader3();" class="button border">Add Listing<i class="fas fa-laptop-house ml-2"></i></a>
                        </div>
                        <!-- Header Widget / End -->
                    </div>
                    <?php if($email != ''){?>
                    <div class="header-user-menu user-menu add">
                        <div class="header-user-name-white">
                            <!-- <a href="/page/profile"> -->
                            
                            Hi, <?php echo $name; ?>
                            <!-- </a> -->
                        </div>
                        <ul>
                                <li>
                                    <a href="/page/salesequest-pendingappproval">Sale Requests</a>
                                </li>
                                <li>
                                    <a href="/page/salesequest-open">SalesRequests List</a>
                                </li>
                            <?php //}?>

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
                                <a class="active"  href="/page/add-listings">Add Property</a>
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
                    }else{
                    ?>
                    <!-- Right Side Content / End -->

                    <span  id="headerlogindiv">
                        <div class="right-side d-none d-none d-lg-none d-xl-flex sign ml-0" >
                            <!-- Header Widget -->
                            <div class="header-widget sign-in">
                                <div class="show-reg-form" ><a style="cursor: pointer;" onclick="loginIn()">Sign In</a></div>
                            </div>
                            <div class="header-widget sign-in">
                                <div class="show-reg-form" ><a style="cursor: pointer;" onclick="signUp()">Sign Up</a></div>
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
        <div class="clearfix"></div>
        <section id="hero-area" style="height:auto;" class="parallax-searchs home15 overlay thome-7 thome-1" data-stellar-background-ratio="0.5">
            <div class="hero-main">
                <div class="container">
                    <div class="row">
                        <div class="col-12">
                            <div class="hero-inner">
                                    <div class="col-12">
                                        <div class="banner-search-wrap">
                                            <div class="tab-content">
                                                <div class="tab-pane fade show active" id="tabs_1">
                                                    <div class="rld-main-search" style="display: flex;justify-content: center;margin-right:0px">
                                                        <div class="row">
                                                            <div class="rld-single-input">
                                                                <input type="text" placeholder="PropertyID" autocomplete="off" id="search_string">
                                                            </div>
                                                            <div class="rld-single-input"   onmouseover="hiddenAdvancedDivHeader3();">
                                                                <select class="single-select"  id="property_type" style="width:100%; margin-right: 10px!important;">
                                                                    <option value="">Sale/Rent</option>
                                                                    <?php 
                                                                    foreach($active_property_types_response->data as $property_type){
                                                                        echo '<option value="'.$property_type->id.'">'.$property_type->displayname.'</option>';
                                                                    }
                                                                    ?>
                                                                </select>
                                                            </div>
                                                            <div class="rld-single-input"   onmouseover="hiddenAdvancedDivHeader3();">
                                                                <input type="hidden" id="selActivePropertType" name="selActivePropertType" value="">
                                                                <nav id="navigation" class="style-1" style="background: white; margin-top:0px;margin-left: 5px!important;margin-right: 5px;border: 1px solid;border-radius: 5px;border-color: #ebebeb; max-width:100%">
                                                                    <ul>
                                                                        <li ><a>Property Type</a>
                                                                            <ul id="activePropertType">
                                                                                <?php
                                                                                foreach($active_listing_types_response->data as $listing_type){
                                                                                    echo '<li><a><input type="checkbox" style="width: auto;height: auto;" class="propertTypes" name="property_types[]" value="'.$listing_type->id.'" id="propertTypes'.$listing_type->id.'">'.$listing_type->displayname.'</a></li>';
                                                                                }
                                                                                ?>
                                                                            
                                                                            </ul>
                                                                        </li>
                                                                    </ul>
                                                                </nav>
                                                            </div>
                                                            <div class="rld-single-select" style="margin-bottom: 15px"  onmouseover="hiddenAdvancedDivHeader3();">
                                                                <input type="hidden" id="selLocation" name="selLocation" value="">
                                                                <nav id="navigation" class="style-1" style="background: white; margin-top:0px;margin-left: 5px!important;margin-right: 5px;border: 1px solid;border-radius: 5px;border-color: #ebebeb;">
                                                                    <ul>
                                                                        <li ><a id="location_title">Location</a>
                                                                            <ul id="activelocation">
                                                                                <?php
                                                                                    foreach($active_district_response->data as $district){
                                                                                        echo '<li class="parent locationLi">
                                                                                                <a><input type="checkbox" id="districts'.$district->id.'" class="district" name="district[]" value="'.$district->id.'" onchange="changeLocationsHeader3(\'districts\',\''.$district->id.'\',\''.$district->displayname.'\')">'.$district->displayname.' </a>
                                                                                                <div class="wrapper" style="top: 0px; left: 208px;">
                                                                                                    <ul style="transform:none;position:initial; visibility: visible;opacity: 100; overflow-x: hidden; overflow-y: auto; max-height: 500px;" id="subDistricts'.$district->id.'">';
                                                                                                        foreach($active_municipality_response->data as $municipality){
                                                                                                            if($district->id == $municipality->district_id){
                                                                                                                echo '<li class="parent locationLi">
                                                                                                                    <a><input type="checkbox" id="municipalities'.$municipality->id.'" class="municipality" name="municipality[]" value="'.$municipality->id.'" onchange="changeLocationsHeader3(\'municipalities\',\''.$municipality->id.'\',\''.$municipality->displayname.'\')">'.$municipality->displayname.'</a>
                                                                                                                    <div class="wrapper">
                                                                                                                        <ul style="visibility: visible;opacity: 100;" id="subMunicipalities'.$municipality->id.'">';
                                                                                                                        foreach($active_location_response->data as $location){
                                                                                                                            if($location->municipality_id == $municipality->id){
                                                                                                                                echo '<li>
                                                                                                                                    <a>
                                                                                                                                    <input type="checkbox" id="locations'.$location->id.'" class="location" name="location[]" value="'.$location->id.'" onchange="changeLocationsHeader3(\'locations',''.$location->id.'',''.$location->displayname.'\')">'.$location->displayname.'</a>
                                                                                                                                </li>';
                                                                                                                            }
                                                                                                                        }
                                                                                                                        echo '</ul>
                                                                                                                    </div>
                                                                                                                </li>';
                                                                                                            }                                                                                                    
                                                                                                        }                                                                                                
                                                                                                    echo '</ul>
                                                                                                </div>
                                                                                            </li>';
                                                                                    }
                                                                                ?>
                                                                            
                                                                            </ul>
                                                                        </li>
                                                                    </ul>
                                                                </nav>
                                                            </div>
                                                            <div class="dropdown-filter"><span></span></div>
                                                            <div class="col-xl-2 col-lg-2 col-md-4 pl-0">
                                                                <a class="btn btn-yellow" onclick="searchNowHeader3([0,0],0,9);">Search Now</a>
                                                            </div>
                                                            <div id="advancedSearch" class="explore__form-checkbox-list full-filter">
                                                                <div class="row">
                                                                    
                                                                    <div class="col-lg-4 col-md-6 py-1 pr-30 pl-0 ">
                                                                        <!-- Form Bedrooms -->
                                                                        <div class="form-group beds" style="display: flex;"  id="searchFormBedrooms">
                                                                            <i class="fa fa-bed" aria-hidden="true" style="align-self: center;width: 20px;"></i>
                                                                            <select class="select single-select"  id="selBedrooms">
                                                                                <option value="0">Bedrooms</option>
                                                                                <?php for($i= 1; $i<=10; $i++)
                                                                                {
                                                                                ?>
                                                                                <option value="<?php echo $i;?>"><?php echo $i;?></option>
                                                                                <?php
                                                                                }
                                                                                ?>
                                                                            </select>
                                                                        </div>
                                                                        <!--/ End Form Bedrooms -->
                                                                    </div>
                                                                    <div class="col-lg-4 col-md-6 py-1 pr-30 pl-0">
                                                                        <!-- Form Bathrooms -->
                                                                        <div class="form-group bath" style="display: flex;" id="searchFormBathrooms">
                                                                            <i class="fa fa-bath" aria-hidden="true" style="align-self: center;width: 20px;"></i>
                                                                            <select class="select single-select" id="selBathrooms">
                                                                                <option value="0">Bathrooms</option>
                                                                                <?php for($i= 1; $i<=10; $i++)
                                                                                {
                                                                                ?>
                                                                                <option value="<?php echo $i;?>"><?php echo $i;?></option>
                                                                                <?php
                                                                                }
                                                                                ?>
                                                                            </select>
                                                                            
                                                                        </div>
                                                                        <!--/ End Form Bathrooms -->
                                                                    </div>
                                                                    <div class="col-lg-5 col-md-12 col-sm-12 py-1 pr-30 mr-5 sld ">
                                                                        <!-- Price Fields -->
                                                                        <div class="main-search-field-2">
                                                                            <!-- Area Range -->
                                                                            <div class="range-slider">
                                                                                <label>Area Size</label>
                                                                                <div id="area-range" data-min="0" data-max="1300" data-unit="sq meters"></div>
                                                                                <div class="clearfix"></div>
                                                                            </div>
                                                                            <br>
                                                                            <!-- Price Range -->
                                                                            <div class="range-slider">
                                                                                <label>Price Range</label>
                                                                                <div id="price-range" data-min="0" data-max="600000" data-unit="€"></div>
                                                                                <div class="clearfix"></div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-lg-3 col-md-6 col-sm-12 py-1 pr-30 ">
                                                                        <!-- Checkboxes -->
                                                                        <div class="checkboxes one-in-row margin-bottom-10 ch-1" id="activefeaturesLeft">
                                                                            <?php
                                                                            foreach($active_features as $key=>$feature){
                                                                                if($key <= count($active_features) / 2){
                                                                                    echo '<input id="fcheck-'.$key.'" type="checkbox" class="featurecheck" value="'.$feature->id.'" name="features[]"">
                                                                                    <label for="fcheck-'.$key.'" >'.$feature->displayname.'</label>';
                                                                                }
                                                                                
                                                                            }
                                                                            ?>
                                                        
                                                                        </div>
                                                                        <!-- Checkboxes / End -->
                                                                    </div>
                                                                    <div class="col-lg-3 col-md-6 col-sm-12 py-1 pr-30 ">
                                                                        <!-- Checkboxes -->
                                                                        <div class="checkboxes one-in-row margin-bottom-10 ch-1" id="activefeaturesRight">
                                                                        <?php
                                                                            foreach($active_features as $key=>$feature){
                                                                                if($key > count($active_features) / 2){
                                                                                    echo '<input id="fcheck-'.$key.'" type="checkbox" class="featurecheck" value = "'.$feature->id.'">
                                                                                    <label for="fcheck-'.$key.'">'.$feature->displayname.'</label>';
                                                                                }
                                                                            }
                                                                            ?>
                                                                        </div>
                                                                        <!-- Checkboxes / End -->
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!--/ End Search Form -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>

<div id="searchcontentdiv" style="display:none; padding-top:20px">
    <div class="inner-pages homepage-4 agents hp-6 full hd-white">
        <section class="properties-right featured portfolio blog  mp-1">
            <div class="container-fluid">
                <div class="row">
                    <div id="MapHeader3" class="col-lg-6 col-md-6 mt-0">
                        <div class="alert-box success" id="map_success" style="position: absolute;z-index: 9;width: 100%;margin-top: 80px;">Click on the map to select center and radius</div>
                        <div class="row" style="padding: 25px 0px 0px 0px;position: absolute;z-index: 9;width: 50%;left: 50%;">
                            <div class="col-xl-12 xsRow" style="display: flex;justify-content: flex-end;margin-right: 10px;">
                                <a style="display: none;justify-content: center;align-items: center;margin-right:20px;" class="btn btn-map" id="redrawCircleHeader3" onclick="redrawCircleHeader3();" >Re-draw</a>
                                <a style="display: flex;justify-content: center;align-items: center;" class="btn btn-map" id="showCircleHeader3" onclick="showCircleHeader3();" >Draw</a>
                            </div>
                        </div>
                        <div id="map-leaflet" style="height:100vh"></div>
                    </div>
                    <div id="ListingHeader3" class="col-lg-6 col-md-12 " style="padding-left:20px">
                        <section class="headings-2 pt-0">
                            <div class="pro-wrapper">
                                <div class="detail-wrapper-body">
                                    <div class="listing-title-bar">
                                        <div class="text-heading text-left">
                                            <p class="font-weight-bold mb-0 mt-3" id="page_count"></p>                        
                                        </div>
                                    </div>
                                </div>
                                <div class="cod-pad single detail-wrapper mr-2 mt-0 d-flex justify-content-md-end align-items-center">
                                    <div class="input-group border rounded input-group-lg w-auto mr-4">
                                        <select class="form-control border-0 bg-transparent shadow-none p-0 selectpicker sortby"  id="paginSize" onchange="loadActiveListingsHeader3([0,0],0,9)" name="paginSize">
                                            <option selected value="20">20</option>
                                            <option value="40">40</option>
                                            <option value="60">60</option>
                                            <option value="80">80</option>
                                        </select>
                                    </div>
                                    <div class="input-group border rounded input-group-lg w-auto mr-4">
                                        <label class="input-group-text bg-transparent border-0 text-uppercase letter-spacing-093 pr-1 pl-3" for="inputGroupSelect01"><i class="fas fa-align-left fs-16 pr-2"></i>Sortby:</label>
                                        <select class="form-control border-0 bg-transparent shadow-none p-0 selectpicker sortby"  onchange="loadActiveListingsHeader3([0,0],0,9)"  data-style="bg-transparent border-0 font-weight-600 btn-lg pl-0 pr-3" id="sortby" name="sortby">
                                            <option value="1">Latest</option>
                                            <option value="2">Price(low to high)</option>
                                            <option value="3">Price(high to low)</option>
                                        </select>
                                    </div>
                                
                                </div>
                            </div>
                        </section>
                        <div class="row" id="ListingListContent">
                            
                        </div>
                        <nav aria-label="..." style="padding: 20px;display: flex;justify-content: center;">
                            <ul class="pagination mt-0" id="pagin_content">
                            </ul>
                        </nav>
                    </div>
                    <div class="ViewListMap">
                        <a onclick="replaceview();" style="padding: 10px 20px 10px 20px;background: #E0F2FF;border-radius: 5px;cursor: pointer;" id="showMapListingHeader3">Show Listings</a>
                    </div>
                </div>
                <input type="hidden" id="page_index" value="1">
            </div>
        </section>
    </div>
</div>


<script type="text/javascript">
    

    loadLangHeader3();

    var map = null;
    var circle;
    var viewCircleFlag = 0;

    var desktop = 1;

    // var newScreenWidth = $(window).width();

    // if(newScreenWidth < 700){
    //     desktop = 0;
    //     show_mobile_view();
    // }

    // function show_list(){
    //     $('#mapdiv').hide();
    //     $('#listingsdiv').show();
    // }
    // function show_map(){
    //     alert('here');
    //     $('#mapdiv').show();
    //     $('#listingsdiv').hide();
    // }
    function show_mobile_view(){
        $('#mapdiv').hide();
        $('#listingsdiv').show();
        $('#showlistbutton').show();        
        $('#showmapbutton').show();  
        $('#sideBar').show();  
    }
    function show_desktop_view(){
        $('#mapdiv').show();
        $('#listingsdiv').show();        
        $('#showlistbutton').hide();        
        $('#showmapbutton').hide();        
        $('#sideBar').hide();        
    }

    $(document).ready(function() {
      $(window).scroll(function() {
        $('#showmapbutton').css('top', '90vh');
        $('#showlistbutton').css('top', '90vh');
      });
    });

    $(window).resize(function() {
        var newScreenWidth = $(window).width();
        if(newScreenWidth < 700 && desktop == 1){
            desktop = 0;
            show_mobile_view();
        }
        else if(newScreenWidth >= 700 && desktop == 0){
            desktop = 1;
            show_desktop_view();
        }
    
    // Perform any other actions with the newScreenWidth value
    });

    function loadLangHeader3(){
        data = {
            "slug":"menu",
            "locale":"en_US",
        }
		const url = "/api/getlanguages";
		let xhr = new XMLHttpRequest();
		xhr.open('POST', url, true);
		xhr.setRequestHeader('Content-type', 'application/json');
		xhr.send(JSON.stringify(data));
		xhr.onload = function () {
			list = JSON.parse(xhr.response);
            var temp ="";
            if(list.length>1){
                temp = `<div class="show-lang"><span><i class="fas fa-globe-americas"></i><strong name="activeLang">`+list[0].name+`</strong></span><i class="fa fa-caret-down arrlan"></i></div>
                            <ul class="lang-tooltip lang-action no-list-style" name="activeLangList">`;
                for(i=0;i<list.length;i++){
                    temp += `<li><a style="color: black;" onclick="changeLangHeader3('`+list[i].name+`')">`+list[i].name+`</a></li>`;
                }
                temp += `</ul>`;
            }
            document.getElementsByName("activeLangContent")[0].innerHTML = temp;
            document.getElementsByName("activeLangContent")[1].innerHTML = temp;
            //document.getElementById("").innerHTML = temp;
		}
	}
    function changeLangHeader3(data){
        document.getElementsByName("activeLang")[0].innerHTML = data;
        document.getElementsByName("activeLang")[1].innerHTML = data;
    }
    
    function hiddenAdvancedDivHeader3(){
        document.getElementById('advancedSearch').className = "explore__form-checkbox-list full-filter";
    }
    function changeLocationsHeader3(flag,id,name)
    {
        //insert_location(flag,id,name,"");
        if(flag == "districts"){
            ul = document.getElementById("subDistricts"+id);
            li = ul.getElementsByTagName('li');
            for(i=0;i<li.length;i++){
                input = li[i].getElementsByTagName('input');
                if(input[0].className == "municipality"){
                    document.getElementById("municipalities"+input[0].value).checked = document.getElementById(flag+id).checked;
                }else{
                    document.getElementById("locations"+input[0].value).checked = document.getElementById(flag+id).checked;
                }
            }
        }
        if(flag == "municipalities"){
            ul = document.getElementById("subMunicipalities"+id);
            li = ul.getElementsByTagName('li');
            for(i=0;i<li.length;i++){
                input = li[i].getElementsByTagName('input');
                document.getElementById("locations"+input[0].value).checked = document.getElementById(flag+id).checked;
            }
        }
        
        districts = document.getElementsByClassName('district');
        for(i=0;i<districts.length;i++){
            ul = document.getElementById("subDistricts"+districts[i].value);
            li = ul.getElementsByTagName('li');
            for (j=0; j<li.length; j++) {
                input = li[j].getElementsByTagName('input');
                if (input[0].checked == false) {
                    document.getElementById("districts"+districts[i].value).checked = false;
                }
            }
            municipalities = ul.getElementsByClassName('municipality');
            for (j=0; j<municipalities.length; j++) {
                ul = document.getElementById("subMunicipalities"+municipalities[j].value);
                li = ul.getElementsByTagName('li');
                for (k=0; k<li.length; k++) {
                    input = li[k].getElementsByTagName('input');
                    if (input[0].checked == false) {
                        document.getElementById("municipalities"+municipalities[j].value).checked = false;
                    }
                }
            }
        }
    }
    
    function showAddListingHeader3(){
        user_id = '<?php echo $user_id; ?>';
        if(user_id !== ""){
            window.location.href="/page/add-listings";
        }else{
            loginIn()
        }
	}

    function searchNowHeader3(maker_position,set,zoom){
        console.log(maker_position,set,zoom);
        $('#searchcontentdiv').css("display", "block");
        
        document.getElementById("page_index").value = 1;
        hiddenAdvancedDivHeader3();
        loadActiveListingsHeader3(maker_position,set,zoom);
        showHideMapListingHeader3();
        
	}
    function hiddenAdvancedDivHeader3(){
        document.getElementById('advancedSearch').className = "explore__form-checkbox-list full-filter";
    }
    function loadActiveListingsHeader3(maker_position,set,zoom){
        customer_id = '<?php echo $user_id; ?>';
        if(document.getElementById("selBathrooms").value > 0){
            number_of_bathrooms = document.getElementById("selBathrooms").value;
        }else{
            number_of_bathrooms = "";
        }
        if(document.getElementById("selBedrooms").value > 0){
            number_of_bedrooms = document.getElementById("selBedrooms").value;
        }else{
            number_of_bedrooms = "";
        }
        var tempFeatures = [];
        var features = document.getElementsByClassName('featurecheck');
        for(var j=0; j<features.length;j++){
            if(features[j].checked){
                tempFeatures.push(features[j].value);
            }
        }
        var tempDistrictArr = [];
        var districts = document.getElementsByClassName('district');
        for(var j=0; j<districts.length;j++){
            if(districts[j].checked){
                tempDistrictArr.push(districts[j].value);
            }
        }
        
        var tempMunicipalitiesArr = [];
        var municipalities = document.getElementsByClassName('municipality');
        for(var j=0; j<municipalities.length;j++){
            if(municipalities[j].checked){
                tempMunicipalitiesArr.push(municipalities[j].value);
            }
        }
        var tempLocationArr = [];
        var locations = document.getElementsByClassName('location');
        for(var j=0; j<locations.length;j++){
            if(locations[j].checked){
                tempLocationArr.push(locations[j].value);
            }
        }
        // var tempPropertStatus = [];
        // var propertStatus = document.getElementsByClassName('propertStatus');
        // for(var j=0; j<propertStatus.length;j++){
        //     if(propertStatus[j].checked){
        //         tempPropertStatus.push(propertStatus[j].value);
        //     }
        // }

        var tempPropertStatus = [];
        var propertStatus = $('#property_type').val();
        if(propertStatus != ''){
            tempPropertStatus.push($('#property_type').val());
        }


        var tempPropertTypes = [];
        var propertTypes = document.getElementsByClassName('propertTypes');
        for(var j=0; j<propertTypes.length;j++){
            if(propertTypes[j].checked){
                tempPropertTypes.push(propertTypes[j].value);
            }
        }

        var price1 = 0;
        var size1 = 0;
        var price2 = 600000;
        var size2 = 1300;

        if ($('.first-slider-value').length > 0) {
            var price1 = document.getElementsByClassName("first-slider-value")[1].value;
            var size1 = document.getElementsByClassName("first-slider-value")[0].value;
            size1 = size1.substring(0,size1.length-6);
            price1 = price1.substring(1);
            price1 = price1.replace(",","");
        }
        if ($('.second-slider-value').length > 0) {
            var price2 = document.getElementsByClassName("second-slider-value")[1].value;
            var size2 = document.getElementsByClassName("second-slider-value")[0].value;
            size2 = size2.substring(0,size2.length-6);
            price2 = price2.substring(1);
            price2 = price2.replace(",","");
        }


        if(document.getElementById('search_string').value == ""){
            search_term = "";
        }else{
            search_term = document.getElementById('search_string').value;
        }
        orderbyName = "";
        orderbyType = "";
        switch(document.getElementById("sortby").value){
            case "1":
                orderbyName = "updated_at";
                orderbyType = "desc";
                break;
            case "2":
                orderbyName = "price";
                orderbyType ="asc";
                break;
            case "3":
                orderbyName = "price";
                orderbyType ="desc";
                break;
        }
        const sendData = {
            "number_of_bathrooms": number_of_bathrooms,
            "number_of_bedrooms": number_of_bedrooms,
            "listing_types": tempPropertTypes,
            "features": tempFeatures,
            "min_area_size": parseInt(size1),
            "max_area_size": parseInt(size2),
            "min_price": parseInt(price1),
            "max_price": parseInt(price2),
            "property_type_array": tempPropertStatus,
            "districts": tempDistrictArr,
            "municipalities": tempMunicipalitiesArr,
            "locations": tempLocationArr,
            "search_term": search_term,
            "customer_id": customer_id,
            "page": document.getElementById("page_index").value,
            "per_page":document.getElementById("paginSize").value,
            "orderbyName": orderbyName,
            "orderbyType": orderbyType,
            "radius":maker_position,
            "set":set,
            "retrieve_markers":1
        };
        const url = "/api/activelistings";
		let xhr = new XMLHttpRequest();
		xhr.open('POST', url, true);
		xhr.setRequestHeader('Content-type', 'application/json');
		xhr.send(JSON.stringify(sendData));
		xhr.onload = function () {
            if(document.getElementById("page_index").value == 1){
                markers = JSON.parse(xhr.response).listing_markers;
                var markersArray = [];
                for(i= 0; i<markers.length; i++)
                {
                    if(markers[i].center[0]>0){
                        markersArray.push(markers[i]);    
                    }
                }
                map_init_circle(markersArray,maker_position,set,zoom);
            }
            
			list = JSON.parse(xhr.response).items.data;
			// list = list.data;
			totalrecords = JSON.parse(xhr.response).items.total;
			current_page = JSON.parse(xhr.response).items.current_page;
			per_page = JSON.parse(xhr.response).items.per_page;
            // alrt(total);
            // var valueArray = [];
            var temp ="";
            
            for(i= 0; i<list.length; i++)
            {
                favorite = "";
                if(list[i].in_favoriteproperties == 1){
                    favorite = "color: red;";
                }
                temp +=`<div class="item col-lg-6 col-md-6 col-xs-6 landscapes sale">
                            <div class="project-single">
                                <div class="project-inner project-head">
                                    <div class="homes">
                                        <!-- homes img -->
                                        <a onclick="showListigDetailModal(`+list[i].id+`);" class="homes-img">`;
                if(list[i].featured == true){
                    temp +=`<div class="homes-tag button alt featured">Featured</div>`;
                }
                temp +=`<div class="homes-tag button alt sale">`+list[i].property_type+`</div>
                                            <img src="`+list[i].image+`" alt="home-1" class="img-responsive">
                                        </a>
                                    </div>
                                    <div class="button-effect">
                                        
                                    </div>
                                </div>
                                <!-- homes content -->
                                <div class="homes-content">
                                    <!-- homes address -->
                                    <h3><a onclick="showListigDetailModal(`+list[i].id+`);">`+list[i].displayname+`</a></h3>
                                    <p class="homes-address mb-3">
                                        <a onclick="showListigDetailModal(`+list[i].id+`);">
                                            <i class="fa fa-map-marker"></i><span>`+list[i].location_name+`</span>
                                        </a>
                                    </p>
                                    <!-- homes List -->
                                    <ul class="homes-list clearfix pb-3">`;
                if(list[i].number_of_bedrooms > 0 ){
                    temp +=`<li class="the-icons">
                                <i class="flaticon-bed mr-2" aria-hidden="true"></i>
                                <span>`+list[i].number_of_bedrooms+` Bedrooms</span>
                            </li>`;
                }
                if(list[i].number_of_bathrooms > 0 ){
                    temp +=`<li class="the-icons">
                                <i class="flaticon-bathtub mr-2" aria-hidden="true"></i>
                                <span>`+list[i].number_of_bathrooms+` Bathrooms</span>
                            </li>`;
                }
                if(list[i].area_size > 0 ){
                    temp +=`<li class="the-icons">
                                <i class="flaticon-square mr-2" aria-hidden="true"></i>
                                <span>`+list[i].area_size+` sqm</span>
                            </li>`;
                }
                if(list[i].number_of_garages_or_parkingpaces > 0 ){
                    temp +=`<li class="the-icons">
                                <i class="flaticon-car mr-2" aria-hidden="true"></i>
                                <span>`+list[i].number_of_garages_or_parkingpaces+` Garages</span>
                            </li>`;
                }
                temp +=` </ul>
                        <div class="price-properties pt-3 pb-0">
                            <h3 class="title mt-3">
                                <a onclick="showListigDetailModal(`+list[i].id+`);" tabindex="0">€ `+ list[i].price+`</a>
                            </h3>
                            <div class="compare">
                                <a style="cursor: pointer;" onclick="addFavoritHeader3(`+list[i].id+`)"><i id="faHeart`+list[i].id+`" class="fa fa-heart" style="font-size: x-large; ` + favorite + ` "></i></a>
                            </div>
                        </div></div></div></div>`;
            }
            document.getElementById("ListingListContent").innerHTML = temp;
            document.getElementById("page_count").innerHTML = totalrecords+" Search results"
            if(list.length > 0){
                document.getElementById("ListingListContent").style.height = "auto";
            }else{
                document.getElementById("ListingListContent").style.height = "500px";
            }

            sendData1 = {
                "total": totalrecords,
                "current_page": current_page,
                "per_page": per_page,
            }
            const url1 = "/api/getpagination";
            let xhr1 = new XMLHttpRequest();
            xhr1.open('POST', url1, true);
            xhr1.setRequestHeader('Content-type', 'application/json');
            xhr1.send(JSON.stringify(sendData1));
            xhr1.onload = function () {
                data1 = JSON.parse(xhr1.response);
                list1 = data1.links;
                temp1 = "";                
                if(window.innerWidth > 650){
                    for(j=0;j<list1.length;j++){
                        tempUrl = list1[j].url;
                        if(tempUrl == null){
                            tempIndex = null;
                        }else{
                            tempIndex = tempUrl.substring(tempUrl.indexOf("?page=")+6);
                        }
                        flag = "";
                        if(list1[j].active){
                            flag = "active";
                        }
                        temp1 += `<li class="page-item `+flag+`"><a class="page-link" onclick="loadPageHeader3(`+tempIndex+`,`+maker_position[0]+`,`+maker_position[1]+`,`+set+`,`+zoom+`)">`+list1[j].label+`</a></li>`;
                    }
                }else{
                    for(j=0;j<list1.length;j++){
                        tempUrl = list1[j].url;
                        if(tempUrl == null){
                            tempIndex = null;
                        }else{
                            tempIndex = tempUrl.substring(tempUrl.indexOf("?page=")+6);
                        }
                        if(j==0 || j == list1.length-1){
                            temp1 += `<li class="page-item"><a class="page-link" onclick="loadPageHeader3(`+tempIndex+`,`+maker_position[0]+`,`+maker_position[1]+`,`+set+`,`+zoom+`)">`+list1[j].label+`</a></li>`;    
                        }else{
                            if(list1[j].active){
                                flag = "active";
                                temp1 += `<li class="page-item `+flag+`"><a class="page-link" onclick="loadPageHeader3(`+tempIndex+`,`+maker_position[0]+`,`+maker_position[1]+`,`+set+`,`+zoom+`)">`+list1[j].label+`</a></li>`;
                            }
                        }
                    }
                }
                document.getElementById("pagin_content").innerHTML = temp1;
                
            }
		}
    }
    function map_init_circle(valueArray,maker_position,set,zoom){
        
        if ($('#map-leaflet').length) {
            if(window.innerWidth<=768){
                document.getElementById("MapHeader3").style.display = "block";
            }
            var container = L.DomUtil.get('map');
            if(container != null){
                container._leaflet_id = null;
            }
            
            if (map !== undefined && map !== null) {
                map.remove(); // should remove the map from UI and clean the inner children of DOM element
            }
            if(set > 0){
                map = L.map('map-leaflet').setView(maker_position, zoom);
            }else{
                map = L.map('map-leaflet').setView([34.994003757575776,33.15703828125001], zoom);
            }
            
            L.tileLayer('http://{s}.tile.osm.org/{z}/{x}/{y}.png').addTo(map);      

            circle = L.circle(maker_position, 1000*set).addTo(map);
            circle.setStyle({color: 'green',  opacity:0.5});

            if(viewCircleFlag>0){
                var donut = L.donut(maker_position,{
                    radius: 20000000000000,
                    innerRadius: 1000*set,
                    innerRadiusAsPercent: false,
                    color: '#000',
                    weight: 2,
                }).addTo(map);
            }
            
            var markerArray=[];
            
            valueArray.forEach((value) => {
                var icon = L.divIcon({
                    html: value.icon,
                    iconSize: [50, 50],
                    iconAnchor: [50, 50],
                    popupAnchor: [-20, -42]
                });
                var marker = L.marker(value.center, {
                    icon: icon
                });
                map.addLayer(marker);
                //markerArray.push(marker);
                markerArray[value.id] = marker;
                marker.bindPopup(
                    '<div class="listing-window-image-wrapper">' +
                    '<a onclick="showListigDetailModal(' + value.id + ')">' +
                    '<div class="listing-window-image" style="background-image: url(' + value.image + ');"></div>' +
                    '<div class="listing-window-content">' +
                    '<div class="info">' +
                    '<h2>' + value.title + '</h2>' +
                    '<p>' + value.desc + '</p>' +
                    '<h3>' + value.price + '</h3>' +
                    '</div>' +
                    '</div>' +
                    '</a>' +
                    '</div>'
                );  
            })

            let marker = new L.marker(maker_position, {
                draggable: 'true'
            });

            marker.on('dragend', function(event) {
                temp = marker.getLatLng();
                marker.setLatLng(temp, {
                    draggable: 'true'
                });
                circle.setLatLng(temp);
                document.getElementById("page_index").value = 1;
                loadActiveListingsHeader3([temp.lat,temp.lng],circle.getRadius()/1000,map.getZoom());
            });

            map.addLayer(marker);

            map.on('mousedown', function (event) {
                if(viewCircleFlag == 1){
                    marker.setLatLng(event.latlng);
                    circle.setLatLng(event.latlng);
                    circle.setRadius(0);
                    viewCircleFlag = 2;
                    map.scrollWheelZoom.disable();
                }else if(viewCircleFlag == 2){
                    map.scrollWheelZoom.enable();
                    temp = marker.getLatLng();
                    distance = Math.sqrt(Math.pow( event.latlng.lat - temp.lat, 2) + Math.pow( event.latlng.lng - temp.lng, 2))
                    circle.setRadius(distance*1000/0.011);
                    loadActiveListingsHeader3([temp.lat,temp.lng],distance/0.011,map.getZoom());
                    viewCircleFlag = 3;
                    document.getElementById("redrawCircleHeader3").style.background = "rgb(255, 255, 255)";
                    document.getElementById("redrawCircleHeader3").style.color = "rgb(0, 0, 0)";
                }
            });

            map.on('mousemove', event => {
                if(viewCircleFlag == 2){
                    temp = marker.getLatLng();
                    distance = Math.sqrt(Math.pow( event.latlng.lat - temp.lat, 2) + Math.pow( event.latlng.lng - temp.lng, 2))
                    circle.setRadius(distance*1000/0.0115742);
                }
            });
            if(window.innerWidth<=768){
                if(listing_type == 'map'){
                    document.getElementById("MapHeader3").style.display = "block";
                }else{
                    document.getElementById("MapHeader3").style.display = "none";
                }
            }
        }
    }
    
    $(window).scroll(function(){
        if($(window).scrollTop() >= 200){
            $('anchor3').css({
                "margin-top": "80px"
            })
            $('icon').css({
                "margin-top": "10px"
            })
            $('oldurl').css({
                "margin-top": "296px"
            })
        }
        else{
            $('anchor3').css({
                "margin-top": 300 - $(window).scrollTop()
            })
            $('icon').css({
                "margin-top": 230 - $(window).scrollTop()
            })
            $('oldurl').css({
                "margin-top": 516 - $(window).scrollTop()
            })
        }    
    })
    function showCircleHeader3(){
        if(viewCircleFlag > 0 ){
            viewCircleFlag = 0;
            document.getElementById("redrawCircleHeader3").style.display = "none";
            document.getElementById("showCircleHeader3").style.background = "rgb(255, 255, 255)";
            document.getElementById("showCircleHeader3").style.color = "rgb(0, 0, 0)";
            document.getElementById("showCircleHeader3").innerHTML = "Draw";
            loadActiveListingsHeader3([0,0],0,9);
        }else{
            viewCircleFlag = 1;
            $( "#map_success" ).fadeIn( 300 ).delay( 5000 ).fadeOut( 400 );
            document.getElementById("showCircleHeader3").style.background = "rgb(34, 150, 67)";
            document.getElementById("showCircleHeader3").style.color = "rgb(255, 255, 255)";
            document.getElementById("showCircleHeader3").innerHTML = "Clear";
            document.getElementById("redrawCircleHeader3").style.display = "flex";
            document.getElementById("redrawCircleHeader3").style.background = "rgb(34, 150, 67)";
            document.getElementById("redrawCircleHeader3").style.color = "rgb(255, 255, 255)";
            map_init_circle([],[0,0],0,9)
        }
    }
    function redrawCircleHeader3(){
        $( "#map_success" ).fadeIn( 300 ).delay( 3000 ).fadeOut( 400 );
        viewCircleFlag = 1;
        map_init_circle([],[0,0],0,9);
        document.getElementById("redrawCircleHeader3").style.background = "rgb(34, 150, 67)";
        document.getElementById("redrawCircleHeader3").style.color = "rgb(255, 255, 255)";
    }
    function loadPageHeader3(index,maker_position0,maker_position1,set,zoom){
        document.getElementById("page_index").value = index;
        loadActiveListingsHeader3([maker_position0,maker_position1],set,zoom);
	}
    // var listing_type = 'map';
    var listing_type = 'listings';
    function showHideMapListingHeader3(){
        document.getElementById("MapHeader3").style.height = "870px";
        if($( window ).width() > 1000){
            document.getElementById("ListingHeader3").style.display = "block";
            document.getElementById("showMapListingHeader3").style.display = "hide";
            document.getElementById("MapHeader3").style.display = "block";            
        }
        else{
            document.getElementById("showMapListingHeader3").style.display = "show";
            if(listing_type == 'map'){
                document.getElementById("ListingHeader3").style.display = "none";
                document.getElementById("MapHeader3").style.display = "block";
                document.getElementById("showMapListingHeader3").innerHTML = "Show Listings";
            }
            else if(listing_type == 'listings'){
                document.getElementById("MapHeader3").style.display = "none";
                document.getElementById("ListingHeader3").style.display = "block";
                document.getElementById("showMapListingHeader3").innerHTML = "Show Map";
            }
        }

        document.getElementById('searchcontentdiv').scrollIntoView();
    }
    function replaceview(){
        if(listing_type == 'map'){
            listing_type = 'listings';
        }
        else if(listing_type == 'listings'){
            listing_type = 'map';
        }
        showHideMapListingHeader3();
    }
    $(window).resize(function() {
        showHideMapListingHeader3();
    });
</script>

