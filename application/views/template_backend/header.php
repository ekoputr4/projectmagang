<?php //$data['session'] =  $this->session->userdata('isLogin'); ?>
<!-- <div class="header navbar navbar-inverse navbar-fixed-top">
    <div class="navbar-inner">
        <div style="background-color: #FFFFFF;">
            <div style="float: left; width: 100%; background-color: #FFFFFF;">
                <font style="float: left; padding-left: 10px; margin: 10px auto; font-size: 20px;"><strong>BENGKEL MARZUKI MOTOR</strong></font>
                
                <ul class="nav pull-right">
                    <li class="dropdown user">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <img alt="" src="assets/img/avatar1_small.jpg" />
                        <span class="username"><b><?php echo getSession('role').', '.getSession('user') ?></b></span>
                        <i class="icon-angle-down"></i>
                        </a>
                        <ul class="dropdown-menu">
                            <li><a href="<?php echo site_url('setting');?>"><i class="icon-user"></i> Setting</a></li>
                            <li><a href="<?php echo site_url('login/logout');?>"><i class="icon-key"></i> Log Out</a></li>                                
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div> -->

    <!-- BEGIN HEADER -->
    <div class="header navbar navbar-inverse navbar-fixed-top">
        <!-- BEGIN TOP NAVIGATION BAR -->
        <div class="navbar-inner">
            <div class="container-fluid">
                <!-- BEGIN LOGO -->
                <a class="brand" href="index.html">
                <!-- <img src="public/assets/img/bg/logoheader.png" alt="logo" /> -->
                <!-- <img src="public/assets/img/bg/Untitled-2.png" alt="logo" /> -->
                <!-- <img src="public/assets/img/bg/logodashboard.png" alt="logo" /> -->
                <!-- <img src="<?php echo base_url(); ?>public/assets/img/bg/logodashboard.jpg" alt="logo" />  -->
                <h4 class="text-center"><b><font color="red"> MK DENTAL CLINIC </font></b></h4>
                </a>
                <!-- END LOGO -->
                <!-- BEGIN HORIZANTAL MENU -->
                <div class="navbar hor-menu hidden-phone hidden-tablet">
                    <div class="navbar-inner">
                        <ul class="nav">
                            <li class="visible-phone visible-tablet">
                                <!-- BEGIN RESPONSIVE QUICK SEARCH FORM -->
                                <form class="sidebar-search">
                                    <div class="input-box">
                                        <a href="javascript:;" class="remove"></a>
                                        <input type="text" placeholder="Search..." />            
                                        <input type="button" class="submit" value=" " />
                                    </div>
                                </form>
                                <!-- END RESPONSIVE QUICK SEARCH FORM -->
                            </li>
<!--                             <li class="active">
                                <a href="index.html">
                                Dashboard
                                <span class="selected"></span>
                                </a>
                            </li>
                            <li>
                                <a data-toggle="dropdown" class="dropdown-toggle" href="javascript:;">
                                Sections
                                <span class="arrow"></span>     
                                </a>
                                <ul class="dropdown-menu">
                                    <li><a href="#">Section 1</a></li>
                                    <li><a href="#">Section 2</a></li>
                                    <li><a href="#">Section 3</a></li>
                                    <li><a href="#">Section 4</a></li>
                                    <li><a href="#">Section 5</a></li>
                                </ul>
                                <b class="caret-out"></b>                        
                            </li>
                            <li>
                                <a href="">Tables</a>
                            </li>
                            <li>
                                <a data-toggle="dropdown" class="dropdown-toggle" href="">Extra
                                <span class="arrow"></span>
                                </a>
                                <ul class="dropdown-menu">
                                    <li><a href="index.html">About Us</a></li>
                                    <li><a href="index.html">Services</a></li>
                                    <li><a href="index.html">Pricing</a></li>
                                    <li><a href="index.html">FAQs</a></li>
                                    <li><a href="index.html">Gallery</a></li>
                                    <li><a href="index.html">Registration</a></li>
                                </ul>
                                <b class="caret-out"></b>                        
                            </li>
                            <li>
                                <span class="hor-menu-search-form-toggler">&nbsp;</span>
                                <div class="search-form hidden-phone hidden-tablet">
                                    <form class="form-search">
                                        <div class="input-append">
                                            <input type="text" placeholder="Search..." class="m-wrap">
                                            <button type="button" class="btn"></button>
                                        </div>
                                    </form>
                                </div>
                            </li> -->
                        </ul>
                    </div>
                </div>

                <a href="javascript:;" class="btn-navbar collapsed" data-toggle="collapse" data-target=".nav-collapse">
                <img src="<?php echo base_url(); ?>public/assets/img/menu-toggler.png" alt="" />
                </a>          
                <ul class="nav pull-right">
<!--                    <li class="dropdown" id="header_notification_bar">
                        <a href="<?php echo site_url('dashboard');?>" class="dropdown-toggle">
                        <i class="icon-home"></i>
                        </a>
                    </li>

                     <li class="dropdown" id="header_inbox_bar">
                        <a href="orderlist_c" class="dropdown-toggle">
                        <i class="icon-shopping-cart"></i>
                        </a>
                    </li>
                    
                    <li class="dropdown" id="header_inbox_bar">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <i class="icon-envelope"></i>
                        </a>
                        <ul class="dropdown-menu extended inbox">
                            <li>
                                <p>You have 12 new messages</p>
                            </li>
                            <li>
                                <a href="inbox.html?a=view">
                                <span class="photo"><img src="<?php echo base_url(); ?>public/assets/img/avatar2.jpg" alt="" /></span>
                                <span class="subject">
                                <span class="from">Lisa Wong</span>
                                <span class="time">Just Now</span>
                                </span>
                                <span class="message">
                                Vivamus sed auctor nibh congue nibh. auctor nibh
                                auctor nibh...
                                </span>  
                                </a>
                            </li>
                            <li>
                                <a href="inbox.html?a=view">
                                <span class="photo"><img src="<?php echo base_url(); ?>public/assets/img/avatar3.jpg" alt="" /></span>
                                <span class="subject">
                                <span class="from">Richard Doe</span>
                                <span class="time">16 mins</span>
                                </span>
                                <span class="message">
                                Vivamus sed congue nibh auctor nibh congue nibh. auctor nibh
                                auctor nibh...
                                </span>  
                                </a>
                            </li>
                            <li>
                                <a href="inbox.html?a=view">
                                <span class="photo"><img src="<?php echo base_url(); ?>public/assets/img/avatar1.jpg" alt="" /></span>
                                <span class="subject">
                                <span class="from">Bob Nilson</span>
                                <span class="time">2 hrs</span>
                                </span>
                                <span class="message">
                                Vivamus sed nibh auctor nibh congue nibh. auctor nibh
                                auctor nibh...
                                </span>  
                                </a>
                            </li>
                            <li class="external">
                                <a href="inbox.html">See all messages <i class="m-icon-swapright"></i></a>
                            </li>
                        </ul>
                    </li>                    

                    <li class="dropdown" id="header_inbox_bar">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <i class="icon-user"></i>
                        </a>
                        <ul class="dropdown-menu extended notification">
                            <li>
                                <a href="akun_c"><i class="icon-user"></i> My Account</a>
                            </li>
                            <li>
                                <a href="gantipass_c"><i class="icon-refresh"></i> Change Password</a>
                            </li>
                            <li>
                                <a href="<?php echo site_url('login/logout');?>"><i class="icon-key"></i> Logout</a>
                            </li>
                        </ul>
                    </li> -->

                    <!-- BEGIN USER LOGIN DROPDOWN -->
                    <li class="dropdown user">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <img alt="" src="<?php echo base_url(); ?>public/assets/img/user_small.jpg" />
                        <span class="username"><?php echo  getSession('namastatus')  ?> <?php echo  getSession('user')  ?></span>
                        <i class="icon-angle-down"></i>
                        </a>
                        <ul class="dropdown-menu">
<!--                             <li><a href="extra_profile.html"><i class="icon-user"></i> My Profile</a></li>
                            <li><a href="page_calendar.html"><i class="icon-calendar"></i> My Calendar</a></li>
                            <li><a href="inbox.html"><i class="icon-envelope"></i> My Inbox(3)</a></li>
                            <li><a href="#"><i class="icon-tasks"></i> My Tasks</a></li> -->
                            <!-- <li><a href="akun_c"><i class="icon-user"></i> My Account</a></li> -->
                            <li><a href="gantipass_c"><i class="icon-refresh"></i> Change Password</a></li>
                            <li class="divider"></li>
                            <!-- <li><a href="extra_lock.html"><i class="icon-lock"></i> Lock Screen</a></li> -->
                            <li><a href="<?php echo site_url('login/logout');?>"><i class="icon-key"></i> Log Out</a></li>
                        </ul>
                    </li>
                    <!-- END USER LOGIN DROPDOWN -->
                </ul>
                <!-- END TOP NAVIGATION MENU --> 
            </div>
        </div>
        <!-- END TOP NAVIGATION BAR -->
    </div>
    <!-- END HEADER -->