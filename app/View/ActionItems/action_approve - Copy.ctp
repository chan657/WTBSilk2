<?php
$this->Html->addCrumb('Transaction Action', 'javascript:void(0);', array('class' => 'breadcrumblast'));
echo $this->Form->create('ActionItem', array('method' => 'post',
    'id' => 'parsley_reg',
    'novalidate' => true,
    'inputDefaults' => array(
        'label' => false,
        'div' => false,
        'class' => 'form-control',
    ),
));
?>
<div class="col-sm-12" id="mycl-det">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h4 class="panel-title">Action</h4>
        </div>
        <div class="panel-body">
            <fieldset>
                <legend><span>Action</span></legend>
            </fieldset>
            <div class="row">
                <div class="col-sm-12">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="reg_input_name" class="req">Choose Action Type</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10">
                                <?php
                                echo $this->Form->input('type_id', array('options' => $action_type, 'empty' => '--Select--', 'data-required' => 'true'));
                                ?></div>
                        </div>
                    </div>
                    <div class="col-sm-6 release_cln" style="display:none;">
                        <div class="form-group" id="rejection">
                            <label>Reason for Release</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10"><?php echo $this->Form->input('lookup_release_id', array('id' => 'release_id', 'options' => $release, 'empty' => '--Select--')); ?>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 report_tran" style="display:none;">
                        <div class="form-group">
                            <label>Cost Currency </label>
                            <span class="colon">:</span>
                            <div class="col-sm-10"><?php echo $this->Form->input('Lead.unit_cost_currency', array('options' => array('INR' => 'INR', 'AED' => 'AED', 'USD' => 'USD'), 'empty' => '--Select--', 'value' => 'INR', 'disabled' => TRUE, 'selected' => TRUE, 'tabindex' => '20')); ?></div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12 report_tran" style="display:none; clear:both;">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="reg_input_name" class="req">Transaction Type</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10">
                                <?php
                                echo $this->Form->input('Deal.deal_type', array('options' => $LookupValueLeadTransactionType, 'empty' => '--Select--', 'disabled' => array('2', '3', '4', '5', '6')));
                                ?></div>
                        </div>
                        <div class="form-group">
                            <label for="reg_input_name" class="req">Project</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10">
                                <?php
                                echo $this->Form->input('Deal.deal_project_id', array('options' => $projects, 'empty' => '--Select'));
                                ?></div>
                        </div>
                        <div class="form-group builder" <?php if ($this->data['Deal']['deal_billing_type'] == '2') { ?> style="display:none;" <?php } ?>>
                            <label for="reg_input_name" class="req" >Builder</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10">
                                <?php
                                echo $this->Form->input('Deal.deal_builder_id', array('options' => $builders, 'empty' => '--Select'));
                                ?></div>
                        </div>
                        <div class="form-group partner" <?php if ($this->data['Deal']['deal_billing_type'] == '1') { ?> style="display:none;" <?php } ?>>
                            <label for="reg_input_name" class="req" >Partner</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10">
                                <?php
                                echo $this->Form->input('Deal.deal_marketing_partner_id', array('options' => $partners, 'empty' => '--Select'));
                                ?></div>
                        </div>

                        <div class="form-group">
                            <label>Floor Number</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10"><?php echo $this->Form->input('Deal.deal_unit_floor', array('class' => 'form-control rgt', 'tabindex' => '19','type' => 'text')); ?></div>
                        </div>
                        <div class="form-group">
                            <label for="reg_input_name" class="req">Client</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10">
                                <?php
                                echo $this->Form->input('Deal.deal_client_id', array('options' => $lead_lt, 'empty' => '--Select'));
                                ?></div>
                        </div>
                        <div class="form-group" >
                            <label for="reg_input_name" class="req">Booking Date</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10">
                                <div class="input-group date ebro_datepicker event_date_present_div" data-date-format="dd-mm-yyyy" data-date-autoclose="true">
                                    <?php
                                    $deal_booking_date = '';
                                    if ($this->data['Deal']['deal_booking_date'])
                                        $deal_booking_date = date('d-m-Y', strtotime($this->data['Deal']['deal_booking_date']));
                                    echo $this->Form->input('Deal.deal_booking_date', array('id' => 'dpd1', 'type' => 'text', 'data-date-format' => 'dd-mm-yyyy', 'data-date-autoclose' => 'true', 'value' => $deal_booking_date));
                                    ?>
                                    <span class="input-group-addon"><i class="icon-calendar"></i></span>
                                </div>


                            </div>
                        </div>
                        <div class="form-group percsym">
                            <label>Commission % </label>
                            <span class="colon">:</span>
                            <div class="col-sm-10"><div class="input-group"><?php echo $this->Form->input('Deal.deal_commission_percent', array('class' => 'form-control rgt taxes_duty', 'tabindex' => '33')); ?><span class="input-group-addon">%</span></div></div>
                        </div> 
                        <div class="form-group" >
                            <label for="reg_input_name" class="req">Tentative Reg.  Date</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10">
                                <div class="input-group date ebro_datepicker event_date_present_div" data-date-format="dd-mm-yyyy" data-date-autoclose="true">
                                    <?php
                                    $deal_expected_invoice_date = '';
                                    if ($this->data['Deal']['deal_expected_invoice_date'])
                                        $deal_expected_invoice_date = date('d-m-Y', strtotime($this->data['Deal']['deal_expected_invoice_date']));
                                    echo $this->Form->input('Deal.deal_expected_invoice_date', array('id' => 'dpd1', 'type' => 'text', 'data-date-format' => 'dd-mm-yyyy', 'data-date-autoclose' => 'true', 'value' => $deal_expected_invoice_date));
                                    ?>
                                    <span class="input-group-addon"><i class="icon-calendar"></i></span>
                                </div>


                            </div>
                        </div>




                    </div>
                    <div class="col-sm-6">

                        <div class="form-group">
                            <label for="reg_input_name" class="req">Billing Type</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10">
                                <?php
                                echo $this->Form->input('Deal.deal_billing_type', array('options' => $billing_types, 'empty' => '--Select--', 'disabled' => array('3', '4', '5', '6', '7')));
                                ?></div>
                        </div>
                        <div class="form-group">
                            <label for="reg_input_name" class="req">Project Legal Name</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10">
                                <?php
                                echo $this->Form->input('Deal.deal_project_legal_name_id', array('options' => $ProjectLegalNameList, 'empty' => '--Select--'));
                                ?></div>
                        </div>
                        <div class="form-group">
                            <label for="reg_input_name" class="req">Unit</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10">
                                <?php
                                echo $this->Form->input('Deal.deal_project_unit_id', array('options' => $project_unit_list, 'empty' => '--Select--'));
                                ?></div>
                        </div>
                        <div class="form-group">
                            <label>Sale Pattern</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10"><?php echo $this->Form->input('Deal.deal_sale_pattern', array('options' => array('Sellable' => 'Sellable', 'Carpet' => 'Carpet'), 'empty' => '--Select--', 'default' => 'Sellable', 'tabindex' => '26')); ?></div>
                        </div>
                        <div class="form-group">
                            <label for="reg_input_name" class="req">Property Value</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10">
                                <?php
                                echo $this->Form->input('Deal.deal_invoiced_on_amount',array('class' => 'form-control rgt'));
                                ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="reg_input_name" class="req">Booking Amount</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10">
                                <?php
                                echo $this->Form->input('Deal.deal_booking_amount',array('class' => 'form-control rgt'));
                                ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Commission Event</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10"><?php echo $this->Form->input('Deal.deal_invoice_event', array('options' => $commission_event, 'empty' => '--Select--', 'tabindex' => '55')); ?></div>
                        </div>
                        <div class="form-group" >
                            <label for="reg_input_name" class="req">Tentative Invoice  Date</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10">
                                <div class="input-group date ebro_datepicker event_date_present_div" data-date-format="dd-mm-yyyy" data-date-autoclose="true">
                                    <?php
                                    $deal_actual_invoice_date = '';
                                    if ($this->data['Deal']['deal_actual_invoice_date'])
                                        $deal_actual_invoice_date = date('d-m-Y', strtotime($this->data['Deal']['deal_actual_invoice_date']));
                                    echo $this->Form->input('Deal.deal_actual_invoice_date', array('id' => 'dpd1', 'type' => 'text', 'data-date-format' => 'dd-mm-yyyy', 'data-date-autoclose' => 'true', 'value' => $deal_actual_invoice_date));
                                    ?>
                                    <span class="input-group-addon"><i class="icon-calendar"></i></span>
                                </div>


                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12 release_cln" style="display:none;">
                    <div class="form-group">
                        <label>Comment</label>
                        <span class="colon">:</span>
                        <div class="col-sm-10">
                            <?php
                            echo $this->Form->input('other_release', array('type' => 'textarea'));
                            ?></div>
                    </div>
                </div>


                <div class="col-sm-12 report_tran" id="ajax_prolegal" style="display:none;">
                    <?php if (count($ProjectLegalNames)) { ?>
                        <div class="panel-group" id="accordion2">
                            <div class="panel panel-default" style="clear:both">
                                <div class="panel-heading">
                                    <h4 class="panel-title">
                                        <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion1" href="#acc2_collapseSeven">
                                            Project Legal Name Details
                                        </a>
                                    </h4>
                                </div>
                                <div id="acc2_collapseSeven" class="panel-collapse collapse">
                                    <div class="panel-body">
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label>Legal Address</label>
                                                <span class="colon">:</span>
                                                <div class="col-sm-10"><?php echo $this->Form->input('legal_address', array('value' => $ProjectLegalNames['BuilderLegalName']['builder_legal_names_address'], 'readonly' => true, 'label' => false, 'div' => false, 'class' => 'form-control')); ?></div>
                                            </div>
                                            <div class="form-group">
                                                <label>Legal Location</label>
                                                <span class="colon">:</span>
                                                <div class="col-sm-10"><?php
                                                    echo $this->Form->input('legal_address', array('value' => $ProjectLegalNames['Location']['city_name'], 'readonly' => true, 'label' => false, 'div' => false, 'class' => 'form-control'));
                                                    ?></div>
                                            </div>
                                            <div class="form-group">
                                                <label>Contact Name</label>
                                                <span class="colon">:</span>
                                                <div class="col-sm-10"><?php
                                                    echo $this->Form->input('legal_address', array('value' => $ProjectLegalNames['BuilderContact']['builder_contact_name'], 'readonly' => true, 'label' => false, 'div' => false, 'class' => 'form-control'));
                                                    ?></div>
                                            </div>
                                            <div class="form-group">
                                                <label>Primar Mobile</label>
                                                <span class="colon">:</span>
                                                <div class="col-sm-10"> <?php echo $this->Form->input('legal_address', array('value' => $ProjectLegalNames['BuilderContact']['builder_contact_mobile_no'], 'readonly' => true, 'label' => false, 'div' => false, 'class' => 'form-control')); ?></div>
                                            </div>


                                        </div>
                                        <div class="col-sm-6">

                                            <div class="form-group">
                                                <label>Legal Address</label>
                                                <span class="colon">:</span>
                                                <div class="col-sm-10"> <?php echo $this->Form->input('legal_address', array('label' => false, 'div' => false, 'class' => 'form-control')); ?></div>
                                            </div>
                                            <div class="form-group">
                                                <label>Legal Location</label>
                                                <span class="colon">:</span>
                                                <div class="col-sm-10"> <?php echo $this->Form->input('legal_address', array('label' => false, 'div' => false, 'class' => 'form-control')); ?></div>
                                            </div>
                                            <div class="form-group">
                                                <label>Contact Name</label>
                                                <span class="colon">:</span>
                                                <div class="col-sm-10"> <?php echo $this->Form->input('legal_address', array('label' => false, 'div' => false, 'class' => 'form-control')); ?></div>
                                            </div>
                                            <div class="form-group">
                                                <label>Primar Mobile</label>
                                                <span class="colon">:</span>
                                                <div class="col-sm-10"> <?php echo $this->Form->input('legal_address', array('label' => false, 'div' => false, 'class' => 'form-control')); ?></div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                </div>     
                <div class="col-sm-12 report_tran" id="ajax_client" style="display:none;">
                    <?php if (count($leads)) { ?>
                        <div class="panel-group" id="accordion2">
                            <div class="panel panel-default" style="clear:both">
                                <div class="panel-heading">
                                    <h4 class="panel-title">
                                        <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion1" href="#acc2_collapseEight">
                                            Client Details
                                        </a>
                                    </h4>
                                </div>
                                <div id="acc2_collapseEight" class="panel-collapse collapse">
                                    <div class="panel-body">
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label>Client Name</label>
                                                <span class="colon">:</span>
                                                <div class="col-sm-10">
                                                    <?php
                                                    echo $this->Form->input('client_name', array('value' => $leads['Lead']['lead_fname'] . ' ' . $leads['Lead']['lead_lname'], 'readonly' => true, 'label' => false, 'div' => false, 'class' => 'form-control'));
                                                    ?> 
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label>Country</label>
                                                <span class="colon">:</span>
                                                <div class="col-sm-10">
                                                    <?php
                                                    echo $this->Form->input('legal_address', array('value' => $leads['Country']['value'], 'readonly' => true, 'label' => false, 'div' => false, 'class' => 'form-control'));
                                                    ?> 
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label>Primary Mobile</label>
                                                <span class="colon">:</span>
                                                <div class="col-sm-10">
                                                    <?php
                                                    echo $this->Form->input('lead_primaryphonenumber', array('value' => $leads['PrimaryCode']['code'] . ' ' . $leads['Lead']['lead_primaryphonenumber'], 'readonly' => true, 'label' => false, 'div' => false, 'class' => 'form-control'));
                                                    ?> 
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label>Secondary Mobile</label>
                                                <span class="colon">:</span>
                                                <div class="col-sm-10">
                                                    <?php
                                                    echo $this->Form->input('lead_secondaryphonenumber', array('value' => $leads['SecondaryCode']['code'] . ' ' . $leads['Lead']['lead_secondaryphonenumber'], 'readonly' => true, 'label' => false, 'div' => false, 'class' => 'form-control'));
                                                    ?> 
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label>Email</label>
                                                <span class="colon">:</span>
                                                <div class="col-sm-10">
                                                    <?php
                                                    echo $this->Form->input('lead_emailid', array('value' => $leads['Lead']['lead_emailid'], 'readonly' => true, 'label' => false, 'div' => false, 'class' => 'form-control'));
                                                    ?> 
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label>Street Address</label>
                                                <span class="colon">:</span>
                                                <div class="col-sm-10">
                                                    <?php
                                                    echo $this->Form->input('legal_address', array('value' => $leads['Lead']['lead_streetaddress'], 'readonly' => true, 'label' => false, 'div' => false, 'class' => 'form-control'));
                                                    ?> 
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label>Client Name</label>
                                                <span class="colon">:</span>
                                                <div class="col-sm-10">
                                                    <?php echo $this->Form->input('legal_address', array('label' => false, 'div' => false, 'class' => 'form-control')); ?> 
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label>Country</label>
                                                <span class="colon">:</span>
                                                <div class="col-sm-10">
                                                    <?php echo $this->Form->input('legal_address', array('label' => false, 'div' => false, 'class' => 'form-control')); ?> 
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label>Primary Mobile</label>
                                                <span class="colon">:</span>
                                                <div class="col-sm-10">
                                                    <?php echo $this->Form->input('legal_address', array('label' => false, 'div' => false, 'class' => 'form-control')); ?> 
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label>Secondary Mobile</label>
                                                <span class="colon">:</span>
                                                <div class="col-sm-10">
                                                    <?php echo $this->Form->input('legal_address', array('label' => false, 'div' => false, 'class' => 'form-control')); ?> 
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label>Email</label>
                                                <span class="colon">:</span>
                                                <div class="col-sm-10">
                                                    <?php echo $this->Form->input('legal_address', array('label' => false, 'div' => false, 'class' => 'form-control')); ?> 
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label>Street Address</label>
                                                <span class="colon">:</span>
                                                <div class="col-sm-10">
                                                    <?php echo $this->Form->input('legal_address', array('label' => false, 'div' => false, 'class' => 'form-control')); ?> 
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>

                    <?php } ?>
                </div>
                <div class="col-sm-12 report_tran" id="ajax_unit"  style="display:none;">
                    <?php if (count($project_units)) { ?>
                        <div class="panel-group" id="accordion2">
                            <div class="panel panel-default" style="clear:both">

                                <div class="panel-heading">
                                    <h4 class="panel-title">
                                        <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion1" href="#acc2_collapseSix">
                                            Unit Details
                                        </a>
                                    </h4>
                                </div>
                                <div id="acc2_collapseSix" class="panel-collapse collapse">
                                    <div class="panel-body">
                                        <div class="col-sm-6">        

                                            <div class="form-group">
                                                <label>Unit Type</label>
                                                <span class="colon">:</span>
                                                <div class="col-sm-10"><?php
                                                    echo $this->Form->input('unit_type', array('value' => $project_units['UnitType']['value'], 'readonly' => true, 'label' => false, 'div' => false, 'class' => 'form-control'));
                                                    ?></div>
                                            </div>
                                            <div class="form-group">
                                                <label>Unit Name</label>
                                                <span class="colon">:</span>
                                                <div class="col-sm-10"><?php
                                                    echo $this->Form->input('unit_name', array('value' => $project_units['ProjectUnit']['unit_name'], 'readonly' => true, 'label' => false, 'div' => false, 'class' => 'form-control'));
                                                    ?></div>
                                            </div>









                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label>Unit Type </label>
                                                <span class="colon">:</span>
                                                <div class="col-sm-10"><?php echo $this->Form->input('name', array('class' => 'form-control', 'label' => false, 'div' => false)); ?></div>
                                            </div>
                                            <div class="form-group">
                                                <label>Unit Name</label>
                                                <span class="colon">:</span>
                                                <div class="col-sm-10"><?php echo $this->Form->input('name', array('class' => 'form-control', 'label' => false, 'div' => false)); ?></div>
                                            </div>


                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="panel panel-default">

                                <div class="panel-heading">
                                    <h4 class="panel-title">
                                        <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion1" href="#acc2_collapseOne">
                                            Unit Structure
                                        </a>
                                    </h4>
                                </div>
                                <div id="acc2_collapseOne" class="panel-collapse collapse">
                                    <div class="panel-body">
                                        <div class="col-sm-6">  
                                            <div class="form-group">
                                                <label>Sellable (Lowest)</label>
                                                <span class="colon">:</span>
                                                <div class="col-sm-10"><?php echo $this->Form->input('unit_name', array('value' => $project_units['ProjectUnit']['unit_sellable_area_lowest_size'], 'readonly' => true, 'label' => false, 'div' => false, 'class' => 'form-control rgt taxes_duty')); ?></div>
                                            </div>
                                            <div class="form-group">
                                                <label>Sellable (Highest)</label>
                                                <span class="colon">:</span>
                                                <div class="col-sm-10"><?php echo $this->Form->input('unit_name', array('value' => $project_units['ProjectUnit']['unit_sellable_area_highest_size'], 'readonly' => true, 'label' => false, 'div' => false, 'class' => 'form-control rgt taxes_duty')); ?></div>
                                            </div>
                                            <div class="form-group">
                                                <label>Carpet (Highest)</label>
                                                <span class="colon">:</span>
                                                <div class="col-sm-10"><?php echo $this->Form->input('unit_name', array('value' => $project_units['ProjectUnit']['unit_carpet_area_highest_size'], 'readonly' => true, 'label' => false, 'div' => false, 'class' => 'form-control rgt taxes_duty')); ?></div>
                                            </div>
                                            <div class="form-group">
                                                <label>Carpet (Lowest)</label>
                                                <span class="colon">:</span>
                                                <div class="col-sm-10"><?php
                                                    echo $this->Form->input('unit_name', array('value' => $project_units['ProjectUnit']['units_carpet_area_lowest_size'], 'readonly' => true, 'label' => false, 'div' => false, 'class' => 'form-control rgt taxes_duty'));
                                                    ?></div>
                                            </div>      












                                        </div>
                                        <div class="col-sm-6">

                                            <div class="form-group">
                                                <label>Sellable (Lowest)</label>
                                                <span class="colon">:</span>
                                                <div class="col-sm-10"><?php echo $this->Form->input('name', array('class' => 'form-control rgt', 'label' => false, 'div' => false)); ?></div>
                                            </div>
                                            <div class="form-group">
                                                <label>Sellable (Highest)</label>
                                                <span class="colon">:</span>
                                                <div class="col-sm-10"><?php echo $this->Form->input('name', array('class' => 'form-control rgt', 'label' => false, 'div' => false)); ?></div>
                                            </div>
                                            <div class="form-group">
                                                <label>Carpet (Highest)</label>
                                                <span class="colon">:</span>
                                                <div class="col-sm-10"><?php echo $this->Form->input('name', array('class' => 'form-control rgt', 'label' => false, 'div' => false)); ?></div>
                                            </div>
                                            <div class="form-group">
                                                <label>Carpet (Lowest)</label>
                                                <span class="colon">:</span>
                                                <div class="col-sm-10"><?php echo $this->Form->input('name', array('class' => 'form-control rgt', 'label' => false, 'div' => false)); ?></div>
                                            </div>         
                                        </div>
                                    </div>
                                </div>
                            </div>



                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="panel-title">
                                        <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#acc2_collapseTwo">
                                            Unit Cost / Sq Ft
                                        </a>
                                    </h4>
                                </div>
                                <div id="acc2_collapseTwo" class="panel-collapse collapse">
                                    <div class="panel-body">
                                        <div class="col-sm-6">        

                                            <div class="form-group">
                                                <label>Basic Price / Sq Ft</label>
                                                <span class="colon">:</span>
                                                <div class="col-sm-10"><?php
                                                    echo $this->Form->input('unit_name', array('value' => $project_units['ProjectUnit']['unit_total_basic_cost'], 'readonly' => true, 'label' => false, 'div' => false, 'class' => 'form-control rgt taxes_duty'));
                                                    ?></div>
                                            </div>
                                            <div class="form-group">
                                                <label>Other / Sq Ft</label>
                                                <span class="colon">:</span>
                                                <div class="col-sm-10"><?php echo $this->Form->input('unit_name', array('value' => $project_units['ProjectUnit']['unit_other_cost_per_sq_ft'], 'readonly' => true, 'label' => false, 'div' => false, 'class' => 'form-control rgt taxes_duty')); ?></div>
                                            </div> 
                                            <div class="form-group">
                                                <label>Floor Rise / Sq Ft </label>
                                                <span class="colon">:</span>
                                                <div class="col-sm-10"><?php echo $this->Form->input('unit_name', array('value' => $project_units['ProjectUnit']['unit_floor_charges_sq_ft'], 'readonly' => true, 'label' => false, 'div' => false, 'class' => 'form-control rgt taxes_duty')); ?></div>
                                            </div>  
                                            <div class="form-group">
                                                <label>Floor Rise From</label>
                                                <span class="colon">:</span>
                                                <div class="col-sm-10"><?php echo $this->Form->input('unit_name', array('value' => $project_units['ProjectUnit']['unit_floor_rise_or_plc_from'], 'readonly' => true, 'label' => false, 'div' => false, 'class' => 'form-control rgt taxes_duty')); ?></div>
                                            </div> 
                                            <div class="form-group">
                                                <label>PLC / Sq Ft</label>
                                                <span class="colon">:</span>
                                                <div class="col-sm-10"><?php echo $this->Form->input('unit_name', array('value' => $project_units['ProjectUnit']['unit_plc_charges_sq_ft'], 'readonly' => true, 'label' => false, 'div' => false, 'class' => 'form-control  rgt taxes_duty')); ?></div>
                                            </div> 






                                        </div>
                                        <div class="col-sm-6">

                                            <div class="form-group">
                                                <label>Basic Price / Sq Ft</label>
                                                <span class="colon">:</span>
                                                <div class="col-sm-10"><?php
                                                    echo $this->Form->input('name', array('class' => 'form-control rgt', 'label' => false, 'div' => false));
                                                    ?></div>
                                            </div>
                                            <div class="form-group">
                                                <label>Other / Sq Ft</label>
                                                <span class="colon">:</span>
                                                <div class="col-sm-10"><?php echo $this->Form->input('name', array('class' => 'form-control rgt', 'label' => false, 'div' => false)); ?></div>
                                            </div> 
                                            <div class="form-group">
                                                <label>Floor Rise / Sq Ft </label>
                                                <span class="colon">:</span>
                                                <div class="col-sm-10"><?php echo $this->Form->input('name', array('class' => 'form-control rgt', 'label' => false, 'div' => false)); ?></div>
                                            </div>  
                                            <div class="form-group">
                                                <label>Floor Rise From</label>
                                                <span class="colon">:</span>
                                                <div class="col-sm-10"><?php echo $this->Form->input('name', array('class' => 'form-control rgt', 'label' => false, 'div' => false)); ?></div>
                                            </div> 
                                            <div class="form-group">
                                                <label>PLC / Sq Ft</label>
                                                <span class="colon">:</span>
                                                <div class="col-sm-10"><?php echo $this->Form->input('name', array('class' => 'form-control rgt', 'label' => false, 'div' => false)); ?></div>
                                            </div> 

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="panel-title">
                                        <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#acc2_collapseThree">
                                            Lump sum cost (Pre-agreement)
                                        </a>
                                    </h4>
                                </div>
                                <div id="acc2_collapseThree" class="panel-collapse collapse">
                                    <div class="panel-body">
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label>Amenities Cost </label>
                                                <span class="colon">:</span>
                                                <div class="col-sm-10"><?php
                                                    echo $this->Form->input('unit_name', array('value' => $project_units['ProjectUnit']['unit_amenities_cost'], 'readonly' => true, 'label' => false, 'div' => false, 'class' => 'form-control rgt'));
                                                    ?></div>
                                            </div>
                                            <div class="form-group">
                                                <label>Infrastructure Cost</label>
                                                <span class="colon">:</span>
                                                <div class="col-sm-10"><?php echo $this->Form->input('unit_name', array('value' => $project_units['ProjectUnit']['unit_infra_pre_agreement_cost'], 'readonly' => true, 'label' => false, 'div' => false, 'class' => 'form-control rgt')); ?></div>
                                            </div>   
                                            <div class="form-group">
                                                <label>Car Parking Cost </label>
                                                <span class="colon">:</span>
                                                <div class="col-sm-10"><?php echo $this->Form->input('unit_name', array('value' => $project_units['ProjectUnit']['unit_car_parking_cost'], 'readonly' => true, 'label' => false, 'div' => false, 'class' => 'form-control rgt')); ?></div>
                                            </div>
                                            <div class="form-group">
                                                <label>Other Cost</label>
                                                <span class="colon">:</span>
                                                <div class="col-sm-10"><?php echo $this->Form->input('unit_name', array('value' => $project_units['ProjectUnit']['unit_other_pre_agreement_cost'], 'readonly' => true, 'label' => false, 'div' => false, 'class' => 'form-control rgt')); ?></div>
                                            </div>   
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label>Amenities Cost </label>
                                                <span class="colon">:</span>
                                                <div class="col-sm-10"><?php
                                                    echo $this->Form->input('name', array('class' => 'form-control rgt', 'label' => false, 'div' => false));
                                                    ?></div>
                                            </div>
                                            <div class="form-group">
                                                <label>Infrastructure Cost</label>
                                                <span class="colon">:</span>
                                                <div class="col-sm-10"><?php echo $this->Form->input('name', array('class' => 'form-control rgt', 'label' => false, 'div' => false)); ?></div>
                                            </div>   
                                            <div class="form-group">
                                                <label>Car Parking Cost </label>
                                                <span class="colon">:</span>
                                                <div class="col-sm-10"><?php
                                                    echo $this->Form->input('name', array('class' => 'form-control rgt', 'label' => false, 'div' => false));
                                                    ?></div>
                                            </div>
                                            <div class="form-group">
                                                <label>Other Cost</label>
                                                <span class="colon">:</span>
                                                <div class="col-sm-10"><?php echo $this->Form->input('name', array('class' => 'form-control rgt', 'label' => false, 'div' => false)); ?></div>
                                            </div> 

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="panel-title">
                                        <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#acc2_collapseFour">
                                            Taxes & Duties
                                        </a>
                                    </h4>
                                </div>

                                <div id="acc2_collapseFour" class="panel-collapse collapse">
                                    <div class="panel-body">
                                        <div class="col-sm-6">
                                            <div class="form-group percsym">
                                                <label>Stamp Duty %  </label>
                                                <span class="colon">:</span>
                                                <div class="col-sm-10"><div class="input-group"><?php echo $this->Form->input('unit_name', array('value' => $project_units['ProjectUnit']['unit_stamp_duty'], 'readonly' => true, 'label' => false, 'div' => false, 'class' => 'form-control rgt taxes_duty')); ?><span class="input-group-addon">%</span></div></div>
                                            </div>
                                            <div class="form-group percsym">
                                                <label>Service Tax % </label>
                                                <span class="colon">:</span>
                                                <div class="col-sm-10"><div class="input-group"><?php echo $this->Form->input('unit_name', array('value' => $project_units['ProjectUnit']['unit_service_tax'], 'readonly' => true, 'label' => false, 'div' => false, 'class' => 'form-control rgt taxes_duty')); ?><span class="input-group-addon">%</span></div></div>
                                            </div>  
                                            <div class="form-group percsym">
                                                <label>VAT % </label>
                                                <span class="colon">:</span>
                                                <div class="col-sm-10"><div class="input-group"><?php echo $this->Form->input('unit_name', array('value' => $project_units['ProjectUnit']['unit_vat'], 'readonly' => true, 'label' => false, 'div' => false, 'class' => 'form-control rgt taxes_duty')); ?><span class="input-group-addon">%</span></div></div>
                                            </div>
                                            <div class="form-group">
                                                <label>Registration</label>
                                                <span class="colon">:</span>
                                                <div class="col-sm-10"><?php
                                                    echo $this->Form->input('unit_name', array('value' => $project_units['ProjectUnit']['unit_registration_cost'], 'readonly' => true, 'label' => false, 'div' => false, 'class' => 'form-control rgt taxes_duty'));
                                                    ?></div>
                                            </div> 
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group percsym">
                                                <label>Stamp Duty %  </label>
                                                <span class="colon">:</span>
                                                <div class="col-sm-10"><div class="input-group"><?php echo $this->Form->input('name', array('class' => 'form-control rgt taxes_duty', 'label' => false, 'div' => false)); ?><span class="input-group-addon">%</span></div></div>
                                            </div>
                                            <div class="form-group percsym">
                                                <label>Service Tax % </label>
                                                <span class="colon">:</span>
                                                <div class="col-sm-10"><div class="input-group"><?php echo $this->Form->input('name', array('class' => 'form-control rgt taxes_duty', 'label' => false, 'div' => false)); ?><span class="input-group-addon">%</span></div></div>
                                            </div>  
                                            <div class="form-group percsym">
                                                <label>VAT % </label>
                                                <span class="colon">:</span>
                                                <div class="col-sm-10"><div class="input-group"><?php echo $this->Form->input('name', array('class' => 'form-control rgt taxes_duty', 'label' => false, 'div' => false)); ?><span class="input-group-addon">%</span></div></div>
                                            </div>
                                            <div class="form-group">
                                                <label>Registration</label>
                                                <span class="colon">:</span>
                                                <div class="col-sm-10"><?php echo $this->Form->input('name', array('class' => 'form-control rgt taxes_duty', 'label' => false, 'div' => false)); ?></div>
                                            </div>  
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="panel-title">
                                        <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#acc2_collapseFive">
                                            Lump sum cost (Post-agreement)
                                        </a>
                                    </h4>
                                </div>
                                <div id="acc2_collapseFive" class="panel-collapse collapse">
                                    <div class="panel-body">
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label>Society / Maint</label>
                                                <span class="colon">:</span>
                                                <div class="col-sm-10"><?php
                                                    echo $this->Form->input('unit_name', array('value' => $project_units['ProjectUnit']['unit_societies_cost'], 'readonly' => true, 'label' => false, 'div' => false, 'class' => 'form-control rgt taxes_duty'));
                                                    ?></div>
                                            </div>
                                            <div class="form-group">
                                                <label>Infra Charges </label>
                                                <span class="colon">:</span>
                                                <div class="col-sm-10"><?php echo $this->Form->input('unit_name', array('value' => $project_units['ProjectUnit']['unit_other_infra_charges'], 'readonly' => true, 'label' => false, 'div' => false, 'class' => 'form-control rgt taxes_duty')); ?></div>
                                            </div> 
                                            <div class="form-group">
                                                <label>Legal Charges</label>
                                                <span class="colon">:</span>
                                                <div class="col-sm-10"><?php echo $this->Form->input('unit_name', array('value' => $project_units['ProjectUnit']['unit_legal_cost'], 'readonly' => true, 'label' => false, 'div' => false, 'class' => 'form-control rgt taxes_duty')); ?></div>
                                            </div>
                                            <div class="form-group">
                                                <label>Other Charges</label>
                                                <span class="colon">:</span>
                                                <div class="col-sm-10"><?php echo $this->Form->input('unit_name', array('value' => $project_units['ProjectUnit']['unit_other_charges'], 'readonly' => true, 'label' => false, 'div' => false, 'class' => 'form-control rgt taxes_duty')); ?></div>
                                            </div>       
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label>Society / Maint</label>
                                                <span class="colon">:</span>
                                                <div class="col-sm-10"><?php
                                                    echo $this->Form->input('name', array('class' => 'form-control rgt taxes_duty', 'label' => false, 'div' => false));
                                                    ?></div>
                                            </div>
                                            <div class="form-group">
                                                <label>Infra Charges </label>
                                                <span class="colon">:</span>
                                                <div class="col-sm-10"><?php echo $this->Form->input('name', array('class' => 'form-control rgt taxes_duty', 'label' => false, 'div' => false)); ?></div>
                                            </div>
                                            <div class="form-group">
                                                <label>Legal Charges</label>
                                                <span class="colon">:</span>
                                                <div class="col-sm-10"><?php
                                                    echo $this->Form->input('name', array('class' => 'form-control rgt taxes_duty', 'label' => false, 'div' => false));
                                                    ?></div>
                                            </div>
                                            <div class="form-group">
                                                <label>Other Charges</label>
                                                <span class="colon">:</span>
                                                <div class="col-sm-10"><?php
                                                    echo $this->Form->input('name', array('class' => 'form-control rgt taxes_duty', 'label' => false, 'div' => false));
                                                    ?></div>
                                            </div>  
                                        </div> 
                                    </div>
                                </div>
                            </div>



                        </div>
                    <?php } ?>
                </div>
                <div class="col-sm-12">
                    <div class="row">

                        <div class="col-sm-1">
                            <?php
                            echo $this->Form->submit('Add', array('class' => 'btn btn-success sticky_success'));
                            ?>
                        </div>
                        <div class="col-sm-1">
                            <?php echo $this->Form->button('Reset', array('type' => 'reset', 'class' => 'btn btn-danger sticky_important')); ?>
                        </div>


                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
echo $this->Form->end();

/* * *****************************Ajax function *********************************** */
/**
 *
 * Get Builder List By Project Id
 */
$this->Js->get('#DealDealProjectId')->event('change', $this->Js->request(array(
            'controller' => 'all_functions',
            'action' => 'get_list_builder_by_project_id/Deal'
                ), array(
            'update' => '#DealDealBuilderId',
            'async' => true,
            'before' => 'loading("DealDealBuilderId")',
            'complete' => 'loaded("DealDealBuilderId")',
            'method' => 'post',
            'dataExpression' => true,
            'data' => $this->Js->serializeForm(array(
                'isForm' => true,
                'inline' => true
            ))
        ))
);

/**
 *
 * Get Unit List By Project Id
 */
$this->Js->get('#DealDealProjectId')->event('change', $this->Js->request(array(
            'controller' => 'all_functions',
            'action' => 'get_unit_by_project_id/Deal'
                ), array(
            'update' => '#DealDealProjectUnitId',
            'async' => true,
            'before' => 'loading("DealDealProjectUnitId")',
            'complete' => 'loaded("DealDealProjectUnitId")',
            'method' => 'post',
            'dataExpression' => true,
            'data' => $this->Js->serializeForm(array(
                'isForm' => true,
                'inline' => true
            ))
        ))
);

/**
 *
 * Get Project Legal List By Project Id
 */
$this->Js->get('#DealDealProjectId')->event('change', $this->Js->request(array(
            'controller' => 'all_functions',
            'action' => 'get_project_legal_list_by_project_id/Deal'
                ), array(
            'update' => '#DealDealProjectLegalNameId',
            'async' => true,
            'before' => 'loading("DealDealProjectLegalNameId")',
            'complete' => 'loaded("DealDealProjectLegalNameId")',
            'method' => 'post',
            'dataExpression' => true,
            'data' => $this->Js->serializeForm(array(
                'isForm' => true,
                'inline' => true
            ))
        ))
);

/**
 *
 * Get Project Legal Name Details By Project Legal Id
 */
$this->Js->get('#DealDealProjectLegalNameId')->event('change', $this->Js->request(array(
            'controller' => 'all_functions',
            'action' => 'get_project_legal_details_by_prolegal_id/Deal'
                ), array(
            'update' => '#ajax_prolegal',
            'async' => true,
            'before' => 'loading_img("ajax_prolegal")',
            'complete' => 'loaded_img("ajax_prolegal")',
            'method' => 'post',
            'dataExpression' => true,
            'data' => $this->Js->serializeForm(array(
                'isForm' => true,
                'inline' => true
            ))
        ))
);

/**
 *
 * Get Unit Details By UNit Id
 */
$this->Js->get('#DealDealProjectUnitId')->event('change', $this->Js->request(array(
            'controller' => 'all_functions',
            'action' => 'get_project_unit_details_by_unit_id/Deal'
                ), array(
            'update' => '#ajax_unit',
            'async' => true,
            'before' => 'loading_img("ajax_unit")',
            'complete' => 'loaded_img("ajax_unit")',
            'method' => 'post',
            'dataExpression' => true,
            'data' => $this->Js->serializeForm(array(
                'isForm' => true,
                'inline' => true
            ))
        ))
);

/**
 *
 * Get Client Details By Client Id
 */
$this->Js->get('#DealDealClientId')->event('change', $this->Js->request(array(
            'controller' => 'all_functions',
            'action' => 'get_client_details_by_client_id/Deal'
                ), array(
            'update' => '#ajax_client',
            'async' => true,
            'before' => 'loading_img("ajax_client")',
            'complete' => 'loaded_img("ajax_client")',
            'method' => 'post',
            'dataExpression' => true,
            'data' => $this->Js->serializeForm(array(
                'isForm' => true,
                'inline' => true
            ))
        ))
);
?>   
<script>
    $('#ActionItemTypeId').change(function() {
        var val = $(this).val();
        if (val == '20') {
            $('.release_cln').css('display', 'block');
            $('.report_tran').css('display', 'none');
        }
        else
        {
            $('.release_cln').css('display', 'none');
            $('.report_tran').css('display', 'block');
        }
    });
</script>
