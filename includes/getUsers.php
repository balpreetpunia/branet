<?php


require_once 'DbOperation.php';

$db = new DbOperation();

$term = (isset($_GET['term'])) ? $_GET['term'] : "";


$users = $db->getUsers($term);


foreach ($users as $user){

    echo "<tr>
                <td><a href=\"member.php?name=".urlencode($user['name'])."\" class=\"brand-color\"><u>View</u></a></td>
                <td>".$user['name']." </td>
                <td>".$user['contact_name']."</td>
                <td>".$user['address_city']."</td>
                <td>".$user['address_province']."</td>
                <td>".$user['phone']."</td>
                <td>".$user['email']."</td>
            </tr>";
}

?>