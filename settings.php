<?php
require("includes/top.php");
require("includes/getUser.php");
?>

<div class="container-fluid mx-4 mt-5">
    <h1 class="mt-4">Settings</h1>

    <div class="row">
        <div class="col-12 col-md-4">
            <div class="mt-5 text-center">
                <h3><?= $user['name'] ?></h3>
            </div>
            <div class="row mt-5 px-5">
                <div class="col-6">
                    <h5 class="small color-grey">Effective Date</h5>
                    <span><?php $dateEf = date_create($user['effective_date']); echo date_format($dateEf,'j M Y') ?></span>
                </div>
                <div class="col-6">
                    <h5 class="small color-grey">Expiration Date</h5>
                    <span><?php $dateEx = date_create($user['expiration_date']); echo date_format($dateEx,'j M Y') ?></span>
                </div>
                <div class="col-12 mt-3">
                    <h5 class="small color-grey">Payment Plan</h5>
                    <span><?= $user['membership_type'] ?></span>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-8 border-left">
            <div class="mt-5 ml-4 px-2 pb-2">
                <div class="row">
                    <div id="company-info-button" class="col-3 pb-1 tab selected-tab">Company Info</div>
                    <div id="contact-info-button" class="col-3 pb-1 border-bottom color-grey tab">Contact Info</div>
                    <div id="password-change-button" class="col-3 pb-1 border-bottom color-grey tab">Password Change</div>
                </div>
                <div id="company-info" class="ml-2 mt-4">
                    <div class="small color-grey">Company Address</div>
                    <div id="address-street"><?= $user['address_street'] ?></div>
                    <div id="address-city"><?= $user['address_city'] ?></div>
                    <div id="address-province"><?= $user['address_province'] ?></div>
                    <div id="address-postalcode"><?= $user['address_postalcode'] ?></div>

                    <div class="small mt-4 color-grey">Phone</div>
                    <div id="phone"><?= $user['phone'] ?></div>

                    <div class="small mt-4 color-grey">Email</div>
                    <div id="email"><?= $user['email'] ?></div>

                    <div class="small mt-4 color-grey">Website</div>
                    <div id="website"><?= $user['website'] ?></div>
                </div>

                <div id="contact-info" class="ml-2 mt-4 d-none">
                    <div class="small mt-4 color-grey">Contact Name</div>
                    <div id="contact-name"><?= $user['contact_name'] ?></div>
                    <div class="small mt-4 color-grey">Contact Email</div>
                    <div id="contact-name"><?= $user['contact_email'] ?></div>
                </div>

                <div id="password-change" class="ml-2 mt-4 d-none">
                    <div class="small mt-4 color-grey">Change Password</div>
                    <input class="form-control mr-sm-2 mt-3 search-bar" placeholder="New Password">
                    <input class="form-control mr-sm-2 mt-3 search-bar" placeholder="Confirm Password">
                    <button class="btn brand-button mt-3">Change Password</button>
                </div>

            </div>
        </div>
    </div>

</div>

<script>
    $("#company-info-button").click(function() {
        $("#company-info").removeClass('d-none');
        $("#contact-info").addClass('d-none');
        $("#password-change").addClass('d-none');
        $("#company-info-button").addClass('selected-tab');
        $("#company-info-button").removeClass('border-bottom color-grey');
        $("#contact-info-button").removeClass('selected-tab');
        $("#password-change-button").removeClass('selected-tab');
        $("#contact-info-button").addClass('border-bottom color-grey');
        $("#password-change-button").addClass('border-bottom color-grey');
    });

    $("#contact-info-button").click(function() {
        $("#company-info").addClass('d-none');
        $("#contact-info").removeClass('d-none');
        $("#password-change").addClass('d-none');
        $("#contact-info-button").addClass('selected-tab');
        $("#contact-info-button").removeClass('border-bottom color-grey');
        $("#company-info-button").removeClass('selected-tab');
        $("#password-change-button").removeClass('selected-tab');
        $("#company-info-button").addClass('border-bottom color-grey');
        $("#password-change-button").addClass('border-bottom color-grey');
    });

    $("#password-change-button").click(function() {
        $("#company-info").addClass('d-none');
        $("#contact-info").addClass('d-none');
        $("#password-change").removeClass('d-none');
        $("#password-change-button").addClass('selected-tab');
        $("#password-change-button").removeClass('border-bottom color-grey');
        $("#company-info-button").removeClass('selected-tab');
        $("#contact-info-button").removeClass('selected-tab');
        $("#company-info-button").addClass('border-bottom color-grey');
        $("#contact-info-button").addClass('border-bottom color-grey');
    });
</script>

<?php
require("includes/bottom.php");
?>
