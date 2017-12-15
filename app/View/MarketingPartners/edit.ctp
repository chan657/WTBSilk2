<?php
$this->Html->addCrumb('Edit Partner', 'javascript:void(0);', array('class' => 'breadcrumblast'));

$role_id = $this->Session->read("role_id");
if (($this->data['MarketingPartner']['marketing_partner_active_primary'] == '1' || $action_type == '0') && $role_id <> '27') {
    $builder_active_primary = true;
    $label_active_primary = 'Waiting...';
} else {
    $builder_active_primary = false;
    $label_active_primary = 'Update';
}

if (($this->data['MarketingPartner']['marketing_partner_active_operation'] == '1' || $action_type == '1') && $role_id <> '27') {
    $builder_active_operation = true;
    $label_active_operation = 'Waiting...';
} else {
    $builder_active_operation = false;
    $label_active_operation = 'Update';
}
?>

<div class="col-sm-12" id="mycl-det">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h4 class="panel-title">Add Information</h4>
        </div>
        <div class="panel-body edtpro">
            <fieldset>
                <legend><span>Edit Partner</span></legend>
            </fieldset>
            <div class="row">
                <div class="col-sm-12">
                    <?php
                    echo $this->Form->create('MarketingPartner', array('method' => 'post', 'id' => 'wizard_b', 'novalidate' => true,
                        'inputDefaults' => array(
                            'label' => false,
                            'div' => false,
                            'class' => 'form-control',
                        )
                    ));
                    echo $this->Form->input('action_type', array('value' => '0', 'type' => 'hidden', 'id' => 'ActionType'));
                    if ($actio_itme_id) {
                        if ($screen_position == 'SC-1') {
                            echo $this->Form->hidden('stpes', array('value' => 'steps-uid-1-t-0','id' => 'steps'));
                            $builder_active_primary = false;
                            $label_active_primary = 'Update';
                            $builder_active_operation = true;
                            $label_active_operation = 'Waiting...';
                        } else if ($screen_position == 'SC-2') {
                            echo $this->Form->hidden('stpes', array('value' => 'steps-uid-1-t-1','id' => 'steps'));
                            $builder_active_operation = false;
                            $label_active_operation = 'Update';
                            $builder_active_primary = true;
                            $label_active_primary = 'Waiting...';
                        }
                    }
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
                                            echo $this->Form->input('marketing_partner_primarycity', array('options' => $city, 'empty' => '--Select--', 'data-required' => 'true', 'onchange' => 'filterPreferences(this.value,\'BuilderBuilderTertiarycity\',\'BuilderCity4\',\'BuilderBuilderSecondarycity\',\'BuilderCity5\')', 'tabindex' => '1'));
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
                        <div class="row">
                            <div class="col-sm-1">
                                <?php
                                echo $this->Form->submit($label_active_primary, array('class' => 'btn btn-success sticky_success', 'disabled' => $builder_active_primary));
                                ?>
                                <!--<button type="submit" id="update_buttn" disabled="disabled" class="btn btn-success sticky_success">Update</button>-->

                            </div>



                        </div>  	



                    </fieldset>


                    <h4>Partner Operations</h4>
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
                        </div>
                        <div class="row">
                            <div class="col-sm-1">
                                <?php
                                echo $this->Form->submit($label_active_operation, array('class' => 'btn btn-success sticky_success', 'disabled' => $builder_active_operation));
                                ?>
                                <!--<button type="submit" id="update_buttn" disabled="disabled" class="btn btn-success sticky_success">Update</button>-->

                            </div>



                        </div>   
                    </fieldset>


                    <h4>Partner Contacts</h4>
                    <fieldset class="nopdng">
                        <div class="row">

                            <div class="col-sm-12">

                                <div class="form-control-static">
                                    <div class="table-heading disimp">
                                        <h4 class="table-heading-title">Contact Details</h4><span class="badge badge-circle add-client nomrgn"><i class="icon-plus"></i>
                                            <?php echo $this->Html->link('Add Contact', '/builder_contacts/add/' . $this->data['MarketingPartner']['id'] . '/1', array('class' => 'open-popup-link add-btn')); ?>

                                        </span></div><table border="0" cellpadding="0" cellspacing="0" id="resp_table" class="table toggle-square myclitb" data-filter="#table_search" data-page-size="40">
                                        <thead>
                                            <tr>
                                                <th data-toggle="true" width="7%">Partner Name</th>
                                                <th data-hide="phone" width="7%">Contact Name</th>
                                                <th data-hide="phone" width="5%">Designation</th>
                                                <th data-hide="phone" width="6%">Primary Mobile</th>
                                                <th data-hide="phone" width="8%">Secondary Mobile</th>

                                                <th data-hide="phone" width="1%">Email Address</th>
                                                <th data-hide="phone" width="7%">Location</th>
                                                <th data-hide="phone" width="5%">For City</th>
                                                <th data-hide="phone" width="7%">Level</th>

                                                <th data-hide="phone" data-sort-ignore="true" width="1%">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>  
                                            <?php
// pr($builder_contacts);
                                            if (count($builder_contacts) && !empty($builder_contacts)):
                                                foreach ($builder_contacts as $BuilderContact):
                                                    $id = $BuilderContact['BuilderContact']['id'];
                                                    ?> 
                                                    <tr>
                                                        <td><?php echo $BuilderContact['MarketingPartner']['marketing_partner_display_name']; ?></td>
                                                        <td><?php echo $BuilderContact['BuilderContact']['builder_contact_name']; ?></td>
                                                        <td><?php echo $BuilderContact['BuilderContact']['builder_contact_designation']; ?></td>
                                                        <td><?php echo $BuilderContact['PrimaryMobileCountry']['code'] . ' ' . $BuilderContact['BuilderContact']['builder_contact_mobile_no']; ?></td>
                                                        <td><?php echo $BuilderContact['SecondMobileCountry']['code'] . ' ' . $BuilderContact['BuilderContact']['builder_contact_secondary_mobile_no']; ?></td>

                                                        <td><?php echo $BuilderContact['BuilderContact']['builder_contact_email']; ?></td>
                                                        <td><?php echo $BuilderContact['Location']['city_name']; ?></td>
                                                        <td><?php echo $BuilderContact['ForCompanyCity']['city_name']; ?></td>
                                                        <td><?php echo $BuilderContact['Level']['value']; ?></td>

                                                        <td><?php
                                                            if ($BuilderContact['BuilderContact']['builder_contact_approved'] == 1) {

                                                                echo $this->Html->link('<span class="icon-pencil"></span>', array('controller' => 'builder_contacts', 'action' => 'edit', 'slug' => $BuilderContact['BuilderContact']['builder_contact_name'] . '-' . $BuilderContact['Location']['city_name'], 'id' => base64_encode($id)), array('class' => 'open-popup-link add-btn act-ico', 'escape' => false));
                                                            }
                                                            ?></td>
                                                    </tr>
                                                <?php endforeach; ?>

                                                <?php
                                            else:
                                                echo '<tr><td colspan="10" class="norecords">No Records Found</td></tr>';

                                            endif;
                                            ?>

                                        </tbody>   
                                    </table></div>

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

        var steps = $('#steps').val();
        $('#' + steps).click();
        
        $('#update_buttn').click(function() {
            $('#wizard_b').submit();
        });

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