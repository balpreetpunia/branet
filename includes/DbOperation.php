<?php

class DbOperation
{
    //Database connection link
    private $con;

    //Class constructor
    function __construct()
    {
        //Getting the DbConnect.php file
        require_once dirname(__FILE__) . '/DbConnect.php';

        //Creating a DbConnect object to connect to the database
        $db = new DbConnect();

        //Initializing our connection link of this class
        //by calling the method connect of DbConnect class
        $this->con = $db->connect();
    }




    function getUserById($username){
        $stmt = $this->con->prepare("SELECT username, name, contact_name, contact_email, phone, email, website, membership_type,
                                            effective_date, expiration_date, address_street, address_city, address_province, address_postalcode FROM users WHERE username = ?");
        $stmt->bind_param("s",$username);
        $stmt->execute();
        $stmt->bind_result($username, $name, $contact_name, $contact_email, $phone, $email, $website, $membership_type, $effective_date, $expiration_date, $address_street, $address_city, $address_province, $address_postalcode);

        //$users = array();

        while($stmt->fetch()){
            $user  = array();
            $user['username'] = $username;
            $user['name'] = $name;
            $user['contact_name'] = $contact_name;
            $user['contact_email'] = $contact_email;
            $user['phone'] = $phone;
            $user['email'] = $email;
            $user['website'] = $website;
            $user['membership_type'] = $membership_type;
            $user['effective_date'] = $effective_date;
            $user['expiration_date'] = $expiration_date;
            $user['address_street'] = $address_street;
            $user['address_city'] = $address_city;
            $user['address_province'] = $address_province;
            $user['address_postalcode'] = $address_postalcode;


            //array_push($users, $user);
        }

        return $user;
    }


    function getUsers($term){
        $stmt = $this->con->prepare("SELECT username, name, contact_name, contact_email, phone, email, website, membership_type,
                                            effective_date, expiration_date, address_street, address_city, address_province, address_postalcode FROM users where name LIKE CONCAT(?,'%')");
        $stmt->bind_param("s",$term);
        $stmt->execute();
        $stmt->bind_result($username, $name, $contact_name, $contact_email, $phone, $email, $website, $membership_type, $effective_date, $expiration_date, $address_street, $address_city, $address_province, $address_postalcode);

        $users = array();

        while($stmt->fetch()){
            $user  = array();
            $user['username'] = $username;
            $user['name'] = $name;
            $user['contact_name'] = $contact_name;
            $user['contact_email'] = $contact_email;
            $user['phone'] = $phone;
            $user['email'] = $email;
            $user['website'] = $website;
            $user['membership_type'] = $membership_type;
            $user['effective_date'] = $effective_date;
            $user['expiration_date'] = $expiration_date;
            $user['address_street'] = $address_street;
            $user['address_city'] = $address_city;
            $user['address_province'] = $address_province;
            $user['address_postalcode'] = $address_postalcode;


            array_push($users, $user);
        }

        return $users;
    }

    function getInventoryByCompany($term,$term2){
        $stmt = $this->con->prepare("SELECT id, model, brand, category, subcategory, company, quantity, price FROM inventory where model LIKE CONCAT(?,'%') AND company = ?");
        $stmt->bind_param("ss",$term,$term2);
        $stmt->execute();
        $stmt->bind_result($id, $brand, $model, $category, $subcategory, $company, $quantity, $price);

        $inventory_list = array();

        while($stmt->fetch()){
            $inventory = array();
            $inventory['id'] = $id;
            $inventory['brand'] = $brand;
            $inventory['model'] = $model;
            $inventory['category'] = $category;
            $inventory['subcategory'] = $subcategory;
            $inventory['company'] = $company;
            $inventory['quantity'] = $quantity;
            $inventory['price'] = $price;

            array_push($inventory_list,$inventory);
        }

        return $inventory_list;

    }

    function getInventory($term)
    {
        $stmt = $this->con->prepare("SELECT * FROM (SELECT a.brand , a.model, a.category, a.subcategory, a.quantity, a.price, a.company , b.address_city, b.address_province, b.phone 
FROM inventory a 
LEFT JOIN users b 
ON a.company = b.name
UNION
SELECT a.brand , a.model, a.category, a.subcategory, a.quantity, a.price, a.company , b.address_city, b.address_province, b.phone 
FROM inventory a 
RIGHT JOIN users b 
ON a.company = b.name order by model asc) as t where t.model LIKE CONCAT(?,'%')");
        $stmt->bind_param("s", $term);
        $stmt->execute();
        $stmt->bind_result( $brand, $model, $category, $subcategory, $company, $quantity, $price, $address_city, $address_province, $phone);

        $inventory_list = array();

        while ($stmt->fetch()) {
            $inventory = array();
            $inventory['model'] = $model;
            $inventory['brand'] = $brand;
            $inventory['category'] = $category;
            $inventory['subcategory'] = $subcategory;
            $inventory['company'] = $company;
            $inventory['quantity'] = $quantity;
            $inventory['price'] = $price;
            $inventory['address_city'] = $address_city;
            $inventory['address_province'] = $address_province;
            $inventory['phone'] = $phone;

            array_push($inventory_list, $inventory);
        }

        return $inventory_list;

    }

    function getInfo()
    {
        $info_list = array();
        $stmt = $this->con->prepare("SELECT COUNT(*) FROM users");
        $stmt->execute();
        $stmt->bind_result($users);

        while ($stmt->fetch()) {
            $info_list['users'] = $users;
        }

        $stmt = $this->con->prepare("SELECT COUNT(*) FROM users where expiration_date between CURDATE() and DATE_ADD( CURDATE( ) ,INTERVAL 1 MONTH )");
        $stmt->execute();
        $stmt->bind_result($expiring);

        while ($stmt->fetch()) {
            $info_list['expiring'] = $expiring;
        }

        $stmt = $this->con->prepare("SELECT COUNT(*) FROM users where expiration_date < CURDATE()");
        $stmt->execute();
        $stmt->bind_result($pending_payments);

        while ($stmt->fetch()) {
            $info_list['pending_payments'] = $pending_payments;
        }

        $stmt = $this->con->prepare("SELECT COUNT(*) FROM applications");
        $stmt->execute();
        $stmt->bind_result($applications);

        while ($stmt->fetch()) {
            $info_list['applications'] = $applications;
        }

        return $info_list;

    }

    function getApplications($term){
        $stmt = $this->con->prepare("SELECT username, name, contact_name, contact_email, phone, email, website, membership_type,
                                            effective_date, expiration_date, address_street, address_city, address_province, address_postalcode FROM applications where name LIKE CONCAT(?,'%')");
        $stmt->bind_param("s",$term);
        $stmt->execute();
        $stmt->bind_result($username, $name, $contact_name, $contact_email, $phone, $email, $website, $membership_type, $effective_date, $expiration_date, $address_street, $address_city, $address_province, $address_postalcode);

        $users = array();

        while($stmt->fetch()){
            $user  = array();
            $user['username'] = $username;
            $user['name'] = $name;
            $user['contact_name'] = $contact_name;
            $user['contact_email'] = $contact_email;
            $user['phone'] = $phone;
            $user['email'] = $email;
            $user['website'] = $website;
            $user['membership_type'] = $membership_type;
            $user['effective_date'] = $effective_date;
            $user['expiration_date'] = $expiration_date;
            $user['address_street'] = $address_street;
            $user['address_city'] = $address_city;
            $user['address_province'] = $address_province;
            $user['address_postalcode'] = $address_postalcode;


            array_push($users, $user);
        }

        return $users;
    }


    function getProducts($term){
        $stmt = $this->con->prepare("SELECT id, model, brand, category, subcategory FROM products where model LIKE CONCAT(?,'%')");
        $stmt->bind_param("s",$term);
        $stmt->execute();
        $stmt->bind_result($id, $brand, $model, $category, $subcategory);

        $inventory_list = array();

        while($stmt->fetch()){
            $inventory = array();
            $inventory['id'] = $id;
            $inventory['brand'] = $brand;
            $inventory['model'] = $model;
            $inventory['category'] = $category;
            $inventory['subcategory'] = $subcategory;

            array_push($inventory_list,$inventory);
        }

        return $inventory_list;

    }


    function createProduct($model, $brand, $category, $name, $subcategory, $quantity, $price){
        $stmt = $this->con->prepare("INSERT INTO inventory (model,brand,category,company,subcategory,quantity,price) 
                            VALUES (?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("sssssid", $model, $brand, $category, $name, $subcategory, $quantity, $price);
        if($stmt->execute())
            return true;
        return false;
    }










}