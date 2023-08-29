<?php
if(isset($_GET['index'])){
    $sales_request_id = $_GET['index'];
 }else{
    $sales_request_id = "";
 }

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
<style>
    table tbody tr td {
        border: none;
    }
</style>
<link rel="stylesheet" href="/theme/sabbiancowebsite/assets/css/jquery-ui.css<?php echo time(); ?>">
<div class="inner-pages homepage-4 agents hp-6 full hd-white">
    <section class="single-proper blog details">
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
                <div >
                    <div class="form-group text-right">
                        <a href="/page/salesequest-open" class="btn btn-secondary" >
                            Back to Sales Requests
                        </a>
                        <button type="button" class="btn btn-success" data-toggle="modal" data-target="#closeDeal">
                            Close Deal
                        </button>
                    </div>
                    <div class="form-group" style="margin-top: 40px; padding: 20px;">
                        <table class="table" id="customer_detail" style="border:none;">
                        </table>

                    </div>
                </div>
                <div >
                    <!-- class="tabs-container" -->
                    <div class="tabs">
                        <h3 class="active">Request Details</h3>
                        <h3>Listings</h3>
                        <h3>Appointments</h3>
                        <h3>Notes</h3>
                    </div>
                    <hr style="margin-top: -2px">
                    <div class="tabs-content">
                        <section class="properties-list featured portfolio blog active" style="padding: 20px;">
                            <h2>Request Details</h2>
                            <div class="alert-box success" id="updateRequestDetails_success">Update Ok !!!</div>
                            <div class="alert-box failure" id="updateRequestDetails_failure">fail!!!</div>
                            <div class="properties-list featured blog" style="margin-left: 20px;  margin-top:50px;">
                                <div class="banner-search-wrap" style="margin-left: 30px;margin-right:30px;">
                                    <div class="tab-content">
                                        <div class="tab-pane fade show active" id="tabs_1" style="margin-bottom: 5px;">
                                            <div >
                                                <div class="row">
                                                    <div onmouseover="hiddenAdvancedDivRequestProperty();"  class="col-lg-3 col-md-6 col-sm-12 py-2 pr-30" style="align-self: self-end;" id="searchFormType" >
                                                        <!-- <input type="hidden" id="selActivePropertStatus" name="selActivePropertStatus" value=<?php //echo $sendListingType; ?>> -->
                                                        <nav id="navigation" class="style-1" style="background: white;margin-top:0px;margin-left: 10px!important;margin-right: 10px;border: 1px solid;border-radius: 5px;border-color: #ebebeb;">
                                                            <ul>
                                                                <li ><a id="location_title">Property Status</a>
                                                                    <ul id="activePropertStatus">
                                                                        
                                                                    </ul>
                                                                </li>
                                                            </ul>
                                                        </nav>
                                                    </div>
                                                    <div onmouseover="hiddenAdvancedDivRequestProperty();"  class="col-lg-3 col-md-6 col-sm-12 py-2 pr-30" style="align-self: self-end; width: 180px" >
                                                        <input type="hidden" id="selListingType" name="selListingType" >
                                                        <nav id="navigation" class="style-1" style="background: white;margin-top:0px;margin-left: 10px!important;margin-right: 10px;border: 1px solid;border-radius: 5px;border-color: #ebebeb;">
                                                            <ul>
                                                                <li ><a id="location_title">listing Types</a>
                                                                    <ul id="activePropertType">
                                                                        
                                                                    </ul>
                                                                </li>
                                                            </ul>
                                                        </nav>
                                                    </div>
                                                    <div onmouseover="hiddenAdvancedDivRequestProperty();"  class="col-lg-3 col-md-6 col-sm-12 py-2 pr-30" >
                                                        <input type="hidden" id="selLocation" name="selLocation" >
                                                        <nav id="navigation" class="style-1" style=" background: white;margin-top:0px;margin-left: 10px!important;margin-right: 10px;border: 1px solid;border-radius: 5px;border-color: #ebebeb;">
                                                            <ul>
                                                                <li ><a id="location_title">Location</a>
                                                                    <ul id="activelocation">
                                                                    
                                                                    </ul>
                                                                </li>
                                                            </ul>
                                                        </nav>
                                                    </div>
                                                    <div class="col-lg-3 col-md-6 col-sm-12 py-2 pr-30" >
                                                        <div class="dropdown-filter" style="width: 238px"><span>Advanced Search</span></div>
                                                    </div>
                                                    <div id="advancedSearch" style="margin-top: 0px;" class="explore__form-checkbox-list full-filter">
                                                        <div class="row">
                                                            <div class="col-lg-4 col-md-6 py-1 pr-30 pl-0 ">
                                                                <!-- Form Bedrooms -->
                                                                <div class="form-group beds" style="display: flex;"  id="searchFormBedrooms">
                                                                    <i class="fa fa-bed" aria-hidden="true" style="align-self: center;width: 20px;"></i>
                                                                    <select class="select single-select"  id="selBedrooms">
                                                                        <option value="0">Bedrooms</option>
                                                                        <?php for($i= 1; $i<=10; $i++)
                                                                        {
                                                                        ?>
                                                                        <option value="<?php echo $i;?>"><?php echo $i;?></option>
                                                                        <?php
                                                                        }
                                                                        ?>
                                                                    </select>
                                                                </div>
                                                                <!--/ End Form Bedrooms -->
                                                            </div>
                                                            <div class="col-lg-4 col-md-6 py-1 pl-0 pr-0">
                                                                <!-- Form Bathrooms -->
                                                                <div class="form-group bath" style="display: flex;" id="searchFormBathrooms">
                                                                    <i class="fa fa-bath" aria-hidden="true" style="align-self: center;width: 20px;"></i>
                                                                    <select class="select single-select" id="selBathrooms">
                                                                        <option value="0">Bathrooms</option>
                                                                        <?php for($i= 1; $i<=10; $i++)
                                                                        {
                                                                        ?>
                                                                        <option value="<?php echo $i;?>"><?php echo $i;?></option>
                                                                        <?php
                                                                        }
                                                                        ?>
                                                                    </select>
                                                                    
                                                                </div>
                                                                <!--/ End Form Bathrooms -->
                                                            </div>
                                                            <div class="col-lg-5 col-md-12 col-sm-12 py-1 pr-30 mr-5 sld">
                                                                <!-- Price Fields -->
                                                                <div class="main-search-field-2">
                                                                    <!-- Area Range -->
                                                                    <div class="range-slider">
                                                                        <label>Area Size</label>
                                                                        <div id="area-range" data-min="0" data-max="1300" data-unit="sq meters"></div>
                                                                        <div class="clearfix"></div>
                                                                    </div>
                                                                    <br>
                                                                    <!-- Price Range -->
                                                                    <div class="range-slider">
                                                                        <label>Price Range</label>
                                                                        <div id="price-range" data-min="0" data-max="600000" data-unit="€"></div>
                                                                        <div class="clearfix"></div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-3 col-md-6 col-sm-12 py-1 pr-30">
                                                                <!-- Checkboxes -->
                                                                <div class="checkboxes one-in-row margin-bottom-10 ch-1" id="activefeaturesLeft">
                                                                    
                                                                </div>
                                                                <!-- Checkboxes / End -->
                                                            </div>
                                                            <div class="col-lg-3 col-md-6 col-sm-12 py-1 pr-30">
                                                                <!-- Checkboxes -->
                                                                <div class="checkboxes one-in-row margin-bottom-10 ch-2" id="activefeaturesRight">
                                                                    
                                                                </div>
                                                                <!-- Checkboxes / End -->
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <div>
                                <div style="margin-top: 15px; display: flex;justify-content: flex-end; margin-right: 50px">
                                    <a class="btn btn-yellow" style="height: 43px;width: 121px;margin-right: 50px;" onclick="updateRequestRequestProperty();">Update</a>
                                    <a class="btn btn-yellow" style="height: 43px;width: 121px;" onclick="searchListingsRequestProperty();">Search</a>
                                </div>
                            </div>
                            <div class="row" id="ListingListContent">
            
                            </div>
                            <nav aria-label="..." class="pt-3" style="display: flex;justify-content: center;">
                                <ul class="pagination mt-0" id="pagin_content">
                                </ul>
                            </nav>
                        </section>
                        <section class="properties-list featured portfolio blog" style="padding: 20px;">
                            <h2>Listings</h2>
                            <div class="form-group text-right">
                                <input type="checkbox" onchange="loadListingsRequestProperty()" name="hide_not_interested" id="hide_not_interested" checked><label for="hide_not_interested">Hide not Interested</label> 
                                <button type="button" class="btn btn-success" data-toggle="modal" data-target="#addAppointments">
                                    Add Appointment
                                </button>
                            </div>
                            <p>
                            <!-- <div class="text-heading text-left">
                                <p class="font-weight-bold mb-0 mt-3" id="page_count"></p>                        
                            </div> -->
                            <div style="margin-left: -20px; margin-bottom:20px;">
                                <table class="table table-striped" >
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>My Listings</th>
                                            <th>Status	</th>
                                            <th>Add Appointment</th>
                                        </tr>
                                    </thead>
                                    <tbody id="request_Listing_Content">
                                        
                                    </tbody>
                                </table>
                            </div>
                            <!-- <nav aria-label="..." class="pt-3" style="display: flex; justify-content: center; padding: 10px;">
                                <ul class="pagination mt-0" id="pagin_content">
                                </ul>
                            </nav>     -->
                        </section>
                        <section class="properties-list featured portfolio blog" style="padding: 20px;">
                            <h2>Appointments</h2>
                            <div class="form-group text-right">
                                <input type="checkbox" onclick="loadAppointmentRequestProperty();" id="hide_signed_appointmet" name="hide_signed_appointmet" checked><label for="hide_signed_appointmet">Hide Signed Appointments</label> 
                                <button type="button" class="btn btn-success" data-toggle="modal" data-target="#addSignature">
                                    Add Signature
                                </button>
                            </div>
                            <p>
                            <div style="margin-top:20px; margin-bottom:20px;">
                                <table class="table table-striped" >
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Listing Name</th>
                                            <th>Date</th>
                                            <th>signed</th>
                                        </tr>
                                    </thead>
                                    <tbody id="appointments_list_content">
                                    </tbody>
                                </table>
                            </div>
                        </section>
                        <section class="properties-list featured portfolio blog" style="padding: 20px;">
                            <h2>Notes</h2>
                            <div class="form-group text-right">
                                <button type="button" class="btn btn-success" data-toggle="modal" data-target="#addNotes">
                                    Add Notes
                                </button>
                            </div>
                            <div style="margin-top:20px; margin-bottom:20px;">
                                <table class="table table-striped" >
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Note</th>
                                            <th>Date Added</th>
                                        </tr>
                                    </thead>
                                    <tbody id="notes_list_content">
                                    </tbody>
                                </table>
                            </div>
                        </section>
                    </div>
                </div>
            </div>
        </div>
        <input type="hidden" id="customer_id">
        <input type="hidden" id="source_id"> 
        <input type="hidden" id="page_index" value="1">
    </section>
</div>
<div class="modal fade bs-modal-sm signatureModal" id="addSignature" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm" style="margin-top: 200px;">
        <div class="modal-content" style="width: 500px;">
            <div class="row justify-content-center">
                <div class="col-md-10 text-center" style="margin: 40px 0px 40px 0px;">
                    <!-- <h3 class="h5">Date picker</h3>
                    <div class="w-100">
                    <form action="" method="post" class="signdatepickers">
                    <div class="form-group"> -->
                        <!-- <label class="label-control" for="id_start_datetime">Datetime picker</label> -->
                        <!-- <div class="input-group date" id="id_1">
                        <input name="signature_date" id="signature_date" type="date" class="form-control">
                        </div>
                    </div> -->
                    </form>
                    <div class="flex-row">
                        <h3 class="h5">Please Sign</h3>
                        <div class="wrapper" style="border: solid;color: black;">
                            <canvas id="signaturePad" width="400px" height="200px"></canvas>
                        </div>
                    </div>
                    <div style="margin-top: 10px; display: flex; justify-content: flex-end;">
                        <a class="btn btn-yellow" id="signatureClear"  style="color: white;">Clear</a>&nbsp;&nbsp;&nbsp;&nbsp;
                        <a class="btn btn-yellow" onclick="signAppointmentRequestProperty()" style="color: white;">Submit</a>
                    </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="addAppointments" tabindex="-1" role="dialog" aria-labelledby="addAppointmentsLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
        <div class="modal-header">
        <h5 class="modal-title" id="addAppointmentsLabel">Add Appointment</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        </div>
        <div class="alert-box success" id="add_appointment_success">Ok !!!</div>
        <div class="alert-box failure" id="add_appointment_failure">fail!!!</div>
        <div class="modal-body">
            <label>Appointment Date</label>
            <input name="appointment_date" id="appointment_date" type="date" class="form-control">
        </div>
        <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" onclick="addAppointmentRequestProperty()">Save changes</button>
        </div>
    </div>
    </div>
</div>
<div class="modal fade" id="addNotes" tabindex="-1" role="dialog" aria-labelledby="addNotesLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
        <div class="modal-header">
        <h5 class="modal-title" id="addNotesLabel">Add Note</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        </div>
        <div class="modal-body">
            <div class="form-group" id="deal_note_type">
                <label>Type</label>
                <select class="form-control" name="deal_note_type_select" id="deal_note_type_select">
                    
                </select>
            </div>
            <div class="form-group">
                <label>Notes</label>
                <textarea name="new_note" id="new_note" class="form-control"></textarea>
            </div>
        </div>
        <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" onclick="addNoteRequestProperty()">Save changes</button>
        </div>
    </div>
    </div>
</div>
<div class="modal fade" id="closeDeal" tabindex="-1" role="dialog" aria-labelledby="closeDeal" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
        <div class="modal-header">
        <h5 class="modal-title" id="closeDealLabel">Close Deal</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        </div>
        <div class="modal-body">
            <div class="alert-box success" id="closeDeal_success">Submit Ok !!!</div>
            <div class="alert-box failure" id="closeDeal_failure">fail!!!</div>
            <div class="form-group">
                <label>Status</label>
                <select class="form-control" name="deal_status" id="deal_status">
                    <option value="">Please Select</option>
                    <option value="won">Won</option>
                    <option value="lost">Lost</option>
                </select>
            </div>
            <div class="form-group" id="deal_listing">
                <label>Listing</label>
                <select class="form-control" name="deal_listing_select" id="deal_listing_select">
                    
                </select>
            </div>                    
            <div class="form-group">
                <label>Close Amount</label>
                <input class="form-control" type="number" name="deal_close_amount" id="deal_close_amount">
            </div>
            <div class="form-group" id="lost_reason">
                <label>Lost Reason</label>
                <select class="form-control" name="lost_reason_select" id="lost_reason_select">
                    
                </select>
            </div>
        </div>
        <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" onclick="closeDealRequestProperty()">Save changes</button>
        </div>
    </div>
    </div>
</div>
<script>
    var signatureImage;

    var canvas = document.getElementById("signaturePad");

    var signaturePad = new SignaturePad(canvas, {
        backgroundColor: 'rgb(250,250,250)'
    });

    document.getElementById("signatureClear").addEventListener('click', function(){
        signaturePad.clear();
    })
    

    let tabs = document.querySelectorAll(".tabs h3");
    let tabContents = document.querySelectorAll(".tabs-content section");

    tabs.forEach((tab, index) => {
        tab.addEventListener("click", () => {
            tabContents.forEach((content) => {
            content.classList.remove("active");
            });
            tabs.forEach((tab) => {
            tab.classList.remove("active");
            });
            tabContents[index].classList.add("active");
            tabs[index].classList.add("active");
            if(index == 1){
                loadListingsRequestProperty();
            }
            if(index == 0){
                loadSalesRequestDetailRequestProperty();
            }
            if(index == 2){
                loadAppointmentRequestProperty();
            }
            if(index == 3){
                loadNotesRequestProperty();
            }
        });
    });
    function appointmentUpdateRequestProperty()
    {
        signatureImage = signaturePad.toDataURL();
        var appointments = document.getElementsByClassName("AppointmentSign");
        var appointmentLists = 0;
        var statuses = document.getElementsByClassName("appointmentStatusSelect");
        for(var i=0;i<appointments.length;i++){
            if(appointments[i].checked) {
                if(appointmentLists == 0){
                    appointmentLists =  appointments[i].id;
                }else{
                    appointmentLists += ","+ appointments[i].id;
                }
            }
        }
        if(appointments.length>0){
            const s = document.getElementById("signdatePicker").value;
            const d = new Date(s);
            var date = d.getFullYear()+"-"+(d.getMonth()+1)+"-"+ d.getDate()+" "+d.getHours()+":"+d.getMinutes()+":"+d.getSeconds();
            let data = {
                "requestIndex": document.getElementById("requestIndex").value,
                "lists": appointmentLists,
                "signatureImage": signatureImage,
                "date": date
            };
            console.log(data);
            const url = "/api/update_appointments";
            let xhr = new XMLHttpRequest();
            xhr.open('POST', url, true);
            xhr.setRequestHeader('Content-type', 'application/json');
            xhr.send(JSON.stringify(data));
            xhr.onload = function () {
                result = xhr.response;
                console.log(result);
                if(result == "ok"){
                    alert("Send Mail ok");
                    get_appointments();
                    $("#signatureModal").modal('hide');
                }else{
                    alert("Add fail");
                }
            }
        }
    }
    // window.addEventListener("load", (event) => {
        sales_request_id = '<?php echo $sales_request_id; ?>';
        if(sales_request_id == ""){
            window.location.href="/page/home";
        }
        loadSalesRequestDetailRequestProperty();
		loadActiveFeaturesRequestProperty();
        loadActiveDistrictRequestProperty();
        loadActivePropertTypeRequestProperty();
        loadActivePropertStatusRequestProperty();
        loadModalGetListingsRequestProperty();
        loadModalGetLostReasonRequestProperty();
        loadModalGetNoteTypeRequestProperty();
	// });
    
    function addNoteRequestProperty(){
        sales_request_id = '<?php echo $sales_request_id; ?>';
		//appointment_date
        sendData = {
            "sales_request_id": sales_request_id,
            "sales_request_note_type_id": document.getElementById('deal_note_type_select').value,
            "description": document.getElementById('new_note').value,
        }
		const url = "/api/addnote";
		let xhr = new XMLHttpRequest();
		xhr.open('POST', url, true);
		xhr.setRequestHeader('Content-type', 'application/json');
		xhr.send(JSON.stringify(sendData));
		xhr.onload = function () {
            if(xhr.status == "201"){
                loadNotesRequestProperty();
                $("#addNotes").modal('hide');
            }else{
                alert("fail");
            }
		}
	}
    function loadNotesRequestProperty(){
        sales_request_id = '<?php echo $sales_request_id; ?>';
		
		
        sendData = {
            "sales_request_id": sales_request_id,
        }
        console.log(sendData);
		const url = "/api/salesrequest-getnotes";
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
                        <td>`+ list[i].description +`</td>
                        <td>`+ (new Date(list[i].created_at)).toISOString().slice(0, 10) +`</td>
                        </tr>`;
            }
            document.getElementById("notes_list_content").innerHTML = temp;
		}
	}
    function signAppointmentRequestProperty(){
		//appointment_date
        var temp = [];
        var Lists = document.getElementsByClassName('appointments_list');
        for(var j=0; j<Lists.length;j++){
            if(Lists[j].checked){
                temp.push(Lists[j].value);
            }
        }
        signatureImage = signaturePad.toDataURL();
        sendData = {
            "signature": signatureImage,
            "id": temp,
        }
        console.log(sendData);
		const url = "/api/salesrequest-signappointment";
		let xhr = new XMLHttpRequest();
		xhr.open('POST', url, true);
		xhr.setRequestHeader('Content-type', 'application/json');
		xhr.send(JSON.stringify(sendData));
		xhr.onload = function () {
            data = JSON.parse(xhr.response);
            console.log(data);
            if(xhr.status == "201"){
                loadListingsRequestProperty();
                // $("#addSignature").modal('hide');
            }else{
                alert("fail");
            }
		}
	}
    function loadAppointmentRequestProperty(){
        sales_request_id = '<?php echo $sales_request_id; ?>';
		
		
        var hide_signed_appointmet = null;
        if(document.getElementById("hide_signed_appointmet").checked == true){
            hide_signed_appointmet = 0;
        }
        sendData = {
            "sales_request_id": sales_request_id,
            "signed":hide_signed_appointmet,
        }
		const url = "/api/salesrequest-getappointments";
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
                        <td style="display: flex;"><img style="width: 100px;" src='`+ list[i].image +`'><span style="margin: 10px;">`+ list[i].listing_name + `</span></td>
                        <td>`+ (new Date(list[i].date)).toISOString().slice(0, 10) +`</td>`;
                if(list[i].signed == 1){
                    temp +=`<td><input class="appointments_list" checked type="checkbox" value="`+list[i].id+`"></td>
                        </tr>`;
                }else{
                    temp +=`<td><input class="appointments_list" type="checkbox" value="`+list[i].id+`"></td>
                        </tr>`;
                }
                        
            }
            document.getElementById("appointments_list_content").innerHTML = temp;
		}
	}
    function addAppointmentRequestProperty(){
        sales_request_id = '<?php echo $sales_request_id; ?>';
		//appointment_date
        var temp = [];
        var Listings = document.getElementsByClassName('Listing');
        for(var j=0; j<Listings.length;j++){
            if(Listings[j].checked){
                temp.push(Listings[j].value);
            }
        }
        ///////////// listing_id or not listings array()
        sendData = {
            "date": document.getElementById("appointment_date").value,
            "sales_request_id": sales_request_id,
            "listings": temp,
            "status": "open",
        }
		const url = "/api/salesrequest-addappointments";
		let xhr = new XMLHttpRequest();
		xhr.open('POST', url, true);
		xhr.setRequestHeader('Content-type', 'application/json');
		xhr.send(JSON.stringify(sendData));
		xhr.onload = function () {
            data = JSON.parse(xhr.response);
            if(xhr.status == "201"){
                if( data.hasOwnProperty('message')){
                    $("#add_appointment_success").html(data.message);
                }
                $( "#add_appointment_success" ).fadeIn( 300 ).delay( 1500 ).fadeOut( 400 );
                loadAppointmentRequestProperty();
                $("#addAppointments").modal('hide');
            }else{
                console.log(data.errors.date);
                console.log(data.errors.date[0]);
                if( data.hasOwnProperty('errors')){
                    if( data.errors.hasOwnProperty('date')){
                        $("#add_appointment_failure").html(data.errors.date[0]);
                    }
                }
                $( "#add_appointment_failure" ).fadeIn( 300 ).delay( 1500 ).fadeOut( 400 );
            }
		}
	}
    function loadListingsRequestProperty(){
        sales_request_id = '<?php echo $sales_request_id; ?>';
		
        var hide_not_interested = null;
        if(document.getElementById("hide_not_interested").checked == true){
            hide_not_interested = 'open';
        }
        sendData = {
            "sales_request_id": sales_request_id,
            "status":hide_not_interested,
        }
        console.log(sendData);
		const url = "/api/salesrequest-getlistings";
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
                        <td style="display: flex;"><img style="width: 100px;" src='`+ list[i].image +`'><span style="margin: 10px;">`+ list[i].listing_name + `</span></td>
                        <td><select style="padding: 0px 0px 0px 10px;height: 35px;" onchange="changeRequestListingsStatusRequestProperty(`+list[i].id+`)" id="listingsStatusSelect`+list[i].id+`">`;
                if(list[i].status == "open"){
                        temp +=`<option selected value="open">Open</option>
                                <option value="not_interested">Not Interested</option>  `;
                    }else{
                        temp +=`<option value="open">Open</option>
                                <option selected value="notInterested">Not Interested</option>  `;
                    }
                temp +=`</select></td>
                        <td><input class="Listing" type="checkbox" value="`+list[i].listing_id+`"></td>
                        </tr>`;
            }
            document.getElementById("request_Listing_Content").innerHTML = temp;
		}
	}
    function changeRequestListingsStatusRequestProperty(data){
		
        sendData = {
            "id": data,
            "status": document.getElementById("listingsStatusSelect"+data).value,
        }
        console.log(sendData);
		const url = "/api/salesrequest-changelistingtype";
		let xhr = new XMLHttpRequest();
		xhr.open('POST', url, true);
		xhr.setRequestHeader('Content-type', 'application/json');
		xhr.send(JSON.stringify(sendData));
		xhr.onload = function () {
            if(xhr.status == "201"){
                loadListingsRequestProperty();
            }else{
                alert("fail");
            }
		}
	}
    function loadActiveFeaturesRequestProperty(){
		
		
		const url = "/api/activefeatures";
		let xhr = new XMLHttpRequest();
		xhr.open('POST', url, true);
		xhr.setRequestHeader('Content-type', 'application/json');
		xhr.send();
		xhr.onload = function () {
			list = JSON.parse(xhr.response);
			data = list.data;	
            var temp ="";
            for(i=0;i<Math.round(data.length/2);i++){
                temp += `<input id="featurecheck`+data[i].id+`" type="checkbox" class="featurecheck" value = "`+data[i].id+`">
                <label for="featurecheck`+data[i].id+`">`+data[i].displayname+`</label>`;
            }
            document.getElementById("activefeaturesLeft").innerHTML = temp;
            temp ="";
            for(i=Math.round(data.length/2);i<data.length;i++){
                temp += `<input id="featurecheck`+data[i].id+`" type="checkbox" class="featurecheck" value = "`+data[i].id+`">
                <label for="featurecheck`+data[i].id+`">`+data[i].displayname+`</label>`;
            }
            document.getElementById("activefeaturesRight").innerHTML = temp;
		}
	}
    function loadActiveDistrictRequestProperty(){
		
		const url = "/api/activedistrict";
		let xhr = new XMLHttpRequest();
        let xhr1 = new XMLHttpRequest();
		xhr.open('POST', url, true);
		xhr.setRequestHeader('Content-type', 'application/json');
		xhr.send();
		xhr.onload = function () {
			list = JSON.parse(xhr.response);
			data = list.data;	
            var temp ="";
            for(i=0;i<data.length;i++){
                temp += `<li class="parent locationLi" ><a><input type="checkbox" id="districts`+data[i].id+`" class="district" name="district[]" value="`+data[i].id+`" onchange="changeLocationsRequestProperty('districts','`+data[i].id+`','`+data[i].displayname+`')">`+data[i].displayname+`</a>
                <div class="wrapper"><ul style="transform:none;position:initial; visibility: visible;opacity: 100; overflow-x: hidden; overflow-y: auto; max-height: 600px;" id="subDistricts`+data[i].id+`"></ul></div></li>`;
            }
            document.getElementById("activelocation").innerHTML = temp;
            loadActiveMunicipalityRequestProperty();
		}
	}
    function loadActiveMunicipalityRequestProperty(){
		
		
		const url = "/api/activemunicipality";
		let xhr = new XMLHttpRequest();
		xhr.open('POST', url, true);
		xhr.setRequestHeader('Content-type', 'application/json');
		xhr.send();
		xhr.onload = function () {
			list = JSON.parse(xhr.response);
			data = list.data;
            districts = document.getElementsByClassName("district");
            for(j=0;j<districts.length;j++)
            {
                temp ="";
                for(i=0;i<data.length;i++){
                    if(data[i].district_id == districts[j].value){
                        temp += `<li class="parent locationLi"><a><input type="checkbox"  id="municipalities`+data[i].id+`"  class="municipality" name="municipality[]" value="`+data[i].id+`" onchange="changeLocationsRequestProperty('municipalities','`+data[i].id+`','`+data[i].displayname+`')">`+data[i].displayname+`</a>
                        <div class="wrapper"><ul style="visibility: visible;opacity: 100;" id="subMunicipalities`+data[i].id+`"></ul></div></li>`;
                    }
                }
                document.getElementById("subDistricts"+districts[j].value).innerHTML = temp;
                loadActiveLocationRequestProperty();
            }
		}
	}
    function loadActiveLocationRequestProperty(){
		const url = "/api/activelocation";
		let xhr = new XMLHttpRequest();
		xhr.open('POST', url, true);
		xhr.setRequestHeader('Content-type', 'application/json');
		xhr.send();
		xhr.onload = function () {
			list = JSON.parse(xhr.response);
			data = list.data;
            municipalities = document.getElementsByClassName("municipality");
            for(j=0;j<municipalities.length;j++)
            {
                temp ="";
                for(i=0;i<data.length;i++){
                    if(data[i].municipality_id == municipalities[j].value){
                        temp += `<li><a><input type="checkbox"  id="locations`+data[i].id+`"  class="location" name="location[]" value="`+data[i].id+`" onchange="changeLocationsRequestProperty('locations','`+data[i].id+`','`+data[i].displayname+`')">`+data[i].displayname+`</a>`;
                    }
                }
                document.getElementById("subMunicipalities"+municipalities[j].value).innerHTML = temp;
            }
		}
	}
    function loadActivePropertStatusRequestProperty(){
		const url = "/api/activeproperty-types";
		let xhr = new XMLHttpRequest();
		xhr.open('POST', url, true);
		xhr.setRequestHeader('Content-type', 'application/json');
		xhr.send();
		xhr.onload = function () {
			list = JSON.parse(xhr.response);
			data = list.data;	
            var temp ="";
            for(i=0;i<data.length;i++){
                temp += `<li><a><input type="checkbox" class="propertyStatus" value="`+data[i].id+`" id="propertyStatus`+data[i].id+`" >`+data[i].displayname+`</a>
                        </li>`;
            }
            document.getElementById("activePropertStatus").innerHTML = temp;
		}
	}
    function loadActivePropertTypeRequestProperty(){
		const url = "/api/activelisting-types";
		let xhr = new XMLHttpRequest();
		xhr.open('POST', url, true);
		xhr.setRequestHeader('Content-type', 'application/json');
		xhr.send();
		xhr.onload = function () {
			list = JSON.parse(xhr.response);
			data = list.data;	
            var temp ="";
            for(i=0;i<data.length;i++){
                temp += `<li><a><input type="checkbox" class="propertyTypes" value="`+data[i].id+`" id="propertyTypes`+data[i].id+`" >`+data[i].displayname+`</a>
                        </li>`;
            }
            document.getElementById("activePropertType").innerHTML = temp;
		}
	}
    function changeLocationsRequestProperty(flag,id,name)
    {
        if(flag == "districts"){
            ul = document.getElementById("subDistricts"+id);
            li = ul.getElementsByTagName('li');
            for(i=0;i<li.length;i++){
                input = li[i].getElementsByTagName('input');
                if(input[0].className == "municipality"){
                    document.getElementById("municipalities"+input[0].value).checked = document.getElementById(flag+id).checked;
                }else{
                    document.getElementById("locations"+input[0].value).checked = document.getElementById(flag+id).checked;
                }
            }
        }
        if(flag == "municipalities"){
            ul = document.getElementById("subMunicipalities"+id);
            li = ul.getElementsByTagName('li');
            for(i=0;i<li.length;i++){
                input = li[i].getElementsByTagName('input');
                document.getElementById("locations"+input[0].value).checked = document.getElementById(flag+id).checked;
            }
        }
        
        districts = document.getElementsByClassName('district');
        for(i=0;i<districts.length;i++){
            ul = document.getElementById("subDistricts"+districts[i].value);
            li = ul.getElementsByTagName('li');
            for (j=0; j<li.length; j++) {
                input = li[j].getElementsByTagName('input');
                if (input[0].checked == false) {
                    document.getElementById("districts"+districts[i].value).checked = false;
                }
            }
            municipalities = ul.getElementsByClassName('municipality');
            for (j=0; j<municipalities.length; j++) {
                ul = document.getElementById("subMunicipalities"+municipalities[j].value);
                li = ul.getElementsByTagName('li');
                for (k=0; k<li.length; k++) {
                    input = li[k].getElementsByTagName('input');
                    if (input[0].checked == false) {
                        document.getElementById("municipalities"+municipalities[j].value).checked = false;
                    }
                }
            }
            
        }
    }
    function closeDealRequestProperty(){
        sales_request_id = '<?php echo $sales_request_id; ?>';
        sendData = {
            "id": sales_request_id,
            "status": document.getElementById('deal_status').value,
            "listing_id": document.getElementById("deal_listing_select").value,
            "agreement_price":document.getElementById("deal_close_amount").value,
            "sales_lost_reason_id": document.getElementById("lost_reason_select").value,
        }
		const url = "/api/salesrequest-closedeal";
		let xhr = new XMLHttpRequest();
		xhr.open('POST', url, true);
		xhr.setRequestHeader('Content-type', 'application/json');
		xhr.send(JSON.stringify(sendData));
		xhr.onload = function () {
            data = JSON.parse(xhr.response);
            if(data.hasOwnProperty("errors")){
                Object.keys(data.errors).forEach(function(key) {
                    $("#closeDeal_failure").html(data.errors[key][0]);
                })
                $( "#closeDeal_failure" ).fadeIn( 300 ).delay( 1500 ).fadeOut( 400 );
            }else{
                $( "#closeDeal_success" ).fadeIn( 300 ).delay( 1500 ).fadeOut( 400 );
                window.location.href = "/page/salesequest-open";
            }
		}
	}
    function loadModalGetListingsRequestProperty(){
        sales_request_id = '<?php echo $sales_request_id; ?>';
        sendData = {
            "sales_request_id": sales_request_id,
            "status":null,
        }        
		const url = "/api/salesrequest-getlistings";
		let xhrClose = new XMLHttpRequest();
		xhrClose.open('POST', url, true);
		xhrClose.setRequestHeader('Content-type', 'application/json');
		xhrClose.send(JSON.stringify(sendData));
		xhrClose.onload = function () {
			data = JSON.parse(xhrClose.response);
			list = data.data;	
            var temp ="";
            var temp1 ="";
            for(i=0;i<list.length;i++){
                name = list[i].listing_name.substring(0,70);
                temp +=`<option value="`+list[i].listing_id+`">` + name + `</option>`;
                temp1 +=`<li data-value="`+list[i].listing_id+`" class="option">` + name + `</li>`;
            }
            document.getElementById("deal_listing_select").innerHTML = temp;
            document.getElementById("deal_listing").getElementsByClassName("list")[0].innerHTML = temp1;
		}
    }
    function loadModalGetLostReasonRequestProperty(){
        const url1 = "/api/salesrequest-getlostreason";
		let xhr = new XMLHttpRequest();
		xhr.open('POST', url1, true);
		xhr.setRequestHeader('Content-type', 'application/json');
		xhr.send();
		xhr.onload = function () {
			data = JSON.parse(xhr.response);
			list = data.data;	
            var temp ="";
            var temp1 ="";
            for(i=0;i<list.length;i++){
                temp +=`<option value="`+list[i].id+`">` +list[i].name + `</option>`;
                temp1 +=`<li data-value="`+list[i].id+`" class="option">` + list[i].name + `</li>`;
            }
            document.getElementById("lost_reason_select").innerHTML = temp;
            document.getElementById("lost_reason").getElementsByClassName("list")[0].innerHTML = temp1;
		}
	}
    function loadModalGetNoteTypeRequestProperty(){
        const url1 = "/api/salesrequest-getnotetype";
		let xhr = new XMLHttpRequest();
		xhr.open('POST', url1, true);
		xhr.setRequestHeader('Content-type', 'application/json');
		xhr.send();
		xhr.onload = function () {
			data = JSON.parse(xhr.response);
			list = data.data;	
            var temp ="";
            var temp1 ="";
            for(i=0;i<list.length;i++){
                temp +=`<option value="`+list[i].id+`">` +list[i].name + `</option>`;
                temp1 +=`<li data-value="`+list[i].id+`" class="option">` + list[i].name + `</li>`;
            }
            document.getElementById("deal_note_type_select").innerHTML = temp;
            document.getElementById("deal_note_type").getElementsByClassName("list")[0].innerHTML = temp1;
		}
	}
    function loadSalesRequestDetailRequestProperty(){
        sales_request_id = '<?php echo $sales_request_id; ?>';
		
        sendData = {
            "id": sales_request_id,
        }
        const url1 = "/api/salesrequest-getsalesrequestdetail";
		let xhr = new XMLHttpRequest();
		xhr.open('POST', url1, true);
		xhr.setRequestHeader('Content-type', 'application/json');
		xhr.send(JSON.stringify(sendData));
		xhr.onload = function () {
			detail = JSON.parse(xhr.response);
            temp = `<tr><td style="margin: 0px;height: 40px;padding: 0px;border: none;">Customer Name</td>
                    <td style="margin: 0px;height: 40px;padding: 0px;border: none;">Customer Surname</td>
                    <td style="margin: 0px;height: 40px;padding: 0px;border: none;">Email</td>
                    <td style="margin: 0px;height: 40px;padding: 0px;border: none;">Address</td>
                    <td style="margin: 0px;height: 40px;padding: 0px;border: none;">Phone</td></tr>`;
            temp += `<tr><td style="margin: 0px;height: 40px;padding: 0px;border: none;">`+detail.customer_name+`</td>
                    <td style="margin: 0px;height: 40px;padding: 0px;border: none;">`+detail.customer_surname+`</td>
                    <td style="margin: 0px;height: 40px;padding: 0px;border: none;">`+detail.customer_email+`</td>
                    <td style="margin: 0px;height: 40px;padding: 0px;border: none;">`+detail.customer_address+`</td>
                    <td style="margin: 0px;height: 40px;padding: 0px;border: none;">`+detail.customer_phone+`</td></tr>`;
            document.getElementById("customer_detail").innerHTML = temp;
            setTimeout(() => {
                document.getElementById("customer_id").value = detail.customer_id;
                // document.getElementById("name").value = detail.name;
                // document.getElementById("date").value = moment(detail.date).utc().format('YYYY-MM-DD');
                // document.getElementById("description").value = detail.description;
                document.getElementById("source_id").value = detail.source_id;
                document.getElementById('propertyStatus'+detail.property_type_id).checked = true;
                if(detail.minimum_bedrooms>0){
                    document.getElementById("searchFormBedrooms").getElementsByClassName("current")[0].innerHTML = detail.minimum_bedrooms;    
                    document.getElementById("selBedrooms").value = detail.minimum_bedrooms;
                }
                if(detail.minimum_bathrooms>0){
                    document.getElementById("searchFormBathrooms").getElementsByClassName("current")[0].innerHTML = detail.minimum_bathrooms;
                    document.getElementById("selBathrooms").value = detail.minimum_bathrooms;
                }
                document.getElementById("price-range").setAttribute('data-min',detail.minimum_budget);
                document.getElementById("price-range").setAttribute('data-max', detail.maximum_budget);
                document.getElementById("area-range").setAttribute('data-min',detail.minimum_size);
                document.getElementById("area-range").setAttribute('data-max', detail.maximum_size);
                document.getElementsByClassName("first-slider-value")[1].value = "€"+detail.minimum_budget;
                document.getElementsByClassName("second-slider-value")[1].value = "€"+detail.maximum_budget;
                document.getElementsByClassName("first-slider-value")[0].value = detail.minimum_size+" sq meters";
                document.getElementsByClassName("second-slider-value")[0].value = detail.maximum_size+" sq meters";
                for(var j=0; j<detail.listingTypes.length;j++){
                    document.getElementById('propertyTypes'+detail.listingTypes[j]).checked = true;
                }
                for(var j=0; j<detail.districts.length;j++){
                    document.getElementById('districts'+detail.districts[j]).checked = true;
                }
                for(var j=0; j<detail.municipalities.length;j++){
                    document.getElementById('municipalities'+detail.municipalities[j]).checked = true;
                }
                for(var j=0; j<detail.locations.length;j++){
                    document.getElementById('locations'+detail.locations[j]).checked = true;
                }
                for(var j=0; j<detail.features.length;j++){
                    document.getElementById('featurecheck'+detail.features[j]).checked = true;
                }
            }, 6000);
		}
	}
    function hiddenAdvancedDivRequestProperty(){
        document.getElementById('advancedSearch').className = "explore__form-checkbox-list full-filter";
    }
    function updateRequestRequestProperty(){
        hiddenAdvancedDivRequestProperty();
        sales_request_id = '<?php echo $sales_request_id; ?>';
		
        if(document.getElementById("selBathrooms").value > 0){
            number_of_bathrooms = document.getElementById("selBathrooms").value;
        }else{
            number_of_bathrooms = "";
        }
        if(document.getElementById("selBedrooms").value > 0){
            number_of_bedrooms = document.getElementById("selBedrooms").value;
        }else{
            number_of_bedrooms = "";
        }
        var tempFeatures = [];
        var features = document.getElementsByClassName('featurecheck');
        for(var j=0; j<features.length;j++){
            if(features[j].checked){
                tempFeatures.push(features[j].value);
            }
        }
        var tempDistrictArr = [];
        var districts = document.getElementsByClassName('district');
        for(var j=0; j<districts.length;j++){
            if(districts[j].checked){
                tempDistrictArr.push(districts[j].value);
            }
        }
        var tempMunicipalitiesArr = [];
        var municipalities = document.getElementsByClassName('municipality');
        for(var j=0; j<municipalities.length;j++){
            if(municipalities[j].checked){
                tempMunicipalitiesArr.push(municipalities[j].value);
            }
        }
        var tempLocationArr = [];
        var locations = document.getElementsByClassName('location');
        for(var j=0; j<locations.length;j++){
            if(locations[j].checked){
                tempLocationArr.push(locations[j].value);
            }
        }
        var tempPropertStatus;
        var propertStatus = document.getElementsByClassName('propertyStatus');
        for(var j=0; j<propertStatus.length;j++){
            if(propertStatus[j].checked){
                tempPropertStatus = propertStatus[j].value;
            }
        }
        var tempPropertTypes = [];
        var propertTypes = document.getElementsByClassName('propertyTypes');
        for(var j=0; j<propertTypes.length;j++){
            if(propertTypes[j].checked){
                tempPropertTypes.push(propertTypes[j].value);
            }
        }
        var price1 = document.getElementsByClassName("first-slider-value")[1].value;
        var size1 = document.getElementsByClassName("first-slider-value")[0].value;
        var price2 = document.getElementsByClassName("second-slider-value")[1].value;
        var size2 = document.getElementsByClassName("second-slider-value")[0].value;
        size1 = size1.substring(0,size1.length-6);
        price1 = price1.substring(1);
        price1 = price1.replace(",","");
        size2 = size2.substring(0,size2.length-6);
        price2 = price2.substring(1);
        price2 = price2.replace(",","");
        if(price1 == ''){
            price1 = 0;
        }
        if(price2 == ''){
            price2 = 600000;
        }
        if(size1 == ''){
            size1 = 0;
        }
        if(size2 == ''){
            size2 = 1300;
        }
        
        const sendData = {
            "id": sales_request_id,
            "customer_id": document.getElementById("customer_id").value,
            "source_id": document.getElementById("source_id").value,
            "property_type_id": tempPropertStatus,
            "minimum_bashrooms": number_of_bathrooms,
            "minimum_bedrooms": number_of_bedrooms,
            "sales_request_listing_types": tempPropertTypes,
            "sales_request_feature": tempFeatures,
            "minimum_size": parseInt(size1),
            "maximum_size": parseInt(size2),
            "minimum_budget": parseInt(price1),
            "maximum_budget": parseInt(price2),
            "sales_request_districts": tempDistrictArr,
            "sales_request_municipalities": tempMunicipalitiesArr,
            "sales_request_locations": tempLocationArr,
        };
        const url1 = "/api/salesrequest-updatesalesrequest";
		let xhr = new XMLHttpRequest();
		xhr.open('POST', url1, true);
		xhr.setRequestHeader('Content-type', 'application/json');
		xhr.send(JSON.stringify(sendData));
		xhr.onload = function () {
			data = JSON.parse(xhr.response);
            if(data.hasOwnProperty("errors")){
                Object.keys(data.errors).forEach(function(key) {
                    $("#updateRequestDetails_failure").html(data.errors[key][0]);
                })
                $( "#updateRequestDetails_failure" ).fadeIn( 300 ).delay( 1500 ).fadeOut( 400 );
            }else{
                $( "#updateRequestDetails_success" ).fadeIn( 300 ).delay( 1500 ).fadeOut( 400 );
            }
		}
	}
    function searchListingsRequestProperty(){
        hiddenAdvancedDivRequestProperty();
        if(document.getElementById("selBathrooms").value > 0){
            number_of_bathrooms = document.getElementById("selBathrooms").value;
        }else{
            number_of_bathrooms = "";
        }
        if(document.getElementById("selBedrooms").value > 0){
            number_of_bedrooms = document.getElementById("selBedrooms").value;
        }else{
            number_of_bedrooms = "";
        }
        var tempFeatures = [];
        var features = document.getElementsByClassName('featurecheck');
        for(var j=0; j<features.length;j++){
            if(features[j].checked){
                tempFeatures.push(features[j].value);
            }
        }
        var tempDistrictArr = [];
        var districts = document.getElementsByClassName('district');
        for(var j=0; j<districts.length;j++){
            if(districts[j].checked){
                tempDistrictArr.push(districts[j].value);
            }
        }
        var tempMunicipalitiesArr = [];
        var municipalities = document.getElementsByClassName('municipality');
        for(var j=0; j<municipalities.length;j++){
            if(municipalities[j].checked){
                tempMunicipalitiesArr.push(municipalities[j].value);
            }
        }
        var tempLocationArr = [];
        var locations = document.getElementsByClassName('location');
        for(var j=0; j<locations.length;j++){
            if(locations[j].checked){
                tempLocationArr.push(locations[j].value);
            }
        }
        var tempPropertStatus = [];
        var propertStatus = document.getElementsByClassName('propertyStatus');
        for(var j=0; j<propertStatus.length;j++){
            if(propertStatus[j].checked){
                tempPropertStatus.push(propertStatus[j].value);
            }
        }
        var tempPropertTypes = [];
        var propertTypes = document.getElementsByClassName('propertyTypes');
        for(var j=0; j<propertTypes.length;j++){
            if(propertTypes[j].checked){
                tempPropertTypes.push(propertTypes[j].value);
            }
        }
        var price1 = document.getElementsByClassName("first-slider-value")[1].value;
        var size1 = document.getElementsByClassName("first-slider-value")[0].value;
        var price2 = document.getElementsByClassName("second-slider-value")[1].value;
        var size2 = document.getElementsByClassName("second-slider-value")[0].value;
        size1 = size1.substring(0,size1.length-6);
        price1 = price1.substring(1);
        price1 = price1.replace(",","");
        size2 = size2.substring(0,size2.length-6);
        price2 = price2.substring(1);
        price2 = price2.replace(",","");
        if(price1 == ''){
            price1 = 0;
        }
        if(price2 == ''){
            price2 = 600000;
        }
        if(size1 == ''){
            size1 = 0;
        }
        if(size2 == ''){
            size2 = 1300;
        }
        user_id = '<?php echo $user_id; ?>';
        const sendData = {
            "number_of_bathrooms": number_of_bathrooms,
            "number_of_bedrooms": number_of_bedrooms,
            "listing_types": tempPropertTypes,
            "features": tempFeatures,
            "min_area_size": parseInt(size1),
            "max_area_size": parseInt(size2),
            "min_price": parseInt(price1),
            "max_price": parseInt(price2),
            "districts": tempDistrictArr,
            "municipalities": tempMunicipalitiesArr,
            "locations": tempLocationArr,
            "page": document.getElementById("page_index").value,
            "customer_id": user_id,
            "show_favorites":"1"
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
                    <div style="display: flex; padding: 10px; width:100%">
                    <div class="item col-lg-4 col-md-12 col-xs-12 landscapes sale pr-0 pb-0 my-44 ft" >
                        <div class="project-single mb-0 bb-0">
                            <div class="project-inner project-head">
                                <div class="homes">
                                    <a href="/page/listing-details?index=`+list[i].id+`" class="homes-img">`;
                if(list[i].featured == true){
                    temp +=`<div class="homes-tag button alt featured">Featured</div>`;
                }
                temp +=`<div class="homes-tag button alt sale">`+list[i].property_type+`</div>
                                        <img src="`+list[i].image+`" alt="home-1" class="img-responsive">
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-12 homes-content pb-0 mb-44" >
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
                    <div class=" col-lg-1 col-md-12 price-properties pt-3 pb-0" style="display: grid;background:white;">
                        <h3 class="title mt-3">
                            <a href="/page/listing-details?index=`+list[i].id+`" tabindex="0">€ `+ list[i].price+`</a>
                        </h3>
                        <div class="compare">
                            <a style="cursor: pointer;" onclick="addFavoritRequestProperty(`+list[i].id+`)"><i id="faHeart`+list[i].id+`" class="fa fa-heart" style="font-size: x-large; ` + favorite + ` "></i></a>
                        </div>
                    </div>
                    <div class=" col-lg-1 col-md-12 price-properties pt-3 pb-0" style="background:white;display: flex;align-items: center;justify-content: center;" id="listing_add_remove`+list[i].id+`">
                        <a class="btn btn-secondary" style="color:white" onclick="addRequestListingRequestProperty(`+list[i].id+`)">Add</a>
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
                        temp1 += `<li class="page-item `+flag+`"><a class="page-link" onclick="loadPageRequestProperty(`+tempIndex+`)">`+list1[j].label+`</a></li>`;
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
                            temp1 += `<li class="page-item"><a class="page-link" onclick="loadPageRequestProperty(`+tempIndex+`)">`+list1[j].label+`</a></li>`;    
                        }else{
                            if(list1[j].active){
                                flag = "active";
                                temp1 += `<li class="page-item `+flag+`"><a class="page-link" onclick="loadPageRequestProperty(`+tempIndex+`)">`+list1[j].label+`</a></li>`;
                            }
                        }
                    }
                }
                document.getElementById("pagin_content").innerHTML = temp1;
            }
           
            sales_request_id = '<?php echo $sales_request_id; ?>';
            sendData2 = {
                "sales_request_id": sales_request_id,
            }
            const url2 = "/api/salesrequest-getlistings";
            let xhr2 = new XMLHttpRequest();
            xhr2.open('POST', url2, true);
            xhr2.setRequestHeader('Content-type', 'application/json');
            xhr2.send(JSON.stringify(sendData2));
            xhr2.onload = function () {
                data2 = JSON.parse(xhr2.response);
                list2 = data2.data;	
                for(k=0;k<list2.length;k++){
                    element = document.getElementById("listing_add_remove"+list2[k].listing_id);
                    if (typeof(element) != 'undefined' && element != null)
                    {
                        element.innerHTML = `<a class="btn btn-secondary" style="color:white" onclick="addRequestListingRequestProperty(`+list2[k].listing_id+`)">Remove</a>`;
                    }
                }
                
            }
		}
	}
    function loadPageRequestProperty(index){
        document.getElementById("page_index").value = index;
		searchListingsRequestProperty();
	}
    function addRequestListingRequestProperty(index){
        sales_request_id = '<?php echo $sales_request_id; ?>';
        sendData = {
            "sales_request_id": sales_request_id,
            "listing_id": index,
        }
        const url = "/api/salesrequest-addlisting";
        let xhr = new XMLHttpRequest();
        xhr.open('POST', url, true);
        xhr.setRequestHeader('Content-type', 'application/json');
        xhr.send(JSON.stringify(sendData));
        xhr.onload = function () {
            if(xhr.status == "201"){
                searchListingsRequestProperty();
            }else{
                alert("fail");
            }
        }
    }
    function removeRequestListingRequestProperty(index){
        sales_request_id = '<?php echo $sales_request_id; ?>';
        sendData = {
            "sales_request_id": sales_request_id,
            "listing_id": index,
        }
        const url = "/api/salesrequest-deletelisting";
        console.log(sendData);
        let xhr = new XMLHttpRequest();
        xhr.open('POST', url, true);
        xhr.setRequestHeader('Content-type', 'application/json');
        xhr.send(JSON.stringify(sendData));
        xhr.onload = function () {
            if(xhr.status == "201"){
                searchListingsRequestProperty();
            }else{
                alert("fail");
            }
        }
    }
    function addFavoritRequestProperty(index)
    {
        
        customer_id = '<?php echo $user_id; ?>';
        if(customer_id !== ""){
            const url = "/api/add-remove-to-favorites";
            const sendData = {
                "customer_id": customer_id,
                "listing_id": index,
            };
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
            }
        }else{
            loginIn();
        }
    }
</script>
