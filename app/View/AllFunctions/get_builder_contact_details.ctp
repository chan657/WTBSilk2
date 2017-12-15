<?php if (count($contact_details) > 0 || !empty($contact_details)) { ?>
    <div class="col-sm-6">

        <div class="form-group">
            <label>Primary Mobile</label>
            <span class="colon">:</span>
            <div class="col-sm-10" style="padding-top:6px;"><?php echo $contact_details[0]['PrimaryMobileCountry']['code'] . ' ' . $contact_details[0]['BuilderContact']['builder_contact_mobile_no']; ?></div>
        </div>
        <div class="form-group">
            <label>Email Address</label>
            <span class="colon">:</span>
            <div class="col-sm-10" style="padding-top:6px;"><?php echo $contact_details[0]['BuilderContact']['builder_contact_email']; ?></div>
        </div>
        <div class="form-group">
            <label>For Company</label>
            <span class="colon">:</span>
            <div class="col-sm-10" style="padding-top:6px;"><?php echo $contact_details[0]['ForCompany']['value']; ?></div>
        </div>
    </div>
    <div class="col-sm-6">

        <div class="form-group">
            <label>Secondary Mobile</label>
            <span class="colon">:</span>
            <div class="col-sm-10" style="padding-top:6px;"> <?php echo $contact_details[0]['SecondMobileCountry']['code'] . ' ' . $contact_details[0]['BuilderContact']['builder_contact_secondary_mobile_no']; ?></div>
        </div>
        <div class="form-group">
            <label>Location</label>
            <span class="colon">:</span>
            <div class="col-sm-10" style="padding-top:6px;"> <?php echo $contact_details[0]['Location']['city_name']; ?></div>
        </div>
        <div class="form-group">
            <label>For Company City</label>
            <span class="colon">:</span>
            <div class="col-sm-10" style="padding-top:6px;"> <?php echo $contact_details[0]['ForCompanyCity']['city_name']; ?></div>
        </div>
    </div>
<?php
}?>