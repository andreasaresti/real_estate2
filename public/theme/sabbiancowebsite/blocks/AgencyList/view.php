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
                    <aside class="col-lg-6 google-maps-left mt-0" style="position: sticky;">
                        <div class="row" style="display: flex;align-items: center;margin: 10px 0px 0px 60px; position: absolute;z-index: 9;">
                            <div class="col-lg-12 col-md-12" style="margin-top: 20px;">
                                <!-- <input type="number" class="kilometresListMap" name="kilometresListMap" min="0" max="100" placeholder="80" value="80" />&nbsp;&nbsp;&nbsp;&nbsp;
                                <input type="range" class="rangeListMap" name="rangeListMap" min="0" max="100" step="1" value="80" />&nbsp;&nbsp;&nbsp;&nbsp; -->
                                <!-- <a style="height: 40px;width: 130px;padding: 0px 0px 0px 0px;line-height: 40px;" class="btn btn-yellow" id="Show_Hide">Show/Hdie</a> -->
                            </div>
                            <div class="col-lg-12 col-md-12" style="margin-top: 20px;display:none" id="circleSize">
                                <div class="row" style="width: 98%;">
                                    <div class="col-lg-2 col-md-2">
                                        <a style="height: 40px;width: 65px;padding: 0px 0px 0px 0px;line-height: 40px;" class="btn btn-yellow" id="circleSize1" >+ 1 km</a>
                                    </div>
                                    <div class="col-lg-2 col-md-2">
                                        <a style="height: 40px;width: 65px;padding: 0px 0px 0px 0px;line-height: 40px;" class="btn btn-yellow" id="circleSize5" >+ 5 km</a>
                                    </div>
                                    <div class="col-lg-2 col-md-2">
                                        <a style="height: 40px;width: 65px;padding: 0px 0px 0px 0px;line-height: 40px;" class="btn btn-yellow" id="circleSize10" >+ 10 km</a>
                                    </div>
                                    <div class="col-lg-2 col-md-2">
                                        <a style="height: 40px;width: 65px;padding: 0px 0px 0px 0px;line-height: 40px;" class="btn btn-yellow" id="circleSize30" >+ 30 km</a>
                                    </div>
                                    <div class="col-lg-2 col-md-2">
                                        <a style="height: 40px;width: 65px;padding: 0px 0px 0px 0px;line-height: 40px;" class="btn btn-yellow" id="circleSize50" >+ 50 km</a>
                                    </div>
                                    <div class="col-lg-2 col-md-2">
                                        <a style="height: 40px;width: 65px;padding: 0px 0px 0px 0px;line-height: 40px;" class="btn btn-yellow" id="circleSize100" >+ 100 km</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="map-leaflet"></div>
                    </aside>
                    <div class="col-lg-6  google-maps-right mt-0" style="position: sticky;height: 100vh;">
                        <div class="row" id="ListingListContent" style="margin-left: 10px;">
                            
                        </div>
                    </div>
                </div>
                <!-- <div class="row" id="ListingListContent"></div> -->
            </div>
            <!-- <nav aria-label="..." class="pt-3">
                <ul class="pagination mt-0" id="pagin_content" style="display: flex;justify-content: center;">
                    
                </ul>
            </nav> -->
            <input type="hidden" id="page_index" value="1">
        </div>
    </section>
    <!-- <section class="blog blog-section">
        <div class="container-fluid">
            
            <nav aria-label="..." class="pt-3">
                <ul class="pagination mt-0" id="pagin_content">
                    
                </ul>
            </nav>
            <input type="hidden" id="page_index" value="1">
        </div>
    </section> -->
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
	window.addEventListener("load", (event) => {
        loadAgenciesAgencyList();
	});
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
                                        <p>Emai: `+list[i].email +`</p>
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
            
            // $( "#circleSize1" ).on('click', function() {
            //     set = 1;
            //     if(map.hasLayer(circle))
            //         map.removeLayer(circle);
            //     if(circleFlag == 1){
            //         circle = L.circle(curLocation, 1000*set).addTo(map);
            //         calculate_point();
            //     }
            // });
            // $( "#circleSize5" ).on('click', function() {
            //     set = 5;
            //     if(map.hasLayer(circle))
            //         map.removeLayer(circle);
            //     if(circleFlag == 1){
            //         circle = L.circle(curLocation, 1000*set).addTo(map);
            //         calculate_point();
            //     }
            // });
            // $( "#circleSize10" ).on('click', function() {
            //     set = 10;
            //     if(map.hasLayer(circle))
            //         map.removeLayer(circle);
            //     if(circleFlag == 1){
            //         circle = L.circle(curLocation, 1000*set).addTo(map);
            //         calculate_point();
            //     }
            // });
            // $( "#circleSize30" ).on('click', function() {
            //     set = 30;
            //     if(map.hasLayer(circle))
            //         map.removeLayer(circle);
            //     if(circleFlag == 1){
            //         circle = L.circle(curLocation, 1000*set).addTo(map);
            //         calculate_point();
            //     }
            // });
            // $( "#circleSize50" ).on('click', function() {
            //     set = 50;
            //     if(map.hasLayer(circle))
            //         map.removeLayer(circle);
            //     if(circleFlag == 1){
            //         circle = L.circle(curLocation, 1000*set).addTo(map);
            //         calculate_point();
            //     }
            // });
            // $( "#circleSize100" ).on('click', function() {
            //     set = 100;
            //     if(map.hasLayer(circle))
            //         map.removeLayer(circle);
            //     if(circleFlag == 1){
            //         circle = L.circle(curLocation, 1000*set).addTo(map);
            //         calculate_point();
            //     }
            // });
            // $( "#Show_Hide" ).on('click', function() {
            //     if(circleFlag == 1){
            //         marker.setLatLng([0,0], {
            //             draggable: 'true'
            //         }).bindPopup(data.latlng).update();
            //         curLocation = marker.getLatLng();
            //         if(map.hasLayer(circle))
            //             map.removeLayer(circle);
            //         circle = L.circle(curLocation, 0).addTo(map);
            //         circle.setLatLng(curLocation);
            //         circleFlag = 0;
            //         document.getElementById("circleSize").style.display = "none";
            //         calculate_point();
            //     }else{
            //         marker.setLatLng([34.994003757575776,33.19793701171876], {
            //             draggable: 'true'
            //         }).bindPopup(data.latlng).update();
            //         curLocation = marker.getLatLng();
            //         if(map.hasLayer(circle))
            //             map.removeLayer(circle);
            //         circle = L.circle(curLocation,1000*set).addTo(map);
            //         circle.setLatLng(curLocation);
            //         circleFlag = 1;
            //         document.getElementById("circleSize").style.display = "block";
            //         calculate_point();
            //     }
            // });
            
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
                // circle.setLatLng(curLocation);
                // calculate_point();
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
                // if(map.hasLayer(circle))
                // map.removeLayer(circle);
                // circle = L.circle(curLocation, 1000*set).addTo(map);
                // circle.setLatLng(curLocation);
                // circleFlag = 1;
                // document.getElementById("circleSize").style.display = "block";
                // calculate_point();
                
            });

            map.on("click", addMarker);

            // if(modeFlag){
            //     marker.setLatLng([34.994003757575776,33.15673828125001], {
            //         draggable: 'true'
            //     }).bindPopup(data.latlng).update();
            //     curLocation = marker.getLatLng();
            //     if(map.hasLayer(circle))
            //         map.removeLayer(circle);
            //     circle = L.circle(curLocation, 1000*set).addTo(map);
            //     circle.setLatLng(curLocation);
            //     circleFlag = 1;
            //     document.getElementById("circleSize").style.display = "block";
            //     calculate_point();
            // }

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
            // function calculate_point(){
            //     var agencyArray = [];
            //     markerArray.forEach((value, index) => {
            //         flag = 0;
            //         if(circleFlag == 1){
            //             distance = Math.pow((curLocation.lat-value._latlng.lat),2);
            //             distance += Math.pow((curLocation.lng-value._latlng.lng),2);
            //             distance = Math.sqrt(distance);
            //             if(distance < 0.0090437*set){
            //                 flag =1;
            //             }
            //         }else{
            //             flag =1;
            //         }
            //         if(flag == 1){
            //             map.addLayer(value);
            //             agencyArray.push(index);
            //         }else{
            //             map.removeLayer(value);
            //         }
            //     });
            //     loadSearchAgencyAgencyList(agencyArray);
            // }
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
                                <a href="#" class="news-img-link">
                                    <div class="news-item-img">
                                        <img class="resp-img" src="`+list[i].image+`" style="height: 220px;padding: 15px;">
                                    </div>
                                </a>
                                <div class="news-item-text">
                                    <a href="#"><h3>`+ list[i].name + `</h3></a>
                                    <div class="news-item-descr">
                                        <p>Emai: `+list[i].email +`</p>
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