
<?php
$this->Html->addCrumb('Add Builder', 'javascript:void(0);', array('class' => 'breadcrumblast'));
?>

<div class="col-sm-12" id="mycl-det">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h4 class="panel-title">Add Information</h4>
        </div>
        <div class="panel-body">
            <fieldset>
                <legend><span>Add Builder</span></legend>
            </fieldset>
            <div class="row">
                <div class="col-sm-12">
<?php
echo $this->Form->create('Builder', array('method' => 'post', 'id' => 'wizard_a', 'novalidate' => true,
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
                                        <label for="reg_input_name" class="req">Builder Name</label>
                                        <span class="colon">:</span>
                                        <div class="col-sm-10"> <?php echo $this->Form->input('builder_name', array('data-required' => 'true', 'tabindex' => '1')); ?></div>
                                    </div>

                                    <div class="form-group">
                                        <label>Board Email</label>
                                        <span class="colon">:</span>
                                        <div class="col-sm-10"> <?php echo $this->Form->input('builder_boardemail', array('tabindex' => '3')); ?></div>
                                    </div>
                                    <div class="form-group">
                                        <label>Website</label>
                                        <span class="colon">:</span>
                                        <div class="col-sm-10"> <?php echo $this->Form->input('builder_website', array('tabindex' => '5')); ?></div>
                                    </div>


                                </div>

                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="input_name" class="req">Primary City</label>
                                        <span class="colon">:</span>
                                        <div class="col-sm-10">
<?php
echo $this->Form->input('builder_primarycity', array('options' => $city, 'empty' => '--Select--', 'data-required' => 'true', 'onchange' => 'filterPreferences(this.value,\'BuilderBuilderTertiarycity\',\'BuilderCity4\',\'BuilderBuilderSecondarycity\',\'BuilderCity5\')', 'tabindex' => '1'));
?></div>
                                    </div>
                                    <div class="form-group slt-sm">
                                        <label>Board Number</label>
                                        <span class="colon">:</span>
                                        <div class="col-sm-10">
<?php
echo $this->Form->input('builder_boardnumber_code', array('options' => $codes, 'default' => '76', 'empty' => '--Select--'));
echo $this->Form->input('builder_boardnumber', array('class' => 'form-control sm rgt', 'tabindex' => '4'));
?></div>
                                    </div>

                                </div>
                                <br class="spacer" />
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label>Builder Description</label>
                                        <span class="colon">:</span>
                                        <div class="col-sm-10 editable txtbox">
<?php
echo $this->Form->input('builder_description', array('type' => 'textarea', 'tabindex' => '6'));
?></div>
                                    </div>
                                    <div class="form-group">
                                        <label>Corporate Address</label>
                                        <span class="colon">:</span>
                                        <div class="col-sm-10 editable txtbox">
                                            <?php
                                            echo $this->Form->input('builder_corporateaddress', array('type' => 'textarea', 'tabindex' => '7'));
                                            ?></div>
                                    </div>
                                </div>

                            </div>


                        </div>

                    </fieldset>

                    <h4>Builder Operations</h4>
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
echo $this->Form->input('builder_secondarycity', array('options' => $city, 'empty' => '--Secondary City--', 'class' => 'form-control', 'onchange' => 'filterPreferences(this.value,\'BuilderBuilderTertiarycity\',\'BuilderCity4\',\'BuilderCity5\',\'BuilderBuilderPrimarycity\')', 'tabindex' => '8'));
?>
                                                </div>
                                                <div class="col-sm-3">
<?php
echo $this->Form->input('builder_tertiarycity', array('options' => $city, 'empty' => '--Tertiary City--', 'class' => 'form-control city_custom', 'onchange' => 'filterPreferences(this.value,\'BuilderBuilderSecondarycity\',\'BuilderCity4\',\'BuilderCity5\',\'BuilderBuilderPrimarycity\')', 'tabindex' => '9'));
?>
                                                </div>
                                                <div class="col-sm-3">
                                                    <?php
                                                    echo $this->Form->input('city_4', array('options' => $city, 'empty' => '--City 4--', 'class' => 'form-control city_custom', 'onchange' => 'filterPreferences(this.value,\'BuilderBuilderSecondarycity\',\'BuilderBuilderTertiarycity\',\'BuilderCity5\',\'BuilderBuilderPrimarycity\')', 'tabindex' => '10'));
                                                    ?>
                                                </div>
                                                <div class="col-sm-3">
                                                    <?php
                                                    echo $this->Form->input('city_5', array('options' => $city, 'empty' => '--City 5--', 'class' => 'form-control city_custom', 'onchange' => 'filterPreferences(this.value,\'BuilderBuilderSecondarycity\',\'BuilderCity4\',\'BuilderBuilderTertiarycity\',\'BuilderBuilderPrimarycity\')', 'tabindex' => '11'));
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
<?php echo $this->Form->input('builder_highendresidential', array('options' => array('1' => 'Yes', '2' => 'No'), 'empty' => '--High End Residential--', 'data-required' => 'true', 'tabindex' => '12')); ?>
                                                </div>
                                                <div class="col-sm-3">
<?php echo $this->Form->input('builder_residential', array('options' => array('1' => 'Yes', '2' => 'No'), 'empty' => '--Residential--', 'data-required' => 'true', 'tabindex' => '13')); ?>
                                                </div>
                                                <div class="col-sm-3">
<?php echo $this->Form->input('builder_commercial', array('options' => array('1' => 'Yes', '2' => 'No'), 'empty' => '--Commercial--', 'data-required' => 'true', 'tabindex' => '14')); ?>
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
echo $this->Form->input('builder_rating', array('value' => '100000', 'readonly' => 'readonly'));
?>
                                                </div>
                                                <div class="col-sm-3">
<?php
echo $this->Form->input('builder_brandrecognition', array('value' => '100000', 'readonly' => 'readonly'));
?>
                                                </div>
                                                <div class="col-sm-3">
                                                    <?php
                                                    echo $this->Form->input('builder_qualityofconstruction', array('value' => '100000', 'readonly' => 'readonly'));
                                                    ?>
                                                </div>
                                                <div class="col-sm-3">
                                                    <?php
                                                    echo $this->Form->input('builder_timelydelivery', array('value' => '100000', 'readonly' => 'readonly'));
                                                    ?></div>
                                                <div class="col-sm-3">
                                                    <?php
                                                    echo $this->Form->input('builder_pasttrackrecord', array('value' => '100000', 'readonly' => 'readonly'));
                                                    ?></div>
                                                <div class="col-sm-3">
<?php
echo $this->Form->input('builder_professionalismandtransparency', array('value' => '100000', 'readonly' => 'readonly'));
?></div>              
                                            </div></div>
                                    </div>
                                </div>


                            </div>
                        </div>
                    </fieldset>


                    <h4>Builder Contacts</h4>
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
                                            <label>Builder Name</label>
                                            <span class="colon">:</span>
                                            <div class="col-sm-10"> <?php echo $this->Form->input('builder_text', array('class' => 'form-control builder_text', 'readonly' => 'readonly')); ?></div>
                                        </div>
                                        <div class="form-group">
                                            <label class="required">Contact Name</label>
                                            <span class="colon">:</span>
                                            <div class="col-sm-10"> <?php echo $this->Form->input('BuilderContact.builder_contact_name', array('class' => 'form-control data_required', 'tabindex' => '16')); ?></div>
                                        </div>

                                        <div class="form-group slt-sm">
                                            <label class="required">Primary Mobile</label>
                                            <span class="colon">:</span>
                                            <div class="col-sm-10">
<?php
echo $this->Form->input('BuilderContact.builder_contact_mobile_country_code', array('options' => $codes, 'default' => '76', 'empty' => '--Select--'));
echo $this->Form->input('BuilderContact.builder_contact_mobile_no', array('class' => 'form-control sm rgt data_required', 'tabindex' => '18'));
?></div>
                                        </div>

                                        <div class="form-group">
                                            <label for="email">Email Address</label>
                                            <span class="colon">:</span>
                                            <div class="col-sm-10">  <?php echo $this->Form->input('BuilderContact.builder_contact_email', array('tabindex' => '20')); ?></div>
                                        </div>
                                        <div class="form-group">
                                            <label class="required">For Company</label>
                                            <span class="colon">:</span>
                                            <div class="col-sm-10"><?php echo $this->Form->input('BuilderContact.builder_contact_company', array('options' => $for_company, 'empty' => '--Select--', 'class' => 'form-control data_required', 'tabindex' => '22')); ?></div>
                                        </div>
                                        <h4>Contact Logistics</h4>

                                        <div class="form-group">
                                            <label>Initiation Group</label>
                                            <span class="colon">:</span>
                                            <div class="col-sm-10"><?php echo $this->Form->input('BuilderContact.builder_contact_intiated_by_id', array('options' => $contact_initiated, 'empty' => '--Select--', 'tabindex' => '24')); ?></div>
                                        </div>
                                        <div class="form-group">
                                            <label>Manager Group</label>
                                            <span class="colon">:</span>
                                            <div class="col-sm-10"><?php echo $this->Form->input('BuilderContact.builder_contact_managed_by_id', array('options' => $contact_managed, 'empty' => '--Select--', 'tabindex' => '26')); ?></div>
                                        </div>





                                    </div>

                                    <div class="col-sm-6">
                                        <h4>&nbsp;</h4>
                                        <div class="form-group">
                                            <label class="required">Contact Level</label>
                                            <span class="colon">:</span>
                                            <div class="col-sm-10">  <?php echo $this->Form->input('BuilderContact.builder_contact_level', array('options' => $contact_level, 'empty' => '--Select--', 'class' => 'form-control data_required', 'tabindex' => '15')); ?></div>
                                        </div>
                                        <div class="form-group">
                                            <label class="required">Designation</label>
                                            <span class="colon">:</span>
                                            <div class="col-sm-10">
<?php
echo $this->Form->input('BuilderContact.builder_contact_designation', array('class' => 'form-control data_required', 'tabindex' => '17'));
?></div>
                                        </div>
                                        <div class="form-group slt-sm">
                                            <label>Secondary Mobile</label>
                                            <span class="colon">:</span>
                                            <div class="col-sm-10">  <?php echo $this->Form->input('BuilderContact.builder_contact_secondary_mobile_country_code', array('options' => $codes, 'default' => '76', 'empty' => '--Select--'));
echo $this->Form->input('BuilderContact.builder_contact_secondary_mobile_no', array('class' => 'form-control sm rgt', 'tabindex' => '19'));
?></div>
                                        </div>  

                                        <div class="form-group">
                                            <label class="required">Location</label>
                                            <span class="colon">:</span>
                                            <div class="col-sm-10">  <?php echo $this->Form->input('BuilderContact.builder_contact_location', array('options' => $city, 'empty' => '--Select--', 'class' => 'form-control data_required', 'tabindex' => '21')); ?></div>
                                        </div>
                                        <div class="form-group">
                                            <label for="input_name">For Company City</label>
                                            <span class="colon">:</span>
                                            <div class="col-sm-10"><?php echo $this->Form->input('BuilderContact.builder_contact_company_city', array('options' => $city, 'empty' => '--Select--', 'tabindex' => '23')); ?></div>
                                        </div>
                                        <h4>&nbsp;</h4>

                                        <div class="form-group">
                                            <label>Initiated  By</label>
                                            <span class="colon">:</span>
                                            <div class="col-sm-10"><?php echo $this->Form->input('BuilderContact.builder_contact_intiated_by', array('options' => array(), 'empty' => '--Select--', 'tabindex' => '25')); ?></div>
                                        </div>
                                        <div class="form-group">
                                            <label>Managed By</label>
                                            <span class="colon">:</span>
                                            <div class="col-sm-10"> <?php echo $this->Form->input('BuilderContact.builder_contact_managed_by', array('options' => array(), 'empty' => '--Select--', 'tabindex' => '27')); ?></div>
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
<?php
$this->Js->get('#BuilderCityId')->event('change', $this->Js->request(array(
            'controller' => 'all_functions',
            'action' => 'get_suburb_by_city/Builder/builder_primarycity'
                ), array(
            'update' => '#BuilderSuburbId',
            'async' => true,
            'before' => 'loading("BuilderSuburbId")',
            'complete' => 'loaded("BuilderSuburbId")',
            'method' => 'post',
            'dataExpression' => true,
            'data' => $this->Js->serializeForm(array(
                'isForm' => true,
                'inline' => true
            ))
        ))
);
$this->Js->get('#BuilderBuilderPrimarycity')->event('change', $this->Js->request(array(
            'controller' => 'all_functions',
            'action' => 'get_list_initiated_by_city'
                ), array(
            'update' => '#BuilderContactBuilderContactIntiatedBy',
            'async' => true,
            'before' => 'loading("BuilderContactBuilderContactIntiatedBy")',
            'complete' => 'loaded("BuilderContactBuilderContactIntiatedBy")',
            'method' => 'post',
            'dataExpression' => true,
            'data' => $this->Js->serializeForm(array(
                'isForm' => true,
                'inline' => true
            ))
        ))
);
$this->Js->get('#BuilderBuilderPrimarycity')->event('change', $this->Js->request(array(
            'controller' => 'all_functions',
            'action' => 'get_list_managed_by_city'
                ), array(
            'update' => '#BuilderContactBuilderContactManagedBy',
            'async' => true,
            'before' => 'loading("BuilderContactBuilderContactManagedBy")',
            'complete' => 'loaded("BuilderContactBuilderContactManagedBy")',
            'method' => 'post',
            'dataExpression' => true,
            'data' => $this->Js->serializeForm(array(
                'isForm' => true,
                'inline' => true
            ))
        ))
);
?>
<?php
/*
$this->Js->get('#BuilderSuburbId')->event('change', $this->Js->request(array(
            'controller' => 'all_functions',
            'action' => 'get_area_by_suburb/Builder/'
                ), array(
            'update' => '#BuilderAreaId',
            'async' => true,
            'before' => 'loading("BuilderAreaId")',
            'complete' => 'loaded("BuilderAreaId")',
            'method' => 'post',
            'dataExpression' => true,
            'data' => $this->Js->serializeForm(array(
                'isForm' => true,
                'inline' => true
            ))
        ))
);
 * 
 */
?>
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

        $('#BuilderBuilderName').blur(function() {
            $('.builder_text').val($(this).val());

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
        $('#BuilderBuilderPrimarycity').change(function() {
            $('#BuilderContactBuilderContactLocation').val($(this).val());
            $('#BuilderContactBuilderContactCompanyCity').val($(this).val());
        });
        $('#BuilderContactBuilderContactLocation').change(function(e) {
            var primary_city = $('#BuilderBuilderPrimarycity').val();
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
            var primary_city = $('#BuilderBuilderPrimarycity').val();
            e.preventDefault();
            bootbox.confirm("Are you sure?", function(result) {
                if (result == false) {
                    //alert('asd');
                    $('#BuilderContactBuilderContactCompanyCity').val(primary_city);

                }
                //bootbox.alert("Confirm result: "+result);
            });
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


        var initiated = $('#BuilderContactBuilderContactIntiatedById').val();
        var managed = $('#BuilderContactBuilderContactManagedById').val();
        if (initiated != '')
        {
            var initiated_by = $('#BuilderContactBuilderContactIntiatedBy').val();
            if (initiated_by == '') {
                bootbox.alert('Please select initiated by!');
                return false;
            }
        }
        if (managed != '')
        {
            var managed_by = $('#BuilderContactBuilderContactManagedBy').val();
            if (managed_by == '') {
                bootbox.alert('Please select managed by!');
                return false;
            }
        }


    }

</script>