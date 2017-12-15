<?php
$this->Html->addCrumb('Add SightSeeing', 'javascript:void(0);', array('class' => 'breadcrumblast'));
echo $this->Form->create('SightSeeingElement', array('method' => 'post',
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
                <legend><span>Add SightSeeing</span></legend>
            </fieldset>
            <div class="row">
                <div class="col-sm-12">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="reg_input_name" class="req">Transfer Object Type</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10">
                                <?php
                                echo $this->Form->input('TransferObjectTypeId', array('options' => array(), 'empty' => '--Select--'));
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
                            <label for="reg_input_name">City Code</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10">
                                <?php
                                echo $this->Form->input('CityCode');
                                ?></div>
                        </div>

                        <div class="form-group">
                            <label for="reg_input_name">Transfer Element</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10"><?php
                                echo $this->Form->input('TransferElementID', array('type' => 'text'));
                                ?></div>
                        </div>
                      
                        <div class="form-group">
                            <label class="bgr">PickUp Time</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10">
                                <div class="input-group bootstrap-timepicker">
                                    <?php
                                    echo $this->Form->input('PickUptime', array('type' => 'text', 'class' => 'form-control time_picker'));
                                    ?>
                                    <span class="input-group-addon"><i class="icon-time"></i></span>
                                </div>

                            </div>
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
                        <div class="form-group">
                            <label for="reg_input_name">SightSeeing Name</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10">
                                <?php
                                echo $this->Form->input('SightSeeingName', array('type' => 'text'));
                                ?></div>
                        </div>
                        <div class="form-group">
                            <label class="bgr">Drop Time</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10">
                                <div class="input-group bootstrap-timepicker">
                                    <?php
                                    echo $this->Form->input('Droptime', array('type' => 'text', 'class' => 'form-control time_picker'));
                                    ?>
                                    <span class="input-group-addon"><i class="icon-time"></i></span>
                                </div>

                            </div>
                        </div>
                        





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
                        <label for="reg_input_name" style="margin-left: 14px">Supplier Policy</label>
                        <span class="colon">:</span>
                        <div class="col-sm-10">
                            <?php
                            echo $this->Form->input('SupplierPolicy', array('type' => 'textarea', 'style' => 'width:122%;height:100px'));
                            ?></div>
                    </div>
                    <div class="form-group">
                        <label for="reg_input_name" style="margin-left: 14px">Cancellation DeadLine</label>
                        <span class="colon">:</span>
                        <div class="col-sm-10">
                            <?php
                            echo $this->Form->input('CancellationDeadLine', array('type' => 'textarea', 'style' => 'width:122%;height:100px'));
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
                        <label for="reg_input_name" style="margin-left: 14px">SightSeeingDetails</label>
                        <span class="colon">:</span>
                        <div class="col-sm-10">
                            <?php
                            echo $this->Form->input('SightSeeingDetails', array('type' => 'textarea', 'style' => 'width:122%;height:100px'));
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



