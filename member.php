<?php
require("includes/top.php");
?>

    <div class="container-fluid mx-4 mt-5">

        <div><a href="members.php" class="brand-color">< Back</a> </div>
        <div class="d-flex">
            <h1>Members / Inventory</h1>
            <div class="ml-auto"><input id="search" class="form-control mr-sm-2 search-bar" type="search" placeholder="Search..." aria-label="Search"></div>
        </div>
        <div id="table-check" class="table-responsive">
            <table id="inventory-table" class="table mt-4 table-borderless color-grey">
                <thead>
                <tr>
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

    <div id="add_data_Modal" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Add Product</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <form method="post" id="insert_form" class="eventInsForm">
                        <label>Model</label>
                        <input type="text" name="model" id="model" class="form-control auto" />
                        <br />
                        <label>Brand</label>
                        <select name="brand" id="brand" class="form-control">
                            <option value="">Select</option>
                            <option value="SAMSUNG">Samsung</option>
                            <option value="LG">LG</option>
                        </select>
                        <br />
                        <label>Main Category</label>
                        <input type="text" name="m-category" id="m-category" class="form-control" />
                        <br />
                        <label>Sub Category</label>
                        <input type="text" name="s-category" id="s-category" class="form-control" />
                        <br />
                        <label>Quantity</label>
                        <input type="number" name="quantity" id="quantity" class="form-control" />
                        <br />
                        <label>Price</label>
                        <input type="number" step="any" name="price" id="price" class="form-control" />
                        <br />
                        <div class="d-flex"><div class="ml-auto"><input type="submit" name="insert" id="insert" value="Add" class="btn brand-button" /></div></div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>


    <script>

        $(document).ready(function() {


            console.log($("#search").val());

            $("#search").on('change keyup paste input', function() {
                getInventoryByCompany($("#search").val(),'<?= $_GET['name'];?>');
            });

            getInventoryByCompany($("#search").val(),'<?= $_GET['name'];?>');

            function getInventoryByCompany(termValue,termValue2) {


                //console.log(termValue);
                $.get("includes/getInventoryByMember.php", {term: termValue, term2 : termValue2}, function (data) {
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

            //autocomplete
            $(".auto").autocomplete({
                source: "includes/searchProduct.php",
                minLength: 1,
                select: function (e, ui) {

                    console.log("click");
                    console.log(ui.item['value']);
                    var term = ui.item['value'];
                    console.log(ui);

                    $.get("includes/getProduct.php", {term: term}, function (data) {
                        var data = jQuery.parseJSON(data);
                        console.log(data);
                        console.log(data['category']);
                        $('#brand').val(data['brand']);
                        $('#m-category').val(data['category']);
                        $('#s-category').val(data['subcategory']);
                    });
                }
            });

            $(".auto").autocomplete( "option", "appendTo", ".eventInsForm" );

            //insert product
            $('form').submit(function (event) {
                event.preventDefault();

                // get the form data
                var formData = {


                    'model': $('[name=model]').val(),
                    'brand': $('[name=brand]').val(),
                    'category': $('[name=m-category]').val(),
                    'subcategory': $('[name=s-category]').val(),
                    'quantity': $('[name=quantity]').val(),
                    'price': $('[name=price]').val(),
                    'name' : '<?= $_COOKIE['name']?>'

                };

                console.log(formData);

                // process the form
                $.ajax({
                    type: 'POST', // define the type of HTTP verb we want to use (POST for our form)
                    url: 'aapi/api.php?apicall=createproduct', // the url where we want to POST
                    data: formData, // our data object
                    dataType: 'json', // what type of data do we expect back from the server
                    encode: true
                })
                // using the done promise callback
                    .done(function (data) {

                        console.log(data)

                        var message;
                        if (data.error == 0) {
                            message = "Success! \n";
                            $('#add_data_Modal').modal('toggle');
                            getInventoryByCompany($("#search").val(),'<?= $_COOKIE['name'];?>');

                        } else {
                            message = "Failed! \n"
                        }

                        message += data.message;
                        alert(message);


                    });
            });

        });


    </script>

<?php
require("includes/bottom.php");
?>