<?php

use App\Helpers\Helper;

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

    $postData = [
        'slug'=>"menu",
        'locale'=>"en_US",
        'menu_id'=>"1",
    ];

    $menu_response = Helper::get_menu($postData);       
    $menu_response = json_decode($menu_response);
?>
<style>
    
    #header.cloned.sticky ul li a:hover {
    color: #707070 !important;
}
</style>

<div class="homepage-9 hp-6 homepage-1 mh">
    <div id="wrapper">
        <header id="header-container" class="header ">
            <div id="header" class="head-tr bottom cloned sticky">
                <div id="logo" style="position: absolute;width: 100%;text-align: center;">
                    <a href="/page/home"><img src="/theme/sabbiancowebsite/assets/images/logosabbianco.png" data-sticky-logo="/theme/sabbiancowebsite/assets/images/logosabbianco.png" alt=""></a>
                </div>
                <div class="container container-header">
                    <div class="left-side">
                        <div class="mmenu-trigger">
                            <button class="hamburger hamburger--collapse" type="button">
                                <span class="hamburger-box">
                                    <span class="hamburger-inner"></span>
                                </span>
                            </button>
                        </div>
                        <nav id="navigation" class="style-1 head-tr" style="border:none;">
                            <ul name="menuResponsive"  class="menu_style">
                            <?php
                                foreach($menu_response as $menu){
                                    if($menu->parent_id == null){
                                        $sub_children_menu = []; 
                                        foreach($menu_response as $submenu){
                                            if($submenu->parent_id == $menu->id){
                                                $sub_children_menu[] = $submenu; 
                                            }
                                        }
                                        echo '<li><a href="'.$menu->value.'">'.$menu->name.'</a>';
                                        if(count($sub_children_menu) > 0){
                                            echo '<ul>';
                                            foreach($sub_children_menu as $submenu){
                                                echo '<li><a href="'.$submenu->value.'">'.$submenu->name.'</a></li>';
                                            }
                                            echo '</ul>';
                                        }
                                        
                                        echo '</li>';

                                    }
                                }
                                ?>
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

                    <span  id="headerlogindiv">
                        <div class="right-side d-none d-none d-lg-none d-xl-flex sign ml-0" >
                            <!-- Header Widget -->
                            <div class="header-widget sign-in">
                                <div class="show-reg-form" ><a style="cursor: pointer;" onclick="loginIn()">Sign In</a></div>
                            </div>
                            <div class="header-widget sign-in">
                                <div class="show-reg-form" ><a style="cursor: pointer;" onclick="signUp()">Sign Up</a></div>
                            </div>
                            <!-- Header Widget / End -->
                        </div>
                    </span>
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
<script type="text/javascript">
	// window.addEventListener("load", (event) => {
        // loadMenuHeader2();
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
            // document.getElementsByName("menuResponsive")[1].innerHTML = temp;
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