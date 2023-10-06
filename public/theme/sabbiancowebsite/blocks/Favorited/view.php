<?php
 if(isset($_SESSION["user_id"])){
    $user_id = $_SESSION["user_id"];
 }else{
    $user_id = "";
 }
if(isset($_SESSION["user_role"])){
    $user_role = $_SESSION["user_role"];
 }else{
    $user_role = "";
 }
?>
<section class="properties-list featured portfolio blog">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-3 col-md-12 col-xs-12 pl-0 pr-0 user-dash">
                <div class="user-profile-box mb-0">
                    <div class="detail clearfix">
                        <ul class="mb-0">
                            <?php if($user_id != ''){
                                if($user_role == "sales_people"){ ?>
                                <li>
                                    <a href="/page/dashboard">
                                        <i class="fa fa-map-marker"></i> Dashboard
                                    </a>
                                </li>
                                <li>
                                    <a href="/page/salesequest-pendingappproval">
                                        <i class="fa fa-list"></i> Sale Requests Pending/Appproval
                                    </a>
                                </li>
                                <li>
                                    <a href="/page/salesequest-open">
                                        <i class="fa fa-list"></i> Sales Requests Open
                                    </a>
                                </li>
                            <?php }}?>

                            <li>
                                <a   href="/page/profile">
                                    <i class="fa fa-user"></i>Profile
                                </a>
                            </li>
                            <li>
                                <a href="/page/my-listings">
                                    <i class="fa fa-list" aria-hidden="true"></i>My Properties
                                </a>
                            </li>
                            <li>
                                <a class="active" href="/page/favorited">
                                    <i class="fa fa-heart" aria-hidden="true"></i>Favorited Properties
                                </a>
                            </li>
                            <li>
                                <a href="/page/add-listings">
                                    <i class="fa fa-list" aria-hidden="true"></i>Add Property
                                </a>
                            </li>
                            <li>
                                <a href="/page/changepassword">
                                    <i class="fa fa-lock"></i>Change Password
                                </a>
                            </li>
                            <li>
                                <a onclick="signOut()">
                                    <i class="fas fa-sign-out-alt"></i>Log Out
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-lg-9 col-md-12 col-xs-12 pl-0 user-dash2">
                <div class="container">
                    <div class="row" id="ListingListContent" style="display: flex;justify-content: center;">
            
                    </div>
                    <nav aria-label="..." class="pt-3" style="display: flex;justify-content: center;">
                        <ul class="pagination mt-0" id="pagin_content">
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <input type="hidden" id="page_index" value="1">
</section>
<script type="text/javascript">
    // window.addEventListener("load", (event) => {
        user_id = '<?php echo $user_id; ?>';
        if(user_id == ""){
            window.location.href="/page/home";
        }
		loadActiveListingsListFavorited();
        
	// });
    function loadActiveListingsListFavorited(){
        user_id = '<?php echo $user_id; ?>';
        const sendData = {
            "customer_id": user_id,
            "show_favorites": 1,
            "page": document.getElementById("page_index").value,
        };
		const url = "/api/activelistings";
		let xhr = new XMLHttpRequest();
		xhr.open('POST', url, true);
		xhr.setRequestHeader('Content-type', 'application/json');
		xhr.send(JSON.stringify(sendData));
		xhr.onload = function () {
			list = JSON.parse(xhr.response).items.data;
            temp = "";
            for(var i= 0; i<list.length; i++)
            {
                favorite = "";
                if(list[i].in_favoriteproperties == 1){
                    favorite = "color: red;";
                }
                temp +=`
                    <div class="row" style="display: flex;padding: 10px;width: 100%;">
                    <div class="item col-lg-4 col-md-12 col-xs-12 landscapes sale pr-0 pb-0 my-44 ft" >
                        <div class="project-single mb-0 bb-0">
                            <div class="project-inner project-head">
                                <div class="homes">
                                    <a href="/page/listing-details?index=`+list[i].id+`" class="homes-img">`;
                if(list[i].featured == 1){
                    temp +=`<div class="homes-tag button alt featured">Featured</div>`;
                }
                temp +=`<div class="homes-tag button alt sale">`+list[i].property_type+`</div>
                                        
                                        <img src="`+list[i].image+`" alt="home-1" class="img-responsive">
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-7 col-md-12 homes-content pb-0 mb-44" >
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
                        </div>
                        <div class="col-lg-1 col-md-12 homes-content pb-0 mb-44"  style=" display: flex; justify-content: space-around; align-items: center; flex-wrap: wrap;">
                            <h3 class="title mt-3">`;
                        if(parseInt(list[i].price)>0){
                            temp +=`<a href="/page/listing-details?index=`+list[i].id+`" tabindex="0">€ `+ list[i].price+`</a>`;
                        }
                        temp +=`</h3>
                            <div class="compare">
                                <a style="cursor: pointer;" onclick="addFavoritFavorited(`+list[i].id+`)"><i id="faHeart`+list[i].id+`" class="fa fa-heart" style="font-size: x-large; ` + favorite + ` "></i></a>
                            </div>
                        </div>
                    </div>`;
            }
            document.getElementById("ListingListContent").innerHTML = temp

            sendData1 = {
                "total": data.total,
                "current_page": data.current_page,
                "per_page": data.per_page,
            }
            const url1 = "/api/getpagination";
            let xhr1 = new XMLHttpRequest();
            xhr1.open('POST', url1, true);
            xhr1.setRequestHeader('Content-type', 'application/json');
            xhr1.send(JSON.stringify(sendData1));
            xhr1.onload = function () {
                data1 = JSON.parse(xhr1.response);
                list1 = data1.links;
                temp1 = "";
                if(window.innerWidth > 650){
                    for(j=0;j<list1.length;j++){
                        tempUrl = list1[j].url;
                        if(tempUrl == null){
                            tempIndex = null;
                        }else{
                            tempIndex = tempUrl.substring(tempUrl.indexOf("?page=")+6);
                        }
                        flag = "";
                        if(list1[j].active){
                            flag = "active";
                        }
                        temp1 += `<li class="page-item `+flag+`"><a class="page-link" onclick="loadPageFavorited(`+tempIndex+`)">`+list1[j].label+`</a></li>`;
                    }
                }else{
                    for(j=0;j<list1.length;j++){
                        tempUrl = list1[j].url;
                        if(tempUrl == null){
                            tempIndex = null;
                        }else{
                            tempIndex = tempUrl.substring(tempUrl.indexOf("?page=")+6);
                        }
                        if(j==0 || j == list1.length-1){
                            temp1 += `<li class="page-item"><a class="page-link" onclick="loadPageFavorited(`+tempIndex+`)">`+list1[j].label+`</a></li>`;    
                        }else{
                            if(list1[j].active){
                                flag = "active";
                                temp1 += `<li class="page-item `+flag+`"><a class="page-link" onclick="loadPageFavorited(`+tempIndex+`)">`+list1[j].label+`</a></li>`;
                            }
                        }
                    }
                }
                document.getElementById("pagin_content").innerHTML = temp1;
            }
		}
	}
    function addFavoritFavorited(index)
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
                loadActiveListingsListFavorited();
            }
        }else{
            loginIn();
        }
    }
    function loadPageFavorited(index){
        document.getElementById("page_index").value = index;
		loadActiveListingsListFavorited();
	}
</script>