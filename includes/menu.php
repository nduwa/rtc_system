<?php
if(!isset($_SESSION["user_id"])){ header('location: index.php');  }
################## display the user privilegies on system  ###########
$obj  = new Model();
$get_session = $_SESSION['user_id'];
$rows  = $obj->user_privilege($get_session);

###############################################
if(!isset($_SESSION['user_id'])){
  header("location:login");
}
if ((time() - $_SESSION['last_time']) >3600 ) {
	header("location:logout.php");
}
if(time() - $_SESSION['last_time'] < 3600){
  $_SESSION['last_time'] = time();
}
?>
<body class="nav-md">
  <div class="container body">
    <div class="main_container">
      <div class="col-md-3 left_col">
        <div class="left_col scroll-view">
          <div class="navbar nav_title" style="border: 0;" >
            <a href="home" class="site_title"style="background-color:#3C8DBC"><i class="fa fa-paw"></i> <span style="font-size:25px;"> ~ RTC ~ </span></a><br>
          </div>

          <div class="clearfix"></div>
          <br />
          <!-- sidebar menu -->
          <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
            <div class="menu_section">
              
              <ul class="nav side-menu">
                  <li><a href="home"><i class="fa fa-home"></i> DASHBOARD <span class="fa fa-chevron-down"></span></a>
                  </li>
                  <?php  if($rows['inspection'] == 1){ ?>
                    <li><a><i class="fa fa-cog"></i>INSPECTIONS <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <?php  if($rows['farmer_inspection'] == 1){ ?>
                      <li><a href="rtc_stations">Update Farmer Trees</a></li>
                      <?php }   if($rows['registers'] == 1){ ?>
                      <li><a href="registered_farmers">Registered Farmers</a></li>
                      <li><a href="collected_gps">Farm GPS</a></li>
                      <?php } ?>
                    </ul>
                  </li>
                  <?php } if($rows['training'] == 1){ ?>
                    <li><a><i class="fa fa-cog"></i>TRAINING <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <?php  if($rows['weekly_report'] == 1){ ?>
                      <li><a href="rtc_weekly_report">Weekly Report</a></li>
                      <?php } ?>
                    </ul>
                  </li>
                  <?php } if($rows['manage_user']== 1){ ?>
                  <li><a><i class="fa fa-users"></i> MANAGE USERS <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <?php  if($rows['list_user'] == 1){ ?>
                      <li><a href="rtc_users">List of users</a></li>
                      <?php } ?>
                    </ul>
                  </li>
                  <?php } ?> 
              </ul>
            </div>


          </div>
          <!-- /sidebar menu -->
          <!-- /menu footer buttons -->
          <div class="sidebar-footer hidden-small">
            <a data-toggle="tooltip" data-placement="top" title="Settings">
              <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
            </a>
            <a data-toggle="tooltip" data-placement="top" title="FullScreen">
              <span class="glyphicon glyphicon-fullscreen" aria-hidden="true"></span>
            </a>
            <a data-toggle="tooltip" data-placement="top" title="Lock">
              <span class="glyphicon glyphicon-eye-close" aria-hidden="true"></span>
            </a>
            <a data-toggle="tooltip" data-placement="top" title="Logout" href="logout">
              <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
            </a>
          </div>
          <!-- /menu footer buttons -->
        </div>
      </div>

      <!-- top navigation -->
      
      <div class="top_nav">
            <div class="nav_menu">
                <div class="nav toggle">
                  <a id="menu_toggle"><i class="fa fa-bars"></i></a>
                </div>
                <nav class="nav navbar-nav">
                <ul class=" navbar-right" style="">
                  <li class="nav-item dropdown open" style="padding-left: 15px;font-size:18px;">
                    <a href="javascript:;" class="user-profile dropdown-toggle" aria-haspopup="true" id="navbarDropdown" data-toggle="dropdown" aria-expanded="false">
                      <img src="../images/Logo.jpg" alt=""><?php echo $_SESSION['Name_Full']; ?>
                    </a>
                    <div class="dropdown-menu dropdown-usermenu pull-right" aria-labelledby="navbarDropdown" style="margin-top:20px;font-size:16px;">
                      <a class="dropdown-item"  href="profile"> Profile</a>
                        
                      <a class="dropdown-item"  href="logout"><i class="fa fa-sign-out pull-right"></i> Log Out</a>
                    </div>
                  </li>
                </ul>
              </nav>
            </div>
          </div>
      <!-- /top navigation -->
