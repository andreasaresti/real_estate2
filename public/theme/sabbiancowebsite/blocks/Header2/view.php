<?php
    if(isset($_SESSION["user_id"])){
        $user_id = $_SESSION["user_id"];
    }else{
        $user_id = "";
    }

    if(isset($_SESSION["email"])){
        $email = $_SESSION["email"];
    }else{
        $email = "";
    }

    if(isset($_SESSION["user_role"])){
        $user_role = $_SESSION["user_role"];
    }else{
        $user_role = "";
    }
    if(isset($_SESSION["user_image"])){
        $user_image = $_SESSION["user_image"];
    }else{
        $user_image = "";
    }
    if(isset($_SESSION["name"])){
        $name = $_SESSION["name"];
    }else{
        $name = "";
    }
?>
<div class="homepage-9 hp-6 homepage-1 mh">
    <div id="wrapper">
        <header id="header-container" class="header ">
            <div id="header" class="head-tr bottom cloned sticky">
                <div class="container container-header">
                    <div class="left-side">
                        <div id="logo">
                            <a href="/page/home"><img src="/theme/sabbiancowebsite/assets/images/logosabbianco.png" data-sticky-logo="/theme/sabbiancowebsite/assets/images/logosabbianco.png" alt=""></a>
                        </div>
                        <div class="mmenu-trigger">
                            <button class="hamburger hamburger--collapse" type="button">
                                <span class="hamburger-box">
                                    <span class="hamburger-inner"></span>
                                </span>
                            </button>
                        </div>
                        <nav id="navigation" class="style-1 head-tr" style="border:none;">
                            <ul name="menuResponsive"  class="menu_style">
                            </ul>
                        </nav>
                    </div>
                    <div class="right-side d-none d-none d-lg-none d-xl-flex">
                        <!-- Header Widget -->
                        <div class="header-widget">
                            <a onclick="showAddListingHeader2();" class="button border">Add Listing<i class="fas fa-laptop-house ml-2"></i></a>
                        </div>
                        <!-- Header Widget / End -->
                    </div>
                    <?php if($email != ''){?>
                    <div class="header-user-menu user-menu add">
                        <div class="header-user-name">
                            <!-- <a href="/page/profile"> -->
                            
                            Hi, <?php echo $name; ?>
                            <!-- </a> -->
                        </div>
                        <ul>
                            <?php if($user_role == "sales_people"){ ?>
                                <li>
                                    <a href="/page/salesequest-pendingappproval">Sale Requests</a>
                                </li>
                                <li>
                                    <a href="/page/salesequest-open">SalesRequests List</a>
                                </li>
                            <?php }?>

                            <li>
                                <a href="/page/profile">Profile</a>
                            </li>
                            <li>
                                <a href="/page/my-listings">My Properties</a>
                            </li>
                            <li>
                                <a href="/page/favorited">Favorited Properties</a>
                            </li>
                            <li>
                                <a class="active"  href="/page/add-listings">Add Property</a>
                            </li>
                            <li>
                                <a href="/page/changepassword">Change Password</a>
                            </li>
                            <li>
                                <a onclick="signOut()">Log Out</a>
                            </li>
                        </ul>
                    </div>
                    <?php 
                    }else{
                    ?>
                    <!-- Right Side Content / End -->

                    <div class="right-side d-none d-none d-lg-none d-xl-flex sign ml-0">
                        <!-- Header Widget -->
                        <div class="header-widget sign-in">
                            <div class="show-reg-form" ><a style="color: black;cursor: pointer;" onclick="loginIn()">Sign In</a></div>
                        </div>
                        <div class="header-widget sign-in">
                            <div class="show-reg-form" ><a style="color: black;cursor: pointer;" onclick="signUp()">Sign Up</a></div>
                        </div>
                        <!-- Header Widget / End -->
                    </div>
                    <!-- Right Side Content / End -->
                    <?php
                    }
                    ?>
                    <div class="header-user-menu user-menu add d-none d-lg-none d-xl-flex">
                        <div class="lang-wrap" name="activeLangContent">
                            
                        </div>
                    </div>
                </div>
            </div>
        </header>
        <div class="clearfix" style="height: 100px;"></div>
    </div>
</div>
<a href="#signup"  data-toggle="modal" data-target=".log-sign" id="loginModal"></a>
<div class="modal fade bs-modal-sm log-sign" id="myModal" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm" style="margin-top: 200px;">
        <div class="modal-content" style="width: 500px;">
            <div>
                <div class="bs-example bs-example-tabs">
                    <ul id="myTab" class="nav nav-tabs">
                        <li id="loginModalTab1" style="padding: 10px;" class=" tab-style login-shadow "><a href="#signin" id="loginModalTabButton" data-toggle="tab">Log In</a></li>
                        <li id="loginModalTab2" style="padding: 10px;" class=" tab-style "><a href="#signup"  id="signupModalTabButton" data-toggle="tab">Sign Up</a></li>
                    </ul>
                </div>
                <div class="modal-body">
                    <div id="myTabContent" class="tab-content" style="margin-left: 20px; margin-right: 20px;">
                    <div class="alert-box success" id="login_success">Login Ok !!!</div>
                    <div class="alert-box failure" id="login_failure">fail!!!</div>
                    <div class="tab-pane fade active in" id="signin">
                        <!-- Sign In Form -->
                        <!-- Text input-->
                        <div class="group">
                            <label for="date">Email address</label></div>        
                            <input required="" id="login_email" class="loginModalInput" type="text"><span class="highlight"></span><span class="bar"></span>
                        <!-- Password input-->
                        <div class="group">
                            <label for="date">Password</label>
                            <input required="" id="login_password" class="loginModalInput" type="password"><span class="highlight"></span><span class="bar"></span>
                        </div>
                        <em>minimum 6 characters</em>

                    <div class="forgot-link">
                        <a href="#forgot" data-toggle="modal" data-target="#forgot-password"> I forgot my password</a>
                        </div>
                        <!-- Button -->
                        <div class="control-group">
                        <label class="control-label" for="signin"></label>
                        <div class="controls">
                            <button onclick="modalLoginIn()" class="btn btn-primary btn-block">Log In</button>
                        </div>
                        </div>
                    </div>
                    
                    
                    <div class="tab-pane fade" id="signup">
                        <div class="alert-box success" id="signup_success">SignUp Ok !!!</div>
                        <div class="alert-box failure" id="signup_failure">fail!!!</div>
                        <!-- Sign Up Form -->
                        <!-- Text input-->
                        <div class="group">
                            <label for="date">First Name</label></div>
                            <input required="" id="SignFristName" class="loginModalInput" type="text"><span class="highlight"></span><span class="bar"></span>
                        <!-- Text input-->
                        <div class="group">
                            <label for="date">Surname</label></div>
                            <input required="" id="SignLastName" class="loginModalInput" type="text"><span class="highlight"></span><span class="bar"></span>
                        <!-- Password input-->
                        <div class="group">
                            <label for="date">Email</label></div>
                            <input required="" id="SignEmail" class="loginModalInput" type="text"><span class="highlight"></span><span class="bar"></span>
                        <!-- Text input-->
                        <div class="group">
                            <label for="date">Password</label></div>
                            <input required="" id="Signpassword1" class="loginModalInput" type="password"><span class="highlight"></span><span class="bar"></span>
                        <div class="group">
                            <label for="date">Confirm password</label></div>
                            <input required=""  id="Signpassword2" class="loginModalInput" type="password"><span class="highlight"></span><span class="bar"></span>
                        <em>1-8 Characters</em>
                        
                        <!-- Button -->
                        <div class="control-group">
                        <label class="control-label" for="confirmsignup"></label>
                        <div class="controls">
                            <button onclick="modalSignUp()" class="btn btn-primary btn-block">Sign Up</button>
                        </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
	// window.addEventListener("load", (event) => {
        loadMenuHeader2();
        loadLangHeader2();
	// });
    function loadLangHeader2(){
		
        data = {
            "slug":"menu",
            "locale":"en_US",
        }
		const url = "/api/getlanguages";
		let xhr = new XMLHttpRequest();
		xhr.open('POST', url, true);
		xhr.setRequestHeader('Content-type', 'application/json');
		xhr.send(JSON.stringify(data));
		xhr.onload = function () {
			list = JSON.parse(xhr.response);
            var temp ="";
            if(list.length>1){
                temp = `<div class="show-lang"><span><i class="fas fa-globe-americas"></i><strong name="activeLang">`+list[0].name+`</strong></span><i class="fa fa-caret-down arrlan"></i></div>
                            <ul class="lang-tooltip lang-action no-list-style" name="activeLangList">`;
                for(i=0;i<list.length;i++){
                    temp += `<li><a style="color: black;" onclick="changeLangHeader2('`+list[i].name+`')">`+list[i].name+`</a></li>`;
                }
                temp += `</ul>`;
            }
            document.getElementsByName("activeLangContent")[0].innerHTML = temp;
            document.getElementsByName("activeLangContent")[1].innerHTML = temp;
		}
	}
    function changeLangHeader2(data){
        document.getElementsByName("activeLang")[0].innerHTML = data;
        document.getElementsByName("activeLang")[1].innerHTML = data;
    }
    function loadMenuHeader2(){
        data = {
            "slug":"menu",
            "locale":"en_US",
        }
		const url = "/api/getmenu";
		let xhr = new XMLHttpRequest();
		xhr.open('POST', url, true);
		xhr.setRequestHeader('Content-type', 'application/json');
		xhr.send(JSON.stringify(data));
		xhr.onload = function () {
			list = JSON.parse(xhr.response);
            var temp ="";
            for(i=0;i<list.length;i++){
                if(list[i].parent_id == null){
                    temp += `<li><a style="font-size: 16px;" href="`+list[i].value+`">`+list[i].name+`</a><ul>`;
                    for(j=0;j<list.length;j++){
                        if(list[j].parent_id == list[i].id){
                            temp += `<li><a style="font-size: 16px;" href="`+list[j].value+`">`+list[j].name+`</a><ul>`;
                            for(k=0;k<list.length;k++){
                                if(list[k].parent_id == list[j].id){
                                    temp += `<li><a  style="font-size: 16px;" href="`+list[k].value+`">`+list[k].name+`</a></li>`;
                                }
                            }
                            temp += `</ul></li>`;
                        }
                    }
                    temp += `</ul></li>`;
                }
            }
            temp = temp.replaceAll("<ul></ul>","");
            // temp += `<li class="d-none d-xl-none d-block d-lg-block mt-5 pb-4 ml-5 border-bottom-0"><a href="/page/add-listings" class="button border btn-lg btn-block text-center">Add Listing<i class="fas fa-laptop-house ml-2"></i></a></li>`;
            document.getElementsByName("menuResponsive")[0].innerHTML = temp;
            // document.getElementsByName("menuResponsive")[1].innerHTML = temp;
		}
	}
    function loginIn()
    {
        document.getElementById("loginModal").click();
        document.getElementById("loginModalTabButton").click();
    }
    function signUp()
    {
        document.getElementById("loginModal").click();
        document.getElementById("signupModalTabButton").click();
    }
    function modalLoginIn()
    {
        
        let data = {
            "email": document.getElementById("login_email").value,
            "password": document.getElementById("login_password").value,
        };
        
        const url = "/api/login-webuser";
        let xhr = new XMLHttpRequest();
        xhr.open('POST', url, true);
        xhr.setRequestHeader('Content-type', 'application/json');
        xhr.send(JSON.stringify(data));
        xhr.onload = function () {
            console.log(xhr.response);
            data = JSON.parse(xhr.response);
            
            if(xhr.status == "201"){
                $( "div.success" ).fadeIn( 300 ).delay( 1500 ).fadeOut( 400 );
                window.location.href="/page/profile";
            }else{
                if( data.hasOwnProperty('errors')){
                    if( data.errors.hasOwnProperty('password')){
                        $("#login_failure").html(data.errors.password);
                    }
                    if( data.errors.hasOwnProperty('email')){
                        $("#login_failure").html(data.errors.email);
                    }
                }
                if( data.hasOwnProperty('message')){
                    $("#login_failure").html(data.message);
                }
                $( "div.failure" ).fadeIn( 300 ).delay( 1500 ).fadeOut( 400 );
                // alert("Login Fail");
            }
        }
    }
    function modalSignUp()
    {
        let data = {
            "name": document.getElementById("SignFristName").value,
            "surname": document.getElementById("SignLastName").value,
            "email": document.getElementById("SignEmail").value,
            "password": document.getElementById("Signpassword1").value,
            "confirm_password": document.getElementById("Signpassword2").value,
        };
        
        const url = "/api/create-webuser";
        let xhr = new XMLHttpRequest();
        xhr.open('POST', url, true);
        xhr.setRequestHeader('Content-type', 'application/json');
        xhr.send(JSON.stringify(data));
        xhr.onload = function () {
            data = JSON.parse(xhr.response);
            if(xhr.status == "201"){
                $( "div.signup_success" ).fadeIn( 300 ).delay( 1500 ).fadeOut( 400 );
                window.location.href="/page/profile";
            }else{
                if( data.hasOwnProperty('errors')){
                    if( data.errors.hasOwnProperty('password')){
                        $("#signup_failure").html(data.errors.password);
                    }
                    if( data.errors.hasOwnProperty('email')){
                        $("#signup_failure").html(data.errors.email);
                    }
                }
                if( data.hasOwnProperty('message')){
                    $("#signup_failure").html(data.message);
                }
                $( "div.signup_failure" ).fadeIn( 300 ).delay( 1500 ).fadeOut( 400 );
                // alert("Login Fail");
            }
        }
    }
    function signOut()
    {
        
        const url = "/api/logout-webuser";
        let xhr = new XMLHttpRequest();
        xhr.open('POST', url, true);
        xhr.setRequestHeader('Content-type', 'application/json');
        xhr.send();
        xhr.onload = function () {
            if(xhr.status == "201"){
                window.location.href="/page/home";
            }else{
                alert("LogOut Fail");
            }
        }
    }
    function showAddListingHeader2(){
        user_id = '<?php echo $user_id; ?>';
        if(user_id !== ""){
            window.location.href="/page/add-listings";
        }else{
            loginIn()
        }
	}
</script>