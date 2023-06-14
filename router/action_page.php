<?php
include "../includes/auto_load.req.php";
include "../vendor/php-excel-reader/excel_reader2.php";
include "../vendor/SpreadsheetReader.php"; 
$object = new Model();
$object_change = new MakeChange();
$object_display = new Display();

if(isset($_POST['login_button'])){
    $object->login_form($_POST);
}
if(isset($_POST['btn_register_trees'])){
    $object->register_trees_form($_POST);
}
if(isset($_POST['UpdateUserInfo'])){
    $get_session = $_SESSION['user_id'];
    $object->updateProfile($get_session);
}
if(isset($_POST['update_password'])){
    $get_session = $_SESSION['user_id'];
    $object->UserUpdatePassword($get_session);
}
if (isset($_REQUEST['user_status'])) {
    $status = $_REQUEST['status'];
    $id =$_REQUEST['user_ID'];
    $object->SystemUserAccess($status,$id);
}
if(isset($_REQUEST['access_right'])){
    $id = $_REQUEST['user'];
    $status = $_REQUEST['status'];
    $col = $_REQUEST['access_right'];
    $object->UserAccessRight($id,$status,$col);
}
if(isset($_POST['rtc_users_registration'])){
    $object->User_Registion_Form($_POST);
}
if(isset($_POST['save_receivable_supplier_product'])){
    $object->supplied_coffee($_POST);
}
if(isset($_POST['new_module'])){
    $object->module_Form($_POST);
}
if(isset($_POST['rtc_warehouse_setting'])){
    $object->warehouse_setting($_POST);
}
if(isset($_POST['rtc_certification_setting'])){
    $object->rtc_certification_setting($_POST);
}
if(isset($_POST['rtc_product_type_setting'])){
    $object->rtc_product_type_setting($_POST);
}
if(isset($_POST['rtc_product_category_setting'])){
    $object->rtc_product_category_setting($_POST);
}
if(isset($_POST['rtc_coffee_grade_setting'])){
    $object->rtc_coffee_grade_setting($_POST);
}
if(isset($_POST['rtc_department_setting'])){
    $object->rtc_department_setting($_POST);
}
if(isset($_REQUEST['delete_data'])){
    $table_name = $_REQUEST['table_name'];
    $id = $_REQUEST['id'];
    $object_change->delete_data($id,$table_name);
}
if(isset($_REQUEST['rtc_edit_data'])){
    $object_change->edit_data($_POST);
}
if(isset($_POST['save_delivery_lot'])){
    $object_change->Store_delivery_lot($_POST);
}
if(isset($_POST['rtc_setting_new_hopper'])){
    $object->Setting_new_hopper($_POST);
}
if(isset($_POST['save_assigned_PRB_Delivery'])){
    $object_change->PRB_Assignment_Delivery($_POST);
}
if(isset($_POST['save_produced_green'])){
    $object_change->save_produced_green($_POST);
}
if(isset($_POST['green_defects_setting'])){
    $object->green_defects_setting($_POST);
}
if(isset($_POST['save_PRB_coffee_defects_data'])){
    $object_change->save_PRB_coffee_defects_data($_POST);
}
if(isset($_POST['new_bank_account'])){
    $object->New_Bank_Account($_POST);
}
if(isset($_POST['Submit_Export_Deliveries'])){
    $object->Submit_Export_Deliveries($_POST);
}
if(isset($_POST['import_it_tools'])){
    $object->Import_IT_Tools($_POST);
}
if(isset($_POST['rtc_it_tools_registration'])){
    $object->Register_IT_Tools($_POST);
}
if(isset($_POST['btn_send_weekly_report'])){
    $object->Weekly_Report($_POST);
}