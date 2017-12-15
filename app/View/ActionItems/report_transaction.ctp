<?php
echo $this->Html->css(array('/bootstrap/css/bootstrap.min', 'popup',
    'todc-bootstrap.min',
    'font-awesome/css/font-awesome.min',
    '/js/lib/datepicker/css/datepicker',
    '/js/lib/timepicker/css/bootstrap-timepicker.min'
        )
);
echo $this->Html->script(array('jquery.min', 'lib/chained/jquery.chained.remote.min', 'lib/jquery.inputmask/jquery.inputmask.bundle.min', 'lib/parsley/parsley.min', 'pages/ebro_form_validate', 'lib/datepicker/js/bootstrap-datepicker', 'lib/timepicker/js/bootstrap-timepicker.min', 'pages/ebro_form_extended'));
//pr($this->data);
?>
<div class="pop-outer">
    <div class="pop-up-hdng">Report A Transaction</div>


    <?php
//echo $this->Form->create('Remark', array('enctype' => 'multipart/form-data'));
    echo $this->Form->create('ActionItem', array('method' => 'post', 'id' => 'parsley_reg', 'novalidate' => true,
        'inputDefaults' => array(
            'label' => false,
            'div' => false,
            'class' => 'form-control',
        ),
        array('controller' => 'action_items', 'action' => 'report_transaction')
    ));
    echo $this->Form->hidden('base_url', array('id' => 'hidden_site_baseurl', 'value' => $this->request->base . ((!is_null($this->params['language'])) ? '/' . $this->params['language'] : '')));

    echo $this->Form->hidden('reimbursement_with', array('readonly' => true));
    ?>
    <div class="col-sm-12">
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
                <label for="reg_input_name" class="req">Choose Project</label>
                <span class="colon">:</span>
                <div class="col-sm-10">
                    <?php
                    echo $this->data['DealProject']['project_name'];
                    ?></div>
            </div>
            <?php if ($this->data['Deal']['deal_billing_type'] == '1') { ?>
                <div class="form-group builder">
                    <label for="reg_input_name" class="req" >Choose Builder</label>
                    <span class="colon">:</span>
                    <div class="col-sm-10">
                        <?php
                        echo $this->data['DealBuilder']['builder_name'];
                        ?></div>
                </div>
            <?php } else { ?>
                <div class="form-group partner">
                    <label for="reg_input_name" class="req" >Choose Partner</label>
                    <span class="colon">:</span>
                    <div class="col-sm-10">
                        <?php
                        echo $this->data['DealPartner']['marketing_partner_display_name'];
                        ?></div>
                </div>
            <?php } ?>
            <div class="form-group">
                <label>Floor Number</label>
                <span class="colon">:</span>
                <div class="col-sm-10">
                    <?php echo $this->data['Deal']['deal_unit_floor']; ?>
                </div>
            </div>
            <div class="form-group">
                <label for="reg_input_name" class="req">Choose Client</label>
                <span class="colon">:</span>
                <div class="col-sm-10">
                    <?php
                    echo $this->data['DealClient']['lead_fname'].' '.$this->data['DealClient']['lead_lname'];
                    ?></div>
            </div>
            <div class="form-group" >
                <label for="reg_input_name" class="req">Booking Date</label>
                <span class="colon">:</span>
                <div class="col-sm-10">.
                    <?php if ($this->data['Deal']['deal_booking_date'])
                            echo date('d-m-Y', strtotime($this->data['Deal']['deal_booking_date'])); ?>
                                 </div>
            </div>
            <div class="form-group percsym">
                <label>Commission % </label>
                <span class="colon">:</span>
                <div class="col-sm-10">
                    <?php echo $this->data['Deal']['deal_commission_percent']; ?>
                       </div>
            </div> 
            <div class="form-group" >
                <label for="reg_input_name" class="req">Tentative Reg.  Date</label>
                <span class="colon">:</span>
                <div class="col-sm-10">
                    <?php if ($this->data['Deal']['deal_expected_invoice_date'])
                            echo date('d-m-Y', strtotime($this->data['Deal']['deal_expected_invoice_date']));?>
                
                </div>
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
                <label for="reg_input_name" class="req">Choose Unit</label>
                <span class="colon">:</span>
                <div class="col-sm-10">
                    <?php
                    echo $this->data['DealUnit']['unit_name'];
                    ?></div>
            </div>
            <div class="form-group">
                <label>Sale Pattern</label>
                <span class="colon">:</span>
                <div class="col-sm-10">
                    <?php echo $this->data['Deal']['deal_sale_pattern']; ?></div>
            </div>
            <div class="form-group">
                <label for="reg_input_name" class="req">Property Value</label>
                <span class="colon">:</span>
                <div class="col-sm-10">
                    <?php
                    echo $this->data['Deal']['deal_invoiced_on_amount'];
                    ?>
                </div>
            </div>
            <div class="form-group">
                <label for="reg_input_name" class="req">Booking Amount</label>
                <span class="colon">:</span>
                <div class="col-sm-10">
                    <?php
                    echo $this->data['Deal']['deal_booking_amount'];
                    ?>
                </div>
            </div>
            <div class="form-group">
                <label>Commission Event</label>
                <span class="colon">:</span>
                <div class="col-sm-10">
                    <?php echo $this->data['CommissionEvent']['value']; ?></div>
            </div>
            <div class="form-group" >
                <label for="reg_input_name" class="req">Tentative Invoice  Date</label>
                <span class="colon">:</span>
                <div class="col-sm-10">
                    <?php $deal_actual_invoice_date = '';
                        if ($this->data['Deal']['deal_actual_invoice_date'])
                            echo date('d-m-Y', strtotime($this->data['Deal']['deal_actual_invoice_date']));?>
                </div>
            </div>
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
                    <div class="col-sm-6 return_cln" style="display:none;">
                        <div class="form-group" id="rejection">
                            <label>Reason for Release</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10">
                                <?php echo $this->Form->input('lookup_return_id', array('id' => 'return_id', 'options' => $returns, 'empty' => '--Select--')); ?>
                            </div>
                        </div>
                    </div>
                                   </div>
    <div class="col-sm-12 fullrow return_cln" style="display:none;">
                    <div class="form-group">
                        <label>Comment</label>
                        <span class="colon">:</span>
                        <div class="col-sm-10">
                            <?php
                            echo $this->Form->input('other_return', array('type' => 'textarea'));
                            ?></div>
                    </div>
                </div>
    <div class="row">
        <div class="col-sm-12"><?php echo $this->Form->submit('Action', array('class' => 'success btn', 'div' => false, 'id' => 'udate_unit')); ?><?php
            echo $this->Form->button('Reset', array('type' => 'reset', 'class' => 'reset btn'));
            ?></div>
    </div>           


    <?php echo $this->Form->end();
    ?>
</div>	
 
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
    $('#ActionItemTypeId').change(function() {
        var val = $(this).val();
        if (val == '8') {
            $('.return_cln').css('display', 'block');
            
        }
        else
        {
            $('.return_cln').css('display', 'none');
            
        }
    });
</script>
