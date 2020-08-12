<?php


require_once 'DbOperation.php';

$db = new DbOperation();

$term = (isset($_GET['term'])) ? $_GET['term'] : "";


$users = $db->getApplications($term);


foreach ($users as $user){

    echo "<tr>
                <td><input type=\"checkbox\" name=".$user['username']." /></td>
                <td>".$user['name']."</td>
                <td>".$user['address_province']."</td>
                <td><span class=\"pink-color\"> <i class=\"fas fa-circle fa-sm\"></i>&nbsp;&nbsp;Awaiting Approval</span></td>
                <td>".$user['membership_type']."</td>
                <td>".$user['effective_date']."</td>
            </tr>";
}

?>