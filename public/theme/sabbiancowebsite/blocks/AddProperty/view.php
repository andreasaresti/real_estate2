<?php
 $serverUrl = env('APP_URL');
 if(isset($_SESSION["user_id"])){
    $user_id = $_SESSION["user_id"];
 }else{
    $user_id = "";
 }
 if(isset($_SESSION["user_role"])){
    $user_role = $_SESSION["user_role"];
 }else{
    $user_role = "";
 }
?>
<div class="inner-pages maxw1600 m0a dashboard-bd">
<section class="user-page section-padding pt-5">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-3 col-md-12 col-xs-12 pl-0 pr-0 user-dash">
                <div class="user-profile-box mb-0">
                    
                    <div class="detail clearfix">
                        <ul class="mb-0">
                            <li>
                                <a href="/page/dashboard">
                                    <i class="fa fa-map-marker"></i> Dashboard
                                </a>
                            </li>
                            <?php if($user_id != ''){
                                if($user_role == "sales_people"){ ?>
                                <li>
                                    <a href="/page/salesequest-pendingappproval">
                                        <i class="fa fa-list"></i> Sale Requests
                                    </a>
                                </li>
                                <li>
                                    <a href="/page/salesequest-open">
                                        <i class="fa fa-list"></i> SalesRequests List
                                    </a>
                                </li>
                            <?php }}?>

                            <li>
                                <a href="/page/profile">
                                    <i class="fa fa-user"></i>Profile
                                </a>
                            </li>
                            <li>
                                <a href="/page/my-listings">
                                    <i class="fa fa-list" aria-hidden="true"></i>My Properties
                                </a>
                            </li>
                            <li>
                                <a href="/page/favorited">
                                    <i class="fa fa-heart" aria-hidden="true"></i>Favorited Properties
                                </a>
                            </li>
                            <li>
                                <a href="/page/add-listings">
                                    <i class="fa fa-list" aria-hidden="true"></i>Add Property
                                </a>
                            </li>
                            <li>
                                <a href="/page/changepassword">
                                    <i class="fa fa-lock"></i>Change Password
                                </a>
                            </li>
                            <li>
                                <a onclick="signOut()">
                                    <i class="fas fa-sign-out-alt"></i>Log Out
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-lg-9 col-md-12 col-xs-12 pl-0 user-dash2">
                <div class=" royal-add-property-area section_100 pl-0 user-dash2">
                    <div class="single-add-property">
                        <h3>Property description and price</h3>
                        <div class="property-form-group">
                            <form>
                                <div class="row">
                                    <div class="col-md-12">
                                        <p>
                                            <label for="title">Title</label>
                                            <input type="text" name="title" id="title" placeholder="Enter your property title">
                                        </p>
                                    </div>
                                </div>
                                <div class="row" style="padding-left: 20px;margin-bottom: 10px;">
                                    <img id="main_image" width="120" height="120" style="padding: 5px;"/>
                                    <input type="file" 
                                        onchange="loadImageAddProperty(event)">
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <p>
                                            <label for="description">Description</label>
                                            <textarea id="description" name="pro-dexc" placeholder="Describe about your property"></textarea>
                                        </p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-4 col-md-12 dropdown faq-drop">
                                        <div class="form-group categories">
                                            <div class="rld-single-select" style="margin-bottom: 15px" >
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
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-12 dropdown faq-drop">
                                        <div class="rld-single-select" style="margin-bottom: 15px" >
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
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-4 col-md-12">
                                        <p class="no-mb">
                                            <label for="price">Price</label>
                                            <input type="text" name="price" placeholder="EUR" id="price">
                                        </p>
                                    </div>
                                    <div class="col-lg-4 col-md-12">
                                        <p class="no-mb last">
                                            <label for="area">Area</label>
                                            <input type="text" name="area" placeholder="Sqm" id="area">
                                        </p>
                                    </div>
                                    <div class="col-lg-4 col-md-12">
                                        <p class="no-mb last">
                                            <label for="area">Year Built</label>
                                            <input type="text" name="year" placeholder="Year" id="year">
                                        </p>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="single-add-property">
                        <h3>property Images</h3>
                        <div class="property-form-group">
                            <div class="row">
                                <div class="col-md-12">
                                    <form action="/file-upload" class="dropzone" class="dropzone"></form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="single-add-property">
                        <h3>property Location</h3>
                        <div class="property-form-group">
                            <div class="row">
                                <div class="col-lg-4 col-md-12">
                                    <p>
                                        <label for="address">Address</label>
                                        <input type="text" name="address" placeholder="Enter Your Address" id="address">
                                    </p>
                                </div>
                                <div class="col-lg-4 col-md-12" style="align-self: center;margin-top: 23px;display: flex;justify-content: center;">
                                    <div class="rld-single-select" style="margin-bottom: 15px"  style="width: 132px">
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
                                    </p>
                                </div>
                                <div class="col-lg-4 col-md-12" style="align-self: center;margin-top: 23px;display: flex;justify-content: center;">
                                    <div class="form-group categories">
                                        <div class="rld-single-select" >
                                            <input type="hidden" id="selActivePropertStatus" name="selActivePropertStatus" value="">
                                            <nav id="navigation" class="style-1" style="background: white; margin-top:0px;margin-left: 5px!important;margin-right: 5px;border: 1px solid;border-radius: 5px;border-color: #ebebeb;">
                                                <ul>
                                                    <li ><a>Delivery Time</a>
                                                        <ul id="activedelivery_times">
                                                        </ul>
                                                    </li>
                                                </ul>
                                            </nav>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6 col-md-12">
                                    <p class="no-mb first">
                                        <label for="latitude">Google Maps latitude</label>
                                        <input type="text" name="latitude" value = "35.1264" placeholder="Google Maps latitude" id="addPropertyLatitude">
                                    </p>
                                </div>
                                <div class="col-lg-6 col-md-12">
                                    <p class="no-mb last">
                                        <label for="longitude">Google Maps longitude</label>
                                        <input type="text" name="longitude" value = "33.4299" placeholder="Google Maps longitude" id="addPropertyLongitude">
                                    </p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12 col-md-12" style="margin-top: 20px;">
                                    <div id="MapLocation" class="contact-map"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="single-add-property">
                        <h3>Extra Information</h3>
                        <div class="property-form-group">
                            <div class="row">
                                <div class="col-lg-4 col-md-12 dropdown faq-drop">
                                    <div class="form-group categories">
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
                                </div>
                                <div class="col-lg-4 col-md-12 dropdown faq-drop">
                                    <div class="form-group categories">
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
                                </div>
                                <div class="col-lg-4 col-md-12 dropdown faq-drop">
                                    <div class="form-group categories">
                                        <select class="select single-select"  id="garagesParkingpaces">
                                            <option value="0">Garages or Parkingpaces</option>
                                            <?php for($i= 1; $i<=10; $i++)
                                            {
                                            ?>
                                            <option value="<?php echo $i;?>"><?php echo $i;?></option>
                                            <?php
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="single-add-property">
                        <h3>Property Features</h3>
                        <div class="property-form-group">
                            <div class="row" id="activefeatures">
                            </div>
                        </div>
                    </div>
                    <div class="alert-box success" id="addProperty_success">Add Ok !!!</div>
                    <div class="alert-box failure" id="addProperty_failure">fail!!!</div>
                    <div class="single-add-property">
                        <div class="add-property-button pt-5">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="prperty-submit-button" style="display: flex; justify-content: center;">
                                        <button onclick="savePropertyAddProperty()">Submit Property</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
</div>
    
<script src="https://code.jquery.com/jquery-2.2.4.min.js" ></script>
<script src="https://npmcdn.com/leaflet@0.7.7/dist/leaflet.js" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/leaflet/1.0.0-rc.1/leaflet-src.js" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/leaflet.esri/2.0.0/esri-leaflet.js" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/leaflet.esri.geocoder/2.1.0/esri-leaflet-geocoder.js" crossorigin="anonymous"></script>
    
<script type="text/javascript">
	window.addEventListener("load", (event) => {
        user_id = '<?php echo $user_id; ?>';
        if(user_id == ""){
            window.location.href="/page/home";
        }
        loadActiveFeaturesAddProperty();
        loadActiveDistrictAddProperty();
        loadActivePropertTypeAddProperty();
        loadActivePropertStatusAddProperty();
        loadActiveDeliveryTimesAddProperty();
        loadMapAddListingAddProperty();
	});
    function loadImageAddProperty(event)
    {
        var reader = new FileReader();
        reader.onload = function(){
        var output = document.getElementById('main_image');
            output.src = reader.result;
        };
        reader.readAsDataURL(event.target.files[0]);
        
    }
    function loadActivePropertStatusAddProperty(){
		
		
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
                temp += `<li><a><input type="radio" name="propertStatus" class="propertStatus" value="`+data[i].id+`" id="propertStatus`+data[i].id+`" >`+data[i].displayname+`</a>
                        </li>`;
            }
            document.getElementById("activePropertStatus").innerHTML = temp;
		}
	}
    function loadActivePropertTypeAddProperty(){
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
                temp += `<li><a><input type="radio" name="propertTypes" class="propertTypes" value="`+data[i].id+`" id="propertTypes`+data[i].id+`" >`+data[i].displayname+`</a>
                        </li>`;
            }
            document.getElementById("activePropertType").innerHTML = temp;
		}
	}
    function loadActiveFeaturesAddProperty(){
		const url = "/api/activefeatures";
		let xhr = new XMLHttpRequest();
		xhr.open('POST', url, true);
		xhr.setRequestHeader('Content-type', 'application/json');
		xhr.send();
		xhr.onload = function () {
			list = JSON.parse(xhr.response);
			data = list.data;	
            var temp ="";
            for(i=0;i<data.length;i++){
                temp += `<div class="col-lg-4 col-md-12">
                            <div class="checkboxes float-left">
                                <div class="filter-tags-wrap">
                                    <input id="featurecheck`+data[i].id+`" class="featurecheck" type="checkbox" value = "`+data[i].id+`">
                                    <label for="featurecheck`+data[i].id+`">`+data[i].displayname+`</label>
                                </div>
                            </div>
                        </div>`;
            }
            document.getElementById("activefeatures").innerHTML = temp;
		}
	}
    function loadActiveDistrictAddProperty(){
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
                temp += `<li><a><input type="radio" id="districts`+data[i].id+`" class="district" name="district" value="`+data[i].id+`" onchange="changeLocationsAddProperty('districts','`+data[i].id+`','`+data[i].displayname+`')">`+data[i].displayname+`</a>
                <ul id="subDistricts`+data[i].id+`"></ul>`;
            }
            document.getElementById("activelocation").innerHTML = temp;
            loadActiveMunicipalityAddProperty();
		}
	}
    function loadActiveMunicipalityAddProperty(){
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
                        temp += `<li class="municipalities"><a><input type="radio"  id="municipalities`+data[i].id+`"  class="municipality" name="municipality" value="`+data[i].id+`" onchange="changeLocationsAddProperty('municipalities','`+data[i].id+`','`+data[i].displayname+`')">`+data[i].displayname+`</a>
                        <ul id="subMunicipalities`+data[i].id+`"></ul>`;
                    }
                }
                document.getElementById("subDistricts"+districts[j].value).innerHTML = temp;
                loadActiveLocationAddProperty();
            }
		}
	}
    function loadActiveLocationAddProperty(){
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
                        temp += `<li><a><input type="radio"  id="locations`+data[i].id+`"  class="location" name="location" value="`+data[i].id+`" onchange="changeLocationsAddProperty('locations','`+data[i].id+`','`+data[i].displayname+`')">`+data[i].displayname+`</a>`;
                    }
                }
                document.getElementById("subMunicipalities"+municipalities[j].value).innerHTML = temp;
            }
		}
	}
    function loadActiveDeliveryTimesAddProperty(){
		const url = "/api/activedelivery_times";
		let xhr = new XMLHttpRequest();
		xhr.open('POST', url, true);
		xhr.setRequestHeader('Content-type', 'application/json');
		xhr.send();
		xhr.onload = function () {
			list = JSON.parse(xhr.response);
			data = list.data;	
            var temp ="";
            for(i=0;i<data.length;i++){
                temp += `<li><a><input type="radio" name="deliveryTimes" class="deliveryTimes" value="`+data[i].id+`" id="deliveryTimes`+data[i].id+`" >`+data[i].displayname+`</a>
                        </li>`;
            }
            document.getElementById("activedelivery_times").innerHTML = temp;
		}
	}
    function changeLocationsAddProperty(flag,id,name)
    {
        // insert_location(flag,id,name,"");
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
    }
    function savePropertyAddProperty()
    {
        user_id = '<?php echo $user_id; ?>';
        var images_tag = [];
        var images = [];
        var images_tag = document.getElementsByClassName('dz-image');
        for(var j=0; j<images_tag.length;j++){
            images.push(images_tag[j].firstChild.getAttribute("src"));
        }
        var feature = [];
        var features = document.getElementsByClassName('featurecheck');
        for(var j=0; j<features.length;j++){
            if(features[j].checked){
                feature.push(features[j].value);
            }
        }
        var tempDistrict;
        var districts = document.getElementsByClassName('district');
        for(var j=0; j<districts.length;j++){
            if(districts[j].checked){
                tempDistrict = districts[j].value;
            }
        }
        var tempMunicipalities;
        var municipalities = document.getElementsByClassName('municipality');
        for(var j=0; j<municipalities.length;j++){
            if(municipalities[j].checked){
                tempMunicipalities = municipalities[j].value;
            }
        }
        var tempLocation;
        var locations = document.getElementsByClassName('location');
        for(var j=0; j<locations.length;j++){
            if(locations[j].checked){
                tempLocation = locations[j].value;
            }
        }
        var tempPropertStatus;
        var propertStatus = document.getElementsByClassName('propertStatus');
        for(var j=0; j<propertStatus.length;j++){
            if(propertStatus[j].checked){
                tempPropertStatus = propertStatus[j].value;
            }
        }
        var tempPropertType;
        var propertTypes = document.getElementsByClassName('propertTypes');
        for(var j=0; j<propertTypes.length;j++){
            if(propertTypes[j].checked){
                tempPropertType = propertTypes[j].value;
            }
        }
        var tempPropertType;
        var propertTypes = document.getElementsByClassName('propertTypes');
        for(var j=0; j<propertTypes.length;j++){
            if(propertTypes[j].checked){
                tempPropertType = propertTypes[j].value;
            }
        }
        var tempDeliveryTime;
        var deliveryTimes = document.getElementsByClassName('deliveryTimes');
        for(var j=0; j<deliveryTimes.length;j++){
            if(deliveryTimes[j].checked){
                tempDeliveryTime = deliveryTimes[j].value;
            }
        }
        let data = {
            "name": document.getElementById("title").value,
            "description": document.getElementById("description").value,
            "price": document.getElementById("price").value,
            "area_size": document.getElementById("area").value,
            "address": document.getElementById("address").value,
            "location_id": tempLocation,
            "latitude": document.getElementById("addPropertyLatitude").value,
            "longitude": document.getElementById("addPropertyLongitude").value,
            "listing_type_id": tempPropertType,
            "property_type_id": tempPropertStatus,
            "year_built": document.getElementById("year").value,
            "number_of_garages_or_parkingpaces": document.getElementById("garagesParkingpaces").value,
            "number_of_bedrooms": document.getElementById("selBedrooms").value,
            "number_of_bashrooms": document.getElementById("selBathrooms").value,
            "image": document.getElementById("main_image").src,
            "images": images,
            "features": feature,
            "owner_id":user_id,
            "delivery_time_id": tempDeliveryTime,
        };
        const url = "/api/createlisting";
        let xhr = new XMLHttpRequest();
        xhr.open('POST', url, true);
        xhr.setRequestHeader('Content-type', 'application/json');
        xhr.send(JSON.stringify(data));
        xhr.onload = function () {
            data = JSON.parse(xhr.response);
            if(data.hasOwnProperty("errors")){
                Object.keys(data.errors).forEach(function(key) {
                    $("#addProperty_failure").html(data.errors[key][0]);
                })
                $( "#addProperty_failure" ).fadeIn( 300 ).delay( 1500 ).fadeOut( 400 );
            }else{
                $( "#addProperty_success" ).fadeIn( 300 ).delay( 1500 ).fadeOut( 400 );
                window.location.reload();
            }
        }
    }
    function loadMapAddListingAddProperty() {
        
        // use below if you want to specify the path for leaflet's images
        //L.Icon.Default.imagePath = '@Url.Content("~/Content/img/leaflet")';
        lat = document.getElementById('addPropertyLatitude').value;
        lng = document.getElementById('addPropertyLongitude').value;
        var curLocation = [lat, lng];
        // use below if you have a model
        // var curLocation = [@Model.Location.addPropertyLatitude, @Model.Location.addPropertyLongitude];
    
        if (curLocation[0] == 0 && curLocation[1] == 0) {
            curLocation = [5.9714, 116.0953];
        }
    
        var map = L.map('MapLocation').setView(curLocation, 12);
    
        L.tileLayer('http://{s}.tile.osm.org/{z}/{x}/{y}.png', {
        attribution: '&copy; <a href="http://osm.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(map);
    
        map.attributionControl.setPrefix(false);
    
        var arcgisOnline = L.esri.Geocoding.arcgisOnlineProvider();
    
        var searchControl = L.esri.Geocoding.geosearch({
        providers: [arcgisOnline]
        }).addTo(map);
    
        searchControl.on('results', function(data){
            $("#address").val(data.text);
            $("#addPropertyLatitude").val(data.latlng.lat);
            $("#addPropertyLongitude").val(data.latlng.lng);
            marker.setLatLng(data.latlng, {
                draggable: 'true'
            }).bindPopup(data.latlng).update();
    
        // console.log(data);
        // results.clearLayers();
        // for (var i = data.results.length - 1; i >= 0; i--) {
        //   results.addLayer(L.marker(data.results[i].latlng));
        // }
        });
    
        var marker = new L.marker(curLocation, {
            draggable: 'true'
        });
    
        marker.on('dragend', function(event) {
            var position = marker.getLatLng();
            marker.setLatLng(position, {
                draggable: 'true'
            }).bindPopup(position).update();
            $("#addPropertyLatitude").val(position.lat);
            $("#addPropertyLongitude").val(position.lng).keyup();
        });
    
        $("#addPropertyLatitude, #addPropertyLongitude").change(function() {
            var position = [parseInt($("#addPropertyLatitude").val()), parseInt($("#addPropertyLongitude").val())];
            marker.setLatLng(position, {
                draggable: 'true'
            }).bindPopup(position).update();
            map.panTo(position);
        });
    
        map.addLayer(marker);
        
        map.on("click", addMarker);
    
        function addMarker(e) {
    
            $("#addPropertyLatitude").val(e.latlng.lat);
            $("#addPropertyLongitude").val(e.latlng.lng);
        
            marker.setLatLng(e.latlng, {
                draggable: 'true'
            }).bindPopup(e.latlng).update();
    
        }
    
    }
</script>
