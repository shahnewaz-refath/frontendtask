<?php
require_once 'classes/api.php';
$api = new Api;
header('Content-Type:application/json');
echo $api->select();
?>