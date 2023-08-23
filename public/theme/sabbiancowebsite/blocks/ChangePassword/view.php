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
<div class="inner-pages maxw1600 m0a dashboard-bd">
    <section class="user-page section-padding pt-55">
        <div class="container-fluid">
            <div class="row" >
                <div class="col-lg-3 col-md-12 col-xs-12 pl-0 pr-0 user-dash">
                    <div class="user-profile-box mb-0" style="height: 600px;">
                        
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
                                    <a  class="active" href="/page/changepassword">
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
                    <div class="my-address">
                        <h3 class="heading pt-0">Change Password</h3>
                            <div class="row">
                                <div class="col-lg-12 ">
                                    <div class="form-group name">
                                        <label>Current Password</label>
                                        <input type="password" id="current-password" class="form-control" placeholder="Current Password">
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-group email">
                                        <label>New Password</label>
                                        <input type="password" id="new-password" class="form-control" placeholder="New Password">
                                    </div>
                                </div>
                                <div class="col-lg-12 ">
                                    <div class="form-group subject">
                                        <label>Confirm New Password</label>
                                        <input type="password" id="confirm-new-password" class="form-control" placeholder="Confirm New Password">
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="send-btn mt-2">
                                        <button onclick="updatePasswordChangePassword();" class="btn btn-common">Send Changes</button>
                                    </div>
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
	// });
    function updatePasswordChangePassword()
    {
        
        user_id = '<?php echo $user_id; ?>';
        password = document.getElementById("new-password").value;
        confirm_password = document.getElementById("confirm-new-password").value;
        const url = "/api/webuserschangepassword";
        data = {
            "password":password,
            "confirm_password":confirm_password,
            "id":user_id
        }
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