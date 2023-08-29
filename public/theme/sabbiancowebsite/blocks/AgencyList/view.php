<?php
 if(isset($_SESSION["user_id"])){
    $user_id = $_SESSION["user_id"];
 }else{
    $user_id = "";
 }
?>
<div class="inner-pages homepage-4 agents hp-6 full hd-white">
    <section class="blog-section" style="padding: 20px 0px 0px 0px;">
        <div class="container">
            <div class="news-wrap">
                <div class="row">
                    <div class="col-lg-12" style="height:300px; margin-bottom:20px">
                        <div id="map-leaflet"></div>
                    </div>
                    <div class="col-lg-12">
                        <div class="row" id="ListingListContent">
                            
                        </div>
                    </div>
                </div>
                <!-- <div class="row" id="ListingListContent"></div> -->
            </div>
            <input type="hidden" id="page_index" value="1">
        </div>
    </section>
</div>
<script src="https://code.jquery.com/jquery-2.2.4.min.js" ></script>
<script src="https://cdn.jsdelivr.net/leaflet/1.0.0-rc.1/leaflet-src.js" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/leaflet.esri/2.0.0/esri-leaflet.js" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/leaflet.esri.geocoder/2.1.0/esri-leaflet-geocoder.js" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/leaflet.markercluster/1.0.0-beta.2.0/leaflet.markercluster.js" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/leaflet.markercluster/1.0.0-beta.2.0/leaflet.markercluster-src.js" crossorigin="anonymous"></script>


<script type="text/javascript">
    var map = null;
    var circle;
	// window.addEventListener("load", (event) => {
        loadAgenciesAgencyList();
	// });
    function loadAgenciesAgencyList(){
        const sendData = {
            // "id": id,
        };
		const url = "/api/get-agencies";
		let xhr = new XMLHttpRequest();
		xhr.open('POST', url, true);
		xhr.setRequestHeader('Content-type', 'application/json');
		xhr.send(JSON.stringify(sendData));
		xhr.onload = function () {
			data = JSON.parse(xhr.response);
			list = data.data;
            var valueArray = [];
            var temp = "";
            
            for(i= 0; i<list.length; i++)
            {
                if(list[i].longitude != null && list[i].latitude != null){
                    center = [ list[i].longitude, list[i].latitude];
                    temp = {
                        "id": list[i].id,
                        "address": list[i].address,
                        "center":center,
                        "icon": "<i class='fa fa-home'></i>",
                        "title": list[i].name,
                        "image": list[i].image,
                        "link": ""
                    };
                    valueArray.push(temp);
                }
            }
            mapInitAgencyList(valueArray,false);
            temp = "";
            for(i= 0; i<list.length; i++)
            {
                temp +=` <div class="col-md-12 col-xs-12" style="margin-bottom: 10px;">
                            <div class="news-item news-item-sm" style="height: auto">
                                <a href="#" class="news-img-link">
                                    <div class="news-item-img">
                                        <img class="resp-img" src="`+list[i].image+`" style="height: 220px;padding: 15px;">
                                    </div>
                                </a>
                                <div class="news-item-text">
                                    <a href="#"><h3>`+ list[i].name + `</h3></a>
                                    <div class="news-item-descr">
                                        <p>Email: `+list[i].email +`</p>
                                        <p>Phone: `+list[i].phone +`</p>
                                        <p>Address: `+list[i].address +`</p>
                                        <p>City: `+list[i].city +`</p>
                                        <p>Country:`+list[i].country +`</p>
                                    </div>
                                </div>
                            </div>
                        </div>`;
                
                        
            }
            document.getElementById("ListingListContent").innerHTML = temp;
		}
	}
    function mapInitAgencyList(valueArray,modeFlag){

        if ($('#map-leaflet').length) {

            let curLocation = [0, 0];
            var circleFlag = 0;
            var container = L.DomUtil.get('map');
            if(container != null){
                container._leaflet_id = null;
            }
            
            if (map !== undefined && map !== null) {
                map.remove(); // should remove the map from UI and clean the inner children of DOM element
                circleFlag = 0;
            }
            map = L.map('map-leaflet').setView([34.994003757575776,33.25703828125001], 9);

            L.tileLayer('http://{s}.tile.osm.org/{z}/{x}/{y}.png').addTo(map);

            // circle = L.circle(curLocation, 0).addTo(map);

            let set = 100;
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
                curLocation = marker.getLatLng();
                marker.setLatLng(curLocation, {
                    draggable: 'true'
                });
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
                
            });

            map.on("click", addMarker);

            function addMarker(e) {
                if(circleFlag == 1){
                    marker.setLatLng(e.latlng, {
                        draggable: 'true'
                    }).bindPopup(e.latlng).update();
                    curLocation = marker.getLatLng();
                    circle.setLatLng(curLocation);
                    calculate_point();
                }
            }
        }
    }
    function loadSearchAgencyAgencyList(agencyArray){
        const sendData = {
            "agencies":agencyArray,
        };
		const url = "/api/get-mapAgencies";
		let xhr = new XMLHttpRequest();
		xhr.open('POST', url, true);
		xhr.setRequestHeader('Content-type', 'application/json');
		xhr.send(JSON.stringify(sendData));
		xhr.onload = function () {
			list = JSON.parse(xhr.response);
            
            var temp = "";
            for(i= 0; i<list.length; i++)
            {
                temp +=` <div class="col-md-12 col-xs-12" style="margin-bottom: 10px;">
                            <div class="news-item news-item-sm" style="height: auto">
                                <div class="news-item-img">
                                    <img class="resp-img" src="`+list[i].image+`" style="height: 220px;padding: 15px;">
                                </div>
                                <div class="news-item-text">
                                    <a href="#"><h3>`+ list[i].name + `</h3></a>
                                    <div class="news-item-descr">
                                        <p>Email: `+list[i].email +`</p>
                                        <p>Phone: `+list[i].phone +`</p>
                                        <p>Address: `+list[i].address +`</p>
                                        <p>City: `+list[i].city +`</p>
                                        <p>Country:`+list[i].country +`</p>
                                    </div>
                                </div>
                            </div>
                        </div>`;
            }
            document.getElementById("ListingListContent").innerHTML = temp;
		}
	}
</script>