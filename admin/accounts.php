<?php
require("../includes/adminTop.php");
?>

    <div class="container-fluid mx-4 mt-5">

        <h1 class="mt-4">Admin / Accounts</h1>
        <div class=" d-flex mx-0 mr-5 pt-2">
            <div class="pt-2"><input id="search" class="form-control mr-sm-2 search-bar" value="" type="search" placeholder="Search..." aria-label="Search"></div>
            <div class="ml-auto"><button class="btn brand-button"><i class="fas fa-plus mr-2"></i>Add Account</button> </div>
        </div>

        <table class="table mt-4 table-borderless table-responsive-md color-grey">
            <thead>
            <tr>
                <th>Status</th>
                <th>Company Name</th>
                <th>Contact Name</th>
                <th>Province</th>
                <th>Phone</th>
                <th>Package</th>
                <th>Created</th>
                <th>Expires</th>
            </tr>
            </thead>
            <tbody id="table-body">
            </tbody>
        </table>

    </div>

    <script>
        $(document).ready(function() {


            console.log($("#search").val());

            $("#search").on('change keyup paste input', function() {
                getUsers($("#search").val());
            });

            getUsers($("#search").val());

            function getUsers(termValue) {


                //console.log(termValue);
                $.get("../includes/a_getAccounts.php", {term: termValue}, function (data) {
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