<?php
$this->Html->addCrumb('Add Booking', 'javascript:void(0);', array('class' => 'breadcrumblast'));
echo $this->Form->create('TravelBookingService', array('method' => 'post',
    'id' => 'parsley_reg',
    'novalidate' => true,
    'inputDefaults' => array(
        'label' => false,
        'div' => false,
        'class' => 'form-control',
    )
));
?>

<div class="col-sm-12" id="mycl-det">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h4 class="panel-title">Add Information</h4>
        </div>
        <div class="panel-body">
            <fieldset>
                <legend><span>Add Booking</span></legend>
            </fieldset>
            <div class="row">
                <div class="col-sm-12">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="reg_input_name" class="req">Booking Code</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10">
                                <?php
                                echo $this->Form->input('BookingCode', array('data-required' => 'true', 'tabindex' => '1'));
                                ?></div>
                        </div>

                        <div class="form-group">
                            <label for="reg_input_name">Supplier Code</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10">
                                <?php
                                echo $this->Form->input('BookingCodeSupplier', array('tabindex' => '3'));
                                ?></div>
                        </div>
                        <div class="form-group">
                            <label for="reg_input_name">Booking Currency</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10">
                                <?php
                                echo $this->Form->input('BookingCurrency', array('options' => array(), 'empty' => '--Select--', 'tabindex' => '5'));
                                ?></div>
                        </div>
                        <div class="form-group">
                            <label for="reg_input_name">Extra Total</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10">
                                <?php
                                echo $this->Form->input('ExtraTotal', array('type' => 'text', 'tabindex' => '7'));
                                ?></div>
                        </div>
                        <div class="form-group">
                            <label for="reg_input_name">Agent</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10">
                                <?php
                                echo $this->Form->input('BookByAgentId', array('options' => array(), 'empty' => '--Select--', 'tabindex' => '9'));
                                ?></div>
                        </div>



                        <div class="form-group">
                            <label for="reg_input_name">Is Online?</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10">
                                <?php
                                echo $this->Form->input('IsOnline', array('options' => array('1' => 'TRUE', '2' => 'FALSE'), 'empty' => '--Select--', 'tabindex' => '15'));
                                ?></div>
                        </div>
                        <div class="form-group">
                            <label for="input_name" class="req">Booking Date</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10">
                                <div class="input-group date ebro_datepicker event_date_present_div" data-date-format="dd-mm-yyyy" data-date-autoclose="true">
                                    <?php
                                    echo $this->Form->input('InvoiceDate', array('type' => 'text', 'data-date-format' => 'dd-mm-yyyy', 'data-date-autoclose' => 'true'));
                                    ?>
                                    <span class="input-group-addon"><i class="icon-calendar"></i></span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="input_name" class="req">Payment Due Date</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10">
                                <div class="input-group date ebro_datepicker event_date_present_div" data-date-format="dd-mm-yyyy" data-date-autoclose="true">
                                    <?php
                                    echo $this->Form->input('PaymentDueDate', array('type' => 'text', 'data-date-format' => 'dd-mm-yyyy', 'data-date-autoclose' => 'true'));
                                    ?>
                                    <span class="input-group-addon"><i class="icon-calendar"></i></span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="reg_input_name">Voucher Code</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10">
                                <?php
                                echo $this->Form->input('VoucherCode', array('tabindex' => '10'));
                                ?></div>
                        </div>
                        <div class="form-group">
                            <label for="reg_input_name">PricePerPersonSingle</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10">
                                <?php
                                echo $this->Form->input('PricePerPersonSingle', array('type' => 'text', 'tabindex' => '6'));
                                ?></div>
                        </div>
                        <div class="form-group">
                            <label for="reg_input_name">PricePerPersonDouble</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10">
                                <?php
                                echo $this->Form->input('PricePerPersonDouble', array('type' => 'text', 'tabindex' => '6'));
                                ?></div>
                        </div>
                        <div class="form-group">
                            <label for="reg_input_name">PricePerCWB</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10">
                                <?php
                                echo $this->Form->input('PricePerCWB', array('type' => 'text', 'tabindex' => '6'));
                                ?></div>
                        </div>
                         <div class="form-group">
                            <label for="reg_input_name">PriceAccomodation</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10">
                                <?php
                                echo $this->Form->input('PriceAccomodation', array('type' => 'text', 'tabindex' => '6'));
                                ?></div>
                        </div>
                    </div>





                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="reg_input_name">Booking Code Alt.</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10">
                                <?php
                                echo $this->Form->input('BookingCodeAlt', array('tabindex' => '2'));
                                ?></div>
                        </div>

                        <div class="form-group">
                            <label for="reg_input_name">Supplier Code Alt.</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10">
                                <?php
                                echo $this->Form->input('BookingCodeSupplierAlt', array('tabindex' => '4'));
                                ?></div>
                        </div>
                        <div class="form-group">
                            <label for="reg_input_name">Booking Total</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10">
                                <?php
                                echo $this->Form->input('BookingTotal', array('type' => 'text', 'tabindex' => '6'));
                                ?></div>
                        </div>
                        <div class="form-group">
                            <label for="reg_input_name">Agent Master</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10">
                                <?php
                                echo $this->Form->input('BookByAgentMasterId', array('options' => array(), 'empty' => '--Select--', 'tabindex' => '8'));
                                ?></div>
                        </div>
                        <div class="form-group">
                            <label for="reg_input_name">Agent Type</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10">
                                <?php
                                echo $this->Form->input('BookByAgentTypeId', array('options' => array(), 'empty' => '--Select--', 'tabindex' => '10'));
                                ?></div>
                        </div>
                        <div class="form-group">
                            <label for="input_name" class="req">Invoice Date</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10">
                                <div class="input-group date ebro_datepicker event_date_present_div" data-date-format="dd-mm-yyyy" data-date-autoclose="true">
                                    <?php
                                    echo $this->Form->input('InvoiceDate', array('type' => 'text', 'data-date-format' => 'dd-mm-yyyy', 'data-date-autoclose' => 'true'));
                                    ?>
                                    <span class="input-group-addon"><i class="icon-calendar"></i></span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="input_name" class="req">Confirmation Date</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10">
                                <div class="input-group date ebro_datepicker event_date_present_div" data-date-format="dd-mm-yyyy" data-date-autoclose="true">
                                    <?php
                                    echo $this->Form->input('ConfirmationDate', array('type' => 'text', 'data-date-format' => 'dd-mm-yyyy', 'data-date-autoclose' => 'true'));
                                    ?>
                                    <span class="input-group-addon"><i class="icon-calendar"></i></span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="reg_input_name">Invoice Code</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10">
                                <?php
                                echo $this->Form->input('InvoiceCode', array('tabindex' => '10'));
                                ?></div>
                        </div>
                        <div class="form-group">
                            <label for="reg_input_name">PricePerPersonTwin</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10">
                                <?php
                                echo $this->Form->input('PricePerPersonTwin', array('type' => 'text', 'tabindex' => '6'));
                                ?></div>
                        </div>
                        <div class="form-group">
                            <label for="reg_input_name">PricePerPersonTriple</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10">
                                <?php
                                echo $this->Form->input('PricePerPersonTriple', array('type' => 'text', 'tabindex' => '6'));
                                ?></div>
                        </div>
                        <div class="form-group">
                            <label for="reg_input_name">PricePerPersonQuad</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10">
                                <?php
                                echo $this->Form->input('PricePerPersonQuad', array('type' => 'text', 'tabindex' => '6'));
                                ?></div>
                        </div>
                        <div class="form-group">
                            <label for="reg_input_name">PricePerCNB</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10">
                                <?php
                                echo $this->Form->input('PricePerCNB', array('type' => 'text', 'tabindex' => '6'));
                                ?></div>
                        </div>
                        <div class="form-group">
                            <label for="reg_input_name">PriceOthers</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10">
                                <?php
                                echo $this->Form->input('PriceOthers', array('type' => 'text', 'tabindex' => '6'));
                                ?></div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="reg_input_name" style="margin-left: 14px">Additional Information</label>
                        <span class="colon">:</span>
                        <div class="col-sm-10">
                            <?php
                            echo $this->Form->input('AdditionalInformation', array('type' => 'textarea', 'style' => 'width:122%;height:100px', 'tabindex' => '16'));
                            ?></div>
                    </div>
                    <div class="form-group">
                        <label for="reg_input_name" style="margin-left: 14px">Special Instruction</label>
                        <span class="colon">:</span>
                        <div class="col-sm-10">
                            <?php
                            echo $this->Form->input('structure_special_instruction', array('type' => 'textarea', 'style' => 'width:122%;height:100px', 'tabindex' => '17'));
                            ?></div>
                    </div>
                    <div class="row">
                        <div class="col-sm-1">
                            <?php
                            echo $this->Form->submit('Submit', array('name' => 'add', 'class' => 'btn btn-success sticky_success', 'value' => 'add'));
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





