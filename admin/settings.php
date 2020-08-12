<?php
require("../includes/adminTop.php");
?>

<div class="container-fluid mx-4 mt-5">
    <h1 class="mt-4">Admin / Settings</h1>

    <div class="row">
        <div class="col-12 col-md-4">
            <div id="password-change" class="ml-2 mt-4">
                <div class="small mt-4 color-grey">Change Password</div>
                <input class="form-control mr-sm-2 mt-3 search-bar" placeholder="New Password">
                <input class="form-control mr-sm-2 mt-3 search-bar" placeholder="Confirm Password">
                <button class="btn brand-button mt-3">Change Password</button>
            </div>
        </div>
        <div class="col-12 col-md-8 border-left">
            <div id="add-admin" class="ml-2 mt-4">
                <div class="small mt-4 color-grey">Add New User Admin</div>
                <input class="form-control mr-sm-2 mt-3 search-bar" placeholder="Name">
                <input class="form-control mr-sm-2 mt-3 search-bar" placeholder="Email Address">
                <input class="form-control mr-sm-2 mt-3 search-bar" placeholder="Create Password">
                <button class="btn brand-button mt-3">Create Admin</button>
            </div>
        </div>
    </div>

</div>


<?php
require("../includes/adminBottom.php");
?>
