<?php $this->Html->addCrumb('Add Client', 'javascript:void(0);', array('class' => 'breadcrumblast')); ?>

<div class="col-sm-12" id="mycl-det">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h4 class="panel-title">Add Information</h4>
        </div>
        <div class="panel-body">
            <fieldset>
                <legend><span>Add Client</span></legend>
            </fieldset>
            <div class="row">
                <div class="col-sm-12">
                    <?php
                    echo $this->Form->create('Lead', array('method' => 'post', 'id' => 'wizard_c', 'novalidate' => true,
                        'inputDefaults' => array(
                            'label' => false,
                            'div' => false,
                            'class' => 'form-control',
                        )
                    ));
                    echo $this->Form->hidden('model_name', array('value' => 'Lead'));
                    echo $this->Form->hidden('dummy_status', array('value' => $dummy_status));
                    ?>

                    <h4>Primary Information</h4>
                    <fieldset class="nopdng">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="reg_input_name" class="req">City</label>
                                        <span class="colon">:</span>
                                        <div class="col-sm-10"><?php
                                            echo $this->Form->input('city_id', array('options' => $city, 'empty' => 'Select', 'data-required' => 'true', 'tabindex' => '1'));
                                            ?></div>
                                    </div>


                                    <div class="form-group">
                                        <label>First Name</label>
                                        <span class="colon">:</span>
                                        <div class="col-sm-10">
                                            <?php
                                            echo $this->Form->input('lead_fname', array('tabindex' => '3'));
                                            ?></div>
                                    </div>
                                    <div class="form-group slt-sm">
                                        <label  for="reg_input_name" class="req">Primary Contact No</label>
                                        <span class="colon">:</span>
                                        <div class="col-sm-10">
                                            <?php
                                            echo $this->Form->input('lead_primary_phone_country_code', array('options' => $codes, 'default' => '76', 'empty' => '--Select--'));
                                            echo $this->Form->input('lead_primaryphonenumber', array('class' => 'form-control sm rgt', 'data-required' => 'true', 'tabindex' => '5'));
                                            ?></div>
                                    </div>

                                    <div class="form-group">
                                        <label for="reg_input_name">Status</label>
                                        <span class="colon">:</span>
                                        <div class="col-sm-10">
                                            <?php
                                            echo $this->Form->input('lead_status', array('options' => $status, 'empty' => 'Select', 'tabindex' => '7', 'default' => '1', 'disabled' => array('2', '3', '4', '5', '6', '7', '8')));
                                            ?></div>
                                    </div>
                                    <div class="form-group">
                                        <label for="reg_input_name">Urgency</label>
                                        <span class="colon">:</span>
                                        <div class="col-sm-10">
                                            <?php
                                            echo $this->Form->input('lead_urgency', array('options' => $urgencies, 'empty' => 'Select', 'default' => '3', 'tabindex' => '9'));
                                            ?></div>
                                    </div>
                                    <div class="form-group">
                                        <label for="reg_input_name">Progress</label>
                                        <span class="colon">:</span>
                                        <div class="col-sm-10">
                                            <?php
                                            echo $this->Form->input('lead_progress', array('options' => $lead_progrss, 'empty' => 'Select', 'tabindex' => '11', 'default' => '1', 'disabled' => array('2', '9', '10', '11', '12', '13', '14', '15', '16', '17', '18', '19', '20')));
                                            ?></div>
                                    </div>
                                    <div class="form-group">
                                        <label for="reg_input_name">Category</label>
                                        <span class="colon">:</span>
                                        <div class="col-sm-10">
                                            <?php
                                            echo $this->Form->input('lead_category', array('options' => $categories, 'empty' => 'Select', 'tabindex' => '13', 'default' => '1', 'disabled' => array('2', '3')));
                                            ?></div>
                                    </div>
                                    <div class="form-group">
                                        <label for="reg_input_name">Industry</label>
                                        <span class="colon">:</span>
                                        <div class="col-sm-10">
                                            <?php
                                            echo $this->Form->input('lead_industry', array('options' => $industry, 'default' => '1', 'tabindex' => '15', 'disabled' => array('2', '3')));
                                            ?></div>
                                    </div>
                                    <div class="form-group slt-sm">
                                        <label for="reg_input_name">Budget</label>
                                        <span class="colon">:</span>
                                        <div class="col-sm-10">
                                            <?php
                                            echo $this->Form->input('lead_budget_unit', array('options' => $courrency, 'empty' => '--Select--', 'tabindex' => '17'));
                                            echo $this->Form->input('lead_budget', array('class' => 'form-control sm rgt', 'value' => '0.00', 'tabindex' => '18'));
                                            ?></div>
                                    </div>
                                    <div class="form-group">
                                        <label for="reg_input_name">Closure Probability</label>
                                        <span class="colon">:</span>
                                        <div class="col-sm-10">
                                            <?php
                                            echo $this->Form->input('lead_closureprobabilityinnext1Month', array('options' => $closureprobabilities, 'empty' => 'Select', 'default' => '6', 'tabindex' => '20', 'disabled' => array('1', '2', '3', '4', '5')));
                                            ?></div>
                                    </div>
                                </div>

                                <div class="col-sm-6">

                                    <div class="form-group">
                                        <label for="reg_input_name">Location</label>
                                        <span class="colon">:</span>
                                        <div class="col-sm-10">
                                            <?php
                                            echo $this->Form->input('lead_country', array('options' => $countires, 'empty' => 'Select', 'tabindex' => '2', 'default' => '76'));
                                            ?></div>
                                    </div>

                                    <div class="form-group">
                                        <label>Last Name</label>
                                        <span class="colon">:</span>
                                        <div class="col-sm-10">
                                            <?php
                                            echo $this->Form->input('lead_lname', array('tabindex' => '4'));
                                            ?></div>
                                    </div>
                                    <div class="form-group slt-sm">
                                        <label for="reg_input_name">Secondary Contact No</label>
                                        <span class="colon">:</span>
                                        <div class="col-sm-10">
                                            <?php
                                            echo $this->Form->input('lead_secondary_phone_country_code', array('options' => $codes, 'default' => '76', 'empty' => '--Select--'));
                                            echo $this->Form->input('lead_secondaryphonenumber', array('class' => 'form-control sm rgt', 'tabindex' => '6'));
                                            ?></div>
                                    </div>
                                    <div class="form-group">
                                        <label for="reg_input_name">Email</label>
                                        <span class="colon">:</span>
                                        <div class="col-sm-10">
                                            <?php
                                            echo $this->Form->input('lead_emailid', array('tabindex' => '8'));
                                            ?></div>
                                    </div>
                                    <div class="form-group">
                                        <label for="reg_input_name">Importance</label>
                                        <span class="colon">:</span>
                                        <div class="col-sm-10">
                                            <?php
                                            echo $this->Form->input('lead_importance', array('options' => $importance, 'empty' => 'Select', 'default' => '3', 'tabindex' => '10'));
                                            ?></div>
                                    </div>
                                    <div class="form-group">
                                        <label for="reg_input_name">Type</label>
                                        <span class="colon">:</span>
                                        <div class="col-sm-10">
                                            <?php
                                            echo $this->Form->input('lead_type', array('options' => $types, 'empty' => 'Select', 'tabindex' => '12'));
                                            ?></div>
                                    </div>
                                    <div class="form-group">
                                        <label for="reg_input_name">Special</label>
                                        <span class="colon">:</span>
                                        <div class="col-sm-10">
                                            <?php
                                            echo $this->Form->input('lead_special_client_status', array('options' => array('1' => 'Yes', '2' => 'No'), 'empty' => 'Select', 'default' => '2', 'tabindex' => '14'));
                                            ?></div>
                                    </div>
                                    <div class="form-group">
                                        <label for="reg_input_name">Source</label>
                                        <span class="colon">:</span>
                                        <div class="col-sm-10">
                                            <?php
                                            echo $this->Form->input('lead_source', array('options' => $source, 'empty' => 'Select', 'tabindex' => '16', 'default' => '1', 'disabled' => array('2')));
                                            ?></div>
                                    </div>
                                    <div class="form-group">
                                        <label for="reg_input_name">Segment</label>
                                        <span class="colon">:</span>
                                        <div class="col-sm-10">
                                            <?php
                                            echo $this->Form->input('lead_segment', array('options' => $segment, 'empty' => 'Select', 'default' => '1', 'tabindex' => '19'));
                                            ?></div>
                                    </div>

                                </div>
                                <br class="spacer" />
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label>Client Description</label>
                                        <span class="colon">:</span>
                                        <div class="col-sm-10 editable txtbox">
                                            <?php
                                            echo $this->Form->input('lead_description', array('type' => 'textarea', 'tabindex' => '20'));
                                            ?></div>
                                    </div>
                                    <div class="form-group">
                                        <label>Residential Address</label>
                                        <span class="colon">:</span>
                                        <div class="col-sm-10 editable txtbox">
                                            <?php
                                            echo $this->Form->input('lead_streetaddress', array('type' => 'textarea', 'tabindex' => '21'));
                                            ?></div>
                                    </div>
                                </div>

                            </div>


                        </div>

                    </fieldset>

                    <h4>Client Preferences</h4>
                    <fieldset class="nopdng">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="col-sm-12">

                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label>Suburb</label>
                                            <span class="colon">:</span>
                                            <div class="col-sm-10">
                                                <div class="form-group">
                                                    <div class="col-sm-4 col-xs-12">

                                                        <?php
                                                        echo $this->Form->input('lead_suburb1', array('options' => $suburbs, 'tabindex' => '22', 'class' => 'form-control city_bootbox_custom', 'empty' => '--Preference 1--', 'onchange' => 'filterPreferences(this.value,\'LeadLeadSuburb2\',\'LeadLeadSuburb3\')'));
                                                        ?>
                                                    </div>
                                                    <div class="col-sm-4 col-xs-12"><?php
                                                        echo $this->Form->input('lead_suburb2', array('options' => $suburbs, 'tabindex' => '23', 'empty' => '--Preference 2--', 'class' => 'form-control pre_bootbox_custom', 'onchange' => 'filterPreferences(this.value,\'LeadLeadSuburb1\',\'LeadLeadSuburb3\')'));
                                                        ?>
                                                    </div>
                                                    <div class="col-sm-4 col-xs-12">
                                                        <?php
                                                        echo $this->Form->input('lead_suburb3', array('options' => $suburbs, 'tabindex' => '24', 'empty' => '--Preference 3--', 'class' => 'form-control pre_bootbox_custom', 'onchange' => 'filterPreferences(this.value,\'LeadLeadSuburb1\',\'LeadLeadSuburb2\')'));
                                                        ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label>Area</label>
                                            <span class="colon">:</span>
                                            <div class="col-sm-10">
                                                <div class="form-group">    
                                                    <div class="col-sm-4 col-xs-12">

                                                        <?php
                                                        echo $this->Form->input('lead_areapreference1', array('options' => $areas, 'tabindex' => '25', 'empty' => '--Preference 1--', 'class' => 'form-control city_bootbox_custom', 'onchange' => 'filterPreferences(this.value,\'LeadLeadAreapreference2\',\'LeadLeadAreapreference3\')'));
                                                        ?>
                                                    </div>
                                                    <div class="col-sm-4 col-xs-12">
                                                        <?php
                                                        echo $this->Form->input('lead_areapreference2', array('options' => $areas, 'tabindex' => '26', 'empty' => '--Preference 2--', 'class' => 'form-control pre_bootbox_custom', 'onchange' => 'filterPreferences(this.value,\'LeadLeadAreapreference1\',\'LeadLeadAreapreference3\')'));
                                                        ?></div>
                                                    <div class="col-sm-4 col-xs-12">
                                                        <?php
                                                        echo $this->Form->input('lead_areapreference3', array('options' => $areas, 'tabindex' => '27', 'empty' => '--Preference 3--', 'class' => 'form-control pre_bootbox_custom', 'onchange' => 'filterPreferences(this.value,\'LeadLeadAreapreference1\',\'LeadLeadAreapreference2\')'));
                                                        ?></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label>Builder</label>
                                            <span class="colon">:</span>
                                            <div class="col-sm-10">
                                                <div class="form-group">
                                                    <div class="col-sm-4 col-xs-12">
                                                        <?php
                                                        echo $this->Form->input('builder_id1', array('options' => $builders, 'tabindex' => '28', 'class' => 'form-control city_bootbox_custom', 'empty' => '--Preference 1--', 'onchange' => 'filterPreferences(this.value,\'LeadBuilderId2\',\'LeadBuilderId3\')'));
                                                        ?></div>
                                                    <div class="col-sm-4 col-xs-12">
                                                        <?php
                                                        echo $this->Form->input('builder_id2', array('options' => $builders, 'tabindex' => '29', 'empty' => '--Preference 2--', 'class' => 'form-control pre_bootbox_custom', 'onchange' => 'filterPreferences(this.value,\'LeadBuilderId1\',\'LeadBuilderId3\')'));
                                                        ?>
                                                    </div>
                                                    <div class="col-sm-4 col-xs-12">
                                                        <?php
                                                        echo $this->Form->input('builder_id3', array('options' => $builders, 'tabindex' => '30', 'empty' => '--Preference 3--', 'class' => 'form-control pre_bootbox_custom', 'onchange' => 'filterPreferences(this.value,\'LeadBuilderId1\',\'LeadBuilderId2\')'));
                                                        ?></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label>Project</label>
                                            <span class="colon">:</span>
                                            <div class="col-sm-10">
                                                <div class="form-group">    
                                                    <div class="col-sm-4 col-xs-12">
                                                        <?php
                                                        echo $this->Form->input('proj_id1', array('options' => $projects, 'tabindex' => '31', 'empty' => '--Preference 1--', 'class' => 'form-control city_bootbox_custom',
                                                            'onchange' => 'filterPreferences(this.value,\'LeadProjId2\',\'LeadProjId3\')'));
                                                        ?></div>
                                                    <div class="col-sm-4 col-xs-12">
                                                        <?php
                                                        echo $this->Form->input('proj_id2', array('options' => $projects, 'tabindex' => '32', 'empty' => '--Preference 2--', 'class' => 'form-control pre_bootbox_custom', 'onchange' => 'filterPreferences(this.value,\'LeadProjId1\',\'LeadProjId3\')'));
                                                        ?></div>
                                                    <div class="col-sm-4 col-xs-12">
                                                        <?php
                                                        echo $this->Form->input('proj_id3', array('options' => $projects, 'tabindex' => '33', 'empty' => '--Preference 3--', 'class' => 'form-control pre_bootbox_custom', 'onchange' => 'filterPreferences(this.value,\'LeadProjId1\',\'LeadProjId2\')'));
                                                        ?></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label>Unit</label>
                                            <span class="colon">:</span>
                                            <div class="col-sm-10">
                                                <div class="form-group">    
                                                    <div class="col-sm-4 col-xs-12">
                                                        <?php
                                                        echo $this->Form->input('lead_unit_id_1', array('options' => $unit, 'tabindex' => '34', 'empty' => '--Preference 1--', 'onchange' => 'filterPreferences(this.value,\'LeadLeadUnitId2\',\'LeadLeadUnitId3\')'));
                                                        ?></div>
                                                    <div class="col-sm-4 col-xs-12">
                                                        <?php
                                                        echo $this->Form->input('lead_unit_id_2', array('options' => $unit, 'tabindex' => '35', 'empty' => '--Preference 2--', 'class' => 'form-control pre_bootbox_custom', 'onchange' => 'filterPreferences(this.value,\'LeadLeadUnitId1\',\'LeadLeadUnitId3\')'));
                                                        ?></div>
                                                    <div class="col-sm-4 col-xs-12">
                                                        <?php
                                                        echo $this->Form->input('lead_unit_id_3', array('options' => $unit, 'tabindex' => '36', 'empty' => '--Preference 3--', 'class' => 'form-control pre_bootbox_custom', 'onchange' => 'filterPreferences(this.value,\'LeadLeadUnitId1\',\'LeadLeadUnitId2\')'));
                                                        ?></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label>Project Type</label>
                                            <span class="colon">:</span>
                                            <div class="col-sm-10">
                                                <div class="form-group">    
                                                    <div class="col-sm-4 col-xs-12">
                                                        <?php
                                                        echo $this->Form->input('lead_typeofprojectpreference1', array('options' => $type_preference, 'tabindex' => '37', 'empty' => '--Preference 1--', 'onchange' => 'filterPreferences(this.value,\'LeadLeadTypeofprojectpreference2\',\'LeadLeadTypeofprojectpreference3\')'));
                                                        ?></div>
                                                    <div class="col-sm-4 col-xs-12">
                                                        <?php
                                                        echo $this->Form->input('lead_typeofprojectpreference2', array('options' => $type_preference, 'tabindex' => '38', 'empty' => '--Preference 2--', 'class' => 'form-control pre_bootbox_custom', 'onchange' => 'filterPreferences(this.value,\'LeadLeadTypeofprojectpreference1\',\'LeadLeadTypeofprojectpreference3\')'));
                                                        ?></div>
                                                    <div class="col-sm-4 col-xs-12">
                                                        <?php
                                                        echo $this->Form->input('lead_typeofprojectpreference3', array('options' => $type_preference, 'tabindex' => '39', 'class' => 'form-control pre_bootbox_custom', 'empty' => '--Preference 3--', 'onchange' => 'filterPreferences(this.value,\'LeadLeadTypeofprojectpreference1\',\'LeadLeadTypeofprojectpreference2\')'));
                                                        ?></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>                                                                               
                                </div>






                            </div>
                        </div>
                    </fieldset>


                    <h4>Lead Management</h4>
                    <fieldset class="nopdng">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="reg_input_name" class="req">Creation Type</label>
                                        <span class="colon">:</span>
                                        <div class="col-sm-10">
                                            <?php
                                            echo $this->Form->input('lead_creation_type', array('options' => $creation_types, 'default' => $creation_default_value, 'tabindex' => '40', 'empty' => '--Select--', 'data-required' => 'true'));
                                            ?></div>
                                    </div>
                                    <div class="form-group">
                                        <label for="reg_input_name">Phone Officer</label>
                                        <span class="colon">:</span>
                                        <div class="col-sm-10">
                                            <?php
                                            echo $this->Form->input('lead_phoneofficer', array('id' => $id, 'options' => $phone_officer, 'tabindex' => '41',
                                                'class' => 'form-control phone_officer'));

                                            echo $this->Form->input('ajax_lead_phoneofficer', array('div' => array('id' => 'phone_div_id', 'style' => 'display:none'), 'tabindex' => '42', 'options' => array(),
                                            ));
                                            ?></div>
                                    </div>

                                    <div class="form-group">
                                        <label for="reg_input_name">Channel</label>
                                        <span class="colon">:</span>
                                        <div class="col-sm-10 exp"><?php
                                            echo $this->Form->input('lead_channel', array('options' => array(), 'tabindex' => '43', 'empty' => '--Select--'));
                                            ?></div>
                                    </div>


                                    <div class="form-group">
                                        <label for="reg_input_name">Primary Manager</label>
                                        <span class="colon">:</span>
                                        <div class="col-sm-10 exp"><?php
                                            echo $this->Form->input('lead_managerprimary', array('options' => array(), 'tabindex' => '44', 'empty' => '--Select--'));
                                            ?></div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="reg_input_name">Created By</label>
                                        <span class="colon">:</span>
                                        <div class="col-sm-10">
                                            <?php
                                            echo $this->Form->input('created_by', array('options' => $created_by, 'tabindex' => '45'));
                                            ?></div>
                                    </div>
                                    <div class="form-group">
                                        <label for="reg_input_name">Associate</label>
                                        <span class="colon">:</span>
                                        <div class="col-sm-10 exp"><?php
                                            echo $this->Form->input('lead_associate', array('options' => $associate, 'tabindex' => '46'));
                                            echo $this->Form->input('ajax_lead_associate', array('div' => array('id' => 'associate_div_id', 'style' => 'display:none'), 'tabindex' => '47', 'options' => array()));
                                            ?></div>
                                    </div>       
                                    <div class="form-group">
                                        <label for="reg_input_name">Secondary Manager</label>
                                        <span class="colon">:</span>
                                        <div class="col-sm-10 exp"><?php
                                            echo $this->Form->input('lead_managersecondary', array('options' => array(), 'tabindex' => '48', 'empty' => '--Select--'));
                                            ?></div>
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
if ($role_id <> '14' && $creation_type <> '5') {
    $this->Js->get('#LeadCityId')->event('change', $this->Js->request(array(
                'controller' => 'all_functions',
                'action' => 'get_phone_office_by_cityid'
                    ), array(
                'update' => '.phone_officer',
                'async' => true,
                'before' => 'loading("phone_officer")',
                'complete' => 'loaded("phone_officer")',
                'method' => 'post',
                'dataExpression' => true,
                'data' => $this->Js->serializeForm(array(
                    'isForm' => true,
                    'inline' => true
                ))
            ))
    );

    $this->Js->get('#LeadCityId')->event('change', $this->Js->request(array(
                'controller' => 'all_functions',
                'action' => 'get_associate_by_cityid'
                    ), array(
                'update' => '#LeadLeadAssociate',
                'async' => true,
                'before' => 'loading("LeadLeadAssociate")',
                'complete' => 'loaded("LeadLeadAssociate")',
                'method' => 'post',
                'dataExpression' => true,
                'data' => $this->Js->serializeForm(array(
                    'isForm' => true,
                    'inline' => true
                ))
            ))
    );
}





$this->Js->get('#LeadCityId')->event('change', $this->Js->request(array(
            'controller' => 'all_functions',
            'action' => 'get_project_by_city/Lead'
                ), array(
            'update' => '#LeadProjId1',
            'async' => true,
            'before' => 'loading("LeadProjId1")',
            'complete' => 'loaded("LeadProjId1")',
            'method' => 'post',
            'dataExpression' => true,
            'data' => $this->Js->serializeForm(array(
                'isForm' => true,
                'inline' => true
            ))
        ))
);

$this->Js->get('#LeadCityId')->event('change', $this->Js->request(array(
            'controller' => 'all_functions',
            'action' => 'get_project_by_city/Lead'
                ), array(
            'update' => '#LeadProjId2',
            'async' => true,
            'before' => 'loading("LeadProjId2")',
            'complete' => 'loaded("LeadProjId2")',
            'method' => 'post',
            'dataExpression' => true,
            'data' => $this->Js->serializeForm(array(
                'isForm' => true,
                'inline' => true
            ))
        ))
);

$this->Js->get('#LeadCityId')->event('change', $this->Js->request(array(
            'controller' => 'all_functions',
            'action' => 'get_project_by_city/Lead'
                ), array(
            'update' => '#LeadProjId3',
            'async' => true,
            'method' => 'post',
            'before' => 'loading("LeadProjId3")',
            'complete' => 'loaded("LeadProjId3")',
            'dataExpression' => true,
            'data' => $this->Js->serializeForm(array(
                'isForm' => true,
                'inline' => true
            ))
        ))
);

$this->Js->get('#LeadCityId')->event('change', $this->Js->request(array(
            'controller' => 'all_functions',
            'action' => 'get_builder_by_cityid'
                ), array(
            'update' => '#LeadBuilderId1',
            'async' => true,
            'before' => 'loading("LeadBuilderId1")',
            'complete' => 'loaded("LeadBuilderId1")',
            'method' => 'post',
            'dataExpression' => true,
            'data' => $this->Js->serializeForm(array(
                'isForm' => true,
                'inline' => true
            ))
        ))
);
$this->Js->get('#LeadCityId')->event('change', $this->Js->request(array(
            'controller' => 'all_functions',
            'action' => 'get_builder_by_cityid'
                ), array(
            'update' => '#LeadBuilderId2',
            'async' => true,
            'before' => 'loading("LeadBuilderId2")',
            'complete' => 'loaded("LeadBuilderId2")',
            'method' => 'post',
            'dataExpression' => true,
            'data' => $this->Js->serializeForm(array(
                'isForm' => true,
                'inline' => true
            ))
        ))
);
$this->Js->get('#LeadCityId')->event('change', $this->Js->request(array(
            'controller' => 'all_functions',
            'action' => 'get_builder_by_cityid'
                ), array(
            'update' => '#LeadBuilderId3',
            'async' => true,
            'before' => 'loading("LeadBuilderId3")',
            'complete' => 'loaded("LeadBuilderId3")',
            'method' => 'post',
            'dataExpression' => true,
            'data' => $this->Js->serializeForm(array(
                'isForm' => true,
                'inline' => true
            ))
        ))
);

$this->Js->get('#LeadCityId')->event('change', $this->Js->request(array(
            'controller' => 'all_functions',
            'action' => 'get_suburb_by_city/Lead/city_id'
                ), array(
            'update' => '#LeadLeadSuburb1',
            'async' => true,
            'before' => 'loading("LeadLeadSuburb1")',
            'complete' => 'loaded("LeadLeadSuburb1")',
            'method' => 'post',
            'dataExpression' => true,
            'data' => $this->Js->serializeForm(array(
                'isForm' => true,
                'inline' => true
            ))
        ))
);
$this->Js->get('#LeadCityId')->event('change', $this->Js->request(array(
            'controller' => 'all_functions',
            'action' => 'get_suburb_by_city'
                ), array(
            'update' => '#LeadLeadSuburb2',
            'async' => true,
            'before' => 'loading("LeadLeadSuburb2")',
            'complete' => 'loaded("LeadLeadSuburb2")',
            'method' => 'post',
            'dataExpression' => true,
            'data' => $this->Js->serializeForm(array(
                'isForm' => true,
                'inline' => true
            ))
        ))
);
$this->Js->get('#LeadCityId')->event('change', $this->Js->request(array(
            'controller' => 'all_functions',
            'action' => 'get_suburb_by_city'
                ), array(
            'update' => '#LeadLeadSuburb3',
            'async' => true,
            'before' => 'loading("LeadLeadSuburb3")',
            'complete' => 'loaded("LeadLeadSuburb3")',
            'method' => 'post',
            'dataExpression' => true,
            'data' => $this->Js->serializeForm(array(
                'isForm' => true,
                'inline' => true
            ))
        ))
);
$this->Js->get('#LeadCityId')->event('change', $this->Js->request(array(
            'controller' => 'all_functions',
            'action' => 'get_area_by_city'
                ), array(
            'update' => '#LeadLeadAreapreference1',
            'async' => true,
            'before' => 'loading("LeadLeadAreapreference1")',
            'complete' => 'loaded("LeadLeadAreapreference1")',
            'method' => 'post',
            'dataExpression' => true,
            'data' => $this->Js->serializeForm(array(
                'isForm' => true,
                'inline' => true
            ))
        ))
);

$this->Js->get('#LeadCityId')->event('change', $this->Js->request(array(
            'controller' => 'all_functions',
            'action' => 'get_area_by_city'
                ), array(
            'update' => '#LeadLeadAreapreference2',
            'async' => true,
            'before' => 'loading("LeadLeadAreapreference2")',
            'complete' => 'loaded("LeadLeadAreapreference2")',
            'method' => 'post',
            'dataExpression' => true,
            'data' => $this->Js->serializeForm(array(
                'isForm' => true,
                'inline' => true
            ))
        ))
);

$this->Js->get('#LeadCityId')->event('change', $this->Js->request(array(
            'controller' => 'all_functions',
            'action' => 'get_area_by_city'
                ), array(
            'update' => '#LeadLeadAreapreference3',
            'async' => true,
            'method' => 'post',
            'dataExpression' => true,
            'data' => $this->Js->serializeForm(array(
                'isForm' => true,
                'inline' => true
            ))
        ))
);
?>
<input type="hidden" id="disable_attr">
<input type="hidden" id="focus_attr">
<script type="text/javascript">
//<![CDATA[

    function filterPreferences(val, id1, id2) {
        //alert(val)
        $("#" + id1 + " option").each(function() {
            var optionVal = $(this).val();
            if (val == optionVal) {
                $("#" + id1).children('option[value="' + optionVal + '"]').attr('disabled', 'disabled');
            }
        });

        $("#" + id2 + " option").each(function() {
            var optionVal = $(this).val();
            if (val == optionVal) {
                $("#" + id2).children('option[value="' + optionVal + '"]').attr('disabled', 'disabled');
            }
        });
    }

    function OpenMessagebox(disable, text) {

        $(disable).prop('disabled', 'disabled');
        $('#message').css('display', 'block');
        $('#message p').text(text);
        $(".content").addClass("msg");

    }


    $(document).ready(function() {
        var FULL_BASE_URL = $('#hidden_site_baseurl').val();

        filterPreferences($('#LeadProjId1').val(), 'LeadProjId2', 'LeadProjId3');
        filterPreferences($('#LeadProjId2').val(), 'LeadProjId1', 'LeadProjId3');
        filterPreferences($('#LeadProjId3').val(), 'LeadProjId1', 'LeadProjId2');

        filterPreferences($('#LeadBuilderId1').val(), 'LeadBuilderId2', 'LeadBuilderId3');
        filterPreferences($('#LeadBuilderId2').val(), 'LeadBuilderId1', 'LeadBuilderId3');
        filterPreferences($('#LeadBuilderId3').val(), 'LeadBuilderId1', 'LeadBuilderId2');

        filterPreferences($('#LeadLeadUnitId1').val(), 'LeadLeadUnitId2', 'LeadLeadUnitId3');
        filterPreferences($('#LeadLeadUnitId2').val(), 'LeadLeadUnitId1', 'LeadLeadUnitId3');
        filterPreferences($('#LeadLeadUnitId3').val(), 'LeadLeadUnitId1', 'LeadLeadUnitId2');

        filterPreferences($('#LeadLeadSuburb1').val(), 'LeadLeadSuburb2', 'LeadLeadSuburb3');
        filterPreferences($('#LeadLeadSuburb2').val(), 'LeadLeadSuburb1', 'LeadLeadSuburb3');
        filterPreferences($('#LeadLeadSuburb3').val(), 'LeadLeadSuburb1', 'LeadLeadSuburb2');

        filterPreferences($('#LeadLeadAreapreference1').val(), 'LeadLeadAreapreference2', 'LeadLeadAreapreference3');
        filterPreferences($('#LeadLeadAreapreference2').val(), 'LeadLeadAreapreference1', 'LeadLeadAreapreference3');
        filterPreferences($('#LeadLeadAreapreference3').val(), 'LeadLeadAreapreference1', 'LeadLeadAreapreference2');

        filterPreferences($('#LeadLeadTypeofprojectpreference1').val(), 'LeadLeadTypeofprojectpreference2', 'LeadLeadTypeofprojectpreference3');
        filterPreferences($('#LeadLeadTypeofprojectpreference2').val(), 'LeadLeadTypeofprojectpreference1', 'LeadLeadTypeofprojectpreference3');
        filterPreferences($('#LeadLeadTypeofprojectpreference3').val(), 'LeadLeadTypeofprojectpreference1', 'LeadLeadTypeofprojectpreference2');





    });


//]]>
</script>