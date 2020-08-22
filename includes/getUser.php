<?php


require_once 'DbOperation.php';

$db = new DbOperation();
$name = $_COOKIE['name'];
$user = $db->getUserByName($name);


?>