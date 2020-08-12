<?php
require("../includes/adminTop.php");
require("../includes/a_getInfo.php");
?>

    <div class="container-fluid mx-4 mt-5">
        <h1 class="mt-4">Admin / Dashboard</h1>
        <div class="row mt-4 mr-0 pr-4">
            <div class="col-md-12 col-lg-3 pr-4 mb-4 mb-lg-0">
                <div class="col-12 box-shadow">
                    <div class="w-100 pt-3">
                        <h5>Users</h5>
                    </div>
                    <div class="w-100 py-3 text-right brand-color">
                        <h2 id="total-users"><?= $info['users'] ?></h2>
                    </div>
                </div>
            </div>
            <div class="col-md-12 col-lg-3 pr-4 mb-4 mb-lg-0">
                <div class="col-12 box-shadow">
                    <div class="w-100 pt-3">
                        <h5>Pending Apps</h5>
                    </div>
                    <div class="w-100 py-3 text-right brand-color">
                        <h2 id="pending-applications"><?= $info['applications'] ?></h2>
                    </div>
                </div>
            </div>
            <div class="col-md-12 col-lg-3 pr-4 mb-4 mb-lg-0">
                <div class="col-12 box-shadow">
                    <div class="w-100 pt-3">
                        <h5>Pending Payments</h5>
                    </div>
                    <div class="w-100 py-3 text-right brand-color">
                        <h2 id="pending-payments"><?= $info['pending_payments'] ?></h2>
                    </div>
                </div>
            </div>
            <div class="col-md-12 col-lg-3 pr-4 mb-4 mb-lg-0">
                <div class="col-12 box-shadow">
                    <div class="w-100 pt-3">
                        <h5>Expiring Soon</h5>
                    </div>
                    <div class="w-100 py-3 text-right brand-color">
                        <h2 id="expiring-soon"><?= $info['expiring'] ?></h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <br><br>

    <div class="mx-5">
        <div id="table-check" class="table-responsive">
            <table id="inventory-table" class="table mt-4 table-borderless color-grey">
                <thead>
                <tr>
                    <th>Company Name</th>
                    <th>Contact Name</th>
                    <th>Province</th>
                    <th>Status</th>
                    <th>Package</th>
                    <th>Created</th>
                </tr>
                </thead>
                <tbody id="table-body">
                </tbody>
            </table>
        </div>
    </div>

    <script>

        $(document).ready(function() {

            $term = "";
            getUsers($term);

            function getUsers(termValue) {


                //console.log(termValue);
                $.get("../includes/a_getUsers.php", {term: termValue}, function (data) {
                    // Display the returned data in browser
                    $("#table-body").html(data);
                    //console.log(data);
                });
            }

        });


    </script>


<?php
require("../includes/adminBottom.php");
?>