<?php


require_once 'DbOperation.php';

$db = new DbOperation();
$username = $_COOKIE['username'];
$user = $db->getUserById($username);


?>