<?php


require_once 'DbOperation.php';

$db = new DbOperation();

$user = $db->getUserById('sales@teletime.ca');


?>