<?php


require_once 'DbOperation.php';

$db = new DbOperation();

$term = (isset($_GET['term'])) ? $_GET['term'] : "";


$users = $db->getUsers($term);


foreach ($users as $user){

    echo "<tr>
                <td>".$user['name']." </td>
                <td>".$user['contact_name']."</td>
                <td>".$user['address_province']."</td>
                <td>";if (date( "Y-m-d", strtotime($user['expiration_date'])) < date( "Y-m-d", strtotime("now")) )
                {echo "<span class=\"brand-color\"> <i class=\"fas fa-circle fa-sm\"></i>&nbsp;&nbsp;Pending Payment</span>" ;}
                else{echo "<span class=\"green-color\"> <i class=\"fas fa-circle fa-sm\"></i>&nbsp;&nbsp;Active</span>" ;}
                echo"</td>
                <td>".$user['membership_type']."</td>
                <td>".$user['effective_date']."</td>
            </tr>";
}

?>