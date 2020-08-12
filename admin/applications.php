<?php
require("../includes/adminTop.php");
?>

    <div class="container-fluid mx-4 mt-5">

        <h1 class="mt-4">Admin / Applications</h1>
        <div class=" d-flex mx-0 mr-5 pt-2">
            <div class="mr-3"><button class="btn button-grey">Action on <span id="check-count">0</span> selected</button> </div>
            <div class=""><input id="search" class="form-control mr-sm-2 search-bar" type="search" placeholder="Search..." aria-label="Search"></div>
        </div>
        <div id="table-check" class="table-responsive">
            <table id="application-table" class="table mt-4 table-borderless color-grey">
                <thead>
                <tr>
                    <th><input formmethod="select_all" name="select_all" value="1" type="checkbox"></th>
                    <th>Company Name</th>
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


            console.log($("#search").val());

            $("#search").on('change keyup paste input', function() {
                getApplications($("#search").val());
            });

            getApplications($("#search").val());

            function getApplications(termValue) {


                //console.log(termValue);
                $.get("../includes/a_getApplications.php", {term: termValue}, function (data) {
                    // Display the returned data in browser
                    $("#table-body").html(data);
                    //console.log(data);
                });
            }


            var dataTable = document.getElementById('application-table');
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
require("../includes/adminBottom.php");
?>