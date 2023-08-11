<?php
 $serverUrl = env('APP_URL');
if(isset($_SESSION["sales_person_id"])){
    $user_id = $_SESSION["sales_person_id"];
 }else{
    $user_id = "";
 }
if(isset($_SESSION["user_role"])){
    $user_role = $_SESSION["user_role"];
 }else{
    $user_role = "";
 }
?>
<style>
    table tbody tr td {
        border: none;
    }
</style>
<div class="inner-pages homepage-4 agents hp-6 full hd-white">
<section class="properties-list featured portfolio blog"> 
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
                                <a class="active"  href="/page/salesequest-open">
                                    <i class="fa fa-list"></i> Sales Requests Open
                                </a>
                            </li>
                        <?php }}?>

                        <li>
                            <a href="/page/profile">
                                <i class="fa fa-user"></i>Profile
                            </a>
                        </li>
                        <li>
                            <a href="/page/my-listings">
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
        <div class="col-lg-9 col-md-12 col-xs-12 pl-0 user-dash2" >
            <div class="container">
                <h2 style="margin-top: 50px;">Request List</h2>
                <table class="table table-striped" >
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Name</th>
                            <th>Date</th>
                            <th>customer_id</th>
                            <th>source_id</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody id="request_list_content">
                        
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>
</div>
<script>
    // window.addEventListener("load", (event) => {
        user_id = '<?php echo $user_id; ?>';
        if(user_id == ""){
            window.location.href="/page/home";
        }
        loadSalesRequestRequestListOpen();
	// });
    
    function loadSalesRequestRequestListOpen(){
        user_id = '<?php echo $user_id; ?>';
        sendData = {
            "sales_people_id": user_id,
            "accepted_status": "yes",
        }
        console.log(sendData);
		const url = "/api/salesrequest-getsalesrequest";
		let xhr = new XMLHttpRequest();
		xhr.open('POST', url, true);
		xhr.setRequestHeader('Content-type', 'application/json');
		xhr.send(JSON.stringify(sendData));
		xhr.onload = function () {
			data = JSON.parse(xhr.response);
			list = data.data;	
            var temp ="";
            for(i=0;i<list.length;i++){
                temp +=`<tr>
                        <td>` + (i+1) +`</td>
                        <td>`+ list[i].name + `</td>
                        <td>`+list[i].date +`</td>
                        <td>`+list[i].customer_id +`</td>
                        <td>`+list[i].source_id +`</td>`;
                temp += `<td><a style="color:white;" class="btn btn-secondary" onclick="requestViewRequestListOpen(`+list[i].id+`)"> view </a></td>`;
                temp += `</tr>`;
            }
            document.getElementById("request_list_content").innerHTML = temp;
		}
	}
    function requestViewRequestListOpen(data){
        window.location.href = "/page/salesequest-details?index="+data
	}
    
</script>