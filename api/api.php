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

        case 'createproduct':
            //first check the parameters required for this request are available or not
            //isTheseParametersAvailable(array('model', 'brand', 'category', 'product'));

            //check if model already exists
            $dbcheck = new DbOperation();
            if(isset($_POST['model'])){
                $result_check = $dbcheck->getInventoryByCompany($_POST['model'],$_POST['name']);

                if($result_check) {
                    //record is created means there is no error
                    $response['error'] = true;

                    //in message we have a success message
                    $response['message'] = 'Product already exists';

                    break;
                }
            }

            //creating a new dboperation object
            $db = new DbOperation();

            $_POST['model'] = isset($_POST['model']) ? $_POST['model'] : '';
            $_POST['brand'] = isset($_POST['brand']) ? $_POST['brand'] : '';
            $_POST['category'] = isset($_POST['category']) ? $_POST['category'] : '';
            $_POST['subcategory'] = isset($_POST['subcategory']) ? $_POST['subcategory'] : '';
            $_POST['quantity'] = isset($_POST['quantity']) ? $_POST['quantity'] : '';
            $_POST['price'] = isset($_POST['price']) ? $_POST['price'] : '';
            $_POST['name'] = isset($_POST['name']) ? $_POST['name'] : '';

            //creating a new record in the database
            $result = $db->createProduct(
                $_POST['model'],
                $_POST['brand'],
                $_POST['category'],
                $_POST['name'],
                $_POST['subcategory'],
                $_POST['quantity'],
                $_POST['price']
            );


            //if the record is created adding success to response
            if($result){
                //record is created means there is no error
                $response['error'] = false;

                //in message we have a success message
                $response['message'] = 'Product added successfully';

                //and we are getting all the products from the database in the response
                //$response['products'] = $db->getProducts();
            }else{

                //if record is not added that means there is an error
                $response['error'] = true;

                //and we have the error message
                $response['message'] = 'Some error occurred please try again';
            }

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

