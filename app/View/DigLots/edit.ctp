<?php
$this->Html->addCrumb('View / Edit Lot', 'javascript:void(0);', array('class' => 'breadcrumblast'));
//pr($this->data);
?>

<div class="col-sm-12" id="mycl-det">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h4 class="panel-title">View / Edit Information</h4>         
        </div>

        <div class="panel-body">
            <fieldset>
                <legend><span>View / Edit Lot</span></legend>
            </fieldset>
            <div class="row">
                <div class="col-sm-12">
                    <?php
                    echo $this->Form->create('DigLot', array('method' => 'post', 'id' => 'parsley_reg', 'class' => 'form-horizontal user_form', 'novalidate' => true,
                        'inputDefaults' => array(
                            'label' => false,
                            'div' => false,
                            'class' => 'form-control',
                        )
                    ));
            
                    ?>
                    <div class="col-sm-6"> 
                           
                        <div class="form-group">
                            <label for="reg_input_name" class="req">Lot Name</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10 editable">
                                <p class="form-control-static"><?php echo $this->data['DigLot']['lot_name']; ?></p>
                                <div class="hidden_control">
<?php echo $this->Form->input('lot_name', array('data-required' => 'true','tabindex' => '1')); ?>
                                </div>
                            </div>
                        </div>
                         <div class="form-group">
                            <label for="reg_input_name" class="req">Lot Channel</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10 editable">
                                <p class="form-control-static"><?php if($this->data['DigLot']['lot_channel'] > 1) echo $this->data['Channel']['channel_name']; else echo $this->data['DigLot']['lot_channel']; ?></p>
                                <div class="hidden_control">
<?php echo $this->Form->input('lot_channel', array('options' => $DigLotUsedBies, 'empty' => '--Select--', 'data-required' => 'true','tabindex' => '3')); ?>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="reg_input_name" class="req">Lot Day</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10 editable">
                                <p class="form-control-static"><?php echo $this->data['DigLot']['lot_day']; ?></p>
                                <div class="hidden_control">
<?php echo $this->Form->input('lot_day', array('options' => array('1' => '1','2' => '2','3'=>'3'), 'empty' => '--Select--', 'data-required' => 'true','tabindex' => '5')); ?>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="reg_input_name" class="req">Lot Usage Status</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10 editable">
                                <p class="form-control-static"><?php echo $this->data['DigBaseUsage']['value']; ?></p>
                                <div class="hidden_control">
<?php  echo $this->Form->input('usage_status', array('options' => $DigLotUsageStatus, 'empty' => '--Select--','tabindex' => '7')); ?>
                                </div>
                            </div>
                        </div>
                
                       
                        
                    </div>  
                    <div class="col-sm-6">
                       
                        <div class="form-group">
                            <label for="reg_input_name" class="req">Lot Type</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10 editable">
                                <p class="form-control-static"><?php echo $this->data['DigLotType']['value']; ?></p>
                                <div class="hidden_control">
<?php echo $this->Form->input('lot_type', array('options' => $DigLotTypes, 'empty' => '--Select--', 'data-required' => 'true','tabindex' => '2')); ?>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="reg_input_name" class="req">Lot Used By</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10 editable">
                                <p class="form-control-static"><?php echo $this->data['DigLot']['lot_used_by']; ?></p>
                                <div class="hidden_control">
<?php echo $this->Form->input('lot_used_by', array('options' => array(), 'empty' => '--Select--','tabindex' => '4')); ?>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="reg_input_name" class="req">Active?</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10 editable">
                                <p class="form-control-static"><?php echo $this->data['DigLot']['active']; ?></p>
                                <div class="hidden_control">
<?php echo $this->Form->input('active', array('options' => array('TRUE' => 'TRUE', 'FALSE' => 'FALSE'), 'empty' => '--Select--','tabindex' => '6')); ?>
                                </div>
                            </div>
                        </div>
      
                    </div>
          
                    <div class="form-group">
                            <label for="reg_input_name" class="req">Lot Description</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10 editable">
                                <p class="form-control-static"><?php echo $this->data['DigLot']['lot_description']; ?></p>
                                <div class="hidden_control">
<?php echo $this->Form->input('lot_description', array('type' => 'textarea', 'style' => 'width:122%;height:100px','tabindex' => '8')); ?>
                                </div>
                            </div>
                        </div>
                  <div class="form-group">
                            <label for="reg_input_name" class="req">Lot Comment</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10 editable">
                                <p class="form-control-static"><?php echo $this->data['DigLot']['lot_comment']; ?></p>
                                <div class="hidden_control">
<?php echo $this->Form->input('lot_comment', array('type' => 'textarea', 'style' => 'width:122%;height:100px','tabindex' => '9')); ?>
                                </div>
                            </div>
                        </div>
                    <div class="form-group">
                            <label for="reg_input_name" class="req">Lot Instructions</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10 editable">
                                <p class="form-control-static"><?php echo $this->data['DigLot']['lot_Instructions']; ?></p>
                                <div class="hidden_control">
<?php echo $this->Form->input('lot_Instructions', array('type' => 'textarea', 'style' => 'width:122%;height:100px','tabindex' => '10')); ?>
                                </div>
                            </div>
                        </div>
                   
                  
                
                    <div style ="clear:both"></div>
                    <div class="form_submit clearfix" style="display:none">
                        <div class="row">
                            <div class="col-sm-1">
<?php
echo $this->Form->submit('Update', array('name' => 'add', 'class' => 'btn btn-success sticky_success', 'value' => 'add'));
?>
                            </div>
                            <div class="col-sm-1">
<?php echo $this->Form->button('Reset', array('type' => 'reset', 'class' => 'btn btn-danger sticky_important')); ?>
                            </div>


                        </div>

                    </div>
                    </div> 
<?php 
echo $this->Form->end(); 
?>
                
                   
                    
            </div>
        </div>
    </div>
</div>


