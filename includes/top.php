<?php
$value = 'Teletime';
if(!isset($_COOKIE['username'])){
    header("Location: login.php");
    //setcookie("name", $value, time()+3600);
    echo 'unset';
}

?>
<!doctype html>

<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Branet</title>
    <link rel="stylesheet" href="public/css/bootstrap.css">
    <link rel="stylesheet" href="public/css/style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link rel="stylesheet" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.10.1/themes/base/minified/jquery-ui.min.css" type="text/css" />
    <script type="text/javascript" src="http://code.jquery.com/ui/1.10.1/jquery-ui.min.js"></script>
    <script src="https://code.jquery.com/jquery-migrate-3.0.0.min.js" integrity="sha256-JklDYODbg0X+8sPiKkcFURb5z7RvlNMIaE3RA2z97vw=" crossorigin="anonymous"></script>
    <script src="public/js/bootstrap.bundle.js"></script>
    <script src="https://kit.fontawesome.com/4ba6be508b.js" crossorigin="anonymous"></script>
    <script src="app/app.js"></script>
    <link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Muli">




</head>

<body>

<div class="d-flex" id="wrapper">

    <!-- Sidebar -->
    <div class="border-right" id="sidebar-wrapper">
        <div class="sidebar-heading mt-1">
            <div class="row">
                <div class="col-9">
                    <img id="brand-img-big" class="d-none d-md-inline" src="public/images/logo.png" height="22rem">
                    <img id="brand-img-small" class="d-inline d-md-none" src="public/images/logo_small.png" height="22rem">
                </div>
                <div id="menu-toggle" class="col-3 pl-1 mt-1">
                </div>
            </div>
        </div>
        <div id="list-group" class="list-group list-group-flush mt-4 pr-1">
            <a id="dashboard-page" href="dashboard.php" class="list-group-item list-group-item-action mt-3"><img class="side-icon mr-3" src="public/images/dashboard_icon.png"><span class="d-none d-md-inline">Dashboard</span></a>
            <a id="product-page" href="productsearch.php" class="list-group-item list-group-item-action mt-3"><img class="side-icon mr-3" src="public/images/search_icon.png"><span class="d-none d-md-inline">Product Search</span></a>
            <a id="inventory-page" href="inventory.php" class="list-group-item list-group-item-action mt-3"><img class="side-icon mr-3" src="public/images/inventory_icon.png"><span class="d-none d-md-inline">Inventory</span></a>
            <a id="members-page" href="members.php" class="list-group-item list-group-item-action mt-3"><img class="side-icon mr-3" src="public/images/members_icon.png"><span class="d-none d-md-inline">Members</span></a>
            <a id="settings-page" href="settings.php" class="list-group-item list-group-item-action mt-3"><img class="side-icon mr-3" src="public/images/settings_icon.png"><span class="d-none d-md-inline">Settings</span></a>
        </div>

        <p class="version"> Version 1.0 </p>
    </div>
    <!-- /#sidebar-wrapper -->

    <!-- Page Content -->
    <div id="page-content-wrapper">

        <nav class="navbar navbar-expand-lg navbar-light">

            <div class=" navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ml-auto mt-2 mt-lg-0">
                    <li class="nav-item dropdown ml-auto text-right">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <img class="side-icon mr-3" src="public/images/user_icon.png"><?= $_COOKIE['name'];?>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="#">Action</a>
                            <a class="dropdown-item" href="#">Another action</a>
                            <div class="dropdown-divider"></div>
                            <a id="log-out" class="dropdown-item" href="#">Log Out</a>
                        </div>
                    </li>
                </ul>
            </div>
        </nav>