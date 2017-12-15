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
//pr($this->data);
?>


<!----------------------------start add project block------------------------------>
<div class="pop-outer">
    <div class="pop-up-hdng">View Unit</div>


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
// pr($lead);
    ?>
    <div class="row">
        <div class="col-sm-12 spacer">
            <div class="col-sm-4">     
                <div class="form-group">
                    <h4>Unit Details</h4>
                    <label for="reg_input_name" style="width: 37%">Project Name</label>
                    <span class="colon">:</span>
                    <div class="col-sm-6">
                        <?php echo $this->data['Project']['project_name']; ?>
                    </div>


                </div>
            </div>
            <div class="col-sm-4">     
                <h4>&nbsp;</h4>
                <div class="form-group">
                    
                    <label for="reg_input_name">Tower</label>
                    <span class="colon">:</span>
                    <div class="col-sm-6">
                        <?php echo $this->data['ProjectUnit']['unit_tower_phase']; ?>
                    </div>


                </div>
            </div>
            <div class="col-sm-4">     
                <h4>&nbsp;</h4>
                <div class="form-group">
                    
                    <label for="reg_input_name">Unit Type</label>
                    <span class="colon">:</span>
                    <div class="col-sm-6">
                        <?php
                        echo $this->data['UnitType']['value'];
                        ?>
                    </div>


                </div>
            </div>
        </div> 
        <div class="col-sm-12 spacer fullrow">
            <div class="form-group">
                <label>Unit Description</label>
                <span class="colon">:</span>
                <div class="col-sm-10 editable txtbox">
                    <?php echo $this->data['ProjectUnit']['unit_description']; ?>
                </div>
            </div>
            <div class="form-group">
                <label>Unit Remarks</label>
                <span class="colon">:</span>
                <div class="col-sm-10 editable txtbox">
                    <?php echo $this->data['ProjectUnit']['unit_other_remarks']; ?>
                </div>
            </div>
        </div>
        <div class="col-sm-12 spacer">

            <h4><span style="color:#771D5A"><div id="input_quilifier_text"><?php echo $this->data['ProjectUnit']['unit_name']; ?></div></span></h4>
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
                                <div class="col-sm-10"><?php echo $this->data['ProjectUnit']['unit_total_units_in_project']; ?></div>
                            </div>
                            <div class="form-group">
                                <label>Sellable (Lowest)</label>
                                <span class="colon">:</span>
                                <div class="col-sm-10"><?php echo $this->data['ProjectUnit']['unit_sellable_area_lowest_size']; ?></div>
                            </div>
                            <div class="form-group">
                                <label>Carpet (Lowest)</label>
                                <span class="colon">:</span>
                                <div class="col-sm-10"><?php echo $this->data['ProjectUnit']['units_carpet_area_lowest_size']; ?></div>
                            </div>
                            <div class="form-group">
                                <label>Avg Loading %  </label>
                                <span class="colon">:</span>
                                <div class="col-sm-10"><div class="input-group"><?php echo $this->data['ProjectUnit']['unit_loading_factor'].'%'; ?></div></div>
                            </div>







                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Available </label>
                                <span class="colon">:</span>
                                <div class="col-sm-10"><?php echo $this->data['ProjectUnit']['unit_total_units_currently_available']; ?></div>
                            </div>
                            <div class="form-group">
                                <label>Sellable (Highest)</label>
                                <span class="colon">:</span>
                                <div class="col-sm-10"><?php echo $this->data['ProjectUnit']['unit_sellable_area_highest_size'];?></div>
                            </div>
                            <div class="form-group">
                                <label>Carpet (Highest)</label>
                                <span class="colon">:</span>
                                <div class="col-sm-10"><?php echo $this->data['ProjectUnit']['unit_carpet_area_highest_size'];?></div>
                            </div>
                            <div class="form-group">
                                <label>Unit Active</label>
                                <span class="colon">:</span>
                                <div class="col-sm-10"><?php if($this->data['ProjectUnit']['unit_total_units_currently_available'] == '1')echo 'Yes';else 'No'; ?></div>
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
                        <div class="col-sm-10"><?php echo $this->data['ProjectUnit']['unit_floor_number'];?></div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label>Cost Currency </label>
                        <span class="colon">:</span>
                        <div class="col-sm-10"><?php echo $this->data['ProjectUnit']['unit_cost_currency'];?></div>
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
                                <div class="col-sm-10"><?php echo $this->data['ProjectUnit']['unit_total_basic_cost'];?></div>
                            </div> 
                            <div class="form-group">
                                <label>Floor Rise / Sq Ft </label>
                                <span class="colon">:</span>
                                <div class="col-sm-10"><?php echo $this->data['ProjectUnit']['unit_floor_charges_sq_ft'];?></div>
                            </div>   
                            <div class="form-group">
                                <label>PLC / Sq Ft</label>
                                <span class="colon">:</span>
                                <div class="col-sm-10"><?php echo $this->data['ProjectUnit']['unit_plc_charges_sq_ft']; ?></div>
                            </div> 






                        </div>
                        <div class="col-sm-6">

                            <div class="form-group">
                                <label>Other / Sq Ft</label>
                                <span class="colon">:</span>
                                <div class="col-sm-10"><?php echo $this->data['ProjectUnit']['unit_other_cost_per_sq_ft']; ?></div>
                            </div>
                            <div class="form-group">
                                <label>Floor Rise From</label>
                                <span class="colon">:</span>
                                <div class="col-sm-10"><?php echo $this->data['ProjectUnit']['unit_floor_rise_or_plc_from']; ?></div>
                            </div>

                            <div class="form-group">
                                <label>Sale Pattern</label>
                                <span class="colon">:</span>
                                <div class="col-sm-10"><?php echo $this->data['ProjectUnit']['unit_price_on_sellable_or_carpet']; ?></div>
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
                                <div class="col-sm-10"><?php echo $this->data['ProjectUnit']['unit_amenities_cost'];  ?></div>
                            </div>
                            <div class="form-group">
                                <label>Infrastructure Cost</label>
                                <span class="colon">:</span>
                                <div class="col-sm-10"><?php echo $this->data['ProjectUnit']['unit_infra_pre_agreement_cost']; ?></div>
                            </div>    
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Car Parking Cost </label>
                                <span class="colon">:</span>
                                <div class="col-sm-10"><?php echo $this->data['ProjectUnit']['unit_car_parking_cost'];?></div>
                            </div>
                            <div class="form-group">
                                <label>Other Cost</label>
                                <span class="colon">:</span>
                                <div class="col-sm-10"><?php echo $this->data['ProjectUnit']['unit_other_pre_agreement_cost']; ?></div>
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
                                <div class="col-sm-10"><div class="input-group"><?php echo $this->data['ProjectUnit']['unit_stamp_duty'].' %';?></div></div>
                            </div>
                            <div class="form-group">
                                <label>Service Tax % </label>
                                <span class="colon">:</span>
                                <div class="col-sm-10"><div class="input-group"><?php echo $this->data['ProjectUnit']['unit_service_tax'].' %'; ?></div></div>
                            </div>    
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>VAT % </label>
                                <span class="colon">:</span>
                                <div class="col-sm-10"><div class="input-group"><?php echo $this->data['ProjectUnit']['unit_vat'].' %'; ?></div></div>
                            </div>
                            <div class="form-group">
                                <label>Registration</label>
                                <span class="colon">:</span>
                                <div class="col-sm-10"><?php echo $this->data['ProjectUnit']['unit_registration_cost'];?></div>
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
                                <div class="col-sm-10"><?php echo $this->data['ProjectUnit']['unit_societies_cost'];?></div>
                            </div>
                            <div class="form-group">
                                <label>Infra Charges </label>
                                <span class="colon">:</span>
                                <div class="col-sm-10"><?php echo $this->data['ProjectUnit']['unit_other_infra_charges'];?></div>
                            </div>    
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Legal Charges</label>
                                <span class="colon">:</span>
                                <div class="col-sm-10"><?php echo $this->data['ProjectUnit']['unit_legal_cost'];?></div>
                            </div>
                            <div class="form-group">
                                <label>Other Charges</label>
                                <span class="colon">:</span>
                                <div class="col-sm-10"><?php echo $this->data['ProjectUnit']['unit_other_charges'];?></div>
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
                                <div class="col-sm-10"><?php echo $this->data['ProjectUnit']['unit_iniitial_booking_amount'];?></div>
                            </div>




                        </div>
                        <div class="col-sm-6">
                            <div class="form-group int-sm">
                                <label>Due By</label>
                                <span class="colon">:</span>
                                <div class="col-sm-10">  <?php
                                    echo $this->data['ProjectUnit']['unit_initial_booking_payment_due'];
                                    echo $this->data['ProjectUnit']['unit_initial_option'];
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
                                <div class="col-sm-10"><div class="input-group"><?php echo $this->data['ProjectUnit']['unit_downpayment_on_percent_or_lumpsum'].' %';?></div></div>
                            </div>

                            <div class="form-group int-sm">
                                <label>Due By</label>
                                <span class="colon">:</span>
                                <div class="col-sm-10">  <?php
                                    echo $this->data['ProjectUnit']['unit_downpayment_amount_due_in'];
                                    echo $this->data['ProjectUnit']['unit_downpayment_option'];
                                    ?></div>
                            </div>


                            <h4>Second Payment</h4>

                            <div class="form-group percsym">
                                <label>Percent Lumpsum</label>
                                <span class="colon">:</span>
                                <div class="col-sm-10"><div class="input-group"><?php echo $this->data['ProjectUnit']['unit_second_payment_on_percent_or_lumpsum'].' %';?></div></div>
                            </div>
                            <div class="form-group int-sm">
                                <label>Due By</label>
                                <span class="colon">:</span>
                                <div class="col-sm-10">  <?php
                                    echo $this->data['ProjectUnit']['unit_second_payment_amount_due_in'];
                                    echo $this->data['ProjectUnit']['unit_second_option'];
                                    ?></div>
                            </div>

                            <h4>Third Payment</h4>   

                            <div class="form-group">
                                <label>Percent Lumpsum</label>
                                <span class="colon">:</span>
                                <div class="col-sm-10"><div class="input-group"><?php echo $this->data['ProjectUnit']['unit_third_payment_on_percent_or_lumpsum'].' %';?></div></div>
                            </div>
                            <div class="form-group int-sm">
                                <label>Due By</label>
                                <span class="colon">:</span>
                                <div class="col-sm-10">  <?php
                                    echo $this->data['ProjectUnit']['unit_third_party_amount_due_in'];
                                    echo $this->data['ProjectUnit']['unit_third_party_option'];
                                    ?></div>
                            </div>


                        </div>
                        <div class="col-sm-6">

                            <h4>&nbsp;</h4>
                            <div class="form-group">
                                <label>Attached to</label>
                                <span class="colon">:</span>
                                <div class="col-sm-10"><?php echo $this->data['FirstAttach']['value'];?></div>
                            </div>
                            <h4>&nbsp;</h4>
                            <h4>&nbsp;</h4>
                            <div class="form-group">
                                <label>Attached to </label>
                                <span class="colon">:</span>
                                <div class="col-sm-10"><?php echo $this->data['SecondAttach']['value'];?></div>
                            </div>

                            <h4>&nbsp;</h4> 
                            <h4>&nbsp;</h4>

                            <div class="form-group">
                                <label>Attached to</label>
                                <span class="colon">:</span>
                                <div class="col-sm-10"><?php echo $this->data['ThirdAttach']['value'];?></div>
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
                                <div class="col-sm-10"><div class="input-group"><?php echo $this->data['ProjectUnit']['unit_commission_percent'].' %';?></div></div>
                            </div>
                            <div class="form-group">
                                <label>Based on</label>
                                <span class="colon">:</span>
                                <div class="col-sm-10"><?php echo $this->data['CommissionBasedOn']['value']; ?></div>
                            </div>

                        </div>
                        <div class="col-sm-6">

                            <div class="form-group">
                                <label>Commission Event</label>
                                <span class="colon">:</span>
                                <div class="col-sm-10"><?php echo $this->data['CommissionEvent']['value']; ?></div>
                            </div>
                            <div class="form-group">
                                <label>Applied To</label>
                                <span class="colon">:</span>
                                <div class="col-sm-10"><?php echo $this->data['ProjectUnit']['unit_commission_applied_to']; ?></div>
                            </div>
                        </div> 
                    </div>
                </div>
            </div>
        </div>
    </div>

   
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
                <td><?php echo $this->data['ProjectUnit']['booking_amount'];?></td>
                <td class="rgtaln">Downpayment</td>
                <td><?php echo $this->data['ProjectUnit']['unit_total_downpayment_required'];?></td>

            </tr>
            <tr>
                <td class="rgtaln">Second Payment :</td>
                <td><?php echo $this->data['ProjectUnit']['unit_total_second_payment_required'];?></td>
                <td class="rgtaln">Third Payment</td>
                <td><?php echo $this->data['ProjectUnit']['unit_total_third_payment_required'];?></td>

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
                <td><?php echo $this->data['ProjectUnit']['booking_amount_high'];?></td>
                <td class="rgtaln">Downpayment</td>
                <td><?php echo $this->data['ProjectUnit']['unit_total_downpayment_required_high'];?></td>

            </tr>
            <tr>
                <td class="rgtaln">Second Payment :</td>
                <td><?php echo $this->data['ProjectUnit']['unit_total_second_payment_required_high'];?></td>
                <td class="rgtaln">Third Payment</td>
                <td><?php echo $this->data['ProjectUnit']['unit_total_third_payment_required_high'];?></td>

            </tr>
        </table>


    </div>

    <?php echo $this->Form->end();
    ?>
</div>	

<!----------------------------end add project block------------------------------>
