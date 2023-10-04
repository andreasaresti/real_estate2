<?php
 if(isset($_SESSION["user_id"])){
    $user_id = $_SESSION["user_id"];
 }else{
    $user_id = "";
 }
?>
<div class="homepage-9 hp-6 homepage-1 mh">
    <div id="wrapper">
        <section class="featured portfolio rec-pro disc">
            <div class="container-fluid">
                <div class="sec-title discover">
                    <h2><span>Discover </span>Popular Properties</h2>
                    <p>We provide full service at every step.</p>
                </div>
                <div class="portfolio col-xl-12">
                    <div class="slick-lancers">
                        <div class="agents-grid">
                            <div class="landscapes">
                            </div>
                        </div>
                        <div class="agents-grid">
                            <div class="people">
                                
                            </div>
                        </div>
                        <div class="agents-grid">
                            <div class="people landscapes no-pb pbp-3">
                               
                            </div>
                        </div>
                        <div class="agents-grid">
                            <div class="landscapes">
                                
                            </div>
                        </div>
                        <div class="agents-grid" data-aos="fade-up">
                            <div class="people">
                                
                            </div>
                        </div>
                        <div class="agents-grid" data-aos="fade-up">
                            <div class="people landscapes no-pb pbp-3">
                                
                            </div>
                        </div>
                        <div class="agents-grid" data-aos="fade-up">
                            <div class="landscapes">
                                
                            </div>
                        </div>
                        <div class="agents-grid" data-aos="fade-up">
                            <div class="people">
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>
<script type="text/javascript">
    window.addEventListener("load", (event) => {
		loadPoplarListingsListPopularProperties();
        
	});
    function loadPoplarListingsListPopularProperties(){
		
        user_id = '<?php echo $user_id; ?>';
        const sendData = {
            "popular": 1,
            "customer_id": user_id,
        };
		const url = "/api/activelistings";
		let xhr = new XMLHttpRequest();
		xhr.open('POST', url, true);
		xhr.setRequestHeader('Content-type', 'application/json');
		xhr.send(JSON.stringify(sendData));
		xhr.onload = function () {
			list = JSON.parse(xhr.response).items.data;
            if(list.length >= 8){
                size = 8;
            }else{
                size = list.length;
            }
            for(i= 0; i<size; i++)
            {
                favorite = "";
                if(list[i].in_favoriteproperties == 1){
                    favorite = "color: red;";
                }
                temp =`<div class="people">
                                <div class="project-single">
                                    <div class="project-inner project-head">
                                        <div class="homes">
                                            <!-- homes img -->
                                            <a onclick="showListigDetailModal(`+list[i].id+`);" class="homes-img" tabindex="0">`;
                                    if(list[i].featured == 1){
                                        temp +=`<div class="homes-tag button alt featured">Featured</div>`;
                                    }
                                    temp +=`<div class="homes-tag button alt sale">`+list[i].property_type+`</div>
                                                <img src="`+list[i].image+`" alt="home-1" class="img-responsive">
                                            </a>
                                        </div>
                                    </div>
                                    <!-- homes content -->
                                    <div class="homes-content">
                                        <!-- homes address -->
                                        <h3><a style="display: block;height: 80px;overflow-y: hidden;" onclick="showListigDetailModal(`+list[i].id+`);" tabindex="0">`+list[i].displayname+`</a></h3>
                                        <p class="homes-address mb-3">
                                            <a onclick="showListigDetailModal(`+list[i].id+`);" tabindex="0">
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
                                    temp +=`</ul>
                                        <div class="price-properties pb-0">
                                            <h3 class="title mt-3">
                                                <a onclick="showListigDetailModal(`+list[i].id+`);" tabindex="0">€ `+ list[i].price+`</a>
                                            </h3>
                                            <div class="compare">
                                                <a style="cursor: pointer;" onclick="addFavoritPopularProperties(`+list[i].id+`)"><i id="faHeartPopularProperties`+list[i].id+`" class="fa fa-heart" style="font-size: x-large; ` + favorite + ` "></i></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>`;
                document.getElementById("slick-slide0"+i).innerHTML = temp
            }
            
		}
	}
    function addFavoritPopularProperties(index)
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
                
                var paragraph = document.getElementById("faHeartPopularProperties"+index);
                if(paragraph.style.color !== "red"){
                    paragraph.style.color = "red";
                }else{
                    paragraph.style.color = "currentColor";
                }
                loadPoplarListingsListPopularProperties();
            }
        }else{
            loginIn();
        }
    }
</script>