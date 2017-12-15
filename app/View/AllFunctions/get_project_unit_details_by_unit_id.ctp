<?php if (count($project_units) > 0) { ?>
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
                                echo $this->Form->input('ActionItem.unit_type', array('value' => $project_units['UnitType']['value'], 'readonly' => true, 'label' => false, 'div' => false, 'class' => 'form-control'));
                                ?>
                                <span class="copy_right_arrow" id="copy_unit_type"></span>
                            </div>

                        </div>
                        <div class="form-group">
                                                <label>Floor Number</label>
                                                <span class="colon">:</span>
                                                <div class="col-sm-10"><?php
                                                    echo $this->Form->input('ActionItem.unit_floor_number', array('value' => $project_units['ProjectUnit']['unit_floor_number'], 'readonly' => true, 'label' => false, 'div' => false, 'class' => 'form-control rgt'));
                                                    ?>
                                                    <span class="copy_right_arrow" id="copy_unit_floor_number"></span>
                                                </div>

                                            </div> 
                        <div class="form-group">
                            <label>Unit Display Name</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10"><?php
                                echo $this->Form->input('ActionItem.unit_name', array('value' => $project_units['ProjectUnit']['unit_name'], 'readonly' => true, 'label' => false, 'div' => false, 'class' => 'form-control'));
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
                            <div class="col-sm-10"><?php echo $this->Form->input('name', array('class' => 'form-control', 'label' => false, 'div' => false)); ?></div>
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
                                echo $this->Form->input('ActionItem.unit_total_basic_cost', array('value' => $project_units['ProjectUnit']['unit_total_basic_cost'], 'readonly' => true, 'label' => false, 'div' => false, 'class' => 'form-control rgt taxes_duty'));
                                ?>
                                <span class="copy_right_arrow" id="copy_unit_basic_cost"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Other / Sq Ft</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10"><?php echo $this->Form->input('ActionItem.unit_other_cost_per_sq_ft', array('value' => $project_units['ProjectUnit']['unit_other_cost_per_sq_ft'], 'readonly' => true, 'label' => false, 'div' => false, 'class' => 'form-control rgt taxes_duty')); ?>
                                <span class="copy_right_arrow" id="copy_unit_other_cost_per_sq_ft"></span>
                            </div>
                        </div> 
                        <div class="form-group">
                            <label>Floor Rise / Sq Ft </label>
                            <span class="colon">:</span>
                            <div class="col-sm-10"><?php echo $this->Form->input('ActionItem.unit_floor_charges_sq_ft', array('value' => $project_units['ProjectUnit']['unit_floor_charges_sq_ft'], 'readonly' => true, 'label' => false, 'div' => false, 'class' => 'form-control rgt taxes_duty')); ?>
                                <span class="copy_right_arrow" id="copy_unit_floor_charges_sq_ft"></span>
                            </div>
                        </div>  
                        <div class="form-group">
                            <label>Floor Rise From</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10"><?php echo $this->Form->input('ActionItem.unit_floor_rise_or_plc_from', array('value' => $project_units['ProjectUnit']['unit_floor_rise_or_plc_from'], 'readonly' => true, 'label' => false, 'div' => false, 'class' => 'form-control rgt taxes_duty')); ?>
                                <span class="copy_right_arrow" id="copy_unit_floor_rise_or_plc_from"></span>
                            </div>
                        </div> 
                        <div class="form-group">
                            <label>PLC / Sq Ft</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10"><?php echo $this->Form->input('ActionItem.unit_plc_charges_sq_ft', array('value' => $project_units['ProjectUnit']['unit_plc_charges_sq_ft'], 'readonly' => true, 'label' => false, 'div' => false, 'class' => 'form-control  rgt taxes_duty')); ?>
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
                                echo $this->Form->input('ActionItem.unit_amenities_cost', array('value' => $project_units['ProjectUnit']['unit_amenities_cost'], 'readonly' => true, 'label' => false, 'div' => false, 'class' => 'form-control rgt'));
                                ?>
                                <span class="copy_right_arrow" id="copy_unit_amenities_cost"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Infrastructure Cost</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10"><?php echo $this->Form->input('ActionItem.unit_infra_pre_agreement_cost', array('value' => $project_units['ProjectUnit']['unit_infra_pre_agreement_cost'], 'readonly' => true, 'label' => false, 'div' => false, 'class' => 'form-control rgt')); ?>
                                <span class="copy_right_arrow" id="copy_unit_infra_pre_agreement_cost"></span>
                            </div>
                        </div>   
                        <div class="form-group">
                            <label>Car Parking Cost </label>
                            <span class="colon">:</span>
                            <div class="col-sm-10"><?php echo $this->Form->input('ActionItem.unit_car_parking_cost', array('value' => $project_units['ProjectUnit']['unit_car_parking_cost'], 'readonly' => true, 'label' => false, 'div' => false, 'class' => 'form-control rgt')); ?>
                                <span class="copy_right_arrow" id="copy_unit_car_parking_cost"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Other Cost</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10"><?php echo $this->Form->input('ActionItem.unit_other_pre_agreement_cost', array('value' => $project_units['ProjectUnit']['unit_other_pre_agreement_cost'], 'readonly' => true, 'label' => false, 'div' => false, 'class' => 'form-control rgt')); ?>
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
                            <div class="col-sm-10"><div class="input-group"><?php echo $this->Form->input('ActionItem.unit_stamp_duty', array('value' => $project_units['ProjectUnit']['unit_stamp_duty'], 'readonly' => true, 'label' => false, 'div' => false, 'class' => 'form-control rgt taxes_duty')); ?><span class="input-group-addon">%</span></div>
                                <span class="copy_right_arrow" id="copy_unit_stamp_duty"></span>
                            </div>
                        </div>
                        <div class="form-group percsym">
                            <label>Service Tax % </label>
                            <span class="colon">:</span>
                            <div class="col-sm-10"><div class="input-group"><?php echo $this->Form->input('ActionItem.unit_service_tax', array('value' => $project_units['ProjectUnit']['unit_service_tax'], 'readonly' => true, 'label' => false, 'div' => false, 'class' => 'form-control rgt taxes_duty')); ?><span class="input-group-addon">%</span></div>
                                <span class="copy_right_arrow" id="copy_unit_service_tax"></span>
                            </div>
                        </div>  
                        <div class="form-group percsym">
                            <label>VAT % </label>
                            <span class="colon">:</span>
                            <div class="col-sm-10"><div class="input-group"><?php echo $this->Form->input('ActionItem.unit_vat', array('value' => $project_units['ProjectUnit']['unit_vat'], 'readonly' => true, 'label' => false, 'div' => false, 'class' => 'form-control rgt taxes_duty')); ?><span class="input-group-addon">%</span></div>
                                <span class="copy_right_arrow" id="copy_unit_vat"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Registration</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10"><?php
                                echo $this->Form->input('ActionItem.unit_registration_cost', array('value' => $project_units['ProjectUnit']['unit_registration_cost'], 'readonly' => true, 'label' => false, 'div' => false, 'class' => 'form-control rgt taxes_duty'));
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
                                echo $this->Form->input('ActionItem.unit_societies_cost', array('value' => $project_units['ProjectUnit']['unit_societies_cost'], 'readonly' => true, 'label' => false, 'div' => false, 'class' => 'form-control rgt taxes_duty'));
                                ?>
                                <span class="copy_right_arrow" id="copy_unit_societies_cost"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Infra Charges </label>
                            <span class="colon">:</span>
                            <div class="col-sm-10"><?php echo $this->Form->input('ActionItem.unit_other_infra_charges', array('value' => $project_units['ProjectUnit']['unit_other_infra_charges'], 'readonly' => true, 'label' => false, 'div' => false, 'class' => 'form-control rgt taxes_duty')); ?>
                                <span class="copy_right_arrow" id="copy_unit_other_infra_charges"></span>
                            </div>
                        </div> 
                        <div class="form-group">
                            <label>Legal Charges</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10"><?php echo $this->Form->input('ActionItem.unit_legal_cost', array('value' => $project_units['ProjectUnit']['unit_legal_cost'], 'readonly' => true, 'label' => false, 'div' => false, 'class' => 'form-control rgt taxes_duty')); ?>
                                <span class="copy_right_arrow" id="copy_unit_legal_cost"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Other Charges</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10"><?php echo $this->Form->input('ActionItem.unit_other_charges', array('value' => $project_units['ProjectUnit']['unit_other_charges'], 'readonly' => true, 'label' => false, 'div' => false, 'class' => 'form-control rgt taxes_duty')); ?>
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
                            <div class="col-sm-10"><?php echo $this->Form->input('ActionItem.unit_iniitial_booking_amount', array('value' => $project_units['ProjectUnit']['unit_iniitial_booking_amount'], 'readonly' => true, 'class' => 'form-control rgt', 'tabindex' => '39', 'label' => false, 'div' => false)); ?>
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
                            <div class="col-sm-10"><div class="input-group"><?php echo $this->Form->input('ActionItem.unit_downpayment_on_percent_or_lumpsum', array('value' => $project_units['ProjectUnit']['unit_downpayment_on_percent_or_lumpsum'], 'readonly' => true, 'class' => 'form-control rgt', 'tabindex' => '42', 'label' => false, 'div' => false)); ?><span class="input-group-addon">%</span></div>
                                <span class="copy_right_arrow" id="copy_unit_downpayment_on_percent_or_lumpsum"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Attached to</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10"><?php echo $this->Form->input('ActionItem.unit_downpayment_attached_to_construction', array('options' => $attach_to, 'selected' => $project_units['ProjectUnit']['unit_downpayment_attached_to_construction'], 'disabled' => true, 'empty' => '--Select--', 'tabindex' => '43', 'label' => false, 'div' => false, 'class' => 'form-control')); ?>
                                <span class="copy_right_arrow" id="copy_unit_downpayment_attached_to_construction"></span>
                            </div>
                        </div>
                        <div class="form-group int-sm">
                            <label>Due By</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10">  <?php
                                echo $this->Form->input('ActionItem.unit_downpayment_amount_due_in', array('value' => $project_units['ProjectUnit']['unit_downpayment_amount_due_in'], 'readonly' => true, 'class' => 'form-control sm rgt', 'tabindex' => '44', 'label' => false, 'div' => false));
                                echo $this->Form->input('ActionItem.unit_downpayment_option', array('label' => false, 'options' => array('Days' => 'Days', 'Months' => 'Months'), 'selected' => $project_units['ProjectUnit']['unit_downpayment_option'], 'disabled' => true, 'empty' => '--Select--', 'tabindex' => '45', 'label' => false, 'div' => false, 'class' => 'form-control'));
                                ?>
                                <span class="copy_right_arrow" id="copy_unit_downpayment_amount_due_in"></span>
                            </div>
                        </div>

                        <h4>Second Payment</h4>

                        <div class="form-group percsym">
                            <label>Percent Lumpsum</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10"><div class="input-group"><?php echo $this->Form->input('ActionItem.unit_second_payment_on_percent_or_lumpsum', array('value' => $project_units['ProjectUnit']['unit_second_payment_on_percent_or_lumpsum'], 'readonly' => true, 'class' => 'form-control rgt', 'tabindex' => '46', 'label' => false, 'div' => false)); ?><span class="input-group-addon">%</span></div>
                                <span class="copy_right_arrow" id="copy_unit_second_payment_on_percent_or_lumpsum"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Attached to </label>
                            <span class="colon">:</span>
                            <div class="col-sm-10"><?php echo $this->Form->input('ActionItem.unit_second_payment_attached_to_construction', array('options' => $attach_to, 'selected' => $project_units['ProjectUnit']['unit_second_payment_attached_to_construction'], 'disabled' => true, 'empty' => '--Select--', 'tabindex' => '47', 'label' => false, 'div' => false, 'class' => 'form-control')); ?>
                                <span class="copy_right_arrow" id="copy_unit_second_payment_attached_to_construction"></span>
                            </div>
                        </div>
                        <div class="form-group int-sm">
                            <label>Due By</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10">  <?php
                                echo $this->Form->input('ActionItem.unit_second_payment_amount_due_in', array('value' => $project_units['ProjectUnit']['unit_second_payment_amount_due_in'], 'readonly' => true, 'class' => 'form-control sm rgt', 'tabindex' => '48', 'label' => false, 'div' => false));
                                echo $this->Form->input('ActionItem.unit_second_option', array('label' => false, 'options' => array('Days' => 'Days', 'Months' => 'Months'), 'selected' => $project_units['ProjectUnit']['unit_second_option'], 'disabled' => true, 'empty' => '--Select--', 'tabindex' => '49', 'label' => false, 'div' => false, 'class' => 'form-control'));
                                ?>
                                <span class="copy_right_arrow" id="copy_unit_second_payment_amount_due_in"></span>
                            </div>
                        </div>

                        <h4>Third Payment</h4>   

                        <div class="form-group percsym">
                            <label>Percent Lumpsum</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10"><div class="input-group"><?php echo $this->Form->input('ActionItem.unit_third_payment_on_percent_or_lumpsum', array('value' => $project_units['ProjectUnit']['unit_third_payment_on_percent_or_lumpsum'], 'readonly' => true, 'class' => 'form-control rgt', 'tabindex' => '50', 'label' => false, 'div' => false)); ?><span class="input-group-addon">%</span></div>
                                <span class="copy_right_arrow" id="copy_unit_third_payment_on_percent_or_lumpsum"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Attached to</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10"><?php echo $this->Form->input('ActionItem.unit_third_payment_attached_to_construction', array('options' => $attach_to, 'selected' => $project_units['ProjectUnit']['unit_third_payment_attached_to_construction'], 'disabled' => true, 'empty' => '--Select--', 'tabindex' => '51', 'label' => false, 'div' => false, 'class' => 'form-control')); ?>
                                <span class="copy_right_arrow" id="copy_unit_third_payment_attached_to_construction"></span>
                            </div>
                        </div>
                        <div class="form-group int-sm">
                            <label>Due By</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10">  <?php
                                echo $this->Form->input('ActionItem.unit_third_party_amount_due_in', array('value' => $project_units['ProjectUnit']['unit_third_party_amount_due_in'], 'readonly' => true, 'class' => 'form-control sm rgt', 'tabindex' => '52', 'label' => false, 'div' => false));
                                echo $this->Form->input('ActionItem.unit_third_party_option', array('label' => false, 'options' => array('Days' => 'Days', 'Months' => 'Months'), 'selected' => $project_units['ProjectUnit']['unit_third_party_option'], 'disabled' => true, 'empty' => '--Select--', 'tabindex' => '53', 'label' => false, 'div' => false, 'class' => 'form-control'));
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
                            <div class="col-sm-10"><div class="input-group"><?php echo $this->Form->input('ActionItem.unit_commission_percent', array('value' => $project_units['ProjectUnit']['unit_commission_percent'], 'readonly' => true, 'class' => 'form-control rgt taxes_duty', 'tabindex' => '54', 'label' => false, 'div' => false)); ?><span class="input-group-addon">%</span></div>
                                <span class="copy_right_arrow" id="copy_unit_commission_percent"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Based on</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10"><?php echo $this->Form->input('ActionItem.unit_commission_based_on', array('options' => $based_on,'class' => 'form-control', 'selected' => $project_units['ProjectUnit']['unit_commission_based_on'], 'disabled' => true, 'empty' => '--Select--', 'tabindex' => '56', 'label' => false, 'div' => false)); ?>
                                <span class="copy_right_arrow" id="copy_unit_commission_based_on"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Commission Event</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10"><?php echo $this->Form->input('ActionItem.unit_commission_event', array('options' => $commission_event,'class' => 'form-control', 'selected' => $project_units['ProjectUnit']['unit_commission_event'], 'disabled' => true, 'empty' => '--Select--', 'tabindex' => '55', 'label' => false, 'div' => false)); ?>
                                <span class="copy_right_arrow" id="copy_unit_commission_event"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Applied To</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10"><?php echo $this->Form->input('ActionItem.unit_commission_applied_to', array('value' => $project_units['ProjectUnit']['unit_commission_applied_to'], 'readonly' => true, 'class' => 'form-control rgt', 'readonly' => true, 'tabindex' => '57', 'label' => false, 'div' => false)); ?>
                                <span class="copy_right_arrow" id="copy_unit_commission_applied_to"></span>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group percsym">
                            <label>Commission % </label>
                            <span class="colon">:</span>
                            <div class="col-sm-10"><div class="input-group"><?php echo $this->Form->input('Deal.deal_unit_commission_percent', array('class' => 'form-control rgt taxes_duty', 'tabindex' => '54', 'label' => false, 'div' => false)); ?><span class="input-group-addon">%</span></div>

                            </div>
                        </div>
                        <div class="form-group">
                            <label>Based on</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10"><?php echo $this->Form->input('Deal.deal_unit_commission_based_on', array('options' => $based_on, 'empty' => '--Select--','class' => 'form-control', 'tabindex' => '56', 'label' => false, 'div' => false)); ?></div>
                        </div>
                        <div class="form-group">
                            <label>Commission Event</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10"><?php echo $this->Form->input('Deal.deal_unit_commission_event', array('options' => $commission_event,'class' => 'form-control', 'empty' => '--Select--', 'tabindex' => '55', 'label' => false, 'div' => false)); ?></div>
                        </div>
                        <div class="form-group">
                            <label>Applied To</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10"><?php echo $this->Form->input('Deal.deal_unit_commission_applied_to', array('class' => 'form-control rgt', 'readonly' => true, 'tabindex' => '57', 'label' => false, 'div' => false)); ?></div>
                        </div>
                    </div> 
                </div>
            </div>
        </div>
    </div>
<script>
    $('#copy_unit_type').click(function(){
       $('#DealDealUnitType').val($('#ActionItemUnitType').val());
    });
    
    $('#copy_unit_name').click(function(){
       $('#DealDealUnitName').val($('#ActionItemUnitName').val());
    });
    $('#copy_unit_basic_cost').click(function(){
       $('#DealDealUnitBasicCost').val($('#ActionItemUnitTotalBasicCost').val());
    });
    $('#copy_unit_other_cost_per_sq_ft').click(function(){
       $('#DealDealUnitOtherCostPerSqFt').val($('#ActionItemUnitOtherCostPerSqFt').val());
    });
    $('#copy_unit_floor_charges_sq_ft').click(function(){
       $('#DealDealUnitFloorChargesSqFt').val($('#ActionItemUnitFloorChargesSqFt').val());
    });
    $('#copy_unit_floor_rise_or_plc_from').click(function(){
       $('#DealDealUnitFloorRiseOrPlcFrom').val($('#ActionItemUnitFloorRiseOrPlcFrom').val());
    });
    $('#copy_unit_plc_charges_sq_ft').click(function(){
       $('#DealDealUnitPlcChargesSqFt').val($('#ActionItemUnitPlcChargesSqFt').val());
    });
    
    $('#copy_unit_amenities_cost').click(function(){
       $('#DealDealUnitAmenitiesCost').val($('#ActionItemUnitAmenitiesCost').val());
    });
    $('#copy_unit_infra_pre_agreement_cost').click(function(){
       $('#DealDealUnitInfraPreAgreementCost').val($('#ActionItemUnitInfraPreAgreementCost').val());
    });
    $('#copy_unit_car_parking_cost').click(function(){
       $('#DealDealUnitCarParkingCost').val($('#ActionItemUnitCarParkingCost').val());
    });
    $('#copy_unit_other_pre_agreement_cost').click(function(){
       $('#DealDealUnitOtherPreAgreementCost').val($('#ActionItemUnitOtherPreAgreementCost').val());
    });
    
    $('#copy_unit_stamp_duty').click(function(){
       $('#DealDealUnitStampDuty').val($('#ActionItemUnitStampDuty').val());
    });
    $('#copy_unit_service_tax').click(function(){
       $('#DealDealUnitServiceTax').val($('#ActionItemUnitServiceTax').val());
    });
    $('#copy_unit_vat').click(function(){
       $('#DealDealUnitVat').val($('#ActionItemUnitVat').val());
    });
    $('#copy_unit_registration_cost').click(function(){
       $('#DealDealUnitRegistrationCost').val($('#ActionItemUnitRegistrationCost').val());
    });
       
    $('#copy_unit_societies_cost').click(function(){
       $('#DealDealUnitSocietiesCost').val($('#ActionItemUnitSocietiesCost').val());
    });
    $('#copy_unit_other_infra_charges').click(function(){
       $('#DealDealOtherInfraCharges').val($('#ActionItemUnitOtherInfraCharges').val());
    });
    $('#copy_unit_legal_cost').click(function(){
       $('#DealDealUnitLegalCost').val($('#ActionItemUnitLegalCost').val());
    });
    $('#copy_unit_other_charges').click(function(){
       $('#DealDealUnitOtherCharges').val($('#ActionItemUnitOtherCharges').val());
    });
    $('#copy_unit_iniitial_booking_amount').click(function(){
       $('#DealDealBookingAmount').val($('#ActionItemUnitIniitialBookingAmount').val());
    });
    
    $('#copy_unit_downpayment_on_percent_or_lumpsum').click(function(){
       $('#DealDealUnitDownpaymentOnPercentOrLumpsum').val($('#ActionItemUnitDownpaymentOnPercentOrLumpsum').val());
    });
    $('#copy_unit_downpayment_attached_to_construction').click(function(){
       $('#DealDealUnitDownpaymentAttachedToConstruction').val($('#ActionItemUnitDownpaymentAttachedToConstruction').val());
    });
    $('#copy_unit_downpayment_amount_due_in').click(function(){
       $('#DealDealUnitDownpaymentAmountDueIn').val($('#ActionItemUnitDownpaymentAmountDueIn').val());
       $('#DealDealUnitDownpaymentOption').val($('#ActionItemUnitDownpaymentOption').val());
    });
    
    $('#copy_unit_second_payment_on_percent_or_lumpsum').click(function(){
       $('#DealDealUnitSecondPaymentOnPercentOrLumpsum').val($('#ActionItemUnitSecondPaymentOnPercentOrLumpsum').val());
    });
    $('#copy_unit_downpayment_attached_to_construction').click(function(){
       $('#DealDealUnitSecondPaymentAttachedToConstruction').val($('#ActionItemUnitSecondPaymentAttachedToConstruction').val());
    });
    $('#copy_unit_downpayment_amount_due_in').click(function(){
       $('#DealDealUnitSecondPaymentAmountDueIn').val($('#ActionItemUnitSecondPaymentAmountDueIn').val());
       $('#DealDealUnitSecondOption').val($('#ActionItemUnitSecondOption').val());
    });
    
    $('#copy_unit_third_payment_on_percent_or_lumpsum').click(function(){
       $('#DealDealUnitThirdPaymentOnPercentOrLumpsum').val($('#ActionItemUnitThirdPaymentOnPercentOrLumpsum').val());
    });
    $('#copy_unit_third_payment_attached_to_construction').click(function(){
       $('#DealDealUnitThirdPaymentAttachedToConstruction').val($('#ActionItemUnitThirdPaymentAttachedToConstruction').val());
    });
    $('#copy_unit_third_party_amount_due_in').click(function(){
       $('#DealDealUnitThirdPartyAmountDueIn').val($('#ActionItemUnitThirdPartyAmountDueIn').val());
       $('#DealDealUnitThirdPartyOption').val($('#ActionItemUnitThirdPartyOption').val());
    });
    
    $('#copy_unit_commission_percent').click(function(){
       $('#DealDealUnitCommissionPercent').val($('#ActionItemUnitCommissionPercent').val());
    });
    $('#copy_unit_commission_based_on').click(function(){
       $('#DealDealUnitCommissionBasedOn').val($('#ActionItemUnitCommissionBasedOn').val());
    });
    $('#copy_unit_commission_event').click(function(){
       $('#DealDealUnitCommissionEvent').val($('#ActionItemUnitCommissionEvent').val());
    });
    $('#copy_unit_commission_applied_to').click(function(){
       $('#DealDealUnitCommissionAppliedTo').val($('#ActionItemUnitCommissionAppliedTo').val());
    });
    $('#copy_unit_floor_number').click(function() {
        $('#DealDealUnitFloorNumber').val($('#ActionItemUnitFloorNumber').val());
    });
</script>
    <?php
}?>