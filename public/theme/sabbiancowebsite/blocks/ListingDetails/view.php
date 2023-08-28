<?php
if(isset($_SESSION["user_id"])){
   $user_id = $_SESSION["user_id"];
}else{
   $user_id = "";
}
if(isset($_GET['index'])){
    $index = $_GET['index'];
}else{
    $index = 0;
}
?>
<div class="inner-pages sin-1 homepage-4 hd-white">
<section class="single-proper blog details">
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
                    <div id="map-leaflet" class="contact-map" style="height: 255px; width:685px"></div>
                </div>
            </div>
            <aside class="col-lg-4 col-md-12 car">
                <div class="single widget">
                    <!-- end author-verified-badge $sales_people['name'] !== "" && -->
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
                                            <input type="button" onclick="sendRequestListingDetails();" name="sendmessage" class="multiple-send-message" value="Submit Request" />
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php //}?>                       
                    </div>
                </div>
            </aside>
        </div>
        <section class="similar-property featured portfolio p-0 bg-white-inner">
            <div class="container">
                <h5>Similar Properties</h5>
                <div class="row portfolio-items" id="SimilarListingsContent">
                </div>
            </div>
        </section>
    </div>
</section>
</div>
<script src="/theme/sabbiancowebsite/assets/js/leaflet.js"></script>
<script src="/theme/sabbiancowebsite/assets/js/leaflet-gesture-handling.min.js"></script>
<script src="/theme/sabbiancowebsite/assets/js/leaflet-providers.js"></script>
<script src="/theme/sabbiancowebsite/assets/js/leaflet.markercluster.js"></script>
<script src="/theme/sabbiancowebsite/assets/js/map4.js?2"></script>
<script type="text/javascript">
	// window.addEventListener("load", (event) => {
		loadListingDetailListingDetails();
        loadSimilarListingsListingDetails();
	// });
	function loadListingDetailListingDetails(){
        index = '<?php echo $index; ?>';
		const url = "/api/activelistings";
		let xhr = new XMLHttpRequest();
        sendData = {
            "id": index,
        }
		xhr.open('POST', url, true);
		xhr.setRequestHeader('Content-type', 'application/json');
		xhr.send(JSON.stringify(sendData));
		xhr.onload = function () {
			list = JSON.parse(xhr.response);
            list = list.items;
			data = list.data[0];
            console.log(data);
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
                <a style="cursor: pointer;" onclick="addFavoritListingDetails(`+data.id+`)">
                    <i id="faHeart`+data.id+`" class="fa fa-heart" style="font-size: x-large; `+favorite+`"></i>
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
            
            var valueArray = [];
            valueArray.push(data.listingmarker);
            map_init(valueArray);

		}
	}
    function addFavoritListingDetails(index)
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
    function loadSimilarListingsListingDetails(){
		
        index = '<?php echo $index; ?>';
        const sendData = {
            "listing_id": index,
        };
		const url = "/api/getsimilarlistings";
		let xhr = new XMLHttpRequest();
		xhr.open('POST', url, true);
		xhr.setRequestHeader('Content-type', 'application/json');
        xhr.send(JSON.stringify(sendData));
		xhr.onload = function () {
			data = JSON.parse(xhr.response);
			list = data;
            temp = "";
            if(list.length > 3){
                size = 3;
            }else{
                size = list.length;
            }
            for(var i= 0; i<size; i++)
            {
                favorite = "";
                if(list[i].in_favoriteproperties == 1){
                    favorite = "color: red;";
                }
                temp +=`<div class="item col-lg-4 col-md-6 col-xs-12 landscapes sale">
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
                        <div class="col-lg-12 col-md-12 homes-content pb-0 mb-44"  style=" display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap;padding: 0px!important;box-shadow: none;">
                            <h3 class="title mt-3">
                                <a href="/page/listing-details?index=`+list[i].id+`" tabindex="0">€ `+ list[i].price+`</a>
                            </h3>
                            <div class="compare">
                                <a style="cursor: pointer;" onclick="addFavoritListingDetails(`+list[i].id+`)"><i id="faHeart`+list[i].id+`" class="fa fa-heart" style="font-size: x-large; ` + favorite + ` "></i></a>
                            </div>
                        </div></div></div></div>`;
            }
            document.getElementById("SimilarListingsContent").innerHTML = temp
		}
	}
    function sendRequestListingDetails()
    {
        customer_id = '<?php echo $user_id; ?>';
        index = '<?php echo $index; ?>';
        size = document.getElementById("ListingArea").innerHTML;
        price = document.getElementById("listingPrice").innerHTML;
        price = price.substring(2);
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
            loginIn();
        }
    }
</script>