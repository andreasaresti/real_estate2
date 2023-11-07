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

<script type="text/javascript">
    var map = [];
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
                temp +=` <div class="col-md-12 col-xs-12" style="margin-bottom: 10px;">
                            <div class="news-item news-item-sm" style="height: auto">
                                <div style="width:300px;" id="agencyMap`+list[i].id+`"></div>
                                <div class="news-item-text">
                                <div style="width: 100%;display: flex;justify-content: space-between;margin: 5px 10px 5px 10px;">
                                <a href="#"><h3>`+ list[i].name + `</h3></a>`;
				if(list[i].map !== null && list[i].map !== ""){
					temp +=`<a onclick="window.open('`+ list[i].map + `', '_blank', 'location=yes,height=760,width=1024,scrollbars=yes,status=yes');">
								<i class="fa fa-external-link" aria-hidden="true"></i>
							</a>`;
				}
				temp +=`</div><div class="news-item-descr">
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
            mapInitAgencyList(valueArray);
		}
	}
    function mapInitAgencyList(valueArray){
            
            for(i=0;i<valueArray.length;i++){//valueArray.forEach((value) => {
                value = valueArray[i];
                map[i] = L.map('agencyMap'+value.id).setView(value.center, 9);

                L.tileLayer('http://{s}.tile.osm.org/{z}/{x}/{y}.png').addTo(map[i]);
                var icon = L.divIcon({
                    html: value.icon,
                    iconSize: [50, 50],
                    iconAnchor: [50, 50],
                    popupAnchor: [-20, -42]
                });
                var marker = L.marker(value.center, {
                    icon: icon
                });
                map[i].addLayer(marker);
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
            }
            //})
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