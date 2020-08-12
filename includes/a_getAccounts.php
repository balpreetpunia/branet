<?php


require_once 'DbOperation.php';

$db = new DbOperation();

$term = (isset($_GET['term'])) ? $_GET['term'] : "";


$users = $db->getUsers($term);


foreach ($users as $user){

    echo "<tr>
                <td class='text-center'>";if (date( "Y-m-d", strtotime($user['expiration_date'])) < date( "Y-m-d", strtotime("now")) )
                {echo "<span class=\"brand-color\"> <i class=\"fas fa-circle fa-sm\"></i></span>" ;}
                else{echo "<span class=\"green-color\"> <i class=\"fas fa-circle fa-sm\"></i></span>" ;}
                echo"</td>
                <td><a href=\"\" class=\"brand-color\"><u>".$user['name']." </u></a></td>
                <td>".$user['contact_name']."</td>
                <td>".$user['address_province']."</td>
                <td>".$user['phone']."</td>
                <td>".$user['membership_type']."</td>
                <td>".$user['effective_date']."</td>
                <td>".$user['expiration_date']."</td>
            </tr>";
}

?>