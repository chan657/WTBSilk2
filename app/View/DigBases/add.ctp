<?php
$this->Html->addCrumb('Add Base', 'javascript:void(0);', array('class' => 'breadcrumblast'));
echo $this->Form->create('DigBase', array('enctype' => 'multipart/form-data', 'method' => 'post',
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
                <legend><span>Add Base</span></legend>
            </fieldset>
            <div class="row">
                <div class="col-sm-12">
                    <div class="col-sm-6">
                        

                        <div class="form-group">
                            <label for="reg_input_name" class="req">Base Website</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10">
                                <?php
                                echo $this->Form->input('base_website_url', array('data-required' => 'true', 'tabindex' => '1'));
                                ?></div>
                        </div>
                      
                     
                        <div class="form-group">
                            <label for="reg_input_name" class="req">Target Geography</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10">
                                <?php
                                echo $this->Form->input('base_target_geography', array('options' => $DigBaseTargetGeographies, 'empty' => '--Select--', 'data-required' => 'true', 'tabindex' => '3'));
                                ?></div>
                        </div>
                        <div class="form-group">
                            <label for="reg_input_name" class="req">Used By</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10">
                                <?php
                                echo $this->Form->input('base_used_by', array('data-required' => 'true','options' =>$DigBaseUsedBies, 'empty' => '--Select--', 'tabindex' => '5'));
                                ?></div>
                        </div>
                        
                        <div class="form-group">
                            <label for="reg_input_name">Base PR</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10">
                                <?php
                                echo $this->Form->input('base_pr', array('type' => 'text', 'tabindex' => '7'));
                                ?></div>
                        </div>
                        <div class="form-group">
                            <label for="reg_input_name">Base DA</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10">
                                <?php
                                echo $this->Form->input('base_da', array('type' => 'text', 'tabindex' => '9'));
                                ?></div>
                        </div>
                        <div class="form-group">
                            <label for="reg_input_name">Auto Approved?</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10">
                                <?php
                                echo $this->Form->input('base_auto_approved', array('options' =>$DigBaseDaAaClLrLookups, 'empty' => '--Select--', 'tabindex' => '11'));
                                ?></div>
                        </div>
                     
                        <div class="form-group">
                            <label for="reg_input_name">Login Required?</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10">
                                <?php
                                echo $this->Form->input('base_login_required', array('options' =>$DigBaseDaAaClLrLookups, 'empty' => '--Select--', 'tabindex' => '13'));
                                ?></div>
                        </div>
                        <h4>&nbsp;</h4>
                        <div class="form-group">
                            <label for="reg_input_name">Base Usage Status</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10">
                                <?php
                                echo $this->Form->input('base_usage_status', array('options' => $DigBaseUsages,'empty' => '--Select--', 'tabindex' => '15'));
                                ?></div>
                        </div>                     
     
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="reg_input_name" class="req">Base Primary Type</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10">
                                <?php
                                echo $this->Form->input('base_type', array('options' => $DigBaseTypes, 'empty' => '--Select--','data-required' => 'true', 'tabindex' => '2'));
                                ?></div>
                        </div>
                        <div class="form-group">
                            <label for="reg_input_name" class="req">Usage Type</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10">
                                <?php
                                echo $this->Form->input('base_usage', array('options' => $DigBaseUsageTypes, 'empty' => '--Select--','data-required' => 'true', 'tabindex' => '4'));
                                ?></div>
                        </div>
                        <div class="form-group">
                            <label for="reg_input_name" class="req">Base Why</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10">
                                <?php
                                echo $this->Form->input('base_why', array('options' => $DigBaseWhies,'empty' => '--Select--','data-required' => 'true', 'tabindex' => '6'));
                                ?></div>
                        </div>
                        <div class="form-group">
                            <label for="reg_input_name">Base DF</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10"><?php
                                echo $this->Form->input('base_dofollow', array('options' => $DigBaseDofollows, 'empty' => '--Select--', 'tabindex' => '8'));
                                ?></div>
                        </div>
                        <div class="form-group">
                            <label for="reg_input_name">Base PA</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10"><?php
                                echo $this->Form->input('base_pa',array('type' => 'text', 'tabindex' => '10'));
                                ?></div>
                        </div>
                        <div class="form-group">
                            <label for="reg_input_name">Profile Equal To Public?</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10"><?php
                                echo $this->Form->input('base_pp',array('options' => $DigBaseDaAaClLrLookups, 'empty' => '--Select--', 'tabindex' => '12'));
                                ?></div>
                        </div>
                        <div class="form-group">
                            <label for="reg_input_name">Link Within Text?</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10"><?php
                                echo $this->Form->input('base_link_within_comment',array('options' => $DigBaseDaAaClLrLookups, 'empty' => '--Select--', 'tabindex' => '14'));
                                ?></div>
                        </div>
                        
                        <h4>&nbsp;</h4>
                        
                        <div class="form-group" style="margin-top:21px;">
                            <label for="reg_input_name">Base Active</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10">
                                <?php
                                echo $this->Form->input('active', array('options' => array('TRUE' => 'TRUE','FALSE' => 'FALSE'),'empty' => '--Select--', 'tabindex' => '16'));
                                ?></div>
                        </div>
                 </div>
                    <div style="clear: both;"></div>
                    <div class="col-sm-12">
                        <h4>Link Information</h4>
                        <div class="form-group">
                                    <label>Link 2</label>
                                    <span class="colon">:</span>
                                    <div class="col-sm-10 editable txtbox">
                                        <div class="row" id="fr-select">
                                            <div class="col-sm-4">
                                                <?php echo $this->Form->input('base_used_as1', array('options' =>$DigBaseTypes, 'empty' => '--Used As--', 'tabindex' => '17')); ?>
                                                
                                            </div>
                                            <div class="col-sm-4">
                                                <?php echo $this->Form->input('base_link1_category', array('options' =>$DigBaseLinkCategories, 'empty' => '--Link Category--', 'tabindex' => '18')); ?>
                                                
                                            </div>
                                            <div class="col-sm-4">
                                                <?php echo $this->Form->input('base_link1_dofollow', array('options' =>$DigBaseDaAaClLrLookups, 'empty' => '--Link Dofollow--', 'tabindex' => '19')); ?>
                                            </div>

                                        </div></div>
                                </div>
                        <div class="form-group">
                                    <label>Link 3</label>
                                    <span class="colon">:</span>
                                    <div class="col-sm-10 editable txtbox">
                                        <div class="row" id="fr-select">
                                            <div class="col-sm-4">
                                                <?php echo $this->Form->input('base_used_as2', array('options' =>$DigBaseTypes, 'empty' => '--Used As--', 'tabindex' => '20')); ?>
                                                
                                            </div>
                                            <div class="col-sm-4">
                                                <?php echo $this->Form->input('base_link2_category', array('options' =>$DigBaseLinkCategories, 'empty' => '--Link Category--', 'tabindex' => '21')); ?>
                                                
                                            </div>
                                            <div class="col-sm-4">
                                                <?php echo $this->Form->input('base_link2_dofollow', array('options' =>$DigBaseDaAaClLrLookups, 'empty' => '--Link Dofollow--', 'tabindex' => '22')); ?>
                                            </div>

                                        </div></div>
                                </div>
                        <div class="form-group">
                                    <label>Link 4</label>
                                    <span class="colon">:</span>
                                    <div class="col-sm-10 editable txtbox">
                                        <div class="row" id="fr-select">
                                            <div class="col-sm-4">
                                                 <?php echo $this->Form->input('base_used_as3', array('options' =>$DigBaseTypes, 'empty' => '--Used As--', 'tabindex' => '23')); ?>
                                                
                                            </div>
                                            <div class="col-sm-4">
                                                <?php echo $this->Form->input('base_link3_category', array('options' =>$DigBaseLinkCategories, 'empty' => '--Link Category--', 'tabindex' => '24')); ?>
                                                
                                            </div>
                                            <div class="col-sm-4">
                                               <?php echo $this->Form->input('base_link3_dofollow', array('options' =>$DigBaseDaAaClLrLookups, 'empty' => '--Link Dofollow--', 'tabindex' => '25')); ?>
                                            </div>

                                        </div></div>
                                </div>
   
                    </div>
                   
                    <div class="form-group">
                        <label for="reg_input_name" style="margin-left: 14px">Usage Instructions</label>
                        <span class="colon">:</span>
                        <div class="col-sm-10">
                            <?php
                            echo $this->Form->input('base_usage_instructions', array('type' => 'textarea', 'style' => 'width:122%;height:100px', 'tabindex' => '26'));
                            ?></div>
                    </div>
                    
                    <div class="form-group">
                        <label for="reg_input_name" style="margin-left: 14px">Base Comment</label>
                        <span class="colon">:</span>
                        <div class="col-sm-10">
                            <?php
                            echo $this->Form->input('base_comment', array('type' => 'textarea', 'style' => 'width:122%;height:100px', 'tabindex' => '27'));
                            ?></div>
                    </div>
                    <div class="form-group">
                        <label for="reg_input_name" style="margin-left: 14px">Base Description</label>
                        <span class="colon">:</span>
                        <div class="col-sm-10">
                            <?php
                            echo $this->Form->input('base_description', array('type' => 'textarea', 'style' => 'width:122%;height:100px', 'tabindex' => '28'));
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




