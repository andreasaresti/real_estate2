<?php
 $serverUrl = env('APP_URL');
 if(isset($_SESSION["user_id"])){
    $user_id = $_SESSION["user_id"];
 }else{
    $user_id = "";
 }
?>
<div class="inner-pages homepage-4 agents hp-6 full hd-white">
<section class="properties-right featured portfolio blog google-map-right mp-1">
    <div class="container-fluid">
        
        <div class="row">
            <aside class="col-lg-6 col-md-6 google-maps-left mt-0">
                <div style="display: flex;align-items: center;margin-left: 15px;">
                    <input type="number" class="kilometresListMap" name="kilometresListMap" min="0" max="100" placeholder="15" value="15" />
                    <input type="range" class="rangeListMap" name="rangeListMap" min="0" max="100" step="1" value="15" />
                </div>
                <div id="map-leaflet"></div>
            </aside>
            <div class="col-lg-6 col-md-12 google-maps-right" style="padding-left:20px">
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
                                        <div class="rld-single-select" style="margin-bottom: 15px" onmouseover="hiddenAdvancedDivListingMap();">
                                            <input type="hidden" id="selActivePropertStatus" name="selActivePropertStatus" value="">
                                            <nav id="navigation" class="style-1" style="background: white; margin-top:0px;margin-left: 5px!important;margin-right: 5px;border: 1px solid;border-radius: 5px;border-color: #ebebeb;">
                                                <ul>
                                                    <li ><a>Property Status</a>
                                                        <ul id="activePropertStatus">
                                                        
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
                                                        
                                                        </ul>
                                                    </li>
                                                </ul>
                                            </nav>
                                        </div>
                                        <div class="rld-single-select" style="margin-bottom: 15px" onmouseover="hiddenAdvancedDivListingMap();" style="width: 132px">
                                            <input type="hidden" id="selLocation" name="selLocation" value="">
                                            <nav id="navigation" class="style-1" style="background: white; margin-top:0px;margin-left: 5px!important;margin-right: 5px;border: 1px solid;border-radius: 5px;border-color: #ebebeb;">
                                                <ul>
                                                    <li ><a id="location_title">Location</a>
                                                        <ul id="activelocation">
                                                        
                                                        </ul>
                                                    </li>
                                                </ul>
                                            </nav>
                                        </div>
                                        <div class="dropdown-filter" style="width: 238px"><span>Advanced Search</span></div>
                                        <div class="col-xl-2 col-lg-2 col-md-4 pl-0" style="width: 150px">
                                            <a class="btn btn-yellow" onclick="loadActiveListingsListingMap()">Search Now</a>
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
                                                            <div id="area-range" data-min="0" data-max="1300" data-unit="sq ft"></div>
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
                                                        
                                                    </div>
                                                    <!-- Checkboxes / End -->
                                                </div>
                                                <div class="col-lg-3 col-md-6 col-sm-12 py-1 pr-30">
                                                    <!-- Checkboxes -->
                                                    <div class="checkboxes one-in-row margin-bottom-10 ch-2" id="activefeaturesRight">
                                                        
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
                                <select class="form-control border-0 bg-transparent shadow-none p-0 selectpicker sortby"  id="paginSize" onchange="loadActiveListingsListingMap()" name="paginSize">
                                    <option selected value="20">20</option>
                                    <option value="40">40</option>
                                    <option value="60">60</option>
                                    <option value="80">80</option>
                                </select>
                            </div>
                            <div class="input-group border rounded input-group-lg w-auto mr-4">
                                <label class="input-group-text bg-transparent border-0 text-uppercase letter-spacing-093 pr-1 pl-3" for="inputGroupSelect01"><i class="fas fa-align-left fs-16 pr-2"></i>Sortby:</label>
                                <select class="form-control border-0 bg-transparent shadow-none p-0 selectpicker sortby"  onchange="loadActiveListingsListingMap()"  data-style="bg-transparent border-0 font-weight-600 btn-lg pl-0 pr-3" id="sortby" name="sortby">
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
            </div>
        </div>
        <nav aria-label="..." style="padding: 20px;display: flex;justify-content: flex-end;">
            <ul class="pagination mt-0" id="pagin_content">
                
            </ul>
        </nav>
        <input type="hidden" id="page_index" value="1">
    </div>
</section>
</div>
<!-- <script src="/theme/sabbiancowebsite/assets/js/leaflet.js"></script>
<script src="/theme/sabbiancowebsite/assets/js/leaflet-gesture-handling.min.js"></script>
<script src="/theme/sabbiancowebsite/assets/js/leaflet-providers.js"></script>
<script src="/theme/sabbiancowebsite/assets/js/leaflet.markercluster.js"></script>
<script src="/theme/sabbiancowebsite/assets/js/map4.js?2"></script> -->

<script src="https://code.jquery.com/jquery-2.2.4.min.js" ></script>
<script src="https://cdn.jsdelivr.net/leaflet/1.0.0-rc.1/leaflet-src.js" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/leaflet.esri/2.0.0/esri-leaflet.js" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/leaflet.esri.geocoder/2.1.0/esri-leaflet-geocoder.js" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/leaflet.markercluster/1.0.0-beta.2.0/leaflet.markercluster.js" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/leaflet.markercluster/1.0.0-beta.2.0/leaflet.markercluster-src.js" crossorigin="anonymous"></script>



<script type="text/javascript">
    function searchShowListingMap(){
        console.log(document.getElementById("SearchShowButton").innerHTML);
        if(document.getElementById("SearchShowButton").innerHTML == "Search Show"){
            document.getElementById("SearchShowButton").innerHTML = "Search Hide";
            document.getElementById("SearchBar").style.display = "block";
        }else{
            document.getElementById("SearchShowButton").innerHTML = "Search Show";
            document.getElementById("SearchBar").style.display = "none";
        }
        
    }
	window.addEventListener("load", (event) => {
		loadActiveFeaturesListingMap();
        loadActiveDistrictListingMap();
        loadActiveListingsListingMap();
        loadActivePropertTypeListingMap();
        loadActivePropertStatusListingMap();
	});
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
    function loadPageListingMap(index){
        document.getElementById("page_index").value = index;
		loadActiveListingsListingMap();
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
                temp += `<li><a><input type="checkbox" id="districts`+data[i].id+`" class="district" name="district[]" value="`+data[i].id+`" onchange="changeLocationsListingMap('districts','`+data[i].id+`','`+data[i].displayname+`')">`+data[i].displayname+`</a>
                <ul id="subDistricts`+data[i].id+`"></ul>`;
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
                        temp += `<li class="municipalities"><a><input type="checkbox"  id="municipalities`+data[i].id+`"  class="municipality" name="municipality[]" value="`+data[i].id+`" onchange="changeLocationsListingMap('municipalities','`+data[i].id+`','`+data[i].displayname+`')">`+data[i].displayname+`</a>
                        <ul id="subMunicipalities`+data[i].id+`"></ul>`;
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
    function loadActiveListingsListingMap(){
        hiddenAdvancedDivListingMap();
		
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
        var price1 = document.getElementsByClassName("first-slider-value")[1].value;
        var size1 = document.getElementsByClassName("first-slider-value")[0].value;
        var price2 = document.getElementsByClassName("second-slider-value")[1].value;
        var size2 = document.getElementsByClassName("second-slider-value")[0].value;
        size1 = size1.substring(0,size1.length-6);
        price1 = price1.substring(1);
        price1 = price1.replace(",","");
        size2 = size2.substring(0,size2.length-6);
        price2 = price2.substring(1);
        price2 = price2.replace(",","");
        if(price1 == ''){
            price1 = 0;
        }
        if(price2 == ''){
            price2 = 600000;
        }
        if(size1 == ''){
            size1 = 0;
        }
        if(size2 == ''){
            size2 = 1300;
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
            "districts": tempDistrictArr,
            "municipalities": tempMunicipalitiesArr,
            "locations": tempLocationArr,
            "search_term": search_term,
            "customer_id": customer_id,
            "page": document.getElementById("page_index").value,
            "per_page":document.getElementById("paginSize").value,
            "orderbyName": orderbyName,
            "orderbyType": orderbyType,
        };
		const url = "/api/activelistings";
		let xhr = new XMLHttpRequest();
		xhr.open('POST', url, true);
		xhr.setRequestHeader('Content-type', 'application/json');
		xhr.send(JSON.stringify(sendData));
		xhr.onload = function () {
			data = JSON.parse(xhr.response);
			list = data.data;
            var valueArray = [];
            var temp ="";
            for(i= 0; i<list.length; i++)
            {
                valueArray.push(list[i].listingmarker);
            }
            map_init_circle(valueArray);
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
                                        <a href="/page/listing-details?index=`+list[i].id+`" class="homes-img">`;
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
                                    <h3><a href="/page/listing-details?index=`+list[i].id+`">`+list[i].displayname+`</a></h3>
                                    <p class="homes-address mb-3">
                                        <a href="/page/listing-details?index=`+list[i].id+`">
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
                                <a href="/page/listing-details?index=`+list[i].id+`" tabindex="0">€ `+ list[i].price+`</a>
                            </h3>
                            <div class="compare">
                                <a style="cursor: pointer;" onclick="addFavoritListingMap(`+list[i].id+`)"><i id="faHeart`+list[i].id+`" class="fa fa-heart" style="font-size: x-large; ` + favorite + ` "></i></a>
                            </div>
                        </div></div></div></div>`;
            }
            document.getElementById("ListingListContent").innerHTML = temp
            document.getElementById("page_count").innerHTML = data.total+" Search results"

            
            sendData1 = {
                "total": data.total,
                "current_page": data.current_page,
                "per_page": data.per_page,
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
                let tempStr = "";
                for(j=0;j<list1.length;j++){
                    flag = "";
                    if(list1[j].active){
                        flag = "active";
                    }
                    temp1 += `<li class="page-item `+flag+`"><a class="page-link" onclick="loadPageListingMap(`+list1[j].label+`)">`+list1[j].label+`</a></li>`;
                }
                document.getElementById("pagin_content").innerHTML = temp1;
            }
		}
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
    function map_init_circle(valueArray){
        if ($('#map-leaflet').length) {

            let set = 10;
            $('.rangeListMap').on('input', function() {
                set = $(this).val();
                $('.kilometresListMap').val(set);
            });

            $('.kilometresListMap').on('input', function() {
                set = $(this).val();
                $('.rangeListMap').val(set);
            });    

            $( ".rangeListMap, .kilometresListMap" ).on('input', function() {
                if(map.hasLayer(circle))
                    map.removeLayer(circle);
                if(circleFlag == 1){
                    circle = L.circle(curLocation, 1000*set).addTo(map);
                }
            });

            let curLocation = [0, 0];
            var circleFlag = 0;
            var container = L.DomUtil.get('map');
            if(container != null){
                container._leaflet_id = null;
            }

            if (map !== undefined && map !== null) {
                map.remove(); // should remove the map from UI and clean the inner children of DOM element
            }

            // var map = L.map('map-leaflet', {
            //     zoom: 9,
            //     maxZoom: 20,
            //     tap: false,
            //     gestureHandling: true,
            //     center: [40.90, -73.90]
            // });
            var map = L.map('map-leaflet').setView(valueArray[0].center, 10);

            L.tileLayer('http://{s}.tile.osm.org/{z}/{x}/{y}.png').addTo(map);

            var marker_cluster = L.markerClusterGroup();

            // map.scrollWheelZoom.disable();

            // var OpenStreetMap_DE = L.tileLayer('https://{s}.tile.openstreetmap.de/tiles/osmde/{z}/{x}/{y}.png', {
            //     scrollWheelZoom: false,
            //     attribution: '&copy; <a href="http://osm.org/copyright">OpenStreetMap</a> contributors'
            // }).addTo(map);

            valueArray.forEach((value) => {
                var icon = L.divIcon({
                    html: value.icon,
                    iconSize: [50, 50],
                    iconAnchor: [50, 50],
                    popupAnchor: [-20, -42]
                });

                var marker = L.marker(value.center, {
                    icon: icon
                }).addTo(map);

                marker.bindPopup(
                    '<div class="listing-window-image-wrapper">' +
                    '<a href="' + value.link + '">' +
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

                marker_cluster.addLayer(marker);
            });

            let marker = new L.marker(curLocation, {
                draggable: 'true'
            });

            var circle = L.circle(curLocation, 0).addTo(map);

            marker.on('dragend', function(event) {
                curLocation = marker.getLatLng();
                marker.setLatLng(curLocation, {
                    draggable: 'true'
                });
                circle.setLatLng(curLocation);
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
                curLocation = marker.getLatLng();
                if(map.hasLayer(circle))
                map.removeLayer(circle);
                circle = L.circle(curLocation, 1000*set).addTo(map);
                circle.setLatLng(curLocation);
                circleFlag = 1;
            });

            map.on("click", addMarker);

            function addMarker(e) {
                if(circleFlag == 1){
                    marker.setLatLng(e.latlng, {
                        draggable: 'true'
                    }).bindPopup(e.latlng).update();
                    curLocation = marker.getLatLng();
                    circle.setLatLng(curLocation);
                }
            }
        }
    }
</script>