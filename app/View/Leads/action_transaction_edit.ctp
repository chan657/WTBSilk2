<?php
echo $this->Html->css(array('/bootstrap/css/bootstrap.min', 'popup', 'font-awesome/css/font-awesome.min'));
echo $this->Html->script(array('jquery.min', 'lib/chained/jquery.chained.remote.min', 'lib/jquery.inputmask/jquery.inputmask.bundle.min', 'lib/parsley/parsley.min', 'pages/ebro_form_validate', 'lib/datepicker/js/bootstrap-datepicker', 'lib/timepicker/js/bootstrap-timepicker.min', 'pages/ebro_form_extended'));
?>
<?php
echo $this->Form->create('Deal', array('method' => 'post', 'id' => 'parsley_reg', 'novalidate' => true,
    'inputDefaults' => array(
        'label' => false,
        'div' => false,
        'class' => 'form-control',
    ),
    array('controller' => 'leads', 'action' => 'action_transaction_edit'),
));
?>



<div class="pop-outer">
    <div class="pop-up-hdng">Edit Transaction </div>


    <div class="row">
        <div class="col-sm-12">
            <div class="col-sm-6">
                <div class="form-group">
                    <label for="reg_input_name" class="req">Transaction Type</label>
                    <span class="colon">:</span>
                    <div class="col-sm-10">
                        <?php
                        echo $this->Form->input('deal_type', array('options' => $LookupValueLeadTransactionType, 'empty' => '--Select--', 'disabled' => array('2', '3', '4', '5', '6')));
                        ?></div>
                </div>
                <div class="form-group">
                    <label for="reg_input_name" class="req">Choose Project</label>
                    <span class="colon">:</span>
                    <div class="col-sm-10">
                        <?php
                        echo $this->Form->input('deal_project_id', array('options' => $projects, 'empty' => '--Select--'));
                        ?></div>
                </div>
                
                    <div class="form-group builder" <?php if ($this->data['Deal']['deal_billing_type'] == '1') { ?>style="display: block" <?php }else{?> style="display: none" <?php }?>>
                        <label for="reg_input_name" class="req" >Choose Builder</label>
                        <span class="colon">:</span>
                        <div class="col-sm-10">
                            <?php
                            echo $this->Form->input('deal_builder_id', array('options' => $builders, 'empty' => '--Select--'));
                            ?></div>
                    </div>
               
                    <div class="form-group partner" <?php if ($this->data['Deal']['deal_billing_type'] == '2') { ?>style="display: block" <?php }else{?> style="display: none" <?php }?>>
                        <label for="reg_input_name" class="req" >Choose Partner</label>
                        <span class="colon">:</span>
                        <div class="col-sm-10">
                            <?php
                            echo $this->Form->input('deal_marketing_partner_id', array('options' => $partners, 'empty' => '--Select--'));
                            ?></div>
                    </div>
               
                <div class="form-group">
                    <label for="reg_input_name" class="req">Choose Client</label>
                    <span class="colon">:</span>
                    <div class="col-sm-10">
                        <?php
                        echo $this->Form->input('deal_client_id', array('options' => $lead_lt, 'empty' => '--Select--'));
                        ?></div>
                </div>
                <div class="form-group">
                    <label>Unit Number</label>
                    <span class="colon">:</span>
                    <div class="col-sm-10"><?php echo $this->Form->input('deal_unit_number', array('class' => 'form-control rgt', 'tabindex' => '19', 'type' => 'text')); ?></div>
                </div>
                <div class="form-group">
                    <label>Cluster Number</label>
                    <span class="colon">:</span>
                    <div class="col-sm-10"><?php echo $this->Form->input('deal_unit_cluster', array('class' => 'form-control rgt', 'tabindex' => '19', 'type' => 'text')); ?></div>
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
                            echo $this->Form->input('deal_booking_date', array('id' => 'dpd1', 'type' => 'text', 'data-date-format' => 'dd-mm-yyyy', 'data-date-autoclose' => 'true', 'value' => $deal_booking_date));
                            ?>
                            <span class="input-group-addon"><i class="icon-calendar"></i></span>
                        </div>


                    </div>
                </div>
                <div class="form-group percsym">
                    <label>Commission % </label>
                    <span class="colon">:</span>
                    <div class="col-sm-10"><div class="input-group"><?php echo $this->Form->input('deal_commission_percent', array('class' => 'form-control rgt taxes_duty', 'tabindex' => '33')); ?><span class="input-group-addon">%</span></div></div>
                </div> 
                <div class="form-group" >
                    <label for="reg_input_name" class="req">Appr. Reg.  Date</label>
                    <span class="colon">:</span>
                    <div class="col-sm-10">
                        <div class="input-group date ebro_datepicker event_date_present_div" data-date-format="dd-mm-yyyy" data-date-autoclose="true">
                            <?php
                            $deal_expected_invoice_date = '';
                            if ($this->data['Deal']['deal_expected_invoice_date'])
                                $deal_expected_invoice_date = date('d-m-Y', strtotime($this->data['Deal']['deal_expected_invoice_date']));
                            echo $this->Form->input('deal_expected_invoice_date', array('id' => 'dpd1', 'type' => 'text', 'data-date-format' => 'dd-mm-yyyy', 'data-date-autoclose' => 'true', 'value' => $deal_expected_invoice_date));
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
                        echo $this->Form->input('deal_billing_type', array('options' => $billing_types, 'empty' => '--Select--', 'disabled' => array('3', '4', '5', '6', '7')));
                        ?></div>
                </div>
                <div class="form-group">
                    <label for="reg_input_name" class="req">Legal Name</label>
                    <span class="colon">:</span>
                    <div class="col-sm-10">
                        <?php
                        echo $this->Form->input('deal_project_legal_name_id', array('options' => $ProjectLegalNameList, 'empty' => '--Select'));
                        ?></div>
                </div>
                <div class="form-group">
                    <label for="reg_input_name" class="req">Choose Unit</label>
                    <span class="colon">:</span>
                    <div class="col-sm-10">
                        <?php
                        echo $this->Form->input('deal_project_unit_id', array('options' => $project_unit_list, 'empty' => '--Select'));
                        ?></div>
                </div>
                <div class="form-group">
                    <label>Sale Pattern</label>
                    <span class="colon">:</span>
                    <div class="col-sm-10"><?php echo $this->Form->input('deal_sale_pattern', array('options' => array('Sellable' => 'Sellable', 'Carpet' => 'Carpet'), 'empty' => '--Select--', 'default' => 'Sellable', 'tabindex' => '26')); ?></div>
                </div>
                <div class="form-group">
                    <label>Tower Number</label>
                    <span class="colon">:</span>
                    <div class="col-sm-10"><?php echo $this->Form->input('deal_unit_tower_or_building', array('class' => 'form-control rgt', 'tabindex' => '19', 'type' => 'text')); ?></div>
                </div>
                <div class="form-group">
                    <label for="reg_input_name" class="req">Property Value</label>
                    <span class="colon">:</span>
                    <div class="col-sm-10">
                        <?php
                        echo $this->Form->input('deal_invoiced_on_amount');
                        ?>
                    </div>
                </div>
                <div class="form-group">
                    <label for="reg_input_name" class="req">Booking Amount</label>
                    <span class="colon">:</span>
                    <div class="col-sm-10">
                        <?php
                        echo $this->Form->input('deal_booking_amount');
                        ?>
                    </div>
                </div>
                <div class="form-group">
                    <label>Commission Event</label>
                    <span class="colon">:</span>
                    <div class="col-sm-10"><?php echo $this->Form->input('deal_invoice_event', array('options' => $commission_event, 'empty' => '--Select--', 'tabindex' => '55')); ?></div>
                </div>
                <div class="form-group" >
                    <label for="reg_input_name" class="req">Appr. Invoice  Date</label>
                    <span class="colon">:</span>
                    <div class="col-sm-10">
                        <div class="input-group date ebro_datepicker event_date_present_div" data-date-format="dd-mm-yyyy" data-date-autoclose="true">
                            <?php
                            $deal_actual_invoice_date = '';
                            if ($this->data['Deal']['deal_actual_invoice_date'])
                                $deal_actual_invoice_date = date('d-m-Y', strtotime($this->data['Deal']['deal_actual_invoice_date']));
                            echo $this->Form->input('deal_actual_invoice_date', array('id' => 'dpd1', 'type' => 'text', 'data-date-format' => 'dd-mm-yyyy', 'data-date-autoclose' => 'true', 'value' => $deal_actual_invoice_date));
                            ?>
                            <span class="input-group-addon"><i class="icon-calendar"></i></span>
                        </div>


                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12"><?php echo $this->Form->submit('Update', array('class' => 'btn btn-success sticky_success', 'div' => false, 'id' => 'udate_unit')); ?><?php
            echo $this->Form->button('Reset', array('type' => 'reset', 'class' => 'reset btn'));
            ?></div>
    </div>
</div>                              

<?php echo $this->Form->end(); ?>   

<script>
    $('#DealDealBillingType').change(function() {
        var val = $(this).val();
        if (val == '1') {
            $('.builder').css('display', 'block');
            $('.partner').css('display', 'none');
        }
        else if (val == '2') {
            $('.builder').css('display', 'none');
            $('.partner').css('display', 'block');
        }
    });
</script>