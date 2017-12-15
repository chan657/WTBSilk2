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


//pr($this->data);
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
                
                <div class="col-sm-12 report_tran" style="display:block; clear:both;">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="reg_input_name" class="req">Transaction Type</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10">
                                <?php
                                echo $this->data['TransactionType']['value'];
                                ?></div>
                        </div>
                       
                        <div class="form-group">
                            <label>Cost Currency </label>
                            <span class="colon">:</span>
                            <div class="col-sm-10">
                                <?php echo $this->data['Deal']['deal_currency']; ?>
                            </div>
                        </div>
                    
                        <div class="form-group">
                            <label for="reg_input_name" class="req">Project</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10">
                                <?php
                               echo $this->data['DealProject']['project_name'];
                                ?></div>
                        </div>
                        <div class="form-group builder" <?php if ($this->data['Deal']['deal_billing_type'] == '2') { ?> style="display:none;" <?php } ?>>
                            <label for="reg_input_name" class="req" >Builder</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10">
                                <?php
                                echo $this->data['DealBuilder']['builder_name'];
                                ?></div>
                        </div>
                        <div class="form-group partner" <?php if ($this->data['Deal']['deal_billing_type'] == '1') { ?> style="display:none;" <?php } ?>>
                            <label for="reg_input_name" class="req" >Partner</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10">
                                <?php
                                echo $this->data['DealPartner']['marketing_partner_display_name'];
                                ?></div>
                        </div>

                        <div class="form-group">
                            <label for="reg_input_name" class="req">Client</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10">
                                <?php
                                echo $this->data['DealClient']['lead_fname'].' '.$this->data['DealClient']['lead_lname'];
                                ?></div>
                        </div>

                        <div class="form-group">
                            <label>Unit Number</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10"><?php echo $this->data['Deal']['deal_unit_number'];?></div>
                        </div>
                        <div class="form-group">
                            <label>Cluster Number</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10"><?php echo $this->data['Deal']['deal_unit_cluster'];?></div>
                        </div>


                    </div>
                    <div class="col-sm-6">

                        <div class="form-group">
                            <label for="reg_input_name" class="req">Billing Type</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10">
                                <?php
                                echo $this->data['BillingType']['value'];
                                ?></div>
                        </div>
                        <div class="form-group">
                            <label for="reg_input_name" class="req">Project Legal Name</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10">
                                <?php
                                echo $this->data['DealLegalName']['builder_legal_names_name'];
                                ?></div>
                        </div>
                        <div class="form-group">
                            <label for="reg_input_name" class="req">Unit</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10">
                                <?php
                                echo $this->data['DealUnit']['unit_name'];
                                ?></div>
                        </div>
                        <div class="form-group">
                            <label>Sale Pattern</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10"><?php echo $this->data['Deal']['deal_sale_pattern']; ?></div>
                        </div>
                        <div class="form-group">
                            <label>Tower Number</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10"><?php echo $this->data['Deal']['deal_unit_tower_or_building'];?></div>
                        </div>  
                        <div class="form-group" >
                            <label for="reg_input_name" class="req">Booking Date</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10">
                                <?php
                                    $deal_booking_date = '';
                                    if ($this->data['Deal']['deal_booking_date'])
                                        $deal_booking_date = date('d-m-Y', strtotime($this->data['Deal']['deal_booking_date']));
                                    echo $deal_booking_date;
                                    ?>
                           


                            </div>
                        </div>
                    </div>
                </div>
                



                <div class="col-sm-12 report_tran" id="ajax_unit"  style="display:block;">
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
                                                   
                                                </div>

                                            </div>
                                            <div class="form-group">
                                                <label>Floor Number</label>
                                                <span class="colon">:</span>
                                                <div class="col-sm-10"><?php
                                                    echo $this->Form->input('unit_floor_number', array('value' => $project_units['ProjectUnit']['unit_floor_number'], 'readonly' => true, 'label' => false, 'div' => false, 'class' => 'form-control rgt'));
                                                    ?>
                                                  
                                                </div>

                                            </div>    
                                            <div class="form-group">
                                                <label>Unit Display Name</label>
                                                <span class="colon">:</span>
                                                <div class="col-sm-10"><?php
                                                    echo $this->Form->input('unit_name', array('value' => $project_units['ProjectUnit']['unit_name'], 'readonly' => true, 'label' => false, 'div' => false, 'class' => 'form-control'));
                                                    ?>
                                                   
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
                                                <div class="col-sm-10"><?php echo $this->data['Deal']['deal_unit_type'];?></div>
                                            </div>
                                            <div class="form-group">
                                                <label>Floor Number</label>
                                                <span class="colon">:</span>
                                                <div class="col-sm-10"><?php echo $this->data['Deal']['deal_unit_floor_number'];?></div>
                                            </div>
                                            <div class="form-group">
                                                <label>Unit Display Name</label>
                                                <span class="colon">:</span>
                                                <div class="col-sm-10"><?php echo $this->data['Deal']['deal_unit_name'];?></div>
                                            </div>
                                            <div class="form-group">
                                                <label>Sold Area</label>
                                                <span class="colon">:</span>
                                                <div class="col-sm-10"><?php echo $this->data['Deal']['deal_sold_area'];?></div>
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
                                                   
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label>Other / Sq Ft</label>
                                                <span class="colon">:</span>
                                                <div class="col-sm-10"><?php echo $this->Form->input('unit_other_cost_per_sq_ft', array('value' => $project_units['ProjectUnit']['unit_other_cost_per_sq_ft'], 'readonly' => true, 'label' => false, 'div' => false, 'class' => 'form-control rgt taxes_duty')); ?>
                                                   
                                                </div>
                                            </div> 
                                            <div class="form-group">
                                                <label>Floor Rise / Sq Ft </label>
                                                <span class="colon">:</span>
                                                <div class="col-sm-10"><?php echo $this->Form->input('unit_floor_charges_sq_ft', array('value' => $project_units['ProjectUnit']['unit_floor_charges_sq_ft'], 'readonly' => true, 'label' => false, 'div' => false, 'class' => 'form-control rgt taxes_duty')); ?>
                                                  
                                                </div>
                                            </div>  
                                            <div class="form-group">
                                                <label>Floor Rise From</label>
                                                <span class="colon">:</span>
                                                <div class="col-sm-10"><?php echo $this->Form->input('unit_floor_rise_or_plc_from', array('value' => $project_units['ProjectUnit']['unit_floor_rise_or_plc_from'], 'readonly' => true, 'label' => false, 'div' => false, 'class' => 'form-control rgt taxes_duty')); ?>
                                                  
                                                </div>
                                            </div> 
                                            <div class="form-group">
                                                <label>PLC / Sq Ft</label>
                                                <span class="colon">:</span>
                                                <div class="col-sm-10"><?php echo $this->Form->input('unit_plc_charges_sq_ft', array('value' => $project_units['ProjectUnit']['unit_plc_charges_sq_ft'], 'readonly' => true, 'label' => false, 'div' => false, 'class' => 'form-control  rgt taxes_duty')); ?>
                                                    
                                                </div>
                                            </div> 






                                        </div>
                                        <div class="col-sm-6">

                                            <div class="form-group">
                                                <label>Basic Price / Sq Ft</label>
                                                <span class="colon">:</span>
                                                <div class="col-sm-10"><?php
                                                    echo $this->data['Deal']['deal_unit_basic_cost'];
                                                    ?>

                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label>Other / Sq Ft</label>
                                                <span class="colon">:</span>
                                                <div class="col-sm-10"><?php echo $this->data['Deal']['deal_unit_other_cost_per_sq_ft'];?></div>
                                            </div> 
                                            <div class="form-group">
                                                <label>Floor Rise / Sq Ft </label>
                                                <span class="colon">:</span>
                                                <div class="col-sm-10"><?php echo $this->data['Deal']['deal_unit_floor_charges_sq_ft'];?></div>
                                            </div>  
                                            <div class="form-group">
                                                <label>Floor Rise From</label>
                                                <span class="colon">:</span>
                                                <div class="col-sm-10"><?php echo $this->data['Deal']['deal_unit_floor_rise_or_plc_from'];?></div>
                                            </div> 
                                            <div class="form-group">
                                                <label>PLC / Sq Ft</label>
                                                <span class="colon">:</span>
                                                <div class="col-sm-10"><?php echo $this->data['Deal']['deal_unit_plc_charges_sq_ft'];?></div>
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
                                                    
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label>Infrastructure Cost</label>
                                                <span class="colon">:</span>
                                                <div class="col-sm-10"><?php echo $this->Form->input('unit_infra_pre_agreement_cost', array('value' => $project_units['ProjectUnit']['unit_infra_pre_agreement_cost'], 'readonly' => true, 'label' => false, 'div' => false, 'class' => 'form-control rgt')); ?>
                                                   
                                                </div>
                                            </div>   
                                            <div class="form-group">
                                                <label>Car Parking Cost </label>
                                                <span class="colon">:</span>
                                                <div class="col-sm-10"><?php echo $this->Form->input('unit_car_parking_cost', array('value' => $project_units['ProjectUnit']['unit_car_parking_cost'], 'readonly' => true, 'label' => false, 'div' => false, 'class' => 'form-control rgt')); ?>
                                                  
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label>Other Cost</label>
                                                <span class="colon">:</span>
                                                <div class="col-sm-10"><?php echo $this->Form->input('unit_other_pre_agreement_cost', array('value' => $project_units['ProjectUnit']['unit_other_pre_agreement_cost'], 'readonly' => true, 'label' => false, 'div' => false, 'class' => 'form-control rgt')); ?>
                                                   
                                                </div>
                                            </div>   
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label>Amenities Cost </label>
                                                <span class="colon">:</span>
                                                <div class="col-sm-10"><?php
                                                    echo $this->data['Deal']['deal_unit_amenities_cost'];
                                                    ?></div>
                                            </div>
                                            <div class="form-group">
                                                <label>Infrastructure Cost</label>
                                                <span class="colon">:</span>
                                                <div class="col-sm-10"><?php echo $this->data['Deal']['deal_unit_infra_pre_agreement_cost'];?></div>
                                            </div>   
                                            <div class="form-group">
                                                <label>Car Parking Cost </label>
                                                <span class="colon">:</span>
                                                <div class="col-sm-10"><?php
                                                    echo $this->data['Deal']['deal_unit_car_parking_cost'];
                                                    ?></div>
                                            </div>
                                            <div class="form-group">
                                                <label>Other Cost</label>
                                                <span class="colon">:</span>
                                                <div class="col-sm-10"><?php echo $this->data['Deal']['deal_unit_other_pre_agreement_cost'];?></div>
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
                                                   
                                                </div>
                                            </div>
                                            <div class="form-group percsym">
                                                <label>Service Tax % </label>
                                                <span class="colon">:</span>
                                                <div class="col-sm-10"><div class="input-group"><?php echo $this->Form->input('unit_service_tax', array('value' => $project_units['ProjectUnit']['unit_service_tax'], 'readonly' => true, 'label' => false, 'div' => false, 'class' => 'form-control rgt taxes_duty')); ?><span class="input-group-addon">%</span></div>
                                                  
                                                </div>
                                            </div>  
                                            <div class="form-group percsym">
                                                <label>VAT % </label>
                                                <span class="colon">:</span>
                                                <div class="col-sm-10"><div class="input-group"><?php echo $this->Form->input('unit_vat', array('value' => $project_units['ProjectUnit']['unit_vat'], 'readonly' => true, 'label' => false, 'div' => false, 'class' => 'form-control rgt taxes_duty')); ?><span class="input-group-addon">%</span></div>
                                                  
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label>Registration</label>
                                                <span class="colon">:</span>
                                                <div class="col-sm-10"><?php
                                                    echo $this->Form->input('unit_registration_cost', array('value' => $project_units['ProjectUnit']['unit_registration_cost'], 'readonly' => true, 'label' => false, 'div' => false, 'class' => 'form-control rgt taxes_duty'));
                                                    ?>
                                                  
                                                </div>
                                            </div> 
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label>Stamp Duty %  </label>
                                                <span class="colon">:</span>
                                                <div class="col-sm-10"><div class="input-group"><?php echo $this->data['Deal']['deal_unit_stamp_duty'].' %';?></div></div>
                                            </div>
                                            <div class="form-group">
                                                <label>Service Tax % </label>
                                                <span class="colon">:</span>
                                                <div class="col-sm-10"><div class="input-group"><?php echo $this->data['Deal']['deal_unit_service_tax'].' %';?></div></div>
                                            </div>  
                                            <div class="form-group">
                                                <label>VAT % </label>
                                                <span class="colon">:</span>
                                                <div class="col-sm-10"><div class="input-group"><?php echo $this->data['Deal']['deal_unit_vat'].' %';?></div></div>
                                            </div>
                                            <div class="form-group">
                                                <label>Registration</label>
                                                <span class="colon">:</span>
                                                <div class="col-sm-10"><?php echo $this->data['Deal']['deal_unit_registration_cost'];?></div>
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
                                                   
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label>Infra Charges </label>
                                                <span class="colon">:</span>
                                                <div class="col-sm-10"><?php echo $this->Form->input('unit_other_infra_charges', array('value' => $project_units['ProjectUnit']['unit_other_infra_charges'], 'readonly' => true, 'label' => false, 'div' => false, 'class' => 'form-control rgt taxes_duty')); ?>
                                                  
                                                </div>
                                            </div> 
                                            <div class="form-group">
                                                <label>Legal Charges</label>
                                                <span class="colon">:</span>
                                                <div class="col-sm-10"><?php echo $this->Form->input('unit_legal_cost', array('value' => $project_units['ProjectUnit']['unit_legal_cost'], 'readonly' => true, 'label' => false, 'div' => false, 'class' => 'form-control rgt taxes_duty')); ?>
                                                  
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label>Other Charges</label>
                                                <span class="colon">:</span>
                                                <div class="col-sm-10"><?php echo $this->Form->input('unit_other_charges', array('value' => $project_units['ProjectUnit']['unit_other_charges'], 'readonly' => true, 'label' => false, 'div' => false, 'class' => 'form-control rgt taxes_duty')); ?>
                                                   
                                                </div>
                                            </div>       
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label>Society / Maint</label>
                                                <span class="colon">:</span>
                                                <div class="col-sm-10"><?php
                                                    echo $this->data['Deal']['deal_unit_societies_cost'];
                                                    ?></div>
                                            </div>
                                            <div class="form-group">
                                                <label>Infra Charges </label>
                                                <span class="colon">:</span>
                                                <div class="col-sm-10"><?php echo $this->data['Deal']['deal_other_infra_charges'];?></div>
                                            </div>
                                            <div class="form-group">
                                                <label>Legal Charges</label>
                                                <span class="colon">:</span>
                                                <div class="col-sm-10"><?php
                                                    echo $this->data['Deal']['deal_unit_legal_cost'];
                                                    ?></div>
                                            </div>
                                            <div class="form-group">
                                                <label>Other Charges</label>
                                                <span class="colon">:</span>
                                                <div class="col-sm-10"><?php
                                                    echo $this->data['Deal']['deal_unit_other_charges'];
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
                                                   
                                                </div>
                                            </div>


                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label>Booking Amount</label>
                                                <span class="colon">:</span>
                                                <div class="col-sm-10"><?php echo $this->data['Deal']['deal_booking_amount'];?></div>
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
                                                    
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label>Attached to</label>
                                                <span class="colon">:</span>
                                                <div class="col-sm-10"><?php echo $this->Form->input('unit_downpayment_attached_to_construction', array('options' => $attach_to, 'selected' => $project_units['ProjectUnit']['unit_downpayment_attached_to_construction'], 'disabled' => true, 'empty' => '--Select--', 'tabindex' => '43', 'label' => false, 'div' => false, 'class' => 'form-control')); ?>
                                                  
                                                </div>
                                            </div>
                                            <div class="form-group int-sm">
                                                <label>Due By</label>
                                                <span class="colon">:</span>
                                                <div class="col-sm-10">  <?php
                                                    echo $this->Form->input('unit_downpayment_amount_due_in', array('value' => $project_units['ProjectUnit']['unit_downpayment_amount_due_in'], 'readonly' => true, 'class' => 'form-control sm rgt', 'tabindex' => '44', 'label' => false, 'div' => false));
                                                    echo $this->Form->input('unit_downpayment_option', array('label' => false, 'options' => array('Days' => 'Days', 'Months' => 'Months'), 'selected' => $project_units['ProjectUnit']['unit_downpayment_option'], 'disabled' => true, 'empty' => '--Select--', 'tabindex' => '45', 'label' => false, 'div' => false, 'class' => 'form-control'));
                                                    ?>
                                                  
                                                </div>
                                            </div>

                                            <h4>Second Payment</h4>

                                            <div class="form-group percsym">
                                                <label>Percent Lumpsum</label>
                                                <span class="colon">:</span>
                                                <div class="col-sm-10"><div class="input-group"><?php echo $this->Form->input('unit_second_payment_on_percent_or_lumpsum', array('value' => $project_units['ProjectUnit']['unit_second_payment_on_percent_or_lumpsum'], 'readonly' => true, 'class' => 'form-control rgt', 'tabindex' => '46', 'label' => false, 'div' => false)); ?><span class="input-group-addon">%</span></div>
                                                    
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label>Attached to </label>
                                                <span class="colon">:</span>
                                                <div class="col-sm-10"><?php echo $this->Form->input('unit_second_payment_attached_to_construction', array('options' => $attach_to, 'selected' => $project_units['ProjectUnit']['unit_second_payment_attached_to_construction'], 'disabled' => true, 'empty' => '--Select--', 'tabindex' => '47', 'label' => false, 'div' => false, 'class' => 'form-control')); ?>
                                                   
                                                </div>
                                            </div>
                                            <div class="form-group int-sm">
                                                <label>Due By</label>
                                                <span class="colon">:</span>
                                                <div class="col-sm-10">  <?php
                                                    echo $this->Form->input('unit_second_payment_amount_due_in', array('value' => $project_units['ProjectUnit']['unit_second_payment_amount_due_in'], 'readonly' => true, 'class' => 'form-control sm rgt', 'tabindex' => '48', 'label' => false, 'div' => false));
                                                    echo $this->Form->input('unit_second_option', array('label' => false, 'options' => array('Days' => 'Days', 'Months' => 'Months'), 'selected' => $project_units['ProjectUnit']['unit_second_option'], 'disabled' => true, 'empty' => '--Select--', 'tabindex' => '49', 'label' => false, 'div' => false, 'class' => 'form-control'));
                                                    ?>
                                                  
                                                </div>
                                            </div>

                                            <h4>Third Payment</h4>   

                                            <div class="form-group percsym">
                                                <label>Percent Lumpsum</label>
                                                <span class="colon">:</span>
                                                <div class="col-sm-10"><div class="input-group"><?php echo $this->Form->input('unit_third_payment_on_percent_or_lumpsum', array('value' => $project_units['ProjectUnit']['unit_third_payment_on_percent_or_lumpsum'], 'readonly' => true, 'class' => 'form-control rgt', 'tabindex' => '50', 'label' => false, 'div' => false)); ?><span class="input-group-addon">%</span></div>
                                                  
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label>Attached to</label>
                                                <span class="colon">:</span>
                                                <div class="col-sm-10"><?php echo $this->Form->input('unit_third_payment_attached_to_construction', array('options' => $attach_to, 'selected' => $project_units['ProjectUnit']['unit_third_payment_attached_to_construction'], 'disabled' => true, 'empty' => '--Select--', 'tabindex' => '51', 'label' => false, 'div' => false, 'class' => 'form-control')); ?>
                                                   
                                                </div>
                                            </div>
                                            <div class="form-group int-sm">
                                                <label>Due By</label>
                                                <span class="colon">:</span>
                                                <div class="col-sm-10">  <?php
                                                    echo $this->Form->input('unit_third_party_amount_due_in', array('value' => $project_units['ProjectUnit']['unit_third_party_amount_due_in'], 'readonly' => true, 'class' => 'form-control sm rgt', 'tabindex' => '52', 'label' => false, 'div' => false));
                                                    echo $this->Form->input('unit_third_party_option', array('label' => false, 'options' => array('Days' => 'Days', 'Months' => 'Months'), 'selected' => $project_units['ProjectUnit']['unit_third_party_option'], 'disabled' => true, 'empty' => '--Select--', 'tabindex' => '53', 'label' => false, 'div' => false, 'class' => 'form-control'));
                                                    ?>
                                                  
                                                </div>
                                            </div>


                                        </div>
                                        <div class="col-sm-6">

                                            <h4>&nbsp;</h4>
                                            <div class="form-group">
                                                <label>Percent Lumpsum</label>
                                                <span class="colon">:</span>
                                                <div class="col-sm-10"><div class="input-group"><?php echo $this->data['Deal']['deal_unit_downpayment_on_percent_or_lumpsum'].' %';?></div></div>
                                            </div>
                                            <div class="form-group">
                                                <label>Attached to</label>
                                                <span class="colon">:</span>
                                                <div class="col-sm-10"><?php echo $this->data['Deal']['deal_unit_downpayment_attached_to_construction'];?></div>
                                            </div>
                                            <div class="form-group int-sm">
                                                <label>Due By</label>
                                                <span class="colon">:</span>
                                                <div class="col-sm-10">  <?php
                                                    echo $this->data['Deal']['deal_unit_downpayment_amount_due_in'];
                                                    echo $this->data['Deal']['deal_unit_downpayment_option'];
                                                    ?></div>
                                            </div>

                                            <h4>&nbsp;</h4>
                                            <div class="form-group">
                                                <label>Percent Lumpsum</label>
                                                <span class="colon">:</span>
                                                <div class="col-sm-10"><div class="input-group"><?php echo $this->data['Deal']['deal_unit_second_payment_on_percent_or_lumpsum'].' %';?></div></div>
                                            </div>
                                            <div class="form-group">
                                                <label>Attached to</label>
                                                <span class="colon">:</span>
                                                <div class="col-sm-10"><?php echo $this->data['Deal']['deal_unit_second_payment_attached_to_construction'];?></div>
                                            </div> 
                                            <div class="form-group int-sm">
                                                <label>Due By</label>
                                                <span class="colon">:</span>
                                                <div class="col-sm-10">  <?php
                                                    echo $this->data['Deal']['deal_unit_second_payment_amount_due_in'];
                                                    echo $this->data['Deal']['deal_unit_second_option'];
                                                    ?></div>
                                            </div>

                                            <h4>&nbsp;</h4>

                                            <div class="form-group">
                                                <label>Percent Lumpsum</label>
                                                <span class="colon">:</span>
                                                <div class="col-sm-10"><div class="input-group"><?php echo $this->data['Deal']['deal_unit_third_payment_on_percent_or_lumpsum'].' %';?></div></div>
                                            </div>
                                            <div class="form-group">
                                                <label>Attached to</label>
                                                <span class="colon">:</span>
                                                <div class="col-sm-10"><?php echo $this->data['Deal']['deal_unit_third_payment_attached_to_construction'];?></div>
                                            </div>
                                            <div class="form-group int-sm">
                                                <label>Due By</label>
                                                <span class="colon">:</span>
                                                <div class="col-sm-10">  <?php
                                                    echo $this->data['Deal']['deal_unit_third_party_amount_due_in'];
                                                    echo $this->data['Deal']['deal_unit_third_party_option'];
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
                                                   
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label>Based on</label>
                                                <span class="colon">:</span>
                                                <div class="col-sm-10"><?php echo $this->Form->input('unit_commission_based_on', array('options' => $based_on, 'selected' => $project_units['ProjectUnit']['unit_commission_based_on'], 'disabled' => true, 'empty' => '--Select--', 'tabindex' => '56')); ?>
                                                   
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label>Commission Event</label>
                                                <span class="colon">:</span>
                                                <div class="col-sm-10"><?php echo $this->Form->input('unit_commission_event', array('options' => $commission_event, 'selected' => $project_units['ProjectUnit']['unit_commission_event'], 'disabled' => true, 'empty' => '--Select--', 'tabindex' => '55')); ?>
                                                  
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label>Applied To</label>
                                                <span class="colon">:</span>
                                                <div class="col-sm-10"><?php echo $this->Form->input('unit_commission_applied_to', array('value' => $project_units['ProjectUnit']['unit_commission_applied_to'], 'readonly' => true, 'class' => 'form-control rgt', 'readonly' => true, 'tabindex' => '57')); ?>
                                                  
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label>Commission % </label>
                                                <span class="colon">:</span>
                                                <div class="col-sm-10"><div class="input-group"><?php echo $this->data['Deal']['deal_unit_commission_percent'].' %';?></div>

                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label>Based on</label>
                                                <span class="colon">:</span>
                                                <div class="col-sm-10"><?php echo $this->data['Deal']['deal_unit_commission_based_on'];?></div>
                                            </div>
                                            <div class="form-group">
                                                <label>Commission Event</label>
                                                <span class="colon">:</span>
                                                <div class="col-sm-10"><?php echo $this->data['Deal']['deal_unit_commission_event'];?></div>
                                            </div>
                                            <div class="form-group">
                                                <label>Applied To</label>
                                                <span class="colon">:</span>
                                                <div class="col-sm-10"><?php echo $this->data['Deal']['deal_unit_commission_applied_to'];?></div>
                                            </div>
                                        </div> 
                                    </div>
                                </div>
                            </div>
                        </div>

                    <?php } ?>
                </div>

                <div class="col-sm-12 report_tran" id="ajax_client" style="display:block;">
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
                                                    echo $this->Form->input('lead_country', array('value' => $leads['Country']['value'], 'readonly' => true, 'label' => false, 'div' => false, 'class' => 'form-control'));
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
                                                    echo $this->Form->input('lead_streetaddress', array('value' => $leads['Lead']['lead_streetaddress'], 'readonly' => true, 'label' => false, 'div' => false, 'class' => 'form-control'));
                                                    ?> 
                                                  
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label>Client Name</label>
                                                <span class="colon">:</span>
                                                <div class="col-sm-10">
                                                    <?php echo $this->data['Deal']['deal_client_name'];?> 
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label>Country</label>
                                                <span class="colon">:</span>
                                                <div class="col-sm-10">
                                                    <?php echo $this->data['Deal']['deal_lead_country'];?> 
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label>Primary Mobile</label>
                                                <span class="colon">:</span>
                                                <div class="col-sm-10">
                                                    <?php echo $this->data['Deal']['deal_lead_primaryphonenumber'];?> 
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label>Secondary Mobile</label>
                                                <span class="colon">:</span>
                                                <div class="col-sm-10">
                                                    <?php echo $this->data['Deal']['deal_lead_secondaryphonenumber'];?> 
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label>Email</label>
                                                <span class="colon">:</span>
                                                <div class="col-sm-10">
                                                    <?php echo $this->data['Deal']['deal_lead_emailid'];?> 
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label>Street Address</label>
                                                <span class="colon">:</span>
                                                <div class="col-sm-10">
                                                    <?php echo $this->data['Deal']['deal_lead_streetaddress'];?> 
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>

                    <?php } ?>
                </div>
                <div class="col-sm-12 report_tran" id="ajax_prolegal" style="display:block;">
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
                                                   
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label>Legal Location</label>
                                                <span class="colon">:</span>
                                                <div class="col-sm-10"><?php
                                                    echo $this->Form->input('legal_city', array('value' => $ProjectLegalNames['Location']['city_name'], 'readonly' => true, 'label' => false, 'div' => false, 'class' => 'form-control'));
                                                    ?>
                                                  
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label>Contact Name</label>
                                                <span class="colon">:</span>
                                                <div class="col-sm-10"><?php
                                                    echo $this->Form->input('legal_contact', array('value' => $ProjectLegalNames['BuilderContact']['builder_contact_name'], 'readonly' => true, 'label' => false, 'div' => false, 'class' => 'form-control'));
                                                    ?>
                                                   
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
                                                  
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label>Primary Email</label>
                                                <span class="colon">:</span>
                                                <div class="col-sm-10"> <?php echo $this->Form->input('legal_email', array('value' => $ProjectLegalNames['BuilderContact']['builder_contact_email'], 'readonly' => true, 'label' => false, 'div' => false, 'class' => 'form-control')); ?>
                                                  
                                                </div>
                                            </div>


                                        </div>
                                        <div class="col-sm-6">

                                            <div class="form-group">
                                                <label>Legal Address</label>
                                                <span class="colon">:</span>
                                                <div class="col-sm-10"> <?php echo $this->data['Deal']['deal_legal_address'];?></div>
                                            </div>
                                            <div class="form-group">
                                                <label>Legal Location</label>
                                                <span class="colon">:</span>
                                                <div class="col-sm-10"> <?php echo $this->data['Deal']['deal_legal_city'];?></div>
                                            </div>
                                            <div class="form-group">
                                                <label>Contact Name</label>
                                                <span class="colon">:</span>
                                                <div class="col-sm-10"> <?php echo $this->data['Deal']['deal_legal_contact'];?></div>
                                            </div>
                                            <div class="form-group slt-sm">
                                                <label for="reg_input_name">Primary Mobile</label>
                                                <span class="colon">:</span>
                                                <div class="col-sm-10">
                                                    <?php
                                                   echo $this->data['Deal']['deal_legal_primary_code'];
                                                   echo $this->data['Deal']['deal_legal_primary_no'];
                                                   
                                                    ?></div>
                                            </div>

                                            <div class="form-group">
                                                <label>Primary Email</label>
                                                <span class="colon">:</span>
                                                <div class="col-sm-10"> <?php echo $this->data['Deal']['deal_legal_email'];?></div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                    
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


?>   
<script>
    $('#ActionItemTypeId').change(function() {
        var val = $(this).val();
        if (val == '20') {
            $('.release_cln').css('display', 'block');
            $('.report_tran').css('display', 'block');
        }
        else
        {
            $('.release_cln').css('display', 'none');
            $('.report_tran').css('display', 'block');
        }
    });

   
</script>
