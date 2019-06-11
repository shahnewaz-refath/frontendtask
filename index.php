<?php
require_once 'classes/api.php';
$getdata = new Api;
header('Content-Type:application/json');
echo $getdata->select();
?>