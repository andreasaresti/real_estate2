<?php

    use App\Helpers\Helper;

    if(isset($_SESSION["user_id"])){
        $user_id = $_SESSION["user_id"];
    }
    else{
        $user_id = "";
    }
    $selDistricts = '';
    if(isset($_GET["district"])){
        $selDistricts = $_GET["district"];
    }
    // echo 'selDistricts: '.$selDistricts.'<br>';
    
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

    $active_property_types_response = Helper::get_active_property_types();       
    $active_property_types_response = json_decode($active_property_types_response);
?>
<link rel="stylesheet" href="/theme/sabbiancowebsite/assets/css/jquery-ui.css<?php echo time(); ?>">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="sha512-9usAa10IRO0HhonpyAIVpjrylPvoDwiPUiKdWk5t3PyolY1cOd4DSE0Ga+ri4AuTroPR5aQvXU9xC6qOPnzFeg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<div class="inner-pages homepage-4 agents hp-6 full hd-white">
    <section class="properties-right featured portfolio blog google-map-right mp-1">
        <div class="container-fluid">
            <div class="row">
                <aside id="MapListingMap" class="col-lg-6 col-md-6 google-maps-left mt-0 MobileHiddenMap">
                    <div class="alert-box success" id="map_success" style="position: absolute;z-index: 9;width: 100%;margin-top: 80px;">Click on the map to select center and radius</div>
                    <div class="row" style="padding: 25px 0px 0px 0px;position: absolute;z-index: 9;width: 50%;left: 50%;">
                        <div class="col-xl-12 xsRow" style="display: flex;justify-content: flex-end;margin-right: 10px;">
                            <a style="display: none;justify-content: center;align-items: center;margin-right:20px;" class="btn btn-map" id="redrawCircleListingMap" onclick="redrawCircleListingMap();" >Re-draw</a>
                            <a style="display: flex;justify-content: center;align-items: center;" class="btn btn-map" id="showCircleListingMap" onclick="showCircleListingMap();" >Draw</a>
                        </div>
                    </div>
                    <div id="map-leaflet"></div>
                </aside>
                <div id="ListingListingMap" class="col-lg-6 col-md-12 google-maps-right" style="padding-left:20px">
                    <!-- Search Form -->
                    <div class="col-12 px-0 parallax-searchs-button">
                        <a onclick="searchShowListingMap();" class="btn btn-yellow" id="SearchShowButton" style="margin-top: 20px;height: 41px;padding: 0px;line-height: 39px;">Search Show</a>
                    </div>
                    <div class="col-12 px-0 parallax-searchs" id="SearchBar">
                        <div class="banner-search-wrap">
                            <div class="tab-content">
                                <div class="tab-pane fade show active" id="tabs_1">
                                    <div class="rld-main-search">
                                        <div class="row">
                                            <div class="rld-single-input" onmouseover="hiddenAdvancedDivListingMap();" style="width: 190px">
                                                <input type="text" placeholder="Enter Keyword..." autocomplete="off" id="search_string">
                                            </div>
                                            <div class="rld-single-select" style="margin-bottom: 15px" onmouseover="hiddenAdvancedDivListingMap();" style="width: 132px">
                                                <input type="hidden" id="selLocation" name="selLocation" value="">
                                                <nav id="navigation" class="style-1" style="background: white; margin-top:0px;margin-left: 5px!important;margin-right: 5px;border: 1px solid;border-radius: 5px;border-color: #ebebeb;">
                                                    <ul>
                                                        <li ><a id="location_title">Location</a>
                                                            <ul id="activelocation">
                                                                <?php
                                                                    foreach($active_district_response->data as $district){
                                                                        echo '<li class="parent locationLi">
                                                                                <a><input type="checkbox" id="districts'.$district->id.'" class="district" name="district[]" value="'.$district->id.'" onchange="changeLocationsListingMap(\'districts\',\''.$district->id.'\',\''.$district->displayname.'\')">'.$district->displayname.' </a>
                                                                                <div class="wrapper" style="top: 0px; left: 208px;">
                                                                                    <ul style="transform:none;position:initial; visibility: visible;opacity: 100; overflow-x: hidden; overflow-y: auto; max-height: 500px;" id="subDistricts'.$district->id.'">';
                                                                                        foreach($active_municipality_response->data as $municipality){
                                                                                            if($district->id == $municipality->district_id){
                                                                                                echo '<li class="parent locationLi">
                                                                                                    <a><input type="checkbox" id="municipalities'.$municipality->id.'" class="municipality" name="municipality[]" value="'.$municipality->id.'" onchange="changeLocationsListingMap(\'municipalities\',\''.$municipality->id.'\',\''.$municipality->displayname.'\')">'.$municipality->displayname.'</a>
                                                                                                    <div class="wrapper">
                                                                                                        <ul style="visibility: visible;opacity: 100;" id="subMunicipalities'.$municipality->id.'">';
                                                                                                        foreach($active_location_response->data as $location){
                                                                                                            if($location->municipality_id == $municipality->id){
                                                                                                                echo '<li>
                                                                                                                    <a>
                                                                                                                    <input type="checkbox" id="locations'.$location->id.'" class="location" name="location[]" value="'.$location->id.'" onchange="changeLocationsListingMap(\'locations',''.$location->id.'',''.$location->displayname.'\')">'.$location->displayname.'</a>
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
                                            <div class="rld-single-select" style="margin-bottom: 15px" onmouseover="hiddenAdvancedDivListingMap();">
                                                <input type="hidden" id="selActivePropertStatus" name="selActivePropertStatus" value="">
                                                <nav id="navigation" class="style-1" style="background: white; margin-top:0px;margin-left: 5px!important;margin-right: 5px;border: 1px solid;border-radius: 5px;border-color: #ebebeb;">
                                                    <ul>
                                                        <li ><a>Property Status</a>
                                                        <ul id="activePropertStatus">
                                                    <?php
                                                        foreach($active_property_types_response->data as $property_type){
                                                            echo '<li><a><input type="checkbox" class="propertStatus" value="'.$property_type->id.'" id="propertStatus'.$property_type->id.'" >'.$property_type->displayname.'</a></li>';
                                                        }
                                                        ?> 
                                                    </ul>
                                                        </li>
                                                    </ul>
                                                </nav>
                                            </div>
                                            
                                            <div class="rld-single-select" style="margin-bottom: 15px" onmouseover="hiddenAdvancedDivListingMap();">
                                                <input type="hidden" id="selActivePropertType" name="selActivePropertType" value="">
                                                <nav id="navigation" class="style-1" style="background: white; margin-top:0px;margin-left: 5px!important;margin-right: 5px;border: 1px solid;border-radius: 5px;border-color: #ebebeb;">
                                                    <ul>
                                                        <li ><a>Property Type</a>
                                                        <ul id="activePropertType">
                                                            <?php
                                                            foreach($active_listing_types_response->data as $listing_type){
                                                                echo '<li><a><input type="checkbox" class="propertTypes" name="property_types[]" value="'.$listing_type->id.'" id="propertTypes'.$listing_type->id.'">'.$listing_type->displayname.'</a></li>';
                                                            }
                                                            ?>                                                
                                                        </ul>
                                                        </li>
                                                    </ul>
                                                </nav>
                                            </div>
                                            
                                            <div class="dropdown-filter" style="margin-bottom: 15px; width: 238px"><span>Advanced Search</span></div>
                                            <div class="col-xl-2 col-lg-2 col-md-4 pl-0" style="width: 150px">
                                                <a class="btn btn-yellow" onclick="searchNowListingMap();">Search Now</a>
                                            </div>
                                            <div id="advancedSearch" style="margin-top: 0px;" class="explore__form-checkbox-list full-filter">
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
                                                    <div class="col-lg-4 col-md-6 py-1 pl-0 pr-0">
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
                                                    <div class="col-lg-5 col-md-12 col-sm-12 py-1 pr-30 mr-5 sld">
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
                                                    <div class="col-lg-3 col-md-6 col-sm-12 py-1 pr-30">
                                                        <!-- Checkboxes -->
                                                        <div class="checkboxes one-in-row margin-bottom-10 ch-1" id="activefeaturesLeft">
                                                            <?php
                                                                foreach($active_features as $key=>$feature){
                                                                    if($key <= count($active_features) / 2){
                                                                        echo '<input id="fcheck-'.$feature->id.'" type="checkbox" class="featurecheck" value="'.$feature->id.'" name="features[]"">
                                                                        <label for="fcheck-'.$feature->id.'" >'.$feature->displayname.'</label>';
                                                                    }
                                                                    
                                                                }
                                                            ?>
                                                        </div>
                                                        <!-- Checkboxes / End -->
                                                    </div>
                                                    <div class="col-lg-3 col-md-6 col-sm-12 py-1 pr-30">
                                                        <!-- Checkboxes -->
                                                        <div class="checkboxes one-in-row margin-bottom-10 ch-2" id="activefeaturesRight">
                                                            <?php
                                                                foreach($active_features as $key=>$feature){
                                                                    if($key > count($active_features) / 2){
                                                                        echo '<input id="fcheck-'.$feature->id.'" type="checkbox" class="featurecheck" value = "'.$feature->id.'">
                                                                        <label for="fcheck-'.$feature->id.'">'.$feature->displayname.'</label>';
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
                                    <select class="form-control border-0 bg-transparent shadow-none p-0 selectpicker sortby"  id="paginSize" onchange="loadActiveListingsListingMap([0,0],0,9)" name="paginSize">
                                        <option selected value="20">20</option>
                                        <option value="40">40</option>
                                        <option value="60">60</option>
                                        <option value="80">80</option>
                                    </select>
                                </div>
                                <div class="input-group border rounded input-group-lg w-auto mr-4">
                                    <label class="input-group-text bg-transparent border-0 text-uppercase letter-spacing-093 pr-1 pl-3" for="inputGroupSelect01"><i class="fas fa-align-left fs-16 pr-2"></i>Sortby:</label>
                                    <select class="form-control border-0 bg-transparent shadow-none p-0 selectpicker sortby"  onchange="loadActiveListingsListingMap([0,0],0,9)"  data-style="bg-transparent border-0 font-weight-600 btn-lg pl-0 pr-3" id="sortby" name="sortby">
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
                    <a onclick="showHideMapListingListingMap();" style="padding: 10px 20px 10px 20px;background: #E0F2FF;border-radius: 5px;cursor: pointer;" id="showMapListingListingMap">Show Map</a>
                </div>
            </div>
            <input type="hidden" id="page_index" value="1">
        </div>
    </section>
</div>
<a data-toggle="modal" data-target=".ListingDetailModalListingMap" id="ListingDetailButtonListingMap"></a>
<div class="modal fade bs-modal-sm ListingDetailModalListingMap" style="z-index: 9999;" id="ListingDetailModalListingMap" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm" style="max-width: 80%;">
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


<script src="https://code.jquery.com/jquery-2.2.4.min.js"></script>
<script src="https://unpkg.com/leaflet@1.4.0/dist/leaflet.js"></script>
<script src="https://unpkg.com/esri-leaflet@2.2.3/dist/esri-leaflet.js"></script>
<script src="https://cdn.jsdelivr.net/gh/Falke-Design/L.Donut@latest/src/L.Donut.js"></script>



<script type="text/javascript">
    
    var map = null;
    var mapListingsDetail = null;
    var circle;
    var viewCircleFlag = 0;
    // loadActiveFeaturesListingMap();
    // loadActiveDistrictListingMap();
    function searchShowListingMap(){
        if(document.getElementById("SearchShowButton").innerHTML == "Search Show"){
            document.getElementById("SearchShowButton").innerHTML = "Search Hide";
            document.getElementById("SearchBar").style.display = "block";
        }else{
            document.getElementById("SearchShowButton").innerHTML = "Search Show";
            document.getElementById("SearchBar").style.display = "none";
        }
        
    }
	// window.addEventListener("load", (event) => {

    <?php
        if($selDistricts != ''){
            echo "$( '#districts".$selDistricts."' ).click();";
        }
    ?>
    
    if(localStorage.getItem("list_search_data")){
        // alert('we have local storage');
        tempList = JSON.parse(localStorage.getItem("list_search_data"));
        // setTimeout(() => {
            if(tempList.number_of_bathrooms > 0){
                document.getElementById("selBathrooms").value = tempList.number_of_bathrooms;
            }
            if(tempList.number_of_bedrooms > 0){
                document.getElementById("selBedrooms").value = tempList.number_of_bedrooms;
            }
            if(tempList.search_term !== ""){
                document.getElementById('search_string').value = tempList.search_term;
            }
            for(var j=0; j<tempList.features.length;j++){
                document.getElementById('fcheck-'+tempList.features[j]).checked = true;
            }
            for(var j=0; j<tempList.districts.length;j++){
                document.getElementById('districts'+tempList.districts[j]).checked = true;
            }
            for(var j=0; j<tempList.municipalities.length;j++){
                document.getElementById('municipalities'+tempList.municipalities[j]).checked = true;
            }
            for(var j=0; j<tempList.locations.length;j++){
                document.getElementById('locations'+tempList.locations[j]).checked = true;
            }
            for(var j=0; j<tempList.listing_types.length;j++){
                document.getElementById('propertTypes'+tempList.listing_types[j]).checked = true;
            }
            for(var j=0; j<tempList.listing_status.length;j++){
                document.getElementById('propertStatus'+tempList.listing_status[j]).checked = true;
            }
        // }, 5000);
    }
    loadActiveListingsListingMap([0,0],0,9);
        // loadActivePropertTypeListingMap();
        // loadActivePropertStatusListingMap();
	// });
    function loadActivePropertStatusListingMap(){
		const url = "/api/activeproperty-types";
		let xhr = new XMLHttpRequest();
		xhr.open('POST', url, true);
		xhr.setRequestHeader('Content-type', 'application/json');
		xhr.send();
		xhr.onload = function () {
			list = JSON.parse(xhr.response);
			data = list.data;	
            var temp ="";
            for(i=0;i<data.length;i++){
                temp += `<li><a><input type="checkbox" class="propertStatus" value="`+data[i].id+`" id="propertStatus`+data[i].id+`" >`+data[i].displayname+`</a>
                        </li>`;
            }
            document.getElementById("activePropertStatus").innerHTML = temp;
		}
	}
    function loadActivePropertTypeListingMap(){
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
    function loadPageListingMap(index,maker_position0,maker_position1,set,zoom){
        document.getElementById("page_index").value = index;
        loadActiveListingsListingGrid([maker_position0,maker_position1],set,zoom);
	}
	function loadActiveFeaturesListingMap(){
		
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
    function loadActiveDistrictListingMap(){
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
                temp += `<li class="parent locationLiLeft" ><a><input type="checkbox" id="districts`+data[i].id+`" class="district" name="district[]" value="`+data[i].id+`" onchange="changeLocationsListingMap('districts','`+data[i].id+`','`+data[i].displayname+`')">`+data[i].displayname+`</a>
                <div class="wrapper"><ul style="transform:none;position:initial; visibility: visible;opacity: 100; overflow-x: hidden; overflow-y: auto; max-height: 500px;" id="subDistricts`+data[i].id+`"></ul></div></li>`;
            }
            document.getElementById("activelocation").innerHTML = temp;
            loadActiveMunicipalityListingMap();
		}
	}
    function loadActiveMunicipalityListingMap(){
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
                        temp += `<li class="parent locationLiLeft"><a><input type="checkbox"  id="municipalities`+data[i].id+`"  class="municipality" name="municipality[]" value="`+data[i].id+`" onchange="changeLocationsListingMap('municipalities','`+data[i].id+`','`+data[i].displayname+`')">`+data[i].displayname+`</a>
                        <div class="wrapper"><ul style="visibility: visible;opacity: 100;" id="subMunicipalities`+data[i].id+`"></ul></div></li>`;
                    }
                }
                document.getElementById("subDistricts"+districts[j].value).innerHTML = temp;
                loadActiveLocationListingMap();
            }
		}
	}
    function loadActiveLocationListingMap(){
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
                        temp += `<li><a><input type="checkbox"  id="locations`+data[i].id+`"  class="location" name="location[]" value="`+data[i].id+`" onchange="changeLocationsListingMap('locations','`+data[i].id+`','`+data[i].displayname+`')">`+data[i].displayname+`</a>`;
                    }
                }
                document.getElementById("subMunicipalities"+municipalities[j].value).innerHTML = temp;
            }
		}
	}
    function loadActiveListingsListingGrid(maker_position,set,zoom){
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
                temp +=`<div class="item col-lg-6 col-md-6 col-xs-12 landscapes sale">
                            <div class="project-single">
                                <div class="project-inner project-head">
                                    <div class="homes">
                                        <!-- homes img -->
                                        <a onclick="showListigDetailModalListingMap(`+list[i].id+`);" class="homes-img">`;
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
                                    <h3><a onclick="showListigDetailModalListingMap(`+list[i].id+`);">`+list[i].displayname+`</a></h3>
                                    <p class="homes-address mb-3">
                                        <a onclick="showListigDetailModalListingMap(`+list[i].id+`);">
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
                                <a onclick="showListigDetailModalListingMap(`+list[i].id+`);" tabindex="0">€ `+ list[i].price+`</a>
                            </h3>
                            <div class="compare">
                                <a style="cursor: pointer;" onclick="addFavoritListingMap(`+list[i].id+`)"><i id="faHeart`+list[i].id+`" class="fa fa-heart" style="font-size: x-large; ` + favorite + ` "></i></a>
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
                        temp1 += `<li class="page-item `+flag+`"><a class="page-link" onclick="loadPageListingMap(`+tempIndex+`,`+maker_position[0]+`,`+maker_position[1]+`,`+set+`,`+zoom+`)">`+list1[j].label+`</a></li>`;
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
                            temp1 += `<li class="page-item"><a class="page-link" onclick="loadPageListingMap(`+tempIndex+`,`+maker_position[0]+`,`+maker_position[1]+`,`+set+`,`+zoom+`)">`+list1[j].label+`</a></li>`;    
                        }else{
                            if(list1[j].active){
                                flag = "active";
                                temp1 += `<li class="page-item `+flag+`"><a class="page-link" onclick="loadPageListingMap(`+tempIndex+`,`+maker_position[0]+`,`+maker_position[1]+`,`+set+`,`+zoom+`)">`+list1[j].label+`</a></li>`;
                            }
                        }
                    }
                }
                document.getElementById("pagin_content").innerHTML = temp1;
                
            }
		}
    }
    function loadActiveListingsListingMap(maker_position,set,zoom){
        document.getElementById("page_index").value = 1;
        hiddenAdvancedDivListingMap();
        loadActiveListingsListingGrid(maker_position,set,zoom);
	}
    function hiddenAdvancedDivListingMap(){
        document.getElementById('advancedSearch').className = "explore__form-checkbox-list full-filter";
    }
    function changeLocationsListingMap(flag,id,name)
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
    function addFavoritListingMap(index)
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
                var paragraph = document.getElementById("faHeart"+index);
                if(paragraph.style.color !== "red"){
                    paragraph.style.color = "red";
                }else{
                    paragraph.style.color = "currentColor";
                }
            }
        }else{
            loginIn();
        }
    }

    function map_init_circle(valueArray,maker_position,set,zoom){
        
        if ($('#map-leaflet').length) {
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
                    '<a onclick="showListigDetailModalListingMap('+value.id+');">' +
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
                loadActiveListingsListingMap([temp.lat,temp.lng],circle.getRadius()/1000,map.getZoom());
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
                    loadActiveListingsListingMap([temp.lat,temp.lng],distance/0.011,map.getZoom());
                    viewCircleFlag = 3;
                    document.getElementById("redrawCircleListingMap").style.background = "rgb(255, 255, 255)";
                    document.getElementById("redrawCircleListingMap").style.color = "rgb(0, 0, 0)";
                }
            });

            map.on('mousemove', event => {
                if(viewCircleFlag == 2){
                    temp = marker.getLatLng();
                    distance = Math.sqrt(Math.pow( event.latlng.lat - temp.lat, 2) + Math.pow( event.latlng.lng - temp.lng, 2))
                    circle.setRadius(distance*1000/0.0115742);
                }
            });
            
        }
    }
    function searchNowListingMap(){
        loadActiveListingsListingMap([0,0],0,9);
    }
    function showCircleListingMap(){
        if(viewCircleFlag > 0 ){
            viewCircleFlag = 0;
            document.getElementById("redrawCircleListingMap").style.display = "none";
            document.getElementById("showCircleListingMap").style.background = "rgb(255, 255, 255)";
            document.getElementById("showCircleListingMap").style.color = "rgb(0, 0, 0)";
            document.getElementById("showCircleListingMap").innerHTML = "Draw";
            loadActiveListingsListingMap([0,0],0,9);
        }else{
            viewCircleFlag = 1;
            $( "#map_success" ).fadeIn( 300 ).delay( 5000 ).fadeOut( 400 );
            document.getElementById("showCircleListingMap").style.background = "rgb(34, 150, 67)";
            document.getElementById("showCircleListingMap").style.color = "rgb(255, 255, 255)";
            document.getElementById("showCircleListingMap").innerHTML = "Clear";
            document.getElementById("redrawCircleListingMap").style.display = "flex";
            document.getElementById("redrawCircleListingMap").style.background = "rgb(34, 150, 67)";
            document.getElementById("redrawCircleListingMap").style.color = "rgb(255, 255, 255)";
            map_init_circle([],[0,0],0,9)
        }
    }
    function redrawCircleListingMap(){
        $( "#map_success" ).fadeIn( 300 ).delay( 3000 ).fadeOut( 400 );
        viewCircleFlag = 1;
        document.getElementById("redrawCircleListingMap").style.background = "rgb(34, 150, 67)";
        document.getElementById("redrawCircleListingMap").style.color = "rgb(255, 255, 255)";
    }
    function showHideMapListingListingMap(){
        if(document.getElementById("showMapListingListingMap").innerHTML == "Show Listings"){
            document.getElementById("showMapListingListingMap").innerHTML = "Show Map";
            document.getElementById("MapListingMap").style.display = "none";
            document.getElementById("ListingListingMap").style.display = "block";
        }else{
            document.getElementById("showMapListingListingMap").innerHTML = "Show Listings";
            document.getElementById("ListingListingMap").style.display = "none";
            document.getElementById("MapListingMap").style.display = "block";
        }
    }
    function showListigDetailModalListingMap(index){
        document.getElementById("ListingDetailButtonListingMap").click();
        loadListingsDetailModalListingMap(index);
    }
    function loadListingsDetailModalListingMap(index){

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
                <a style="cursor: pointer;" onclick="addFavoritListingsDetailModalListingMap(`+data.id+`)">
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
            temp += `<li style="margin-left: 50px;width:40%">
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
            document.getElementById("sendMessageListingsDetailModal").setAttribute( "onClick", "sendRequestListingsDetailModalListingMap("+data.id+");" );
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
    function addFavoritListingsDetailModalListingMap(index)
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
                var paragraph = document.getElementById("faHeart"+index);
                var paragraph1 = document.getElementById("faHeartListingDetailModal"+index);
                
                if(paragraph.style.color !== "red"){
                    paragraph.style.color = "red";
                    paragraph1.style.color = "red";
                }else{
                    paragraph.style.color = "currentColor";
                    paragraph1.style.color = "currentColor";
                }
            }
        }else{
            jQuery.noConflict();
            $('#ListingDetailModalListingMap').modal('toggle'); 
            loginIn();
        }
    }
    function sendRequestListingsDetailModalListingMap(index)
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
            $('#ListingDetailModalListingMap').modal('hide');
            loginIn();
        }
    }
</script>
