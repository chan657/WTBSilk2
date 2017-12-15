
<?php
$this->Html->addCrumb('Add Partner', 'javascript:void(0);', array('class' => 'breadcrumblast'));
?>

<div class="col-sm-12" id="mycl-det">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h4 class="panel-title">Add Information</h4>
        </div>
        <div class="panel-body">
            <fieldset>
                <legend><span>Add Partner</span></legend>
            </fieldset>
            <div class="row">
                <div class="col-sm-12">
                    <?php
                    echo $this->Form->create('MarketingPartner', array('method' => 'post', 'id' => 'wizard_a', 'novalidate' => true,
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
                                        <label for="reg_input_name" class="req">Partner Name</label>
                                        <span class="colon">:</span>
                                        <div class="col-sm-10"> <?php echo $this->Form->input('marketing_partner_display_name', array('data-required' => 'true', 'tabindex' => '1')); ?></div>
                                    </div>

                                    <div class="form-group">
                                        <label>Board Email</label>
                                        <span class="colon">:</span>
                                        <div class="col-sm-10"> <?php echo $this->Form->input('marketing_partner_boardemail', array('tabindex' => '3')); ?></div>
                                    </div>
                                    <div class="form-group">
                                        <label>Website</label>
                                        <span class="colon">:</span>
                                        <div class="col-sm-10"> <?php echo $this->Form->input('marketing_partner_website', array('tabindex' => '5')); ?></div>
                                    </div>


                                </div>

                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="reg_input_name" class="req">Partner Legal Name</label>
                                        <span class="colon">:</span>
                                        <div class="col-sm-10"> <?php echo $this->Form->input('marketing_partner_legal_name', array('data-required' => 'true', 'tabindex' => '1')); ?></div>
                                    </div>
                                    <div class="form-group">
                                        <label for="input_name" class="req">Primary City</label>
                                        <span class="colon">:</span>
                                        <div class="col-sm-10">
                                            <?php
                                            echo $this->Form->input('marketing_partner_primarycity', array('options' => $city, 'empty' => '--Select--', 'data-required' => 'true', 'onchange' => 'filterPreferences(this.value,\'MarketingPartnerMarketingPartnerSecondarycity\',\'MarketingPartnerMarketingPartnerCity4\',\'MarketingPartnerMarketingPartnerTertiarycity\',\'MarketingPartnerMarketingPartnerCity5\')', 'tabindex' => '1'));
                                            ?></div>
                                    </div>
                                    <div class="form-group slt-sm">
                                        <label>Board Number</label>
                                        <span class="colon">:</span>
                                        <div class="col-sm-10">
                                            <?php
                                            echo $this->Form->input('marketing_partner_boardnumber_code', array('options' => $codes, 'default' => '76', 'empty' => '--Select--'));
                                            echo $this->Form->input('marketing_partner_boardnumber', array('class' => 'form-control sm rgt', 'tabindex' => '4'));
                                            ?></div>
                                    </div>

                                </div>
                                <br class="spacer" />
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label>Partner Description</label>
                                        <span class="colon">:</span>
                                        <div class="col-sm-10 editable txtbox">
                                            <?php
                                            echo $this->Form->input('marketing_partner_description', array('type' => 'textarea', 'tabindex' => '6'));
                                            ?></div>
                                    </div>
                                    <div class="form-group">
                                        <label>Corporate Address</label>
                                        <span class="colon">:</span>
                                        <div class="col-sm-10 editable txtbox">
                                            <?php
                                            echo $this->Form->input('marketing_partner_corporateaddress', array('type' => 'textarea', 'tabindex' => '7'));
                                            ?></div>
                                    </div>
                                </div>

                            </div>


                        </div>

                    </fieldset>

                    <h4>Partner Operations</h4>
                    <fieldset class="nopdng">
                        <div class="row">
                            <div class="col-sm-12">
                                <h4>Multicity Operations</h4>
                                <div class="form-group">
                                    <label for="reg_input_name">Secondary Cities</label>
                                    <span class="colon">:</span>
                                    <div class="col-sm-10 editable txtbox">
                                        <div class="row" id="fr-select">
                                            <div class="col-sm-3">
                                                <?php
                                                echo $this->Form->input('marketing_partner_secondarycity', array('options' => $city, 'empty' => '--Secondary City--', 'class' => 'form-control', 'onchange' => 'filterPreferences(this.value,\'MarketingPartnerMarketingPartnerTertiarycity\',\'MarketingPartnerMarketingPartnerCity4\',\'MarketingPartnerMarketingPartnerCity5\',\'MarketingPartnerMarketingPartnerPrimarycity\')', 'tabindex' => '8'));
                                                ?>
                                            </div>
                                            <div class="col-sm-3">
                                                <?php
                                                echo $this->Form->input('marketing_partner_tertiarycity', array('options' => $city, 'empty' => '--Tertiary City--', 'class' => 'form-control city_custom', 'onchange' => 'filterPreferences(this.value,\'MarketingPartnerMarketingPartnerSecondarycity\',\'MarketingPartnerMarketingPartnerCity4\',\'MarketingPartnerMarketingPartnerCity5\',\'MarketingPartnerMarketingPartnerPrimarycity\')', 'tabindex' => '9'));
                                                ?>
                                            </div>
                                            <div class="col-sm-3">
                                                <?php
                                                echo $this->Form->input('marketing_partner_city_4', array('options' => $city, 'empty' => '--City 4--', 'class' => 'form-control city_custom', 'onchange' => 'filterPreferences(this.value,\'MarketingPartnerMarketingPartnerSecondarycity\',\'MarketingPartnerMarketingPartnerTertiarycity\',\'MarketingPartnerMarketingPartnerCity5\',\'MarketingPartnerMarketingPartnerPrimarycity\')', 'tabindex' => '10'));
                                                ?>
                                            </div>
                                            <div class="col-sm-3">
                                                <?php
                                                echo $this->Form->input('marketing_partner_city_5', array('options' => $city, 'empty' => '--City 5--', 'class' => 'form-control city_custom', 'onchange' => 'filterPreferences(this.value,\'MarketingPartnerMarketingPartnerSecondarycity\',\'MarketingPartnerMarketingPartnerCity4\',\'MarketingPartnerMarketingPartnerTertiarycity\',\'MarketingPartnerMarketingPartnerPrimarycity\')', 'tabindex' => '11'));
                                                ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </fieldset>


                    <h4>Partner Contacts</h4>
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
                                            <label for="reg_input_name" class="req">Partner Name</label>
                                            <span class="colon">:</span>
                                            <div class="col-sm-10"> <?php echo $this->Form->input('builder_text', array('class' => 'form-control builder_text', 'readonly' => 'readonly')); ?></div>
                                        </div>
                                        <div class="form-group">
                                            <label for="reg_input_name" class="req">Contact Name</label>
                                            <span class="colon">:</span>
                                            <div class="col-sm-10"> <?php echo $this->Form->input('BuilderContact.builder_contact_name', array('class' => 'form-control data_required', 'tabindex' => '3')); ?></div>
                                        </div>

                                        <div class="form-group slt-sm">
                                            <label for="reg_input_name" class="req">Primary Mobile</label>
                                            <span class="colon">:</span>
                                            <div class="col-sm-10">
                                                <?php
                                                echo $this->Form->input('BuilderContact.builder_contact_mobile_country_code', array('options' => $codes, 'default' => '76', 'empty' => '--Select--', 'tabindex' => '5'));
                                                echo $this->Form->input('BuilderContact.builder_contact_mobile_no', array('class' => 'form-control sm rgt', 'tabindex' => '6'));
                                                ?></div>
                                        </div>

                                        <div class="form-group">
                                            <label for="email">Email Address</label>
                                            <span class="colon">:</span>
                                            <div class="col-sm-10">  <?php echo $this->Form->input('BuilderContact.builder_contact_email', array('tabindex' => '9')); ?></div>
                                        </div>
                                        <div class="form-group">
                                            <label for="reg_input_name" class="req">For Company</label>
                                            <span class="colon">:</span>
                                            <div class="col-sm-10"><?php echo $this->Form->input('BuilderContact.builder_contact_company', array('options' => $for_company, 'empty' => '--Select--', 'tabindex' => '11')); ?></div>
                                        </div>
                                    </div>

                                    <div class="col-sm-6">
                                        <h4>&nbsp;</h4>

                                        <div class="form-group">
                                            <label for="reg_input_name" class="req">Contact Level</label>
                                            <span class="colon">:</span>
                                            <div class="col-sm-10">  <?php echo $this->Form->input('BuilderContact.builder_contact_level', array('options' => $contact_level, 'empty' => '--Select--', 'tabindex' => '2')); ?></div>
                                        </div>
                                        <div class="form-group">
                                            <label for="reg_input_name" class="req">Designation</label>
                                            <span class="colon">:</span>
                                            <div class="col-sm-10">
                                                <?php
                                                echo $this->Form->input('BuilderContact.builder_contact_designation', array('class' => 'form-control', 'tabindex' => '4'));
                                                ?></div>
                                        </div>
                                        <div class="form-group slt-sm">
                                            <label>Secondary Mobile</label>
                                            <span class="colon">:</span>
                                            <div class="col-sm-10">  <?php
                                                echo $this->Form->input('BuilderContact.builder_contact_secondary_mobile_country_code', array('options' => $codes, 'default' => '76', 'empty' => '--Select--', 'tabindex' => '7'));
                                                echo $this->Form->input('BuilderContact.builder_contact_secondary_mobile_no', array('class' => 'form-control sm rgt', 'tabindex' => '8'));
                                                ?></div>
                                        </div>  

                                        <div class="form-group">
                                            <label for="reg_input_name" class="req">Location</label>
                                            <span class="colon">:</span>
                                            <div class="col-sm-10">  <?php echo $this->Form->input('BuilderContact.builder_contact_location', array('options' => $city, 'empty' => '--Select--', 'tabindex' => '10')); ?></div>
                                        </div>
                                        <div class="form-group">
                                            <label for="input_name" class="req">For Company City</label>
                                            <span class="colon">:</span>
                                            <div class="col-sm-10"><?php echo $this->Form->input('BuilderContact.builder_contact_company_city', array('options' => $city, 'empty' => '--Select--', 'tabindex' => '12')); ?></div>
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

    $(document).ready(function() {


        $('#is_contact').change(function() {
            if ($(this).is(":checked") == true) {
                $(".required").addClass("req");
                $(".inactive-form").hide();
                $('#wizard_a').attr('onsubmit', 'return validation_chk()');
                //$( ".data_required" ).addClass( "form-control parsley-validated parsley-error" );

            }
            else
            {
                $(".required").removeClass("req").addClass("required");
                $(".inactive-form").show();
                $("#wizard_a").removeAttr("onsubmit");
                //	$( ".data_required" ).removeClass( "parsley-validated parsley-error" );
                //$( ".required" ).removeClass( "req" ).addClass( "required" );
            }
        });
        
        $('#MarketingPartnerMarketingPartnerDisplayName').blur(function() {
            $('.builder_text').val($(this).val());

        });

        
        $('#MarketingPartnerMarketingPartnerPrimarycity').change(function() {
            $('#BuilderContactBuilderContactLocation').val($(this).val());
            $('#BuilderContactBuilderContactCompanyCity').val($(this).val());
        });
        $('#BuilderContactBuilderContactLocation').change(function(e) {
            var primary_city = $('#MarketingPartnerMarketingPartnerPrimarycity').val();
            e.preventDefault();
            bootbox.confirm("Are you sure?", function(result) {
                if (result == false) {
                    //alert('asd');
                    $('#BuilderContactBuilderContactLocation').val(primary_city);

                }
                //bootbox.alert("Confirm result: "+result);
            });
        });
        $('#BuilderContactBuilderContactCompanyCity').change(function(e) {
            var primary_city = $('#MarketingPartnerMarketingPartnerPrimarycity').val();
            e.preventDefault();
            bootbox.confirm("Are you sure?", function(result) {
                if (result == false) {
                    //alert('asd');
                    $('#BuilderContactBuilderContactCompanyCity').val(primary_city);

                }
                //bootbox.alert("Confirm result: "+result);
            });
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

    });
    
    function validation_chk(e) {

    
        
        if ($('#BuilderContactBuilderContactLevel').val() == "")
        {
            bootbox.alert('Contact level can not be blank');
            return false;
        }

        if ($('#BuilderContactBuilderContactName').val() == "")
        {
            bootbox.alert('Contact name can not be blank');
            return false;
        }

        if ($('#BuilderContactBuilderContactDesignation').val() == "")
        {
            bootbox.alert('Contact designation can not be blank');
            return false;
        }
        if ($('#BuilderContactBuilderContactLocation').val() == "")
        {
            bootbox.alert('Contact location can not be blank');
            return false;
        }
        if ($('#BuilderContactBuilderContactCompany').val() == "")
        {
            bootbox.alert('Contact company can not be blank');
            return false;
        }
        if ($('#BuilderContactBuilderContactCompanyCity').val() == "")
        {
            bootbox.alert('Contact company city can not be blank');
            return false;
        }

    }


</script>