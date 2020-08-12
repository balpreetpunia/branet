<?php
require("includes/top.php");
?>

    <div class="container-fluid mx-4 mt-5">

        <h1 class="mt-4">Inventory</h1>
        <div class=" d-flex mx-0 mr-5 pt-2">
            <div class="mr-3"><button class="btn button-grey">Action on <span id="check-count">0</span> selected</button> </div>
            <div class=""><input id="search" class="form-control mr-sm-2 search-bar" type="search" placeholder="Search..." aria-label="Search"></div>
            <div class="ml-auto"><button class="btn brand-button"><i class="fas fa-plus mr-2"></i>Add Product</button> </div>
        </div>
        <div id="table-check" class="table-responsive">
            <table id="inventory-table" class="table mt-4 table-borderless color-grey">
                <thead>
                <tr>
                    <th><input formmethod="select_all" name="select_all" value="1" type="checkbox"></th>
                    <th>Brand</th>
                    <th>Model #</th>
                    <th>Main Category</th>
                    <th>Sub Category</th>
                    <th>Quantity</th>
                    <th>Price</th>
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
                getInventoryByCompany($("#search").val(),'<?= $_COOKIE['name'];?>');
            });

            getInventoryByCompany($("#search").val(),'<?= $_COOKIE['name'];?>');

            function getInventoryByCompany(termValue,termValue2) {


                //console.log(termValue);
                $.get("includes/getInventoryByCompany.php", {term: termValue, term2 : termValue2}, function (data) {
                    // Display the returned data in browser
                    $("#table-body").html(data);
                    //console.log(data);
                });
            }


            var dataTable = document.getElementById('inventory-table');
            var checkItAll = dataTable.querySelector('input[name="select_all"]');

            checkItAll.addEventListener('change', function() {

                var inputs = dataTable.querySelectorAll('tbody>tr>td>input');
                var checkCount = 0;

                if (checkItAll.checked) {
                    checkCount = 0;
                    inputs.forEach(function(input) {
                        input.checked = true;
                        checkCount += 1;
                    });
                    $("#check-count").html(checkCount);
                }

                else if (checkItAll.checked == false){
                    inputs.forEach(function (input) {
                        input.checked = false;
                        checkCount = 0;
                    })
                    $("#check-count").html(checkCount);
                }
            });
        });


    </script>

<?php
require("includes/bottom.php");
?>