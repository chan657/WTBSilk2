<?php
$this->Html->addCrumb('View / Edit Lot Links', 'javascript:void(0);', array('class' => 'breadcrumblast'));
//pr($this->data);
?>

<div class="col-sm-12" id="mycl-det">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h4 class="panel-title">View / Edit Information</h4>         
        </div>

        <div class="panel-body">
            <fieldset>
                <legend><span>View / Edit Lot Links</span></legend>
            </fieldset>
            <div class="row">
                <div class="col-sm-12">
                    <?php
                    echo $this->Form->create('DigLotLink', array('method' => 'post', 'id' => 'parsley_reg', 'class' => 'form-horizontal user_form', 'novalidate' => true,
                        'inputDefaults' => array(
                            'label' => false,
                            'div' => false,
                            'class' => 'form-control',
                        )
                    ));
            
                    ?>
                    <div class="col-sm-6"> 
                           
                        <div class="form-group">
                            <label for="reg_input_name" class="req">Base Name</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10 editable">
                                <p class="form-control-static"><?php echo $this->data['DigBase']['base_website_url']; ?></p>
                                <div class="hidden_control">
<?php  echo $this->Form->input('lot_links_base_id', array('options' => $DigBases, 'empty' => '--Select--', 'data-required' => 'true','tabindex' => '1')); ?>
                                </div>
                            </div>
                        </div>
                         <div class="form-group">
                            <label for="reg_input_name" class="req">Exact URL</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10 editable">
                                <p class="form-control-static"><?php echo $this->data['DigLotLink']['lot_links_exact_url']; ?></p>
                                <div class="hidden_control">
<?php echo $this->Form->input('lot_links_exact_url', array('data-required' => 'true','tabindex' => '3')); ?>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="reg_input_name" class="req">Usage Status</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10 editable">
                                <p class="form-control-static"><?php echo $this->data['DigBaseUsage']['value']; ?></p>
                                <div class="hidden_control">
<?php echo $this->Form->input('lot_links_usage_status',  array('options' => $DigLotLinkUsageStatus, 'empty' => '--Select--', 'data-required' => 'true','tabindex' => '5')); ?>
                                </div>
                            </div>
                        </div>
                       
                
                       
                        
                    </div>  
                    <div class="col-sm-6">
                       
                        <div class="form-group">
                            <label for="reg_input_name" class="req">Lot Name</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10 editable">
                                <p class="form-control-static"><?php echo $this->data['DigLot']['lot_name']; ?></p>
                                <div class="hidden_control">
<?php echo $this->Form->input('lot_links_lot_id', array('options' => $DigLots, 'empty' => '--Select--', 'data-required' => 'true','tabindex' => '2')); ?>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="reg_input_name" class="req">Sample URL</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10 editable">
                                <p class="form-control-static"><?php echo $this->data['DigLotLink']['lot_links_sample_url']; ?></p>
                                <div class="hidden_control">
<?php echo $this->Form->input('lot_links_sample_url', array('data-required' => 'true','tabindex' => '4')); ?>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="reg_input_name" class="req">Active?</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10 editable">
                                <p class="form-control-static"><?php echo $this->data['DigLotLink']['active']; ?></p>
                                <div class="hidden_control">
<?php echo $this->Form->input('active', array('options' => array('TRUE' => 'TRUE', 'FALSE' => 'FALSE'), 'empty' => '--Select--','tabindex' => '6')); ?>
                                </div>
                            </div>
                        </div>
      
                    </div>
          
                    <div class="form-group">
                            <label for="reg_input_name">Description</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10 editable">
                                <p class="form-control-static"><?php echo $this->data['DigLotLink']['lot_links_description']; ?></p>
                                <div class="hidden_control">
<?php echo $this->Form->input('lot_links_description', array('type' => 'textarea', 'style' => 'width:122%;height:100px','tabindex' => '7')); ?>
                                </div>
                            </div>
                        </div>
                  <div class="form-group">
                            <label for="reg_input_name">Comment</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10 editable">
                                <p class="form-control-static"><?php echo $this->data['DigLotLink']['lot_links_comment']; ?></p>
                                <div class="hidden_control">
<?php echo $this->Form->input('lot_links_comment', array('type' => 'textarea', 'style' => 'width:122%;height:100px','tabindex' => '8')); ?>
                                </div>
                            </div>
                        </div>
                    <div class="form-group">
                            <label for="reg_input_name">Instructions</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10 editable">
                                <p class="form-control-static"><?php echo $this->data['DigLotLink']['lot_links_instructions']; ?></p>
                                <div class="hidden_control">
<?php echo $this->Form->input('lot_links_instructions', array('type' => 'textarea', 'style' => 'width:122%;height:100px','tabindex' => '9')); ?>
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


