<?php
$this->Html->addCrumb('Add Agent', 'javascript:void(0);', array('class' => 'breadcrumblast'));
?>

<div class="col-sm-12" id="mycl-det">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h4 class="panel-title">Add Information</h4>
        </div>
        <div class="panel-body">
            <fieldset>
                <legend><span>Add Agent</span></legend>
            </fieldset>
            <div class="row">
                <div class="col-sm-12">
                    <?php
                    echo $this->Form->create('Agent', array('method' => 'post', 'id' => 'wizard_a', 'novalidate' => true,
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
                                        <label for="reg_input_name" class="req">Agent Name</label>
                                        <span class="colon">:</span>
                                        <div class="col-sm-10"> <?php echo $this->Form->input('agent_name', array('data-required' => 'true', 'tabindex' => '1')); ?></div>
                                    </div>
                                    <div class="form-group">
                                        <label for="input_name" class="req">Incorporation Country</label>
                                        <span class="colon">:</span>
                                        <div class="col-sm-10">
                                            <?php
                                            echo $this->Form->input('agent_incorporated_in_country', array('options' => $countries, 'empty' => '--Select--', 'data-required' => 'true', 'tabindex' => '3'));
                                            ?>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="input_name">Suburb</label>
                                        <span class="colon">:</span>
                                        <div class="col-sm-10">
                                            <?php
                                            echo $this->Form->input('agent_suburb', array('options' => array(), 'empty' => '--Select--', 'tabindex' => '5'));
                                            ?>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label>Zip Code</label>
                                        <span class="colon">:</span>
                                        <div class="col-sm-10">
                                            <?php
                                            echo $this->Form->input('agent_zip_code', array('class' => 'form-control rgt', 'tabindex' => '5','type' => 'textbox'));
                                            ?>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>Website</label>
                                        <span class="colon">:</span>
                                        <div class="col-sm-10"> <?php echo $this->Form->input('agent_website', array('tabindex' => '7')); ?></div>
                                    </div>
                                </div>


                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="input_name" class="req">Procurement Type</label>
                                        <span class="colon">:</span>
                                        <div class="col-sm-10">
                                            <?php
                                            echo $this->Form->input('agent_procurement_type', array('options' => $ProcurementTypes, 'empty' => '--Select--', 'data-required' => 'true', 'default' => array('3'), 'tabindex' => '2'));
                                            ?>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="input_name" class="req">Primary City</label>
                                        <span class="colon">:</span>
                                        <div class="col-sm-10">
                                            <?php
                                            echo $this->Form->input('agent_primary_city', array('options' => $city, 'empty' => '--Select--', 'data-required' => 'true', 'onchange' => 'filterPreferences(this.value,\'AgentAgentSecondaryCity\',\'AgentAgentTertiaryCity\',\'AgentAgentCity4\',\'AgentAgentCity5\')', 'tabindex' => '4'));
                                            ?>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="input_name">Area</label>
                                        <span class="colon">:</span>
                                        <div class="col-sm-10">
                                            <?php
                                            echo $this->Form->input('agent_area', array('options' => array(), 'empty' => '--Select--', 'tabindex' => '5'));
                                            ?>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>Time Zone</label>
                                        <span class="colon">:</span>
                                        <div class="col-sm-10"> <?php echo $this->Form->input('agent_time_zone', array('tabindex' => '6', 'options' => $timezone, 'empty' => '--Select--')); ?></div>
                                    </div>

                                    <div class="form-group">
                                        <label>IATA Status</label>
                                        <span class="colon">:</span>
                                        <div class="col-sm-10"> <?php echo $this->Form->input('agent_iata_approval_status', array('options' => array('1' => 'Yes', '2' => 'No'), 'empty' => '--Select--', 'tabindex' => '8')); ?></div>
                                    </div>
                                </div>

                                <br class="spacer" />
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label>Corporate Address</label>
                                        <span class="colon">:</span>
                                        <div class="col-sm-10 editable txtbox">
                                            <?php
                                            echo $this->Form->input('agent_corporate_address', array('type' => 'textarea', 'tabindex' => '8'));
                                            ?></div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group slt-sm">
                                        <label>Mobile</label>
                                        <span class="colon">:</span>
                                        <div class="col-sm-10">
                                            <?php
                                            echo $this->Form->input('agent_contact_number_code_mobile', array('options' => $codes, 'default' => '76', 'empty' => '--Select--', 'tabindex' => '9'));
                                            echo $this->Form->input('agent_contact_number_mobile', array('class' => 'form-control sm rgt', 'tabindex' => '10'));
                                            ?>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>Email</label>
                                        <span class="colon">:</span>
                                        <div class="col-sm-10"> <?php echo $this->Form->input('agent_contact_email', array('tabindex' => '13')); ?></div>
                                    </div>
                                    <div class="form-group">
                                        <label>Business Type</label>
                                        <span class="colon">:</span>
                                        <div class="col-sm-10"> <?php echo $this->Form->input('agent_business_type', array('options' => $AgentBusinessTypes, 'empty' => '--Select--', 'tabindex' => '16')); ?></div>
                                    </div>



                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group slt-sm">
                                        <label>Land Line No.</label>
                                        <span class="colon">:</span>
                                        <div class="col-sm-10">
                                            <?php
                                            echo $this->Form->input('agent_contact_number_code_landline', array('options' => $codes, 'default' => '76', 'empty' => '--Select--', 'tabindex' => '11'));
                                            echo $this->Form->input('agent_contact_number_landline', array('class' => 'form-control sm rgt', 'tabindex' => '12'));
                                            ?>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>Nature of Business</label>
                                        <span class="colon">:</span>
                                        <div class="col-sm-10"> <?php echo $this->Form->input('agent_nature_of_business', array('options' => $NatureOfBusinesses, 'empty' => '--Select--', 'tabindex' => '15')); ?></div>
                                    </div> 
                                    <div class="form-group">
                                        <label>Source</label>
                                        <span class="colon">:</span>
                                        <div class="col-sm-10"> <?php echo $this->Form->input('agent_source', array('options' => $AgentSourcees, 'empty' => '--Select--', 'tabindex' => '16')); ?></div>
                                    </div> 
                                </div>
                                <br class="spacer" />
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label>Registration Note</label>
                                        <span class="colon">:</span>
                                        <div class="col-sm-10 editable txtbox">
                                            <?php
                                            echo $this->Form->input('agent_registration_note', array('type' => 'textarea', 'tabindex' => '17'));
                                            ?></div>
                                    </div>
                                    <div class="form-group">
                                        <label>Description</label>
                                        <span class="colon">:</span>
                                        <div class="col-sm-10 editable txtbox">
                                            <?php
                                            echo $this->Form->input('agent_description', array('type' => 'textarea', 'tabindex' => '17'));
                                            ?></div>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="cont-det">
                                        <p>Do you have multicity operations?</p>
                                        <?php echo $this->Form->checkbox('agent_multicity', array('id' => 'is_multicity')); ?>
                                        <label>Yes</label> 
                                    </div>
                                    <div class="multicity" style="display: none;">
                                    <h4>Multicity Operations</h4>
                                    <div class="form-group">
                                        <label for="reg_input_name">Secondary Cities</label>
                                        <span class="colon">:</span>
                                        <div class="col-sm-10 editable txtbox">
                                            <div class="row" id="fr-select">
                                                <div class="col-sm-3">
                                                    <?php
                                                    echo $this->Form->input('agent_secondary_city', array('options' => $city, 'empty' => '--Secondary City--', 'class' => 'form-control', 'onchange' => 'filterPreferences(this.value,\'AgentAgentPrimaryCity\',\'AgentAgentTertiaryCity\',\'AgentAgentCity4\',\'AgentAgentCity5\')', 'tabindex' => '18'));
                                                    ?>
                                                </div>
                                                <div class="col-sm-3">
                                                    <?php
                                                    echo $this->Form->input('agent_tertiary_city', array('options' => $city, 'empty' => '--Tertiary City--', 'class' => 'form-control city_custom', 'onchange' => 'filterPreferences(this.value,\'AgentAgentPrimaryCity\',\'AgentAgentSecondaryCity\',\'AgentAgentCity4\',\'AgentAgentCity5\')', 'tabindex' => '19'));
                                                    ?>
                                                </div>
                                                <div class="col-sm-3">
                                                    <?php
                                                    echo $this->Form->input('agent_city4', array('options' => $city, 'empty' => '--City 4--', 'class' => 'form-control city_custom', 'onchange' => 'filterPreferences(this.value,\'AgentAgentPrimaryCity\',\'AgentAgentSecondaryCity\',\'AgentAgentTertiaryCity\',\'AgentAgentCity5\')', 'tabindex' => '20'));
                                                    ?>
                                                </div>
                                                <div class="col-sm-3">
                                                    <?php
                                                    echo $this->Form->input('agent_city5', array('options' => $city, 'empty' => '--City 5--', 'class' => 'form-control city_custom', 'onchange' => 'filterPreferences(this.value,\'AgentAgentPrimaryCity\',\'AgentAgentSecondaryCity\',\'AgentAgentTertiaryCity\',\'AgentAgentCity4\')', 'tabindex' => '21'));
                                                    ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    </div>
                                </div>



                            </div>


                        </div>

                    </fieldset>

                    <h4>Agent Preferences</h4>
                    <fieldset class="nopdng">
                        <div class="row">
                            <div class="col-sm-12">

                                <div class="row form-wrap">
                                    <div class="col-sm-12">
                                        <h4>Destination preference</h4>
                                        <div class="form-group">
                                            <div class="col-sm-12">
                                                <div class="checkbox three-column"> 
                                                    <div class="list-checkbox">
                                                        <?php echo $this->Form->checkbox('agent_dest_pref_apac_aus', array('hiddenField' => false)); ?>

                                                        <label for="AmenityAmenityId">APAC / Australia</label>
                                                    </div>

                                                    <div class="list-checkbox">
                                                        <?php echo $this->Form->checkbox('agent_dest_pref_middle_east', array('hiddenField' => false)); ?>
                                                        <label for="AmenityAmenityId">Middle East</label>
                                                    </div>

                                                    <div class="list-checkbox">
                                                        <?php echo $this->Form->checkbox('agent_dest_pref_africa', array('hiddenField' => false)); ?>	
                                                        <label for="AmenityAmenityId">Africa</label>
                                                    </div>

                                                    <div class="list-checkbox">
                                                        <?php echo $this->Form->checkbox('agent_dest_pref_europe', array('hiddenField' => false)); ?>	
                                                        <label for="AmenityAmenityId">Europe</label>
                                                    </div>

                                                    <div class="list-checkbox">
                                                        <?php echo $this->Form->checkbox('agent_dest_pref_n_america', array('hiddenField' => false)); ?>	
                                                        <label for="AmenityAmenityId">North America</label>
                                                    </div>
                                                    <div class="list-checkbox">
                                                        <?php echo $this->Form->checkbox('agent_dest_pref_s_america', array('hiddenField' => false)); ?>
                                                        <label for="AmenityAmenityId">South America</label>
                                                    </div>  

                                                </div>
                                            </div>
                                        </div>
                                        <h4>Product Preference</h4>
                                        <div class="form-group">
                                            <div class="col-sm-12">
                                                <div class="checkbox three-column">            
                                                    <div class="list-checkbox">
                                                        <?php echo $this->Form->checkbox('agent_prod_pref_hotels', array('hiddenField' => false)); ?>
                                                        <label for="AmenityAmenityId">Hotels</label>
                                                    </div>

                                                    <div class="list-checkbox">
                                                        <?php echo $this->Form->checkbox('agent_prod_pref_packages', array('hiddenField' => false)); ?>	
                                                        <label for="AmenityAmenityId">Packages</label>
                                                    </div>

                                                    <div class="list-checkbox">
                                                        <?php echo $this->Form->checkbox('agent_prod_pref_sightseeings', array('hiddenField' => false)); ?>
                                                        <label for="AmenityAmenityId">SightSeeings</label>
                                                    </div>

                                                    <div class="list-checkbox">
                                                        <?php echo $this->Form->checkbox('agent_prod_pref_transfers', array('hiddenField' => false)); ?>
                                                        <label for="AmenityAmenityId">Transfers</label>
                                                    </div>

                                                    <div class="list-checkbox">
                                                        <?php echo $this->Form->checkbox('agent_prod_pref_5', array('hiddenField' => false)); ?>
                                                        <label for="AmenityAmenityId">Preference5</label>
                                                    </div>

                                                    <div class="list-checkbox">
                                                        <?php echo $this->Form->checkbox('agent_prod_pref_6', array('hiddenField' => false)); ?>
                                                        <label for="AmenityAmenityId">Preference6</label>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                        <h4>Usual Client Profile</h4>
                                        <div class="form-group">
                                            <div class="col-sm-12">
                                                <div class="checkbox three-column">                            
                                                    <div class="list-checkbox">
                                                        <?php echo $this->Form->checkbox('agent_client_pref_fit', array('hiddenField' => false)); ?>	
                                                        <label for="AmenityAmenityId">FIT</label>
                                                    </div>

                                                    <div class="list-checkbox">
                                                        <?php echo $this->Form->checkbox('agent_client_pref_l_group', array('hiddenField' => false)); ?>	
                                                        <label for="AmenityAmenityId">Leisure Group</label>
                                                    </div>

                                                    <div class="list-checkbox">
                                                        <?php echo $this->Form->checkbox('agent_client_pref_c_group', array('hiddenField' => false)); ?>	
                                                        <label for="AmenityAmenityId">Corporate Group</label>
                                                    </div>
                                                    <div class="list-checkbox">
                                                        <?php echo $this->Form->checkbox('agent_client_pref_4', array('hiddenField' => false)); ?>	
                                                        <label for="AmenityAmenityId">Preference4</label>
                                                    </div>
                                                    <div class="list-checkbox">
                                                        <?php echo $this->Form->checkbox('agent_client_pref_5', array('hiddenField' => false)); ?>
                                                        <label for="AmenityAmenityId">Preference5</label>
                                                    </div>
                                                    <div class="list-checkbox">
                                                        <?php echo $this->Form->checkbox('agent_client_pref_6', array('hiddenField' => false)); ?>
                                                        <label for="AmenityAmenityId">Preference6</label>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                        <h4>Usual Client Sources</h4>
                                        <div class="form-group">
                                            <div class="col-sm-12">
                                                <div class="checkbox three-column">       
                                                    <div class="list-checkbox">
                                                        <?php echo $this->Form->checkbox('agent_source_pref_online', array('hiddenField' => false)); ?>	
                                                        <label for="AmenityAmenityId">Online</label>
                                                    </div>

                                                    <div class="list-checkbox">
                                                        <?php echo $this->Form->checkbox('agent_source_pref_traditional', array('hiddenField' => false)); ?>	
                                                        <label for="AmenityAmenityId">Traditional</label>
                                                    </div>

                                                    <div class="list-checkbox">
                                                        <?php echo $this->Form->checkbox('agent_source_pref_referrals', array('hiddenField' => false)); ?>	
                                                        <label for="AmenityAmenityId">Referrals</label>
                                                    </div>

                                                    <div class="list-checkbox">
                                                        <?php echo $this->Form->checkbox('agent_source_pref_4', array('hiddenField' => false)); ?>	
                                                        <label for="AmenityAmenityId">Preference4</label>
                                                    </div>

                                                    <div class="list-checkbox">
                                                        <?php echo $this->Form->checkbox('agent_source_pref_5', array('hiddenField' => false)); ?>	
                                                        <label for="AmenityAmenityId">Preference5</label>
                                                    </div>

                                                    <div class="list-checkbox">
                                                        <?php echo $this->Form->checkbox('agent_source_pref_6', array('hiddenField' => false)); ?>	
                                                        <label for="AmenityAmenityId">Preference6</label>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                        <h4>Technology Preferences</h4>
                                        <div class="form-group">
                                            <div class="col-sm-12">
                                                <div class="checkbox three-column">       
                                                    <div class="list-checkbox">
                                                        <?php echo $this->Form->checkbox('agent_xml', array('hiddenField' => false)); ?>	
                                                        <label for="AmenityAmenityId">XML</label>
                                                    </div>

                                                    <div class="list-checkbox">
                                                        <?php echo $this->Form->checkbox('agent_whitelabel', array('hiddenField' => false)); ?>	
                                                        <label for="AmenityAmenityId">Whitelabel</label>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </fieldset>
                    
                    <h4>Agent Logistics</h4>
                    <fieldset class="nopdng">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Primary S / M</label>
                                        <span class="colon">:</span>
                                        <div class="col-sm-10">
                                            <?php
                                            echo $this->Form->input('primary_sales_manager', array('options' => array(), 'empty' => '--Select--'));
                                            ?>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>Primary O / M</label>
                                        <span class="colon">:</span>
                                        <div class="col-sm-10">
                                            <?php
                                           echo $this->Form->input('primary_opration_manager', array('options' => array(), 'empty' => '--Select--'));
                                            ?>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label>Primary A / M</label>
                                        <span class="colon">:</span>
                                        <div class="col-sm-10 exp"><?php
                                          echo $this->Form->input('primary_accounts_manager', array('options' => array(), 'empty' => '--Select--'));
                                            ?>
                                        </div>
                                    </div>

                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Secondary S / M</label>
                                        <span class="colon">:</span>
                                        <div class="col-sm-10">
                                            <?php
                                            echo $this->Form->input('secondary_sales_manager', array('options' => array(), 'empty' => '--Select--'));
                                            ?>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>Secondary O / M</label>
                                        <span class="colon">:</span>
                                        <div class="col-sm-10"><?php
                                           echo $this->Form->input('secondary_opration_manager', array('options' => array(), 'empty' => '--Select--'));
                                            ?>
                                        </div>
                                    </div>       
                                    <div class="form-group">
                                        <label>Secondary A / M</label>
                                        <span class="colon">:</span>
                                        <div class="col-sm-10"><?php
                                            echo $this->Form->input('secondary_accounts_manager', array('options' => array(), 'empty' => '--Select--'));
                                            ?>
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
/*
 * Get sates by country code
 */
$this->Js->get('#AgentAgentPrimaryCity')->event('change', $this->Js->request(array(
            'controller' => 'all_functions',
            'action' => 'get_suburb_by_city/Agent/agent_primary_city'
                ), array(
            'update' => '#AgentAgentSuburb',
            'async' => true,
            'before' => 'loading("AgentAgentSuburb")',
            'complete' => 'loaded("AgentAgentSuburb")',
            'method' => 'post',
            'dataExpression' => true,
            'data' => $this->Js->serializeForm(array(
                'isForm' => true,
                'inline' => true
            ))
        ))
);

$this->Js->get('#AgentAgentSuburb')->event('change', $this->Js->request(array(
            'controller' => 'all_functions',
            'action' => 'get_area_by_suburb/Agent/agent_suburb'
                ), array(
            'update' => '#AgentAgentArea',
            'async' => true,
            'before' => 'loading("AgentAgentArea")',
            'complete' => 'loaded("AgentAgentArea")',
            'method' => 'post',
            'dataExpression' => true,
            'data' => $this->Js->serializeForm(array(
                'isForm' => true,
                'inline' => true
            ))
        ))
);
/*
  $this->Js->get('#AgentAgentIncorporatedInCountry')->event('change', $this->Js->request(array(
  'controller' => 'all_functions',
  'action' => 'get_city_by_county_id/Agent'
  ), array(
  'update' => '#AgentAgentPrimaryCity',
  'async' => true,
  'before' => 'loading("AgentAgentPrimaryCity")',
  'complete' => 'loaded("AgentAgentPrimaryCity")',
  'method' => 'post',
  'dataExpression' => true,
  'data' => $this->Js->serializeForm(array(
  'isForm' => true,
  'inline' => true
  ))
  ))
  );

  $this->Js->get('#AgentAgentIncorporatedInCountry')->event('change', $this->Js->request(array(
  'controller' => 'all_functions',
  'action' => 'get_city_by_county_id/Agent'
  ), array(
  'update' => '#AgentAgentSecondaryCity',
  'async' => true,
  'before' => 'loading("AgentAgentSecondaryCity")',
  'complete' => 'loaded("AgentAgentSecondaryCity")',
  'method' => 'post',
  'dataExpression' => true,
  'data' => $this->Js->serializeForm(array(
  'isForm' => true,
  'inline' => true
  ))
  ))
  );

  $this->Js->get('#AgentAgentIncorporatedInCountry')->event('change', $this->Js->request(array(
  'controller' => 'all_functions',
  'action' => 'get_city_by_county_id/Agent'
  ), array(
  'update' => '#AgentAgentTertiaryCity',
  'async' => true,
  'before' => 'loading("AgentAgentTertiaryCity")',
  'complete' => 'loaded("AgentAgentTertiaryCity")',
  'method' => 'post',
  'dataExpression' => true,
  'data' => $this->Js->serializeForm(array(
  'isForm' => true,
  'inline' => true
  ))
  ))
  );

  $this->Js->get('#AgentAgentIncorporatedInCountry')->event('change', $this->Js->request(array(
  'controller' => 'all_functions',
  'action' => 'get_city_by_county_id/Agent'
  ), array(
  'update' => '#AgentAgentCity4',
  'async' => true,
  'before' => 'loading("AgentAgentCity4")',
  'complete' => 'loaded("AgentAgentCity4")',
  'method' => 'post',
  'dataExpression' => true,
  'data' => $this->Js->serializeForm(array(
  'isForm' => true,
  'inline' => true
  ))
  ))
  );

  $this->Js->get('#AgentAgentIncorporatedInCountry')->event('change', $this->Js->request(array(
  'controller' => 'all_functions',
  'action' => 'get_city_by_county_id/Agent'
  ), array(
  'update' => '#AgentAgentCity5',
  'async' => true,
  'before' => 'loading("AgentAgentCity5")',
  'complete' => 'loaded("AgentAgentCity5")',
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


    $(document).ready(function() {

        $("#is_multicity").bind('click', function() {
            if ($(this).is(":checked")) {
                $(".multicity").css('display','block');
            }
            else {
                $(".multicity").css('display','none');
            }
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

</script>