<?php
$this->Html->addCrumb('Add Transfer Element', 'javascript:void(0);', array('class' => 'breadcrumblast'));
echo $this->Form->create('TransferElement', array('method' => 'post',
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
                <legend><span>Add Transfer Element</span></legend>
            </fieldset>
            <div class="row">
                <div class="col-sm-12">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="reg_input_name" class="req">Transfer Object</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10">
                                <?php
                                echo $this->Form->input('TransferObjectId', array('options' => array(), 'empty' => '--Select--'));
                                ?></div>
                        </div>
                        <div class="form-group">
                            <label for="reg_input_name">From City Code</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10">
                                <?php
                                echo $this->Form->input('FromCityCode');
                                ?></div>
                        </div>
                        <div class="form-group">
                            <label class="bgr">Start Time</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10">
                                <div class="input-group bootstrap-timepicker">
                                    <?php
                                    echo $this->Form->input('StartTime', array('type' => 'text', 'class' => 'form-control time_picker'));
                                    ?>
                                    <span class="input-group-addon"><i class="icon-time"></i></span>
                                </div>

                            </div>
                        </div>
                        <div class="form-group">
                            <label for="reg_input_name">Time Cal Value</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10">
                                <?php
                                echo $this->Form->input('TimeCalValue');
                                ?></div>
                        </div>
                        <div class="form-group">
                            <label for="reg_input_name">Service Name</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10">
                                <?php
                                echo $this->Form->input('ServiceName', array('type' => 'text'));
                                ?></div>
                        </div>
                      




                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="reg_input_name" class="req">Transfer Service Type</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10">
                                <?php
                                echo $this->Form->input('TransferServiceTypeId', array('options' => array(), 'empty' => '--Select--'));
                                ?></div>
                        </div>
                        <div class="form-group">
                            <label for="reg_input_name">To City Code</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10">
                                <?php
                                echo $this->Form->input('ToCityCode');
                                ?></div>
                        </div>
                        <div class="form-group">
                            <label class="bgr">Stop Time</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10">
                                <div class="input-group bootstrap-timepicker">
                                    <?php
                                    echo $this->Form->input('StopTime', array('type' => 'text', 'class' => 'form-control time_picker'));
                                    ?>
                                    <span class="input-group-addon"><i class="icon-time"></i></span>
                                </div>

                            </div>
                        </div>
                        <div class="form-group">
                            <label for="reg_input_name">Priority</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10">
                                <?php
                                echo $this->Form->input('Priority', array('type' => 'text'));
                                ?></div>
                        </div> 
                        
                        
                        





                    </div>
                    <div class="form-group">
                        <label for="reg_input_name" style="margin-left: 14px">Important Note</label>
                        <span class="colon">:</span>
                        <div class="col-sm-10">
                            <?php
                            echo $this->Form->input('ImportantNote', array('type' => 'textarea', 'style' => 'width:122%;height:100px'));
                            ?></div>
                    </div>
                    <div class="form-group">
                        <label for="reg_input_name" style="margin-left: 14px">InterNational Arrivals</label>
                        <span class="colon">:</span>
                        <div class="col-sm-10">
                            <?php
                            echo $this->Form->input('InterNationalArrivals', array('type' => 'textarea', 'style' => 'width:122%;height:100px'));
                            ?></div>
                    </div>
                    <div class="form-group">
                        <label for="reg_input_name" style="margin-left: 14px">Domestic Arrivals</label>
                        <span class="colon">:</span>
                        <div class="col-sm-10">
                            <?php
                            echo $this->Form->input('DomesticArrivals', array('type' => 'textarea', 'style' => 'width:122%;height:100px'));
                            ?></div>
                    </div>
                    <div class="form-group">
                        <label for="reg_input_name" style="margin-left: 14px">Additional Info</label>
                        <span class="colon">:</span>
                        <div class="col-sm-10">
                            <?php
                            echo $this->Form->input('AdditionalInfo', array('type' => 'textarea', 'style' => 'width:122%;height:100px'));
                            ?></div>
                    </div>
                    <div class="form-group">
                        <label for="reg_input_name" style="margin-left: 14px">SupplierPolicy</label>
                        <span class="colon">:</span>
                        <div class="col-sm-10">
                            <?php
                            echo $this->Form->input('SupplierPolicy', array('type' => 'textarea', 'style' => 'width:122%;height:100px'));
                            ?></div>
                    </div>
                    <div class="form-group">
                        <label for="reg_input_name" style="margin-left: 14px">cancellation Deadline</label>
                        <span class="colon">:</span>
                        <div class="col-sm-10">
                            <?php
                            echo $this->Form->input('cancellationDeadline', array('type' => 'textarea', 'style' => 'width:122%;height:100px'));
                            ?></div>
                    </div>
                    <div class="form-group">
                        <label for="reg_input_name" style="margin-left: 14px">Tariff Note</label>
                        <span class="colon">:</span>
                        <div class="col-sm-10">
                            <?php
                            echo $this->Form->input('TariffNote', array('type' => 'textarea', 'style' => 'width:122%;height:100px'));
                            ?></div>
                    </div>
                    <div class="form-group">
                        <label for="reg_input_name" style="margin-left: 14px">Transfer Details</label>
                        <span class="colon">:</span>
                        <div class="col-sm-10">
                            <?php
                            echo $this->Form->input('TransferDetails', array('type' => 'textarea', 'style' => 'width:122%;height:100px'));
                            ?></div>
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
    </div>
</div>
