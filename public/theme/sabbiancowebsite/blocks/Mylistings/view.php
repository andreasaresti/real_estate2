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
<section class="user-page section-padding pt-5">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-3 col-md-12 col-xs-12 pl-0 pr-0 user-dash">
                <div class="user-profile-box mb-0">
                    <div class="detail clearfix">
                        <ul class="mb-0">
                            <li>
                                <a href="/page/dashboard">
                                    <i class="fa fa-map-marker"></i> Dashboard
                                </a>
                            </li>
                            <?php if($user_id != ''){
                                if($user_role == "sales_people"){ ?>
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
                                <a  href="/page/profile">
                                    <i class="fa fa-user"></i>Profile
                                </a>
                            </li>
                            <li>
                                <a class="active"  href="/page/my-listings">
                                    <i class="fa fa-list" aria-hidden="true"></i>My Properties
                                </a>
                            </li>
                            <li>
                                <a href="/page/favorited">
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
            <div class="col-lg-9 col-md-12 col-xs-12  user-dash2">
                <div class="my-properties">
                    <table class="table-responsive">
                        <thead>
                            <tr>
                                <th class="pl-2">My Properties</th>
                                <th class="p-0"></th>
                                <th>Date Added</th>
                            </tr>
                        </thead>
                        <tbody id ="ListingListContent">
                            
                        </tbody>
                    </table>
                    <div class="pagination-container" >
                        <nav style="display: flex;align-items: center;justify-content: center;">
                            <ul class="pagination" id="pagin_content">
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<script type="text/javascript">
    window.addEventListener("load", (event) => {
        user_id = '<?php echo $user_id; ?>';
        if(user_id == ""){
            window.location.href="/page/home";
        }
		loadActivelistingsListMylistings();
	});
    function loadActivelistingsListMylistings(){
        user_id = '<?php echo $user_id; ?>';
        const sendData = {
            "owner_id": user_id,
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
            for(var i= 0; i<list.length; i++)
            {
                date = list[i].created_at;
                date = moment(date).format('YYYY-MM-DD');
                temp +=`<tr>
                            <td class="image myelist">
                                <a href="/page/listing-details?index=`+list[i].id+`"><img alt="my-properties-3" src="`+list[i].image+`" class="img-fluid"></a>
                            </td>
                            <td>
                                <div class="inner">
                                    <a href="/page/listing-details?index=`+list[i].id+`"><h2>`+list[i].displayname+`</h2></a>
                                    <figure><i class="lni-map-marker"></i>`+list[i].location_name+`</figure>
                                    
                                </div>
                            </td>
                            <td>`+date+`</td>
                        </tr>`;
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
                        temp1 += `<li class="page-item `+flag+`"><a class="page-link" onclick="loadPageMylistings(`+tempIndex+`)">`+list1[j].label+`</a></li>`;
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
                            temp1 += `<li class="page-item"><a class="page-link" onclick="loadPageMylistings(`+tempIndex+`)">`+list1[j].label+`</a></li>`;    
                        }else{
                            if(list1[j].active){
                                flag = "active";
                                temp1 += `<li class="page-item `+flag+`"><a class="page-link" onclick="loadPageMylistings(`+tempIndex+`)">`+list1[j].label+`</a></li>`;
                            }
                        }
                    }
                }
                document.getElementById("pagin_content").innerHTML = temp1;
            }
		}
	}
    function loadPageMylistings(index){
        document.getElementById("page_index").value = index;
		loadActivelistingsListMylistings();
	}
</script>