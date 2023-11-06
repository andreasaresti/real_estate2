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
    ];

    $menu_response = Helper::get_menu($postData);       
    $menu_response = json_decode($menu_response);

?>


<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="sha512-9usAa10IRO0HhonpyAIVpjrylPvoDwiPUiKdWk5t3PyolY1cOd4DSE0Ga+ri4AuTroPR5aQvXU9xC6qOPnzFeg==" crossorigin="anonymous" referrerpolicy="no-referrer" />

<div class="homepage-9 hp-6 homepage-1 mh" style="z-index: 9999;position: relative;">
    <div id="wrapper">
        <header id="header-container" class="zillow-header">
            <div id="header"  style="padding: 0px;height: 80px;">
                <div id="logo" style="position: absolute;width: 100%;text-align: center;">
                    <a href="/page/home"><img style="width:175px;margin-top: 2px;" src="/theme/sabbiancowebsite/assets/images/logosabbianco.png" data-sticky-logo="/theme/sabbiancowebsite/assets/images/logosabbianco.png" alt=""></a>
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
                        <nav id="navigation" class="style-1 head-tr">
                            <ul name="menuResponsive" class="menu_style">
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
                    
                    <?php if($email != ''){?>
                    <div class="header-user-menu user-menu add">
                        <div class="header-user-name" style="font-size: 20px;">
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
    </div>
</div>


<script type="text/javascript">
    

</script>

