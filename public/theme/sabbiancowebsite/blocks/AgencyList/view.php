<?php
 $serverUrl = env('APP_URL');
 if(isset($_SESSION["user_id"])){
    $user_id = $_SESSION["user_id"];
 }else{
    $user_id = "";
 }
?>
<div class="inner-pages homepage-4 agents hp-6 full hd-white">
<section class="blog blog-section">
    <div class="container-fluid">
        <div class="row">
            <aside class="col-lg-6 google-maps-left mt-0" style="position: sticky;">
                <div id="map-leaflet"></div>
            </aside>
            <div class="col-lg-6  google-maps-right mt-0" style="position: sticky;height: 100vh;">
                <div class="row" id="ListingListContent" style="margin-left: 10px;">
                    
                </div>
            </div>
        </div>
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
    var countriesAgencyList = [];
	// window.addEventListener("load", (event) => {
        loadCountryAgencyList();
        
	// });
    function loadCountryAgencyList(){
        const url = "/api/get-countries";
		let xhr = new XMLHttpRequest();
		xhr.open('POST', url, true);
		xhr.setRequestHeader('Content-type', 'application/json');
		xhr.send();
		xhr.onload = function () {
			data = JSON.parse(xhr.response);
            list = data.data;
            for(i=0;i<list.length;i++){
                countriesAgencyList.push({"code":list[i].code,"name":list[i].displayname});
            }
            loadAgenciesAgencyList();
        }
    }
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
            map_init(valueArray);
            temp = "";
            for(i= 0; i<list.length; i++)
            {
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
                                        <p>Country:`+getCountryAgencyList(list[i].country) +`</p>
                                    </div>
                                </div>
                            </div>
                        </div>`;
            }
            document.getElementById("ListingListContent").innerHTML = temp;
		}
	}
    function getCountryAgencyList(code){
        for(i=0;i<countriesAgencyList.length;i++){
            if(countriesAgencyList[i].code == code){
                return countriesAgencyList[i].name;
            }
        }
    }
    
</script>