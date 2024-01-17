<?php
class Display extends Dbh {
    #####################################################################################
                # function of getting user details 
    ##################################################################################### 

    public function getUsers(){
        $sql = "SELECT s.__kp_Staff,s._kf_Location,s._kf_Supplier,s._kf_Station, 
        s._kf_User,s.userID,s.Name,s.Phone,s.Role,s.Gender,u.id,u.created_at,u.__kp_User,
        u._kf_Location,u.Email,u.Name_Full,u.Name_User,u.status,u.id FROM staff s 
        INNER JOIN rtc_users u ON s._kf_User = u.__kp_User 
        ORDER BY u.id DESC";
        $result = $this->conn->query($sql);
        if($result->num_rows > 0){
            while($row = $result->fetch_assoc()){
                $data[] = $row;
            }
            return $data;
        }
    }
    #####################################################################################
                # function of accessing the privilegies 
    #####################################################################################

    public function AccessPrivilege($id){
        $sql = "SELECT * FROM rtc_users_modules_access  
                WHERE rtc_users_modules_access.user_ID = '$id'";
        $result = $this->conn->query($sql);
        if($result->num_rows > 0){
           $row_access = $result->fetch_assoc(); 
            return $row_access;
        }
    }
   
    #####################################################################################
                # function of display the station of rtc
    #####################################################################################

    public function displayedStation(){
        if(($_SESSION['staff_Role'] == 'Washing Station Accountant') || ($_SESSION['staff_Role'] == 'Washing Station Manager') || ($_SESSION['staff_Role'] == 'Field Officer') || ($_SESSION['staff_Role'] == '	Site Collector')){
            $sql_station = $this->conn->query("SELECT * FROM `rtc_household_trees`
            WHERE _kf_Station = '$_SESSION[_kf_Station]' AND _kf_Supplier = '$_SESSION[_kf_Supplier]'");
        }else{
            $sql_station = $this->conn->query("SELECT * FROM `rtc_household_trees`");
        }
        $station_count  = $sql_station->num_rows;
        if($station_count > 0){
            while($row = $sql_station->fetch_assoc()){
                $station_data[] = $row;
            }
            return $station_data;
        }
    }
    #####################################################################################
                # function of display the station of rtc
    #####################################################################################

    public function displayedRegisteredFarmers(){
        if(($_SESSION['staff_Role'] == 'Washing Station Accountant') || ($_SESSION['staff_Role'] == 'Washing Station Manager') || ($_SESSION['staff_Role'] == 'Field Officer') || ($_SESSION['staff_Role'] == '	Site Collector')){
            $sql_farmers = $this->conn->query("SELECT * FROM `rtc_field_farmers`
            WHERE _kf_Station = '$_SESSION[_kf_Station]' AND _kf_Supplier = '$_SESSION[_kf_Supplier]'");
        }else{
            $sql_farmers = $this->conn->query("SELECT * FROM `rtc_field_farmers`");
        }
        $farmer_count  = $sql_farmers->num_rows;
        if($farmer_count > 0){
            while($row = $sql_farmers->fetch_assoc()){
                $farmers_data[] = $row;
            }
            return $farmers_data;
        }
    }
    #####################################################################################
                # function of display the farm gps of rtc
    #####################################################################################

    public function displayed_GPS_Farm(){
        if(($_SESSION['staff_Role'] == 'Washing Station Accountant') || ($_SESSION['staff_Role'] == 'Washing Station Manager') || ($_SESSION['staff_Role'] == 'Field Officer') || ($_SESSION['staff_Role'] == '	Site Collector')){
            $sql_gps = $this->conn->query("SELECT * FROM `rtc_farm_coordinations`
            WHERE _kf_Station = '$_SESSION[_kf_Station]' AND _kf_Supplier = '$_SESSION[_kf_Supplier]'");
        }else{
            $sql_gps = $this->conn->query("SELECT * FROM `rtc_farm_coordinations`");
        }
        $gps_count  = $sql_gps->num_rows;
        if($gps_count > 0){
            while($row = $sql_gps->fetch_assoc()){
                $gps_data[] = $row;
            }
            return $gps_data;
        }
    }
    #####################################################################################
                # function of display rtc module is just menu and submenu
    #####################################################################################

    public function displayWeeklyReport(){
        if(($_SESSION['staff_Role'] == 'Washing Station Accountant') || ($_SESSION['staff_Role'] == 'Washing Station Manager') || ($_SESSION['staff_Role'] == 'Field Officer') || ($_SESSION['staff_Role'] == '	Site Collector')){
            $results = $this->conn->query("SELECT * FROM `rtc_field_weekly_report`
            WHERE _kf_Station = '$_SESSION[_kf_Station]' AND _kf_Supplier = '$_SESSION[_kf_Supplier]'");
        }else{
            $results = $this->conn->query("SELECT * FROM `rtc_field_weekly_report`");
        }
        $module_count  = $results->num_rows;
        if($module_count > 0){
            while($row = $results->fetch_assoc()){
                $module_data[] = $row;
            }
            return $module_data;
        }
    }
    #####################################################################################
                # function of removing farmer trees record
    #####################################################################################

    public function removeTrees($id){
        
        $sql_delete = "DELETE FROM `rtc_household_trees` WHERE `rtc_household_trees`.`ID` = $id";
        $result_delete = $this->conn->query($sql_delete);
        if($result_delete){
            echo '<script>
                setTimeout(function(){
                    window.location.href = "../views/rtc_stations";
                }, 0);
            </script>';
        }
    }

    #####################################################################################
                # function of removing farmer trees record
    #####################################################################################

    public function removeFarmerInfo($id){
        
        $sql_delete = "DELETE FROM `rtc_field_farmers` WHERE `rtc_field_farmers`.`id` = $id";
        $result_delete = $this->conn->query($sql_delete);
        if($result_delete){
            echo '<script>
                setTimeout(function(){
                    window.location.href = "../views/registered_farmers";
                }, 0);
            </script>';
        }
    }
    #####################################################################################
                # function of removing farm gps record
    #####################################################################################

    public function removeFarm_GPS_Info($id){
        
        $sql_delete = "DELETE FROM `rtc_farm_coordinates` WHERE `rtc_farm_coordinates`.`id` = $id";
        $result_delete = $this->conn->query($sql_delete);
        if($result_delete){
            echo '<script>
                setTimeout(function(){
                    window.location.href = "../views/collected_gps";
                }, 0);
            </script>';
        }
    }
    #####################################################################################
                # function of removing farmer trees record
    #####################################################################################

    public function remove_Weekly_Report($id){
        
        $sql_delete = "DELETE FROM `rtc_field_weekly_report` WHERE `rtc_field_weekly_report`.`ID` = $id";
        $result_delete = $this->conn->query($sql_delete);
        if($result_delete){
            echo '<script>
                setTimeout(function(){
                    window.location.href = "../views/rtc_weekly_report";
                }, 0);
            </script>';
        }
    }
} 