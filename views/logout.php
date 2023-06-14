<?php
include "../includes/auto_load.req.php";
$object = new Model();
$getSession = $_SESSION['user_id'];
$object->getUserOut($getSession);
?>