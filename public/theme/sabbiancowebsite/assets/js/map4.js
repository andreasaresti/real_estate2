//$(document).ready(function () {
function map_init(valueArray){
	'use strict';
	if ($('#map-leaflet').length) {
		var container = L.DomUtil.get('map');
		if(container != null){
		container._leaflet_id = null;
		}
		console.log('hi2');

		console.log(map); // should output the object that represents instance of Leaflet
		if (map !== undefined && map !== null) {
			console.log('hi2');
			map.remove(); // should remove the map from UI and clean the inner children of DOM element
		console.log(map); // nothing should actually happen to the value of mymap
		}
		console.log('hi4');

		var map = L.map('map-leaflet', {
			zoom: 9,
			maxZoom: 20,
			tap: false,
			gestureHandling: true,
			center: [40.90, -73.90]
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
	}
}
//});
