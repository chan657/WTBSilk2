<?php
echo $this->Html->css(array('/bootstrap/css/bootstrap.min', 'popup',
    'todc-bootstrap.min',
    'font-awesome/css/font-awesome.min',
    '/img/flags/flags',
    'retina',
    'theme/color_1',
        )
);

echo $this->Html->script(array('jquery.min', 'pages/ebro_form_validate', '/bootstrap/js/bootstrap.min', 'common', 'lib/chained/jquery.chained.remote.min', 'lib/jquery.inputmask/jquery.inputmask.bundle.min', 'lib/parsley/parsley.min', 'lib/datepicker/js/bootstrap-datepicker', 'lib/timepicker/js/bootstrap-timepicker.min', 'pages/ebro_form_extended'));
?>


<!----------------------------start add project block------------------------------>
<div class="pop-outer">
    <div class="pop-up-hdng">Edit Unit</div>


    <?php
//echo $this->Form->create('Remark', array('enctype' => 'multipart/form-data'));
    echo $this->Form->create('ProjectUnit', array('method' => 'post', 'id' => 'parsley_reg', 'novalidate' => true,
        'inputDefaults' => array(
            'label' => false,
            'div' => false,
            'class' => 'form-control',
        ),
        array('controller' => 'projects', 'action' => 'edit_unit')
    ));
    echo $this->Form->hidden('unit_name');
    echo $this->Form->hidden('unit_floor_rise_or_plc');
    echo $this->Form->hidden('basic_cost');
    echo $this->Form->hidden('high_basic_cost');
    echo $this->Form->hidden('total_lump_cost');
    echo $this->Form->hidden('agreement_cost');
    echo $this->Form->hidden('high_agreement_cost');
    echo $this->Form->hidden('post_tax_total');
    echo $this->Form->hidden('high_post_tax_total');
    echo $this->Form->hidden('payable_cost');
    echo $this->Form->hidden('high_payable_cost');

// pr($lead);
    ?>
    <div class="row">
        <div class="col-sm-12 spacer fullrow">
            <div class="form-group">
                <h4>Unit Details</h4>
                <label for="reg_input_name" class="req bgr">Project Name</label>
                <span class="colon">:</span>
                <div class="col-sm-3 extrapace">
                    <?php echo $this->Form->input('project_id', array('disabled' => true, 'options' => $projects, 'data-required' => 'true', 'tabindex' => '1')); ?>
                </div>
                <div class="col-sm-3 extrapace">
                    <?php echo $this->Form->input('unit_tower_phase', array('placeholder' => 'Type Tower / Phase', 'tabindex' => '2')); ?>
                </div>
                <div class="col-sm-3 extrapace">
                    <?php
                    echo $this->Form->input('unit_type', array('options' => $unit_type, 'empty' => '--Choose Unit Type--', 'data-required' => 'true', 'tabindex' => '2'));
                    ?>


                </div>
            </div>

        </div>
        <!--<div class="col-sm-6">
       
            <div class="form-group">
                <label for="reg_input_name" class="req bgr">Project Name</label>
                <span class="colon">:</span>
                <div class="col-sm-10"> <?php echo $this->Form->input('project_id', array('options' => $projects, 'data-required' => 'true', 'tabindex' => '1')); ?></div>
            </div>
            
        </div>--> 
        <!--<div class="col-sm-6">
        <h4>&nbsp;</h4>
        <div class="form-group">
                <label for="reg_input_name" class="req bgr">Unit Type</label>
                <span class="colon">:</span>
                <div class="col-sm-10">  <?php echo $this->Form->input('unit_type', array('options' => $unit_type, 'empty' => '--Select--', 'data-required' => 'true', 'tabindex' => '2')); ?></div>
            </div>
        </div>-->
        <div class="col-sm-12 spacer fullrow">
            <div class="form-group">
                <label>Unit Description</label>
                <span class="colon">:</span>
                <div class="col-sm-10 editable txtbox">
                    <?php echo $this->Form->input('unit_description', array('type' => 'textarea', 'tabindex' => '3')); ?>
                </div>
            </div>
            <div class="form-group">
                <label>Unit Remarks</label>
                <span class="colon">:</span>
                <div class="col-sm-10 editable txtbox">
                    <?php echo $this->Form->input('unit_other_remarks', array('type' => 'textarea', 'tabindex' => '4')); ?>
                </div>
            </div>
        </div>
        <div class="col-sm-12 spacer">

            <div class="form-group five-column">
                <div class="col-sm-12">
                    <?php
                    echo $this->Form->input('unit_type_qualifier_1', array('options' => $unit_qualifier1, 'empty' => '--Qualifier 1--', 'tabindex' => '5'));
                    echo $this->Form->input('unit_type_qualifier_2', array('options' => $unit_qualifier2, 'empty' => '--Qualifier 2--', 'tabindex' => '6'));
                    echo $this->Form->input('unit_type_qualifier_3', array('options' => $unit_qualifier3, 'empty' => '--Qualifier 3--', 'tabindex' => '7'));
                    echo $this->Form->input('unit_type_qualifier_4', array('options' => $unit_qualifier4, 'empty' => '--Qualifier 4--', 'tabindex' => '8'));
                    echo $this->Form->input('unit_type_qualifier_5', array('options' => $unit_qualifier5, 'empty' => '--Qualifier 5--', 'tabindex' => '9'));
                    ?>
                    <?php echo $this->Form->button('Generate', array('type' => 'button', 'class' => 'btn btn-default btn-sm', 'id' => 'generate_qualifier', 'tabindex' => '10')); ?>

                </div>
            </div>
            <h4><span style="color:#771D5A"><div id="input_quilifier_text"><?php echo $this->data['ProjectUnit']['unit_name'];?></div></span></h4>
        </div>
    </div> 

    <div class="col-sm-12 expadng">
        <div class="panel-group" id="accordion1">
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
                                <label>Total Units</label>
                                <span class="colon">:</span>
                                <div class="col-sm-10"><?php echo $this->Form->input('unit_total_units_in_project', array('class' => 'form-control rgt', 'tabindex' => '11')); ?></div>
                            </div>
                            <div class="form-group">
                                <label>Sellable (Lowest)</label>
                                <span class="colon">:</span>
                                <div class="col-sm-10"><?php echo $this->Form->input('unit_sellable_area_lowest_size', array('class' => 'form-control rgt', 'tabindex' => '13')); ?></div>
                            </div>
                            <div class="form-group">
                                <label>Carpet (Lowest)</label>
                                <span class="colon">:</span>
                                <div class="col-sm-10"><?php echo $this->Form->input('units_carpet_area_lowest_size', array('class' => 'form-control rgt', 'tabindex' => '15')); ?></div>
                            </div>
                            <div class="form-group percsym">
                                <label>Avg Loading %  </label>
                                <span class="colon">:</span>
                                <div class="col-sm-10"><div class="input-group"><?php echo $this->Form->input('unit_loading_factor', array('tabindex' => '17')); ?><span class="input-group-addon">%</span></div></div>
                            </div>







                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Available </label>
                                <span class="colon">:</span>
                                <div class="col-sm-10"><?php echo $this->Form->input('unit_total_units_currently_available', array('class' => 'form-control rgt', 'tabindex' => '12')); ?></div>
                            </div>
                            <div class="form-group">
                                <label>Sellable (Highest)</label>
                                <span class="colon">:</span>
                                <div class="col-sm-10"><?php echo $this->Form->input('unit_sellable_area_highest_size', array('class' => 'form-control rgt', 'tabindex' => '14')); ?></div>
                            </div>
                            <div class="form-group">
                                <label>Carpet (Highest)</label>
                                <span class="colon">:</span>
                                <div class="col-sm-10"><?php echo $this->Form->input('unit_carpet_area_highest_size', array('class' => 'form-control rgt', 'tabindex' => '16')); ?></div>
                            </div>
                            <div class="form-group">
                                <label>Unit Active</label>
                                <span class="colon">:</span>
                                <div class="col-sm-10"><?php echo $this->Form->input('unit_total_units_currently_available', array('options' => array('1' => 'Yes', '2' => 'No'), 'empty' => '--Select--', 'default' => '1', 'tabindex' => '18')); ?></div>
                            </div>         
                        </div>
                    </div>
                </div>
            </div>

            <div class="calbson">
                <h5>All calculations are based on:</h5>
                <div class="col-sm-6">

                    <div class="form-group">
                        <label>Floor Number</label>
                        <span class="colon">:</span>
                        <div class="col-sm-10"><?php echo $this->Form->input('unit_floor_number', array('class' => 'form-control rgt', 'value' => '0', 'readonly' => true, 'tabindex' => '19')); ?></div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label>Cost Currency </label>
                        <span class="colon">:</span>
                        <div class="col-sm-10"><?php echo $this->Form->input('unit_cost_currency', array('options' => array('INR' => 'INR', 'AED' => 'AED', 'USD' => 'USD'), 'empty' => '--Select--', 'value' => 'INR', 'disabled' => TRUE, 'selected' => TRUE, 'tabindex' => '20')); ?></div>
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
                                <div class="col-sm-10"><?php echo $this->Form->input('unit_total_basic_cost', array('class' => 'form-control rgt', 'tabindex' => '21')); ?></div>
                            </div> 
                            <div class="form-group">
                                <label>Floor Rise / Sq Ft </label>
                                <span class="colon">:</span>
                                <div class="col-sm-10"><?php echo $this->Form->input('unit_floor_charges_sq_ft', array('class' => 'form-control rgt', 'tabindex' => '23')); ?></div>
                            </div>   
                            <div class="form-group">
                                <label>PLC / Sq Ft</label>
                                <span class="colon">:</span>
                                <div class="col-sm-10"><?php echo $this->Form->input('unit_plc_charges_sq_ft', array('class' => 'form-control rgt', 'tabindex' => '25')); ?></div>
                            </div> 






                        </div>
                        <div class="col-sm-6">

                            <div class="form-group">
                                <label>Other / Sq Ft</label>
                                <span class="colon">:</span>
                                <div class="col-sm-10"><?php echo $this->Form->input('unit_other_cost_per_sq_ft', array('class' => 'form-control rgt', 'tabindex' => '22')); ?></div>
                            </div>
                            <div class="form-group">
                                <label>Floor Rise From</label>
                                <span class="colon">:</span>
                                <div class="col-sm-10"><?php echo $this->Form->input('unit_floor_rise_or_plc_from', array('class' => 'form-control rgt', 'tabindex' => '24')); ?></div>
                            </div>

                            <div class="form-group">
                                <label>Sale Pattern</label>
                                <span class="colon">:</span>
                                <div class="col-sm-10"><?php echo $this->Form->input('unit_price_on_sellable_or_carpet', array('options' => array('Sellable' => 'Sellable', 'Carpet' => 'Carpet'), 'empty' => '--Select--', 'default' => 'Sellable', 'tabindex' => '26')); ?></div>
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
                                <div class="col-sm-10"><?php echo $this->Form->input('unit_amenities_cost', array('class' => 'form-control rgt', 'tabindex' => '27')); ?></div>
                            </div>
                            <div class="form-group">
                                <label>Infrastructure Cost</label>
                                <span class="colon">:</span>
                                <div class="col-sm-10"><?php echo $this->Form->input('unit_infra_pre_agreement_cost', array('class' => 'form-control rgt', 'tabindex' => '29')); ?></div>
                            </div>    
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Car Parking Cost </label>
                                <span class="colon">:</span>
                                <div class="col-sm-10"><?php echo $this->Form->input('unit_car_parking_cost', array('class' => 'form-control rgt', 'tabindex' => '28')); ?></div>
                            </div>
                            <div class="form-group">
                                <label>Other Cost</label>
                                <span class="colon">:</span>
                                <div class="col-sm-10"><?php echo $this->Form->input('unit_other_pre_agreement_cost', array('class' => 'form-control rgt', 'tabindex' => '30')); ?></div>
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
                                <div class="col-sm-10"><div class="input-group"><?php echo $this->Form->input('unit_stamp_duty', array('class' => 'form-control rgt taxes_duty', 'value' => '5.00', 'tabindex' => '31')); ?><span class="input-group-addon">%</span></div></div>
                            </div>
                            <div class="form-group percsym">
                                <label>Service Tax % </label>
                                <span class="colon">:</span>
                                <div class="col-sm-10"><div class="input-group"><?php echo $this->Form->input('unit_service_tax', array('class' => 'form-control rgt taxes_duty', 'value' => '3.09', 'tabindex' => '33')); ?><span class="input-group-addon">%</span></div></div>
                            </div>    
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group percsym">
                                <label>VAT % </label>
                                <span class="colon">:</span>
                                <div class="col-sm-10"><div class="input-group"><?php echo $this->Form->input('unit_vat', array('class' => 'form-control rgt taxes_duty', 'value' => '1.00', 'tabindex' => '32')); ?><span class="input-group-addon">%</span></div></div>
                            </div>
                            <div class="form-group">
                                <label>Registration</label>
                                <span class="colon">:</span>
                                <div class="col-sm-10"><?php echo $this->Form->input('unit_registration_cost', array('class' => 'form-control rgt', 'tabindex' => '34')); ?></div>
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
                                <div class="col-sm-10"><?php echo $this->Form->input('unit_societies_cost', array('class' => 'form-control rgt', 'tabindex' => '35')); ?></div>
                            </div>
                            <div class="form-group">
                                <label>Infra Charges </label>
                                <span class="colon">:</span>
                                <div class="col-sm-10"><?php echo $this->Form->input('unit_other_infra_charges', array('class' => 'form-control rgt', 'tabindex' => '37')); ?></div>
                            </div>    
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Legal Charges</label>
                                <span class="colon">:</span>
                                <div class="col-sm-10"><?php echo $this->Form->input('unit_legal_cost', array('class' => 'form-control rgt', 'tabindex' => '36')); ?></div>
                            </div>
                            <div class="form-group">
                                <label>Other Charges</label>
                                <span class="colon">:</span>
                                <div class="col-sm-10"><?php echo $this->Form->input('unit_other_charges', array('class' => 'form-control rgt', 'tabindex' => '38')); ?></div>
                            </div>  
                        </div> 
                    </div>
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4 class="panel-title">
                        <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#acc2_collapseSix">
                            Booking Requirements
                        </a>
                    </h4>
                </div>
                <div id="acc2_collapseSix" class="panel-collapse collapse">
                    <div class="panel-body">
                        <div class="col-sm-6">

                            <div class="form-group">
                                <label>Booking Amount</label>
                                <span class="colon">:</span>
                                <div class="col-sm-10"><?php echo $this->Form->input('unit_iniitial_booking_amount', array('class' => 'form-control rgt', 'tabindex' => '39')); ?></div>
                            </div>




                        </div>
                        <div class="col-sm-6">
                            <div class="form-group int-sm">
                                <label>Due By</label>
                                <span class="colon">:</span>
                                <div class="col-sm-10">  <?php
                                    echo $this->Form->input('unit_initial_booking_payment_due', array('class' => 'form-control sm rgt', 'tabindex' => '40'));
                                    echo $this->Form->input('unit_initial_option', array('label' => false, 'options' => array('Days' => 'Days', 'Months' => 'Months'), 'empty' => '--Select--', 'tabindex' => '41'));
                                    ?></div>
                            </div>







                        </div> 
                    </div>
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4 class="panel-title">
                        <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#acc2_collapseSeven">
                            Downpayment Requirements
                        </a>
                    </h4>
                </div>
                <div id="acc2_collapseSeven" class="panel-collapse collapse">
                    <div class="panel-body">

                        <div class="col-sm-6">
                            <h4>Downpayment</h4>
                            <div class="form-group percsym">
                                <label>Percent Lumpsum</label>
                                <span class="colon">:</span>
                                <div class="col-sm-10"><div class="input-group"><?php echo $this->Form->input('unit_downpayment_on_percent_or_lumpsum', array('class' => 'form-control rgt', 'tabindex' => '42')); ?><span class="input-group-addon">%</span></div></div>
                            </div>

                            <div class="form-group int-sm">
                                <label>Due By</label>
                                <span class="colon">:</span>
                                <div class="col-sm-10">  <?php
                                    echo $this->Form->input('unit_downpayment_amount_due_in', array('class' => 'form-control sm rgt', 'tabindex' => '44'));
                                    echo $this->Form->input('unit_downpayment_option', array('label' => false, 'options' => array('Days' => 'Days', 'Months' => 'Months'), 'empty' => '--Select--', 'tabindex' => '45'));
                                    ?></div>
                            </div>


                            <h4>Second Payment</h4>

                            <div class="form-group percsym">
                                <label>Percent Lumpsum</label>
                                <span class="colon">:</span>
                                <div class="col-sm-10"><div class="input-group"><?php echo $this->Form->input('unit_second_payment_on_percent_or_lumpsum', array('class' => 'form-control rgt', 'tabindex' => '46')); ?><span class="input-group-addon">%</span></div></div>
                            </div>
                            <div class="form-group int-sm">
                                <label>Due By</label>
                                <span class="colon">:</span>
                                <div class="col-sm-10">  <?php
                                    echo $this->Form->input('unit_second_payment_amount_due_in', array('class' => 'form-control sm rgt', 'tabindex' => '48'));
                                    echo $this->Form->input('unit_second_option', array('label' => false, 'options' => array('Days' => 'Days', 'Months' => 'Months'), 'empty' => '--Select--', 'tabindex' => '49'));
                                    ?></div>
                            </div>

                            <h4>Third Payment</h4>   

                            <div class="form-group percsym">
                                <label>Percent Lumpsum</label>
                                <span class="colon">:</span>
                                <div class="col-sm-10"><div class="input-group"><?php echo $this->Form->input('unit_third_payment_on_percent_or_lumpsum', array('class' => 'form-control rgt', 'tabindex' => '50')); ?><span class="input-group-addon">%</span></div></div>
                            </div>
                            <div class="form-group int-sm">
                                <label>Due By</label>
                                <span class="colon">:</span>
                                <div class="col-sm-10">  <?php
                                    echo $this->Form->input('unit_third_party_amount_due_in', array('class' => 'form-control sm rgt', 'tabindex' => '52'));
                                    echo $this->Form->input('unit_third_party_option', array('label' => false, 'options' => array('Days' => 'Days', 'Months' => 'Months'), 'empty' => '--Select--', 'tabindex' => '53'));
                                    ?></div>
                            </div>


                        </div>
                        <div class="col-sm-6">

                            <h4>&nbsp;</h4>
                            <div class="form-group">
                                <label>Attached to</label>
                                <span class="colon">:</span>
                                <div class="col-sm-10"><?php echo $this->Form->input('unit_downpayment_attached_to_construction', array('options' => $attach_to, 'empty' => '--Select--', 'tabindex' => '43')); ?></div>
                            </div>
                            <h4>&nbsp;</h4>
                            <h4>&nbsp;</h4>
                            <div class="form-group">
                                <label>Attached to </label>
                                <span class="colon">:</span>
                                <div class="col-sm-10"><?php echo $this->Form->input('unit_second_payment_attached_to_construction', array('options' => $attach_to, 'empty' => '--Select--', 'tabindex' => '47')); ?></div>
                            </div>

                            <h4>&nbsp;</h4> 
                            <h4>&nbsp;</h4>

                            <div class="form-group">
                                <label>Attached to</label>
                                <span class="colon">:</span>
                                <div class="col-sm-10"><?php echo $this->Form->input('unit_third_payment_attached_to_construction', array('options' => $attach_to, 'empty' => '--Select--', 'tabindex' => '51')); ?></div>
                            </div>

                        </div> 
                    </div>
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4 class="panel-title">
                        <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#acc2_collapseEight">
                            Commission Structure
                        </a>
                    </h4>
                </div>
                <div id="acc2_collapseEight" class="panel-collapse collapse">
                    <div class="panel-body">
                        <div class="col-sm-6">

                            <div class="form-group percsym">
                                <label>Commission % </label>
                                <span class="colon">:</span>
                                <div class="col-sm-10"><div class="input-group"><?php echo $this->Form->input('unit_commission_percent', array('class' => 'form-control rgt taxes_duty', 'tabindex' => '54')); ?><span class="input-group-addon">%</span></div></div>
                            </div>
                            <div class="form-group">
                                <label>Based on</label>
                                <span class="colon">:</span>
                                <div class="col-sm-10"><?php echo $this->Form->input('unit_commission_based_on', array('options' => $based_on, 'empty' => '--Select--', 'tabindex' => '56')); ?></div>
                            </div>

                        </div>
                        <div class="col-sm-6">

                            <div class="form-group">
                                <label>Commission Event</label>
                                <span class="colon">:</span>
                                <div class="col-sm-10"><?php echo $this->Form->input('unit_commission_event', array('options' => $commission_event, 'empty' => '--Select--', 'tabindex' => '55')); ?></div>
                            </div>
                            <div class="form-group">
                                <label>Applied To</label>
                                <span class="colon">:</span>
                                <div class="col-sm-10"><?php echo $this->Form->input('unit_commission_applied_to', array('class' => 'form-control rgt', 'readonly' => true, 'tabindex' => '57')); ?></div>
                            </div>
                        </div> 
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php echo $this->Form->button('Calculate', array('type' => 'button', 'class' => 'btn btn-default btn-sm calbtn', 'onclick' => 'total_calculate()')); ?>
    <div class="col-sm-12 spacer expadng">
        <table class="ctable" width="100%" cellpadding="0" cellspacing="0" border="0">
            <tr>
                <td colspan="4" align="center"><strong>Lowest</strong></td>
            </tr>
            <tr>
                <td class="rgtaln">Unit Total cost / sq ft</td>
                <td align="right"><span class="unit_cost"><?php echo $this->data['ProjectUnit']['unit_cost_currency'] . ' ' . $this->data['ProjectUnit']['unit_floor_rise_or_plc']; ?></span></td>
                <td class="rgtaln">Basic Cost</td>
                <td class="rgtaln"><span class="basic_cost"><?php echo $this->data['ProjectUnit']['unit_cost_currency'] . ' ' . $this->data['ProjectUnit']['basic_cost']; ?></span></td>
            </tr>
            <tr>
                <td class="rgtaln">Total Lump Sum Cost</td>
                <td align="right"><span class="tot_lump_cost"><?php echo $this->data['ProjectUnit']['unit_cost_currency'] . ' ' . $this->data['ProjectUnit']['total_lump_cost']; ?></span></td>
                <td class="rgtaln">Average Agreement Value</td>
                <td class="rgtaln"><span class="agreement_cost"><?php echo $this->data['ProjectUnit']['unit_cost_currency'] . ' ' . $this->data['ProjectUnit']['agreement_cost']; ?></span></td>
            </tr>
            <tr>
                <td class="rgtaln">Average Post-Tax Total Cost</td>
                <td align="right"><span class="post_tax_total"><?php echo $this->data['ProjectUnit']['unit_cost_currency'] . ' ' . $this->data['ProjectUnit']['post_tax_total']; ?></span></td>
                <td class="rgtaln">All Inclusive Cost</td>
                <td class="rgtaln"><span class="payable_cost"><?php echo $this->data['ProjectUnit']['unit_cost_currency'] . ' ' . $this->data['ProjectUnit']['payable_cost']; ?></span></td>
            </tr>
            <tr>
                <td class="rgtaln">Booking Amount</td>
                <td><?php echo $this->Form->input('booking_amount', array('class' => 'form-control rgt', 'readonly' => true)); ?></td>
                <td class="rgtaln">Downpayment</td>
                <td><?php echo $this->Form->input('unit_total_downpayment_required', array('class' => 'form-control rgt', 'readonly' => true)); ?></td>

            </tr>
            <tr>
                <td class="rgtaln">Second Payment :</td>
                <td><?php echo $this->Form->input('unit_total_second_payment_required', array('class' => 'form-control rgt', 'readonly' => true)); ?></td>
                <td class="rgtaln">Third Payment</td>
                <td><?php echo $this->Form->input('unit_total_third_payment_required', array('class' => 'form-control rgt', 'readonly' => true)); ?></td>

            </tr>


        </table>
        <table class="ctable" width="100%" cellpadding="0" cellspacing="0" border="0">
            <tr>
                <td colspan="4" align="center"><strong>Highest</strong></td>
            </tr>
            <tr>
                <td class="rgtaln">Unit Total cost / sq ft</td>
                <td align="right"><span class="unit_cost"><?php echo $this->data['ProjectUnit']['unit_cost_currency'] . ' ' . $this->data['ProjectUnit']['unit_floor_rise_or_plc']; ?></span></td>
                <td class="rgtaln">Basic Cost</td>
                <td class="rgtaln"><span class="basic_cost_hig"><?php echo $this->data['ProjectUnit']['unit_cost_currency'] . ' ' . $this->data['ProjectUnit']['high_basic_cost']; ?></span></td>
            </tr>
            <tr>
                <td class="rgtaln">Total Lump Sum Cost</td>
                <td align="right"><span class="tot_lump_cost"><?php echo $this->data['ProjectUnit']['unit_cost_currency'] . ' ' . $this->data['ProjectUnit']['total_lump_cost']; ?></span></td>
                <td class="rgtaln">Average Agreement Value</td>
                <td class="rgtaln"><span class="agreement_high_cost"><?php echo $this->data['ProjectUnit']['unit_cost_currency'] . ' ' . $this->data['ProjectUnit']['high_agreement_cost']; ?></span></td>
            </tr>
            <tr>
                <td class="rgtaln">Average Post-Tax Total Cost</td>
                <td align="right"><span class="high_post_tax_total"><?php echo $this->data['ProjectUnit']['unit_cost_currency'] . ' ' . $this->data['ProjectUnit']['high_post_tax_total']; ?></span></td>
                <td class="rgtaln">All Inclusive Cost</td>
                <td class="rgtaln"><span class="high_payable_cost"><?php echo $this->data['ProjectUnit']['unit_cost_currency'] . ' ' . $this->data['ProjectUnit']['high_payable_cost']; ?></span></td>
            </tr>
            <tr>
                <td class="rgtaln">Booking Amount</td>
                <td><?php echo $this->Form->input('booking_amount_high', array('class' => 'form-control rgt', 'readonly' => true)); ?></td>
                <td class="rgtaln">Downpayment</td>
                <td><?php echo $this->Form->input('unit_total_downpayment_required_high', array('class' => 'form-control rgt', 'readonly' => true)); ?></td>

            </tr>
            <tr>
                <td class="rgtaln">Second Payment :</td>
                <td><?php echo $this->Form->input('unit_total_second_payment_required_high', array('class' => 'form-control rgt', 'readonly' => true)); ?></td>
                <td class="rgtaln">Third Payment</td>
                <td><?php echo $this->Form->input('unit_total_third_payment_required_high', array('class' => 'form-control rgt', 'readonly' => true)); ?></td>

            </tr>
        </table>


    </div>
    <div class="row">
        <div class="col-sm-12">
            <?php echo $this->Form->submit('Update', array('class' => 'success btn', 'div' => false, 'id' => 'udate_unit')); ?>
            <?php echo $this->Form->button('Reset', array('type' => 'reset', 'class' => 'reset btn')); ?>

        </div>
    </div>


    <?php echo $this->Form->end();
    ?>
</div>	
<script>
    $('#generate_qualifier').click(function() {
        var qualifier2 = $('#ProjectUnitUnitTypeQualifier2').val();
        var qualifier1 = $('#ProjectUnitUnitTypeQualifier1').val();
        var qualifier3 = $('#ProjectUnitUnitTypeQualifier3').val();
        var qualifier4 = $('#ProjectUnitUnitTypeQualifier4').val();
        var qualifier5 = $('#ProjectUnitUnitTypeQualifier5').val();

        var text = '';
        if (qualifier1 != '')
            text += $('#ProjectUnitUnitTypeQualifier1 option:selected').text();
        if (qualifier2 != '')
            text += ' ' + $('#ProjectUnitUnitTypeQualifier2 option:selected').text();
        if (qualifier3 != '')
            text += ' ' + $('#ProjectUnitUnitTypeQualifier3 option:selected').text();
        if (qualifier4 != '')
            text += ' ' + $('#ProjectUnitUnitTypeQualifier4 option:selected').text();
        if (qualifier5 != '')
            text += ' ' + $('#ProjectUnitUnitTypeQualifier5 option:selected').text();

        $('#input_quilifier_text').text(text);
        $('#ProjectUnitUnitName').val(text);
    });


    $('#ProjectUnitUnitSellableAreaLowestSize').blur(function() {
        $('#ProjectUnitUnitSellableAreaHighestSize').val($(this).val());
    });
    $('#ProjectUnitUnitsCarpetAreaLowestSize').blur(function() {
        $('#ProjectUnitUnitCarpetAreaHighestSize').val($(this).val());
    });

    $('#ProjectUnitUnitIniitialBookingAmount').change(function() {
        $('#ProjectUnitBookingAmount').val($(this).val());
        $('#ProjectUnitBookingAmountHigh').val($(this).val());
    });

    function total_calculate() {

        //Unit cost
        var UnitBasciCost = parseFloat($('#ProjectUnitUnitTotalBasicCost').val());
        var plcCost = parseFloat($('#ProjectUnitUnitPlcChargesSqFt').val());
        var otherCost = parseFloat($('#ProjectUnitUnitOtherCostPerSqFt').val());
        var FloorRise = parseFloat($('#ProjectUnitUnitFloorChargesSqFt').val());
        var FloorRiseFrom = parseFloat($('#ProjectUnitUnitFloorRiseOrPlcFrom').val());
        var FloorNumber = parseFloat($('#ProjectUnitUnitFloorNumber').val());
        var currency = $('#ProjectUnitUnitCostCurrency').val();
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
        $('#ProjectUnitUnitFloorRiseOrPlc').val(calculate);

        //Basic Cost

        var sellableLow = parseInt($('#ProjectUnitUnitSellableAreaLowestSize').val());
        var sellableHig = parseInt($('#ProjectUnitUnitSellableAreaHighestSize').val());
        var carpetLow = parseInt($('#ProjectUnitUnitsCarpetAreaLowestSize').val());
        var carpetHig = parseInt($('#ProjectUnitUnitCarpetAreaHighestSize').val());
        var OnSellableCarpet = $('#ProjectUnitUnitPriceOnSellableOrCarpet').val();
        var calculate = 0;
        var UnitTotalCost = parseFloat($('#ProjectUnitUnitFloorRiseOrPlc').val());

        if (OnSellableCarpet == 'Sellable') {
            var calculateLow = parseFloat(UnitTotalCost * sellableLow);
            var calculateHig = parseFloat(UnitTotalCost * sellableHig);
        }
        if (OnSellableCarpet == 'Carpet') {
            var calculateLow = parseFloat(UnitTotalCost * carpetLow);
            var calculateHig = parseFloat(UnitTotalCost * carpetHig);
        }

        $('.basic_cost').text(currency + ' ' + calculateLow);
        $('.basic_cost_hig').text(currency + ' ' + calculateHig);
        $('#ProjectUnitBasicCost').val(calculateLow);
        $('#ProjectUnitHighBasicCost').val(calculateHig);


        //var AmenitiesCost = 0;
        var CarParkingCost = parseInt($('#ProjectUnitUnitCarParkingCost').val());
        var InfrastructureCost = parseInt($('#ProjectUnitUnitInfraPreAgreementCost').val());
        var OtherCost = parseInt($('#ProjectUnitUnitOtherPreAgreementCost').val());
        var BasciCost = parseFloat($('#ProjectUnitBasicCost').val());
        var HighBasciCost = parseFloat($('#ProjectUnitHighBasicCost').val());
        var calculate = 0;
        var AmenitiesCost = parseInt($('#ProjectUnitUnitAmenitiesCost').val());
        if (AmenitiesCost > 0)
            calculate = calculate + AmenitiesCost;

        if (CarParkingCost)
            calculate = calculate + CarParkingCost;

        if (InfrastructureCost)
            calculate = calculate + InfrastructureCost;

        if (OtherCost)
            calculate = calculate + OtherCost;

        $('.tot_lump_cost').text(currency + ' ' + calculate);
        $('#ProjectUnitTotalLumpCost').val(calculate);
        var agreement_cost = parseFloat(BasciCost + calculate);
        var agreement_high_cost = parseFloat(HighBasciCost + calculate);
        $('.agreement_high_cost').text(currency + ' ' + agreement_high_cost);
        $('.agreement_cost').text(currency + ' ' + agreement_cost);
        $('#ProjectUnitAgreementCost').val(agreement_cost);
        $('#ProjectUnitHighAgreementCost').val(agreement_high_cost);

        var AgreementCost = parseInt($('#ProjectUnitAgreementCost').val());
        var HighAgreementCost = parseInt($('#ProjectUnitHighAgreementCost').val());
        var StampDuty = parseFloat($('#ProjectUnitUnitStampDuty').val() / 100);
        var vat = parseFloat($('#ProjectUnitUnitVat').val() / 100);
        var seviceTax = parseFloat($('#ProjectUnitUnitServiceTax').val() / 100);
        var registration = parseInt($('#ProjectUnitUnitRegistrationCost').val());
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
        var high_post_taxt_total = parseInt((HighAgreementCost * calculate) + registration + HighAgreementCost);
        //var result = post_taxt_total.toFixed(2); // returns 12.43
        $('.post_tax_total').text(currency + ' ' + post_taxt_total);
        $('.high_post_tax_total').text(currency + ' ' + high_post_taxt_total);
        $('#ProjectUnitPostTaxTotal').val(post_taxt_total);
        $('#ProjectUnitHighPostTaxTotal').val(high_post_taxt_total);

        var post_tax_total = parseInt($('#ProjectUnitPostTaxTotal').val());
        var high_post_tax_total = parseInt($('#ProjectUnitHighPostTaxTotal').val());
        var SocietiesCost = parseInt($('#ProjectUnitUnitSocietiesCost').val());
        var LegalCost = parseInt($('#ProjectUnitUnitLegalCost').val());
        var InfraCost = parseInt($('#ProjectUnitUnitOtherInfraCharges').val());
        var OtherCost = parseInt($('#ProjectUnitUnitOtherCharges').val());


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
        var high_payable_cost = parseFloat(high_post_tax_total + calculate);
        $('.payable_cost').text(currency + ' ' + payable_cost);
        $('.high_payable_cost').text(currency + ' ' + high_payable_cost);
        $('#ProjectUnitPayableCost').val(payable_cost);
        $('#ProjectUnitHighPayableCost').val(high_payable_cost);
        ///
        var attachTo = $('#ProjectUnitUnitDownpaymentAttachedToConstruction').val();
        var CostValue = 0;
        var calculate = 0;
        var PercentLumpsum = parseFloat($('#ProjectUnitUnitDownpaymentOnPercentOrLumpsum').val() / 100);
        if (attachTo == '1') //Basic Cost
        {
            CostValue = parseInt($('#ProjectUnitBasicCost').val());
            HighCostValue = parseInt($('#ProjectUnitHighBasicCost').val());
            $('#ProjectUnitUnitTotalDownpaymentRequired').attr('readonly', true);
            $('#ProjectUnitUnitTotalDownpaymentRequiredHigh').attr('readonly', true);
            calculate = parseInt(CostValue * PercentLumpsum);
            calculate_high = parseInt(HighCostValue * PercentLumpsum);
            $('#ProjectUnitUnitTotalDownpaymentRequired').val(calculate);
            $('#ProjectUnitUnitTotalDownpaymentRequiredHigh').val(calculate_high);
        }
        else if (attachTo == '2')// agreemnet cost
        {
            CostValue = parseInt($('#ProjectUnitAgreementCost').val());
            HighCostValue = parseInt($('#ProjectUnitHighBasicCost').val());
            $('#ProjectUnitUnitTotalDownpaymentRequired').attr('readonly', true);
            $('#ProjectUnitUnitTotalDownpaymentRequiredHigh').attr('readonly', true);
            calculate = parseInt(CostValue * PercentLumpsum);
            calculate1 = parseInt(HighCostValue * PercentLumpsum);
            $('#ProjectUnitUnitTotalDownpaymentRequired').val(calculate);
            $('#ProjectUnitUnitTotalDownpaymentRequiredHigh').val(calculate1);
        }
        else // other
        {
            $('#ProjectUnitUnitTotalDownpaymentRequired').attr('readonly', false);
            $('#ProjectUnitUnitTotalDownpaymentRequired').val(0);
            $('#ProjectUnitUnitTotalDownpaymentRequiredHigh').attr('readonly', false);
            $('#ProjectUnitUnitTotalDownpaymentRequiredHigh').val(0);
        }

        /// Second payment
        var attachTo = $('#ProjectUnitUnitSecondPaymentAttachedToConstruction').val();
        var CostValue = 0;
        var calculate = 0;
        var PercentLumpsum = parseFloat($('#ProjectUnitUnitSecondPaymentOnPercentOrLumpsum').val() / 100);
        if (attachTo == '1') //Basic Cost
        {
            CostValue = parseInt($('#ProjectUnitBasicCost').val());
            HighCostValue = parseInt($('#ProjectUnitHighBasicCost').val());
            $('#ProjectUnitUnitTotalSecondPaymentRequired').attr('readonly', true);
            $('#ProjectUnitUnitTotalSecondPaymentRequiredHigh').attr('readonly', true);
            calculate = parseInt(CostValue * PercentLumpsum);
            calculate_high = parseInt(HighCostValue * PercentLumpsum);
            $('#ProjectUnitUnitTotalSecondPaymentRequired').val(calculate);
            $('#ProjectUnitUnitTotalSecondPaymentRequiredHigh').val(calculate_high);
        }
        else if (attachTo == '2')// agreemnet cost
        {
            CostValue = parseInt($('#ProjectUnitAgreementCost').val());
            HighCostValue = parseInt($('#ProjectUnitHighBasicCost').val());
            $('#ProjectUnitUnitTotalSecondPaymentRequired').attr('readonly', true);
            $('#ProjectUnitUnitTotalSecondPaymentRequiredHigh').attr('readonly', true);
            calculate = parseInt(CostValue * PercentLumpsum);
            calculate_high = parseInt(HighCostValue * PercentLumpsum);
            $('#ProjectUnitUnitTotalSecondPaymentRequired').val(calculate);
            $('#ProjectUnitUnitTotalSecondPaymentRequiredHigh').val(calculate_high);
        }
        else // other
        {
            $('#ProjectUnitUnitTotalSecondPaymentRequired').attr('readonly', false);
            $('#ProjectUnitUnitTotalSecondPaymentRequiredHigh').attr('readonly', false);
            $('#ProjectUnitUnitTotalSecondPaymentRequired').val(0);
            $('#ProjectUnitUnitTotalSecondPaymentRequiredHigh').val(0);
        }
        /* Third payment*/
        var attachTo = $('#ProjectUnitUnitThirdPaymentAttachedToConstruction').val();
        var CostValue = 0;
        var calculate = 0;
        var PercentLumpsum = parseFloat($('#ProjectUnitUnitThirdPaymentOnPercentOrLumpsum').val() / 100);
        if (attachTo == '1') //Basic Cost
        {
            CostValue = parseInt($('#ProjectUnitBasicCost').val());
            HighCostValue = parseInt($('#ProjectUnitHighBasicCost').val());
            $('#ProjectUnitUnitTotalThirdPaymentRequired').attr('readonly', true);
            $('#ProjectUnitUnitTotalThirdPaymentRequiredHigh').attr('readonly', true);
            calculate = parseInt(CostValue * PercentLumpsum);
            calculate_high = parseInt(HighCostValue * PercentLumpsum);
            $('#ProjectUnitUnitTotalThirdPaymentRequired').val(calculate);
            $('#ProjectUnitUnitTotalThirdPaymentRequiredHigh').val(calculate_high);
        }
        else if (attachTo == '2')// agreemnet cost
        {
            CostValue = parseInt($('#ProjectUnitAgreementCost').val());
            HighCostValue = parseInt($('#ProjectUnitHighBasicCost').val());
            $('#ProjectUnitUnitTotalThirdPaymentRequired').attr('readonly', true);
            $('#ProjectUnitUnitTotalThirdPaymentRequiredHigh').attr('readonly', true);
            calculate = parseInt(CostValue * PercentLumpsum);
            calculate_high = parseInt(HighCostValue * PercentLumpsum);
            $('#ProjectUnitUnitTotalThirdPaymentRequired').val(calculate);
            $('#ProjectUnitUnitTotalThirdPaymentRequiredHigh').val(calculate_high);
        }
        else // other
        {
            $('#ProjectUnitUnitTotalThirdPaymentRequired').attr('readonly', false);
            $('#ProjectUnitUnitTotalThirdPaymentRequiredHigh').attr('readonly', false);
            $('#ProjectUnitUnitTotalThirdPaymentRequired').val(0);
            $('#ProjectUnitUnitTotalThirdPaymentRequiredHigh').val(0);
        }
        ////
        var attachTo = $('#ProjectUnitUnitCommissionBasedOn').val();
        if (attachTo == '1') //Basic Cost
        {
            CostValue = parseInt($('#ProjectUnitBasicCost').val());
            $('#ProjectUnitUnitCommissionAppliedTo').attr('readonly', true);
            $('#ProjectUnitUnitCommissionAppliedTo').val(CostValue);
        }
        else if (attachTo == '2')// agreemnet cost
        {
            CostValue = parseInt($('#ProjectUnitAgreementCost').val());
            $('#ProjectUnitUnitCommissionAppliedTo').attr('readonly', true);
            $('#ProjectUnitUnitCommissionAppliedTo').val(CostValue);
        }
        else // other
        {
            $('#ProjectUnitUnitCommissionAppliedTo').attr('readonly', false);
            $('#ProjectUnitUnitCommissionAppliedTo').val(0);
        }
        //////




    }

    $('#ProjectUnitUnitCommissionBasedOn').change(function() {
        var attachTo = $(this).val();
        if (attachTo == '3') //Basic Cost
        {
            $('#ProjectUnitUnitCommissionAppliedTo').attr('readonly', false);
        }

    });

    $('.taxes_duty').change(function(event) {
        //alert('asd');
        this.value = parseFloat(this.value).toFixed(2);
        //  this.value = this.value.replace (/(\.\d\d)\d+|([\d.]*)[^\d.]/, '$1$2');
    })


</script>		
<!----------------------------end add project block------------------------------>
