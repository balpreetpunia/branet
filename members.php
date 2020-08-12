<?php
require("includes/top.php");
?>

    <div class="container-fluid mx-4 mt-5">

        <h1 class="mt-4">Members</h1>
        <div class="pt-2"><input id="search" class="form-control mr-sm-2 search-bar" value="" type="search" placeholder="Search..." aria-label="Search"></div>

        <table class="table mt-4 table-borderless table-responsive-md color-grey">
            <thead>
            <tr>
                <th>Inventory</th>
                <th>Company Name</th>
                <th>Contact Name</th>
                <th>City</th>
                <th>Province</th>
                <th>Phone</th>
                <th>Email</th>
            </tr>
            </thead>
            <tbody id="table-body">
            <?php //require("includes/getUsers.php");?>
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
            $.get("includes/getUsers.php", {term: termValue}, function (data) {
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