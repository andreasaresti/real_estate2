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

    $postData = [
        'slug'=>"menu",
        'locale'=>"en_US",
    ];

    $menu_response = Helper::get_menu($postData);       
    $menu_response = json_decode($menu_response);
    // echo '<pre>';
    // print_r($menu_response);
    // echo '</pre>';
?>
    <style>
    .parallax-searchs.home15 {
        height: 100vh;
        display:block;
    }
    @media only screen and (max-width: 1024px){
        .parallax-searchs.home15 .hero-inner {
            padding: 0px 0;
        }
    }

</style>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="sha512-9usAa10IRO0HhonpyAIVpjrylPvoDwiPUiKdWk5t3PyolY1cOd4DSE0Ga+ri4AuTroPR5aQvXU9xC6qOPnzFeg==" crossorigin="anonymous" referrerpolicy="no-referrer" />

<div class="homepage-9 google-maps hp-6 homepage-1 mh" style="z-index: 9999;position: relative;">
    <div id="wrapper" style="height: 100vh;">
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
                            <a onclick="showAddListingHeaderMap();" class="button border">Add Listing<i class="fas fa-laptop-house ml-2"></i></a>
                        </div>
                        <!-- Header Widget / End -->
                    </div>
                    <?php if($email != ''){?>
                    <div class="header-user-menu user-menu add">
                        <div class=" header-user-name">
                            <!-- <a href="/page/profile">topMenu -->
                            
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

                    <div class="right-side d-none d-none d-lg-none d-xl-flex sign ml-0">
                        <!-- Header Widget -->
                        <div class="header-widget sign-in">
                            <div class="show-reg-form" ><a style="cursor: pointer;" onclick="loginIn()">Sign In</a></div>
                        </div>
                        <div class="header-widget sign-in">
                            <div class="show-reg-form" ><a style="cursor: pointer;" onclick="signUp()">Sign Up</a></div>
                        </div>
                        <!-- Header Widget / End -->
                    </div>
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
        <div class="row" style="display: flex;align-items: center;margin: 25px 0px 0px 50px; position: absolute;z-index: 9; bottom:40px;">
            <div class="col-xl-12 xsRow" style="display: flex;justify-content: space-around;align-items: center;padding: 0px;">
                <a  class="btn btn-map" id="mapSizeListingMap5" onclick="mapSizeListingMap(5);" style="margin-right:5px;background: rgb(255, 255, 255); color: rgb(0, 0, 0);">+ 5 km</a>
                <a  class="btn btn-map" id="mapSizeListingMap10" onclick="mapSizeListingMap(10);" style="margin-right:5px;background: rgb(255, 255, 255); color: rgb(0, 0, 0);">+ 10 km</a>
                <a  class="btn btn-map" id="mapSizeListingMap30" onclick="mapSizeListingMap(30);" style="margin-right:5px;background: rgb(255, 255, 255); color: rgb(0, 0, 0);">+ 30 km</a>
                <a  class="btn btn-map" id="mapSizeListingMap50" onclick="mapSizeListingMap(50);" style="margin-right:5px;background: rgb(255, 255, 255); color: rgb(0, 0, 0);">+ 50 km</a>
                <a  class="btn btn-map" id="mapSizeListingMap100" onclick="mapSizeListingMap(100);" style="margin-right:5px;background: rgb(255, 255, 255); color: rgb(0, 0, 0);">+ 100 km</a>
                <a style="display: flex;justify-content: center;align-items: center;background: rgb(255, 255, 255); color: rgb(0, 0, 0);" class="btn btn-map" id="showCircleListingMap" onclick="showCircleListingMap();" ><i class="fa-solid fa-location-crosshairs" style="font-size:30px;"></i></a>
            </div>
        </div>
        
        <div id="map-leaflet" style="position: absolute;height: 100vh;"></div>
        <div class="filter">
            <div class="filter-toggle d-lg-none d-sm-flex"><i class="fa fa-search"></i>
                <h6>START SEARCHING</h6></div>
            <form method="get">
                <div class="filter-item">
                    <label>Property Status</label>
                    <input type="hidden" id="selActivePropertStatus" name="selActivePropertStatus" value="">
                    <nav id="navigation" class="style-1" style="background: white;margin:0px 5px 15px 5px;border: 1px solid;border-radius: 5px;border-color: #ebebeb;width: 100%;">
                        <ul style="width: 100%;">
                            <li style="width: 100%;"><a>Property Status</a>
                            <ul id="activePropertStatus" style="width: 100%;">
                        <?php
                            foreach($active_property_types_response->data as $property_type){
                                echo '<li style="width: 95%;"><a style="width: 95%;"><input type="checkbox" class="propertStatus" value="'.$property_type->id.'" id="propertStatus'.$property_type->id.'" >'.$property_type->displayname.'</a></li>';
                            }
                            ?> 
                        </ul>
                            </li>
                        </ul>
                    </nav>
                </div>
                <div class="filter-item">
                    <label>Property Type</label>
                        <input type="hidden" id="selActivePropertType" name="selActivePropertType" value="">
                        <nav id="navigation" class="style-1" style="width: 100%;background: white; margin:0px 5px 15px 5px;border: 1px solid;border-radius: 5px;border-color: #ebebeb;">
                            <ul style="width: 100%;">
                                <li style="width: 100%;"><a>Property Type</a>
                                <ul id="activePropertType" style="width: 100%;">
                                    <?php
                                    foreach($active_listing_types_response->data as $listing_type){
                                        echo '<li style="width: 95%;"><a style="width: 95%;"><input type="checkbox" class="propertTypes" name="property_types[]" value="'.$listing_type->id.'" id="propertTypes'.$listing_type->id.'">'.$listing_type->displayname.'</a></li>';
                                    }
                                    ?>                                                
                                </ul>
                                </li>
                            </ul>
                        </nav>
                </div>
                <div class="filter-item">
                    <label>Location</label>
                    <input type="hidden" id="selLocation" name="selLocation" value="">
                    <nav id="navigation" class="style-1" style="width: 100%;background: white; margin:0px 5px 15px 5px;border: 1px solid;border-radius: 5px;border-color: #ebebeb;">
                        <ul>
                            <li ><a id="location_title">Location</a>
                                <ul id="activelocation">
                                    <?php
                                        foreach($active_district_response->data as $district){
                                            echo '<li class="parent locationLi">
                                                    <a><input type="checkbox" id="districts'.$district->id.'" class="district" name="district[]" value="'.$district->id.'" onchange="changeLocationsHeaderMap(\'districts\',\''.$district->id.'\',\''.$district->displayname.'\')">'.$district->displayname.' </a>
                                                    <div class="wrapper" style="top: 0px; left: 208px;">
                                                        <ul style="transform:none;position:initial; visibility: visible;opacity: 100; overflow-x: hidden; overflow-y: auto; max-height: 500px;" id="subDistricts'.$district->id.'">';
                                                            foreach($active_municipality_response->data as $municipality){
                                                                if($district->id == $municipality->district_id){
                                                                    echo '<li class="parent locationLi">
                                                                        <a><input type="checkbox" id="municipalities'.$municipality->id.'" class="municipality" name="municipality[]" value="'.$municipality->id.'" onchange="changeLocationsHeaderMap(\'municipalities\',\''.$municipality->id.'\',\''.$municipality->displayname.'\')">'.$municipality->displayname.'</a>
                                                                        <div class="wrapper">
                                                                            <ul style="visibility: visible;opacity: 100;" id="subMunicipalities'.$municipality->id.'">';
                                                                            foreach($active_location_response->data as $location){
                                                                                if($location->municipality_id == $municipality->id){
                                                                                    echo '<li>
                                                                                        <a>
                                                                                        <input type="checkbox" id="locations'.$location->id.'" class="location" name="location[]" value="'.$location->id.'" onchange="changeLocationsHeaderMap(\'locations',''.$location->id.'',''.$location->displayname.'\')">'.$location->displayname.'</a>
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
                <div class="filter-item mb-3">
                    <label>Price</label>
                    <input type="text" disabled="" id="price" class="slider_amount m-t-lg-30 m-t-xs-0 m-t-sm-10 mb-3">
                    <div class="slider-range mt-2 ui-slider ui-corner-all ui-slider-horizontal ui-widget ui-widget-content"><div class="ui-slider-range ui-corner-all ui-widget-header" style="left: 28.2051%; width: 35.8974%;"></div><span tabindex="0" class="ui-slider-handle ui-corner-all ui-state-default" style="left: 28.2051%;"></span><span tabindex="0" class="ui-slider-handle ui-corner-all ui-state-default" style="left: 64.1026%;"></span></div>
                </div>
                <div class="filter-item filter-half mt-3">
                    <label>Beds</label>
                    <select name="beds" id="property-beds">
                        <option value="">Any</option>
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                        <option value="6">6</option>
                        <option value="7">7</option>
                        <option value="8">8</option>
                        <option value="9">9</option>
                        <option value="10">10</option>
                    </select>
                </div>
                <div class="filter-item filter-half filter-half-last mt-3">
                    <label>Baths</label>
                    <select name="baths" id="property-baths">
                        <option value="">Any</option>
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                        <option value="6">6</option>
                        <option value="7">7</option>
                        <option value="8">8</option>
                        <option value="9">9</option>
                        <option value="10">10</option>
                    </select>
                </div>
                <div class="clear"></div>
                <div class="filter-item ">
                    <label>Area</label>
                    <input type="number" name="areaMin" id="areaMin" class="area-filter filter-1 mb-3" placeholder="Min">
                    <input type="number" name="areaMax" id="areaMax" class="area-filter mb-3" placeholder="Max">
                    <div class="clear"></div>
                </div>
                
                <div class="filter-item">
                    <label class="label-submit p-0 m-0">Submit</label>
                    <br>
                    <input style="text-align: center;" onclick="listsViewHeaderMap();" class="button alt mb-0" value="SEARCH PROPERTY">
                </div>
            </form>
        </div>
    </div>
</div>
<a href="#signup"  data-toggle="modal" data-target=".log-sign" id="loginModal"></a>
<div class="modal fade bs-modal-sm log-sign" style="z-index:9999" id="myModal" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm" style="margin-top: 200px;">
        <div class="modal-content" style="width: 500px;">
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
                        <div class="controls">
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
                        <div class="controls">
                            <button onclick="modalSignUp()" class="btn btn-primary btn-block">Sign Up</button>
                        </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-2.2.4.min.js" ></script>
<script src="https://cdn.jsdelivr.net/leaflet/1.0.0-rc.1/leaflet-src.js" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/leaflet.esri/2.0.0/esri-leaflet.js" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/leaflet.esri.geocoder/2.1.0/esri-leaflet-geocoder.js" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/leaflet.markercluster/1.0.0-beta.2.0/leaflet.markercluster.js" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/leaflet.markercluster/1.0.0-beta.2.0/leaflet.markercluster-src.js" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/gh/Falke-Design/L.Donut@latest/src/L.Donut.js"></script>
<script type="text/javascript">
    var map = null;
    var circle;
    var curLocation = [0,0];
    var viewCircleFlag = 0;
    var page_index = 0;


	// window.addEventListener("load", (event) => {
        // loadMenuHeaderMap();
        loadLangHeaderMap();
		// loadActiveFeaturesHeaderMap();
        // loadActiveDistrictHeaderMap();
        // loadActivePropertTypeHeaderMap();
	// });
    loadActiveListingsListingGrid([0,0],0);
    function loadActiveListingsListingGrid(maker_position = '',set= ''){
        const sendData = {
            "retrieve_markers":1,
            "radius":maker_position,
            "set":set
        };
		const url = "/api/activelistings";
		let xhr = new XMLHttpRequest();
		xhr.open('POST', url, true);
		xhr.setRequestHeader('Content-type', 'application/json');
		xhr.send(JSON.stringify(sendData));
		xhr.onload = function () {
            markers = JSON.parse(xhr.response).listing_markers;
            var markersArray = [];
            for(i= 0; i<markers.length; i++)
            {
                if(markers[i].center[0]>0){
                    markersArray.push(markers[i]);    
                }
            }
            // map_init(markersArray);
            map_init_circle(markersArray,maker_position,set);
		}
    }
    function map_init_circle(valueArray,maker_position,set){
        
        if ($('#map-leaflet').length) {
            curLocation = maker_position;
            var container = L.DomUtil.get('map');
            if(container != null){
                container._leaflet_id = null;
            }
            
            if (map !== undefined && map !== null) {
                map.remove(); // should remove the map from UI and clean the inner children of DOM element
            }
            map = L.map('map-leaflet').setView([34.994003757575776,33.15703828125001], 9);
            L.tileLayer('http://{s}.tile.osm.org/{z}/{x}/{y}.png').addTo(map);      

            if(set>0){
                var donut = L.donut(curLocation,{
                    radius: 20000000000000,
                    innerRadius: 1000*set,
                    innerRadiusAsPercent: false,
                    color: '#000',
                    weight: 2,
                }).addTo(map);
                circle = L.circle(curLocation, 1000*set).addTo(map);
                circle.setStyle({color: 'green',  opacity:0.5});
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
                    '<a href="/' + value.link + '">' +
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

            let marker = new L.marker(curLocation, {
                draggable: 'true'
            });

            marker.on('dragend', function(event) {
                temp = marker.getLatLng();
                curLocation = [temp.lat,temp.lng];
                marker.setLatLng(curLocation, {
                    draggable: 'true'
                });
                circle.setLatLng(curLocation);
                document.getElementById("page_index").value = 1;
                loadActiveListingsListingMap(curLocation,set);
            });

            map.addLayer(marker);
            
            var arcgisOnline = L.esri.Geocoding.arcgisOnlineProvider();

            var searchControl = L.esri.Geocoding.geosearch({
                providers: [arcgisOnline]
            }).addTo(map);

            searchControl.on('results', function(data){
                marker.setLatLng(data.latlng, {
                    draggable: 'true'
                }).bindPopup(data.latlng).update();
                temp = marker.getLatLng();
                curLocation = [temp.lat,temp.lng];
                if(map.hasLayer(circle))
                map.removeLayer(circle);
                circle = L.circle(curLocation, 1000*set).addTo(map);
                circle.setLatLng(curLocation);
                document.getElementById("page_index").value = 1;
                loadActiveListingsListingMap(curLocation,set);
                
            });

            map.on("click", addMarker);

            function addMarker(e) {
                if(set>0){
                    marker.setLatLng(e.latlng, {
                        draggable: 'true'
                    }).bindPopup(e.latlng).update();
                    temp = marker.getLatLng();
                    curLocation = [temp.lat,temp.lng];
                    circle.setLatLng(curLocation);
                    document.getElementById("page_index").value = 1;
                    loadActiveListingsListingMap(curLocation,set);
                }
            }
        }
    }
    function map_init(valueArray){
        
        if ($('#map-leaflet').length) {
            var container = L.DomUtil.get('map');
            if(container != null){
                container._leaflet_id = null;
            }
            
            if (map !== undefined && map !== null) {
                map.remove(); // should remove the map from UI and clean the inner children of DOM element
            }
            // map = L.map('map-leaflet').setView([34.994003757575776,33.15703828125001], 10, scrollWheelZoom: false);
            map = L.map('map-leaflet', {scrollWheelZoom: false}).setView([34.994003757575776,33.15703828125001], 10);
            map.zoomControl.setPosition('bottomright');
            L.tileLayer('http://{s}.tile.osm.org/{z}/{x}/{y}.png').addTo(map);      

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
                    '<a href="/' + value.link + '">' +
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
        }
    }
    function loadLangHeaderMap(){
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
                    temp += `<li><a class="topMenu" style="color: black;" onclick="changeLangHeaderMap('`+list[i].name+`')">`+list[i].name+`</a></li>`;
                }
                temp += `</ul>`;
            }
            document.getElementsByName("activeLangContent")[0].innerHTML = temp;
            document.getElementsByName("activeLangContent")[1].innerHTML = temp;
            //document.getElementById("").innerHTML = temp;
		}
	}
    function changeLangHeaderMap(data){
        document.getElementsByName("activeLang")[0].innerHTML = data;
        document.getElementsByName("activeLang")[1].innerHTML = data;
    }
    function loadMenuHeaderMap(){
        data = {
            "slug":"menu",
            "locale":"en_US",
        }
		const url = "/api/getmenu";
		let xhr = new XMLHttpRequest();
		xhr.open('POST', url, true);
		xhr.setRequestHeader('Content-type', 'application/json');
		xhr.send(JSON.stringify(data));
		xhr.onload = function () {
			list = JSON.parse(xhr.response);
            var temp ="";
            for(i=0;i<list.length;i++){
                if(list[i].parent_id == null){
                    temp += `<li><a class="topMenu" href="`+list[i].value+`">`+list[i].name+`</a><ul>`;
                    for(j=0;j<list.length;j++){
                        if(list[j].parent_id == list[i].id){
                            temp += `<li><a class="topMenu" href="`+list[j].value+`">`+list[j].name+`</a><ul>`;
                            for(k=0;k<list.length;k++){
                                if(list[k].parent_id == list[j].id){
                                    temp += `<li><a class="topMenu" href="`+list[k].value+`">`+list[k].name+`</a></li>`;
                                }
                            }
                            temp += `</ul></li>`;
                        }
                    }
                    temp += `</ul></li>`;
                }
            }
            temp = temp.replaceAll("<ul></ul>","");
            // temp += `<li class="d-none d-xl-none d-block d-lg-block mt-5 pb-4 ml-5 border-bottom-0"><a href="/page/add-listings" class="button border btn-lg btn-block text-center">Add Listing<i class="fas fa-laptop-house ml-2"></i></a></li>`;
            document.getElementsByName("menuResponsive")[0].innerHTML = temp;
            // document.getElementsByName("menuResponsive")[1].innerHTML = temp;
		}
	}
    function loadActivePropertTypeHeaderMap(){
		const url = "/api/activelisting-types";
		let xhr = new XMLHttpRequest();
		xhr.open('POST', url, true);
		xhr.setRequestHeader('Content-type', 'application/json');
		xhr.send();
		xhr.onload = function () {
			list = JSON.parse(xhr.response);
			data = list.data;	
            var temp ="";
            for(i=0;i<data.length;i++){
                temp += `<li><a><input type="checkbox" class="propertTypes" value="`+data[i].id+`" id="propertTypes`+data[i].id+`" >`+data[i].displayname+`</a>
                        </li>`;
            }
            document.getElementById("activePropertType").innerHTML = temp;
		}
	}
	function loadActiveFeaturesHeaderMap(){
		const url = "/api/activefeatures";
		let xhr = new XMLHttpRequest();
		xhr.open('POST', url, true);
		xhr.setRequestHeader('Content-type', 'application/json');
		xhr.send();
		xhr.onload = function () {
			list = JSON.parse(xhr.response);
			data = list.data;	
            var temp ="";
            for(i=0;i<Math.round(data.length/2);i++){
                temp += `<input id="fcheck-`+i+`" type="checkbox" class="featurecheck" value = "`+data[i].id+`">
                <label for="fcheck-`+i+`">`+data[i].displayname+`</label>`;
            }
            document.getElementById("activefeaturesLeft").innerHTML = temp;
            temp ="";
            for(i=Math.round(data.length/2);i<data.length;i++){
                temp += `<input id="fcheck-`+i+`" type="checkbox" class="featurecheck" value = "`+data[i].id+`">
                <label for="fcheck-`+i+`">`+data[i].displayname+`</label>`;
            }
            document.getElementById("activefeaturesRight").innerHTML = temp;
		}
	}
    function loadActiveDistrictHeaderMap(){
		const url = "/api/activedistrict";
		let xhr = new XMLHttpRequest();
        let xhr1 = new XMLHttpRequest();
		xhr.open('POST', url, true);
		xhr.setRequestHeader('Content-type', 'application/json');
		xhr.send();
		xhr.onload = function () {
			list = JSON.parse(xhr.response);
			data = list.data;	
            var temp ="";
            for(i=0;i<data.length;i++){
                temp += `<li class="parent locationLi" ><a><input type="checkbox" id="districts`+data[i].id+`" class="district" name="district[]" value="`+data[i].id+`" onchange="changeLocationsHeaderMap('districts','`+data[i].id+`','`+data[i].displayname+`')">`+data[i].displayname+`</a>
                <div class="wrapper"><ul style="transform:none;position:initial; visibility: visible;opacity: 100; overflow-x: hidden; overflow-y: auto; max-height: 500px;" id="subDistricts`+data[i].id+`"></ul></div></li>`;
            }
            document.getElementById("activelocation").innerHTML = temp;
            loadActiveMunicipalityHeaderMap();
		}
	}
    function loadActiveMunicipalityHeaderMap(){
		const url = "/api/activemunicipality";
		let xhr = new XMLHttpRequest();
		xhr.open('POST', url, true);
		xhr.setRequestHeader('Content-type', 'application/json');
		xhr.send();
		xhr.onload = function () {
			list = JSON.parse(xhr.response);
			data = list.data;
            districts = document.getElementsByClassName("district");
            for(j=0;j<districts.length;j++)
            {
                temp ="";
                for(i=0;i<data.length;i++){
                    if(data[i].district_id == districts[j].value){
                        temp += `<li class="parent locationLi"><a><input type="checkbox"  id="municipalities`+data[i].id+`"  class="municipality" name="municipality[]" value="`+data[i].id+`" onchange="changeLocationsHeaderMap('municipalities','`+data[i].id+`','`+data[i].displayname+`')">`+data[i].displayname+`</a>
                        <div class="wrapper"><ul style="visibility: visible;opacity: 100;" id="subMunicipalities`+data[i].id+`"></ul></div></li>`;
                    }
                }
                document.getElementById("subDistricts"+districts[j].value).innerHTML = temp;
                loadActiveLocationHeaderMap();
            }
		}
	}
    function loadActiveLocationHeaderMap(){
		const url = "/api/activelocation";
		let xhr = new XMLHttpRequest();
		xhr.open('POST', url, true);
		xhr.setRequestHeader('Content-type', 'application/json');
		xhr.send();
		xhr.onload = function () {
			list = JSON.parse(xhr.response);
			data = list.data;
            municipalities = document.getElementsByClassName("municipality");
            for(j=0;j<municipalities.length;j++)
            {
                temp ="";
                for(i=0;i<data.length;i++){
                    if(data[i].municipality_id == municipalities[j].value){
                        temp += `<li><a><input type="checkbox"  id="locations`+data[i].id+`"  class="location" name="location[]" value="`+data[i].id+`" onchange="changeLocationsHeaderMap('locations','`+data[i].id+`','`+data[i].displayname+`')">`+data[i].displayname+`</a>`;
                    }
                }
                document.getElementById("subMunicipalities"+municipalities[j].value).innerHTML = temp;
            }
		}
	}
    function hiddenAdvancedDivHeaderMap(){
        document.getElementById('advancedSearch').className = "explore__form-checkbox-list full-filter";
    }
    function changeLocationsHeaderMap(flag,id,name)
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
            console.log(xhr.response);
            data = JSON.parse(xhr.response);
            if(xhr.status == "201"){
                $( "div.success" ).fadeIn( 300 ).delay( 1500 ).fadeOut( 400 );
                window.location.href="/page/profile";
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
                // alert("Login Fail");
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
                window.location.href="/page/profile";
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
    function showAddListingHeaderMap(){
        user_id = '<?php echo $user_id; ?>';
        if(user_id !== ""){
            window.location.href="/page/add-listings";
        }else{
            loginIn()
        }
	}
    function listsViewHeaderMap(){
        customer_id = '<?php echo $user_id; ?>';
        number_of_bathrooms = document.getElementById("property-baths").value;
        number_of_bedrooms = document.getElementById("property-beds").value;
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
        var tempPropertStatus = [];
        var propertStatus = document.getElementsByClassName('propertStatus');
        for(var j=0; j<propertStatus.length;j++){
            if(propertStatus[j].checked){
                tempPropertStatus.push(propertStatus[j].value);
            }
        }
        var tempPropertTypes = [];
        var propertTypes = document.getElementsByClassName('propertTypes');
        for(var j=0; j<propertTypes.length;j++){
            if(propertTypes[j].checked){
                tempPropertTypes.push(propertTypes[j].value);
            }
        }
        var size2 = document.getElementById("areaMax").value;
        var size1 = document.getElementById("areaMin").value;

        var price = document.getElementById("price").value;
        
        price = price.replaceAll(",","");
        price1 = price.substring(1,price.indexOf(" - €"));
        price2 = price.substring(price.indexOf(" - €")+4);
        
        const sendData = {
            "number_of_bathrooms": number_of_bathrooms,
            "number_of_bedrooms": number_of_bedrooms,
            "listing_types": tempPropertTypes,
            "listing_status": tempPropertStatus,
            "features": tempFeatures,
            "min_area_size": parseInt(size1),
            "max_area_size": parseInt(size2),
            // "min_price": parseInt(price1),
            // "max_price": parseInt(price2),
            "districts": tempDistrictArr,
            "municipalities": tempMunicipalitiesArr,
            "locations": tempLocationArr,
            "search_term": "",
            "customer_id": customer_id
        };

        localStorage.setItem("list_search_data", JSON.stringify(sendData));
        window.location.href = "/page/listings-map";
	}
    function showCircleListingMap(radius=100){
        document.getElementById("mapSizeListingMap5").style.background = "rgb(255, 255, 255)";
        document.getElementById("mapSizeListingMap5").style.color = "rgb(0, 0, 0)";
        document.getElementById("mapSizeListingMap10").style.background = "rgb(255, 255, 255)";
        document.getElementById("mapSizeListingMap10").style.color = "rgb(0, 0, 0)";
        document.getElementById("mapSizeListingMap30").style.background = "rgb(255, 255, 255)";
        document.getElementById("mapSizeListingMap30").style.color = "rgb(0, 0, 0)";
        document.getElementById("mapSizeListingMap50").style.background = "rgb(255, 255, 255)";
        document.getElementById("mapSizeListingMap50").style.color = "rgb(0, 0, 0)";
        document.getElementById("mapSizeListingMap100").style.background = "rgb(255, 255, 255)";
        document.getElementById("mapSizeListingMap100").style.color = "rgb(0, 0, 0)";
        if(viewCircleFlag > 0 ){
            curLocation = [0,0];
            document.getElementById("mapSizeListingMap"+viewCircleFlag).style.background = "rgb(255, 255, 255)";
            document.getElementById("mapSizeListingMap"+viewCircleFlag).style.color = "rgb(0, 0, 0)";
            document.getElementById("showCircleListingMap").style.background = "rgb(255, 255, 255)";
            document.getElementById("showCircleListingMap").style.color = "rgb(0, 0, 0)";
            viewCircleFlag = 0;
            loadActiveListingsListingMap(curLocation,0);
        }
        else{
            viewCircleFlag = radius;
            curLocation = [34.994003757575776,33.19793701171876];
            document.getElementById("mapSizeListingMap"+radius).style.background = "rgb(34, 150, 67)";
            document.getElementById("mapSizeListingMap"+radius).style.color = "rgb(255, 255, 255)";
            document.getElementById("showCircleListingMap").style.background = "rgb(34, 150, 67)";
            document.getElementById("showCircleListingMap").style.color = "rgb(255, 255, 255)";
            loadActiveListingsListingMap(curLocation,100);
        }
        
    }
    function mapSizeListingMap(index){
        if(viewCircleFlag==0){
            showCircleListingMap(index);
        }
        if(viewCircleFlag>0){
            viewCircleFlag = index;
            document.getElementById("mapSizeListingMap5").style.background = "rgb(255, 255, 255)";
            document.getElementById("mapSizeListingMap5").style.color = "rgb(0, 0, 0)";
            document.getElementById("mapSizeListingMap10").style.background = "rgb(255, 255, 255)";
            document.getElementById("mapSizeListingMap10").style.color = "rgb(0, 0, 0)";
            document.getElementById("mapSizeListingMap30").style.background = "rgb(255, 255, 255)";
            document.getElementById("mapSizeListingMap30").style.color = "rgb(0, 0, 0)";
            document.getElementById("mapSizeListingMap50").style.background = "rgb(255, 255, 255)";
            document.getElementById("mapSizeListingMap50").style.color = "rgb(0, 0, 0)";
            document.getElementById("mapSizeListingMap100").style.background = "rgb(255, 255, 255)";
            document.getElementById("mapSizeListingMap100").style.color = "rgb(0, 0, 0)";
            document.getElementById("mapSizeListingMap"+index).style.background = "rgb(34, 150, 67)";
            document.getElementById("mapSizeListingMap"+index).style.color = "rgb(255, 255, 255)";
            loadActiveListingsListingMap(curLocation,index);
        }
    }
    function loadActiveListingsListingMap(maker_position,set){
        page_index = 1;
        loadActiveListingsListingGrid(maker_position,set);
        
	}
</script>