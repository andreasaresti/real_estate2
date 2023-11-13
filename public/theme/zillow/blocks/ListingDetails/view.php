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
        <div id="detail-container-column" class="active-hdp-col yui3-app-views">
            <div class="active-view preload-lightbox">
                <div id="__next">
                    <div data-test="hdp-for-sale-page-content">
                        <div class="hdp__sc-9dqr3g-0 gDrWtP ds-wrapper fs-package">
                            <div class="hdp__sc-9dqr3g-1 KyLea ds-container">
                                <div class="layout-wrapper" style="height: auto;">
                                    <div class="layout-container " style="position: initial;">
                                        <div class="media-column-container" style="overflow-y:auto">
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
                                                                                    <span> bed</span>
                                                                                    <span color="colors.gray300" class="dpf__sc-13frln-0 haJXRk"></span>
                                                                                </span>
                                                                                <!-- <button type="button" aria-expanded="false" aria-haspopup="false" class="TriggerText-c11n-8-84-3__sc-139r5uq-0 eJlkOp TooltipPopper-c11n-8-84-3__sc-io290n-0 hdp__sc-1vcj1w9-0 cPCtZj"> -->
                                                                                <span data-testid="bed-bath-item" id="ListingBathTitleDiv" class="Text-c11n-8-84-3__sc-aiai24-0 hrfydd">
                                                                                    <i class="flaticon-bathtub mr-2" aria-hidden="true"></i>
                                                                                    <strong id="ListingBathTitle"></strong>
                                                                                    <span> bath</span>
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
                                            <div class="data-view-container" style="overflow-y:auto">
                                                <div class="ds-data-view-list">
                                                    <div class="hdp__sc-1jydst6-0 lckxKm">
                                                        <div class="single homes-content details mb-30">
                                                            <!-- title -->
                                                            <h3 class="mb-3">Property Details</h3>
                                                            <ul class="clearfix">
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
                                                            <h3 class="mb-3">Description</h3>
                                                            <p id="listingDescription"></p>
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
        <!-- <section class="similar-property featured portfolio p-0 bg-white-inner mt-5">
            <div class="container">
                <h3>Similar Properties</h3>
                <div class="row portfolio-items" id="SimilarListingsContent" style="height:auto!important">
                </div>
            </div>
        </section> -->
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
        // loadSimilarListingsListingDetails();
	// });
	function loadListingDetailListingDetails(){
        index = '<?php echo $index; ?>';
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
            if(data.number_of_bathrooms !== null  && data.number_of_bathrooms>0){
                document.getElementById("ListingBath").innerHTML = data.number_of_bathrooms;
                document.getElementById("ListingBathTitle").innerHTML = data.number_of_bathrooms;
            }else{
                document.getElementById("ListingBathDiv").style.display = "none";
                document.getElementById("ListingBathTitleDiv").style.display = "none";
            }
            if(data.number_of_bedrooms !== null && data.number_of_bedrooms>0){
                document.getElementById("ListingBedrooms").innerHTML = data.number_of_bedrooms;
                document.getElementById("ListingBedroomsTitle").innerHTML = data.number_of_bedrooms;
            }else{
                document.getElementById("ListingBedroomsDiv").style.display = "none";
                document.getElementById("ListingBedroomsTitleDiv").style.display = "none";
            }
            if(data.area_size !== null  && data.area_size>0){
                document.getElementById("ListingArea").innerHTML = data.area_size + "sqm";
                document.getElementById("ListingAreaTitle").innerHTML = data.area_size;
            }else{
                document.getElementById("ListingAreaDiv").style.display = "none";
                document.getElementById("ListingAreaTitleDiv").style.display = "none";
            }

            if(data.property_type !== null ){
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
            temp = data.displaydescription;
            temp = temp.replaceAll("col-lg-6","col-lg-12");
            document.getElementById("listingDescription").innerHTML = temp;
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
    var mapListingsDetail = null;
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
                                    <h3><a style="display: block;height: 80px;overflow-y: hidden;" href="/page/listing-details?index=`+list[i].id+`">`+list[i].displayname+`</a></h3>
                                    <p class="homes-address mb-3">
                                        <a href="/page/listing-details?index=`+list[i].id+`">
                                            <i class="fa fa-map-marker"></i><span>`+list[i].location_name+`</span>
                                        </a>
                                    </p>
                                    <!-- homes List -->
                                    <ul style="display: block;height: 58px;overflow-y: hidden;" class="homes-list clearfix pb-0">`;
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
                            <h3 class="title mt-3">`;
                        if(parseInt(list[i].price)>0){
                            temp +=`<a href="/page/listing-details?index=`+list[i].id+`" tabindex="0">€ `+ list[i].price+`</a>`;
                        }
                        temp +=`</h3>
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
            loginIn();
        }
    }
</script>