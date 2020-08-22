</div>
<!-- /#page-content-wrapper -->

</div>
<!-- /#wrapper -->

<!-- Menu Toggle Script -->
<script>
    $("#menu-toggle").click(function(e) {
        e.preventDefault();
        $("#wrapper").toggleClass("toggled");
        $(".shrink").toggleClass("d-md-block");
        $("#list-group > a > span").each(function() {
            $( this ).toggleClass( "d-md-inline" );
        });
        $("#list-group").toggleClass("list-group");
        $("#brand-img-big").toggleClass( "d-md-inline" );
        $("#brand-img-small").toggleClass( "d-md-none" );
        $("#menu-toggle").toggleClass( "toggle-position" );
    });

    let url = window.location.href;
    if (url.includes('dashboard')){
        $("#dashboard-page > span").addClass('brand-color');
    }
    else if (url.includes('productsearch')){
        $("#product-page > span").addClass('brand-color');
    }
    else if (url.includes('inventory')){
        $("#inventory-page > span").addClass('brand-color');
    }
    else if (url.includes('member')){
        $("#members-page > span").addClass('brand-color');
    }
    else if (url.includes('settings')){
        $("#settings-page > span").addClass('brand-color');
    }

    $("#log-out").click(function(e) {
        e.preventDefault();
        document.cookie = "name= ; expires = Thu, 01 Jan 1970 00:00:00 GMT"
        document.cookie = "username= ; expires = Thu, 01 Jan 1970 00:00:00 GMT"
        window.location.href='login.php';
    });
</script>