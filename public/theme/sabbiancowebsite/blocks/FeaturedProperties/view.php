<?php
 $serverUrl = env('APP_URL');
 if(isset($_SESSION["user_id"])){
    $user_id = $_SESSION["user_id"];
 }else{
    $user_id = "";
 }
?>
<div class="homepage-9 hp-6 homepage-1 mh">
    <div id="wrapper">
        <section class="featured portfolio bg-white-2 rec-pro full-l">
            <div class="container-fluid">
                <div class="sec-title">
                    <h2><span>Featured </span>Properties</h2>
                    <p>These are our featured properties</p>
                </div>
                <div class="row portfolio-items" id="FeaturedListingListContent">
                    
                </div>
                <div class="bg-all">
                    <a href="/page/listings" class="btn btn-outline-light">View More</a>
                </div>
            </div>
        </section>
    </div>
</div>
<script type="text/javascript">
    // window.addEventListener("load", (event) => {
		loadFeaturedListingsListFeaturedProperties();
        
	// });
    function loadFeaturedListingsListFeaturedProperties(){
		
        user_id = '<?php echo $user_id; ?>';
        const sendData = {
            "customer_id": user_id,
            "featured": 1,
        };
		const url = "/api/activelistings";
		let xhr = new XMLHttpRequest();
		xhr.open('POST', url, true);
		xhr.setRequestHeader('Content-type', 'application/json');
		xhr.send(JSON.stringify(sendData));
		xhr.onload = function () {
			data = JSON.parse(xhr.response);
			list = data.data;
            temp = "";
            if(list.length >= 6){
                size = 6;
            }else{
                size = list.length;
            }
            for(var i= 0; i<size; i++)
            {
                favorite = "";
                if(list[i].in_favoriteproperties == 1){
                    favorite = "color: red;";
                }
                temp +=`<div class="item col-xl-6 col-lg-12 col-md-12 col-xs-12 it2 web rent no-pb">
                            <div class="project-single no-mb last" >
                                <div class="project-inner project-head">
                                    <div class="homes">
                                        <!-- homes img -->
                                        <a href="/page/listing-details?index=`+list[i].id+`" class="homes-img">`;
                                    if(list[i].featured == 1){
                                        temp +=`<div class="homes-tag button alt featured">Featured</div>`;
                                    }
                                    temp +=`<div class="homes-tag button sale rent">`+list[i].property_type+`</div>
                                            <img src="`+list[i].image+`" alt="home-1" class="img-responsive">
                                        </a>
                                    </div>
                                    <div class="button-effect">
                                        <a href="/page/listing-details?index=`+list[i].id+`" class="btn"><i class="fa fa-link"></i></a>
                                        <a href="https://www.youtube.com/watch?v=14semTlwyUY" class="btn popup-video popup-youtube"><i class="fas fa-video"></i></a>
                                        <a href="single-property-2.html" class="img-poppu btn"><i class="fa fa-photo"></i></a>
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
                                    temp +=`
                                    </ul>
                                    <div class="price-properties pt-3 pb-0">
                                        <h3 class="title mt-3">
                                            <a href="/page/listing-details?index=`+list[i].id+`">€‎`+ list[i].price+`</a>
                                        </h3>
                                        <div class="compare">
                                            <a style="cursor: pointer;" onclick="addFavoritFeaturedProperties(`+list[i].id+`)"><i id="faHeart`+list[i].id+`" class="fa fa-heart" style="font-size: x-large; ` + favorite + ` "></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            </div>`;
            }
            document.getElementById("FeaturedListingListContent").innerHTML = temp
		}
	}
    function addFavoritFeaturedProperties(index)
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
                loadFeaturedListingsListFeaturedProperties();
            }
        }else{
            loginIn();
        }
    }
</script>