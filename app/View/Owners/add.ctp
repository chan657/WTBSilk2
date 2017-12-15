
<?php
$this->Html->addCrumb('Add Owner', 'javascript:void(0);', array('class' => 'breadcrumblast'));
?>

<div class="col-sm-12" id="mycl-det">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h4 class="panel-title">Add Information</h4>
        </div>
        <div class="panel-body">
            <fieldset>
                <legend><span>Add Owner</span></legend>
            </fieldset>
            <div class="row">
                <div class="col-sm-12">
                    <?php
                    echo $this->Form->create('Owner', array('method' => 'post', 'id' => 'wizard_a', 'novalidate' => true,
                        'inputDefaults' => array(
                            'label' => false,
                            'div' => false,
                            'class' => 'form-control',
                        )
                    ));
                    ?>

                    <h4>Primary Information</h4>
                    <fieldset class="nopdng">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="reg_input_name" class="req">Owner Name</label>
                                        <span class="colon">:</span>
                                        <div class="col-sm-10"> <?php echo $this->Form->input('owner_name', array('data-required' => 'true', 'tabindex' => '1')); ?></div>
                                    </div>

                                    <div class="form-group">
                                        <label>Board Email</label>
                                        <span class="colon">:</span>
                                        <div class="col-sm-10"> <?php echo $this->Form->input('owner_boardemail', array('tabindex' => '3')); ?></div>
                                    </div>
                                    <div class="form-group">
                                        <label>Website</label>
                                        <span class="colon">:</span>
                                        <div class="col-sm-10"> <?php echo $this->Form->input('owner_website', array('tabindex' => '5')); ?></div>
                                    </div>


                                </div>

                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="input_name" class="req">Primary City</label>
                                        <span class="colon">:</span>
                                        <div class="col-sm-10">
                                            <?php
                                            echo $this->Form->input('owner_primarycity', array('options' => $city, 'empty' => '--Select--', 'data-required' => 'true', 'onchange' => 'filterPreferences(this.value,\'OwnerOwnerSecondarycity\',\'OwnerOwnerTertiarycity\',\'OwnerCity4\',\'OwnerCity5\')', 'tabindex' => '1'));
                                            ?></div>
                                    </div>
                                    <div class="form-group slt-sm">
                                        <label>Board Number</label>
                                        <span class="colon">:</span>
                                        <div class="col-sm-10">
                                            <?php
                                            echo $this->Form->input('owner_boardnumber_code', array('options' => $codes, 'default' => '76', 'empty' => '--Select--'));
                                            echo $this->Form->input('owner_boardnumber', array('class' => 'form-control sm rgt', 'tabindex' => '4'));
                                            ?></div>
                                    </div>

                                </div>
                                <br class="spacer" />
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label>Owner Description</label>
                                        <span class="colon">:</span>
                                        <div class="col-sm-10 editable txtbox">
                                            <?php
                                            echo $this->Form->input('owner_description', array('type' => 'textarea', 'tabindex' => '6'));
                                            ?></div>
                                    </div>
                                    <div class="form-group">
                                        <label>Corporate Address</label>
                                        <span class="colon">:</span>
                                        <div class="col-sm-10 editable txtbox">
                                            <?php
                                            echo $this->Form->input('owner_corporateaddress', array('type' => 'textarea', 'tabindex' => '7'));
                                            ?></div>
                                    </div>
                                </div>

                            </div>


                        </div>

                    </fieldset>

                    <h4>Owner Operations</h4>
                    <fieldset class="nopdng">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="col-sm-12">
                                    <h4>Multicity Operations</h4>
                                    <div class="form-group">
                                        <label for="reg_input_name">Secondary Cities</label>
                                        <span class="colon">:</span>
                                        <div class="col-sm-10 editable txtbox">
                                            <div class="row" id="fr-select">
                                                <div class="col-sm-3">
                                                    <?php
                                                    echo $this->Form->input('owner_secondarycity', array('options' => $city, 'empty' => '--Secondary City--', 'class' => 'form-control', 'onchange' => 'filterPreferences(this.value,\'OwnerOwnerPrimarycity\',\'OwnerOwnerTertiarycity\',\'OwnerCity4\',\'OwnerCity5\')', 'tabindex' => '8'));
                                                    ?>
                                                </div>
                                                <div class="col-sm-3">
                                                    <?php
                                                    echo $this->Form->input('owner_tertiarycity', array('options' => $city, 'empty' => '--Tertiary City--', 'class' => 'form-control city_custom', 'onchange' => 'filterPreferences(this.value,\'OwnerOwnerPrimarycity\',\'OwnerOwnerSecondarycity\',\'OwnerCity4\',\'OwnerCity5\')', 'tabindex' => '9'));
                                                    ?>
                                                </div>
                                                <div class="col-sm-3">
                                                    <?php
                                                    echo $this->Form->input('city_4', array('options' => $city, 'empty' => '--City 4--', 'class' => 'form-control city_custom', 'onchange' => 'filterPreferences(this.value,\'OwnerOwnerPrimarycity\',\'OwnerOwnerSecondarycity\',\'OwnerOwnerTertiarycity\',\'OwnerCity5\')', 'tabindex' => '10'));
                                                    ?>
                                                </div>
                                                <div class="col-sm-3">
                                                    <?php
                                                    echo $this->Form->input('city_5', array('options' => $city, 'empty' => '--City 5--', 'class' => 'form-control city_custom', 'onchange' => 'filterPreferences(this.value,\'OwnerOwnerPrimarycity\',\'OwnerOwnerSecondarycity\',\'OwnerOwnerTertiarycity\',\'OwnerCity4\')', 'tabindex' => '11'));
                                                    ?></div></div></div>
                                    </div>
                                </div>

                                <div class="col-sm-12">
                                    <h4>Construction Capabilities</h4>
                                    <div class="form-group">
                                        <label for="input_name" class="req">Constructions</label>
                                        <span class="colon">:</span>
                                        <div class="col-sm-10 editable txtbox">
                                            <div class="row" id="fr-select">
                                                <div class="col-sm-3">
                                                    <?php echo $this->Form->input('owner_highendresidential', array('options' => array('1' => 'Yes', '2' => 'No'), 'empty' => '--High End Residential--', 'data-required' => 'true', 'tabindex' => '12')); ?>
                                                </div>
                                                <div class="col-sm-3">
                                                    <?php echo $this->Form->input('owner_residential', array('options' => array('1' => 'Yes', '2' => 'No'), 'empty' => '--Residential--', 'data-required' => 'true', 'tabindex' => '13')); ?>
                                                </div>
                                                <div class="col-sm-3">
                                                    <?php echo $this->Form->input('owner_commercial', array('options' => array('1' => 'Yes', '2' => 'No'), 'empty' => '--Commercial--', 'data-required' => 'true', 'tabindex' => '14')); ?>
                                                </div>
                                            </div></div>
                                    </div>
                                </div>

                                <div class="col-sm-12">
                                    <h4>Ratings</h4>
                                    <div class="form-group">
                                        <label for="reg_input_name">Ratings</label>
                                        <span class="colon">:</span>
                                        <div class="col-sm-10 editable txtbox">
                                            <div class="row" id="fr-select">
                                                <div class="col-sm-3">
                                                    <?php
                                                    echo $this->Form->input('owner_rating', array('value' => '100000', 'readonly' => 'readonly'));
                                                    ?>
                                                </div>
                                                <div class="col-sm-3">
                                                    <?php
                                                    echo $this->Form->input('owner_brandrecognition', array('value' => '100000', 'readonly' => 'readonly'));
                                                    ?>
                                                </div>
                                                <div class="col-sm-3">
                                                    <?php
                                                    echo $this->Form->input('owner_qualityofconstruction', array('value' => '100000', 'readonly' => 'readonly'));
                                                    ?>
                                                </div>
                                                <div class="col-sm-3">
                                                    <?php
                                                    echo $this->Form->input('owner_timelydelivery', array('value' => '100000', 'readonly' => 'readonly'));
                                                    ?></div>
                                                <div class="col-sm-3">
                                                    <?php
                                                    echo $this->Form->input('owner_pasttrackrecord', array('value' => '100000', 'readonly' => 'readonly'));
                                                    ?></div>
                                                <div class="col-sm-3">
                                                    <?php
                                                    echo $this->Form->input('owner_professionalismandtransparency', array('value' => '100000', 'readonly' => 'readonly'));
                                                    ?></div>              
                                            </div></div>
                                    </div>
                                </div>


                            </div>
                        </div>
                    </fieldset>


                    <h4>Owner Contacts</h4>
                    <fieldset class="nopdng">
                        <div class="row">

                            <div class="col-sm-12">
                                <div class="cont-det">
                                    <p>Do you have contact details?</p>
                                    <?php echo $this->Form->checkbox('is_contact', array('id' => 'is_contact')); ?>
                                    <label>Yes</label> 
                                </div>
                                <div class="row form-wrap">
                                    <div class="inactive-form"></div>
                                    <div class="col-sm-6">

                                        <h4>Contact Details</h4>
                                        <div class="form-group">
                                            <label>Owner Name</label>
                                            <span class="colon">:</span>
                                            <div class="col-sm-10"> <?php echo $this->Form->input('owner_text', array('class' => 'form-control owner_text', 'readonly' => 'readonly')); ?></div>
                                        </div>
                                        <div class="form-group">
                                            <label class="required">Contact Name</label>
                                            <span class="colon">:</span>
                                            <div class="col-sm-10"> <?php echo $this->Form->input('owner_contact_name', array('class' => 'form-control data_required', 'tabindex' => '16')); ?></div>
                                        </div>

                                        <div class="form-group slt-sm">
                                            <label class="required">Primary Mobile</label>
                                            <span class="colon">:</span>
                                            <div class="col-sm-10">
                                                <?php
                                                echo $this->Form->input('owner_contact_mobile_country_code', array('options' => $codes, 'default' => '76', 'empty' => '--Select--'));
                                                echo $this->Form->input('owner_contact_mobile_no', array('class' => 'form-control sm rgt data_required', 'tabindex' => '18'));
                                                ?></div>
                                        </div>

                                        <div class="form-group">
                                            <label for="email">Email Address</label>
                                            <span class="colon">:</span>
                                            <div class="col-sm-10">  <?php echo $this->Form->input('owner_contact_email', array('tabindex' => '20')); ?></div>
                                        </div>
                                        <div class="form-group">
                                            <label class="required">For Company</label>
                                            <span class="colon">:</span>
                                            <div class="col-sm-10"><?php echo $this->Form->input('owner_contact_company', array('options' => $for_company, 'empty' => '--Select--', 'class' => 'form-control data_required', 'tabindex' => '22')); ?></div>
                                        </div>






                                    </div>

                                    <div class="col-sm-6">
                                        <h4>&nbsp;</h4>
                                        <div class="form-group">
                                            <label class="required">Contact Level</label>
                                            <span class="colon">:</span>
                                            <div class="col-sm-10">  <?php echo $this->Form->input('owner_contact_level', array('options' => $contact_level, 'empty' => '--Select--', 'class' => 'form-control data_required', 'tabindex' => '15')); ?></div>
                                        </div>
                                        <div class="form-group">
                                            <label class="required">Designation</label>
                                            <span class="colon">:</span>
                                            <div class="col-sm-10">
                                                <?php
                                                echo $this->Form->input('owner_contact_designation', array('class' => 'form-control data_required', 'tabindex' => '17'));
                                                ?></div>
                                        </div>
                                        <div class="form-group slt-sm">
                                            <label>Secondary Mobile</label>
                                            <span class="colon">:</span>
                                            <div class="col-sm-10">  <?php
                                                echo $this->Form->input('owner_contact_secondary_mobile_country_code', array('options' => $codes, 'default' => '76', 'empty' => '--Select--'));
                                                echo $this->Form->input('owner_contact_secondary_mobile_no', array('class' => 'form-control sm rgt', 'tabindex' => '19'));
                                                ?></div>
                                        </div>  

                                        <div class="form-group">
                                            <label class="required">Location</label>
                                            <span class="colon">:</span>
                                            <div class="col-sm-10">  <?php echo $this->Form->input('owner_contact_location', array('options' => $city, 'empty' => '--Select--', 'class' => 'form-control data_required', 'tabindex' => '21')); ?></div>
                                        </div>
                                        <div class="form-group">
                                            <label for="input_name">For Company City</label>
                                            <span class="colon">:</span>
                                            <div class="col-sm-10"><?php echo $this->Form->input('owner_contact_company_city', array('options' => $city, 'empty' => '--Select--', 'tabindex' => '23')); ?></div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </fieldset>



<?php echo $this->Form->end(); ?>
                </div>
            </div>

        </div>
    </div>


</div>

<script>
    $(document).ready(function(e) {
        $("#is_contact").bind('click', function() {
            if ($(this).is(":checked")) {
                $(".inactive-form").hide();
            }
            else {
                $(".inactive-form").show();
            }
        });
    });
</script>
<script>

    $(document).ready(function() {


        $('#is_contact').change(function() {
            if ($(this).is(":checked") == true) {
                $(".required").addClass("req");
                //$( ".data_required" ).attr("data-required", "true");
                $('#wizard_a').attr('onsubmit', 'return validation_chk()');
                //$( ".data_required" ).addClass( "form-control parsley-validated parsley-error" );

            }
            else
            {
                $(".required").removeClass("req").addClass("required");
                //$(".data_required").removeAttr("data-required");
                $("#wizard_a").removeAttr("onsubmit");
                //	$( ".data_required" ).removeClass( "parsley-validated parsley-error" );
                //$( ".required" ).removeClass( "req" ).addClass( "required" );
            }
            /*
             var val= $(this).val();
             if(val == '1')
             {
             $( ".required" ).addClass( "req" );
             }
             */

        });

        $('#OwnerOwnerName').blur(function() {
            $('.owner_text').val($(this).val());

        });
        $('.city_custom').click(function(e) {
            var id = $(this).parent().prev('div').find('select').attr('id');
            var pref = $('#' + id).val();

            if (pref == '' || pref == null) {
                e.preventDefault();
                bootbox.dialog({
                    message: "Please select preference",
                    title: "Message",
                    buttons: {
                        success: {
                            label: "Got It!",
                            className: "btn-success",
                            callback: function() {
                            }
                        },
                        main: {
                            label: "More Info!",
                            className: "btn-primary",
                            callback: function() {
                                bootbox.alert('Information-<strong>Goes here..</strong>');
                            }
                        }
                    }

                });
            }

        });
        $('#OwnerOwnerPrimarycity').change(function() {
            $('#OwnerOwnerContactLocation').val($(this).val());
            $('#OwnerOwnerContactCompanyCity').val($(this).val());
        });
        $('#OwnerOwnerContactLocation').change(function(e) {
            var primary_city = $('#OwnerOwnerPrimarycity').val();
            e.preventDefault();
            bootbox.confirm("Are you sure?", function(result) {
                if (result == false) {
                    //alert('asd');
                    $('#OwnerOwnerContactLocation').val(primary_city);

                }
                //bootbox.alert("Confirm result: "+result);
            });
        });
        $('#OwnerOwnerContactCompanyCity').change(function(e) {
            var primary_city = $('#OwnerOwnerPrimarycity').val();
            e.preventDefault();
            bootbox.confirm("Are you sure?", function(result) {
                if (result == false) {
                    //alert('asd');
                    $('#OwnerOwnerContactCompanyCity').val(primary_city);

                }
                //bootbox.alert("Confirm result: "+result);
            });
        });
    });
    function validation_chk(e) {

        if ($('#OwnerOwnerContactLevel').val() == "")
        {
            bootbox.alert('Contact level can not be blank');
            return false;
        }

        if ($('#OwnerOwnerContactName').val() == "")
        {
            bootbox.alert('Contact name can not be blank');
            return false;
        }

        if ($('#OwnerOwnerContactDesignation').val() == "")
        {
            bootbox.alert('Contact designation can not be blank');
            return false;
        }
        if ($('#OwnerOwnerContactMobileNo').val() == "")
        {
            bootbox.alert('Contact number can not be blank');
            return false;
        }
        if ($('#OwnerOwnerContactLocation').val() == "")
        {
            bootbox.alert('Contact location can not be blank');
            return false;
        }
        if ($('#OwnerOwnerContactCompany').val() == "")
        {
            bootbox.alert('Contact company can not be blank');
            return false;
        }
    }

</script>