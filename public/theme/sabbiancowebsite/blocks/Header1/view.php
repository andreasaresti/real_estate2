
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
<div class="homepage-9 hp-6 homepage-1 mh" style="z-index: 9999;position: relative;">
    <div id="wrapper">
        <header id="header-container" class="header head-tr">
            <div id="header" class="head-tr bottom">
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
                        <nav id="navigation" class="style-1 head-tr">
                            <ul name="menuResponsive" class="menu_style">
                            </ul>
                        </nav>
                    </div>
                    <div class="right-side d-none d-lg-none d-xl-flex">
                        <!-- Header Widget -->
                        <div class="header-widget">
                            <a onclick="showAddListingHeader1();" class="button border">Add Listing<i class="fas fa-laptop-house ml-2"></i></a>
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
                                <li>
                                    <a href="/page/salesequest-pendingappproval">Sale Requests</a>
                                </li>
                                <li>
                                    <a href="/page/salesequest-open">SalesRequests List</a>
                                </li>
                            <?php //}?>

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
                            <div class="show-reg-form" ><a style="cursor: pointer;" onclick="loginIn()">Sign In</a></div>
                        </div>
                        <div class="header-widget sign-in">
                            <div class="show-reg-form" ><a style="cursor: pointer;" onclick="signUp()">Sign Up</a></div>
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
        <div class="clearfix"></div>
        <section id="hero-area" class="parallax-searchs home15 overlay thome-7 thome-1" data-stellar-background-ratio="0.5">
            <div class="hero-main">
                <div class="container" data-aos="zoom-in">
                    <div class="row">
                        <div class="col-12">
                            <div class="hero-inner">
                                <!-- Welcome Text -->
                                <div class="welcome-text">
                                    <h1 class="h1">Find Your Dream
                                    <br class="d-md-none">
                                    <span class="typed border-bottom"></span>
                                </h1>
                                    <p class="mt-4">We Have Over Million Properties For You.</p>
                                </div>
                                <!--/ End Welcome Text -->
                                <!-- Search Form -->
                                <div class="col-12">
                                    <div class="banner-search-wrap">
                                        <ul class="nav nav-tabs rld-banner-tab">
                                            <li class="nav-item">
                                                <a class="nav-link active" data-toggle="tab" href="#tabs_1">For Sale</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" data-toggle="tab" href="#tabs_2">For Rent</a>
                                            </li>
                                        </ul>
                                        <div class="tab-content">
                                            <div class="tab-pane fade show active" id="tabs_1">
                                                <div class="rld-main-search" style="display: flex;justify-content: center;">
                                                    <div class="row">
                                                        <div class="rld-single-input">
                                                            <input type="text" placeholder="Enter Keyword..." autocomplete="off" id="search_string">
                                                        </div>
                                                        <div class="rld-single-select" style="margin-bottom: 15px"  onmouseover="hiddenAdvancedDivHeader1();">
                                                            <input type="hidden" id="selActivePropertType" name="selActivePropertType" value="">
                                                            <nav id="navigation" class="style-1" style="background: white; margin-top:0px;margin-left: 5px!important;margin-right: 5px;border: 1px solid;border-radius: 5px;border-color: #ebebeb;">
                                                                <ul>
                                                                    <li ><a>Property Type</a>
                                                                        <ul id="activePropertType">
                                                                        
                                                                        </ul>
                                                                    </li>
                                                                </ul>
                                                            </nav>
                                                        </div>
                                                        <div class="rld-single-select" style="margin-bottom: 15px" onmouseover="hiddenAdvancedDivHeader1();">
                                                            <input type="hidden" id="selLocation" name="selLocation" value="">
                                                            <nav id="navigation" class="style-1" style="background: white; margin-top:0px;margin-left: 5px!important;margin-right: 5px;border: 1px solid;border-radius: 5px;border-color: #ebebeb;">
                                                                <ul>
                                                                    <li ><a id="location_title">Location</a>
                                                                        <ul id="activelocation">
                                                                        
                                                                        </ul>
                                                                    </li>
                                                                </ul>
                                                            </nav>
                                                        </div>
                                                        <div class="dropdown-filter"><span>Advanced Search</span></div>
                                                        <div class="col-xl-2 col-lg-2 col-md-4 pl-0">
                                                            <a class="btn btn-yellow" onclick="lists_view();">Search Now</a>
                                                        </div>
                                                        <div id="advancedSearch" class="explore__form-checkbox-list full-filter">
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
                                                                <div class="col-lg-4 col-md-6 py-1 pr-30 pl-0">
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
                                                                <div class="col-lg-5 col-md-12 col-sm-12 py-1 pr-30 mr-5 sld ">
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
                                                                            <div id="price-range" data-min="0" data-max="600000" data-unit="$"></div>
                                                                            <div class="clearfix"></div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-3 col-md-6 col-sm-12 py-1 pr-30 ">
                                                                    <!-- Checkboxes -->
                                                                    <div class="checkboxes one-in-row margin-bottom-10 ch-1" id="activefeaturesLeft">
                                                    
                                                                    </div>
                                                                    <!-- Checkboxes / End -->
                                                                </div>
                                                                <div class="col-lg-3 col-md-6 col-sm-12 py-1 pr-30 ">
                                                                    <!-- Checkboxes -->
                                                                    <div class="checkboxes one-in-row margin-bottom-10 ch-1" id="activefeaturesRight">
                                                    
                                                                    </div>
                                                                    <!-- Checkboxes / End -->
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!--/ End Search Form -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>
<a href="#signup"  data-toggle="modal" data-target=".log-sign" id="loginModal"></a>
<div class="modal fade bs-modal-sm log-sign" style="z-index:9999" id="myModal" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
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
        loadMenuHeader1();
        loadLangHeader1();
		loadActiveFeaturesHeader1();
        loadActiveDistrictHeader1();
        loadActivePropertTypeHeader1();
	// });
    function loadLangHeader1(){
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
                    temp += `<li><a style="color: black;" onclick="changeLangHeader1('`+list[i].name+`')">`+list[i].name+`</a></li>`;
                }
                temp += `</ul>`;
            }
            document.getElementsByName("activeLangContent")[0].innerHTML = temp;
            document.getElementsByName("activeLangContent")[1].innerHTML = temp;
            //document.getElementById("").innerHTML = temp;
		}
	}
    function changeLangHeader1(data){
        document.getElementsByName("activeLang")[0].innerHTML = data;
        document.getElementsByName("activeLang")[1].innerHTML = data;
    }
    function loadMenuHeader1(){
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
            console.log(list);
            var temp ="";
            for(i=0;i<list.length;i++){
                if(list[i].parent_id == null){
                    temp += `<li><a href="`+list[i].value+`">`+list[i].name+`</a><ul>`;
                    for(j=0;j<list.length;j++){
                        if(list[j].parent_id == list[i].id){
                            temp += `<li><a href="`+list[j].value+`">`+list[j].name+`</a><ul>`;
                            for(k=0;k<list.length;k++){
                                if(list[k].parent_id == list[j].id){
                                    temp += `<li><a href="`+list[k].value+`">`+list[k].name+`</a></li>`;
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
            document.getElementsByName("menuResponsive")[1].innerHTML = temp;
		}
	}
    function loadActivePropertTypeHeader1(){
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
                temp += `<li><a><input type="checkbox" class="propertTypes" value="`+data[i].id+`" id="propertTypes`+data[i].id+`" >`+data[i].displayname+`</a>
                        </li>`;
            }
            document.getElementById("activePropertType").innerHTML = temp;
		}
	}
	function loadActiveFeaturesHeader1(){
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
                temp += `<input id="fcheck-`+i+`" type="checkbox" class="featurecheck" value = "`+data[i].id+`">
                <label for="fcheck-`+i+`">`+data[i].displayname+`</label>`;
            }
            document.getElementById("activefeaturesLeft").innerHTML = temp;
            temp ="";
            for(i=Math.round(data.length/2);i<data.length;i++){
                temp += `<input id="fcheck-`+i+`" type="checkbox" class="featurecheck" value = "`+data[i].id+`">
                <label for="fcheck-`+i+`">`+data[i].displayname+`</label>`;
            }
            document.getElementById("activefeaturesRight").innerHTML = temp;
		}
	}
    function loadActiveDistrictHeader1(){
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
                temp += `<li class="parent locationLi" ><a><input type="checkbox" id="districts`+data[i].id+`" class="district" name="district[]" value="`+data[i].id+`" onchange="changeLocationsHeader1('districts','`+data[i].id+`','`+data[i].displayname+`')">`+data[i].displayname+`</a>
                <div class="wrapper"><ul style="transform:none;position:initial; visibility: visible;opacity: 100; overflow-x: hidden; overflow-y: auto; max-height: 600px;" id="subDistricts`+data[i].id+`"></ul></div></li>`;
            }
            document.getElementById("activelocation").innerHTML = temp;
            loadActiveMunicipalityHeader1();
		}
	}
    function loadActiveMunicipalityHeader1(){
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
                        temp += `<li class="parent locationLi"><a><input type="checkbox"  id="municipalities`+data[i].id+`"  class="municipality" name="municipality[]" value="`+data[i].id+`" onchange="changeLocationsHeader1('municipalities','`+data[i].id+`','`+data[i].displayname+`')">`+data[i].displayname+`</a>
                        <div class="wrapper"><ul style="visibility: visible;opacity: 100;" id="subMunicipalities`+data[i].id+`"></ul></div></li>`;
                    }
                }
                document.getElementById("subDistricts"+districts[j].value).innerHTML = temp;
                loadActiveLocationHeader1();
            }
		}
	}
    function loadActiveLocationHeader1(){
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
                        temp += `<li><a><input type="checkbox"  id="locations`+data[i].id+`"  class="location" name="location[]" value="`+data[i].id+`" onchange="changeLocationsHeader1('locations','`+data[i].id+`','`+data[i].displayname+`')">`+data[i].displayname+`</a>`;
                    }
                }
                document.getElementById("subMunicipalities"+municipalities[j].value).innerHTML = temp;
            }
		}
	}
    function hiddenAdvancedDivHeader1(){
        document.getElementById('advancedSearch').className = "explore__form-checkbox-list full-filter";
    }
    function changeLocationsHeader1(flag,id,name)
    {
        //insert_location(flag,id,name,"");
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
                //alert("LogOut Ok");
                window.location.href="/page/home";
            }else{
                alert("LogOut Fail");
            }
        }
    }
    function lists_view(){
        hiddenAdvancedDivHeader1();
        customer_id = '<?php echo $user_id; ?>';
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
        var propertStatus = document.getElementsByClassName('propertStatus');
        for(var j=0; j<propertStatus.length;j++){
            if(propertStatus[j].checked){
                tempPropertStatus.push(propertStatus[j].value);
            }
        }
        var tempPropertTypes = [];
        var propertTypes = document.getElementsByClassName('propertTypes');
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
        if(document.getElementById('search_string').value == ""){
            search_term = "";
        }else{
            search_term = document.getElementById('search_string').value;
        }
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
            "search_term": search_term,
            "customer_id": customer_id,
        };
        console.log(sendData);
        localStorage.setItem("list_search_data", JSON.stringify(sendData));
        window.location.href = "/page/listings";
	}
    function showAddListingHeader1(){
        user_id = '<?php echo $user_id; ?>';
        if(user_id !== ""){
            window.location.href="/page/add-listings";
        }else{
            loginIn()
        }
	}
</script>