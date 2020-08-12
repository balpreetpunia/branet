<?php
require("includes/top.php");
?>

    <div class="container-fluid mx-4 mt-5">

        <h1 class="mt-4">Product Search</h1>
        <div class="pt-2"><input id="search" class="form-control mr-sm-2 search-bar" value="" type="search" placeholder="Search..." aria-label="Search"></div>
        <div class="table-responsive">
            <table class="table mt-4 table-borderless color-grey">
                <thead>
                <tr>
                    <th>Brand</th>
                    <th>Model #</th>
                    <th>Sub Category</th>
                    <th>Quantity</th>
                    <th>Price</th>
                    <th>Company Name</th>
                    <th>City</th>
                    <th>Province</th>
                    <th>Phone</th>
                </tr>
                </thead>
                <tbody id="table-body">
                <?php //require("includes/getUsers.php");?>
                </tbody>
            </table>
        </div>

    </div>

    <script>
        $(document).ready(function() {


            console.log($("#search").val());

            $("#search").on('change keyup paste input', function() {
                getInventory($("#search").val());
            });

            getInventory($("#search").val());

            function getInventory(termValue) {


                //console.log(termValue);
                $.get("includes/getInventory.php", {term: termValue}, function (data) {
                    // Display the returned data in browser
                    $("#table-body").html(data);
                    //console.log(data);
                });
            }
        });

    </script>


<?php
require("includes/bottom.php");
?>