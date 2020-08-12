<?php

//getting the dboperation class
require_once '../includes/DbOperation.php';

$response = array();

//if it is an api call
//that means a get parameter named api call is set in the URL
//and with this parameter we are concluding that it is an api call
if(isset($_GET['apicall'])){

    switch($_GET['apicall']){

        //the READ operation
        //if the call is getusers
        case 'getusers':
            $db = new DbOperation();
            $response['error'] = false;
            $response['message'] = 'Request successfully completed';
            $response['data'] = $db->getUsers($_GET['term']);
            break;

    }

}else{
    //if it is not api call
    //pushing appropriate values to response array
    $response['error'] = true;
    $response['message'] = 'Invalid API Call';
}

//displaying the response in json structure

/*function convert_before_json(&$item, $key)
{
    $item = utf8_encode($item);
}

array_walk_recursive($response, "convert_before_json");*/

//array_walk_recursive($response,function(&$item){$item=strval($item);});

echo json_encode($response);

