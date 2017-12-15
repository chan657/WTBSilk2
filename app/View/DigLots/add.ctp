<?php
$this->Html->addCrumb('Add Lot', 'javascript:void(0);', array('class' => 'breadcrumblast'));
echo $this->Form->create('DigLot', array('enctype' => 'multipart/form-data', 'method' => 'post',
    'id' => 'parsley_reg',
    'novalidate' => true,
    'inputDefaults' => array(
        'label' => false,
        'div' => false,
        'class' => 'form-control',
    )
));

echo $this->Form->hidden('base_url', array('id' => 'hidden_site_baseurl', 'value' => $this->request->base . ((!is_null($this->params['language'])) ? '/' . $this->params['language'] : '')));
?>

<div class="col-sm-12" id="mycl-det">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h4 class="panel-title">Add Information</h4>
        </div>
        <div class="panel-body">
            <fieldset>
                <legend><span>Add Lot</span></legend>
            </fieldset>
            <div class="row">
                <div class="col-sm-12">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="reg_input_name" class="req">Lot Name</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10">
                                <?php
                                echo $this->Form->input('lot_name',array('tabindex' => '1'));
                                ?></div>
                        </div>
                        
                        <div class="form-group">
                            <label for="reg_input_name" class="req">Lot Channel</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10">
                                <?php
                                echo $this->Form->input('lot_channel', array('options' => $DigLotUsedBies, 'empty' => '--Select--', 'data-required' => 'true','tabindex' => '3'));
                                ?></div>
                        </div>
                      
                        <div class="form-group">
                            <label for="reg_input_name">Lot Day</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10"><?php
                                echo $this->Form->input('lot_day', array('options' => array('1' => '1','2' => '2','3'=>'3'), 'empty' => '--Select--', 'data-required' => 'true','tabindex' => '5'));
                                ?></div>
                        </div>
                        <div class="form-group">
                            <label for="reg_input_name">Lot Usage Status</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10">
                                <?php
                                echo $this->Form->input('usage_status', array('options' => $DigLotUsageStatus, 'empty' => '--Select--','tabindex' => '7'));
                                ?></div>
                        </div>
                    

                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="reg_input_name" class="req">Lot Type</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10">
                                <?php
                                echo $this->Form->input('lot_type', array('options' => $DigLotTypes, 'empty' => '--Select--', 'data-required' => 'true','tabindex' => '2'));
                                ?></div>
                        </div>
                        <div class="form-group">
                            <label for="reg_input_name">Lot Used By</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10">
                                <?php
                                echo $this->Form->input('lot_used_by', array('options' => array(), 'empty' => '--Select--','tabindex' => '4'));
                                ?></div>
                        </div>                  

                        <div class="form-group">
                            <label for="reg_input_name">Active?</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10">
                                <?php
                                echo $this->Form->input('active', array('options' => array('TRUE' => 'TRUE', 'FALSE' => 'FALSE'), 'empty' => '--Select--','tabindex' => '6'));
                                ?></div>
                        </div>
                    </div>
                </div>
                <div style="clear: both"></div>                                 
                <div class="col-sm-12">                    
                    <div class="form-group">
                        <label for="reg_input_name" style="margin-left: 14px">Lot Description</label>
                        <span class="colon">:</span>
                        <div class="col-sm-10">
                            <?php
                            echo $this->Form->input('lot_description', array('type' => 'textarea', 'style' => 'width:122%;height:100px','tabindex' => '8'));
                            ?></div>
                    </div>
                    <div class="form-group">
                        <label for="reg_input_name" style="margin-left: 14px">Lot Comment</label>
                        <span class="colon">:</span>
                        <div class="col-sm-10">
                            <?php
                            echo $this->Form->input('lot_comment', array('type' => 'textarea', 'style' => 'width:122%;height:100px','tabindex' => '9'));
                            ?></div>
                    </div>
                    <div class="form-group">
                        <label for="reg_input_name" style="margin-left: 14px">Lot Instructions</label>
                        <span class="colon">:</span>
                        <div class="col-sm-10">
                            <?php
                            echo $this->Form->input('lot_Instructions', array('type' => 'textarea', 'style' => 'width:122%;height:100px','tabindex' => '10'));
                            ?></div>
                    </div>

                    <div class="row">
                        <div class="col-sm-1">
                            <?php
                            echo $this->Form->submit('Submit', array('class' => 'btn btn-success sticky_success'));
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