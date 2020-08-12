<?php


require_once 'DbOperation.php';

$db = new DbOperation();

$term = (isset($_GET['term'])) ? $_GET['term'] : "";


$inventory_list = $db->getInventory($term);

foreach ($inventory_list as $inventory){

    echo "<tr>
                <td>".$inventory['brand']." </td>
                <td>".$inventory['model']."</td>
                <td>".$inventory['subcategory']."</td>
                <td>".$inventory['company']."</td>
                <td>".$inventory['quantity']."</td>
                <td>".$inventory['price']."</td>
                <td>".$inventory['address_city']."</td>
                <td>".$inventory['address_province']."</td>
                <td>".$inventory['phone']."</td>
            </tr>";
}
echo '<script>var $checkboxes = $(\'#table-check td input[type="checkbox"]\');

            $checkboxes.change(function(){
                var countCheckedCheckboxes = $checkboxes.filter(\':checked\').length;
                $(\'#check-count\').text(countCheckedCheckboxes);
                //console.log(countCheckedCheckboxes);
            });</script>';

?>