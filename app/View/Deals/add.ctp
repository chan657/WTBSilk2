<?php
$this->Html->addCrumb('Add Transaction', 'javascript:void(0);', array('class' => 'breadcrumblast'));
echo $this->Form->create('Deal', array('method' => 'post',
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
            <h4 class="panel-title">Add Transaction</h4>
        </div>
        <div class="panel-body">
            <fieldset>
                <legend><span>Add Transaction</span></legend>
            </fieldset>
            <div class="row">

                <div class="col-sm-12">

                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Client</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10"><?php echo $this->Form->input('deal_id', array('options' => $leads, 'empty' => '--Select--','tabindex' => '1')); ?></div>
                        </div>
                       
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
                                echo $this->Form->input('deal_project_id', array('options' => $projects, 'empty' => '--Select'));
                                ?></div>
                        </div>
                        <div class="form-group builder" style="display:none;">
                            <label for="reg_input_name" class="req" >Choose Builder</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10">
                                <?php
                                echo $this->Form->input('deal_builder_id', array('options' => array(), 'empty' => '--Select'));
                                ?></div>
                        </div>
                        <div class="form-group partner" style="display:none;">
                            <label for="reg_input_name" class="req" >Choose Partner</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10">
                                <?php
                                echo $this->Form->input('deal_marketing_partner_id', array('options' => $partners, 'empty' => '--Select'));
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
                                    echo $this->Form->input('deal_booking_date', array('id' => 'dpd1', 'type' => 'text', 'data-date-format' => 'dd-mm-yyyy', 'data-date-autoclose' => 'true'));
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
                            <label for="reg_input_name" class="req">Tentative Reg.  Date</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10">
                                <div class="input-group date ebro_datepicker event_date_present_div" data-date-format="dd-mm-yyyy" data-date-autoclose="true">
                                    <?php
                                    echo $this->Form->input('deal_expected_invoice_date', array('id' => 'dpd1', 'type' => 'text', 'data-date-format' => 'dd-mm-yyyy', 'data-date-autoclose' => 'true'));
                                    ?>
                                    <span class="input-group-addon"><i class="icon-calendar"></i></span>
                                </div>


                            </div>
                        </div>




                    </div>
                    <div class="col-sm-6">
                         <div class="form-group">
                            <label>Cost Currency </label>
                            <span class="colon">:</span>
                            <div class="col-sm-10"><?php echo $this->Form->input('deal_currency', array('options' => array('INR' => 'INR', 'AED' => 'AED', 'USD' => 'USD'), 'empty' => '--Select--', 'value' => 'INR', 'disabled' => TRUE, 'selected' => TRUE, 'tabindex' => '20')); ?></div>
                        </div>
                        <div class="form-group">
                            <label for="reg_input_name" class="req">Billing Type</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10">
                                <?php
                                echo $this->Form->input('deal_billing_type', array('options' => $billing_types, 'empty' => '--Select--', 'disabled' => array('3', '4', '5', '6', '7')));
                                ?></div>
                        </div>
                        <div class="form-group">
                            <label for="reg_input_name" class="req">Project Legal Name</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10">
                                <?php
                                echo $this->Form->input('deal_project_legal_name_id', array('options' => array(), 'empty' => '--Select'));
                                ?></div>
                        </div>
                        <div class="form-group">
                            <label for="reg_input_name" class="req">Choose Unit</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10">
                                <?php
                                echo $this->Form->input('deal_project_unit_id', array('options' => array(), 'empty' => '--Select'));
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
                            <label for="reg_input_name" class="req">Tentative Invoice  Date</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10">
                                <div class="input-group date ebro_datepicker event_date_present_div" data-date-format="dd-mm-yyyy" data-date-autoclose="true">
                                    <?php
                                    echo $this->Form->input('deal_actual_invoice_date', array('id' => 'dpd1', 'type' => 'text', 'data-date-format' => 'dd-mm-yyyy', 'data-date-autoclose' => 'true'));
                                    ?>
                                    <span class="input-group-addon"><i class="icon-calendar"></i></span>
                                </div>


                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12 release_cln" style="display:none;">
                    <div class="form-group">
                        <label style="padding:0 0 0 15px">Comment</label>
                        <span class="colon" style="padding:0 0 0 15px">:</span>
                        <div class="col-sm-10" style="width:82%">
                            <?php
                            echo $this->Form->input('other_release', array('type' => 'textarea'));
                            ?></div>
                    </div>
                </div>



            </div>
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
?>   
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
        if (val == '11') {
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
