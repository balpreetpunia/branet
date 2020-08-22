<?php

require_once 'DbOperation.php';

$db = new DbOperation();


if (isset($_GET['term'])){

    $term = $_GET['term'];
    $return_arr = array();


    $product_list = $db->getProducts($term);
    foreach($product_list as $product){
        $return_arr[] =  $product['brand'];
    }


    /* Toss back results as json encoded array. */
    echo json_encode($return_arr);
}

?>