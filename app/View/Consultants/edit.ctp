<?php
$this->Html->addCrumb('Edit Consultant', 'javascript:void(0);', array('class' => 'breadcrumblast'));

$role_id = $this->Session->read("role_id");
if (($this->data['Consultant']['consultant_active_primary'] == '1' || $action_type == '0') && $role_id <> '27') {
    $consultant_active_primary = true;
    $label_active_primary = 'Waiting...';
} else {
    $consultant_active_primary = false;
    $label_active_primary = 'Update';
}

if (($this->data['Consultant']['consultant_active_operation'] == '1' || $action_type == '1') && $role_id <> '27') {
    $consultant_active_operation = true;
    $label_active_operation = 'Waiting...';
} else {
    $consultant_active_operation = false;
    $label_active_operation = 'Update';
}
if (($this->data['Consultant']['consultant_active_contact'] == '1' || $action_type == '2') && $role_id <> '27') {
    $consultant_active_contact = true;
    $label_active_contact = 'Waiting...';
} else {
    $consultant_active_contact = false;
    $label_active_contact = 'Update';
}
?>

<div class="col-sm-12" id="mycl-det">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h4 class="panel-title">Add Information</h4>
        </div>
        <div class="panel-body edtpro">
            <fieldset>
                <legend><span>Edit Consultant</span></legend>
            </fieldset>
            <div class="row">
                <div class="col-sm-12">
                    <?php
                    echo $this->Form->create('Consultant', array('method' => 'post', 'id' => 'wizard_b', 'novalidate' => true,
                        'inputDefaults' => array(
                            'label' => false,
                            'div' => false,
                            'class' => 'form-control',
                        )
                    ));
                    echo $this->Form->input('action_type', array('value' => '0', 'type' => 'hidden', 'id' => 'ActionType'));
                    ?>

                    <h4>Primary Information</h4>
                    <fieldset class="nopdng">

                        <div class="row">
                            <div class="col-sm-12">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="reg_input_name" class="req">Consultant Name</label>
                                        <span class="colon">:</span>
                                        <div class="col-sm-10"> <?php echo $this->Form->input('consultant_name', array('data-required' => 'true', 'tabindex' => '1')); ?></div>
                                    </div>

                                    <div class="form-group">
                                        <label>Board Email</label>
                                        <span class="colon">:</span>
                                        <div class="col-sm-10"> <?php echo $this->Form->input('consultant_boardemail', array('tabindex' => '3')); ?></div>
                                    </div>
                                    <div class="form-group">
                                        <label>Website</label>
                                        <span class="colon">:</span>
                                        <div class="col-sm-10"> <?php echo $this->Form->input('consultant_website', array('tabindex' => '5')); ?></div>
                                    </div>


                                </div>

                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="input_name" class="req">Primary City</label>
                                        <span class="colon">:</span>
                                        <div class="col-sm-10">
                                            <?php
                                            echo $this->Form->input('consultant_primarycity', array('options' => $city, 'empty' => '--Select--', 'data-required' => 'true', 'onchange' => 'filterPreferences(this.value,\'ConsultantConsultantSecondarycity\',\'ConsultantConsultantTertiarycity\',\'ConsultantCity4\',\'ConsultantCity5\')', 'tabindex' => '1'));
                                            ?></div>
                                    </div>
                                    <div class="form-group slt-sm">
                                        <label>Board Number</label>
                                        <span class="colon">:</span>
                                        <div class="col-sm-10">
                                            <?php
                                            echo $this->Form->input('consultant_boardnumber_code', array('options' => $codes, 'default' => '76', 'empty' => '--Select--'));
                                            echo $this->Form->input('consultant_boardnumber', array('class' => 'form-control sm rgt', 'tabindex' => '4'));
                                            ?></div>
                                    </div>

                                </div>
                                <br class="spacer" />
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label>Consultant Description</label>
                                        <span class="colon">:</span>
                                        <div class="col-sm-10 editable txtbox">
                                            <?php
                                            echo $this->Form->input('consultant_description', array('type' => 'textarea', 'tabindex' => '6'));
                                            ?></div>
                                    </div>
                                    <div class="form-group">
                                        <label>Corporate Address</label>
                                        <span class="colon">:</span>
                                        <div class="col-sm-10 editable txtbox">
                                            <?php
                                            echo $this->Form->input('consultant_corporateaddress', array('type' => 'textarea', 'tabindex' => '7'));
                                            ?></div>
                                    </div>
                                </div>

                            </div>


                        </div>
                        <div class="row">
                            <div class="col-sm-1">
                                <?php
                                echo $this->Form->submit($label_active_primary, array('class' => 'btn btn-success sticky_success', 'disabled' => $consultant_active_primary));
                                ?>
                                <!--<button type="submit" id="update_buttn" disabled="disabled" class="btn btn-success sticky_success">Update</button>-->

                            </div>



                        </div>  	



                    </fieldset>


                    <h4>Consultant Operations</h4>
                    <fieldset class="nopdng">
                        <div class="row">
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
                                                            echo $this->Form->input('consultant_secondarycity', array('options' => $city, 'empty' => '--Secondary City--', 'class' => 'form-control', 'onchange' => 'filterPreferences(this.value,\'ConsultantConsultantPrimarycity\',\'ConsultantConsultantTertiarycity\',\'ConsultantCity4\',\'ConsultantCity5\')', 'tabindex' => '8'));
                                                            ?>
                                                        </div>
                                                        <div class="col-sm-3">
                                                            <?php
                                                            echo $this->Form->input('consultant_tertiarycity', array('options' => $city, 'empty' => '--Tertiary City--', 'class' => 'form-control city_custom', 'onchange' => 'filterPreferences(this.value,\'ConsultantConsultantPrimarycity\',\'ConsultantConsultantSecondarycity\',\'ConsultantCity4\',\'ConsultantCity5\')', 'tabindex' => '9'));
                                                            ?>
                                                        </div>
                                                        <div class="col-sm-3">
                                                            <?php
                                                            echo $this->Form->input('city_4', array('options' => $city, 'empty' => '--City 4--', 'class' => 'form-control city_custom', 'onchange' => 'filterPreferences(this.value,\'ConsultantConsultantPrimarycity\',\'ConsultantConsultantSecondarycity\',\'ConsultantConsultantTertiarycity\',\'ConsultantCity5\')', 'tabindex' => '10'));
                                                            ?>
                                                        </div>
                                                        <div class="col-sm-3">
                                                            <?php
                                                            echo $this->Form->input('city_5', array('options' => $city, 'empty' => '--City 5--', 'class' => 'form-control city_custom', 'onchange' => 'filterPreferences(this.value,\'ConsultantConsultantPrimarycity\',\'ConsultantConsultantSecondarycity\',\'ConsultantConsultantTertiarycity\',\'ConsultantCity4\')', 'tabindex' => '11'));
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
                                                            <?php echo $this->Form->input('consultant_highendresidential', array('options' => array('1' => 'Yes', '2' => 'No'), 'empty' => '--High End Residential--', 'data-required' => 'true', 'tabindex' => '12')); ?>
                                                        </div>
                                                        <div class="col-sm-3">
                                                            <?php echo $this->Form->input('consultant_residential', array('options' => array('1' => 'Yes', '2' => 'No'), 'empty' => '--Residential--', 'data-required' => 'true', 'tabindex' => '13')); ?>
                                                        </div>
                                                        <div class="col-sm-3">
                                                            <?php echo $this->Form->input('consultant_commercial', array('options' => array('1' => 'Yes', '2' => 'No'), 'empty' => '--Commercial--', 'data-required' => 'true', 'tabindex' => '14')); ?>
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
                                                            echo $this->Form->input('consultant_rating', array('value' => '100000', 'readonly' => 'readonly'));
                                                            ?>
                                                        </div>
                                                        <div class="col-sm-3">
                                                            <?php
                                                            echo $this->Form->input('consultant_brandrecognition', array('value' => '100000', 'readonly' => 'readonly'));
                                                            ?>
                                                        </div>
                                                        <div class="col-sm-3">
                                                            <?php
                                                            echo $this->Form->input('consultant_qualityofconstruction', array('value' => '100000', 'readonly' => 'readonly'));
                                                            ?>
                                                        </div>
                                                        <div class="col-sm-3">
                                                            <?php
                                                            echo $this->Form->input('consultant_timelydelivery', array('value' => '100000', 'readonly' => 'readonly'));
                                                            ?></div>
                                                        <div class="col-sm-3">
                                                            <?php
                                                            echo $this->Form->input('consultant_pasttrackrecord', array('value' => '100000', 'readonly' => 'readonly'));
                                                            ?></div>
                                                        <div class="col-sm-3">
                                                            <?php
                                                            echo $this->Form->input('consultant_professionalismandtransparency', array('value' => '100000', 'readonly' => 'readonly'));
                                                            ?></div>              
                                                    </div></div>
                                            </div>
                                        </div>


                                    </div>
                                </div>
                            </fieldset>
                        </div>
                        <div class="row">
                            <div class="col-sm-1">
                                <?php
                                echo $this->Form->submit($label_active_operation, array('class' => 'btn btn-success sticky_success', 'disabled' => $consultant_active_operation));
                                ?>
                                <!--<button type="submit" id="update_buttn" disabled="disabled" class="btn btn-success sticky_success">Update</button>-->

                            </div>



                        </div>   
                    </fieldset>


                    <h4>Consultant Contacts</h4>
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
                                            <label>Consultant Name</label>
                                            <span class="colon">:</span>
                                            <div class="col-sm-10"> <?php echo $this->Form->input('consultant_text', array('class' => 'form-control consultant_text', 'value' => $this->data['Consultant']['consultant_name'], 'readonly' => 'readonly')); ?></div>
                                        </div>
                                        <div class="form-group">
                                            <label class="required">Contact Name</label>
                                            <span class="colon">:</span>
                                            <div class="col-sm-10"> <?php echo $this->Form->input('consultant_contact_name', array('class' => 'form-control data_required', 'tabindex' => '16')); ?></div>
                                        </div>

                                        <div class="form-group slt-sm">
                                            <label class="required">Primary Mobile</label>
                                            <span class="colon">:</span>
                                            <div class="col-sm-10">
                                                <?php
                                                echo $this->Form->input('consultant_contact_mobile_country_code', array('options' => $codes, 'default' => '76', 'empty' => '--Select--'));
                                                echo $this->Form->input('consultant_contact_mobile_no', array('class' => 'form-control sm rgt data_required', 'tabindex' => '18'));
                                                ?></div>
                                        </div>

                                        <div class="form-group">
                                            <label for="email">Email Address</label>
                                            <span class="colon">:</span>
                                            <div class="col-sm-10">  <?php echo $this->Form->input('consultant_contact_email', array('tabindex' => '20')); ?></div>
                                        </div>
                                        <div class="form-group">
                                            <label class="required">For Company</label>
                                            <span class="colon">:</span>
                                            <div class="col-sm-10"><?php echo $this->Form->input('consultant_contact_company', array('options' => $for_company, 'empty' => '--Select--', 'class' => 'form-control data_required', 'tabindex' => '22')); ?></div>
                                        </div>






                                    </div>

                                    <div class="col-sm-6">
                                        <h4>&nbsp;</h4>
                                        <div class="form-group">
                                            <label class="required">Contact Level</label>
                                            <span class="colon">:</span>
                                            <div class="col-sm-10">  <?php echo $this->Form->input('consultant_contact_level', array('options' => $contact_level, 'empty' => '--Select--', 'class' => 'form-control data_required', 'tabindex' => '15')); ?></div>
                                        </div>
                                        <div class="form-group">
                                            <label class="required">Designation</label>
                                            <span class="colon">:</span>
                                            <div class="col-sm-10">
                                                <?php
                                                echo $this->Form->input('consultant_contact_designation', array('class' => 'form-control data_required', 'tabindex' => '17'));
                                                ?></div>
                                        </div>
                                        <div class="form-group slt-sm">
                                            <label>Secondary Mobile</label>
                                            <span class="colon">:</span>
                                            <div class="col-sm-10">  <?php
                                                echo $this->Form->input('consultant_contact_secondary_mobile_country_code', array('options' => $codes, 'default' => '76', 'empty' => '--Select--'));
                                                echo $this->Form->input('consultant_contact_secondary_mobile_no', array('class' => 'form-control sm rgt', 'tabindex' => '19'));
                                                ?></div>
                                        </div>  

                                        <div class="form-group">
                                            <label class="required">Location</label>
                                            <span class="colon">:</span>
                                            <div class="col-sm-10">  <?php echo $this->Form->input('consultant_contact_location', array('options' => $city, 'empty' => '--Select--', 'class' => 'form-control data_required', 'tabindex' => '21')); ?></div>
                                        </div>
                                        <div class="form-group">
                                            <label for="input_name">For Company City</label>
                                            <span class="colon">:</span>
                                            <div class="col-sm-10"><?php echo $this->Form->input('consultant_contact_company_city', array('options' => $city, 'empty' => '--Select--', 'tabindex' => '23')); ?></div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-1">
                                <?php
                                echo $this->Form->submit($label_active_contact, array('class' => 'btn btn-success sticky_success', 'disabled' => $consultant_active_contact));
                                ?>
                                <!--<button type="submit" id="update_buttn" disabled="disabled" class="btn btn-success sticky_success">Update</button>-->

                            </div>
                        </div>
                    </fieldset>



<?php echo $this->Form->end(); ?>

  <!--<div class="actions clearfix"><ul aria-label="Pagination" role="menu"><li class="last_step" style="display: block;" aria-hidden="false"><?php echo $this->Form->button('Update', array('class' => 'btn btn-success sticky_success', 'id' => 'update_buttn')); ?> </li></ul></div>-->
                </div>
            </div>
        </div>
    </div>
</div>

<script>

    $(document).ready(function() {

        var is_contact = $('#is_contact').val();
        if (is_contact)
            $(".inactive-form").hide();
        $("#is_contact").bind('click', function() {
            if ($(this).is(":checked")) {
                $(".inactive-form").hide();
            }
            else {
                $(".inactive-form").show();
            }
        });

        $('#update_buttn').click(function() {
            $('#wizard_b').submit();
        });

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

        $('#ConsultantConsultantName').blur(function() {
            $('.consultant_text').val($(this).val());

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
        $('#ConsultantConsultantPrimarycity').change(function() {
            $('#ConsultantConsultantContactLocation').val($(this).val());
            $('#ConsultantConsultantContactCompanyCity').val($(this).val());
        });
        $('#ConsultantConsultantContactLocation').change(function(e) {
            var primary_city = $('#ConsultantConsultantPrimarycity').val();
            e.preventDefault();
            bootbox.confirm("Are you sure?", function(result) {
                if (result == false) {
                    //alert('asd');
                    $('#ConsultantConsultantContactLocation').val(primary_city);

                }
                //bootbox.alert("Confirm result: "+result);
            });
        });
        $('#ConsultantConsultantContactCompanyCity').change(function(e) {
            var primary_city = $('#ConsultantConsultantPrimarycity').val();
            e.preventDefault();
            bootbox.confirm("Are you sure?", function(result) {
                if (result == false) {
                    //alert('asd');
                    $('#ConsultantConsultantContactCompanyCity').val(primary_city);

                }
                //bootbox.alert("Confirm result: "+result);
            });
        });
    });
    function validation_chk(e) {

        if ($('#ConsultantConsultantContactLevel').val() == "")
        {
            bootbox.alert('Contact level can not be blank');
            return false;
        }

        if ($('#ConsultantConsultantContactName').val() == "")
        {
            bootbox.alert('Contact name can not be blank');
            return false;
        }

        if ($('#ConsultantConsultantContactDesignation').val() == "")
        {
            bootbox.alert('Contact designation can not be blank');
            return false;
        }
        if ($('#ConsultantConsultantContactMobileNo').val() == "")
        {
            bootbox.alert('Contact number can not be blank');
            return false;
        }
        if ($('#ConsultantConsultantContactLocation').val() == "")
        {
            bootbox.alert('Contact location can not be blank');
            return false;
        }
        if ($('#ConsultantConsultantContactCompany').val() == "")
        {
            bootbox.alert('Contact company can not be blank');
            return false;
        }
    }

</script>