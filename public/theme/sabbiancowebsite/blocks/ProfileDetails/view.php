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
$serverUrl = env('APP_URL');
?>
<div class="th-8">
    <section >
        <div >
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
                                    <a  class="active" href="/page/profile">
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
                <div class="col-lg-9 col-md-12 col-xs-12 pl-0 user-dash2" style="display: flex;justify-content: center;">
                    <div class="widget-boxed" style="width: 650px;margin-bottom: 20px;">
                        <div class="widget-boxed-header">
                            <h4>Profile Details</h4>
                        </div>
                        <div class="sidebar-widget author-widget2">
                            
                            <ul class="author__contact" style="margin-left: 40px; margin-top:50px">
                                <li style="margin-bottom: 20px;display: flex;justify-content: space-between;align-items: center;">
                                    Name:<input style="width: 430px" type="text" id="up_name"    />
                                </li>
                                <li style="margin-bottom: 20px;display: flex;justify-content: space-between;align-items: center;">
                                    Surname:<input style="width: 430px" type="text" id="up_surname"   />
                                </li>
                                <li style="margin-bottom: 20px;display: flex;justify-content: space-between;align-items: center;">
                                    Company Name:&nbsp; <input style="width: 430px" type="text" id="up_company_name"   />
                                </li>
                                <li style="display: flex;">
                                    Country:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                    <select id="up_country" style="display: block;width: 452px;height: 40px;">
                                    </select>
                                </li>
                                <li style="display: flex;">
                                    District:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                    <input style="width:170px;height: 30px;" type="text" id="up_district"    />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                    City:&nbsp; <input style="width:190px;height: 30px;" type="text" id="up_city"    />
                                </li>
                                <!-- <li style="margin-bottom: 20px;display: flex;justify-content: space-between;">
                                    Postal Code:&nbsp; <input style="width: 430px" type="text" id="up_postal_code"   />
                                </li> -->
                                <li style="margin-bottom: 20px;display: flex;justify-content: space-between;align-items: center;">
                                    Mobile: <input style="width: 430px" type="text" id="up_mobile"   />
                                </li>
                                <li style="margin-bottom: 20px;display: flex;justify-content: space-between;align-items: center;">
                                    Phone: <input style="width: 430px" type="text" id="up_phone"  />
                                </li>
                                <li style="margin-bottom: 20px;display: flex;justify-content: space-between;align-items: center;">
                                    Email: <input style="width: 430px" type="text" id="up_email"  />
                                </li>
                                <li style="margin-bottom: 20px;display: flex;justify-content: space-between;align-items: center;">
                                    Note: <textarea style="width: 430px"  id="up_notes"  ></textarea>
                                </li>
                            </ul>
                            <div class="agent-contact-form-sidebar" style="display: flex; justify-content: center; color: white">
                                <a class="btn btn-yellow" onclick="udpateProfileProfileDetails()">Submit</a>
                            </div>
                        </div>
                    </div>
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
		loadCountriesProfileDetails();
        loadProfileProfileDetails();
        $('select').niceSelect('destroy');
	// });
    function loadProfileProfileDetails()
    {
        
        user_id = '<?php echo $user_id; ?>';
        const url = "/api/get-webuser";
        data = {
            "id":user_id,
        }
        let xhr = new XMLHttpRequest();
        xhr.open('POST', url, true);
        xhr.setRequestHeader('Content-type', 'application/json');
        xhr.send(JSON.stringify(data));
        xhr.onload = function () {
            var list = JSON.parse(xhr.response);
            var data = list.data[0];
            document.getElementById("up_name").value = data.name;
            document.getElementById("up_surname").value = data.surname;
            document.getElementById("up_company_name").value = data.company_name;
            document.getElementById("up_country").value = data.country;
            document.getElementById("up_district").value = data.district;
            document.getElementById("up_mobile").value = data.mobile;
            document.getElementById("up_phone").value = data.phone;
            document.getElementById("up_email").value = data.email;
            document.getElementById("up_city").value = data.city;
            document.getElementById("up_notes").value = data.notes;
        }
    }
    function loadCountriesProfileDetails()
    {
        
        const url = "/api/get-countries";
        let xhr = new XMLHttpRequest();
        xhr.open('POST', url, true);
        xhr.setRequestHeader('Content-type', 'application/json');
        xhr.send();
        xhr.onload = function () {
            var list = JSON.parse(xhr.response);
            var data = list.data;
            temp ="";
            for(i=0;i<data.length;i++){
                temp += `<option value="`+data[i].code+`">`+data[i].displayname+`</option>`;
            }
            document.getElementById("up_country").innerHTML = temp;
            // document.getElementById("up_country").style.display = "block";
            // selectDiv = document.getElementsByClassName("nice-select list");
            // selectDiv[0].style.display = "none";
        }
    }
    function udpateProfileProfileDetails()
    {
        
        user_id = '<?php echo $user_id; ?>';
        data = {
            "id": user_id,
            "name": document.getElementById("up_name").value,
            "surname": document.getElementById("up_surname").value,
            "company_name": document.getElementById("up_company_name").value,
            "country": document.getElementById("up_country").value,
            "district": document.getElementById("up_district").value,
            "mobile": document.getElementById("up_mobile").value,
            "phone": document.getElementById("up_phone").value,
            "email": document.getElementById("up_email").value,
            "city": document.getElementById("up_city").value,
            "notes": document.getElementById("up_notes").value
        };
        const url = "/api/update-webuser";
        let xhr = new XMLHttpRequest();
        xhr.open('POST', url, true);
        xhr.setRequestHeader('Content-type', 'application/json');
        xhr.send(JSON.stringify(data));
        xhr.onload = function () {
            if(xhr.status == "201"){
                alert("Update Ok");
                window.location.reload();
            }else{
                alert("Update Fail");
            }
        }
    }
</script>