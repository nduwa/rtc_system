<?php 

class Model extends Dbh {
    #####################################################################################
                # login form function 
    #####################################################################################

    public function login_form($post){
        $username = $_POST['username'];
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
        $password = $_POST['password'];
        $sql = "SELECT * FROM `rtc_users_staff` WHERE Name_User = '$username'";
        $result = $this->conn->query($sql);
        if($result->num_rows > 0){
            while($row = $result->fetch_assoc()){
                if(password_verify($_POST["password"], $row["password"])){
                    $_SESSION['user_id']        = $row['id'];
                    $_SESSION['status']         = $row['status'];
                    $_SESSION['__kp_User']      = $row['__kp_User'];
                    $user                       = $row['__kp_User'];
                    $_SESSION['_kf_Location']   = $row['_kf_Location'];
                    $_SESSION['Email']          = $row['Email'];
                    $_SESSION['Name_Full']      = $row['Name_Full'];
                    $_SESSION['Name_User']      = $row['Name_User'];
                    $_SESSION['user_Role']      = $row['Role'];
                    $_SESSION['last_time']      = time();
                    $sql_sta =$this->conn->query("SELECT * FROM `staff` WHERE _kf_User = '$user'");
                    if($sql_sta){
                        $rows = $sql_sta->fetch_object();
                        $_SESSION['__kp_Staff'] = $rows->__kp_Staff;
                        $_SESSION['_kf_Station'] = $rows->_kf_Station;
                        $_SESSION['staff_Role'] = $rows->Role;
                        $station = $rows->_kf_Station;
                        $_SESSION['userID'] = $rows->userID;
                        $sql_stat =$this->conn->query("SELECT * FROM `rtc_station` WHERE __kp_Station = '$station'");
                        if($sql_stat){
                            $rowst = $sql_stat->fetch_object();
                            $_SESSION['_kf_Supplier'] = $rowst->_kf_Supplier;
                            $_SESSION['Name'] = $rowst->Name;
                            
                        }
                    }
                    if ($_SESSION['status'] == 1){
                        header('location:../views/home');
                    } 
                    else{
                        $_SESSION['message'] = '
                        <p style="color: #900;">
                            <i class="fas fa-lock"></i> 
                            <strong>Please contact Administrator for your account</strong>
                        </p>';
                        echo'<script>
                        setTimeout(function(){
                            window.location.href = "../index";
                        }, 0);
                        </script>';
                    }
                }else{
                    $_SESSION['message'] = '
                        <p style="color: #900;">
                            <i class="fas fa-lock"></i> <strong>Wrong Password</strong>
                        </p>';
                        echo'<script>
			         setTimeout(function(){
			            window.location.href = "../index";
			         }, 0);
			      </script>';
                }
            }
        }else{
            $_SESSION['message'] = '
                <p style="color: #900;">
                    <i class="fas fa-lock"></i> <strong>Wrong Username</strong>
                </p>';
            echo'<script>
                setTimeout(function(){
                    window.location.href = "../index";
                }, 0);
                </script>';
        }
    }
    #####################################################################################
                # function of registering the farmer trees
    #####################################################################################
    public function register_trees_form($post){
        $full_name              =  $_POST['full_name'];
        $kp_Staff               =  $_POST['kp_Staff'];
        $kp_User                =  $_POST['kp_User'];
        $kf_Station             =  $_POST['kf_Station'];
        $CW_Name                =  $_POST['CW_Name'];
        $kf_Supplier            =  $_POST['kf_Supplier'];
        $farmer_ID              =  $_POST['farmer_ID'];
        $farmer_name            =  $_POST['farmer_name'];
        $dot                    =  "'";
        $national               =  $_POST['national_ID'];
        $national_ID            =  mysqli_real_escape_string($dot.$national);
        $group_ID               =  $_POST['group_ID'];
        $received_seedling      =  $_POST['received_seedling'];
        $survived_seedling      =  $_POST['survived_seedling'];
        $planted_year           =  $_POST['planted_year'];
        $old_trees              =  $_POST['old_trees'];
        $old_trees_planted_year =  $_POST['old_trees_planted_year'];
        $coffee_plot            =  $_POST['coffee_plot'];
        $nitrogen               =  $_POST['nitrogen'];
        $natural_shade          =  $_POST['natural_shade'];
        $shade_trees            =  $_POST['shade_trees'];
        if($kp_User == ''){
            $_SESSION['mess'] = '<div class="alert alert-success alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    <strong style="color:red;">Please Logout and Login again before sending....</strong>
                </div>';
                $url = "../views/update_trees.php?msg=&error";
        }else{
            $result = $this->conn->query("INSERT INTO `rtc_household_trees`(ID,full_name,_kf_Staff,
            _kf_User,_kf_Station,_kf_Supplier,CW_Name,Group_ID,farmer_ID,farmer_name,national_ID,
            received_seedling,survived_seedling,planted_year,old_trees,old_trees_planted_year,
            coffee_plot,nitrogen,natural_shade,shade_trees,created_at) VALUES (null,'$full_name','$kp_Staff',
            '$kp_User','$kf_Station','$kf_Supplier','$CW_Name','$group_ID','$farmer_ID','$farmer_name',
            '$national_ID','$received_seedling','$survived_seedling','$planted_year','$old_trees',
            '$old_trees_planted_year','$coffee_plot','$nitrogen','$natural_shade','$shade_trees',now())");
            if($result){
                $_SESSION['mess'] = '<div class="alert alert-success alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    <strong>The data have been inserted successfully!!!!</strong>
                </div>';
                $url = "../views/update_trees.php?msg=&done";
            }else{
                $_SESSION['mess'] = '<div class="alert alert-success alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    <strong>The data not yet inserted!!!!</strong>
                </div>';
                $url = "../views/update_trees.php?msg=&error";
            }
        }
        header('location: '.$url);
    }

    #####################################################################################
                # function of sending weekly report
    #####################################################################################
    public function Weekly_Report($post){
        echo "well";
        $full_name          =  $_POST['full_name'];
        $kp_Staff           =  $_POST['kp_Staff'];
        $kp_User            =  $_POST['kp_User'];
        $kf_Station         =  $_POST['kf_Station'];
        $CW_Name            =  $_POST['CW_Name'];
        $kf_Supplier        =  $_POST['kf_Supplier'];
        $user_code          =  $_POST['user_code'];
        $trained_number     =  $_POST['trained_number'];
        $men_attended       =  $_POST['men_attended'];
        $women_attended     =  $_POST['women_attended'];
        $planned_groups     =  $_POST['planned_groups'];
        $farm_inspected     =  $_POST['farm_inspected'];
        $planned_inspected  =  $_POST['planned_inspected'];
        $comments           =  $_POST['comments'];
        if($kp_User == ''){
            $_SESSION['mess'] = '<div class="alert alert-success alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    <strong style="color:red;">Please Logout and Login again before sending....</strong>
                </div>';
                $url = "../views/weekly_report.php?msg=&error";
        }else{
            $result = $this->conn->query("INSERT INTO `rtc_field_weekly_report`(ID,_kf_Staff,_kf_User,
            _kf_Station,_kf_Supplier,CW_Name,full_name,user_code,trained_number,men_attended,women_attended,
            planned_groups,farm_inspected,planned_inspected,comments,createdAt) VALUES(null,'$kp_Staff',
            '$kp_User','$kf_Station','$kf_Supplier','$CW_Name','$full_name','$user_code','$trained_number',
            '$men_attended','$women_attended','$planned_groups','$farm_inspected','$planned_inspected',
            '$comments',now())");
            if($result){
                $_SESSION['mess'] = '<div class="alert alert-success alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    <strong>The data have been inserted successfully!!!!</strong>
                </div>';
                $url = "../views/weekly_report.php?msg=&done";
            }else{
                $_SESSION['mess'] = '<div class="alert alert-success alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    <strong>The data not yet inserted!!!!</strong>
                </div>';
                $url = "../views/weekly_report.php?msg=&error";
            }
        }
        header('location: '.$url);
    }
    #####################################################################################
                # function of save the farmer in registration
    #####################################################################################
    public function Farmer_Registration($post){
        //echo "well";
        $kf_Supplier        =  $_POST['kf_Supplier'];
        $kp_Staff           =  $_POST['kp_Staff'];
        $kp_User            =  $_POST['kp_User'];
        $user_code          =  $_POST['user_code'];
        $kf_Station         =  $_POST['kf_Station'];
        $CW_Name            =  $_POST['CW_Name'];
        $farmer_name        =  $_POST['farmer_name'];
        $gender             =  $_POST['gender'];
        $Year_Birth         =  $_POST['Year_Birth'];
        $dot                =  "'";
        $ph                 =  $dot.$_POST['phone'];
        $phone              =  mysqli_real_escape_string($this->conn, $ph);
        $id_                =  $dot.$_POST['id_number'];
        $id_number          =  mysqli_real_escape_string($this->conn, $id_);
        $marital_status     =  $_POST['marital_status'];
        $Group_ID           =  $_POST['Group_ID'];
        $village            =  $_POST['village'];
        $cell               =  $_POST['cell'];
        $sector             =  $_POST['sector'];
        $trees              =  $_POST['trees'];
        $productive_trees   =  $_POST['productive_trees'];
        $plot_number        =  $_POST['plot_number'];
        $skills             =  $_POST['skills'];
        $math_skills        =  $_POST['math_skills'];
        $education_level    =  $_POST['education_level'];
        $full_name          =  $_POST['full_name'];
        $plot_gps           =  $_POST['plot_gps'];
                      
        if($kp_User == ''){
            $_SESSION['mess'] = '<div class="alert alert-success alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    <strong style="color:red;">Please Logout and Login again before sending....</strong>
                </div>';
                $url = "../views/farmer_registration.php?msg=&error";
        }else{
            $result = $this->conn->query("INSERT INTO `rtc_field_farmers`(id,_kf_Supplier,_kf_Staff,
            _kf_User,user_code,_kf_Station,CW_Name,farmer_name,Gender,Year_Birth,phone,National_ID,
            Marital_Status,Group_ID,village,cell,sector,Trees,Trees_Producing,number_of_plots,Skills,
            Math_Skills,education_level,created_at,full_name,farm_GPS) VALUES(null,'$kf_Supplier','$kp_Staff',
            '$kp_User','$user_code','$kf_Station','$CW_Name','$farmer_name','$gender','$Year_Birth','$phone',
            '$id_number','$marital_status','$Group_ID','$village','$cell','$sector','$trees','$productive_trees'
            ,'$plot_number','$skills','$math_skills','$education_level',now(),'$full_name','$plot_gps')");
            if($result){
                $_SESSION['mess'] = '<div class="alert alert-success alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    <strong>The farmer data have been inserted successfully!!!!</strong>
                </div>';
                $url = "../views/farmer_registration.php?msg=&done";
            }else{
                $_SESSION['mess'] = '<div class="alert alert-success alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    <strong>The farmer data not yet inserted!!!!</strong>
                </div>';
                $url = "../views/farmer_registration.php?msg=&error";
            }
        }
        header('location: '.$url);
    }
    #####################################################################################
                # function of save the gps farm in registration
    #####################################################################################
    public function GPS_Farm_collection($post){
        //echo "well";
        $kf_Supplier        =  $_POST['kf_Supplier'];
        $kp_Staff           =  $_POST['kp_Staff'];
        $kp_User            =  $_POST['kp_User'];
        $user_code          =  $_POST['user_code'];
        $kf_Station         =  $_POST['kf_Station'];
        $CW_Name            =  $_POST['CW_Name'];
        $farmer_name        =  $_POST['farmer_name'];
        $FarmerID           =  $_POST['FarmerID'];
        $National_ID        =  mysqli_real_escape_string($this->conn, $_POST['National_ID']);
        $full_name          =  $_POST['full_name'];
        $plot_gps           =  mysqli_real_escape_string($this->conn, $_POST['plot_gps']);
                      
        if($kp_User == ''){
            $_SESSION['mess'] = '<div class="alert alert-success alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    <strong style="color:red;">Please Logout and Login again before sending....</strong>
                </div>';
                $url = "../views/gps_collection.php?msg=&error";
        }else{
            $result = $this->conn->query("INSERT INTO `rtc_farm_coordinations`(id,_kf_Supplier,_kf_Staff,
            _kf_User,user_code,_kf_Station,CW_Name,farmer_name,national_ID,farmer_ID,full_name,farm_GPS,created_At) VALUES(null,'$kf_Supplier','$kp_Staff',
            '$kp_User','$user_code','$kf_Station','$CW_Name','$farmer_name','$National_ID','$FarmerID','$full_name','$plot_gps',now())");
            if($result){
                $_SESSION['mess'] = '<div class="alert alert-success alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    <strong>The GPS data have been inserted successfully!!!!</strong>
                </div>';
                $url = "../views/gps_collection.php?msg=&done";
            }else{
                $_SESSION['mess'] = '<div class="alert alert-sanger alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    <strong>The GPS data not yet inserted!!!!</strong>
                </div>';
                $url = "../views/gps_collection.php?msg=&error".$this->conn->error;
            }
        }
        header('location: '.$url);
    }
    #####################################################################################
                # function of checking user privilegies 
    #####################################################################################

    public function user_privilege($get_session){
        $sql = "SELECT * FROM `rtc_users_modules_access` 
                WHERE rtc_users_modules_access.user_ID ='$get_session'";
        $result = $this->conn->query($sql);
        if($result->num_rows > 0){
            $row = $result->fetch_assoc();
            return $row;
        }
    }
    #####################################################################################
                # function user profile update 
    #####################################################################################  
    
    public function updateProfile($get_session){
        if ($_POST['password1']==$_POST['password2']) {
            $fname    =  $_POST['FIRSTNAME'];
            $Lname    =  $_POST['LASTNAME'];
            $user_id   =  $_POST['USER_ID'];
            $email   =  $_POST['EMAIL'];
            $tel      =  $_POST['CONTACTNUMBER'];
            $username =  $_POST['USERNAME'];
            $pwd1     =  $_POST['password1'];
            $pwd2     =  $_POST['password2'];
            $pwd     =  password_hash($pwd1, PASSWORD_DEFAULT);
            if($_POST['password1'] == $_POST['password2']){
                $new_info = "UPDATE `rtc_users`
                        SET first_name='$fname', last_name='$Lname' , phone='$tel', email='$username'
                        , username='$username', password='$pwd', user_code='$pwd1' WHERE user_id ='$get_session'";
                $result_info = $this->conn->query($new_info);
                if($result_info){
                    session_destroy();
                    header('location:../login.php');
                }
            }else{
                header('location:profile.php?error=password not match');
            }
        }else{
            header('location:profile.php?error=password not match');
        }
    }
    #####################################################################################
                # function user update password
    #####################################################################################

    public function UserUpdatePassword($get_session){
        if ($_POST['pass1']==$_POST['pass2']) {
            $pwd1  =  password_hash($_POST['pass1'], PASSWORD_DEFAULT);
            $pwd = $_POST['pass1'];
            $update_user_password = "UPDATE rtc_users SET password = '$pwd1', pass_updated ='1',
                                     user_code = '$pwd' WHERE user_id ='$get_session'";
		    $pass_update = $this->conn->query($update_user_password);
            if ($pass_update) {
		    	$_SESSION['mess'] = '<div class="badge bg-green fade show" style="background-color:#1ABB9C;">
								    <button type="button" class="close" data-dismiss="alert">&times;</button>
								    <strong>Passwor updated successfully!</strong>
								  </div>'.'<script>
			         setTimeout(function(){
			            window.location.href = "logout";
			         }, 7000);
			      </script>'.'<i id="demo"></i>';
                header('location:../views/passUpdate');
		    }
		    else{ 
                $_SESSION['mess'] = '<div class="badge bg-danger fade show" style="background-color:#1ABB9C;">
								    <button type="button" class="close" data-dismiss="alert">&times;</button>
								    <strong>Password updated not yet successfully!</strong>
								  </div>'.'<script>
			         setTimeout(function(){
			            window.location.href = "../views/passUpdate";
			         }, 7000);
			    </script>'.'<i id="demo"></i>';
            }  
        }
    }
    
    #####################################################################################
                # function of giving access to user in system 
    #####################################################################################

    public function SystemUserAccess($status,$id){
        $pass         = '123';
        $passcode     = password_hash($pass, PASSWORD_DEFAULT);
        $sql_user = $this->conn->query("SELECT * FROM `rtc_users_staff` WHERE `id` = '$id'");
        if($sql_user->num_rows > 0){
            $sql_re = $this->conn->query("UPDATE `rtc_users_staff` SET `status` = '$status' WHERE `id` = '$id'");
            if($sql_re){
                $sql_result = $this->conn->query("UPDATE `rtc_users` SET `status` = '$status' WHERE `id` = '$id'");
                if($sql_result){
                    $url = "../views/rtc_users.php?msg=&done";
                }else{
                    $url = "../views/rtc_users.php?msg=&Error";
                }
            }
        }else{
            $sql_staff = $this->conn->query("SELECT * FROM `rtc_users` WHERE `id` = '$id'");
            if($sql_staff->num_rows > 0){
                $access = $sql_staff->fetch_object(); 
                $sql_insert = $this->conn->query("INSERT INTO `rtc_users_staff`(id,created_at,status,__kp_User,
                _kf_Location,Email,Name_Full,Name_User,Role,z_recCreateAccountName,z_recCreateTimestamp,
                z_recModifyAccountName,z_recModifyTimestamp,Phone,Phone_Airtime,password,devicename,last_update_at)
                VALUES('$access->id','$access->created_at','$status','$access->__kp_User','$access->_kf_Location',
                '$access->Email','$access->Name_Full','$access->Name_User','$access->Role',
                '$access->z_recCreateAccountName','$access->z_recCreateTimestamp','$access->z_recModifyAccountName',
                '$access->z_recModifyTimestamp','$access->Phone','$access->Phone_Airtime','$passcode',
                '$access->devicename','$access->last_update_at')");
                if($sql_insert){
                    $sql_result = $this->conn->query("UPDATE `rtc_users` SET `status` = '$status' WHERE `id` = '$id'");
                    if($sql_result){
                        $sql_access = $this->conn->query("INSERT INTO `rtc_users_modules_access`(id,user_ID,created_at)
                        VALUES(null,'$access->id','$access->created_at')");
                        if($sql_access){
                            $url = "../views/rtc_users.php?msg=&done";
                        }else{
                            $url = "../views/rtc_users.php?msg=&Error";
                        }
                    }else{
                        $url = "../views/rtc_users.php?msg=&Error";
                    }
                }
            }
        }
        header('location: '.$url);
    }
    #####################################################################################
                # function of getting user out 
    #####################################################################################

    public function getUserOut($getSession){
        $loggout_user = "UPDATE `rtc_users_staff` SET  last_update_at= now() WHERE id='$getSession'";
        $set_off = $this->conn->query($loggout_user);
        if($set_off){
            session_destroy();
            header('location:../index');
        }
    }
    
    #####################################################################################
                # function of activating the assigned privilege to a user
    #####################################################################################

    public function UserAccessRight($id,$status,$col){
        $sql = "UPDATE rtc_users_modules_access SET $col = '$status' 
                WHERE rtc_users_modules_access.user_ID = '$id'";
        $result = $this->conn->query($sql);
        if ($result) {
            $url = "../views/user_access?id=".$id."&done";
        }
        else{
            $url = "../views/user_access?id=".$id."&error=active not performed".$this->conn->error;
        }
            header('location: '.$url);
    }

    #####################################################################################
                # function of registering a user in system
    #####################################################################################

    public function User_Registion_Form($post){
        $_SESSION['reg_msg'] = "";
        $first_name   = $_POST['first_name'];
        $last_name    = $_POST['last_name'];
        $full_name   = $first_name.$last_name."1234567890";
        $length      = 5;
        ##function for generating user password
        function random_alphanumeric($full_name,$length) {
            $my_string = '';
            for ($i = 0; $i < $length; $i++) {
                $pos = mt_rand(0, strlen($full_name) -1);
                $my_string .= substr($full_name, $pos, 1);
            }
        return $my_string;
        }
        $user_email   = $_POST['user_email'];
        $user_phone   = $_POST['user_phone'];
        $Department_ID_t   = $_POST['Department_ID_t'];
        $username     = $_POST['username'];
        //$pass         = random_alphanumeric($full_name ,5);
        $pass         = 'rtc123';
        $passcode     = password_hash($pass, PASSWORD_DEFAULT);
        $user_ids     = $_SESSION['user_id'];
        $user_status  = '0';
        $pass_update  = '0';
        $reg_date     = date('Y-m-d');

        $sql_check_username = "SELECT * FROM `rtc_users` WHERE username = '$username' ";
        $sql_check_user_email = "SELECT * FROM `rtc_users` WHERE email = '$user_email' ";
        $sql_user_name = $this->conn->query($sql_check_username);
        $sql_user_email= $this->conn->query($sql_check_user_email);

        if ($sql_user_name->num_rows > 0) {
    
            $_SESSION['reg_msg'] = '<div class="alert alert-danger alert-dismissible">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <strong>Username taken</strong></div>';
            echo '<script>
                    setTimeout(function(){
                        window.location.href = "../views/rtc_users";
                    }, 0);
                </script>';
        }elseif ($sql_user_email->num_rows > 0) {
            $_SESSION['reg_msg'] = '<div class="alert alert-danger alert-dismissible">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <strong>Email taken</strong></div>';
            echo '<script>
                    setTimeout(function(){
                        window.location.href = "../views/rtc_users";
                    }, 0);</script>';
        }else{
            $sql = "INSERT INTO `rtc_users`(user_id,first_name,last_name,phone,username,password,
                                user_code,email,Department_ID_t,registered_by,reg_date,user_status,pass_updated,
                                is_type,last_activity,last_seen)
                    VALUES(null,'$first_name','$last_name','$user_phone','$username','$passcode',
                                '$pass','$user_email','$Department_ID_t','$user_ids','$reg_date','$user_status',
                                '$pass_update','offline',now(),now())";
            $result = $this->conn->query($sql);
            $last_id = $this->conn->insert_id;
            if($result){
                $sql_priv = "INSERT INTO `rtc_users_modules_access`(user_ID) 
                            VALUES('$last_id')";
                $results = $this->conn->query($sql_priv);
                if($results){
                    $ppp = '<div class="alert alert-success alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert">&times;</button>
                            <strong>well inserted in the system</strong>
                            <p><i style="color: #000;">Username is: </i><b>'.$username.'</b>';
                    $user_pass = '<i style="color: #000;">Password is:</i> <b>'.$pass.'</b>';
                    $ppp2 = '</div>';
                    $user_info = '<p> Password and username is sent to this email <strong>'.$user_email.'</strong></p>';
                    $_SESSION['reg_msg'] = $ppp." and ".$user_pass.$ppp2;
                    echo '<script>
                            setTimeout(function(){
                                window.location.href = "../views/rtc_users";
                            }, 0);</script>';
                }else{
                    echo  "not yet inserted data".$this->conn->error;
                    die();
                }
            }else{
                echo  "not yet inserted data";
                die();
                $_SESSION['reg_msg'] = '<div class="alert alert-warning alert-dismissible">
                                            <button type="button" class="close" data-dismiss="alert">&times;</button>
                                            <strong>User data not saved</strong>
                                        </div>';
                echo '<script>
                        setTimeout(function(){
                        window.location.href = "../views/rtc_users";
                        }, 0);
                    </script>';
            }
        }
    }
    #####################################################################################
                # function of registering the supplied coffee
    #####################################################################################

    public function supplied_coffee($post){

        $Delivery_ID_t                  = $_POST['Delivery_ID_t'];
        $Delivery_Supplier_ID_t         = $_POST['Delivery_Supplier_ID_t'];
        $Delivery_Certification_ID_t    = $_POST['Delivery_Certification_ID_t'];
        $Delivery_Grade_ID_t            = $_POST['Delivery_Grade_ID_t'];
        $Delivery_Product_Type_ID_t     = $_POST['Delivery_Product_Type_ID_t'];
        $Delivery_Product_Category_ID_t = $_POST['Delivery_Product_Category_ID_t'];
        $Delivery_Warehouse_ID_t        = $_POST['Delivery_Warehouse_ID_t'];
        $Delivery_Bag_Type              = $_POST['Delivery_Bag_Type'];
        $Delivery_Number_Bags           = $_POST['Delivery_Number_Bags'];
        $Delivery_Weight_Parchment      = $_POST['Delivery_Weight_Parchment'];
        $Delivery_MC                    = $_POST['Delivery_MC'];
        if ($Delivery_Bag_Type=='Poly'){
            $Delivery_Weight_Bags       = round($Delivery_Number_Bags/6);
        }else {
            $Delivery_Weight_Bags       = round($Delivery_Number_Bags/4);
        }
        
        $Delivery_NetWeight_Parchment   = $Delivery_Weight_Parchment - $Delivery_Weight_Bags;
        $created_by                     = $_SESSION['user_id'];
        $Delivery_Status                = '0';
        $Delivery_Receiving_Date        = date('Y-m-d');
       
        $sql = "INSERT INTO `rtc_delivery`(id,Delivery_ID_t,Delivery_Supplier_ID_t,Delivery_Certification_ID_t,
                    Delivery_Grade_ID_t,Delivery_Product_Type_ID_t,Delivery_Product_Category_ID_t,Delivery_Warehouse_ID_t,
                    Delivery_Bag_Type,Delivery_Number_Bags,Delivery_Weight_Bags,Delivery_Weight_Parchment,
                    Delivery_NetWeight_Parchment,Delivery_Status,Delivery_MC,Delivery_Receiving_Date,created_by)
                VALUES(null,'$Delivery_ID_t','$Delivery_Supplier_ID_t','$Delivery_Certification_ID_t','$Delivery_Grade_ID_t',
                    '$Delivery_Product_Type_ID_t','$Delivery_Product_Category_ID_t','$Delivery_Warehouse_ID_t',
                    '$Delivery_Bag_Type','$Delivery_Number_Bags','$Delivery_Weight_Bags','$Delivery_Weight_Parchment',
                    '$Delivery_NetWeight_Parchment','$Delivery_Status','$Delivery_MC','$Delivery_Receiving_Date','$created_by')";
        $result = $this->conn->query($sql);
        $last_id = $this->conn->insert_id;
        if($result){
                echo '<script>
                        setTimeout(function(){
                            window.location.href = "../views/rtc_prod_parchment";
                        }, 0);</script>';
        }else{
            echo  "not yet inserted data".$this->conn->error;
        }
    }
    
    #####################################################################################
                # function of register new module is just menu and submenu
    #####################################################################################

    public function module_Form($post){
        $module_name = $_POST['post'];
        $platform = $_POST['platform'];
        $sql_module = $this->conn->query("INSERT INTO `rtc_modules`(module_name,platform)
                    VALUES('$module_name','$platform')");
        if($sql_module){
            if($module_name == 'General Setting'){
                $module_name = 'General_Setting';
            }elseif($module_name == 'Human Resource'){
                $module_name = 'Human_resource';
            }else{
                $module_name;
            }
            $sql_ = "ALTER TABLE rtc_users_modules_access ADD $module_name enum('0','1') NOT NULL DEFAULT '0'";
            $result = $this->conn->query($sql_);
            if($result){
                echo '<script>
                        setTimeout(function(){
                            window.location.href = "../views/rtc_module";
                        }, 0);</script>';
            }
        }
    }

    #####################################################################################
                # function of setting a new warehouse 
    #####################################################################################

    public function warehouse_setting($post){
        $Warehouse_Name     = $_POST['Warehouse_Name'];
        $Warehouse_Address  = $_POST['Warehouse_Address'];
        $Warehouse_Status  = '0';
        $created_by = $_SESSION['user_id'];
        //check if there is a Warehouse code for a house
        $www = "SELECT Warehouse_ID_t FROM `rtc_warehouse` 
                ORDER BY rtc_warehouse.id DESC LIMIT 1";
        $tr = $this->conn->query($www);
        $tr_num =$tr->fetch_assoc();
        if ($tr){
            $row = $tr->num_rows;
            if ($row == 0) { 
                 $last = 'WH000';
                
            }else{
                $warehouse_code = $tr_num['Warehouse_ID_t']; // This is fetched from database
                $last = $warehouse_code;
            }
            $last++;
        }
        $Warehouse_ID_t =  $last;
        
        $sql_warehouse = "INSERT INTO `rtc_warehouse`(id,Warehouse_ID_t,Warehouse_Name,Warehouse_Address,Warehouse_Status,created_by)
                            VALUES(null,'$Warehouse_ID_t','$Warehouse_Name','$Warehouse_Address','$Warehouse_Status','$created_by')";
        $result_warehouse = $this->conn->query($sql_warehouse);
        if($result_warehouse){
            echo '<script>
                        setTimeout(function(){
                            window.location.href = "../views/rtc_gen_setting";
                        }, 0);</script>';
        }else{
            echo $this->conn->error;
            header('location:../views/rtc_gen_setting');
        }
    }
    #####################################################################################
                # function of setting a new certification 
    #####################################################################################

    public function rtc_certification_setting($post){
        $Certification_Name = $_POST['Certification_Name'];
        $created_by         = $_SESSION['user_id'];
        //check if there is a Warehouse code for a house
        $www = "SELECT Certification_ID_t FROM `rtc_certification` 
                ORDER BY rtc_certification.id DESC LIMIT 1";
        $tr = $this->conn->query($www);
        $tr_num =$tr->fetch_assoc();
        if ($tr){
            $row = $tr->num_rows;
            if ($row == 0) { 
                 $last = 'CT000';
                
            }else{
                $certification_code = $tr_num['Certification_ID_t']; // This is fetched from database
                $last = $certification_code;
            }
            $last++;
        }
        $Certification_ID_t =  $last;
        $sql_certification = "INSERT INTO `rtc_certification`(id,Certification_ID_t,Certification_Name,created_by)
                                VALUES(null,'$Certification_ID_t','$Certification_Name','$created_by')";
        $result_certification = $this->conn->query($sql_certification);
        if($result_certification){
            echo '<script>
                        setTimeout(function(){
                            window.location.href = "../views/rtc_gen_setting";
                        }, 0);</script>';
        }else{
            echo $this->conn->error;
            header('location:../views/rtc_gen_setting');
        }
    }
    #####################################################################################
                # function of setting a new product type 
    #####################################################################################

    public function rtc_product_type_setting($post){
        $Product_Type_Name = $_POST['Product_Type_Name'];
        $created_by         = $_SESSION['user_id'];
        //check if there is a Warehouse code for a house
        $www = "SELECT Product_Type_ID_t FROM `rtc_product_type` 
                ORDER BY rtc_product_type.id DESC LIMIT 1";
        $tr = $this->conn->query($www);
        $tr_num =$tr->fetch_assoc();
        if ($tr){
            $row = $tr->num_rows;
            if ($row == 0) { 
                 $last = 'PT000';
                
            }else{
                $product_type_code = $tr_num['Product_Type_ID_t']; // This is fetched from database
                $last = $product_type_code;
            }
            $last++;
        }
        $Product_Type_ID_t =  $last;
        $sql_product_type = "INSERT INTO `rtc_product_type`(id,Product_Type_ID_t,Product_Type_Name,created_by)
                                VALUES(null,'$Product_Type_ID_t','$Product_Type_Name','$created_by')";
        $result_product_type = $this->conn->query($sql_product_type);
        if($result_product_type){
            echo '<script>
                        setTimeout(function(){
                            window.location.href = "../views/rtc_gen_setting";
                        }, 0);</script>';
        }else{
            echo $this->conn->error;
            header('location:../views/rtc_gen_setting');
        }
    }
    #####################################################################################
                # function of setting a new product category 
    #####################################################################################

    public function rtc_product_category_setting($post){
        $Prodcut_Category_Name = $_POST['Prodcut_Category_Name'];
        $created_by         = $_SESSION['user_id'];
        //check if there is a Warehouse code for a house
        $www = "SELECT Product_Category_ID_t FROM `rtc_product_category` 
                ORDER BY rtc_product_category.id DESC LIMIT 1";
        $tr = $this->conn->query($www);
        $tr_num =$tr->fetch_assoc();
        if ($tr){
            $row = $tr->num_rows;
            if ($row == 0) { 
                 $last = 'PC000';
                
            }else{
                $product_category_code = $tr_num['Product_Category_ID_t']; // This is fetched from database
                $last = $product_category_code;
            }
            $last++;
        }
        $Product_Category_ID_t =  $last;
        $sql_product_category = "INSERT INTO `rtc_product_category`(id,Product_Category_ID_t,Prodcut_Category_Name,created_by)
                                VALUES(null,'$Product_Category_ID_t','$Prodcut_Category_Name','$created_by')";
        $result_product_category = $this->conn->query($sql_product_category);
        if($result_product_category){
            echo '<script>
                        setTimeout(function(){
                            window.location.href = "../views/rtc_gen_setting";
                        }, 0);</script>';
        }else{
            echo $this->conn->error;
            header('location:../views/rtc_gen_setting');
        }
    }
    #####################################################################################
                # function of setting a new coffee grade
    #####################################################################################

    public function rtc_coffee_grade_setting($post){
        $Grade_Label = $_POST['Grade_Label'];
        $created_by  = $_SESSION['user_id'];
        //check if there is a Warehouse code for a house
        $www = "SELECT Grade_ID_t FROM `rtc_grade` 
                ORDER BY rtc_grade.id DESC LIMIT 1";
        $tr = $this->conn->query($www);
        $tr_num =$tr->fetch_assoc();
        if ($tr){
            $row = $tr->num_rows;
            if ($row == 0) { 
                 $last = 'CG000';
            }else{
                $coffee_grade_code = $tr_num['Grade_ID_t']; // This is fetched from database
                $last = $coffee_grade_code;
            }
            $last++;
        }
        $Grade_ID_t =  $last;
        $sql_grade = "INSERT INTO `rtc_grade`(id,Grade_ID_t,Grade_Label,created_by)
                                VALUES(null,'$Grade_ID_t','$Grade_Label','$created_by')";
        $result_grade = $this->conn->query($sql_grade);
        if($result_grade){
            echo '<script>
                        setTimeout(function(){
                            window.location.href = "../views/rtc_gen_setting";
                        }, 0);</script>';
        }else{
            echo $this->conn->error;
            header('location:../views/rtc_gen_setting');
        }
    }
    #####################################################################################
                # function of setting a new rtc department
    #####################################################################################

    public function rtc_department_setting($post){
        $Department_Name = $_POST['Department_Name'];
        $created_by  = $_SESSION['user_id'];
        //check if there is a Warehouse code for a house
        $www = "SELECT Department_ID_t FROM `rtc_department` 
                ORDER BY rtc_department.id DESC LIMIT 1";
        $tr = $this->conn->query($www);
        $tr_num =$tr->fetch_assoc();
        if ($tr){
            $row = $tr->num_rows;
            if ($row == 0) { 
                 $last = 'RD000';
            }else{
                $department_code = $tr_num['Department_ID_t']; // This is fetched from database
                $last = $department_code;
            }
            $last++;
        }
        $Department_ID_t =  $last;
        $sql_department = "INSERT INTO `rtc_department`(id,Department_ID_t,Department_Name,created_by)
                                VALUES(null,'$Department_ID_t','$Department_Name','$created_by')";
        $result_department = $this->conn->query($sql_department);
        if($result_department){
            echo '<script>
                        setTimeout(function(){
                            window.location.href = "../views/rtc_gen_setting";
                        }, 0);</script>';
        }else{
            echo $this->conn->error;
            header('location:../views/rtc_gen_setting');
        }
    }

    #####################################################################################
                # function of setting a new hopper data
    #####################################################################################

    public function Setting_new_hopper($post){
        $PRB_Hopper_Name = $_POST['PRB_Hopper_Name'];
        $created_by  = $_SESSION['user_id'];
        $PRB_creation = date('Y-m-d');
        $year = date('Y');
        $month = date('m');
        $day = date('d');
        $hour = date('h');
        $minute = date('i');
        $second = date('s');

        //check if there is a Warehouse code for a house
        $www = "SELECT Defect_ID_t FROM `rtc_coffee_defects` 
                ORDER BY rtc_coffee_defects.id DESC LIMIT 1";
        $tr = $this->conn->query($www);
        $tr_num =$tr->fetch_assoc();
        if ($tr){
            $row = $tr->num_rows;
            if ($row == 0) { 
                 $last = 'CD000';
            }else{
                $defects_code = $tr_num['Defect_ID_t']; // This is fetched from database
                $last = $defects_code;
            }
            $last++;
        }
        $Defect_ID_t =  $last;
        
        //check if there is a Warehouse code for a house
        $PRB_ID_t = 'PRB'.$year.''.$month.''.$day.''.$hour.''.$minute;
        
        $sql_hopper = "INSERT INTO `rtc_production_hopper`(id,PRB_ID_t,PRB_Hopper_Name,PRB_creation,created_by)
                                VALUES(null,'$PRB_ID_t','$PRB_Hopper_Name','$PRB_creation','$created_by')";
        $result_hopper = $this->conn->query($sql_hopper);
        if($result_hopper){
            $sql_insert = "INSERT INTO `rtc_production_batch`(id,PRB_ID_t) 
            VALUES(null,'$PRB_ID_t')";
            $result_insert = $this->conn->query($sql_insert);
            if($result_insert){
                $sql_defects = "INSERT INTO `rtc_coffee_defects`(id,Defect_ID_t,Defect_PRB_ID_t)
                                VALUES(null,'$Defect_ID_t','$PRB_ID_t')";
                $result_defects = $this->conn->query($sql_defects);
                if($result_defects){
                    echo '<script>
                            setTimeout(function(){
                                window.location.href = "../views/rtc_prod_parchment";
                            }, 0);</script>';
                }else{
                    echo $this->conn->error;
                    header('location:../views/rtc_prod_parchment');
                }
            }else{
            echo $this->conn->error;
            header('location:../views/rtc_prod_parchment');
            }
        } else{
            echo $this->conn->error;
            header('location:../views/rtc_prod_parchment');
        }
    }
    #####################################################################################
                # function of setting a green coffee defects
    #####################################################################################

    public function green_defects_setting($post){
        $Defect_Name = $_POST['Defect_Name'];
        $created_by  = $_SESSION['user_id'];
        //check if there is a Warehouse code for a house
        $www = "SELECT Defect_ID_t FROM `rtc_coffee_defects` 
                ORDER BY rtc_coffee_defects.id DESC LIMIT 1";
        $tr = $this->conn->query($www);
        $tr_num =$tr->fetch_assoc();
        if ($tr){
            $row = $tr->num_rows;
            if ($row == 0) { 
                 $last = 'CD000';
            }else{
                $defects_code = $tr_num['Defect_ID_t']; // This is fetched from database
                $last = $defects_code;
            }
            $last++;
        }
        $Defect_ID_t =  $last;
        $sql_defects = "INSERT INTO `rtc_coffee_defects`(id,Defect_ID_t,Defect_Name,created_by)
                                VALUES(null,'$Defect_ID_t','$Defect_Name','$created_by')";
        $result_defects = $this->conn->query($sql_defects);
        if($result_defects){
            echo '<script>
                        setTimeout(function(){
                            window.location.href = "../views/rtc_gen_setting";
                        }, 0);</script>';
        }else{
            echo $this->conn->error;
            header('location:../views/rtc_gen_setting');
        }
    }
    #####################################################################################
                # function of inserting a green coffee defects
    #####################################################################################

    public function save_coffee_defects_data($post){
        $Defect_ID_t = $_POST['Defect_ID'];
        $Defect_values_data = $_POST['Defect_values_data'];
        $arrlength =  count($_POST['Defect_ID']);
        
        for($x = 0; $x < $arrlength; $x++){
            echo $Defect_ID_t[$x]." == ".$Defect_values_data[$x]."<br>";
        }

        die();
        $created_by  = $_SESSION['user_id'];
        //check if there is a Warehouse code for a house
        $www = "SELECT Defect_ID_t FROM `rtc_coffee_defects` 
                ORDER BY rtc_coffee_defects.id DESC LIMIT 1";
        $tr = $this->conn->query($www);
        $tr_num =$tr->fetch_assoc();
        if ($tr){
            $row = $tr->num_rows;
            if ($row == 0) { 
                 $last = 'CD000';
            }else{
                $defects_code = $tr_num['Defect_ID_t']; // This is fetched from database
                $last = $defects_code;
            }
            $last++;
        }
        $Defect_ID_t =  $last;
        $sql_defects = "INSERT INTO `rtc_coffee_defects`(id,Defect_ID_t,Defect_Name,created_by)
                                VALUES(null,'$Defect_ID_t','$Defect_Name','$created_by')";
        $result_defects = $this->conn->query($sql_defects);
        if($result_defects){
            echo '<script>
                        setTimeout(function(){
                            window.location.href = "../views/rtc_gen_setting";
                        }, 0);</script>';
        }else{
            echo $this->conn->error;
            header('location:../views/rtc_gen_setting');
        }
    }
    #####################################################################################
                # function of setting a new rtc bank account 
    #####################################################################################

    public function New_Bank_Account($post){
        $bank_name     = $_POST['bank_name'];
        $bank_account  = $_POST['bank_account'];
        $bank_Status  = '0';
        $created_by = $_SESSION['user_id'];
        //check if there is a bank code
        $www = "SELECT Bank_ID_t FROM `rtc_bank_account` 
                ORDER BY rtc_bank_account.id DESC LIMIT 1";
        $tr = $this->conn->query($www);
        $tr_num =$tr->fetch_assoc();
        if ($tr){
            $row = $tr->num_rows;
            if ($row == 0) { 
                 $last = 'BA000';
                
            }else{
                $bank_code = $tr_num['Bank_ID_t']; // This is fetched from database
                $last = $bank_code;
            }
            $last++;
        }
        $Bank_ID_t =  $last;
        
        $sql_bank = "INSERT INTO `rtc_bank_account`(id,Bank_ID_t,Bank_Name,Bank_account,Bank_Status,created_by)
                    VALUES(null,'$Bank_ID_t','$bank_name','$bank_account','$bank_Status','$created_by')";
        $result_bank = $this->conn->query($sql_bank);
        if($result_bank){
            echo '<script>
                    setTimeout(function(){
                        window.location.href = "../views/rtc_bank";
                    }, 0);</script>';
        }else{
            echo $this->conn->error;
            header('location:../views/rtc_bank');
        }
    }
    #####################################################################################
                # function of submitting or creating an export delivery contract 
    #####################################################################################

    public function Submit_Export_Deliveries($post){
        $EL_Order_ID            = $_POST['EL_Order_ID'];
        $PRB_ID_t               = $_POST['PRB_ID_t'];
        $EL_quality             = $_POST['EL_quality'];
        $EL_green_type          = $_POST['EL_green_type'];
        $EL_bags_number         = $_POST['EL_bags_number'];
        $EL_net_weight          = $_POST['EL_net_weight'];
        $EL_Destination         = $_POST['EL_Destination'];
        $EL_Additonal_comment   = $_POST['EL_Additonal_comment'];
        $EL_Status_EMS          = '0';
        $EL_Status             = '0';
        $created_by             = $_SESSION['user_id'];
        /// combination of PRB and export Lot
        $www = "SELECT Lot_list_ID_t FROM `rtc_export_lot_list` 
                ORDER BY rtc_export_lot_list.id DESC LIMIT 1";
        $tr = $this->conn->query($www);
        $tr_num =$tr->fetch_assoc();
        if ($tr){
            $row = $tr->num_rows;
            if ($row == 0) { 
                 $last = 'EL000';
                
            }else{
                $export_code = $tr_num['Lot_list_ID_t']; // This is fetched from database
                $last = $export_code;
            }
            $last++;
        }
        $Lot_list_ID_t =  $last;
        $sql_lot_list = "INSERT INTO `rtc_export_lot_list`(id,Lot_list_ID_t,EL_Order_ID,PRB_ID,created_by)
                        VALUES(null,'$Lot_list_ID_t','$EL_Order_ID','$PRB_ID_t','$created_by')";
        $result_lot_list = $this->conn->query($sql_lot_list);
        if($result_lot_list){
            $lot_list = "SELECT Lot_list_ID_t FROM `rtc_export_lot_list` 
                ORDER BY rtc_export_lot_list.id DESC LIMIT 1";
            $re_lot = $this->conn->query($lot_list);
            $row_lot = $re_lot->fetch_assoc();
            $EL_export_lot = $row_lot['Lot_list_ID_t'];
      
            $sql_export_delivery = "INSERT INTO `rtc_export_lot`(id,EL_Order_ID,EL_export_lot,EL_quality,EL_green_type,
                        EL_bags_number,EL_net_weight,EL_Destination,EL_Additonal_comment,EL_Status_EMS,EL_Status,Created_by)
                        VALUES(null,'$EL_Order_ID','$EL_export_lot','$EL_quality','$EL_green_type','$EL_bags_number',
                        '$EL_net_weight','$EL_Destination','$EL_Additonal_comment','$EL_Status_EMS','$EL_Status','$created_by')";
            $result_export_delivery = $this->conn->query($sql_export_delivery);
            // echo $this->conn->error;
            // die();
            if($result_export_delivery){
                echo '<script>
                        setTimeout(function(){
                            window.location.href = "../views/rtc_prod_green";
                        }, 0);</script>';
            }else{
                echo $this->conn->error;
                header('location:../views/rtc_prod_green');
            }
        }
    }
    #####################################################################################
                # function of impoting the IT Tools for recording in Human resource 
    #####################################################################################
    public function Import_IT_Tools($post){
        $conn = mysqli_connect('localhost', 'root', '','rtc_online_services');
        $allowedFileType = ['application/vnd.ms-excel','text/xls','text/xlsx','application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'];
        if(in_array($_FILES["file"]["type"],$allowedFileType)){
            $targetPath = '../uploads/'.$_FILES['file']['name'];
            move_uploaded_file($_FILES['file']['tmp_name'], $targetPath);
            $Reader = new SpreadsheetReader($targetPath);
            $sheetCount = count($Reader->sheets());
            for($i=0;$i<$sheetCount;$i++){
                $Reader->ChangeSheet($i);
                foreach ($Reader as $Row){
                    $Device_Name = "";
                    if(isset($Row[0])) {
                        $Device_Name = mysqli_real_escape_string($conn,$Row[0]);
                    }
                    $Processor = "";
                    if(isset($Row[1])) {
                        $Processor = mysqli_real_escape_string($conn,$Row[1]);
                    }
                    $Memory_RAM = "";
                    if(isset($Row[2])) {
                        $Memory_RAM = mysqli_real_escape_string($conn,$Row[2]);
                    }
                    $Edition = "";
                    if(isset($Row[3])) {
                        $Edition = mysqli_real_escape_string($conn,$Row[3]);
                    }
                    $Serial_Number = "";
                    if(isset($Row[4])) {
                        $Serial_Number = mysqli_real_escape_string($conn,$Row[4]);
                    }
                    $Hardware_Device_ID = "";
                    if(isset($Row[5])) {
                        $Hardware_Device_ID = mysqli_real_escape_string($conn,$Row[5]);
                    }
                    $System_type = "";
                    if(isset($Row[6])) {
                        $System_type = mysqli_real_escape_string($conn,$Row[6]);
                    }
                    $IMEI = "";
                    if(isset($Row[7])) {
                        $IMEI = mysqli_real_escape_string($conn,$Row[7]);
                    }
                    $Received_at = "";
                    if(isset($Row[8])) {
                        $Received_at = mysqli_real_escape_string($conn,$Row[8]);
                    }
                    $Returned_at = "";
                    if(isset($Row[9])) {
                        $Returned_at = mysqli_real_escape_string($conn,$Row[9]);
                    }
                    $Device_Return_Condition = "";
                    if(isset($Row[10])) {
                        $Device_Return_Condition = mysqli_real_escape_string($conn,$Row[10]);
                    }
                    $User_Name = "";
                    if(isset($Row[11])) {
                        $User_Name = mysqli_real_escape_string($conn,$Row[11]);
                    }
                    $Station_name = "";
                    if(isset($Row[12])) {
                        $Station_name = mysqli_real_escape_string($conn,$Row[12]);
                    }
                    if (!empty($Device_Name) && !empty($User_Name) ) {
                        $registed_at = date('y-m-d');
                        $query = "INSERT INTO `rtc_it_tools`(Device_Name,Processor,Memory_RAM,Edition,Serial_Number,Hardware_Device_ID,System_type,IMEI,branch_ID,Received_at, Returned_at,Device_Return_Condition,User_Name,Station_name,registed_at,registered_by) 
                        values('".$Device_Name."','".$Processor."','".$Memory_RAM."','".$Edition."','".$Serial_Number."','".$Hardware_Device_ID."','".$System_type."','".$IMEI."','".$Received_at."','".$Returned_at."','".$Device_Return_Condition."','".$User_Name."','".$Station_name."','".$registed_at."','".$_SESSION['user_id'].")";
                        $result = mysqli_query($conn, $query);
                        if (!empty($result)) {
                            $type = "success";
                            $_SESSION['imported_it'] = '<strong class="alert alert-success">Excel Data Imported into the Database</strong>'.'<script>
                                setTimeout(function(){
                                    window.location.href = "rtc_it_tools";
                                }, 1000);
                            </script>';
                            header('location: rtc_it_tools');
                        }else {
                            $type = "error";
                            $_SESSION['imported_it'] ='                        
                                                    <strong class="alert alert-success">
                                                    Problem in Importing Excel Data</strong>
                                                '.$conn->error;
                            //header('location:../views/rtc_it_tools');                    
                        }
                    }
                }
        
            }
        }else{ 
            $type = "error";
            $message = "Invalid File Type. Upload Excel File.";
        }
    }
    #####################################################################################
                # function of insert the IT Tools data for recording in Human resource 
    #####################################################################################
    public function Register_IT_Tools($post){
        $Device_Name        = htmlspecialchars($_POST['Device_Name'], ENT_QUOTES);
        $Processor          = htmlspecialchars($_POST['Processor'], ENT_QUOTES);
        $Memory_RAM         = htmlspecialchars($_POST['Memory_RAM'], ENT_QUOTES);
        $Edition            = htmlspecialchars($_POST['Edition'], ENT_QUOTES);
        $Serial_Number      = htmlspecialchars($_POST['Serial_Number'], ENT_QUOTES);
        $Hardware_Device_ID = htmlspecialchars($_POST['Hardware_Device_ID'], ENT_QUOTES);
        $System_type        = htmlspecialchars($_POST['System_type'], ENT_QUOTES);
        $IMEI               = htmlspecialchars($_POST['IMEI'], ENT_QUOTES);
        $Received_at        = htmlspecialchars($_POST['Received_at'], ENT_QUOTES);
        $Device_Return_Condition  = htmlspecialchars($_POST['Device_Return_Condition'], ENT_QUOTES);
        $User_Name                = htmlspecialchars($_POST['User_Name'], ENT_QUOTES);
        $Station_name             = htmlspecialchars($_POST['Station_name'], ENT_QUOTES);
        $created_by               = $_SESSION['user_id'];

        $sql_it_tools = "INSERT INTO `rtc_it_tools`(Tool_Id ,Device_Name,Processor,Memory_RAM,Edition,
                        Serial_Number,Hardware_Device_ID,System_type,IMEI,Received_at,Device_Return_Condition,User_Name,Station_name,registered_by)
                        VALUES(null,'$Device_Name','$Processor','$Memory_RAM','$Edition','$Serial_Number',
                        '$Hardware_Device_ID','$System_type','$IMEI','$Received_at','$Device_Return_Condition','$User_Name','$Station_name','$created_by')";
        $result_it_tools = $this->conn->query($sql_it_tools);
        if($result_it_tools){
            echo '<script>
                    setTimeout(function(){
                        window.location.href = "../views/rtc_it_tools";
                    }, 0);</script>';
        }else{
            echo $this->conn->error;
            header('location:../views/rtc_it_tools');
        }
    }

}