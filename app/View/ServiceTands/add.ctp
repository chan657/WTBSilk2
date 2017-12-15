<?php
$this->Html->addCrumb('Add Service Trand', 'javascript:void(0);', array('class' => 'breadcrumblast'));
echo $this->Form->create('ServiceTand', array('method' => 'post',
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
                <legend><span>Add Service Trand</span></legend>
            </fieldset>
            <div class="row">
                <div class="col-sm-12">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="reg_input_name" class="req">ServiceCode</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10">
                                <?php
                                echo $this->Form->input('ServiceCode', array('data-required' => 'true','type' => 'text'));
                                ?></div>
                        </div>
                         <div class="form-group">
                            <label for="reg_input_name" class="req">ServiceType</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10">
                                <?php
                                echo $this->Form->input('ServiceType', array('data-required' => 'true','type' => 'text'));
                                ?></div>
                        </div>
                     
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="reg_input_name" class="req">SeqNo</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10">
                                <?php
                                echo $this->Form->input('SeqNo', array('data-required' => 'true','type' => 'text'));
                                ?></div>
                        </div>
                      
                    </div>
                    <div class="form-group">
                        <label for="reg_input_name" style="margin-left: 14px">TermsAndConditions</label>
                        <span class="colon">:</span>
                        <div class="col-sm-10">
                            <?php
                            echo $this->Form->input('TermsAndConditions', array('type' => 'textarea','style' => 'width:122%;height:100px'));
                            ?></div>
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
