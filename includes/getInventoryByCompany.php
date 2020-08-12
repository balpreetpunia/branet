<?php


require_once 'DbOperation.php';

$db = new DbOperation();

$term = (isset($_GET['term'])) ? $_GET['term'] : "";
$term2 = (isset($_GET['term2'])) ? $_GET['term2'] : "";


$inventory_list = $db->getInventoryByCompany($term,$term2);

foreach ($inventory_list as $inventory){

    echo "<tr>
                <td><input type=\"checkbox\" name=".$inventory['id']." /></td>
                <td>".$inventory['model']."</td>
                <td>".$inventory['brand']." </td>
                <td>".$inventory['category']."</td>
                <td>".$inventory['subcategory']."</td>
                <td>".$inventory['quantity']."</td>
                <td>".$inventory['price']."</td>
            </tr>";
}
echo '<script>var $checkboxes = $(\'#table-check td input[type="checkbox"]\');

            $checkboxes.change(function(){
                var checkCount = $checkboxes.filter(\':checked\').length;
                $(\'#check-count\').text(checkCount);
                //console.log(countCheckedCheckboxes);
                if (checkCount > 0){
                        $(\'#action-button\').prop(\'disabled\', false);
                    }
                    else{
                        $(\'#action-button\').prop(\'disabled\', true);
                    }
            });
            </script>';

?>