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
<style>
    table {
        border: 0px solid #ccc;
        border-collapse: collapse;
        margin: 0;
        padding: 0;
        width: 100%;
        table-layout: fixed;
    }

    table caption {
        font-size: 1.5em;
        margin: .5em 0 .75em;
    }

    table tr {
        background-color: #f8f8f8;
        border: 0px solid #ddd;
        padding: .35em;
    }

    table th,
    table td {
        padding: .625em;
        text-align: center;
    }

    table th {
        font-size: .85em;
        letter-spacing: .1em;
        text-transform: uppercase;
    }

    @media screen and (max-width: 600px) {
        table {
            border: 0;
        }

        table caption {
            font-size: 1.3em;
        }
        
        table thead {
            border: none;
            clip: rect(0 0 0 0);
            height: 1px;
            margin: -1px;
            overflow: hidden;
            padding: 0;
            position: absolute;
            width: 1px;
        }
        
        table tr {
            border-bottom: 3px solid #ddd;
            display: block;
            margin-bottom: .625em;
        }
        
        table td {
            border-bottom: 1px solid #ddd;
            display: block;
            font-size: .8em;
            text-align: right;
        }
        
        table td::before {
            /*
            * aria-label has no advantage, it won't be read inside a table
            content: attr(aria-label);
            */
            content: attr(data-label);
            float: left;
            font-weight: bold;
            text-transform: uppercase;
        }
        
        table td:last-child {
            border-bottom: 0;
        }
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
                                <td>No</td>
                                <td>Name</td>
                                <td>Date</td>
                                <td>Customer Name</td>
                                <td>Customer Phone</td>
                                <td>Source Name</td>
                                <td></td>
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
		const url = "/api/salesrequest-getsalesrequest";
		let xhr = new XMLHttpRequest();
		xhr.open('POST', url, true);
		xhr.setRequestHeader('Content-type', 'application/json');
		xhr.send(JSON.stringify(sendData));
		xhr.onload = function () {
			data = JSON.parse(xhr.response);
			list = data.data;
            console.log(list);
            var temp ="";
            for(i=0;i<list.length;i++){
                temp +=`<tr>
                        <td data-label="No">` + (i+1) +`</td>
                        <td data-label="Name">`+ list[i].name + `</td>
                        <td data-label="Date">`+ (new Date(list[i].date)).toISOString().slice(0, 10)  +`</td>
                        <td data-label="Customer Name">`+list[i].customer_name +`</td>
                        <td data-label="Customer Phone">`+list[i].customer_phone +`</td>
                        <td data-label="Source Name">`+list[i].source_name +`</td>`;
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
        window.location.href = "/zillow/salesequest-details?index="+data
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