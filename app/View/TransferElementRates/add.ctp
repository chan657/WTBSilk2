<?php
$this->Html->addCrumb('Add SightSeeing Element Rate', 'javascript:void(0);', array('class' => 'breadcrumblast'));
echo $this->Form->create('TransferElementRate', array('method' => 'post',
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
                <legend><span>Add SightSeeing Element Rate</span></legend>
            </fieldset>
            <div class="row">
                <div class="col-sm-12">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="reg_input_name" class="req">TransferElementId</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10">
                                <?php
                                echo $this->Form->input('TransferElementId', array('data-required' => 'true','type' => 'text'));
                                ?></div>
                        </div>
                        <div class="form-group">
                            <label for="reg_input_name">isRatePerAdult</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10">
                                <?php
                                echo $this->Form->input('isRatePerAdult', array('options' => array('1' => 'Yes','2' => 'No'),'empty' => '--Select--'));
                                ?></div>
                        </div>
                        <div class="form-group">
                            <label for="reg_input_name">isRatePerVan</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10">
                                <?php
                                echo $this->Form->input('isRatePerVan', array('options' => array('1' => 'Yes','2' => 'No'),'empty' => '--Select--'));
                                ?></div>
                        </div>
                        <div class="form-group">
                            <label for="reg_input_name">isRatePerCar</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10">
                                <?php
                                echo $this->Form->input('isRatePerCar', array('options' => array('1' => 'Yes','2' => 'No'),'empty' => '--Select--'));
                                ?></div>
                        </div>
                         <div class="form-group">
                            <label for="reg_input_name" class="req">BuyingCurrency</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10">
                                <?php
                                echo $this->Form->input('BuyingCurrency', array('data-required' => 'true','type' => 'text'));
                                ?></div>
                        </div>
                     
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="reg_input_name" class="req">TransferElementRate</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10">
                                <?php
                                echo $this->Form->input('TransferElementRate', array('data-required' => 'true','type' => 'text'));
                                ?></div>
                        </div>
                        <div class="form-group">
                            <label for="reg_input_name">isRatePerChild</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10">
                                <?php
                                echo $this->Form->input('IsRatePerChild', array('options' => array('1' => 'Yes','2' => 'No'),'empty' => '--Select--'));
                                ?></div>
                        </div>
                        <div class="form-group">
                            <label for="reg_input_name">isRatePerCoach</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10">
                                <?php
                                echo $this->Form->input('isRatePerCoach', array('options' => array('1' => 'Yes','2' => 'No'),'empty' => '--Select--'));
                                ?></div>
                        </div>
                       
                        <div class="form-group">
                            <label for="reg_input_name" class="req">SupplierCode</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10">
                                <?php
                                echo $this->Form->input('SupplierCode', array('data-required' => 'true','type' => 'text'));
                                ?></div>
                        </div>
                      
                    </div>
                    <div style="clear: both;"></div>


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
