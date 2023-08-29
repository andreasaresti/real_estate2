<?php
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
                                    <a  class="active"  href="/page/salesequest-pendingappproval">
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
                    <h2 style="margin-top: 50px;">Request List (Pending)</h2>
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
        loadSalesRequestRequestListPendingAppproval();
	// });
    
    function loadSalesRequestRequestListPendingAppproval(){
        user_id = '<?php echo $user_id; ?>';
        sendData = {
            "sales_people_id": user_id,
            "accepted_status": "no",
        }
        alert(user_id);
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
                        <td>`+ (new Date(list[i].date)).toISOString().slice(0, 10)  +`</td>
                        <td>`+list[i].customer_id +`</td>
                        <td>`+list[i].source_id +`</td>`;
                        if(list[i].accepted_status == "yes"){
                temp += `<td> <a style="color:white;" class="btn btn-secondary" onclick="acceptSalesRequestRequestListPendingAppproval(`+list[i].id+`,'no')"> remove </a> </td>`;
                }else{
                    temp += `<td><a style="color:white;" class="btn btn-secondary" onclick="acceptSalesRequestRequestListPendingAppproval(`+list[i].id+`,'yes')"> add </a></td>`;
                }
                temp += `</tr>`;
            }
            document.getElementById("request_list_content").innerHTML = temp;
		}
	}
    function requestViewRequestListPendingAppproval(data){
        window.location.href = "/sabbiancowebsite/salesequest-details?index="+data
	}
    function acceptSalesRequestRequestListPendingAppproval(data, flag){
		
        sendData = {
            "id": data,
            "accepted_status": flag,
        }
		const url = "/api/salesrequest-acceptsalesrequest";
		let xhr = new XMLHttpRequest();
		xhr.open('POST', url, true);
		xhr.setRequestHeader('Content-type', 'application/json');
		xhr.send(JSON.stringify(sendData));
		xhr.onload = function () {
            if(xhr.status == "201"){
                loadSalesRequestRequestListPendingAppproval();
            }else{
                alert("fail");
            }
		}
	}
</script>