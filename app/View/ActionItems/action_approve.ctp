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

echo $this->Form->hidden('Deal.deal_unit_floor_rise_or_plc');
echo $this->Form->hidden('Deal.deal_basic_cost');
echo $this->Form->hidden('Deal.deal_total_lump_cost');
echo $this->Form->hidden('Deal.deal_agreement_cost');
echo $this->Form->hidden('Deal.deal_post_tax_total');
echo $this->Form->hidden('Deal.deal_payable_cost');
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
                            <label for="reg_input_name" class="req">Client</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10">
                                <?php
                                echo $this->Form->input('Deal.deal_client_id', array('options' => $lead_lt, 'empty' => '--Select'));
                                ?></div>
                        </div>

                        <div class="form-group">
                            <label>Unit Number</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10"><?php echo $this->Form->input('Deal.deal_unit_number', array('class' => 'form-control rgt', 'tabindex' => '19', 'type' => 'text')); ?></div>
                        </div>
                        <div class="form-group">
                            <label>Cluster Number</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10"><?php echo $this->Form->input('Deal.deal_unit_cluster', array('class' => 'form-control rgt', 'tabindex' => '19', 'type' => 'text')); ?></div>
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
                            <label>Tower Number</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10"><?php echo $this->Form->input('Deal.deal_unit_tower_or_building', array('class' => 'form-control rgt', 'tabindex' => '19', 'type' => 'text')); ?></div>
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
                    </div>
                </div>
                <div class="col-sm-12 release_cln" style="display:none;">
                    <div class="form-group padd_textarea">
                        <label>Comment</label>
                        <span class="colon">:</span>
                        <div class="col-sm-10">
                            <?php
                            echo $this->Form->input('other_release', array('type' => 'textarea'));
                            ?></div>
                    </div>
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
                                                    ?>
                                                    <span class="copy_right_arrow" id="copy_unit_type"></span>
                                                </div>

                                            </div>
                                            <div class="form-group">
                                                <label>Floor Number</label>
                                                <span class="colon">:</span>
                                                <div class="col-sm-10"><?php
                                                    echo $this->Form->input('unit_floor_number', array('value' => $project_units['ProjectUnit']['unit_floor_number'], 'readonly' => true, 'label' => false, 'div' => false, 'class' => 'form-control rgt'));
                                                    ?>
                                                    <span class="copy_right_arrow" id="copy_unit_floor_number"></span>
                                                </div>

                                            </div>    
                                            <div class="form-group">
                                                <label>Unit Display Name</label>
                                                <span class="colon">:</span>
                                                <div class="col-sm-10"><?php
                                                    echo $this->Form->input('unit_name', array('value' => $project_units['ProjectUnit']['unit_name'], 'readonly' => true, 'label' => false, 'div' => false, 'class' => 'form-control'));
                                                    ?>
                                                    <span class="copy_right_arrow" id="copy_unit_name"></span>
                                                </div>

                                            </div>
                                            <div class="form-group">
                                                <label>Sellable</label>
                                                <span class="colon">:</span>
                                                <div class="col-sm-10"><?php echo $this->Form->input('unit_name', array('value' => $project_units['ProjectUnit']['unit_sellable_area_lowest_size'] . ' / ' . $project_units['ProjectUnit']['unit_sellable_area_highest_size'], 'readonly' => true, 'label' => false, 'div' => false, 'class' => 'form-control rgt taxes_duty')); ?></div>
                                            </div>    
                                            <div class="form-group">
                                                <label>Carpet</label>
                                                <span class="colon">:</span>
                                                <div class="col-sm-10"><?php echo $this->Form->input('unit_name', array('value' => $project_units['ProjectUnit']['units_carpet_area_lowest_size'] . ' / ' . $project_units['ProjectUnit']['unit_carpet_area_highest_size'], 'readonly' => true, 'label' => false, 'div' => false, 'class' => 'form-control rgt taxes_duty')); ?></div>
                                            </div>    







                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label>Unit Type </label>
                                                <span class="colon">:</span>
                                                <div class="col-sm-10"><?php echo $this->Form->input('Deal.deal_unit_type', array('class' => 'form-control', 'label' => false, 'div' => false)); ?></div>
                                            </div>
                                            <div class="form-group">
                                                <label>Floor Number</label>
                                                <span class="colon">:</span>
                                                <div class="col-sm-10"><?php echo $this->Form->input('Deal.deal_unit_floor_number', array('class' => 'form-control rgt', 'label' => false, 'div' => false)); ?></div>
                                            </div>
                                            <div class="form-group">
                                                <label>Unit Display Name</label>
                                                <span class="colon">:</span>
                                                <div class="col-sm-10"><?php echo $this->Form->input('Deal.deal_unit_name', array('class' => 'form-control', 'label' => false, 'div' => false)); ?></div>
                                            </div>
                                            <div class="form-group">
                                                <label>Sold Area</label>
                                                <span class="colon">:</span>
                                                <div class="col-sm-10"><?php echo $this->Form->input('Deal.deal_sold_area', array('class' => 'form-control', 'label' => false, 'div' => false)); ?></div>
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
                                                    echo $this->Form->input('unit_total_basic_cost', array('value' => $project_units['ProjectUnit']['unit_total_basic_cost'], 'readonly' => true, 'label' => false, 'div' => false, 'class' => 'form-control rgt taxes_duty'));
                                                    ?>
                                                    <span class="copy_right_arrow" id="copy_unit_basic_cost"></span>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label>Other / Sq Ft</label>
                                                <span class="colon">:</span>
                                                <div class="col-sm-10"><?php echo $this->Form->input('unit_other_cost_per_sq_ft', array('value' => $project_units['ProjectUnit']['unit_other_cost_per_sq_ft'], 'readonly' => true, 'label' => false, 'div' => false, 'class' => 'form-control rgt taxes_duty')); ?>
                                                    <span class="copy_right_arrow" id="copy_unit_other_cost_per_sq_ft"></span>
                                                </div>
                                            </div> 
                                            <div class="form-group">
                                                <label>Floor Rise / Sq Ft </label>
                                                <span class="colon">:</span>
                                                <div class="col-sm-10"><?php echo $this->Form->input('unit_floor_charges_sq_ft', array('value' => $project_units['ProjectUnit']['unit_floor_charges_sq_ft'], 'readonly' => true, 'label' => false, 'div' => false, 'class' => 'form-control rgt taxes_duty')); ?>
                                                    <span class="copy_right_arrow" id="copy_unit_floor_charges_sq_ft"></span>
                                                </div>
                                            </div>  
                                            <div class="form-group">
                                                <label>Floor Rise From</label>
                                                <span class="colon">:</span>
                                                <div class="col-sm-10"><?php echo $this->Form->input('unit_floor_rise_or_plc_from', array('value' => $project_units['ProjectUnit']['unit_floor_rise_or_plc_from'], 'readonly' => true, 'label' => false, 'div' => false, 'class' => 'form-control rgt taxes_duty')); ?>
                                                    <span class="copy_right_arrow" id="copy_unit_floor_rise_or_plc_from"></span>
                                                </div>
                                            </div> 
                                            <div class="form-group">
                                                <label>PLC / Sq Ft</label>
                                                <span class="colon">:</span>
                                                <div class="col-sm-10"><?php echo $this->Form->input('unit_plc_charges_sq_ft', array('value' => $project_units['ProjectUnit']['unit_plc_charges_sq_ft'], 'readonly' => true, 'label' => false, 'div' => false, 'class' => 'form-control  rgt taxes_duty')); ?>
                                                    <span class="copy_right_arrow" id="copy_unit_plc_charges_sq_ft"></span>
                                                </div>
                                            </div> 






                                        </div>
                                        <div class="col-sm-6">

                                            <div class="form-group">
                                                <label>Basic Price / Sq Ft</label>
                                                <span class="colon">:</span>
                                                <div class="col-sm-10"><?php
                                                    echo $this->Form->input('Deal.deal_unit_basic_cost', array('class' => 'form-control rgt', 'label' => false, 'div' => false));
                                                    ?>

                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label>Other / Sq Ft</label>
                                                <span class="colon">:</span>
                                                <div class="col-sm-10"><?php echo $this->Form->input('Deal.deal_unit_other_cost_per_sq_ft', array('class' => 'form-control rgt', 'label' => false, 'div' => false)); ?></div>
                                            </div> 
                                            <div class="form-group">
                                                <label>Floor Rise / Sq Ft </label>
                                                <span class="colon">:</span>
                                                <div class="col-sm-10"><?php echo $this->Form->input('Deal.deal_unit_floor_charges_sq_ft', array('class' => 'form-control rgt', 'label' => false, 'div' => false)); ?></div>
                                            </div>  
                                            <div class="form-group">
                                                <label>Floor Rise From</label>
                                                <span class="colon">:</span>
                                                <div class="col-sm-10"><?php echo $this->Form->input('Deal.deal_unit_floor_rise_or_plc_from', array('class' => 'form-control rgt', 'label' => false, 'div' => false)); ?></div>
                                            </div> 
                                            <div class="form-group">
                                                <label>PLC / Sq Ft</label>
                                                <span class="colon">:</span>
                                                <div class="col-sm-10"><?php echo $this->Form->input('Deal.deal_unit_plc_charges_sq_ft', array('class' => 'form-control rgt', 'label' => false, 'div' => false)); ?></div>
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
                                                    echo $this->Form->input('unit_amenities_cost', array('value' => $project_units['ProjectUnit']['unit_amenities_cost'], 'readonly' => true, 'label' => false, 'div' => false, 'class' => 'form-control rgt'));
                                                    ?>
                                                    <span class="copy_right_arrow" id="copy_unit_amenities_cost"></span>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label>Infrastructure Cost</label>
                                                <span class="colon">:</span>
                                                <div class="col-sm-10"><?php echo $this->Form->input('unit_infra_pre_agreement_cost', array('value' => $project_units['ProjectUnit']['unit_infra_pre_agreement_cost'], 'readonly' => true, 'label' => false, 'div' => false, 'class' => 'form-control rgt')); ?>
                                                    <span class="copy_right_arrow" id="copy_unit_infra_pre_agreement_cost"></span>
                                                </div>
                                            </div>   
                                            <div class="form-group">
                                                <label>Car Parking Cost </label>
                                                <span class="colon">:</span>
                                                <div class="col-sm-10"><?php echo $this->Form->input('unit_car_parking_cost', array('value' => $project_units['ProjectUnit']['unit_car_parking_cost'], 'readonly' => true, 'label' => false, 'div' => false, 'class' => 'form-control rgt')); ?>
                                                    <span class="copy_right_arrow" id="copy_unit_car_parking_cost"></span>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label>Other Cost</label>
                                                <span class="colon">:</span>
                                                <div class="col-sm-10"><?php echo $this->Form->input('unit_other_pre_agreement_cost', array('value' => $project_units['ProjectUnit']['unit_other_pre_agreement_cost'], 'readonly' => true, 'label' => false, 'div' => false, 'class' => 'form-control rgt')); ?>
                                                    <span class="copy_right_arrow" id="copy_unit_other_pre_agreement_cost"></span>
                                                </div>
                                            </div>   
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label>Amenities Cost </label>
                                                <span class="colon">:</span>
                                                <div class="col-sm-10"><?php
                                                    echo $this->Form->input('Deal.deal_unit_amenities_cost', array('class' => 'form-control rgt', 'label' => false, 'div' => false));
                                                    ?></div>
                                            </div>
                                            <div class="form-group">
                                                <label>Infrastructure Cost</label>
                                                <span class="colon">:</span>
                                                <div class="col-sm-10"><?php echo $this->Form->input('Deal.deal_unit_infra_pre_agreement_cost', array('class' => 'form-control rgt', 'label' => false, 'div' => false)); ?></div>
                                            </div>   
                                            <div class="form-group">
                                                <label>Car Parking Cost </label>
                                                <span class="colon">:</span>
                                                <div class="col-sm-10"><?php
                                                    echo $this->Form->input('Deal.deal_unit_car_parking_cost', array('class' => 'form-control rgt', 'label' => false, 'div' => false));
                                                    ?></div>
                                            </div>
                                            <div class="form-group">
                                                <label>Other Cost</label>
                                                <span class="colon">:</span>
                                                <div class="col-sm-10"><?php echo $this->Form->input('Deal.deal_unit_other_pre_agreement_cost', array('class' => 'form-control rgt', 'label' => false, 'div' => false)); ?></div>
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
                                                <div class="col-sm-10"><div class="input-group"><?php echo $this->Form->input('unit_stamp_duty', array('value' => $project_units['ProjectUnit']['unit_stamp_duty'], 'readonly' => true, 'label' => false, 'div' => false, 'class' => 'form-control rgt taxes_duty')); ?><span class="input-group-addon">%</span></div>
                                                    <span class="copy_right_arrow" id="copy_unit_stamp_duty"></span>
                                                </div>
                                            </div>
                                            <div class="form-group percsym">
                                                <label>Service Tax % </label>
                                                <span class="colon">:</span>
                                                <div class="col-sm-10"><div class="input-group"><?php echo $this->Form->input('unit_service_tax', array('value' => $project_units['ProjectUnit']['unit_service_tax'], 'readonly' => true, 'label' => false, 'div' => false, 'class' => 'form-control rgt taxes_duty')); ?><span class="input-group-addon">%</span></div>
                                                    <span class="copy_right_arrow" id="copy_unit_service_tax"></span>
                                                </div>
                                            </div>  
                                            <div class="form-group percsym">
                                                <label>VAT % </label>
                                                <span class="colon">:</span>
                                                <div class="col-sm-10"><div class="input-group"><?php echo $this->Form->input('unit_vat', array('value' => $project_units['ProjectUnit']['unit_vat'], 'readonly' => true, 'label' => false, 'div' => false, 'class' => 'form-control rgt taxes_duty')); ?><span class="input-group-addon">%</span></div>
                                                    <span class="copy_right_arrow" id="copy_unit_vat"></span>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label>Registration</label>
                                                <span class="colon">:</span>
                                                <div class="col-sm-10"><?php
                                                    echo $this->Form->input('unit_registration_cost', array('value' => $project_units['ProjectUnit']['unit_registration_cost'], 'readonly' => true, 'label' => false, 'div' => false, 'class' => 'form-control rgt taxes_duty'));
                                                    ?>
                                                    <span class="copy_right_arrow" id="copy_unit_registration_cost"></span>
                                                </div>
                                            </div> 
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group percsym">
                                                <label>Stamp Duty %  </label>
                                                <span class="colon">:</span>
                                                <div class="col-sm-10"><div class="input-group"><?php echo $this->Form->input('Deal.deal_unit_stamp_duty', array('class' => 'form-control rgt taxes_duty', 'label' => false, 'div' => false)); ?><span class="input-group-addon">%</span></div></div>
                                            </div>
                                            <div class="form-group percsym">
                                                <label>Service Tax % </label>
                                                <span class="colon">:</span>
                                                <div class="col-sm-10"><div class="input-group"><?php echo $this->Form->input('Deal.deal_unit_service_tax', array('class' => 'form-control rgt taxes_duty', 'label' => false, 'div' => false)); ?><span class="input-group-addon">%</span></div></div>
                                            </div>  
                                            <div class="form-group percsym">
                                                <label>VAT % </label>
                                                <span class="colon">:</span>
                                                <div class="col-sm-10"><div class="input-group"><?php echo $this->Form->input('Deal.deal_unit_vat', array('class' => 'form-control rgt taxes_duty', 'label' => false, 'div' => false)); ?><span class="input-group-addon">%</span></div></div>
                                            </div>
                                            <div class="form-group">
                                                <label>Registration</label>
                                                <span class="colon">:</span>
                                                <div class="col-sm-10"><?php echo $this->Form->input('Deal.deal_unit_registration_cost', array('class' => 'form-control rgt taxes_duty', 'label' => false, 'div' => false)); ?></div>
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
                                                    echo $this->Form->input('unit_societies_cost', array('value' => $project_units['ProjectUnit']['unit_societies_cost'], 'readonly' => true, 'label' => false, 'div' => false, 'class' => 'form-control rgt taxes_duty'));
                                                    ?>
                                                    <span class="copy_right_arrow" id="copy_unit_societies_cost"></span>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label>Infra Charges </label>
                                                <span class="colon">:</span>
                                                <div class="col-sm-10"><?php echo $this->Form->input('unit_other_infra_charges', array('value' => $project_units['ProjectUnit']['unit_other_infra_charges'], 'readonly' => true, 'label' => false, 'div' => false, 'class' => 'form-control rgt taxes_duty')); ?>
                                                    <span class="copy_right_arrow" id="copy_unit_other_infra_charges"></span>
                                                </div>
                                            </div> 
                                            <div class="form-group">
                                                <label>Legal Charges</label>
                                                <span class="colon">:</span>
                                                <div class="col-sm-10"><?php echo $this->Form->input('unit_legal_cost', array('value' => $project_units['ProjectUnit']['unit_legal_cost'], 'readonly' => true, 'label' => false, 'div' => false, 'class' => 'form-control rgt taxes_duty')); ?>
                                                    <span class="copy_right_arrow" id="copy_unit_legal_cost"></span>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label>Other Charges</label>
                                                <span class="colon">:</span>
                                                <div class="col-sm-10"><?php echo $this->Form->input('unit_other_charges', array('value' => $project_units['ProjectUnit']['unit_other_charges'], 'readonly' => true, 'label' => false, 'div' => false, 'class' => 'form-control rgt taxes_duty')); ?>
                                                    <span class="copy_right_arrow" id="copy_unit_other_charges"></span>
                                                </div>
                                            </div>       
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label>Society / Maint</label>
                                                <span class="colon">:</span>
                                                <div class="col-sm-10"><?php
                                                    echo $this->Form->input('Deal.deal_unit_societies_cost', array('class' => 'form-control rgt taxes_duty', 'label' => false, 'div' => false));
                                                    ?></div>
                                            </div>
                                            <div class="form-group">
                                                <label>Infra Charges </label>
                                                <span class="colon">:</span>
                                                <div class="col-sm-10"><?php echo $this->Form->input('Deal.deal_other_infra_charges', array('class' => 'form-control rgt taxes_duty', 'label' => false, 'div' => false)); ?></div>
                                            </div>
                                            <div class="form-group">
                                                <label>Legal Charges</label>
                                                <span class="colon">:</span>
                                                <div class="col-sm-10"><?php
                                                    echo $this->Form->input('Deal.deal_unit_legal_cost', array('class' => 'form-control rgt taxes_duty', 'label' => false, 'div' => false));
                                                    ?></div>
                                            </div>
                                            <div class="form-group">
                                                <label>Other Charges</label>
                                                <span class="colon">:</span>
                                                <div class="col-sm-10"><?php
                                                    echo $this->Form->input('Deal.deal_unit_other_charges', array('class' => 'form-control rgt taxes_duty', 'label' => false, 'div' => false));
                                                    ?></div>
                                            </div>  
                                        </div> 
                                    </div>
                                </div>
                            </div>
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="panel-title">
                                        <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#acc2_collapseNine">
                                            Booking Details
                                        </a>
                                    </h4>
                                </div>
                                <div id="acc2_collapseNine" class="panel-collapse collapse">
                                    <div class="panel-body">
                                        <div class="col-sm-6">

                                            <div class="form-group">
                                                <label>Booking Amount</label>
                                                <span class="colon">:</span>
                                                <div class="col-sm-10"><?php echo $this->Form->input('unit_iniitial_booking_amount', array('value' => $project_units['ProjectUnit']['unit_iniitial_booking_amount'], 'readonly' => true, 'class' => 'form-control rgt', 'tabindex' => '39')); ?>
                                                    <span class="copy_right_arrow" id="copy_unit_iniitial_booking_amount"></span>
                                                </div>
                                            </div>


                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label>Booking Amount</label>
                                                <span class="colon">:</span>
                                                <div class="col-sm-10"><?php echo $this->Form->input('Deal.deal_booking_amount', array('class' => 'form-control rgt', 'tabindex' => '39')); ?></div>
                                            </div>

                                        </div> 
                                    </div>
                                </div>

                            </div>
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="panel-title">
                                        <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#acc2_collapseTen">
                                            Downpayment Details
                                        </a>
                                    </h4>
                                </div>
                                <div id="acc2_collapseTen" class="panel-collapse collapse">
                                    <div class="panel-body">

                                        <div class="col-sm-6">
                                            <h4>Downpayment</h4>
                                            <div class="form-group percsym">
                                                <label>Percent Lumpsum</label>
                                                <span class="colon">:</span>
                                                <div class="col-sm-10"><div class="input-group"><?php echo $this->Form->input('unit_downpayment_on_percent_or_lumpsum', array('value' => $project_units['ProjectUnit']['unit_downpayment_on_percent_or_lumpsum'], 'readonly' => true, 'class' => 'form-control rgt', 'tabindex' => '42', 'label' => false, 'div' => false)); ?><span class="input-group-addon">%</span></div>
                                                    <span class="copy_right_arrow" id="copy_unit_downpayment_on_percent_or_lumpsum"></span>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label>Attached to</label>
                                                <span class="colon">:</span>
                                                <div class="col-sm-10"><?php echo $this->Form->input('unit_downpayment_attached_to_construction', array('options' => $attach_to, 'selected' => $project_units['ProjectUnit']['unit_downpayment_attached_to_construction'], 'disabled' => true, 'empty' => '--Select--', 'tabindex' => '43', 'label' => false, 'div' => false, 'class' => 'form-control')); ?>
                                                    <span class="copy_right_arrow" id="copy_unit_downpayment_attached_to_construction"></span>
                                                </div>
                                            </div>
                                            <div class="form-group int-sm">
                                                <label>Due By</label>
                                                <span class="colon">:</span>
                                                <div class="col-sm-10">  <?php
                                                    echo $this->Form->input('unit_downpayment_amount_due_in', array('value' => $project_units['ProjectUnit']['unit_downpayment_amount_due_in'], 'readonly' => true, 'class' => 'form-control sm rgt', 'tabindex' => '44', 'label' => false, 'div' => false));
                                                    echo $this->Form->input('unit_downpayment_option', array('label' => false, 'options' => array('Days' => 'Days', 'Months' => 'Months'), 'selected' => $project_units['ProjectUnit']['unit_downpayment_option'], 'disabled' => true, 'empty' => '--Select--', 'tabindex' => '45', 'label' => false, 'div' => false, 'class' => 'form-control'));
                                                    ?>
                                                    <span class="copy_right_arrow" id="copy_unit_downpayment_amount_due_in"></span>
                                                </div>
                                            </div>

                                            <h4>Second Payment</h4>

                                            <div class="form-group percsym">
                                                <label>Percent Lumpsum</label>
                                                <span class="colon">:</span>
                                                <div class="col-sm-10"><div class="input-group"><?php echo $this->Form->input('unit_second_payment_on_percent_or_lumpsum', array('value' => $project_units['ProjectUnit']['unit_second_payment_on_percent_or_lumpsum'], 'readonly' => true, 'class' => 'form-control rgt', 'tabindex' => '46', 'label' => false, 'div' => false)); ?><span class="input-group-addon">%</span></div>
                                                    <span class="copy_right_arrow" id="copy_unit_second_payment_on_percent_or_lumpsum"></span>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label>Attached to </label>
                                                <span class="colon">:</span>
                                                <div class="col-sm-10"><?php echo $this->Form->input('unit_second_payment_attached_to_construction', array('options' => $attach_to, 'selected' => $project_units['ProjectUnit']['unit_second_payment_attached_to_construction'], 'disabled' => true, 'empty' => '--Select--', 'tabindex' => '47', 'label' => false, 'div' => false, 'class' => 'form-control')); ?>
                                                    <span class="copy_right_arrow" id="copy_unit_second_payment_attached_to_construction"></span>
                                                </div>
                                            </div>
                                            <div class="form-group int-sm">
                                                <label>Due By</label>
                                                <span class="colon">:</span>
                                                <div class="col-sm-10">  <?php
                                                    echo $this->Form->input('unit_second_payment_amount_due_in', array('value' => $project_units['ProjectUnit']['unit_second_payment_amount_due_in'], 'readonly' => true, 'class' => 'form-control sm rgt', 'tabindex' => '48', 'label' => false, 'div' => false));
                                                    echo $this->Form->input('unit_second_option', array('label' => false, 'options' => array('Days' => 'Days', 'Months' => 'Months'), 'selected' => $project_units['ProjectUnit']['unit_second_option'], 'disabled' => true, 'empty' => '--Select--', 'tabindex' => '49', 'label' => false, 'div' => false, 'class' => 'form-control'));
                                                    ?>
                                                    <span class="copy_right_arrow" id="copy_unit_second_payment_amount_due_in"></span>
                                                </div>
                                            </div>

                                            <h4>Third Payment</h4>   

                                            <div class="form-group percsym">
                                                <label>Percent Lumpsum</label>
                                                <span class="colon">:</span>
                                                <div class="col-sm-10"><div class="input-group"><?php echo $this->Form->input('unit_third_payment_on_percent_or_lumpsum', array('value' => $project_units['ProjectUnit']['unit_third_payment_on_percent_or_lumpsum'], 'readonly' => true, 'class' => 'form-control rgt', 'tabindex' => '50', 'label' => false, 'div' => false)); ?><span class="input-group-addon">%</span></div>
                                                    <span class="copy_right_arrow" id="copy_unit_third_payment_on_percent_or_lumpsum"></span>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label>Attached to</label>
                                                <span class="colon">:</span>
                                                <div class="col-sm-10"><?php echo $this->Form->input('unit_third_payment_attached_to_construction', array('options' => $attach_to, 'selected' => $project_units['ProjectUnit']['unit_third_payment_attached_to_construction'], 'disabled' => true, 'empty' => '--Select--', 'tabindex' => '51', 'label' => false, 'div' => false, 'class' => 'form-control')); ?>
                                                    <span class="copy_right_arrow" id="copy_unit_third_payment_attached_to_construction"></span>
                                                </div>
                                            </div>
                                            <div class="form-group int-sm">
                                                <label>Due By</label>
                                                <span class="colon">:</span>
                                                <div class="col-sm-10">  <?php
                                                    echo $this->Form->input('unit_third_party_amount_due_in', array('value' => $project_units['ProjectUnit']['unit_third_party_amount_due_in'], 'readonly' => true, 'class' => 'form-control sm rgt', 'tabindex' => '52', 'label' => false, 'div' => false));
                                                    echo $this->Form->input('unit_third_party_option', array('label' => false, 'options' => array('Days' => 'Days', 'Months' => 'Months'), 'selected' => $project_units['ProjectUnit']['unit_third_party_option'], 'disabled' => true, 'empty' => '--Select--', 'tabindex' => '53', 'label' => false, 'div' => false, 'class' => 'form-control'));
                                                    ?>
                                                    <span class="copy_right_arrow" id="copy_unit_third_party_amount_due_in"></span>
                                                </div>
                                            </div>


                                        </div>
                                        <div class="col-sm-6">

                                            <h4>&nbsp;</h4>
                                            <div class="form-group percsym">
                                                <label>Percent Lumpsum</label>
                                                <span class="colon">:</span>
                                                <div class="col-sm-10"><div class="input-group"><?php echo $this->Form->input('Deal.deal_unit_downpayment_on_percent_or_lumpsum', array('class' => 'form-control rgt', 'tabindex' => '50', 'label' => false, 'div' => false)); ?><span class="input-group-addon">%</span></div></div>
                                            </div>
                                            <div class="form-group">
                                                <label>Attached to</label>
                                                <span class="colon">:</span>
                                                <div class="col-sm-10"><?php echo $this->Form->input('Deal.deal_unit_downpayment_attached_to_construction', array('options' => $attach_to, 'empty' => '--Select--', 'tabindex' => '51', 'label' => false, 'div' => false, 'class' => 'form-control')); ?></div>
                                            </div>
                                            <div class="form-group int-sm">
                                                <label>Due By</label>
                                                <span class="colon">:</span>
                                                <div class="col-sm-10">  <?php
                                                    echo $this->Form->input('Deal.deal_unit_downpayment_amount_due_in', array('class' => 'form-control sm rgt', 'tabindex' => '52', 'label' => false, 'div' => false));
                                                    echo $this->Form->input('Deal.deal_unit_downpayment_option', array('label' => false, 'options' => array('Days' => 'Days', 'Months' => 'Months'), 'empty' => '--Select--', 'tabindex' => '53', 'label' => false, 'div' => false, 'class' => 'form-control'));
                                                    ?></div>
                                            </div>

                                            <h4>&nbsp;</h4>
                                            <div class="form-group percsym">
                                                <label>Percent Lumpsum</label>
                                                <span class="colon">:</span>
                                                <div class="col-sm-10"><div class="input-group"><?php echo $this->Form->input('Deal.deal_unit_second_payment_on_percent_or_lumpsum', array('class' => 'form-control rgt', 'tabindex' => '50', 'label' => false, 'div' => false)); ?><span class="input-group-addon">%</span></div></div>
                                            </div>
                                            <div class="form-group">
                                                <label>Attached to</label>
                                                <span class="colon">:</span>
                                                <div class="col-sm-10"><?php echo $this->Form->input('Deal.deal_unit_second_payment_attached_to_construction', array('options' => $attach_to, 'empty' => '--Select--', 'tabindex' => '51', 'label' => false, 'div' => false, 'class' => 'form-control')); ?></div>
                                            </div> 
                                            <div class="form-group int-sm">
                                                <label>Due By</label>
                                                <span class="colon">:</span>
                                                <div class="col-sm-10">  <?php
                                                    echo $this->Form->input('Deal.deal_unit_second_payment_amount_due_in', array('class' => 'form-control sm rgt', 'tabindex' => '52', 'label' => false, 'div' => false));
                                                    echo $this->Form->input('Deal.deal_unit_second_option', array('label' => false, 'options' => array('Days' => 'Days', 'Months' => 'Months'), 'empty' => '--Select--', 'tabindex' => '53', 'label' => false, 'div' => false, 'class' => 'form-control'));
                                                    ?></div>
                                            </div>

                                            <h4>&nbsp;</h4>

                                            <div class="form-group percsym">
                                                <label>Percent Lumpsum</label>
                                                <span class="colon">:</span>
                                                <div class="col-sm-10"><div class="input-group"><?php echo $this->Form->input('Deal.deal_unit_third_payment_on_percent_or_lumpsum', array('class' => 'form-control rgt', 'tabindex' => '50', 'label' => false, 'div' => false)); ?><span class="input-group-addon">%</span></div></div>
                                            </div>
                                            <div class="form-group">
                                                <label>Attached to</label>
                                                <span class="colon">:</span>
                                                <div class="col-sm-10"><?php echo $this->Form->input('Deal.deal_unit_third_payment_attached_to_construction', array('options' => $attach_to, 'empty' => '--Select--', 'tabindex' => '51', 'label' => false, 'div' => false, 'class' => 'form-control')); ?></div>
                                            </div>
                                            <div class="form-group int-sm">
                                                <label>Due By</label>
                                                <span class="colon">:</span>
                                                <div class="col-sm-10">  <?php
                                                    echo $this->Form->input('Deal.deal_unit_third_party_amount_due_in', array('class' => 'form-control sm rgt', 'tabindex' => '52', 'label' => false, 'div' => false));
                                                    echo $this->Form->input('Deal.deal_unit_third_party_option', array('label' => false, 'options' => array('Days' => 'Days', 'Months' => 'Months'), 'empty' => '--Select--', 'tabindex' => '53', 'label' => false, 'div' => false, 'class' => 'form-control'));
                                                    ?></div>
                                            </div>


                                        </div> 
                                    </div>
                                </div>
                            </div>
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="panel-title">
                                        <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#acc2_collapseEleven">
                                            Commission Structure
                                        </a>
                                    </h4>
                                </div>
                                <div id="acc2_collapseEleven" class="panel-collapse collapse">
                                    <div class="panel-body">
                                        <div class="col-sm-6">

                                            <div class="form-group percsym">
                                                <label>Commission % </label>
                                                <span class="colon">:</span>
                                                <div class="col-sm-10"><div class="input-group"><?php echo $this->Form->input('unit_commission_percent', array('value' => $project_units['ProjectUnit']['unit_commission_percent'], 'readonly' => true, 'class' => 'form-control rgt taxes_duty', 'tabindex' => '54')); ?><span class="input-group-addon">%</span></div>
                                                    <span class="copy_right_arrow" id="copy_unit_commission_percent"></span>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label>Based on</label>
                                                <span class="colon">:</span>
                                                <div class="col-sm-10"><?php echo $this->Form->input('unit_commission_based_on', array('options' => $based_on, 'selected' => $project_units['ProjectUnit']['unit_commission_based_on'], 'disabled' => true, 'empty' => '--Select--', 'tabindex' => '56')); ?>
                                                    <span class="copy_right_arrow" id="copy_unit_commission_based_on"></span>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label>Commission Event</label>
                                                <span class="colon">:</span>
                                                <div class="col-sm-10"><?php echo $this->Form->input('unit_commission_event', array('options' => $commission_event, 'selected' => $project_units['ProjectUnit']['unit_commission_event'], 'disabled' => true, 'empty' => '--Select--', 'tabindex' => '55')); ?>
                                                    <span class="copy_right_arrow" id="copy_unit_commission_event"></span>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label>Applied To</label>
                                                <span class="colon">:</span>
                                                <div class="col-sm-10"><?php echo $this->Form->input('unit_commission_applied_to', array('value' => $project_units['ProjectUnit']['unit_commission_applied_to'], 'readonly' => true, 'class' => 'form-control rgt', 'readonly' => true, 'tabindex' => '57')); ?>
                                                    <span class="copy_right_arrow" id="copy_unit_commission_applied_to"></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group percsym">
                                                <label>Commission % </label>
                                                <span class="colon">:</span>
                                                <div class="col-sm-10"><div class="input-group"><?php echo $this->Form->input('Deal.deal_unit_commission_percent', array('class' => 'form-control rgt taxes_duty', 'tabindex' => '54')); ?><span class="input-group-addon">%</span></div>

                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label>Based on</label>
                                                <span class="colon">:</span>
                                                <div class="col-sm-10"><?php echo $this->Form->input('Deal.deal_unit_commission_based_on', array('options' => $based_on, 'empty' => '--Select--', 'tabindex' => '56')); ?></div>
                                            </div>
                                            <div class="form-group">
                                                <label>Commission Event</label>
                                                <span class="colon">:</span>
                                                <div class="col-sm-10"><?php echo $this->Form->input('Deal.deal_unit_commission_event', array('options' => $commission_event, 'empty' => '--Select--', 'tabindex' => '55')); ?></div>
                                            </div>
                                            <div class="form-group">
                                                <label>Applied To</label>
                                                <span class="colon">:</span>
                                                <div class="col-sm-10"><?php echo $this->Form->input('Deal.deal_unit_commission_applied_to', array('class' => 'form-control rgt', 'readonly' => true, 'tabindex' => '57')); ?></div>
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
                                                    <span class="copy_right_arrow" id="copy_client_name"></span>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label>Country</label>
                                                <span class="colon">:</span>
                                                <div class="col-sm-10">
                                                    <?php
                                                    echo $this->Form->input('lead_country', array('value' => $leads['Country']['value'], 'readonly' => true, 'label' => false, 'div' => false, 'class' => 'form-control'));
                                                    ?> 
                                                    <span class="copy_right_arrow" id="copy_lead_country"></span>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label>Primary Mobile</label>
                                                <span class="colon">:</span>
                                                <div class="col-sm-10">
                                                    <?php
                                                    echo $this->Form->input('lead_primaryphonenumber', array('value' => $leads['PrimaryCode']['code'] . ' ' . $leads['Lead']['lead_primaryphonenumber'], 'readonly' => true, 'label' => false, 'div' => false, 'class' => 'form-control'));
                                                    ?>
                                                    <span class="copy_right_arrow" id="copy_lead_primaryphonenumber"></span>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label>Secondary Mobile</label>
                                                <span class="colon">:</span>
                                                <div class="col-sm-10">
                                                    <?php
                                                    echo $this->Form->input('lead_secondaryphonenumber', array('value' => $leads['SecondaryCode']['code'] . ' ' . $leads['Lead']['lead_secondaryphonenumber'], 'readonly' => true, 'label' => false, 'div' => false, 'class' => 'form-control'));
                                                    ?> 
                                                    <span class="copy_right_arrow" id="copy_lead_secondaryphonenumber"></span>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label>Email</label>
                                                <span class="colon">:</span>
                                                <div class="col-sm-10">
                                                    <?php
                                                    echo $this->Form->input('lead_emailid', array('value' => $leads['Lead']['lead_emailid'], 'readonly' => true, 'label' => false, 'div' => false, 'class' => 'form-control'));
                                                    ?> 
                                                    <span class="copy_right_arrow" id="copy_lead_emailid"></span>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label>Street Address</label>
                                                <span class="colon">:</span>
                                                <div class="col-sm-10">
                                                    <?php
                                                    echo $this->Form->input('lead_streetaddress', array('value' => $leads['Lead']['lead_streetaddress'], 'readonly' => true, 'label' => false, 'div' => false, 'class' => 'form-control'));
                                                    ?> 
                                                    <span class="copy_right_arrow" id="copy_lead_streetaddress"></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label>Client Name</label>
                                                <span class="colon">:</span>
                                                <div class="col-sm-10">
                                                    <?php echo $this->Form->input('Deal.deal_client_name', array('label' => false, 'div' => false, 'class' => 'form-control')); ?> 
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label>Country</label>
                                                <span class="colon">:</span>
                                                <div class="col-sm-10">
                                                    <?php echo $this->Form->input('Deal.deal_lead_country', array('label' => false, 'div' => false, 'class' => 'form-control')); ?> 
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label>Primary Mobile</label>
                                                <span class="colon">:</span>
                                                <div class="col-sm-10">
                                                    <?php echo $this->Form->input('Deal.deal_lead_primaryphonenumber', array('label' => false, 'div' => false, 'class' => 'form-control')); ?> 
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label>Secondary Mobile</label>
                                                <span class="colon">:</span>
                                                <div class="col-sm-10">
                                                    <?php echo $this->Form->input('Deal.deal_lead_secondaryphonenumber', array('label' => false, 'div' => false, 'class' => 'form-control')); ?> 
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label>Email</label>
                                                <span class="colon">:</span>
                                                <div class="col-sm-10">
                                                    <?php echo $this->Form->input('Deal.deal_lead_emailid', array('label' => false, 'div' => false, 'class' => 'form-control')); ?> 
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label>Street Address</label>
                                                <span class="colon">:</span>
                                                <div class="col-sm-10">
                                                    <?php echo $this->Form->input('Deal.deal_lead_streetaddress', array('label' => false, 'div' => false, 'class' => 'form-control')); ?> 
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>

                    <?php } ?>
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
                                                <div class="col-sm-10"><?php echo $this->Form->input('legal_address', array('value' => $ProjectLegalNames['BuilderLegalName']['builder_legal_names_address'], 'readonly' => true, 'label' => false, 'div' => false, 'class' => 'form-control')); ?>
                                                    <span class="copy_right_arrow" id="copy_legal_address"></span>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label>Legal Location</label>
                                                <span class="colon">:</span>
                                                <div class="col-sm-10"><?php
                                                    echo $this->Form->input('legal_city', array('value' => $ProjectLegalNames['Location']['city_name'], 'readonly' => true, 'label' => false, 'div' => false, 'class' => 'form-control'));
                                                    ?>
                                                    <span class="copy_right_arrow" id="copy_legal_city"></span>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label>Contact Name</label>
                                                <span class="colon">:</span>
                                                <div class="col-sm-10"><?php
                                                    echo $this->Form->input('legal_contact', array('value' => $ProjectLegalNames['BuilderContact']['builder_contact_name'], 'readonly' => true, 'label' => false, 'div' => false, 'class' => 'form-control'));
                                                    ?>
                                                    <span class="copy_right_arrow" id="copy_legal_contact"></span>
                                                </div>
                                            </div>
                                            <div class="form-group slt-sm">
                                                <label for="reg_input_name">Primary Mobile</label>
                                                <span class="colon">:</span>
                                                <div class="col-sm-10">
                                                    <?php
                                                    echo $this->Form->input('builder_contact_mobile_country_code', array('options' => $codes, 'selected' => $ProjectLegalNames['BuilderContact']['builder_contact_mobile_country_code'], 'disabled' => true, 'empty' => '--Select--', 'class' => 'form-control', 'label' => false, 'div' => false));
                                                    echo $this->Form->input('builder_contact_mobile_no', array('class' => 'form-control sm rgt', 'value' => $ProjectLegalNames['BuilderContact']['builder_contact_email'], 'readonly' => true, 'label' => false, 'div' => false));
                                                    ?>
                                                    <span class="copy_right_arrow" id="copy_legal_primary"></span>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label>Primary Email</label>
                                                <span class="colon">:</span>
                                                <div class="col-sm-10"> <?php echo $this->Form->input('legal_email', array('value' => $ProjectLegalNames['BuilderContact']['builder_contact_email'], 'readonly' => true, 'label' => false, 'div' => false, 'class' => 'form-control')); ?>
                                                    <span class="copy_right_arrow" id="copy_legal_email"></span>
                                                </div>
                                            </div>


                                        </div>
                                        <div class="col-sm-6">

                                            <div class="form-group">
                                                <label>Legal Address</label>
                                                <span class="colon">:</span>
                                                <div class="col-sm-10"> <?php echo $this->Form->input('Deal.deal_legal_address', array('label' => false, 'div' => false, 'class' => 'form-control')); ?></div>
                                            </div>
                                            <div class="form-group">
                                                <label>Legal Location</label>
                                                <span class="colon">:</span>
                                                <div class="col-sm-10"> <?php echo $this->Form->input('Deal.deal_legal_city', array('label' => false, 'div' => false, 'class' => 'form-control')); ?></div>
                                            </div>
                                            <div class="form-group">
                                                <label>Contact Name</label>
                                                <span class="colon">:</span>
                                                <div class="col-sm-10"> <?php echo $this->Form->input('Deal.deal_legal_contact', array('label' => false, 'div' => false, 'class' => 'form-control')); ?></div>
                                            </div>
                                            <div class="form-group slt-sm">
                                                <label for="reg_input_name">Primary Mobile</label>
                                                <span class="colon">:</span>
                                                <div class="col-sm-10">
                                                    <?php
                                                    echo $this->Form->input('Deal.deal_legal_primary_code', array('options' => $codes, 'empty' => '--Select--', 'class' => 'form-control', 'label' => false, 'div' => false));
                                                    echo $this->Form->input('Deal.deal_legal_primary_no', array('class' => 'form-control sm rgt', 'label' => false, 'div' => false));
                                                    ?></div>
                                            </div>

                                            <div class="form-group">
                                                <label>Primary Email</label>
                                                <span class="colon">:</span>
                                                <div class="col-sm-10"> <?php echo $this->Form->input('Deal.deal_legal_email', array('label' => false, 'div' => false, 'class' => 'form-control')); ?></div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                    <?php echo $this->Form->button('Calculate', array('type' => 'button', 'class' => 'btn btn-default btn-sm calbtn', 'onclick' => 'total_calculate()')); ?>
                    <div class="col-sm-12 spacer expadng">
                        <table class="ctable" width="100%" cellpadding="0" cellspacing="0" border="0">
                           
                            <tr>
                                <td class="rgtaln">Unit Total cost / sq ft</td>
                                <td align="right"><span class="unit_cost"></span></td>
                                <td class="rgtaln">Basic Cost</td>
                                <td class="rgtaln"><span class="basic_cost"></span></td>
                            </tr>
                            <tr>
                                <td class="rgtaln">Total Lump Sum Cost</td>
                                <td align="right"><span class="tot_lump_cost"></span></td>
                                <td class="rgtaln">Average Agreement Value</td>
                                <td class="rgtaln"><span class="agreement_cost"></span></td>
                            </tr>
                            <tr>
                                <td class="rgtaln">Average Post-Tax Total Cost</td>
                                <td align="right"><span class="post_tax_total"></span></td>
                                <td class="rgtaln">All Inclusive Cost</td>
                                <td class="rgtaln"><span class="payable_cost"></span></td>
                            </tr>
                            <tr>
                                <td class="rgtaln">Booking Amount</td>
                                <td><?php echo $this->Form->input('Deal.deal_booking_amount_required', array('class' => 'form-control rgt', 'readonly' => true)); ?></td>
                                <td class="rgtaln">Downpayment</td>
                                <td><?php echo $this->Form->input('Deal.deal_unit_total_downpayment_required', array('class' => 'form-control rgt', 'readonly' => true)); ?></td>

                            </tr>
                            <tr>
                                <td class="rgtaln">Second Payment :</td>
                                <td><?php echo $this->Form->input('Deal.deal_unit_total_second_payment_required', array('class' => 'form-control rgt', 'readonly' => true)); ?></td>
                                <td class="rgtaln">Third Payment</td>
                                <td><?php echo $this->Form->input('Deal.deal_unit_total_third_payment_required', array('class' => 'form-control rgt', 'readonly' => true)); ?></td>

                            </tr>


                        </table>
                      


                    </div>
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

    $('#copy_unit_type').click(function() {
        $('#DealDealUnitType').val($('#ActionItemUnitType').val());
    });

    $('#copy_unit_name').click(function() {
        $('#DealDealUnitName').val($('#ActionItemUnitName').val());
    });
    $('#copy_unit_basic_cost').click(function() {
        $('#DealDealUnitBasicCost').val($('#ActionItemUnitTotalBasicCost').val());
    });
    $('#copy_unit_other_cost_per_sq_ft').click(function() {
        $('#DealDealUnitOtherCostPerSqFt').val($('#ActionItemUnitOtherCostPerSqFt').val());
    });
    $('#copy_unit_floor_charges_sq_ft').click(function() {
        $('#DealDealUnitFloorChargesSqFt').val($('#ActionItemUnitFloorChargesSqFt').val());
    });
    $('#copy_unit_floor_rise_or_plc_from').click(function() {
        $('#DealDealUnitFloorRiseOrPlcFrom').val($('#ActionItemUnitFloorRiseOrPlcFrom').val());
    });
    $('#copy_unit_plc_charges_sq_ft').click(function() {
        $('#DealDealUnitPlcChargesSqFt').val($('#ActionItemUnitPlcChargesSqFt').val());
    });

    $('#copy_unit_amenities_cost').click(function() {
        $('#DealDealUnitAmenitiesCost').val($('#ActionItemUnitAmenitiesCost').val());
    });
    $('#copy_unit_infra_pre_agreement_cost').click(function() {
        $('#DealDealUnitInfraPreAgreementCost').val($('#ActionItemUnitInfraPreAgreementCost').val());
    });
    $('#copy_unit_car_parking_cost').click(function() {
        $('#DealDealUnitCarParkingCost').val($('#ActionItemUnitCarParkingCost').val());
    });
    $('#copy_unit_other_pre_agreement_cost').click(function() {
        $('#DealDealUnitOtherPreAgreementCost').val($('#ActionItemUnitOtherPreAgreementCost').val());
    });

    $('#copy_unit_stamp_duty').click(function() {
        $('#DealDealUnitStampDuty').val($('#ActionItemUnitStampDuty').val());
    });
    $('#copy_unit_service_tax').click(function() {
        $('#DealDealUnitServiceTax').val($('#ActionItemUnitServiceTax').val());
    });
    $('#copy_unit_vat').click(function() {
        $('#DealDealUnitVat').val($('#ActionItemUnitVat').val());
    });
    $('#copy_unit_registration_cost').click(function() {
        $('#DealDealUnitRegistrationCost').val($('#ActionItemUnitRegistrationCost').val());
    });

    $('#copy_unit_societies_cost').click(function() {
        $('#DealDealUnitSocietiesCost').val($('#ActionItemUnitSocietiesCost').val());
    });
    $('#copy_unit_other_infra_charges').click(function() {
        $('#DealDealOtherInfraCharges').val($('#ActionItemUnitOtherInfraCharges').val());
    });
    $('#copy_unit_legal_cost').click(function() {
        $('#DealDealUnitLegalCost').val($('#ActionItemUnitLegalCost').val());
    });
    $('#copy_unit_other_charges').click(function() {
        $('#DealDealUnitOtherCharges').val($('#ActionItemUnitOtherCharges').val());
    });
    $('#copy_unit_iniitial_booking_amount').click(function() {
        $('#DealDealBookingAmount').val($('#ActionItemUnitIniitialBookingAmount').val());
    });

    $('#copy_unit_downpayment_on_percent_or_lumpsum').click(function() {
        $('#DealDealUnitDownpaymentOnPercentOrLumpsum').val($('#ActionItemUnitDownpaymentOnPercentOrLumpsum').val());
    });
    $('#copy_unit_downpayment_attached_to_construction').click(function() {
        $('#DealDealUnitDownpaymentAttachedToConstruction').val($('#ActionItemUnitDownpaymentAttachedToConstruction').val());
    });
    $('#copy_unit_downpayment_amount_due_in').click(function() {
        $('#DealDealUnitDownpaymentAmountDueIn').val($('#ActionItemUnitDownpaymentAmountDueIn').val());
        $('#DealDealUnitDownpaymentOption').val($('#ActionItemUnitDownpaymentOption').val());
    });

    $('#copy_unit_second_payment_on_percent_or_lumpsum').click(function() {
        $('#DealDealUnitSecondPaymentOnPercentOrLumpsum').val($('#ActionItemUnitSecondPaymentOnPercentOrLumpsum').val());
    });
    $('#copy_unit_downpayment_attached_to_construction').click(function() {
        $('#DealDealUnitSecondPaymentAttachedToConstruction').val($('#ActionItemUnitSecondPaymentAttachedToConstruction').val());
    });
    $('#copy_unit_downpayment_amount_due_in').click(function() {
        $('#DealDealUnitSecondPaymentAmountDueIn').val($('#ActionItemUnitSecondPaymentAmountDueIn').val());
        $('#DealDealUnitSecondOption').val($('#ActionItemUnitSecondOption').val());
    });

    $('#copy_unit_third_payment_on_percent_or_lumpsum').click(function() {
        $('#DealDealUnitThirdPaymentOnPercentOrLumpsum').val($('#ActionItemUnitThirdPaymentOnPercentOrLumpsum').val());
    });
    $('#copy_unit_third_payment_attached_to_construction').click(function() {
        $('#DealDealUnitThirdPaymentAttachedToConstruction').val($('#ActionItemUnitThirdPaymentAttachedToConstruction').val());
    });
    $('#copy_unit_third_party_amount_due_in').click(function() {
        $('#DealDealUnitThirdPartyAmountDueIn').val($('#ActionItemUnitThirdPartyAmountDueIn').val());
        $('#DealDealUnitThirdPartyOption').val($('#ActionItemUnitThirdPartyOption').val());
    });

    $('#copy_unit_commission_percent').click(function() {
        $('#DealDealUnitCommissionPercent').val($('#ActionItemUnitCommissionPercent').val());
    });
    $('#copy_unit_commission_based_on').click(function() {
        $('#DealDealUnitCommissionBasedOn').val($('#ActionItemUnitCommissionBasedOn').val());
    });
    $('#copy_unit_commission_event').click(function() {
        $('#DealDealUnitCommissionEvent').val($('#ActionItemUnitCommissionEvent').val());
    });
    $('#copy_unit_commission_applied_to').click(function() {
        $('#DealDealUnitCommissionAppliedTo').val($('#ActionItemUnitCommissionAppliedTo').val());
    });

    $('#copy_client_name').click(function() {
        $('#DealDealClientName').val($('#ActionItemClientName').val());
    });
    $('#copy_lead_country').click(function() {
        $('#DealDealLeadCountry').val($('#ActionItemLeadCountry').val());
    });
    $('#copy_lead_primaryphonenumber').click(function() {
        $('#DealDealLeadPrimaryphonenumber').val($('#ActionItemLeadPrimaryphonenumber').val());
    });
    $('#copy_lead_secondaryphonenumber').click(function() {
        $('#DealDealLeadSecondaryphonenumber').val($('#ActionItemLeadSecondaryphonenumber').val());
    });
    $('#copy_lead_emailid').click(function() {
        $('#DealDealLeadEmailid').val($('#ActionItemLeadEmailid').val());
    });
    $('#copy_lead_streetaddress').click(function() {
        $('#DealDealLeadStreetaddress').val($('#ActionItemLeadStreetaddress').val());
    });


    $('#copy_legal_address').click(function() {
        $('#DealDealLegalAddress').val($('#ActionItemLegalAddress').val());
    });
    $('#copy_legal_city').click(function() {
        $('#DealDealLegalCity').val($('#ActionItemLegalCity').val());
    });
    $('#copy_legal_contact').click(function() {
        $('#DealDealLegalContact').val($('#ActionItemLegalContact').val());
    });
    $('#copy_legal_primary').click(function() {
        $('#DealDealLegalPrimaryCode').val($('#ActionItemBuilderContactMobileCountryCode').val());
        $('#DealDealLegalPrimaryNo').val($('#ActionItemBuilderContactMobileNo').val());

    });
    $('#copy_legal_email').click(function() {
        $('#DealDealLegalEmail').val($('#ActionItemLegalEmail').val());
    });
    
    $('#copy_unit_floor_number').click(function() {
        $('#DealDealUnitFloorNumber').val($('#ActionItemUnitFloorNumber').val());
    });


    function total_calculate() {

        //Unit cost
        var UnitBasciCost = parseFloat($('#DealDealUnitBasicCost').val());
        var plcCost = parseFloat($('#DealDealUnitPlcChargesSqFt').val());
        var otherCost = parseFloat($('#DealDealUnitOtherCostPerSqFt').val());
        var FloorRise = parseFloat($('#DealDealUnitFloorChargesSqFt').val());
        var FloorRiseFrom = parseFloat($('#DealDealUnitFloorRiseOrPlcFrom').val());
        var FloorNumber = parseFloat($('#DealDealUnitFloorNumber').val());
        var currency = $('#LeadUnitCostCurrency').val();
        var calculate = 0;
        var Sum = 0;

        if (UnitBasciCost > 0)
            Sum = Sum + UnitBasciCost;

        if (plcCost)
            Sum = Sum + plcCost;

        if (otherCost)
            Sum = Sum + otherCost;

        if (FloorRise)
            Floorrise = FloorRise;
        else
            Floorrise = 0;




        if (FloorNumber > FloorRiseFrom)
            calculate = parseFloat(Sum + Floorrise) * parseFloat(FloorNumber - FloorRiseFrom);
        else
            calculate = parseFloat(Sum);
        $('.unit_cost').text(currency + ' ' + calculate);
        $('#DealDealUnitFloorRiseOrPlc').val(calculate);

        //Basic Cost

      
        var soldArea = parseInt($('#DealDealSoldArea').val());
        var calculate = 0;
        var UnitTotalCost = parseFloat($('#DealDealUnitFloorRiseOrPlc').val());

        
        var calculate = parseFloat(UnitTotalCost * soldArea);

        $('.basic_cost').text(currency + ' ' + calculate);
        $('#DealDealBasicCost').val(calculate);



        //var AmenitiesCost = 0;
        var CarParkingCost = parseInt($('#DealDealUnitCarParkingCost').val());
        var InfrastructureCost = parseInt($('#DealDealUnitInfraPreAgreementCost').val());
        var OtherCost = parseInt($('#DealDealUnitOtherPreAgreementCost').val());
        var BasciCost = parseFloat($('#DealDealBasicCost').val());
        var calculate = 0;
        var AmenitiesCost = parseInt($('#DealDealUnitAmenitiesCost').val());
        if (AmenitiesCost > 0)
            calculate = calculate + AmenitiesCost;

        if (CarParkingCost)
            calculate = calculate + CarParkingCost;

        if (InfrastructureCost)
            calculate = calculate + InfrastructureCost;

        if (OtherCost)
            calculate = calculate + OtherCost;

        $('.tot_lump_cost').text(currency + ' ' + calculate);
        $('#DealDealTotalLumpCost').val(calculate);
        var agreement_cost = parseFloat(BasciCost + calculate);
      

        $('.agreement_cost').text(currency + ' ' + agreement_cost);
        $('#DealDealAgreementCost').val(agreement_cost);

        var AgreementCost = parseInt($('#DealDealAgreementCost').val());
        var StampDuty = parseFloat($('#DealDealUnitStampDuty').val() / 100);
        var vat = parseFloat($('#DealDealUnitVat').val() / 100);
        var seviceTax = parseFloat($('#DealDealUnitServiceTax').val() / 100);
        var registration = parseInt($('#DealDealUnitRegistrationCost').val());
        if (isNaN(registration))
            registration = 0;
        var calculate = 0;

        if (StampDuty > 0)
            calculate = calculate + StampDuty;

        if (vat)
            calculate = calculate + vat;

        if (seviceTax)
            calculate = calculate + seviceTax;


        var post_taxt_total = parseInt((AgreementCost * calculate) + registration + AgreementCost);
       
        //var result = post_taxt_total.toFixed(2); // returns 12.43
        $('.post_tax_total').text(currency + ' ' + post_taxt_total);
        $('#DealDealPostTaxTotal').val(post_taxt_total);


        var post_tax_total = parseInt($('#DealDealPostTaxTotal').val());
        var SocietiesCost = parseInt($('#DealDealUnitSocietiesCost').val());
        var LegalCost = parseInt($('#DealDealUnitLegalCost').val());
        var InfraCost = parseInt($('#DealDealOtherInfraCharges').val());
        var OtherCost = parseInt($('#DealDealUnitOtherCharges').val());


        var calculate = 0;

        if (SocietiesCost > 0)
            calculate = calculate + SocietiesCost;

        if (LegalCost)
            calculate = calculate + LegalCost;

        if (InfraCost)
            calculate = calculate + InfraCost;

        if (OtherCost)
            calculate = calculate + OtherCost;


        var payable_cost = parseFloat(post_tax_total + calculate);

        $('.payable_cost').text(currency + ' ' + payable_cost);
        $('#DealDealPayableCost').val(payable_cost);
        ///
        var attachTo = $('#DealDealUnitDownpaymentAttachedToConstruction').val();
        var CostValue = 0;
        var calculate = 0;
        var PercentLumpsum = parseFloat($('#DealDealUnitDownpaymentOnPercentOrLumpsum').val() / 100);
        if (attachTo == '1') //Basic Cost
        {
            CostValue = parseInt($('#DealDealBasicCost').val());
          
            $('#DealDealUnitTotalDownpaymentRequired').attr('readonly', true);
         
            calculate = parseInt(CostValue * PercentLumpsum);
           
            $('#DealDealUnitTotalDownpaymentRequired').val(calculate);
      
        }
        else if (attachTo == '2')// agreemnet cost
        {
            CostValue = parseInt($('#DealDealAgreementCost').val());
           
            $('#DealDealUnitTotalDownpaymentRequired').attr('readonly', true);
           
            calculate = parseInt(CostValue * PercentLumpsum);
         
            $('#DealDealUnitTotalDownpaymentRequired').val(calculate);
            
        }
        else // other
        {
            $('#DealDealUnitTotalDownpaymentRequired').attr('readonly', false);
            $('#DealDealUnitTotalDownpaymentRequired').val(0);
         
        }

        /// Second payment
        var attachTo = $('#DealDealUnitSecondPaymentAttachedToConstruction').val();
        var CostValue = 0;
        var calculate = 0;
        var PercentLumpsum = parseFloat($('#DealDealUnitSecondPaymentOnPercentOrLumpsum').val() / 100);
        if (attachTo == '1') //Basic Cost
        {
            CostValue = parseInt($('#DealDealBasicCost').val());
          
            $('#DealDealUnitTotalSecondPaymentRequired').attr('readonly', true);
         
            calculate = parseInt(CostValue * PercentLumpsum);
           
            $('#DealDealUnitTotalSecondPaymentRequired').val(calculate);
           
        }
        else if (attachTo == '2')// agreemnet cost
        {
            CostValue = parseInt($('#DealDealAgreementCost').val());
           
            $('#DealDealUnitTotalSecondPaymentRequired').attr('readonly', true);
           
            calculate = parseInt(CostValue * PercentLumpsum);
          
            $('#DealDealUnitTotalSecondPaymentRequired').val(calculate);
            
        }
        else // other
        {
            $('#DealDealUnitTotalSecondPaymentRequired').attr('readonly', false);
            $('#DealDealUnitTotalSecondPaymentRequired').val(0);
            
        }
        /* Third payment*/
        var attachTo = $('#DealDealUnitThirdPaymentAttachedToConstruction').val();
        var CostValue = 0;
        var calculate = 0;
        var PercentLumpsum = parseFloat($('#DealDealUnitThirdPaymentOnPercentOrLumpsum').val() / 100);
        if (attachTo == '1') //Basic Cost
        {
            CostValue = parseInt($('#DealDealBasicCost').val());
           
            $('#DealDealUnitTotalThirdPaymentRequired').attr('readonly', true);
            
            calculate = parseInt(CostValue * PercentLumpsum);
          
            $('#DealDealUnitTotalThirdPaymentRequired').val(calculate);
            
        }
        else if (attachTo == '2')// agreemnet cost
        {
            CostValue = parseInt($('#DealDealAgreementCost').val());
          
            $('#DealDealUnitTotalThirdPaymentRequired').attr('readonly', true);
            
            calculate = parseInt(CostValue * PercentLumpsum);
           
            $('#DealDealUnitTotalThirdPaymentRequired').val(calculate);
          
        }
        else // other
        {
            $('#DealDealUnitTotalThirdPaymentRequired').attr('readonly', false);
         
            $('#DealDealUnitTotalThirdPaymentRequired').val(0);
            
        }
        ////
        var attachTo = $('#DealDealUnitCommissionBasedOn').val();
        if (attachTo == '1') //Basic Cost
        {
            CostValue = parseInt($('#DealDealBasicCost').val());
            $('#DealDealUnitCommissionAppliedTo').attr('readonly', true);
            $('#DealDealUnitCommissionAppliedTo').val(CostValue);
        }
        else if (attachTo == '2')// agreemnet cost
        {
            CostValue = parseInt($('#DealDealAgreementCost').val());
            $('#DealDealUnitCommissionAppliedTo').attr('readonly', true);
            $('#DealDealUnitCommissionAppliedTo').val(CostValue);
        }
        else // other
        {
            $('#DealDealUnitCommissionAppliedTo').attr('readonly', false);
            $('#DealDealUnitCommissionAppliedTo').val(0);
        }
    }
    
    $('#DealDealBookingAmount').change(function() {
        $('#DealDealBookingAmountRequired').val($(this).val());
        
    });

</script>
