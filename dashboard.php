<?php
require("includes/top.php");
require("includes/getUser.php");
?>

            <div class="container-fluid mx-4 mt-5">
                <h1 class="mt-4">Dashboard</h1>
                <div class="row mt-4 mr-0 pr-4">
                    <div class="col-md-12 col-lg-4 pr-4 mb-4 mb-lg-0">
                        <div class="col-12 box-shadow">
                            <div class="w-100 pt-3">
                                <h5>Total Products</h5>
                            </div>
                            <div class="w-100 py-3 text-right brand-color">
                                <h2 id="total-products">20</h2>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 col-lg-4 pr-4 mb-4 mb-lg-0">
                        <div class="col-12 box-shadow">
                            <div class="w-100 pt-3">
                                <h5>Membership</h5>
                            </div>
                            <div class="w-100 py-3 text-right brand-color">
                                <h2 id="membership-type"><?= $user['membership_type'] ?></h2>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 col-lg-4 pr-4 mb-4 mb-lg-0">
                        <div class="col-12 box-shadow">
                            <div class="w-100 pt-3">
                                <h5>Expiring</h5>
                            </div>
                            <div class="w-100 py-3 text-right brand-color">
                                <h2 id="membership-expiry"><?php $dateEx = date_create($user['expiration_date']); echo date_format($dateEx,'j M Y') ?></h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <br><br>

            <div class="mx-5">
                <div class="row mx-0">
                    <h5>Inventory</h5>
                </div>
                <div class="row d-flex mx-0">
                    <div class="mr-3"><button id="action-button" class="btn btn-light" disabled>Action on <span id="check-count">0</span> selected</button> </div>
                    <div class=""><input id="search" class="form-control mr-sm-2 search-bar" type="search" placeholder="Search..." aria-label="Search"></div>
                    <div class="ml-auto"><a href="inventory.php"><button class="btn brand-button"><i class="fas fa-plus mr-2"></i>Add Product</button></a></div>
                </div>
                <div id="table-check" class="table-responsive">
                    <table id="inventory-table" class="table mt-4 table-borderless color-grey">
                        <thead>
                        <tr>
                            <th><input name="select_all" value="1" type="checkbox"></th>
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
                    if (checkCount > 0){
                        $('#action-button').prop('disabled', false);
                    }
                    else{
                        $('#action-button').prop('disabled', true);
                    }
                }

                else if (checkItAll.checked == false){
                    inputs.forEach(function (input) {
                        input.checked = false;
                        checkCount = 0;
                    })
                    $("#check-count").html(checkCount);
                    if (checkCount > 0){
                        $('#action-button').prop('disabled', false);
                    }
                    else{
                        $('#action-button').prop('disabled', true);
                    }
                }
            });


        });


    </script>


<?php
require("includes/bottom.php");
?>