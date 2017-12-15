<?php
$this->Html->addCrumb('View / Edit Topic', 'javascript:void(0);', array('class' => 'breadcrumblast'));
//pr($this->data);
?>

<div class="col-sm-12" id="mycl-det">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h4 class="panel-title">View / Edit Information</h4>         
        </div>

        <div class="panel-body">
            <fieldset>
                <legend><span>View / Edit Topic</span></legend>
            </fieldset>
            <div class="row">
                <div class="col-sm-12">
                    <?php
                    echo $this->Form->create('DigTopic', array('method' => 'post', 'id' => 'parsley_reg', 'class' => 'form-horizontal user_form', 'novalidate' => true,
                        'inputDefaults' => array(
                            'label' => false,
                            'div' => false,
                            'class' => 'form-control',
                        )
                    ));
            
                    ?>
                    <div class="col-sm-6"> 
                           
                        <div class="form-group">
                            <label for="reg_input_name" class="req">Topic Name</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10 editable">
                                <p class="form-control-static"><?php echo $this->data['DigTopic']['topic_name']; ?></p>
                                <div class="hidden_control">
<?php echo $this->Form->input('topic_name', array('data-required' => 'true','tabindex' => '1')); ?>
                                </div>
                            </div>
                        </div>
                         <div class="form-group">
                            <label for="reg_input_name" class="req">Keywords</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10 editable">
                                <p class="form-control-static"><?php echo $this->data['DigTopic']['topic_keywords']; ?></p>
                                <div class="hidden_control">
<?php echo $this->Form->input('topic_keywords', array('type' => 'textarea', 'style' => 'width:100%;height:300px','tabindex' => '3')); ?>
                                </div>
                            </div>
                        </div>
           
                       
                        
                    </div>  
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="reg_input_name" class="req">Channel</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10 editable">
                                <p class="form-control-static"><?php if($this->data['DigTopic']['topic_channel'] > 1) echo $this->data['Channel']['channel_name']; else echo $this->data['DigTopic']['topic_channel']; ?></p>
                                <div class="hidden_control">
<?php echo $this->Form->input('topic_channel', array('options' => $Channel, 'empty' => '--Select--','tabindex' => '2')); ?>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="reg_input_name" class="req">Related Keywords</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10 editable">
                                <p class="form-control-static"><?php echo $this->data['DigTopic']['topic_related_keywords']; ?></p>
                                <div class="hidden_control">
<?php echo $this->Form->input('topic_related_keywords', array('type' => 'textarea', 'style' => 'width:100%;height:300px','tabindex' => '4')); ?>
                                </div>
                            </div>
                        </div>
                       
                      
                      <div class="form_submit clearfix" style="display:none">
                        <div class="row">
                            <div class="col-sm-1">
<?php
echo $this->Form->submit('Generate', array('name' => 'generate', 'class' => 'btn btn-success sticky_success', 'value' => 'generate'));
?>
                            </div>
                            


                        </div>

                    </div>
                   
                    </div>
                    
                    <div class="form-group">
                            <label for="reg_input_name" class="req">Anchors Raw</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10 editable">
                                <p class="form-control-static"><?php echo $this->data['DigTopic']['topic_anchors_raw']; ?></p>
                                <div class="hidden_control">
<?php echo $this->Form->input('topic_anchors_raw', array('value' => $keyword_value, 'style' => 'width: 957px;height: 95px;', 'readonly' => true)); ?>
                                </div>
                            </div>
                        </div>
                    <div class="form-group">
                            <label for="reg_input_name" class="req">Anchors Polished</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10 editable">
                                <p class="form-control-static"><?php echo $this->data['DigTopic']['topic_anchors_polished']; ?></p>
                                <div class="hidden_control">
<?php echo $this->Form->input('topic_anchors_polished', array('value' => $Ukeyword_value, 'style' => 'width: 957px;height: 95px;', 'readonly' => true)); ?>
                                </div>
                            </div>
                        </div>
                    <div class="form-group">
                            <label for="reg_input_name" class="req">Tags Raw</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10 editable">
                                <p class="form-control-static"><?php echo $this->data['DigTopic']['topic_tags_raw']; ?></p>
                                <div class="hidden_control">
<?php echo $this->Form->input('topic_tags_raw', array('value' => $keyword_value, 'style' => 'width: 957px;height: 95px;', 'readonly' => true)); ?>
                                </div>
                            </div>
                        </div>
                    <div class="form-group">
                            <label for="reg_input_name" class="req">Tags Polished</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10 editable">
                                <p class="form-control-static"><?php echo $this->data['DigTopic']['topic_tags_polished']; ?></p>
                                <div class="hidden_control">
<?php echo $this->Form->input('topic_tags_polished', array('value' => $Ukeyword_value, 'style' => 'width: 957px;height: 95px;', 'readonly' => true)); ?>
                                </div>
                            </div>
                        </div>
                    <div class="form-group">
                            <label for="reg_input_name" class="req">Related Raw</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10 editable">
                                <p class="form-control-static"><?php echo $this->data['DigTopic']['topic_related_anchors_raw']; ?></p>
                                <div class="hidden_control">
<?php echo $this->Form->input('topic_related_anchors_raw', array('value' => $related_key_value, 'style' => 'width: 957px;height: 95px;', 'readonly' => true)); ?>
                                </div>
                            </div>
                        </div>
                     <div class="form-group">
                            <label for="reg_input_name" class="req">Related Polished</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10 editable">
                                <p class="form-control-static"><?php echo $this->data['DigTopic']['topic_related_anchors_polished']; ?></p>
                                <div class="hidden_control">
<?php echo $this->Form->input('topic_related_anchors_polished', array('value' => $Urelated_key_value, 'style' => 'width: 957px;height: 95px;', 'readonly' => true)); ?>
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


