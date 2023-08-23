<?php
 if(isset($_SESSION["user_id"])){
    $user_id = $_SESSION["user_id"];
 }else{
    $user_id = "";
 }
?>
<div class="inner-pages homepage-4 agents hp-6 full hd-white">
<section class="blog-section">
            <div class="container">
                <div class="news-wrap">
                    <div class="row">
                        <!-- <aside class="col-lg-6 google-maps-left mt-0" style="position: sticky;">
                            <div id="map-leaflet"></div>
                        </aside> -->
                        <div class="col-lg-12  google-maps-right mt-0" style="position: sticky;height: 100vh;">
                            <div class="row" id="ListingListContent" style="margin-left: 10px;">
                                
                            </div>
                        </div>
                    </div>
                    <!-- <div class="row" id="ListingListContent"></div> -->
                </div>
                <nav aria-label="..." class="pt-3">
                    <ul class="pagination mt-0" id="pagin_content" style="display: flex;justify-content: center;">
                        
                    </ul>
                </nav>
                <input type="hidden" id="page_index" value="1">
            </div>
        </section>
<section class="blog blog-section">
    <div class="container-fluid">
        
        <nav aria-label="..." class="pt-3">
            <ul class="pagination mt-0" id="pagin_content">
                
            </ul>
        </nav>
        <input type="hidden" id="page_index" value="1">
    </div>
</section>
</div>
<script src="/theme/sabbiancowebsite/assets/js/leaflet.js"></script>
<script src="/theme/sabbiancowebsite/assets/js/leaflet-gesture-handling.min.js"></script>
<script src="/theme/sabbiancowebsite/assets/js/leaflet-providers.js"></script>
<script src="/theme/sabbiancowebsite/assets/js/leaflet.markercluster.js"></script>
<script src="/theme/sabbiancowebsite/assets/js/map4.js?2"></script>
<script type="text/javascript">
    // var countries = [];
	window.addEventListener("load", (event) => {
        load_agencies();
	});
    // function loadCountry(){
    //     const url = "/api/get-countries";
	// 	let xhr = new XMLHttpRequest();
	// 	xhr.open('POST', url, true);
	// 	xhr.setRequestHeader('Content-type', 'application/json');
	// 	xhr.send();
	// 	xhr.onload = function () {
	// 		data = JSON.parse(xhr.response);
    //         list = data.data;
    //         for(i=0;i<list.length;i++){
    //             countries.push({"code":list[i].code,"name":list[i].displayname});
    //         }
    //         load_agencies();
    //     }
    // }
    function load_agencies(){
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
                    lat = list[i].longitude;
                    lng = list[i].latitude;
                    center = [ list[i].longitude, list[i].latitude];
                    temp = {
                        "id": list[i].address,
                        "center":center,
                        "icon": "<i class='fa fa-home'></i>",
                        "title": list[i].name,
                        "desc": "",
                        "price": "",
                        "image": list[i].image,
                        "link": ""
                    };
                    valueArray.push(temp);
                }
            }
            // map_init1(valueArray, lat, lng);
            temp = "";
            for(i= 0; i<list.length; i++)
            {
                // alert(i);
                // console.log(list[i].image);
                // console.log(list[i].name);
                // console.log(list[i].email);
                // console.log(list[i].phone);
                // console.log(list[i].address);
                // console.log(list[i].city);
                // console.log(get_country(list[i].country));
                
                temp +=` <div class="col-md-12 col-xs-12">
                            <div class="news-item news-item-sm" style="height: auto">
                                <a href="#" class="news-img-link">
                                    <div class="news-item-img">
                                        <img class="resp-img" src="`+list[i].image+`" style="height: 220px;padding: 10px;">
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
    function map_init1(valueArray, lat, lng){
	'use strict';

	

	if ($('#map-leaflet').length) {
		var container = L.DomUtil.get('map');
		if(container != null){
		container._leaflet_id = null;
		}
		// console.log('hi2');

		// console.log(map); // should output the object that represents instance of Leaflet
		if (map !== undefined && map !== null) {
			// console.log('hi2');
			map.remove(); // should remove the map from UI and clean the inner children of DOM element
		    // console.log(map); // nothing should actually happen to the value of mymap
		}
		// console.log('hi4');

		var map = L.map('map-leaflet', {
			zoom: 9,
			maxZoom: 20,
			tap: false,
			gestureHandling: true,
			center: [lat, lng]
		});
		var marker_cluster = L.markerClusterGroup();

		map.scrollWheelZoom.disable();

		

		var OpenStreetMap_DE = L.tileLayer('https://{s}.tile.openstreetmap.de/tiles/osmde/{z}/{x}/{y}.png', {
			scrollWheelZoom: false,
			attribution: '&copy; <a href="http://osm.org/copyright">OpenStreetMap</a> contributors'
		}).addTo(map);

		// $.ajax('/theme/sabbiancowebsite/assets/js/markers.json', {

		// 	success: function (markers) {
		// 		$.each(markers, function (index, value) {
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
		// 		});

		// 		map.addLayer(marker_cluster);
		// 	},
		// 	error: function() {
		// 		// alert("No");
		// 	}
		// });
	}
}
    // function get_country(code){
    //     for(i=0;i<countries.length;i++){
    //         if(countries[i].code == code){
    //             return countries[i].name;
    //         }
    //     }
    // }
    
</script>