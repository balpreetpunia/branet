<?php


require_once 'DbOperation.php';

$db = new DbOperation();

$term = (isset($_GET['term'])) ? $_GET['term'] : "";


$product_list = $db->getProducts($term);

foreach ($product_list as $product){

    echo "<tr>
                <td><input type=\"checkbox\" name=".$product['id']." /></td>
                <td>".$product['model']."</td>
                <td>".$product['brand']." </td>
                <td>".$product['category']."</td>
                <td>".$product['subcategory']."</td>
\                <td><i class=\"fas fa-ellipsis-h fa-lg\"></i></td>
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